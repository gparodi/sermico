



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
//-----FIN VEHICULOS
//---------------- PARTES DE VEHICULOS---------------///

case 'cargarTablaPartes':cargarTablaPartes($_POST["atributo1"],$_POST["atributo2"]);
		break;
case 'cargarTablaPartesDePartes':cargarTablaPartesDePartes($_POST["atributo1"],$_POST["atributo2"],$_POST["atributo3"]);
		break;
case 'getPartes':
		getPartes();
		break;
case  'cargarTablaDocumentacion':
	   cargarTablaDocumentacion();
	   break;
	   
case  'modificarDocumentacion':
	   modificarDocumentacion();
	   break;

//-----FIN PARTES DE VEHICULOS
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

//-----FIN MANTENIMIENTO

//---------------- VIAJES---------------///
case 'altaViaje':
		altaViaje();
		break;

//-----FIN VIAJES

//----------------PROVEEDORES---------------///

case 'cargarComboBoxProveedores':cargarComboBoxProveedores();
		break;
case 'altaProveedorSimple':
	  altaProveedorSimple();
	  break;
//-----FIN PROVEEDORES

}
		




//----------------VEHICULOS---------------///

//-------CARGAR TABLA VEHICULOS
function cargarTablaVehiculos(){
	
	
	  $query = "CALL listar_vehiculos()";
	  $result = executeQuery($query);
	   $tabla="";
	   
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>" . 
			$row["numero"] . "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["marca"] . "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["modelo"] . "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["patente"]. "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["año"] . "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["tipo"] . "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["kilometros"] . "</font></td>";
		$tabla=$tabla. "<td>" . 
			$row["estado"] . "</font></td></tr>";
		
		
	  }
	 echo $tabla;		 	

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

	$query = "CALL alta_vehiculo('".$numero."','".$patente."','".$marca."','".$modelo."','".$año."',null".",'".$motor."','".$chasis."','".$modeloMotor."','".$ot."','".$tipo."');";
	echo $query;
	$result = executeQuery($query);   
	//$row = mysql_fetch_array($result);
	
	
}

function cargarComboBoxVehiculos(){
	$query = "CALL listar_vehiculos()";
	$result = executeQuery($query);
	$opciones="";
	while($row = mysql_fetch_array($result))
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
	$row = mysql_fetch_array($result);
	
}

function getVehiculo(){
	$idVehiculo=$_POST["idVehiculo"];
	$query = "CALL buscar_vehiculo('".$idVehiculo."')";
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);
	
	$numero=$row["numero"];
	$idInterno=$row["idInterno"];
	$marca=$row["marca"];
	$modelo=$row["modelo"];
	$patente=$row["patente"];
	$km=$row["kilometros"];
	$estado=$row["estado"];
	$combustible=$row["combustible"];
	$año=$row["año"];
	$cobertura=$row["cobertura"];
	$ot=$row["ot"];
	$consumo=$row["consumo"];
	
	$vehiculo=array("numero"=>$numero,"idInterno"=>$idInterno,"marca"=>$marca,"modelo"=>$modelo,"patente"=>$patente,"km"=>$km,"estado"=>$estado,"combustible"=>$combustible,"año"=>$año,"cobertura"=>$cobertura,"ot"=>$ot,"consumo"=>$consumo);
	
	echo json_encode($vehiculo);
	
}

function getVehiculosPorTipo(){
	$tipo=$_POST["tipo"];
	
	$query = "CALL listar_vehiculos_por_tipo('".$tipo."');";
	$result = executeQuery($query);
	$opciones="";
	 while($row = mysql_fetch_array($result))
	  {
		   $opciones.='<option value="'.$row["idInterno"].'">'.$row["idInterno"].'</option>';
		  
	  }
	  
	  echo $opciones;
		
	
}

