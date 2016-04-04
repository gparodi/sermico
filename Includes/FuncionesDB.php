



<?php

require ('db.php');
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

//----------------PLAN DE MANTENIMIENTO---------------///

case 'listarPlanDeMantenimiento':listarPlanDeMantenimiento();
		break;
case 'getPlanDeMantenimiento': getPlanDeMantenimiento();
	  break;
case 'listarVehiculosPorPlanDeMantenimiento':listarVehiculosPorPlanDeMantenimiento();
		break;
case 'listar_tareas_por_planmantenimiento':listar_tareas_por_planmantenimiento();
		break;
		
case 'altaTarea':altaTarea();
		break;
		
case 'setVehiculoEnPlanMantenimiento':setVehiculoEnPlanMantenimiento();
		break;
case 'borrarTarea':borrarTarea();
		break;
case 'altaPlanMantenimiento': altaPlanMantenimiento();
		break;


//-----PLAN DE MANTENIMIENTO

//----------------ALERTAS---------------///
case 'cargarTablaAlertasMail':cargarTablaAlertasMail();
		break;
case 'getAlertas':getAlertas();
		break;

//-----ALERTAS

}
		
//----------------ALERTAS---------------///

function cargarTablaAlertasMail(){
	$idAlertas=$_POST["atributo1"];
	$query = "CALL listar_alertas_mails(".$idAlertas.");";
	$result = executeQuery($query);
	if(mysql_num_rows($result) != 0){
		$row = mysql_fetch_array($result);
		$dato=$row["mails"];
		$mails=explode(",",$dato);
		$tabla="";	
		for($i=0;$i<sizeof($mails);$i++){
			$tabla=$tabla."<tr><td>".$mails[$i]."</td></tr>";		
		}
	}else{
		$tabla="<tr><td>No hay informacion para mostrar</td></tr>";
	}
	echo $tabla;
	
	return;
}

function getAlertas(){
	$idPlanMantenimiento=$_POST["idPlanMantenimiento"];
	$query = "CALL listar_alertas_mails(".$idPlanMantenimiento.");";
	$result = executeQuery($query);
	if(mysql_num_rows($result) != 0){
		$row = mysql_fetch_array($result);
		$kmAntes=$row["kmAntes"];
		$horasAntes=$row["horasAntes"];
		$diasAntes=$row["diasAntes"];
		$mesesAntes=$row["mesesAntes"];
		
		$alertas=array("kmAntes"=>$kmAntes, "horasAntes"=>$horasAntes, "diasAntes"=>$diasAntes, "mesesAntes"=>$mesesAntes);
		echo json_encode($alertas);
	
		
	}else{
		$alertas=array("kmAntes"=>"", "horasAntes"=>"", "diasAntes"=>"", "mesesAntes"=>"");
		echo json_encode($alertas);
	}
	
	return;
	
}

		
//----------------PLAN DE MANTENIMIENTO---------------///




function altaPlanMantenimiento(){

	$titulo=$_POST["titulo"];
	$km=$_POST["km"];
	$horas=$_POST["horas"];
	$dias=$_POST["dias"];
	$meses=$_POST["meses"];
	$años=$_POST["años"];
	$descripcion=$_POST["descripcion"];
	$ultimoVencimiento=$_POST["ultimoVencimiento"];
	$estado=$_POST["estado"];
	

	$query = "CALL alta_plamantenimiento('".$numero."','".$patente."','".$marca."','".$modelo."','".$año."',null".",'".$motor."','".$chasis."','".$modeloMotor."','".$ot."','".$tipo."','".$combustible."','".$descripcion."','".$consumo."','".$km."');";
	$result = executeQuery($query);  
	echo $query; 
	if($row = mysql_fetch_array($result)){
		echo $row["resultado"];
	}else{
		echo "Error";
	}
	
	
}

function borrarTarea(){
	$array_baja=array();
	$array_nop=array();
	$index=$_POST["index"];
	$idplan=$_POST["planmantenimiento"];
	
	$query = "CALL listar_tareas_por_planmantenimiento('".$idplan."')";
	$result = executeQuery($query);
	  
	while($row = mysql_fetch_array($result))
	  {
		$idTarea=$row["idtareas"];
		$estado="NOK";
		for($i=0;$i<$index;$i++){
			$datos=$_POST[$i];
			if($datos["ID"]==$idTarea){
				$estado="OK";	
			}
		}
		if($estado=="NOK"){
			array_push($array_baja,$idTarea);		
		}
		
		
	  }
	
	if(isset($array_baja)){
		for($i=0;$i<sizeof($array_baja);$i++){
			$idTarea=$array_baja[$i];
			$query = "CALL borrar_tarea(".$idTarea.");";
			$result = executeQuery($query);
		}
	}
	
}

function altaTarea(){
	
	$idPlanMantenimiento=$_POST["idPlanMantenimiento"];
	$titulo=$_POST["titulo"];
	$operacion=$_POST["operacion"];
	$descripcion=$_POST["descripcion"];
	$query = "CALL alta_tarea(".$idPlanMantenimiento.",'".$titulo."','".$operacion."','".$descripcion."');";
	$result = executeQuery($query);  
	if($row = mysql_fetch_array($result)){
		echo $row["resultado"];
	}else{
		echo "Error";
	}
	
	
}

	


