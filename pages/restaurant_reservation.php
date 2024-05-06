<!DOCTYPE html>
<html lange="en">
<head>

<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/res_styles.css">
<script type="text/javascript">
 
</script>
</head>
<body>
<?php require_once('../functions/functions.php'); ?>
<?php

?>
<?php 
/*Global variables for validation error messages*/
 global $name_err; 
 global $email_err; 
 global $phone_err;
 global $guests_err;
 global $date_err;

 $guests="";

$success_msg=""; 
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit_reservation'])) {
  $name=$email=$phone=$guests=$date=""; 
 
  /*Validate if fields are empty*/ 
  $name_err=empty($_POST["cus_name"])? $name_err="Name is required!": "";
  $email_err=empty($_POST["cus_email"])? $email_err="Email is required!": ""; 
  $phone_err=empty($_POST["cus_phone"]) ? $phone_err="Phone number is required!": "";
  $guests_err=empty($_POST["num_guests"])? $guests_err="Please selet number of guests!": "";
  $date_err=empty($_POST["res_date_time"])? $date_err="Please selet a reservation date!": "";

  /*Sanitize inputs*/
  $name=sanitizeFormData($_POST["cus_name"]);
  $email=sanitizeFormData($_POST["cus_email"]);
  $phone=sanitizeFormData($_POST["cus_phone"]);
  $guests=sanitizeFormData($_POST["num_guests"]);
  $date=sanitizeFormData($_POST["res_date_time"]) ;

  /*Further validation for email and phone*/
  $email_err=filter_var($email, FILTER_VALIDATE_EMAIL) ? "" : "Email invalid!";  
  $phone_err = preg_match('/^0(\d{9})$/',$phone,$matches)? "" : "Phone number must start with 0 and should have 10 digits in total!";

 /*If no validation errors are found, save to db*/
  if($name_err=="" && $email_err=="" && $phone_err=="" && $guests_err=="" && $date_err==""){
     save_to_db($name,$email,$phone,$guests,$date); 
  }
  
}    

 ?>
  
<h1>Restaurant Reservation System</h1>
<h2>Please fill out your details below.</h2>

<div class="customer_info_div">
<form id="res_form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<label >Customer name : <span class="reg_error">* <?php echo $name_err;?></span></label>
<input type="text" name="cus_name" value="<?php echo isset($name) ? $name : ''; ?>">

<label >Customer email : <span class="reg_error">* <?php echo $email_err;?></span></label>
<input type="text" name="cus_email" value="<?php echo isset($email) ? $email : '';?>">

<label >Customer phone number : <span class="reg_error">* <?php echo $phone_err;?></span></label>
<input type="text" name="cus_phone" value="<?php echo isset($phone) ? $phone : '';?>">

<label >Number of guests : <span class="reg_error">* <?php echo $guests_err;?></span></label>
<select name="num_guests">
  <option value="0" <?php echo $guests == '0' ? 'selected' : ''; ?>>----Please select----</option>
  <option value="1" <?php echo $guests == '1' ? 'selected' : ''; ?>>1</option>
  <option value="2" <?php echo $guests == '2' ? 'selected' : ''; ?>>2</option>
  <option value="3" <?php echo $guests == '3' ? 'selected' : ''; ?>>3</option>
  <option value="4" <?php echo $guests == '4' ? 'selected' : ''; ?>>4</option>
</select>

<label >Date / Time of reservation : <span class="reg_error">* <?php echo $date_err;?></span></label>
<input type="datetime-local"  name="res_date_time" value="<?php echo isset($date) ? $date : '';?>">

<div class="flex-container">
  <input type="submit" name="submit_reservation" value="Submit reservation" class="submitbtn"/> 
</div>
<div id="res_msg">
<?php echo "<small>" . ($success_msg != null ? $success_msg : "") . "</small>"; ?>
</div>
</form>
</div>
</body>
</html>
