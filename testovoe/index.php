<!DOCTYPE html>
<?php
	session_start();
?>


<?php
			$servername = 'localhost';
			$username = 'root';
			$pwd = '';
			$dbname = 'myDB';
			$email = $password = $group= " ";
			$emailErr = $passwordErr = $groupErr= "";
			$authErr="";
			$ok=TRUE;
			
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
 
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 
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
               
					// check if e-mail address is well-formed
					if (!preg_match("/[A-Z]/", $password )) {
						$passwordErr .= "Password must contain [A-Z]"; 
						$ok= FALSE;
					}
					
					if (!preg_match("/[0-9]/", $password )) {
						$passwordErr .= "Password must contain [0-9]"; 
						$ok= FALSE;
					}
				} 
			}
			

			// Create connection
			$conn = new mysqli($servername, $username, $pwd, $dbname);
			// Check connection
			if ($conn->connect_error) {
				header( "Location: install.php" );
				die("Connection failed: " . $conn->connect_error);
			}
			else
			{
			  if($ok===TRUE && $email!=" ")
			  {
				$sql = "SELECT * FROM Users WHERE `email`= ' ".$email. " ' ";
				$result = $conn->query($sql);

				if ($result) 
				{
					$row = $result->fetch_assoc();
					
					$_SESSION["group"]=$row["group"];
					//echo "<h1> ". $row["group"]."</h1>";
					
					$hash= $row["password"];
					$hash= trim($hash);
					//if( password_verify($password, $row["password"]) )
					if( crypt($password, $hash)=== $hash )
					{
						$location = "welcome.php";
						header( "Location: welcome.php" );
						exit();
					}
					else{
						
						if($password)
						{
							$authErr= "Wrong password";
							//echo $row["password"];
							//echo "\n <br>";
							//echo crypt($password, 'hs');
						}
					}
				} 
				else 
				{
					$authErr = "User isn't enregistred";
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
		<title>index page</title>
	</head>
	<body >
		
		 <div id="nav" style="margin: 0px;">
				<div style="float: right; height:100% "><a href="registration.php"> <button type="button" style="height:100%">Регистрация</button> </a> </div>
		</div>
		
		
		<form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method= "post" id="authentification" name="myForm" onsubmit="validatePassword()">
			<fieldset>
				<legend>Authentification:</legend>
				<span> <?php echo $authErr; ?> </span>
				email :
				<br>
				<input type="email" name="email" placeholder="yourname@email.com" required> <span> <?php echo " *".$emailErr; ?> </span>
				<br> password :
				<br>
				<input type="password" name="password" placeholder="yourpassword" required> <span> <?php echo " *".$passwordErr; ?> </span>
				<br>
				<input type="submit" name="Authentification" value="Войти">
			</fieldset>	
		</form>
		
		
		
	</body>
</html>