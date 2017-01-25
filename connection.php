<?php 
define('DB_HOST', 'localhost');
define('DB_NAME', 'ep');
define('DB_USER','root');
define('DB_PASSWORD','');

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die (mysqli_error($connection));
$db=mysqli_select_db($connection, DB_NAME) or die (mysqli_error($connection));

?>