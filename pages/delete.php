
    <?php require_once('../functions/functions.php');
    
    if(isset($_GET['id'])) {
    $reservation_id=$_GET['id'];
   
    }else {
        header('Location: reservation_management.php');
        exit();
    }
try{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

   
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("DELETE FROM reservation_details  WHERE res_id = :res_id");
    $stmt->bindParam(':res_id', $reservation_id);
    $stmt->execute(); 
    header('Location: reservation_management.php?success=true');  
}catch (PDOException $e) {
    echo "Connection failed! " . $e->getMessage();
}
    ?>
