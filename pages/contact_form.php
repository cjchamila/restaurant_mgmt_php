<!DOCTYPE html>
<html lange="en">
<head>

<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/res_styles.css">
<script src="../js/contact_form.js"></script>

</head>
<body>

<?php  
require_once('../functions/functions.php'); 



 global $name_err; 
 global $email_err; 
 global $phone_err;
 global $message_err;
 

$success_msg=""; 
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit_reservation'])) {
  $name=$email=$phone=$message="";  
   $phone=$_POST["cus_phone"];

   if(preg_match('/^0\d{9}$/',$phone)){
    $phone_err="";
   }else{
    $phone_err="Phone number must start with 0 and must have 10 total digits!";
   }

  $name=$name_err=="" ? sanitizeFormData($_POST["cus_name"]) : "";
  $email=$email_err=="" ? sanitizeFormData($_POST["cus_email"]) : "";
  $phone=$phone_err=="" ? sanitizeFormData($_POST["cus_phone"]) : "";
  $message=$message_err=="" ? sanitizeFormData($_POST["cus_msg"]) : "";
  // echo "Preparing to send email...From : '$email' Phone : '$phone' Message : '$message'";
 
  if(!$name_err && !$email_err && !$phone_err  && !$message_err  ){
   
     sendMail($email,$message);
  }
  

  
}    

   

 ?>
  
<h1>Contact us</h1>

<div class="customer_info_div">
<form novalidate id="contact_form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  >
<label >Customer name : *</label> 
<input type="text" id="cusname" name="cus_name" value="<?php echo isset($name) ? $name : ''; ?>" required>
<div><span class="error" >Please enter your name!!</span></div>

<label >Customer email : *</label>
<input type="email" id="mail" name="cus_email" value="<?php echo isset($email) ? $email : '';?>" required >
<div><span class="error" >Please enter email address!</span></div>

<label >Customer phone :  <span class="error">* <?php echo $phone_err;?></span></label>
<input type="tel" id="phone" name="cus_phone" value="<?php echo isset($phone) ? $phone : '';?>" required>
<div><span class="error" >Please enter phone number!</span></div>

<label >Message : *</label>
<textarea name="cus_msg" id="msg" rows="10" cols="50" required><?php echo isset($message) ? $message : '';?></textarea>
<div><span class="error" >Please enter message!</span></div>



<div class="flex-container">
  <input type="submit" name="submit_reservation" value="Send email" class="submitbtn"/> 
  <input type="hidden" id="form_validated_hidden_id" name="form_validated_hidden" value="false">
</div>
<div id="res_msg">

</div>
</form>
</div>
</body>
</html>
