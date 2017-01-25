<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ep');
define('DB_USER','root');
define('DB_PASSWORD','');

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die (mysqli_error($connection));
$db=mysqli_select_db($connection, DB_NAME) or die (mysqli_error($connection));

function Redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

function SignIn($con){
	session_start();   //starting the session for user profile page
	if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
	{
		$user = $_POST['user'];
		$pw = $_POST['pass'];
		$result = mysqli_query($con,"SELECT *  FROM usuario WHERE nombre_usuario ='$user' AND password = '$pw'");
		if($result){
			$row = mysqli_fetch_assoc($result);
			if(!empty($row['nombre_usuario']) AND !empty($row['password']))
			{
				$_SESSION['nombre_usuario'] = $row['password'];
				echo "Has iniciado sesion exitosamente ".$row['nombre_usuario']."!";
				$url = "http://localhost/ep/home.php";
				Redirect($url); //Redirijo al home
			}
			else
			{
				echo "Error: Nombre de usuario o clave incorrecta";
			}
		}
		else{
			echo "Error: ".mysqli_error($con);
		}
		
	}
}

if(isset($_POST['submit'])){
	SignIn($connection);
}

?>	