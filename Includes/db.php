<?php



function executeQuery4($query){
	
		
	$host = gethostbyaddr($_SERVER['SERVER_ADDR']);
	$ip_cliente="";
	if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        $ip_cliente= $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $ip_cliente= $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        $ip_cliente= $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        $ip_cliente= $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        $ip_cliente= $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        $ip_cliente= $_SERVER["REMOTE_ADDR"];
    }
	$prefijo_ip=strchr($ip_cliente,".",true);
	$tipo_ip="";
	if($prefijo_ip==""){
		$tipo_ip="localhost";
	}
	if($prefijo_ip=="192"||$prefijo_ip=="10"||$prefijo_ip=="172"){
		$tipo_ip="privada";
	}else{
		$tipo_ip="publica";
	}
	if($tipo_ip=="publica"){
		if(!isset($_SESSION)){
    		session_start();
		}
		
		if(!isset($_SESSION[$ip_cliente])){
			
			$jsonData = file_get_contents(				"http://api.ipinfodb.com/v3/ip-city/?key=d0562b866396d2d2b8129e30ff3bf8c7e564a7b533b315f0e529113615fb909c&ip=".$ip_cliente."&format=json");
				
			$ubicacion_data = json_decode($jsonData,true);
			if($ubicacion_data["cityName"]!="Tucuman"||$ubicacion_data["regionName"]!="Tucuman"){
				$dbname="control_vehiculos_nqn";
				if(!isset($_SESSION)){
    				session_start();
				}
				$_SESSION[$ip_cliente]=$dbname;
			
		}else{
			$dbname="control_vehiculos";
			if(!isset($_SESSION)){
    			session_start();
			}
			$_SESSION[$ip_cliente]=$dbname;
		}
		
	}else{
		$stored_name=$_SESSION[$ip_cliente];
		$dbname=$stored_name;
	}
	}else{
		$dbname="control_vehiculos";
	}
	$dbname="control_vehiculos";
	$str_datos = file_get_contents("datos.json");
	$datos = json_decode($str_datos,true);
	$dbPass=$datos[$host]["Pass"];
	$user=$datos[$host]["User"];
	//$dbname="control_vehiculos";
	
	$link = @mysql_connect("localhost",$user,$dbPass)
		  or die ("Error al conectar a la base de datos.");
	  @mysql_select_db($dbname, $link)
		  or die ("Error al conectar a la base de datos");
	
	  $result = mysql_query($query);
	  mysql_close($link);
	  return $result;
	
}


function executeQuery($query){
	
	$dbname="control_vehiculos";
	$dbPass="881718";
	$user="root";
	//$dbname="control_vehiculos";
	
	$link = @mysql_connect("localhost",$user,$dbPass)
		  or die ("Error al conectar a la base de datos.");
	  @mysql_select_db($dbname, $link)
		  or die ("Error al conectar a la base de datos");
	
	  $result = mysql_query($query);
	  mysql_close($link);
	  return $result;
	
}
?>