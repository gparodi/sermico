<?php
	require('mailSender.php');
	require('db.php');
	

	$listaplanes=array();
	//BUSCA TODOS LOS PLANES DE MANTENIMIENTO
	global $alertas;
	$listaPartesMail=array();
	$listaTareasMail=array();
	$listaMantenimientoProgramadoMail=array();
	alertas_mantenimientosProgramados();

function alertas_mantenimientosProgramados(){
	$query = "call listar_mantenimiento(0);";
	$result = executeQuery($query);
	$listaMantenimientos=array();
	while($row = mysql_fetch_array($result))
	  {
		   $listaMantenimientos[]=$row;
		  
	  }
	  for($i=0;$i<sizeof($listaMantenimientos);$i++){
		  $mantenimiento=$listaMantenimientos[$i];
		  //BUSCA LOS MANTENIMIENTOS PROGRAMADOS
		  if($mantenimiento["estado"]=="Programado"){
			$fechaInicio =DateTime::createFromFormat('Y-m-d', $mantenimiento["fechaInicio"]); 
        	$fechaActual = new DateTime('now');
            $interval = $fechaInicio->diff($fechaActual);
            $diffDias=$interval->format('%a');
			echo $diffDias;
			//SI FALTA 1 DIA PARA EL MANTENIMIENTO LO AVISA
			if($diffDias==0||$diffDias==1){
				//BUSCA LAS PARTES POR MANTENIMIENTO
				$query = "call buscar_partespormantenimiento(".$mantenimiento["idmantenimiento"].");";
				$result = executeQuery($query);
				if(mysql_num_rows($result)>=1){
					while($row = mysql_fetch_array($result))
					{
						$listaMantenimientoProgramadoMail[]=$row;
						echo "entro";
						echo $row['partes_idpartes'];
						$query = "call buscar_parte(".$row['partes_idpartes'].");";
						$result = executeQuery($query);
						while($row = mysql_fetch_array($result)){
							echo $row['nombre'];
							
						}
						
			  
					}
				}
				
			}
            
		  }
	  }
	  
	
}


function alertas_planMantenimiento(){
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
					if(isset($listaPartesMail)){
					  
					  enviarAlertas($vehiculos_por_plan[$k]);
				  }
				}
				$vehiculos_por_plan=array();
			}
			
		}
		  
}
}
		
		  
function comprobarPartesVehiculos($vehiculoIncluido,$alertas){
		//BUSCA TODAS LAS PARTES DE CADA VEHICULO Y COMPARA CON LAS ALERTAS DE CADA PLAN
		global $listaPartesMail;
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
						
                        if(isset($diasAntes)&&($diffDias>=$diasAntes)){
							$listaPartesMail[]=$partes[$i];						
						
                        }
                        if(isset($mesesAntes)&&($mesesAntes<=$diffMeses)){
                        }
                       
                  }else if(isset($partes[$i]['kmFinal'])){ //VERIFICA LAS PARTES QUE TENGAN KM DE VENCIMIENTO	
					if(trim($partes[$i]['kmFinal'])!=""){  
                        $query = "call buscar_vehiculo('".$vehiculoIncluido["idInterno"]."');";
                        $result = executeQuery($query);
						$vehiculo=mysql_fetch_array($result);
						$kmActual=$vehiculo['kilometros'];
						$diffKm=$kmActual-$partes[$i]['kmFinal'];
						
						if($kmAntes<=$diffKm){
							$listaPartesMail[]=$partes[$i];						
							
						} 
					}
                  }
          }
        }
}

	
function comprobarTareas($vehiculo,$plan,$alertas){
	global $listaTareasMail;
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
			for($j=0;$j<sizeof($listaTareasMail);$j++){
				
				$listaTareasMail[]=$tareas[$j];						
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
				$listaTareasMail[]=$tareas[$j];						
			}
						
      	}
       	if(isset($mesesAntes)&&($mesesAntes>=$diffMeses)){
			for($j=0;$j<sizeof($listaTareasMail);$j++){
				
				$listaTareasMail[]=$tareas[$j];						
			}
		
		}
                      
		
	}
	
	
            
	
}

function enviarAlertas($vehiculo){
	$listaMail=array();
	global $listaPartesMail;
	global $listaTareasMail;
	global $listaMantenimientoProgramadoMail;
	$tablaPartes="";
	$tablaTareas="";
	$head="<h3>Datos del vehiculo</h3>"."<p>Identificacion: <b>".$vehiculo["idInterno"]."</b></p>"."<p>Marca y modelo: <b>".$vehiculo["marca"]." - ".$vehiculo["modelo"]."</b></p>";
	if(isset($listaPartesMail)&&!empty($listaPartesMail)){
		
		$tablaPartes="<table><caption>Proximos vencimientos</caption><thead><th>Nombre</th><th>Vecimiento(km)</th><th>Vencimiento(fecha)</th></thead><tbody>";
		for($i=0;$i<count($listaPartesMail);$i++){
			$tablaPartes=$tablaPartes."<tr><td>".$listaPartesMail[$i]["nombre"]."</td><td>".$listaPartesMail[$i]["kmFinal"]."</td><td>".$listaPartesMail[$i]["fechaProxima"]."</td></tr>";
		}
		$tablaPartes=$tablaPartes."</tbody></table>";
	}
	//TAREAS
	$tablaTareas="<table><caption>Tareas de mantenimiento</caption><thead><th>Titulo</th><th>Operacion</th><th>Descrripcion</th></thead><tbody>";
	for($i=0;$i<count($listaTareasMail);$i++){
		$tablaTareas=$tablaTareas."<tr><td>".$listaTareasMail[$i]["titulo"]."</td><td>".$listaTareasMail[$i]["operacion"]."</td><td>".$listaTareasMail[$i]["descripcion"]."</td></tr>";
	}
	$tablaTareas=$tablaTareas."</tbody></table>";
	$tablas=$head.$tablaPartes.$tablaTareas;
	ob_start() ;
	include('template_mail.html');
	$content = ob_get_contents();
	ob_end_clean();
	$pos=strpos($content,"TABLA -->");
	$mail = substr_replace($content, $tablas, $pos+10, 0);
	array_push($listaMail,"g.parodi@sermico.com.ar");	
	//enviarMail($listaMail,"Mantenimiento programado - ".$vehiculo["idInterno"],$mail);
	echo $mail;
	
	
	
}




?>