
<!DOCTYPE html>
<html lange="en">
<head>

<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/res_styles.css">

</head>
<body>
    <?php require_once('../functions/functions.php');
    
    if(isset($_GET['id'])) {
    $reservation_id=$_GET['id'];
    $reservation_date=$_GET['date'];
    $email=$_GET['email'];
    $phone= $_GET['phone'];
    $guests=$_GET['guests'] ;
    }else {
        // If reservation ID is not provided, redirect to same page 
        header('Location: reservation_management.php');
        exit();
    }
        try{
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;

    
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
        //Update the reservation_details table
        $stmt = $pdo->prepare("UPDATE reservation_details SET no_of_guests= :guests, res_date=:res_date  WHERE res_id = :res_id");
        $stmt->bindParam(':guests', $guests);
        $stmt->bindParam(':res_date', $reservation_date);
        $stmt->bindParam(':res_id', $reservation_id);
        $stmt->execute(); 

        //Get the cus_id for the updated reservation above
        $stmt = $pdo->prepare("SELECT cus_id FROM reservation_details WHERE res_id = :res_id");
        $stmt->bindParam(':res_id', $reservation_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cus_id = $row['cus_id'];

        //Update the customer_info table
        $stmt = $pdo->prepare("UPDATE customer_info SET cus_email= :email, cus_phone=:phone  WHERE cus_id = :cusid");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':cusid', $cus_id);
        $stmt->execute(); 
       

        header('Location: reservation_management.php?success=true');       
        }catch (PDOException $e) {
            echo "Connection failed! " . $e->getMessage();
        }
    ?>
    
</body>
</html>