function getKm(){
	$vehiculo=$_POST["vehiculo"];
	$query = "CALL buscar_vehiculo('".$vehiculo."')";
	  $result = executeQuery($query);
	   
	   
	$row = mysql_fetch_array($result);
	$km=$row["kilometros"];
	echo json_encode(array('km' => $km));
	//echo $query." - ".$km;
	
}

function cargarComboBoxTipos(){
	$query = "CALL listar_tipos();";
	$result = executeQuery($query);
	$opciones="";
	while($row = mysql_fetch_array($result))
	  {
		   $opciones.='<option value="'.$row["tipo"].'">'.$row["tipo"].'</option>';
		  
	  }
	  
	  echo $opciones;
	  
}

//-----FIN VEHICULOS




//---------------- PARTES DE VEHICULOS---------------///

function cargarTablaPartes($vehiculo,$tipo){
	
	
	  $query = "CALL listar_partes('".$vehiculo."',0,'".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	  echo $query;
	  if(mysql_num_rows($result) != 0){
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>". 
			$row["idpartes"] . "</td><td>".$row["nombre"]."</td>";
			$tabla=$tabla."<td><button class=\"addParte\">Agregar Parte</button></td>";
			$tabla=$tabla."</tr>";
				
	  }
	  }else{
		echo $query;
	  }
	  
	 echo $tabla;

	  return;
}



function cargarTablaDocumentacion(){
	
		$tipo=$_POST["atributo2"];
		$vehiculo=$_POST["atributo1"];
	  $query = "CALL listar_partes('".$vehiculo."',0,'".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	  echo $query;
	  if(mysql_num_rows($result) != 0){
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>". 
			$row["idpartes"] . "</td><td>".$row["nombre"]."</td><td>".$row["fechaInicial"]."</td><td>".$row["fechaProxima"]."</td><td>".$row["descripcion"]."</td>";
			$tabla=$tabla."</tr>";
				
	  }
	  }else{
		echo $query;
	  }
	  
	 echo $tabla;

	  return;
}


function cargarTablaPartesDePartes($vehiculo,$tipo,$parte){
	
	
	  $query = "CALL listar_partes_de_partes(".$vehiculo.",".$parte.",".$tipo.")";
	  
	  $result = executeQuery($query);
	   $tabla= "";	
	 if(!empty($result)){
		while($row = mysql_fetch_array($result))
		  {
			$tabla=$tabla."<tr><td>". 
			$row["idpartes"] . "</td><td>".$row["nombre"]."</td>";
				$tabla=$tabla."<td><button class=\"addParte\">Añadir Parte</button></td>";
				$tabla=$tabla."</tr>";	
					
		  }
	 	//echo $query;
	 echo $tabla;
	   }
	//echo $query;
	  return;
}

function modificarDocumentacion(){
	$idParte=$_POST["idParte"];
	$fechaInicial=$_POST["fechaInicial"];
	$fechaVencimiento=$_POST["fechaVencimiento"];
	$nombre=$_POST["nombre"];
	$descripcion=$_POST["descripcion"];
	$query = "CALL update_documentacion(".$idParte.",'".$nombre."','".$fechaInicial."','".$fechaVencimiento."','".$descripcion."')";
	$result = executeQuery($query);
	echo $result[0];
	
}

//-----FIN PARTES DE VEHICULOS



//---------------- MANTENIMIENTO---------------///