function listarPlanDeMantenimiento(){
	$query = "CALL listar_planes_mantenimiento()";
	  $result = executeQuery($query);
	  $tabla="";
	
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>". 
			$row["idplanMantenimiento"]."</td>".
			"<td>".$row["titulo"]."</td>".
			"<td>".$row["km"]."</td>".
			"<td>".$row["horas"]."</td>".
			"<td>".$row["dias"]."</td>".
			"<td>".$row["meses"]."</td>".
			"<td>".$row["años"]."</td>".
			"<td>".$row["descripcion"]."</td>".
			"<td>".$row["estado"]."</td>";
			$tabla=$tabla."</tr>";
				
	  }	
	
	if($tabla==""){
		  $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	  }
	  
	 echo $tabla;

	  return;
	
}

function getPlanDeMantenimiento(){
	$idPlan=$_POST["idPlanMantenimiento"];
	$query = "CALL buscar_planmantenimiento('".$idPlan."')";
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);	
	$idPlanMantenimiento=$row["idplanMantenimiento"];
	$titulo=$row["titulo"];
	$km=$row["km"];
	$horas=$row["horas"];
	$dias=$row["dias"];
	$meses=$row["meses"];
	$años=$row["años"];
	$descripcion=$row["descripcion"];
	$estado=$row["estado"];
	
	$planMantenimiento=array("idPlanMantenimiento"=>$idPlanMantenimiento, "titulo"=>$titulo, "km"=>$km, "horas"=>$horas, "dias"=>$dias, "meses"=>$meses, "años"=>$años, "descripcion"=>$descripcion, "estado"=>$estado);
	
	echo json_encode($planMantenimiento);
	
}

