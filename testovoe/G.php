<!DOCTYPE html>
<?php
	session_start();
?>

<?php
  if( !isset($_SESSION["group"]) )
  {
	header('HTTP/1.0 404 Not Found');
	header('Status: 404 Not Found');
	echo "HTTP/1.0 404 : Вы не имеете доступ к данной странице";
	exit();

  }
  else
  {
	if( $_SESSION["group"]=="user" || $_SESSION["group"]=="moderator" )
	{
		header('HTTP/1.0 404 Not Found');
		header('Status: 404 Not Found');
		echo "HTTP/1.0 404: Вы не имеете доступ к данной странице";
		exit();
	}

  } 
?>


<html>
<head>
 	<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />
	<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
	<link type="text/css" rel="stylesheet" href="style.css" async>
	<script  type="text/javascript" src="scripts.js" async> </script>
	<title>page_G </title>
</head>

<body>
	<div id="nav">
	  
	  <ul>
		<img src=""  style="width:30%">
		<li> <a href="A.php">Страница А</a> </li>
		<li> <a href="B.php">Страница Б</a> </li>
		<li> <a href="V.php">Страница В</a> </li>
		<li> <a href="G.php">Страница Г</a> </li>
		<li> <a href="registration.php"> <button type="button"   id="bt1">Регистрация</button> </a> 
		</li>
	  </ul>
		
	</div>
	
	<div id="main" style="background-color:#f2f2f2">
		<marquee><h1> Страница Г</h1></marquee>
	</div>
	
	<div class="box" onclick="showModalWin(this)">
		<h1> box1 </h1>
		<h3> click on this area to open the modal window </h3>
	</div>
	
	<div class="box2" onclick="showModalWin(this)">
		<h1> box2 </h1>
		<h3> click on this area to open the modal window </h3>
	</div>
	
	<div class="box" onclick="showModalWin(this)">
		<h1> box3 </h1>
		<h3> click on this area to open the modal window </h3>
	</div>
	
	        <!-- Наше модальное всплывающее окно -->
    <div style="text-align: center" id="popupWin" class="modalwin">
		<form>
			<fieldset>
				<legend>Модальное окно</legend>
				<textarea id="textarea" style="width: 90%;"></textarea>
				<div id='button-group'>
					<input type="button" value="Ok" name="Ok" onclick= " setContent() ">
				</div>
			</fieldset>
		</form>    
    </div>
	
</body>

</html>