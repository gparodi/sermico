<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-es">
<head>
 
<link rel="stylesheet" href="Estilos/menu.css" type="text/css" />

<meta name="viewport" content="width=device-width">
</head>
<body>
<div style="overflow:hidden">
    <div id="divUsuario">
        <form id="logIn">
        <input type="text" id="user" required="required" placeholder="Usuario"/>
        <input type="password" id="password" required="required" placeholder="Contraseña"/>
        <button id="btnLog" type="submit">Acceder</button>
        </form>
        <div id="divDescripcionUsuario" style="display:none">
            <p id="idUsuario"></p><button id="btnLogOut">Salir</button>
        </div>
    </div>
</div>
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

<script>
$(document).ready(function(e) {

if(window.sessionStorage.getItem("user_name")!=null){
	$("#logIn").css("display","none");
	$("#divDescripcionUsuario").css("display","block");
	$("#idUsuario").append("Registrado como: "+sessionStorage.getItem("user_name"));
}else{
	
	
}


$("#logIn").on("submit",this,function(e){
	e.preventDefault();
	var user=$("#user").val();
	var pass=$("#password").val();
	$.ajax({
	url: 'Includes/loginServer.php',
	type: 'POST',
	dataType:"json",
	data: {user:user,pass:pass},
	success: function(response){
		if(response.resultado=='TRUE'){
			
			window.sessionStorage.setItem("user_name",user);
			window.sessionStorage.setItem(user,response.perfil);
			
			$("#logIn").css("display","none");
			$("#divDescripcionUsuario").css("display","block");
			$("#idUsuario").append("Registrado como: "+user);
			
			location.reload();
			
		}else{
			alert("Nombre de usuario o contraseña invalidos");
			$("#password").val("");	
		}
		
	}
	});

	
	
});


$("#btnLogOut").on("click",this,function(){
	if(sessionStorage.getItem("user_name")!=null){
		window.sessionStorage.clear();
		$("#logIn").css("display","block");
		$("#divDescripcionUsuario").css("display","none");
		$("#idUsuario").empty();
		
		$.ajax({
		url: 'Includes/logout.php',
		
		});
		
		$(location).attr('href','index.php');
		
		
	}
	
});

	
});

</script>
</html>
