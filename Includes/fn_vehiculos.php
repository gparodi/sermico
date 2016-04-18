<?php

switch($_POST["tarea"]){ 

//----------------VEHICULOS---------------///
case 'cargarTablaVehiculos': cargarTablaVehiculos();
		break;
case 'cargarComboBoxVehiculos':cargarComboBoxVehiculos();
		break;

case 'getKm':
	  getKm();
	  break;
case 'getVehiculosPorTipo':
	 getVehiculosPorTipo();
	 break;
	 
case 'actulizarKm':
	  actulizarKm();
	  break;
	  
case 'getVehiculo':
	  getVehiculo();
	  break;

case  'altaVehiculo':
	   altaVehiculo();
	   break;

case 'cargarComboBoxTipos':
		cargarComboBoxTipos();
		break;
case 'borrarVehiculo':
		borrarVehiculo();
		break;
case 'modificarVehiculo':
		modificarVehiculo();
		break;
case 'getProximoVehiculo': getProximoVehiculo();
		break;
case 'updateEstadoVehiculo':updateEstadoVehiculo();
		break;
//-----FIN VEHICULOS
}


//----------------VEHICULOS---------------///

function getProximoVehiculo(){
	$tipo=$_POST["tipo"];
	$query = "CALL get_proximo_numero('".$tipo."')";
	$result = executeQuery($query);
	if(!empty($result)){
		$row = $result->fetch_assoc();
		echo $row['proximo_vehiculo'];
	}else{
		echo "";
	}
	
}

function updateEstadoVehiculo(){
	$id=$_POST["idVehiculo"];
	$estado=$_POST["estado"];
	$query = "CALL update_estado_vehiculo(null,'".$id."','".$estado."')";
	executeQuery($query);	
	
}

