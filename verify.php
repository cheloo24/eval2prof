<?php 
require_once("connection.php");

function Redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

function Verify($con){
	if(isset($_GET['email']) && !empty($_GET['email'])){
		$query = "SELECT email FROM usuario WHERE email=".$_GET['email'];
		$result = mysqli_query($con, $query);
		if($result){
			$qry = "UPDATE usuario SET activo='1' WHERE email=".$_GET['email'];
			$rslt = mysqli_query($con, $qry);
			if($rslt){
				echo "Su usario ha sido verificado";
				Redirect("http://localhost/ep/home.php");
			}
			else{
				echo "Error :".mysqli_error($con);
			}
		}
		else{
			echo "Error :".mysqli_error($con);
		}
	}
	else{
	    echo "Error problemas con el email, contactese con el administrador";
	}
}

?>