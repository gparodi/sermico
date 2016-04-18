<?php
require('db.php');
$usuario=$_POST['user'];
$pass=md5($_POST['pass']);
$query="call buscar_usuario('".$usuario."','".$pass."');";
$result=executeQuery($query);
if($result){
		 while($row = $result->fetch_assoc())
		{
			$user=$row['user'];
			$perfil=$row['perfil'];
			$ubicacion=$row['ubicacion'];
			
		}
		if($user==$usuario){
			$usuario_array=array("resultado"=>"TRUE","user"=>$user,"perfil"=>$perfil);
			if (!isset($_SESSION)) { session_start(); }
			 $_SESSION['user_name']=$user;
			 $_SESSION[$user]=$ubicacion;
			 echo json_encode($usuario_array);
			
		}
		
}else{
	$usuario_array=array("resultado"=>"FALSE");	
	echo json_encode($usuario_array);
}





?>