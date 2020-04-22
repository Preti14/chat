<?php
//connectivity
	
	$con = mysqli_connect('localhost', 'root', '', 'chat');
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
	
	if($_REQUEST['msg']){
		
		$msg = $_REQUEST['msg'];
		$iduser = $_REQUEST['iduser'];
		$sql = "INSERT INTO chat (iduser, msg, created_date)
	VALUES (".$iduser.",'".$msg."', now())";

	if (mysqli_query($con, $sql)) {
		$last_id = mysqli_insert_id($con);
		//echo "New record created successfully. Last inserted ID is: " . $last_id;
		return true;
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
		return false;
	}
		
	}
	
	if($_REQUEST['logout']){
		session_start(); //to ensure you are using same session
		session_destroy(); //destroy the session
		header("Location: http://localhost/chat/index.php");
		exit();
				
	}