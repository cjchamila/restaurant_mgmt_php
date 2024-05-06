<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is authenticated
if (!isset($_SESSION['user_type'])) {
    echo "user type is ".$_SESSION['user_type'];
    header('Location: login_form.php');
    exit;
}

// Perform authorization check
if ($_SESSION['user_type'] !== 'admin') {
    echo "user type is ".$_SESSION['user_type'];
    header('Location: unauthorized.php');
    exit;
}
?>
<!DOCTYPE html>
<html lange="en">
<head>

<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/res_styles.css">
<script src="../js/reservation_management.js"></script>
</head>
<body>
<?php require_once('../functions/functions.php'); ?>

<h1>Restaurant Reservation Management Console</h1>
<dialog id="editDialog">
    <h3>Edit reservation</h3>
   <div class="customer_info_div" >
            <form id="edit_form"  method="post">
                <label>Reservation Id : </label>
                <input type="text" disabled id="resid" name="res_id"  >

                <label>Customer email : </label>
                <input type="email" id="mail" name="cus_email"  />

                <label>Customer phone : </label> 
                <input type="tel" id="phone" name="cus_phone"  />

                <label>Number of guests : </label>
                <input type="text" id="guest" name="guests" />

                <label>Reservation date : </label>
                <input type="datetime-local"  name="res_date_time" id="res_dt" >
                
                <div class="flex-container">
                <input type="button" id="updateDetails" name="update_reservation" value="Update details" class="submitbtn"/> 
                <input type="button" id="cancelEdit" value="Cancel"  class="cancelbtn" />
                </div>
            </form>
        </div>
</dialog>

<dialog id="deleteDialog">
<h1>Delete Reservation</h1>
<div class="customer_info_div" >
            <form id="delete_form" method="post">
                <label>Reservation Id : </label>
                <input type="text" disabled id="_resid" name="res_id" >

                <label>Customer email : </label>
                <input type="email" disabled id="_mail" name="cus_email"  />

                <label>Customer phone : </label> 
                <input type="tel" disabled id="_phone" name="cus_phone"  />

                <label>Number of guests : </label>
                <input type="text" disabled id="_guest" name="guests" />

                <label>Reservation date : </label>
                <input type="text" disabled id="_res_dt" name="res_date"  >
                
                <div class="flex-container">
                <input type="button" id="deleteDetails" name="delete_reservation" value="Delete reservation" class="submitbtn"/> 
                </div>
            </form>
        </div>
</dialog>
<?php 
get_reservation_details();
?>

<?php 
function get_reservation_details(){  
    global $success_msg;      
    
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
   
   try {
        $pdo = new PDO($dsn, $username, $password);   
      
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       //Retreive reservation details
       $stmt = $pdo->prepare("select rd.res_id,rd.res_date,rd.no_of_guests,rd.cus_id, ci.cus_name,ci.cus_phone,ci.cus_email 
       from reservation_details rd left outer join customer_info ci 
       on rd.cus_id =ci.cus_id ");
      
       $stmt->execute();
   
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       //Display results
       echo "<table>
       <tr>
       <th>Reservation ID</th>
       <th>Reservation date</th>
       <th>Number of guests</th>
       <th>Customer ID</th>
       <th>Customer name</th>
       <th>Customer phone</th>
       <th>Customer email</th>
       <th>Edit</th>
       <th>Delete</th>
       </tr>";
foreach ($rows as $row) {
    echo "<tr>
    <td>".$row['res_id']."</td>
    <td>".$row['res_date']."</td>
    <td>".$row['no_of_guests']."</td>
    <td>".$row['cus_id']."</td>
    <td>".$row['cus_name']."</td>
    <td>".$row['cus_phone']."</td>
    <td>".$row['cus_email']."</td>
    
    <td><a id='edit_link' href='#' data-id='".$row['res_id']."' data-date='".$row['res_date']."' data-guests='".$row['no_of_guests']."' data-phone='".$row['cus_phone']."' data-email='".$row['cus_email']."'>Edit</a></td>
    <td><a id='delete_link' href='#' data-id='".$row['res_id']."' data-date='".$row['res_date']."' data-guests='".$row['no_of_guests']."' data-phone='".$row['cus_phone']."' data-email='".$row['cus_email']."'>Delete</a></td>
    </tr>";
}
echo "</table>";
  
   } catch (PDOException $e) {
       echo 'Connection failed!  ' . $e->getMessage();
   }
    
  }
?>
</body>
</html>