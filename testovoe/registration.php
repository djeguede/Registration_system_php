<!DOCTYPE html>

<?php
	session_start();
?>


<?php

	$servername = 'localhost';
	$username = 'root';
	$pwd = '';
	$dbname = 'myDB';
    $firstname =$lastname =$login =$email =$password =$group = " ";
	$firstnameErr =$lastnameErr =$loginErr =$emailErr =$passwordErr= $groupErr=" ";
	$ok=TRUE;
 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
          return $data;
     }
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
	 
	if (empty($_POST["email"])) {
               $emailErr = "Email is required";
			   $ok= FALSE;
     }
	 else {
               $email = test_input($_POST["email"]);
               
         // check if e-mail address is well-formed
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             $emailErr = "Invalid email format"; 
			 $ok= FALSE;
           }
     } 
	 
	 
	 
	if (empty($_POST["password"])) {
		$passwordErr = "Email is required";
		$ok= FALSE;
	}
	else {
		$password = test_input($_POST["password"]);
               
		if (!preg_match('/[A-Z]/', $password )) {
			 $passwordErr .= "Password must contain [A-Z]"; 
			 $ok= FALSE;
		}
					
		if (!preg_match('/[0-9]/', $password )) {
			$passwordErr .= "Password must contain [0-9]"; 
			$ok= FALSE;
		}
		
		$password = password_hash($password, PASSWORD_DEFAULT);
		//$password =crypt($password, 'hs');
	}
	 
	 
	if (empty($_POST["group"])) {
		$groupdErr = "Email is required";
		$ok= FALSE;
	}
	else {
		
        $group = test_input($_POST["group"]);       	
	} 
	
	if (empty($_POST["login"])) {
		$loginErr = "Email is required";
		$ok= FALSE;
	}
	else {
		
        $login = test_input($_POST["login"]);       	
	} 
	
	
	if (empty($_POST["firstname"])) {
		$firstnameErr = "Email is required";
		$ok= FALSE;
	}
	else {
		
         $firstname = test_input($_POST["firstname"]);      	
	} 
	
	
	if (empty($_POST["lastname"])) {
		$lastnameErr = "Email is required";
		$ok= FALSE;
	}
	else {
		
        $lastname = test_input($_POST["lastname"]);       	
	} 
 }
 
 // Create connection
	$conn = new mysqli($servername, $username, $pwd, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
	  if($ok===TRUE && $login != " ")	
	  {
		$sql = "INSERT INTO Users (`login`, `email`, `password`, `firstname`, `lastname`, `group`) VALUES ( ' ".$login." ', ' ". $email. " ', ' ".$password ."', '".$firstname."', '".$lastname."', '".$group."' )";
	
		if ($conn->query($sql) === TRUE) 
		{
			echo "New record created successfully";
			
			$location = "index.php";
			header( "Location:$location" );
			exit();
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	
	  }
	}

	

$conn->close();
?>




<html>
<head>
 	<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />
	<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
	<link type="text/css" rel="stylesheet" href="style.css" async>
	<script  type="text/javascript" src="scripts.js" async> </script>
	<title>Registration page</title>
</head>

<body>
	<div id=" ">
	</div>

		<form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method= "post" id="registration" name="myForm" onsubmit="validatePassword()">
			<fieldset>
				<legend>Registration information:</legend>
				<br> first name :
				<br>
				<input type="text" name="firstname" placeholder="your first name" required> <span> <?php echo " *".$firstnameErr; ?> </span>
				<br> last name :
				<br>
				<input type="text" name="lastname" placeholder="your last name" required> <span> <?php echo " *".$lastnameErr; ?> </span>
				<br> login :
				<br>
				<input type="text" name="login" placeholder="your login" required> <span> <?php echo " *".$loginErr; ?> </span>
				<br> email :
				<br>
				<input type="email" name="email" placeholder="yourname@email.com" required> <span> <?php echo " *".$emailErr; ?> </span>
				<br> password :
				<br>
				<input type="password" name="password" placeholder="yourpassword" required> <span> <?php echo " *".$passwordErr; ?> </span>
				<br>
				Group:
				<br>
				<select name="group">
					<option value="user">Пользователь</option>
					<option value="moderator">Модератор</option>
					<option value="administrator">Администратор</option>
				</select>
				<br>
				<input type="submit" name="registration" value="Registration">
			</fieldset>	
		</form>
	
</body>

</html>