<?php
	require('mailSender.php');
	$listaplanes=array();
	$query = "call listar_planes_mantenimiento();";
	$result = executeQuery($query);	
	$i=0;
	while($row = mysql_fetch_array($result))
	  {
		   $listaplanes[$i]=$row;
		   $i++;
		  
	  }
	  mysql_free_result($result);
	  
	  for($i=0;$i<count($listaplanes);$i++){
		  
		if($listaplanes[$i]['estado']=="Activo"){
			$partes=array();
			$query = "call buscar_plan_mantenimiento(".$listaplanes[$i]['idplanMantenimiento'].");";
			$result = executeQuery($query);	
			$j=0;
			while($row = mysql_fetch_array($result))
			  {
				   $partes[$j]=$row;
				   $j++;			   
				  
			  }
			  $plan=$listaplanes[$i];
			  comprobarLista($partes,$plan);
			
		}
		  
	  }
		
		  
		  
	
	 
	
function comprobarLista($lista,$plan){
	$kmVehiculo=$plan['kmVehiculo'];
	$kmPlan=$plan['km'];
	$kmUltimo=$plan['ultimoKm'];
	$horaPlan=$plan['horas'];
	$diasPlan=$plan['dias'];
	$mesesPlan=$plan['meses'];
	$añosPlan=$plan['años'];
	$listaMails=array();
	
	$date1 = new DateTime($plan['ultimoVencimiento']);
	$date2 = new DateTime('now');
	$interval = $date1->diff($date2);
	
	$diffDias=$interval->format('%a días');
	$diffMeses=$interval->format('%m meses');
	$diffAños=$interval->format('%y años');
	
	$flagAlerta=0;
	
	if(($kmVehiculo-$kmUltimo)>=$kmPlan){
		$flagAlerta=1;
		echo"km";
	}
	if($diffDias>=$diasPlan){
		$flagAlerta=1;
	}
	if($diffMeses>=$mesesPlan){
		$flagAlerta=1;
	}
	if($diffAños>=$añosPlan){
		$flagAlerta=1;
	}
	if($flagAlerta==1){
		$flagAlerta=0;
		$asunto="Mantenimiento de vehiculo numero: ".$plan['idInterno']." - ".$plan['marca']." ".$plan['modelo'];
		
		array_push($listaMails,"g.parodi@sermico.com.ar");
		array_push($listaMails,"gabrielparodigap@gmail.com");
		
		
		$body="<h1>Servicio automatico de alertas</h1> </br>";
		$body=$body."<h2>Vehiculo numero: ".$plan['idInterno']."</h2><br>";
		$body=$body."<h2>Vehiculo: ".$plan['marca']." ".$plan['modelo']."</h2><br>";
		$body=$body."<h2>Patente: ".$plan['patente']."</h2></br>";
		
		$body=$body."Segun plan de mantenimiento: \"".$plan['titulo']."\"<br>";
	$body=$body."Realizar Mantenimiento a: <br>";
	/*
	$body=file_get_contents("bodyMail.txt");*/
	for($i=0;$i<count($lista);$i++){
		$body=$body."<li>".$lista[$i]['nombre']."- Operacion:".$lista[$i]['operacion']."<br> Descripcion: ".$lista[$i]['descripcion']."</li>";
		
	}
	//enviarMail($listaMails,$asunto,$body);
	echo $body;
	
	}
	
	
}



function executeQuery($query){
	
		
	$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$str_datos = file_get_contents("datos.json");
	$datos = json_decode($str_datos,true);
	$dbPass=$datos[$host]["Pass"];
	$user=$datos[$host]["User"];
	
	
	$link = @mysql_connect("localhost",$user,$dbPass)
		  or die ("Error al conectar a la base de datos.");
	  @mysql_select_db("control_vehiculos", $link)
		  or die ("Error al conectar a la base de datos.");
	
	  $result = mysql_query($query);
	  mysql_close($link);
	  return $result;	
	
	
}

?>