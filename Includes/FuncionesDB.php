



<?php

switch($_POST["tarea"]){ 
case 'cargarTablaVehiculos': cargarTablaVehiculos();
		break;
case 'cargarComboBoxVehiculos':cargarComboBoxVehiculos();
		break;
case 'cargarComboBoxProveedores':cargarComboBoxProveedores();
		break;
case 'cargarTablaPartes':cargarTablaPartes($_POST["atributo1"],$_POST["atributo2"]);
		break;
case 'cargarTablaPartesDePartes':cargarTablaPartesDePartes($_POST["atributo1"],$_POST["atributo2"],$_POST["atributo3"]);
		break;
case 'cargarTablaMantenimiento':cargarTablaMantenimiento($_POST["atributo1"]);
		break;

case 'altaMantenimiento':
		altaMantenimiento();
		break;
		
case 'altaPartesMantenimiento':
		altaPartesMantenimiento();
		break;
		
case 'cargarComboBoxTipos':
		cargarComboBoxTipos();
		break;
		
case 'altaProveedorSimple':
	  altaProveedorSimple();
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
	  
case 'altaViaje':
		altaViaje();
		break;
		
}



function cargarTablaVehiculos(){
	
	
	  $query = "CALL listar_vehiculos()";
	  $result = executeQuery($query);
	   echo "<table id=\"tabla_vehiculo\"><tr>
	<th>Numero</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Patente</th>
	<th>Año</th>
	<th>Tipo</th>
	<th>Kilometros</th>
	<th>Estado</th>
	</tr>";	
	   
	while($row = mysql_fetch_array($result))
	  {
		echo "<tr><td>" . 
			$row["numero"] . "</font></td>";
		echo "<td>" . 
			$row["marca"] . "</font></td>";
		echo "<td>" . 
			$row["modelo"] . "</font></td>";
		echo "<td>" . 
			$row["patente"]. "</font></td>";
		echo "<td>" . 
			$row["año"] . "</font></td>";
		echo "<td>" . 
			$row["tipo"] . "</font></td>";
		echo "<td>" . 
			$row["kilometros"] . "</font></td>";
		echo "<td>" . 
			$row["estado"] . "</font></td></tr>";
		
		
	  }
	 	
	  echo "</table>";
	 	

	  return;
}

function cargarTablaMantenimiento($vehiculo){
	
	
	  $query = "CALL listar_mantenimiento('".$vehiculo."')";
	  $result = executeQuery($query);
	   $tabla= "<table id=\"tablaMantenimiento\"><tr>
	<td>ID</td><td>Titulo</td><td>Proveedor</td><td>KM</td><td>Fecha de Inicio</td><td>Fecha de Fin</td><td>Horas</td><td>Precio($)</td><td>Estado</td>
	</tr>";	
	   
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
	 	
	  $tabla=$tabla."</table>";
	 echo $tabla;

	  return;
}

function cargarTablaPartes($vehiculo,$tipo){
	
	
	  $query = "CALL listar_partes('".$vehiculo."','".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	   
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>". 
			$row["idpartes"] . "</td><td>".$row["nombre"]."</td>";
			$tabla=$tabla."<td><button class=\"addParte\">Agregar Parte</button></td>";
			$tabla=$tabla."</tr>";
				
	  }
	 	
	  
	 echo $tabla;

	  return;
}

function cargarTablaPartesDePartes($vehiculo,$tipo,$parte){
	
	
	  $query = "CALL listar_partes_de_partes(".$vehiculo.",'".$tipo."','".$parte."')";
	  
	  $result = executeQuery($query);
	   $tabla= "";	
	   
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>". 
		$row["idPartes"] . "</td><td>".$row["nombre"]."</td>";
			$tabla=$tabla."<td><button class=\"addParte\">Añadir Parte</button></td>";
			$tabla=$tabla."</tr>";	
				
	  }
	 	
	 echo $tabla;

	  return;
}

function cargarComboBoxVehiculos(){
	$query = "CALL listar_vehiculos()";
	$result = executeQuery($query);
	while($row = mysql_fetch_array($result))
	  {
		   $opciones.='<option value="'.$row["idInterno"].'">'.$row["idInterno"].'</option>';
		  
	  }
	  
	  echo $opciones;
	  
}
function altaViaje(){
	echo $_POST["titulo"];	
	
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
	$query = "CALL listar_tipos()";
	$result = executeQuery($query);
	while($row = mysql_fetch_array($result))
	  {
		   $opciones.='<option value="'.$row["tipo"].'">'.$row["tipo"].'</option>';
		  
	  }
	  
	  echo $opciones;
	  
}

function cargarComboBoxProveedores(){
	$query = "call listar_proveedores();";
	$result = executeQuery($query);	
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
	
	 $query = "CALL alta_mantenimiento('".$proveedor."','".$fechaInicio."','".$fechaFin."','".$km."','".$precio."','".$estado."','".$titulo."');";
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




function executeQuery($query){
	
	//mysql_data_seek($result, 0);
	//mysql_free_result ($result);
	$link = @mysql_connect("localhost", "root","1234")
		  or die ("Error al conectar a la base de datos.");
	  @mysql_select_db("control_vehiculos", $link)
		  or die ("Error al conectar a la base de datos.");
	
	  $result = mysql_query($query);
	  mysql_close($link);
	  return $result;	
	
	
}



?>

