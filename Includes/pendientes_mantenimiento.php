<?php
	require('mailSender.php');
	$listaplanes=array();
	$query = "call listar_planes_mantenimiento();";
	global $alertas;
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
			
			//ALERTAS
			$query = "call buscar_alertas(".$listaplanes[$i]['idplanMantenimiento'].");";
			$result = executeQuery($query);
			if(mysql_num_rows($result) != 0){
				$alertas= mysql_fetch_array($result);
			}
			
			$query = "call listar_vehiculos_por_plan(".$listaplanes[$i]['idplanMantenimiento'].");";
			$result = executeQuery($query);			
				
			if(mysql_num_rows($result) != 0){
				$j=0;
				while($row = mysql_fetch_array($result))
				  {
					 $vehiculos_por_plan[$j]=$row;
					 $j++;  
					  
				  }
				
				for($k=0;$k<count($vehiculos_por_plan);$k++){							  
					 $plan=$listaplanes[$i];
					 //comprobarLista($vehiculos_por_plan[$k],$plan,$alertas);
					comprobarPartesVehiculos($vehiculos_por_plan[$k],$alertas);
				}
				$vehiculos_por_plan=array();
			}
			
		}
		  
}
		
		  
function comprobarPartesVehiculos($vehiculoIncluido,$alertas){
		$partesPendientes=array();
        $query = "call listar_partes('".$vehiculoIncluido["idInterno"]."',0,null);";
        $result = executeQuery($query);
        $listaVencimientos=array();
		$kmAntes=$alertas["kmAntes"];
        if(mysql_num_rows($result) != 0){
        	$i=0;
            while($row = mysql_fetch_array($result))
          	{	
            	$partes[$i]=$row;
               	$i++;
                  
          	}
          for($i=0;$i<sizeof($partes);$i++){
			 
                  if($partes[$i]['fechaProxima']!=""){
                        
                        $vencimiento =DateTime::createFromFormat('d/m/Y', $partes[$i]["fechaProxima"]); 
                        $fechaActual = new DateTime('now');
                        $interval = $vencimiento->diff($fechaActual);
                        $diffDias=$interval->format('%a');
                        $diffMeses=$interval->format('%m');
                        $diasAntes=$alertas["diasAntes"];
                        $mesesAntes=$alertas["mesesAntes"];
                        $kmAntes=$alertas["kmAntes"];
                        $horasAntes=$alertas["horasAntes"];
                        //echo $vehiculoIncluido['idInterno']." - ".$partes[$i]['nombre']."->".$diffAños."->".$diffDias."->".$diffMeses."<br>";
						
                        if(isset($diasAntes)&&($diasAntes>=$diffDias)){
							$partesPendientes[]=$partes[$i];
                        }
                        if(isset($mesesAntes)&&($mesesAntes>=$diffMeses)){
							$partesPendientes[]=$partes[$i];
                        }
                       
                  }else if(isset($partes[$i]['kmFinal'])){
					  
                        $query = "call buscar_vehiculo('".$vehiculoIncluido["idInterno"]."');";
                        $result = executeQuery($query);
						$vehiculo=mysql_fetch_array($result);
						$kmActual=$vehiculo['kilometros'];
						$diffKm=$kmActual-$partes[$i]['kmFinal'];
						
						if($kmAntes>=$diffKm){
							$partesPendientes[]=$partes[$i];
						}
                          
                          
                  }
                
                
          }
          
          
          
        }
		echo json_encode ($partesPendientes);
        
}
	


function executeQuery($query){

	$host = gethostbyaddr($_SERVER['SERVER_ADDR']);	
	$str_datos = file_get_contents("datos.json",FILE_USE_INCLUDE_PATH);
	$datos = json_decode($str_datos,true);
	$dbPass=$datos[$host]["Pass"];
	$user=$datos[$host]["User"];
	$dbname="control_vehiculos";
	
	$link = @mysql_connect("localhost",$user,$dbPass)
		  or die ("Error al conectar a la base de datos.");
	  @mysql_select_db($dbname, $link)
		  or die ("Error al conectar a la base de datos");
	
	  $result = mysql_query($query);
	  mysql_close($link);
	  return $result;
	
}
	


?>