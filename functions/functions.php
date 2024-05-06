<?php 
require_once('../config/db_config.php');
require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  function save_to_db($name,$email,$phone,$guests,$date){  
    global $success_msg;  

     $customer_name=$name;
     $customer_email=$email;
     $customer_phone=$phone;
     $number_of_guests=$guests;
     $reservation_date_time=$date;
   
     $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
     $username = DB_USERNAME;
     $password = DB_PASSWORD;
   try {
        $pdo = new PDO($dsn, $username, $password);   
      
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       //Add data to customer_info table
       $stmt = $pdo->prepare("INSERT INTO customer_info (cus_name, cus_email,cus_phone) VALUES (:value1, :value2, :value3)");
       $stmt->bindParam(':value1', $customer_name);
       $stmt->bindParam(':value2', $customer_email);
       $stmt->bindParam(':value3',$customer_phone);
       $stmt->execute();
   
       $cus_id_pk = $pdo->lastInsertId();
       
       //Add data to reservation_details table
       $stmt = $pdo->prepare("INSERT INTO reservation_details (res_date, no_of_guests, cus_id) VALUES (:value1, :value2, :value3)");
       $stmt->bindParam(':value1', $reservation_date_time);
       $stmt->bindParam(':value2', $number_of_guests);
       $stmt->bindParam(':value3', $cus_id_pk);
       $stmt->execute();
       $success_msg="Successfuly submitted the reservation!";
   
   } catch (PDOException $e) {
       echo 'Connection failed!  ' . $e->getMessage();
   }
    
  }
 ?>

 <?php 
 function sanitizeFormData($formData){
    $formData=stripslashes($formData);
    $formData=trim($formData);
    $formData=htmlspecialchars($formData);
    
    return $formData;
  }
 ?>

 <?php 
  function sendMail($email,$message){
    $mail = new PHPMailer(true);
  try {
      // Server settings
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      
      $mail->setFrom($email, 'Sender');
      $mail->Password = 'vwmv samu hrgq ctds plkij';
      $mail->addAddress('witaji2005@dovesilo.com', 'Recipient');
      $mail->Body = $message;       
      $mail->Port = 587;
; 

      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Contact request from : '.$email;
      $mail->Body =  $message;

      echo 'Preparing to send email...';
      $mail->send();
      echo 'Email sent successfully.';
  } catch (Exception $e) {
      echo 'Error: ' . $mail->ErrorInfo;
  }
  } 

  
 ?>

 <?php 
 
 ?>

<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function processLogin($reg_username,$reg_password){
 
  $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
  $username = DB_USERNAME;
  $password = DB_PASSWORD;
   
 try {
     $pdo = new PDO($dsn, $username, $password);   
    
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
     $stmt = $pdo->prepare("SELECT * FROM registered_users WHERE user_name = :user_name ");
     $stmt->bindParam(':user_name', $reg_username);
    
     $stmt->execute();
     
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
     if ($result !== false) {
      $hashed_password = $result['user_pass']; 
      $user_display_name = $result['display_name'];
      $user_type = $result['user_type'];
      $_SESSION['user_display_name'] = $user_display_name;
      $_SESSION['user_type'] = $user_type;
      echo $user_type;
      return $hashed_password && password_verify($reg_password, $hashed_password);
  } else {
      
      return false;
  }
     
 }catch (PDOException $e) {
  echo 'Connection failed!  ' . $e->getMessage();
}
}
?>
