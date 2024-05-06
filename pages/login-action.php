<?php  

require_once('../functions/functions.php'); 

if(isset($_POST['user_name']) && isset($_POST['password'])){
    $reg_username=$_POST['user_name'];
    $reg_password=$_POST['password'];
  
    if(processLogin($reg_username,$reg_password)){         
        $_SESSION['successMessage'] = "Login successful!";
        header("Location: reservation_management.php");       
    } else {
        $_SESSION['errorMessage'] = "Invalid Credentials!";
        header('Location: login_form.php');  
    }
}

?>