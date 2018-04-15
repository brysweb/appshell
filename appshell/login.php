<?php
require("config.php");

//print_r($_POST); exit();
if(empty($_POST['username'])) die("Username required");
if(empty($_POST['password'])) die("Password required");	
//if(empty($_POST['name'])) die("First name required");	
//if(empty($_POST['email'])) die("email required");	
    
	$username = $_POST['username'];
	$password = $_POST['password'];
	//$name = $_POST['name'];
	//$email = $_POST['email'];
	$hash = md5($password);
	
  
	

	$query = "SELECT ID, username, name, email FROM users WHERE username = :username AND password = :password";
		$query_params = array(':username' => $username, ':password' => $hash);
	//	print_r($_POST); exit();
		

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
    } catch(PDOException $ex){ 
			http_response_code(500);
			echo json_encode(array(
				'error' => array(	
				'msg' => 'Error on select user: ' . $ex->getMessage(),
				'code' => $ex->getCode(),
				),
			));
			exit();
		}
//  require("config.php");

if($_POST['remember']) {
	setcookie('remember_me', $_POST['username'], $year);
	}
	elseif(!$_POST['remember']) {
		if(isset($_COOKIE['remember_me'])) {
			$past = time() - 100;
			setcookie(remember_me, gone, $past);
		}
	}
?>