//-------CARGAR TABLA VEHICULOS
function cargarTablaVehiculos(){
	
	$tipo=$_POST["atributo1"];
	  $query = "CALL listar_vehiculos('".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	   
	while($row = $result->fetch_assoc())
	  {
		$tabla=$tabla."<tr><td>" . 
			$row["idInterno"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["marca"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["modelo"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["patente"]. "</td>";
		$tabla=$tabla. "<td>" . 
			$row["año"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["tipo"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["kilometros"] . "</td>";
			if($row["estado"]=="Operativo"){
		$tabla=$tabla. "<td style=\"background-color:#00CC00\">".$row["estado"]."</td>";
			}else if($row["estado"]=="No operativo"){
		$tabla=$tabla. "<td style=\"background-color:#FF0000\">".$row["estado"]."</td>";
			}$tabla=$tabla."</tr>";
		
		
	  }
	  if($tabla==""){
		  $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	  }
	 echo $tabla;		 	

	  return;
}

function cargarTablaVehiculosPartes(){
	$tipo=$_POST["atributo1"];
	$vehiculo=$_POST["atributo2"];
	  $query = "CALL listar_partes('".$vehiculo."',0,'".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	echo $query;
	if($result){  
	while($row = $result->fetch_assoc())
	  {
		$tabla=$tabla."<tr><td>" . 
			$row["idpartes"] . "</td>";
		$tabla=$tabla. "<td>" . 
		$row["nombre"] . "</td>";
		$tabla=$tabla. "<td>" .
			$row["kmInicial"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["kmFinal"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["fechaProxima"] . "</td></tr>";
		
		
	  }
	  if($tabla==""){
		  $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	  }
	 echo $tabla;
	}
		 	

	  return;
	
	
}

//-------ALTA VEHICULOS
function altaVehiculo(){
	$tipo=$_POST["tipo"];
	$numero=$_POST["numero"];
	 $año=$_POST["año"];
	 $combustible=$_POST["combustible"];
	 $consumo=$_POST["consumo"];
	 $descripcion=$_POST["descripcion"];
	 $km=$_POST["km"];
	 $marca=$_POST["marca"];
	 $modelo=$_POST["modelo"];
	 $modeloMotor=$_POST["modeloMotor"];
	 $motor=$_POST["motor"];
	 $ot=$_POST["ot"];
	 $patente=$_POST["patente"];
	 $chasis=$_POST["chasis"];

	$query = "CALL alta_vehiculo('".$numero."','".$patente."','".$marca."','".$modelo."','".$año."',null".",'".$motor."','".$chasis."','".$modeloMotor."','".$ot."','".$tipo."','".$combustible."','".$descripcion."','".$consumo."','".$km."');";
	$result = executeQuery($query);  
	echo $query; 
	
	
	
}



function cargarComboBoxVehiculos(){
	$query = "CALL listar_vehiculos()";
	$result = executeQuery($query);
	$opciones="";
	while($row = $result->fetch_assoc())
	  {
		   $opciones.='<option value="'.$row["idInterno"].'">'.$row["idInterno"].'</option>';
		  
	  }
	  
	  echo $opciones;
	  
}
function actulizarKm(){
	$vehiculo=$_POST["vehiculo"];
	$km=$_POST["km"];
	$query = "CALL update_km('".$vehiculo."','".$km."');";
	  $result = executeQuery($query);   
	$row = $result->fetch_assoc();
	
}

function getVehiculo(){
	$idVehiculo=$_POST["idVehiculo"];
	$query = "CALL buscar_vehiculo('".$idVehiculo."')";
	$result = executeQuery($query);
	$row = $result->fetch_assoc();
	
	$numero=$row["numero"];
	$idInterno=$row["idInterno"];
	$marca=$row["marca"];
	$modelo=$row["modelo"];
	$patente=$row["patente"];
	$km=$row["kilometros"];
	$estado=$row["estado"];
	$combustible=$row["combustible"];
	$año=$row["año"];
	$tipo=$row["tipo"];
	$modeloMotor=$row["modeloMotor"];
	$descripcion=$row["descripcion"];
	$numeroDeChasis=$row["numero_de_chasis"];
	$numeroMotor=$row["motor"];
	$cobertura=$row["cobertura"];
	$consumo=$row["consumo"];
	$ot=$row["ot"];
	
	
	$vehiculo=array("numero"=>$numero,"idInterno"=>$idInterno,"marca"=>$marca,"modelo"=>$modelo,"patente"=>$patente,"km"=>$km,"estado"=>$estado,"combustible"=>$combustible,"año"=>$año,"tipo" =>$tipo, "modeloMotor"=>$modeloMotor, "descripcion"=>$descripcion, "numeroDeChasis"=>$numeroDeChasis, "numeroMotor"=>$numeroMotor, "cobertura" =>$cobertura, "consumo"=>$consumo, "ot"=>$ot);
	
	echo json_encode($vehiculo);
	
}

function modificarVehiculo(){
	$idInterno=$_POST["idInterno"];
	$numero=$_POST["numero"];
	 $año=$_POST["año"];
	 $combustible=$_POST["combustible"];
	 $consumo=$_POST["consumo"];
	 $descripcion=$_POST["descripcion"];
	 $km=$_POST["km"];
	 $marca=$_POST["marca"];
	 $modelo=$_POST["modelo"];
	 $modeloMotor=$_POST["modeloMotor"];
	 $motor=$_POST["motor"];
	 $ot=$_POST["ot"];
	 $patente=$_POST["patente"];
	 $chasis=$_POST["chasis"];

	$query = "CALL modificar_vehiculo('".$idInterno."','".$numero."','".$patente."','".$marca."','".$modelo."','".$año."',null".",'".$motor."','".$chasis."','".$modeloMotor."','".$ot."','".$combustible."','".$descripcion."','".$consumo."','".$km."');";
	$result = executeQuery($query);  
	echo $query; 
	if($row = $result->fetch_assoc()){
		echo $row["resultado"];
	}else{
		echo "Error";
	}
	
	
}

function getVehiculosPorTipo(){
	$tipo=$_POST["tipo"];
	
	$query = "CALL listar_vehiculos_por_tipo('".$tipo."');";
	$result = executeQuery($query);
	$opciones="";
	 while($row = $result->fetch_assoc())
	  {
		   $opciones.='<option value="'.$row["idInterno"].'">'.$row["idInterno"].'</option>';
		  
	  }
	  
	  echo $opciones;
		
	
}

function getKm(){
	$vehiculo=$_POST["vehiculo"];
	$query = "CALL buscar_vehiculo('".$vehiculo."')";
	$result = executeQuery($query);
	$row = $result->fetch_assoc();
	$km=$row["kilometros"];
	echo json_encode(array('km' => $km));
	//echo $query." - ".$km;
	
}

function cargarComboBoxTipos(){
	$query = "CALL listar_tipos();";
	$result = executeQuery($query);
	$opciones="";
	while($row = $result->fetch_assoc())
	  {
		   $opciones.='<option value="'.$row["tipo"].'">'.$row["tipo"].'</option>';
		  
	  }
	  
	  echo $opciones;
	  
}

function cargarComboBoxTiposPartes(){
	$query = "CALL listar_tipos_partes();";
	$result = executeQuery($query);
	$opciones="";
	while($row = $result->fetch_assoc())
	  {
		   $opciones.='<option value="'.$row["tipo"].'">'.$row["tipo"].'</option>';
		  
	  }
	  
	  echo $opciones;
	
}

function borrarVehiculo(){
	$id=$_POST["idInterno"];
	$query = "CALL borrar_vehiculo('".$id."')";	  
	if($result = executeQuery($query)){
		echo "El vehiculo fue eliminado con exito";	
		
	}else{
		echo "No es posible borrar este vehiculo debido a que existen datos relacionados con el mismo. Por favor comuniquese con el administrador";
		
	}
	
}


//-----FIN VEHICULOS


?>