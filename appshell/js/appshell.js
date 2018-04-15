//Globals
var currentUser = null;

$(document).ready(function() {
    toggleLoginLogoffItems(false);
});

//
function toggleLoginLogoffItems(loggedin) {
    if(loggedin == true){
        $('.loggedOn').show();
        $('.loggedOff').hide();
    } else {// login = false 
        $('.loggedOn').hide();
        $('.loggedOff').show();
    }
}

$('#logoutNavItem').on("click", function() {
    currentUser = null;
    toggleLoginLogoffItems(false);
});

//login
$("#logInButton").click(function(){
    $.ajax({
        url: 'login.php',
        type: 'POST',
        data:	{
                    username:   $("#loginUsername").val(), 
                    password:   $("#loginPwd").val()
                },
        dataType: 'html',
        success:	function(data){
            alert(data);

                        try {
                            data = JSON.parse(data);
                            alert("success");
                            currentUser = data.user[0]; // set the currentUser to the global variable
                            $("#loginUsername").val(""); 
                            // $("#signUpName").val("");
                            // $("#signUpEmail").val("");
                            $('#loggedInUsername').html(currentUser.name)
                             $("#loginPwd").val("");
                            toggleLoginLogoffItems(true);
                            $("#homeNavItem").click();
                        } catch (ex) {
                            alert(ex);
                        }
                    },
        error: 	    function (xhr, ajaxOptions, thrownError) {
                        alert("-ERROR:" + xhr.responseText + " - " + 
                        thrownError + " - Options" + ajaxOptions);
                    }
    });    		

});

//manage account

$('#manageAccountNavItem').on("click", function() {

  $('#manageAccountID').val(currentUser.ID);
  $('#manageAccountUserName').val(currentUser.username);
  $('#manageAccountName').val(currentUser.name);
  $('#manageAccountEmail').val(currentUser.email);

});
//update info
$('#manageAccountUpdate').on('click', function() {
   

    $.ajax({
        url: 'manageaccount.php',
        type: 'POST',
        data:	{
                    username:   $("#manageAccountUserName").val(""),
                    //name:       $("#manageAccountName").val(),
                    //email:      $("#manageAccontEmail").val(),
                    id:         $("#manageAccountID").val(currentUser.ID)
                   
                },
        dataType: 'html',
        success:	function(data){
            alert(data);
                        try {
                            data = JSON.parse(data);
                            alert("success");
                            currentUser = data.user; // set the currentUser to the global variable
                           // $("#manageAccountName").val("");
                            $("#manageAccountUserName").val(currentUser.username);
                            //$("#manageAccountEmail").val("");
                            $("#manageAccountID").val(currentUser.ID); 
                            toggleLoginLogoffItems(true);
                            $("#homeNavItem").click();
                        } catch (ex) {
                            alert(ex);
                        }
                    },
        error: 	    function (xhr, ajaxOptions, thrownError) {
                        alert("-ERROR:" + xhr.responseText + " - " + 
                        thrownError + " - Options" + ajaxOptions);
                    }
  
    });
});



//change password
$('#manageAccountChangePassword').on("click", function() {

    if($('#manageAccountOldPassword').val() == $('#manageAccountNewPassword').val()) {
        alert("new password can not be the same as old password");
         // evt.preventDefault();
        return ;
    }

    $.ajax({
        url: 'manageaccount.php',
        type: 'POST',
        data:	{
                    password:    $("#manageAccountOldPassword").val(currentUser.password),
                    newpassword: $("#manageaccountNewPassword").val("")
                    
                },
        dataType: 'html',
        success:	function(data){

                        try {
                            data = JSON.parse(data);
                            alert("success");
                            currentUser = data.user; // set the currentUser to the global variable
                            $("#manageAccountOldPassword").val(""),
                            $("#manageaccountNewPassword").val("")
                            toggleLoginLogoffItems(true);
                            $("#homeNavItem").click();
                        } catch (ex) {
                            alert(ex);
                        }
                    },
        error: 	    function (xhr, ajaxOptions, thrownError) {
                        alert("-ERROR:" + xhr.responseText + " - " + 
                        thrownError + " - Options" + ajaxOptions);
                    }
    });    		
    
    
    });

function select(e) {
    $('.pop').slideFadeToggle(function() {
      e.removeClass('deselected');
    });    
  }
  
  $(function() {
    $('#manageAccountChangePassword').on('click', function() {
      if($(this).hasClass('deselected')) {
        select($(this));               
      } else {
        $(this).addClass('deselected');
        $('.pop').slideFadeToggle();
      }
      return false;
    });
  
    $('.close').on('click', function() {
      select($('#manageAccountChangePassword'));
      return false;
    });
  });
  
  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
  };


//signup

$('#signUpButton').on('click', function() {
    if($('#signUpPassword').val() != $('#signUpConfirmPassword').val()) {
        alert("passwords must match");
         // evt.preventDefault();
        return ;
    }

    $.ajax({
        url: 'signup.php',
        type: 'POST',
        data:	{
                    username:   $("#signUpUsername").val(), 
                    name:       $("#signUpName").val(),
                    email:      $("#signUpEmail").val(),
                    password:   $("#signUpPassword").val()
                },
        dataType: 'html',
        success:	function(data){

                        try {
                            data = JSON.parse(data);
                            alert("success");
                            currentUser = data.user; // set the currentUser to the global variable
                            $("#signUpUsername").val(""); 
                            $("#signUpName").val("");
                            $("#signUpEmail").val("");
                            $("#signUpPassword").val("");
                            toggleLoginLogoffItems(true);
                            $("#homeNavItem").click();
                        } catch (ex) {
                            alert(ex);
                        }
                    },
        error: 	    function (xhr, ajaxOptions, thrownError) {
                        alert("-ERROR:" + xhr.responseText + " - " + 
                        thrownError + " - Options" + ajaxOptions);
                    }
    });    		
});

//remember me

