<?php
switch($_POST["tarea"]){
	
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

case 'modificarPlanMantenimiento':modificarPlanMantenimiento();
		break;
//-----PLAN DE MANTENIMIENTO
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
	$estado=$_POST["estado"];
	
	$kmAntes=$_POST["kmAntes"];
	$diasAntes=$_POST["diasAntes"];
	$mesesAntes=$_POST["mesesAntes"];
	$horasAntes=$_POST["horasAntes"];
	$listaMails=$_POST["listaMails"];
	

	$query = "CALL alta_planmantenimiento('".$titulo."','".$km."','".$horas."','".$dias."','".$meses."','".$años."','".$descripcion."','".$estado."','".$kmAntes."','".$horasAntes."','".$diasAntes."','".$mesesAntes."','".$listaMails."');";
	$result = executeQuery($query);  
	if($row = $result->fetch_assoc()){
		echo $row["idPlan"];
	}else{
		echo 0;
	}
	
	
}


function modificarPlanMantenimiento(){

	$titulo=$_POST["titulo"];
	$km=$_POST["km"];
	$horas=$_POST["horas"];
	$dias=$_POST["dias"];
	$meses=$_POST["meses"];
	$años=$_POST["años"];
	$descripcion=$_POST["descripcion"];
	$estado=$_POST["estado"];
	
	$kmAntes=$_POST["kmAntes"];
	$diasAntes=$_POST["diasAntes"];
	$mesesAntes=$_POST["mesesAntes"];
	$horasAntes=$_POST["horasAntes"];
	$listaMails=$_POST["listaMails"];
	$idPlan=$_POST["idPlan"];

	$query = "CALL modificar_planmantenimiento(".$idPlan.",'".$titulo."','".$km."','".$horas."','".$dias."','".$meses."','".$años."','".$descripcion."','".$estado."','".$kmAntes."','".$horasAntes."','".$diasAntes."','".$mesesAntes."','".$listaMails."');";
	$result = executeQuery($query);  
	if($row = $result->fetch_assoc()){
		echo $row["idPlan"];
	}else{
		echo 0;
	}
	
	
}



function borrarTarea(){
	$array_baja=array();
	$array_nop=array();
	$index=$_POST["index"];
	$idplan=$_POST["planmantenimiento"];
	
	$query = "CALL listar_tareas_por_planmantenimiento('".$idplan."')";
	$result = executeQuery($query);
	  
	while($row = $result->fetch_assoc())
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
	if($row = $result->fetch_assoc()){
		echo $row["resultado"];
	}else{
		echo "Error";
	}
	
	
}

	


function listarPlanDeMantenimiento(){
	$query = "CALL listar_planes_mantenimiento()";
	  $result = executeQuery($query);
	  $tabla="";
	
	while($row = $result->fetch_assoc())
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
	$row = $result->fetch_assoc();	
	$idPlanMantenimiento=$row["idplanMantenimiento"];
	$titulo=$row["titulo"];
	$km=$row["km"];
	$horas=$row["horas"];
	$dias=$row["dias"];
	$meses=$row["meses"];
	$años=$row["años"];
	$descripcion=$row["descripcion"];
	$estado=$row["estado"];
	
	$planMantenimiento=array("idPlanMantenimiento"=>$idPlanMantenimiento, "titulo"=>$titulo, "km"=>$km, "horas"=>$horas, "dias"=>$dias, "meses"=>$meses, "años"=>$años, "descripcion"=>$descripcion, "estado"=>$estado,"kmAntes"=>$row["kmAntes"],"horasAntes"=>$row["horasAntes"],"diasAntes"=>$row["diasAntes"],"mesesAntes"=>$row["mesesAntes"],"listaMails"=>$row["listaMails"]);
	
	echo json_encode($planMantenimiento);
	
}

function listarVehiculosPorPlanDeMantenimiento(){
	$tipo=$_POST["atributo1"];
	  $query = "CALL listar_vehiculos_por_plan('".$tipo."')";
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
	   
	while($row = $result->fetch_assoc())
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
	  
	while($row = $result->fetch_assoc())
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
			$row = $result->fetch_assoc();
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


?>