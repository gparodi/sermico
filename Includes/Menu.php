<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-es">
<head>
  <title>Menu desplegable CSS</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="Estilos/menu.css" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="rmm-js/responsivemobilemenu.js"></script>

<meta name="viewport" content="width=device-width">
</head>
<body>
<ul id="menu">
    <li><a href="index.php">Inicio</a></li>
    <li>
        <a href="vehiculos.php">Vehiculos</a>
        <ul>
            <li><a href="alta_vehiculo.php">Nuevo vehiculo</a></li>
            <li><a href="actualizar_km.php">Actualizar KM</a></li>
            <li><a href="alta_partes.php">Agregar Parte</a></li>
            <li><a href="documentacion.php">Documentacion</a></li>
        </ul>
    </li>
    <li><a href="mantenimiento.php">Mantenimiento</a>
    	 <ul>
            <li><a href="alta_mantenimiento.php">Cargar</a></li>
            
        </ul>
    
    </li>
    <li><a href="plan_mantenimiento.php">Plan de Mantenimiento</a>
    	<ul>
            <li><a href="alta_plan_mantenimiento.php">Nuevo plan</a></li>
            
     	</ul>
     </li>
    <li><a href="viajes.php">Viajes</a>
    	<ul>
            <li><a href="alta_viajes.php">Nuevo viaje</a></li>
            <li><a href="#">Historial</a></li>
            <li><a href="#">Control</a></li>
        </ul>
    </li>    
    <li><a href="#">Conductores</a>	
    	<ul>
            <li><a href="#">Alta</a></li>
        </ul>
    </li>
    <li><a href="#">Proveedores</a></li>
    
</ul>
</body>
</html>
