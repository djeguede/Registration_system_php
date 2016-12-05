<?php
	session_start();
?>

<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname= 'myDB';

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
	$sql2 = "CREATE TABLE IF NOT EXISTS Users ( `login` VARCHAR(32) NOT NULL,".
			"`email` VARCHAR(50) NOT NULL PRIMARY KEY,".
			"`password` VARCHAR(255) NOT NULL,".
			"`firstname` VARCHAR(32) NOT NULL,".
			"`lastname` VARCHAR(32) NOT NULL,".
			"`group` VARCHAR(32) NOT NULL);";
	
	if ($conn->query($sql) === TRUE) 
	{
		echo "Database created successfully"."\n";
		
		$conn2 = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn2->connect_error) {
				die("Connection failed: " . $conn2->connect_error);
		}
		
		if($conn2->query($sql2) === TRUE)
		{
			$conn2->close();
			header( "Location: registration.php " );
			exit();
		}
		else
		{
			echo "Error creating table: " . $conn2->error;
			$conn2->close();
		}
		
		
	} 
	else 
	{
		echo "Error creating database: " . $conn->error;
	}

$conn->close();

?>