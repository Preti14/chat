<html>
<head>
<title>User Registration Form</title>
<link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <?php session_start(); 
   //connectivity
	
	$con = mysqli_connect('localhost', 'root', '', 'chat');
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
	$result = mysqli_query($con, "SELECT * FROM chat c
		join users u on  u.iduser = c.iduser ");
   ?>
 <div>
 <button style="cursor:pointer" id="logout" name="logout"> LOGOUT </button>
	</div>
 <div class="chat-popup" id="myForm">
  <form  class="form-container">
    <h1>Chat</h1>	
	<div id="chat_box" class="chat-popup">
	<?php //echo "<pre>";
	while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		
		echo "<b>".$r['username'] ." :</b> ".$r['msg']." </br>";
	}
	?>
	</div>
	</br></br>
	</br>
	
    <label for="msg"><b>Message</b></label>
    <textarea style="height: 109px; width: 571px; font-size: 14px !important;" placeholder="Type message.." name="msg" id="msg" required></textarea>
	<input type="hidden" value="<?php echo $_SESSION['iduser'] ?>" name="iduser" id="iduser" />
	<input type="hidden" value="<?php echo $_SESSION['user_name'] ?>" name="user_name" id="user_name" />
    <button style="cursor:pointer" type="button" name="send" id="send" class="btn">Send</button>
    
  </form>
</div> 

</body>

<?php


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	
	$("#send").click(function(){
		var mssg = $("#msg").val();
		var userid = $("#iduser").val();var username = $("#user_name").val();
		
	  $.post("database.php",
	  {
		iduser: userid,
		msg: mssg
	  },
	  function(data, status){
		  if(status == 'success'){
			$("#chat_box").append("<b>"+username +" :</b> "+ mssg+" </br>");
			$("#msg").val('');
		  }
		  
		//alert("Data: " + data + "\nStatus: " + status);
	  });
	});
	
	$("#clear").click(function(){
		$("#msg").val('');
	});
	$("#logout").click(function(){
		
	   window.location = "./logout.php";
	});
});
</script>


