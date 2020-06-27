<?php

if (! empty($_POST["register-user"])) {
    
    $username = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	$confirm_password = filter_var($_POST["confirm_password"], FILTER_SANITIZE_STRING);
	
    
	if(!empty($username) && !empty($password) && ($password == $confirm_password)){
		$save = true;
	}else{
		
		echo "<font color='red'> Check the given input values </font>";
		
	}
	
	//connectivity
	
	$con = mysqli_connect('localhost', 'root', '', 'chat');
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
	
	//extract($_POST);
	if(isset($save))
	{
	
	//To check user already exists or not
	$result = mysqli_query($con,"select username from users where username='$username'");
	
	if (mysqli_num_rows($result) > 0) {
	//if $return returns true value it means user's email already exists
		echo "<font color='red'>".ucfirst($username)."  already exists choose another </font>";
	}
	else
	{
	
	
	$sql = "INSERT INTO users (username, password, created_date)
	VALUES ('".$username."','".$password."', now())";

	if (mysqli_query($con, $sql)) {
		$last_id = mysqli_insert_id($con);
		echo "New record created successfully. Ready to login !!!";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
	
	
	}
	}
}
?>
<html>
<head>
<title>User Registration Form</title>
<link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Mrs.Mohanraj....</h1>
    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
        <div class="form-head">Sign Up</div>
            
<?php
if (! empty($errorMessage) && is_array($errorMessage)) {
    ?>	
            <div class="error-message">
            <?php 
            foreach($errorMessage as $message) {
                echo $message . "<br/>";
            }
            ?>
            </div>
<?php
}
?>
            <div class="field-column">
                <label>Username</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="userName"
                        value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>">
                </div>
            </div>
            
            <div class="field-column">
                <label>Password</label>
                <div><input type="password" class="demo-input-box"
                    name="password" value=""></div>
            </div>
            <div class="field-column">
                <label>Confirm Password</label>
                <div>
                    <input type="password" class="demo-input-box"
                        name="confirm_password" value="">
                </div>
            </div>
          
            <div class="field-column">
                <div>
                    <input type="submit"
                        name="register-user" value="Register"
                        class="btnRegister">
                </div>
            </div>
			<div class="field-column">
                <div>
                    <input type="button"
                        name="login-user"  onclick="window.location='/chat/login.php';"  value="login"
                        class="btnRegister">
                </div>
            </div>
			
        </div>
    </form>
</body>
</html>
