<?php
session_start();
if (! empty($_POST["login-user"])) {
    
    $username = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	
	
    
	if(!empty($username) && !empty($password)){
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
	$result = mysqli_query($con,"select * from users where username='$username' and password = '$password'");
	
	if (mysqli_num_rows($result) < 1) {
	//if $return returns true value it means user's email already exists
		echo "<font color='red'>".ucfirst($username)."  NOT exists </font>";
	}
	else
	{
	while ($row = mysqli_fetch_row($result)) {
		$_SESSION["iduser"]=$row[0];
		$_SESSION["user_name"]=$row[1];
	}	
	//	print_r($_SESSION);
	
	header("Location: http://localhost/chat/chat.php");

	exit();
	
	
	}
	}
}
?>
<html>
<head>
<title>Login Form</title>
<link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
        <div class="form-head">Login page</div>
            
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
                <div>
                    <input type="submit"
                        name="login-user" value="login"
                        class="btnRegister">
                </div>
            </div>
			<div class="field-column">
                <div>
                    <input type="button"
                        name="login-user"  onclick="window.location='/chat/index.php';"  value="register"
                        class="btnRegister">
                </div>
            </div>
        </div>
    </form>
</body>
</html>