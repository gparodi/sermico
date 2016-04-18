<?php
switch($_POST["tarea"]){ 

//---------------- MANTENIMIENTO---------------///

case 'cargarTablaMantenimiento':cargarTablaMantenimiento($_POST["atributo1"]);
		break;

case 'altaMantenimiento':
		altaMantenimiento();
		break;
		
case 'altaPartesMantenimiento':
		altaPartesMantenimiento();
		break;
		
case 'getPartesPorMantenimiento':
		getPartesPorMantenimiento();
		break;

case 'getMantenimiento':
		getMantenimiento();
		break;
		
case 'getMantenimientoProgramado':
		getMantenimientoProgramado();
		break;
case 'borrar_mantenimiento':
		borrar_mantenimiento();
		break;
case 	'ejecutar_mantenimientoProgramado':
		ejecutar_mantenimientoProgramado();
		break;

//-----FIN MANTENIMIENTO
}



//---------------- MANTENIMIENTO---------------///
function borrar_mantenimiento(){
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL borrar_mantenimiento(".$idMantenimiento.");";
	$result = executeQuery($query);
	echo $query;
	echo "OK";
}



//-------CARGAR TABLA MANTENIMENTO
function cargarTablaMantenimiento($vehiculo){
	
	
	  
	  $query = "CALL listar_mantenimiento('101')";
	  $result = executeQuery($query);
	   $tabla="";	
	  
	   if($result->fetch_assoc()){
	   
			while($row = $result->fetch_assoc())
			  {
				$tabla=$tabla."<tr><td>". 
					$row["idmantenimiento"] . "</td><td>".
					$row["titulo"] . "</td><td>".
					$row["nombre"] . "</td><td>".
					$row["km"] . "</td><td>". 
					$row["fechaInicio"] . "</td><td>".
					$row["fechaFin"] . "</td><td>".
					$row["horas"] . "</td><td>".
					$row["precio"] . "</td><td>". 
					$row["estado"] . "</td>";
					$tabla=$tabla."	</tr>";		  
			  }
	   }else{
		    $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	   }
	 	
	 echo $tabla;

	  return;
}

function getPartesPorMantenimiento(){
	$partes=array();
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL listar_partes_por_mantenimiento('".$idMantenimiento."')";
	$result = executeQuery($query);
	if($result){
	$partes["operacion"]="OK";
	while($row = $result->fetch_assoc())
		{	
				$nombre=$row["nombre"];
				$idPartes=$row["idpartes"];
				$partesIdPartes=$row["partes_idpartes"];			
				$tipo=$row["tipo"];
				$descripcion=$row["descripcion"];	
				$operacion=$row["operacion"];	
				$observaciones=$row["observaciones"];
				
				$parte=array("idPartes"=>$idPartes,"partesIdPartes"=>$partesIdPartes,"nombre"=>$nombre,"tipo"=>$tipo,"operacion"=>$operacion,"descripcion"=>$descripcion,"observaciones"=>$observaciones);
				$partes[]=$parte;
				
		}		
		if($nombre!="-"){			
			echo json_encode($partes);
		}else{
			$respuesta=array("operacion"=>"NOK");
			echo json_encode($respuesta);
		}
		//echo json_encode($parte);
	}else{
		$respuesta=array("operacion"=>"NOK");
		echo json_encode($respuesta);
	}
	
		
	
}

function ejecutar_mantenimientoProgramado(){
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL buscar_mantenimiento(".$idMantenimiento.",null,null);";
	$result = executeQuery($query);
	$mantenimiento=array();	
	$partesMantenimiento=array();
	if($result){
		while($row = $result->fetch_assoc()){
			$mantenimiento=$row;			
		}
		$query = "CALL listar_partes_por_mantenimiento(".$mantenimiento["idmantenimiento"].");";
		$result = executeQuery($query);
		if($result){
			while($partesPorMantenimiento = $result->fetch_assoc()){
				$query = "CALL buscar_parte(".$partesPorMantenimiento["idpartes"].");";
				$resultPartes=executeQuery($query);
				$parte = mysql_fetch_array($resultPartes);
				if(isset($parte["kmFinal"])&&($partesPorMantenimiento["operacion"]=="Cambio")){
					$query2 = "CALL buscar_vehiculo(".$parte["idInterno"].");";
					$resultVehiculos=executeQuery($query2);
					$resultVehiculos=mysql_fetch_array($resultVehiculos);
					$query3 = "CALL update_partes(".$parte["idpartes"].",null,".$resultVehiculos["kilometros"].");";				executeQuery($query2);
					echo $query3;
					
				}
			}
		
		}
	}
	
		
	
}


