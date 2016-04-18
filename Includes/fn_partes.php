<?php
switch($_POST["tarea"]){ 

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
	   
case 'altaPartesVehiculo':
		altaPartesVehiculo();
		break;
		
case 'cargarComboBoxTiposPartes':
		cargarComboBoxTiposPartes();
		break;
case 'cargarTablaVehiculosPartes':
		cargarTablaVehiculosPartes();
		break;
		
case 'borrarParte':
		borrarParte();
		break;
		
case 'updatePartes':
		updatePartes();
		break;
		
case 'modificarPartesVehiculo':
		modificarPartesVehiculo();
		break;

//-----FIN PARTES DE VEHICULOS
}



//---------------- PARTES DE VEHICULOS---------------///


function modificarPartesVehiculo(){
	$idParte=$_POST["idParte"];
	$nombre=$_POST["nombre"];
	$kmInicial=$_POST["kmInicial"];
	$kmFinal=$_POST["kmFinal"];
	$fechaInicio=$_POST["fechaInicio"];
	$fechaFin=$_POST["fechaFin"];
	$descripcion=$_POST["descripcion"];	
	$especificaciones=$_POST["especificaciones"];
	
	$query = "CALL modificar_parte(".$idParte.",'".$nombre."','".$kmInicial."','".$kmFinal."','".$fechaInicio."','".$fechaFin."','".$descripcion."','".$especificaciones."');";
	$result = executeQuery($query);
	
	
}

function altaPartesVehiculo(){

	$padre=$_POST["padre"];
	$vehiculo=$_POST["vehiculo"];
	$nombre=$_POST["nombre"];
	$tipo=$_POST["tipo"];
	$kmInicial=$_POST["kmInicial"];
	$kmFinal=$_POST["kmFinal"];
	$fechaInicio=$_POST["fechaInicio"];
	$fechaFin=$_POST["fechaFin"];
	$descripcion=$_POST["descripcion"];	
	$especificaciones=$_POST["especificaciones"];
	
	$query = "CALL alta_partes(0,'".$padre."','".$vehiculo."','".$nombre."','".$tipo."','".$kmInicial."','".$kmFinal."','".$fechaInicio."','".$fechaFin."','".$descripcion."','".$especificaciones."',true);";
	$result = executeQuery($query);
		
}

function updatePartes(){
	$idPartes=$_POST["idPartes"];
	$fechaVencimiento=$_POST["fechaVencimiento"];
	$kmVencimiento=$_POST["kmVencimiento"];
	$query = "CALL update_partes(".$idPartes.",'".$fechaVencimiento."','".$kmVencimiento."');";
	$result = executeQuery($query);
	
	
}

function getPartes(){
	$idparte=$_POST["idparte"];
	$query = "CALL buscar_parte(".$idparte.")";
	$result = executeQuery($query);
	if($result){
		while($row = $result->fetch_assoc())
	 	 {
			$parte=array("nombre"=>$row['nombre'],"tipo"=>$row['tipo'],"kmInicial"=>$row['kmInicial'],"kmFinal"=>$row['kmFinal'],"fechaInicial"=>$row['fechaInicial'],"fechaVencimiento"=>$row['fechaProxima'],"descripcion"=>$row['descripcion'],"especificaciones"=>$row['especificaciones']);
				
	  	}
	  	echo json_encode($parte);
	  }
	  
}
	

function cargarTablaPartes(){
	
	$tipo=$_POST["atributo1"];
	$vehiculo=$_POST["atributo2"];
	  $query = "CALL listar_partes('".$vehiculo."',0,'".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	   
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
		$row["fechaProxima"] . "</td>";
		$tabla=$tabla."<td><button class=\"addParte\"><img src=\"Imagenes/add.png\" width=\"20\" height=\"20 \" /></button></td></tr>";
		
		
	  }
	  if($tabla==""){
		  $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	  }
	 echo $tabla;
		 	

	  return;	
	
}

function borrarParte(){
	$idPartes=$_POST["idPartes"];
	$query = "CALL borrar_parte(".$idPartes.")";
	if($result = executeQuery($query)){
		$row = $result->fetch_assoc();
		
		if($row["resultado"]=="OK"){
			echo "El componente fue eliminado con exito";	
		}else{
			echo "No es posible borrar este componente debido a que existen datos relacionados con el mismo. Por favor comuniquese con el administrador";
		}
		
	}else{
		echo "No es posible borrar este componente debido a que existen datos relacionados con el mismo. Por favor comuniquese con el administrador";
		
	}
	
	
}

function cargarTablaDocumentacion(){
	
		$tipo=$_POST["atributo2"];
		$vehiculo=$_POST["atributo1"];
	  $query = "CALL listar_partes('".$vehiculo."',0,'".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	  if($result){
	while($row = $result->fetch_assoc())
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

?>