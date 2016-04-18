<?php
switch($_POST["tarea"]){ 


//---------------- VIAJES---------------///
case 'altaViaje':
		altaViaje();
		break;

//-----FIN VIAJES
}

//---------------- VIAJES---------------///

function altaViaje(){
	echo $_POST["titulo"];	
	
}

//-----FIN VIAJES



?>