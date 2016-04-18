<?php
switch($_POST["tarea"]){

//----------------PROVEEDORES---------------///

case 'cargarComboBoxProveedores':cargarComboBoxProveedores();
		break;
case 'altaProveedorSimple':
	  altaProveedorSimple();
	  break;
//-----FIN PROVEEDORES
}

//----------------PROVEEDORES---------------///
function cargarComboBoxProveedores(){
	$query = "call listar_proveedores();";
	$result = executeQuery($query);	
	$opciones="";
	if(!empty($result)){
		while($row = $result->fetch_assoc())
		  {
			   $opciones.='<option value="'.$row["nombre"].'">';
			  
		  }
		  echo $opciones;
	}else{
		echo "-";
	}
	
	
}

function altaProveedorSimple(){
	
	$proveedor=$_POST["nombre"];
	$query = "CALL alta_proveedor_simple('".$proveedor."');";
	$result = executeQuery($query);
	return;
	
}

//-----FIN PROVEEDORES

?>