function listarVehiculosPorPlanDeMantenimiento(){
	$tipo=$_POST["atributo1"];
	  $query = "CALL listar_vehiculos_por_plan('".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	   
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>" . 
			$row["idInterno"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["marca"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["modelo"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["año"] . "</td>"."</tr>";
		
		
	  }
	  if($tabla==""){
		  $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	  }
	 echo $tabla;		 	

	  return;
	
}

function listar_tareas_por_planmantenimiento(){
	
	$idPlan=$_POST["atributo1"];
	  $query = "CALL listar_tareas_por_planmantenimiento('".$idPlan."')";
	  $result = executeQuery($query);
	  $tabla="";
	   
	while($row = mysql_fetch_array($result))
	  {
		$tabla=$tabla."<tr><td>" . 
			$row["idtareas"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["titulo"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["operacion"] . "</td>";
		$tabla=$tabla. "<td>" . 
			$row["descripcion"] . "</td>"."</tr>";
		
		
	  }
	  if($tabla==""){
		  $tabla=$tabla."<tr ><td colspan=\"9\">No hay informacion para mostrar</td></tr>";
	  }
	 echo $tabla;		 	

	  return;
	
}



function setVehiculoEnPlanMantenimiento(){
	$array_alta=array();
	$array_baja=array();
	$array_nop=array();
	$index=$_POST["index"];
	$idplan=$_POST["planmantenimiento"];
	
	$query = "CALL listar_vehiculos_por_plan('".$idplan."')";
	$result = executeQuery($query);
	  
	while($row = mysql_fetch_array($result))
	  {
		$vehiculo_numero=$row["idInterno"];
		$estado="NOK";
		for($i=0;$i<$index;$i++){
			$datos=$_POST[$i];
			if($datos["Numero"]==$vehiculo_numero){
				echo "Esta bien";
				$estado="OK";	
			}
		}
		if($estado=="OK"){
			array_push($array_nop,$vehiculo_numero);
			
		}else if($estado=="NOK"){
			array_push($array_baja,$vehiculo_numero);		
		}
		
		
	  }
	
	for($i=0;$i<$index;$i++){
		$datos=$_POST[$i];
		if(in_array($datos["Numero"],$array_baja)){
			echo "todo bien";
		}else if (in_array($datos["Numero"],$array_baja)){
			
		}else{
			array_push($array_alta,$datos["Numero"]);
		}
	}
	if(isset($array_alta)){
		
		for($i=0;$i<sizeof($array_alta);$i++){
			$query = "CALL buscar_vehiculo('".$array_alta[$i]."')";
			$result = executeQuery($query);
			$row = mysql_fetch_array($result);
			$km=$row["kilometros"];
			$query = "CALL alta_vehiculo_en_planmantenimiento('".$array_alta[$i]."','".$idplan."','".$km."',null);";
			$result = executeQuery($query);
		}
	}
	if(isset($array_baja)){
		for($i=0;$i<sizeof($array_baja);$i++){
			$query = "CALL borrar_vehiculo_de_planmantenimiento('".$array_baja[$i]."','".$idplan."');";
			$result = executeQuery($query);
		}
	}
	
}

//----------------VEHICULOS---------------///

function getProximoVehiculo(){
	$tipo=$_POST["tipo"];
	$query = "CALL get_proximo_numero('".$tipo."')";
	$result = executeQuery($query);	   
	$row = mysql_fetch_array($result);
	echo $row['proximo_vehiculo'];
	
}

function updateEstadoVehiculo(){
	$id=$_POST["idVehiculo"];
	$estado=$_POST["estado"];
	$query = "CALL update_estado_vehiculo('".$id."','".$estado."')";
	$result = executeQuery($query);	
	
}

//-------CARGAR TABLA VEHICULOS
function cargarTablaVehiculos(){
	
	$tipo=$_POST["atributo1"];
	  $query = "CALL listar_vehiculos('".$tipo."')";
	  $result = executeQuery($query);
	  $tabla="";
	   
	while($row = mysql_fetch_array($result))
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
	   
	while($row = mysql_fetch_array($result))
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
	if($row = mysql_fetch_array($result)){
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

function cargarComboBoxTiposPartes(){
	$query = "CALL listar_tipos_partes();";
	$result = executeQuery($query);
	$opciones="";
	while($row = mysql_fetch_array($result))
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
	if(mysql_num_rows($result) > 0){
		$row = mysql_fetch_array($result);
		
	}
		echo $query;
	
	
	
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
	if(mysql_num_rows($result) > 0){
		$row = mysql_fetch_array($result);
		
	}
		echo $query;
	
	
	
}

function updatePartes(){
	$idPartes=$_POST["idPartes"];
	$fechaVencimiento=$_POST["fechaVencimiento"];
	$kmVencimiento=$_POST["kmVencimiento"];
	$query = "CALL update_partes(".$idPartes.",'".$fechaVencimiento."','".$kmVencimiento."');";
	$result = executeQuery($query);
	if(mysql_num_rows($result) > 0){
		$row = mysql_fetch_array($result);
		
	}
	echo $query;	
	
}

function getPartes(){
	$idparte=$_POST["idparte"];
	$query = "CALL buscar_partes(".$idparte.")";
	$result = executeQuery($query);
	if(mysql_num_rows($result) != 0){
		while($row = mysql_fetch_array($result))
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
	   
	while($row = mysql_fetch_array($result))
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
		$row = mysql_fetch_array($result);
		
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
function borrar_mantenimiento(){
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL borrar_mantenimiento(".$idMantenimiento.");";
	$result = executeQuery($query);
	echo $query;
	echo "OK";
}



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
	$partes=array();
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL listar_partes_por_mantenimiento('".$idMantenimiento."')";
	$result = executeQuery($query);
	if(mysql_num_rows($result)>0){
	$partes["operacion"]="OK";
	while($row = mysql_fetch_array($result))
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
	if(mysql_num_rows($result)>0){
		while($row = mysql_fetch_array($result)){
			$mantenimiento=$row;			
		}
		$query = "CALL listar_partes_por_mantenimiento(".$mantenimiento["idmantenimiento"].");";
		$result = executeQuery($query);
		if(mysql_num_rows($result)>0){
			while($partesPorMantenimiento = mysql_fetch_array($result)){
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
	
	if(mysql_num_rows($result)>0){
		while($row = mysql_fetch_array($result)){
			$listaMantenimientos[]=$row;			
		}
		
		for($i=0;$i<sizeof($listaMantenimientos);$i++){
			$lista=$lista."<div id=\"".$listaMantenimientos[$i]["idmantenimiento"]."\"<label>ID:".$listaMantenimientos[$i]["idmantenimiento"]."</label> - <label>Titulo:".$listaMantenimientos[$i]['titulo']."</label><button id=\"btn_ejecutar_mp\">Ejecutar</button><button id=\"btn_borrar_mp\">Borrar</button><ul>Tareas:";
			$query = "CALL listar_partes_por_mantenimiento(".$listaMantenimientos[$i]["idmantenimiento"].");";
			$result = executeQuery($query);
			if(mysql_num_rows($result)>0){
				while($row = mysql_fetch_array($result)){
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
/*

function getMantenimientoProgramado(){
	$idVehiculo=$_POST["idVehiculo"];
	$query = "CALL buscar_mantenimiento(0,".$idVehiculo.",'Programado');";
	$result = executeQuery($query);
	$listaTareas=array();
	echo $query;
	if(mysql_num_rows($result)>0){
		while($row = mysql_fetch_array($result)){
			$listaTareas[]=$row;			
		}
		echo json_encode($listaTareas);
	}else{
		echo json_encode(array("resultado"=>'FALSE'));
	
	}
}*/

function getMantenimiento(){
	$idMantenimiento=$_POST["idMantenimiento"];
	$query = "CALL buscar_mantenimiento('".$idMantenimiento."',null,null)";
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);
	
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
	if(mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);	 
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
				$row = mysql_fetch_array($result);
				if($mantenimiento[0]['estado']=="Programado"||$mantenimiento[0]['estado']=="En curso"){
					$query="call update_estado_vehiculo('".$row["idInterno"]."','No operativo');";
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




?>

