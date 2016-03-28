<?php
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<title>Documento sin título</title>
</head>

<body>
<div id="container">
<form id="login" action="#">
<li><label>Usuario:</label>
<input type="text" id="user" /></li>
<li><label>Password:</label>
<input type="password" id="password" /></li>
<button type="submit" id="btnLogin">Log In</button>
</form>
</div>
<div id="respuesta">
</div>
</body>

<script>
$("#login").on("submit",this,function(e){
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
				window.history.back();
				//$(location).attr('href','contenido_1.php');	
			
		}
		
	},
	error: function(jqXHR, textStatus, errorThrown){
	alert(textStatus);
	}
	});
});

$(document).ready(function(e) {
    if(window.sessionStorage.length>0){
		var user_name=sessionStorage.getItem("user_name");
	}
});

</script>

</html>