function getMantenimientoProgramado(){
	$idVehiculo=$_POST["idVehiculo"];
	$query = "CALL buscar_mantenimiento(0,".$idVehiculo.",'Programado');";
	$result = executeQuery($query);
	$listaTareas=array();
	$lista="";
	
	if($result){
		while($row = $result->fetch_assoc()){
			$listaMantenimientos[]=$row;			
		}
		
		for($i=0;$i<sizeof($listaMantenimientos);$i++){
			$lista=$lista."<div id=\"".$listaMantenimientos[$i]["idmantenimiento"]."\"<label>ID:".$listaMantenimientos[$i]["idmantenimiento"]."</label> - <label>Titulo:".$listaMantenimientos[$i]['titulo']."</label><button id=\"btn_ejecutar_mp\">Ejecutar</button><button id=\"btn_borrar_mp\">Borrar</button><ul>Tareas:";
			$query = "CALL listar_partes_por_mantenimiento(".$listaMantenimientos[$i]["idmantenimiento"].");";
			$result = executeQuery($query);
			if($result){
				while($row = $result->fetch_assoc()){
					$lista=$lista."<li><label>".$row["nombre"].": ".$row["operacion"]."</li>";			
				}
				$lista=$lista."</ul></div>";
			}
			
			
			
		}
		
		echo $lista;
	}else{
		echo json_encode(array("resultado"=>'FALSE'));
	
	}
}


function getMantenimiento(){
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL buscar_mantenimiento('".$idMantenimiento."',null,null)";
	$result = executeQuery($query);
	$row = $result->fetch_assoc();
	
	$proveedor=$row["proveedor"];
	$fechaInicio=$row["fechaInicio"];
	$fechaFin=$row["fechaFin"];

	$km=$row["km"];
	$precio=$row["precio"];
	$estado=$row["estado"];
	$titulo=$row["titulo"];
	$horas=$row["horas"];
	$descripcion=$row["descripcion"];
	
	$mantenimiento=array("proveedor"=>$proveedor,"fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin,"km"=>$km,"precio"=>$precio,"estado"=>$estado,"titulo"=>$titulo,"horas"=>$horas,"descripcion"=>$descripcion);
	
	echo json_encode($mantenimiento);	
	
}

function altaMantenimiento(){
	
	$mantenimiento=$_POST['nuevoMantenimiento'];
	
	
	$proveedor=$mantenimiento[0]['proveedor'];
	$fechaInicio=$mantenimiento[0]['fechaInicio'];
	$fechaFin=$mantenimiento[0]['fechaFin'];
	$km=$mantenimiento[0]['km'];
	$precio=$mantenimiento[0]['precio'];
	$estado=$mantenimiento[0]['estado'];
	$titulo=$mantenimiento[0]['titulo'];
	$descripcion=$mantenimiento[0]['descripcion'];
	
	 $query = "CALL alta_mantenimiento('".$proveedor."','".$fechaInicio."','".$fechaFin."','".$km."','".$precio."','".$estado."','".$titulo."','".$descripcion."');";
	$result = executeQuery($query);
	echo $query;
	if($result){
		$row = $result->fetch_assoc();	 
		$idMantenimiento=$row["idMantenimiento"];
		echo $idMantenimiento;
	 
		if (isset($_POST['partes'])){
			$partes=$_POST['partes'];
			for($i=0;$i<sizeof($partes);$i++){
				$query = "CALL alta_partespormantenimiento(".$idMantenimiento.",'".$partes[$i]['idPartes']."','".$partes[$i]['descripcion']."','".$partes[$i]['observaciones']."','".$partes[$i]['operacion']."');";
				$result = executeQuery($query);
				echo $query;	
				
				
			}
			
			
			//HAGO LOS CAMBIOS DE ESTADO EN LOS VEHICULOS	
				$query="call buscar_parte(".$partes[0]["idPartes"].");";
				$result = executeQuery($query);
				$row = $result->fetch_assoc();
				if($mantenimiento[0]['estado']=="Programado"||$mantenimiento[0]['estado']=="En curso"){
					$query="call update_estado_vehiculo(null,'".$row["idInterno"]."','No operativo');";
					$result = executeQuery($query);		
					
				}
					
		}
	}
	

}

function altaPartesMantenimiento(){
	
	
	 
	  $idMantenimiento=$_POST["idMantenimiento"];
	  $idPartes=$_POST["idPartes"];
	  $descripcion=$_POST["descripcion"];
	  $observaciones=$_POST["observaciones"];
	  $operacion=$_POST["operacion"];
	  $vehiculo=$_POST["vehiculo"];
	  
	 $query = "CALL alta_partespormantenimiento(".$idMantenimiento.",".$vehiculo.",'".$idPartes."','".$descripcion."','".$observaciones."','".$operacion."');";
	$result = executeQuery($query);
	echo $query;
	 //$row = $result->fetch_assoc();	 
	 //$nuevoId=$row["result"];
	 
	
		
	//echo json_encode(array('id' => $nuevoId)); 
	

	  return;
}


//-----FIN MANTENIMIENTO

?>