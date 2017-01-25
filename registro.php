<?php 
require_once("connection.php");

function PasswordGenerate(){
	$pw = rand(1000,5000);
	return $pw;
}

function SingUp($con){
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$password = PasswordGenerate();
	$link = "http://localhost/ep/verify.php?email=".$email;
	if(!empty($nombre) && !empty($apellido) && !empty($email) && !empty($password)){
		$to = $email;
		$subj = "Verifica tu cuenta de ETP";
		$mssg  = "Thanks for signing up!\n
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.\n 
		------------------------\n
		Usuario: ".$email."\n
		Clave: ".$password."\n
		------------------------\n
		Porfavor haz click en el siguiente link para verificar tu cuenta:\n
		".$link;
		$headers = "From:noreply@eval2prof.cl"."\r\n";
		mail($to, $subj, $mssg, $headers);
		$pw = md5($password);
		$query = "INSERT INTO usuario (nombre_usuario, apellido_usuario, password, email)
		VALUES (".$nombre.", ".$apellido.", ".$pw.", ".$email.");";
		$result = mysqli_query($con, $query);
		if($result){
			echo "Creando Usuario...";
		}
		else{
			echo "Algo salio mal :".mysqli_error($conn);
		}
	}
}

if(isset($_POST['registrar'])){
 	SingUp($connection);
}
?>
