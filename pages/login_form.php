<?php ?>
<html>
<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="../css/res_styles.css">
<script src="../js/login_validation.js"></script>
</head>
<body>
    <div class="customer_info_div">
    <?php 
    require('../functions/functions.php');    
// echo password_hash("kamal@123", PASSWORD_DEFAULT);
    if (isset($_SESSION["errorMessage"])) {
        ?>
        <div class="unauthorized"><?php echo $_SESSION["errorMessage"]; ?></div>
        <?php
        unset($_SESSION["errorMessage"]); 
    }
    ?>
        <form action="login-action.php" method="post" id="login_form">
			
			<h2>Login</h2>
			<div >
				<label for="user_name">Username </label>
                <input name="user_name" id="user_name" type="text" required >
			</div>
			<div >
				<label for="password">Password </label> 
                <input	name="password" id="password" type="password" required>
			</div>
			<div class="flex-container">
				<input type="submit" name="login" value="Login" class="submitbtn"></span>
			</div>
		</form>
	</div>
</body>
</html>