<?php

function executeQuery($query){
	
	$dbname="";
	if (session_status()!=PHP_SESSION_ACTIVE) { session_start(); }
	if(!isset($_SESSION["user_name"])){
		$dbname="control_vehiculos";
	}else{
		
		$usuario=$_SESSION["user_name"];
		if($_SESSION[$usuario]=='Neuquen'){
			$dbname="control_vehiculos_nqn";
		}else if($_SESSION[$usuario]=='Tucuman'){
			$dbname="control_vehiculos";
		}
	}
	
	$dbPass="881718";
	$dbUser="root";
	
	$link = new mysqli("localhost",$dbUser,$dbPass,$dbname);
	if ($link->connect_errno) {
		echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
	}	
	$resultado = $link->query($query);
	mysqli_close($link);
	return $resultado;

}

?>