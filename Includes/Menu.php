<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-es">
<head>
 
<link rel="stylesheet" href="Estilos/menu.css" type="text/css" />

<meta name="viewport" content="width=device-width">
</head>
<body>
<button id="logout">Logout</button>
<ul id="menu">
    <li><a href="index.php">Inicio</a></li>
    <li>
        <a href="vehiculos.php">Vehiculos</a>
        <ul>
            <li><a href="actualizar_km.php">Actualizar KM</a></li>
        </ul>
    </li>
    <li><a href="mantenimiento.php">Mantenimiento</a>
    	 <ul>
            <li><a href="alta_mantenimiento.php">Nuevo</a></li>
            
        </ul>
    
    </li>
    <li><a href="plan_mantenimiento.php">Plan de Mantenimiento</a>
    	<ul>
            <li><a href="alta_plan_mantenimiento.php">Nuevo plan</a></li>
     	</ul>
     </li>
    <li><a href="prueba.php">Viajes</a>
    	<ul>
            <li><a href="alta_viajes.php">Nuevo viaje</a></li>
            <li><a href="#">Historial</a></li>
            <li><a href="alta_historial_viajes.php">Control</a></li>
        </ul>
    </li>    
   
</ul>
</body>
</html>
