<?php
	require ("db.php");
	$listaplanes=array();
	//BUSCA TODOS LOS PLANES DE MANTENIMIENTO
	$query = "call listar_planes_mantenimiento();";
	global $alertas;
	$listaPartes=array();
	$listaTareas=array();
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
			
			//POR CADA PLAN DE MANTENIMIENTO BUSCA LAS ALERTAS CORRESPONDIENTES
			$query = "call buscar_alertas(".$listaplanes[$i]['idplanMantenimiento'].");";
			$result = executeQuery($query);
			if(mysql_num_rows($result) != 0){
				$alertas= mysql_fetch_array($result);
			}
			// POR CADA PLAN DE MANTENIMIENTO BUSCA LOS VEHICULOS INCLUIDOS EN CADA PLAN
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
					
					 //POR CADA VEHICULOS BUSCA LAS PARTES QUE ESTAN VENCIDAS
					comprobarTareas($vehiculos_por_plan[$k],$listaplanes[$i],$alertas);
					comprobarPartesVehiculos($vehiculos_por_plan[$k],$alertas);
					
				}
				$vehiculos_por_plan=array();
			}
			
		}
		  
}
		
		  
function comprobarPartesVehiculos($vehiculoIncluido,$alertas){
		//BUSCA TODAS LAS PARTES DE CADA VEHICULO Y COMPARA CON LAS ALERTAS DE CADA PLAN
		global $listaPartes;
        $query = "call listar_partes('".$vehiculoIncluido["idInterno"]."',0,null);";
        $result = executeQuery($query);
		$kmAntes=$alertas["kmAntes"];
        if(mysql_num_rows($result) != 0){
        	$i=0;
            while($row = mysql_fetch_array($result))
          	{	
            	$partes[$i]=$row;
               	$i++;
                  
          	}
          for($i=0;$i<sizeof($partes);$i++){
			 
			  	//VERIFICA LAS PARTES QUE TENGAN FECHA DE VENCIMIENTO
                  if(trim($partes[$i]['fechaProxima'])!=""){
                        
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
						
                        if(isset($diasAntes)&&($diasAntes<=$diffDias)){
							$listaPartes[]=$partes[$i];						
						
                        }
                        if(isset($mesesAntes)&&($mesesAntes<=$diffMeses)){
							$listaPartes[]=$partes[$i];
                        }
                       
                  }else if(trim($partes[$i]['kmFinal'])!=""){ //VERIFICA LAS PARTES QUE TENGAN KM DE VENCIMIENTO
					  
                        $query = "call buscar_vehiculo('".$vehiculoIncluido["idInterno"]."');";
                        $result = executeQuery($query);
						$vehiculo=mysql_fetch_array($result);
						$kmActual=$vehiculo['kilometros'];
						$diffKm=$kmActual-$partes[$i]['kmFinal'];
						
						if($kmAntes<=$diffKm){
							$listaPartes[]=$partes[$i];						
							
						} 
                  }
          }
        }
}

	
function comprobarTareas($vehiculo,$plan,$alertas){
	global $listaTareas;
	// CARGA LAS TAREAS POR PLAN DE MANTENIMIENTO 
	$query = "call listar_tareas_por_planmantenimiento(".$plan["idplanMantenimiento"].");";
  	$result = executeQuery($query);
    if(mysql_num_rows($result) != 0){
	    while($row = mysql_fetch_array($result))
      	{	
        	$tareas[]=$row;
		}
	}
	//VERIFICA CADA PUNTO

	if(isset($vehiculo['ultimoKm'])){
		
		if(intval($vehiculo['kmActual'])>=(intval($vehiculo['ultimoKm'])+intval($plan['km']))){
			for($j=0;$j<sizeof($listaTareas);$j++){
				
				$listaTareas[]=$tareas[$j];						
			}
		}
		
	}if(!is_null($vehiculo['ultimoVencimiento'])){
		$fechaActual = new DateTime('now');
		$vencimiento =DateTime::createFromFormat('Y-m-d', $vehiculo["ultimoVencimiento"]);
		$interval = $vencimiento->diff($fechaActual);
		$diffDias=$interval->format('%a');
      	$diffMeses=$interval->format('%m');
      	$diasAntes=$alertas["diasAntes"]                 ;
        $mesesAntes=$alertas["mesesAntes"];
		if(isset($diasAntes)&&($diffDias>=$diasAntes)){
			for($j=0;$j<sizeof($tareas);$j++){
				$listaTareas[]=$tareas[$j];						
			}
						
      	}
       	if(isset($mesesAntes)&&($mesesAntes>=$diffMeses)){
			for($j=0;$j<sizeof($listaTareas);$j++){
				
				$listaTareas[]=$tareas[$j];						
			}
		
		}
                      
		
	}
	
	
            
	
}



?>