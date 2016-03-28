<?php
require('db.php');
$usuario=$_POST['user'];
$pass=md5($_POST['pass']);
$query="call buscar_usuario('".$usuario."','".$pass."');";
$result=executeQuery($query);
if(mysql_num_rows($result)>=1){
		 while($row = mysql_fetch_array($result))
		{
			$user=$row['user'];
			$perfil=$row['perfil'];
			
		}
		if($user==$usuario){
			$usuario_array=array("resultado"=>"TRUE","user"=>$user,"perfil"=>$perfil);
			if (!isset($_SESSION)) { session_start(); }
			 $_SESSION['user_name']=$user;
			 $_SESSION[$user]=$perfil;
			 echo json_encode($usuario_array);
			
		}
		
}else{
	$usuario_array=array("resultado"=>"FALSE");	
	echo json_encode($usuario_array);
}





?>