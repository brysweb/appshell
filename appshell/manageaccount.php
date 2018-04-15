<?php
require("config.php");
	 
	//$name = $_POST['name'];
	$username = $_POST['username'];
	$id = $_POST['id'];
	
	$query = "SELECT 1 FROM users WHERE username = :username";
	$query_params = array(':username' => $username);
	

	try {  
		$stmt = $db->prepare($query); 
		$result = $stmt->execute($query_params); 
	} catch(PDOException $ex) { 
		http_response_code(500);
		echo json_encode(array(
				'error' => array(
				'msg' => 'Error on select checking for dupes: ' . $ex->getMessage(),
				'code' => $ex->getCode(),
			),
		));
		exit();
	} 	  

	$row = $stmt->fetch(); 
		if($row) { 
			//die("This username address is already registered"); 
			// setup reset password button and sent password via email
			//echo "0 .This username is already registered"; // for failure
			http_response_code(500);
			echo json_encode(array(
						'error' => array(
						'msg' => 'This username is already registered;',
						),
			)); /*. $ex->getMessage(),*/
			exit();
		} 

		$sql = "UPDATE users SET username = ':username' WHERE id = ':id'";
		
		$query_params = array(	
			':username' => $username,
			':id' => $id
		);

		try {  
            $stmt = $db->prepare($sql); 
            $result = $stmt->execute($query_params); 
		} catch(PDOException $ex) { 
				http_response_code(500);
				echo json_encode(array(
						'error' => array(
						'msg' => 'Error on update user: ' . $ex->getMessage(),
						'code' => $ex->getCode(),
					),
				));
				exit();
		} 	  
		$query = "SELECT  username FROM users WHERE username = :userName";
		$query_params = array(':userName' => $username);
	
		try { 
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params); 
			
			$outData = array();
			while($row = $stmt->fetch()) {
				$outData[] = $row;
			} 
			//echo json_encode($outData);
			echo '{"user":' . json_encode($outData) . '}'; 
			exit();
		}catch(PDOException $ex){ 
			http_response_code(500);
			echo json_encode(array(
				'error' => array(	
				'msg' => 'Error on select user: ' . $ex->getMessage(),
				'code' => $ex->getCode(),
				),
			));
			exit();
		} 

//change password
$sql = "UPDATE users SET raw_password = '$password', password = '$hash'";
	
	$query_params = array(
		
		':rawPassword' => $password, 		
		':password' => $hash
	); 	
		
	//print_r($query_params); exit();
	
	try {  
            $stmt = $db->prepare($sql); 
            $result = $stmt->execute($query_params); 
    } catch(PDOException $ex) { 
	        //echo "0 .Failed to run query: " . $ex->getMessage(); 
			//logmsg("signup.php : Failed to run query: " . $ex->getMessage());
			http_response_code(500);
			echo json_encode(array(
					'error' => array(
					'msg' => 'Error on update of psasword: ' . $ex->getMessage(),
					'code' => $ex->getCode(),
				),
			));
			exit();
    } 	  

?>