//-------CARGAR TABLA MANTENIMENTO
function cargarTablaMantenimiento($vehiculo){
	
	
	  $query = "CALL listar_mantenimiento('".$vehiculo."')";
	  $result = executeQuery($query);
	   $tabla="";	
	  
	   if(mysql_num_rows($result)){
	   
			while($row = mysql_fetch_array($result))
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
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL listar_partes_por_mantenimiento('".$idMantenimiento."')";
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);
	$partes=array();
	 while($row = mysql_fetch_array($result))
	{
		$nombre=$row["nombre"];
			$idPartes=$row["idpartes"];
			$partesIdPartes=$row["partes_idpartes"];  
			
			$tipo=$row["tipo"];		
			
			$parte=array("idPartes"=>$idPartes,"partesIdPartes"=>$partesIdPartes,"vehiculo"=>$vehiculo,"nombre"=>$nombre,"tipo"=>$tipo,"kmInicial"=>$kmInicial,"kmFinal"=>$kmFinal,"fechaInicial"=>$fechaInicial,"fechaVencimiento"=>$fechaProxima,"descripcion"=>$descripcion,"especificaciones"=>$especificaciones);
			$partes[]=$parte;
	}
		
		  
	
	
	echo json_encode($partes);	
	
		
	
}

function getMantenimiento(){
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL buscar_mantenimiento('".$idMantenimiento."')";
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);
	
	
	$nombre=$row["nombre"];
	$fechaInicio=$row["fechaInicio"];
	$fechaFin=$row["fechaFin"];

	$km=$row["km"];
	$precio=$row["precio"];
	$estado=$row["estado"];
	$titulo=$row["titulo"];
	$horas=$row["horas"];
	$descripcion=$row["descripcion"];
	
	$mantenimiento=array("proveedor"=>$nombre,"fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin,"km"=>$km,"precio"=>$precio,"estado"=>$estado,"titulo"=>$titulo,"horas"=>$horas,"descripcion"=>$descripcion);
	
	echo json_encode($mantenimiento);	
	
}

function altaMantenimiento(){
	
	
	 
	  $titulo=$_POST["titulo"];
	  $proveedor=$_POST["proveedor"];
	  $km=$_POST["km"];
	  $fechaInicio1=$_POST["fechaInicio"];
	  $fechaInicio=date("d/m/Y",strtotime($fechaInicio1));
	  $fechaFin1=$_POST["fechaFin"];
	  $fechaFin=date("d/m/Y",strtotime($fechaFin1));
	  $precio=$_POST["precio"];
	  $estado=$_POST["estado"];
	  $vehiculo=$_POST["vehiculo"];
	  $descripcion=$_POST["descripcion"];
	
	 $query = "CALL alta_mantenimiento('".$proveedor."','".$fechaInicio."','".$fechaFin."','".$km."','".$precio."','".$estado."','".$titulo."','".$descripcion."');";
	$result = executeQuery($query);
	 $row = mysql_fetch_array($result);	 
	 $nuevoId=$row["idMantenimiento"];
	 
	
		
	echo json_encode(array('id' => $nuevoId)); 
	

	  return;
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
	 //$row = mysql_fetch_array($result);	 
	 //$nuevoId=$row["result"];
	 
	
		
	//echo json_encode(array('id' => $nuevoId)); 
	

	  return;
}


//-----FIN MANTENIMIENTO



//---------------- VIAJES---------------///

function altaViaje(){
	echo $_POST["titulo"];	
	
}

//-----FIN VIAJES



//----------------PROVEEDORES---------------///
function cargarComboBoxProveedores(){
	$query = "call listar_proveedores();";
	$result = executeQuery($query);	
	$opciones="";
	while($row = mysql_fetch_array($result))
	  {
		   $opciones.='<option value="'.$row["nombre"].'">';
		  
	  }
	  mysql_free_result($result);
	  echo $opciones;
	
	
}

function altaProveedorSimple(){
	
	  $proveedor=$_POST["nombre"];
	 
	
	 $query = "CALL alta_proveedor_simple('".$proveedor."');";
	$result = executeQuery($query);
	 $row = mysql_fetch_array($result);	 
	 $resultado=$row["mensaje"];
	 	
		
	//echo json_encode(array('id' => $nuevoId)); 
	

	  return;
	
}

//-----FIN PROVEEDORES



function executeQuery($query){
	
		
	$host = gethostbyaddr($_SERVER['SERVER_ADDR']);
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

