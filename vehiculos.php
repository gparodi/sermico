


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting"><!-- InstanceBegin template="/Templates/Template_Base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" type="image/x-icon" href="Imagenes/sermico.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SERMICO SRL</title>
 
<!-- InstanceEndEditable -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="Includes/Utilities.js"></script>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>

</head>

<script src="Includes/Remodal-1.0.6/dist/remodal.min.js"></script>
<body>
<div class="superior">



    <?php include("Includes/Menu.php"); ?>
    
    <!-- end .header -->
  
</div>
<div class="container">
    
  <!-- InstanceBeginEditable name="EditRegion2" -->

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>

</div>


<table id="tablaVehiculos" class="scroll"><thead><tr>
<th>Numero</th><th>Marca</th><th>Modelo</th><th>Patente</th><th>Año</th><th>Tipo</th><th>Kilometros</th><th>Estado</th></tr></thead><tbody></tbody>


</table>


<button id="btnDetalles" style="display:none"> Ver detalles </button>

<div  id="detalleVehiculos" style="display:none">
<h1>Detalles del vehiculo</h1>
<form id="formVehiculo" class="dataform" action="" title="" method="post">

<li id="listaTipos" style="display:none"><label>Tipo</label></li>
<li><select id="tipo">
<option>Utilitarios</option>
<option>Camiones y Semi Acoplados</option>
<option>Transporte de pasajeros</option>
<option>Maquinas especiales</option>
</select></li>

<li><label>Numero</label></li>
<li><input id="numero" type="text" /></li>

<li><label>Marca</label></li>
<li><input id="marca" type="text" /></li>

<li><label>Modelo</label></li>
<li><input id="modelo" type="text" /></li>

<li><label>Patente</label></li>
<li><input id="patente" type="text" required="required" /></li>

<li><label>OT</label></li>
<li><input id="ot" type="text" /></li>

<li><label>Kilometros</label></li>
<li><input id="km" type="text" /></li>

<li><label>Año</label></li>
<li><input id="año" type="text" /></li>

<li><label>Modelo de motor</label></li>
<li><input id="modeloMotor" type="text" /></li>

<li><label>Codigo de motor</label></li>
<li><input id="motor" type="text" /></li>

<li><label>Numero de chasis</label></li>
<li><input id="chasis" type="text" /></li>

<li><label>Consumo promedio</label></li>
<li><input id="consumo" type="text"  /></li>

<li><label>Combustible</label></li>
<li><select id="combustible">
<option>Gasoil grado 2</option>
<option>Nafta grado 2</option>
<option>Gasoil grado 3</option>
<option>Nafta grado 3</option>
</select></li>


<li><label>Descripcion</label></li>
<li><textarea id="descripcion" rows="10" cols="40" ></textarea></li>
<li> <button id="btnNuevoVehiculo" type="submit" style="display:none" value="btnNuevoVehiculo">Aceptar</button> 
</li>
<li> <button id="btnModificarVehiculo" type="submit" style="display:none" value="btnModificarVehiculo">Aceptar</button> 
</li></form>

<div id="partes">
<h2>Componentes</h2>
<div id="filtros">Filtrar por:
<select id="comboBoxFiltroPartes"> </select>

</div>
<table id="tablaVehiculosPartes"><thead>
<th>ID</th><th>Nombre</th><th>Colocacion(Km)</th><th>Vencimiento(Km)</th><th>Vencimiento(Fecha)</th></thead><tbody class="scrollContent"></tbody></table>
</div>
</div>


<div id="menuPop" class="menuPopUp" style="display:none">
      <ul>
            <li id="nuevo">Nuevo</li>
            <li id="eliminar">Eliminar</li>
            <li id="modificar">Modificar</li>
            <li id="agregarParte">Agregar Parte/Accesorio</li>
        </ul>
</div>

<div id="menuPopPartes" class="menuPopUp" style="display:none">
      <ul>
            <li id="nuevo">Nuevo</li>
            <li id="eliminar">Eliminar</li>
            <li id="modificar">Modificar</li>
           
        </ul>
</div>
<div id="partesVehiculos_Modal">
 	
</div>


 <script>
 var $vehiculoActual=0;
 var $estadoDetalle=0;
 var $estado=null;
 var $idBtn=null;
 //FILTRO
var $tipoPartes;
var $vehiculoPartes=0;
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
var $tipo=$("#comboBoxFiltro").val();
loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$tipo);
	
		
});


$(document).on({
    ajaxStart: function() { $("body").addClass("loading");    },
     ajaxStop: function() { $("body").removeClass("loading"); }    
});

$(document).ready(function(e) {
    var user=window.sessionStorage.getItem('user_name');
	var perfil=window.sessionStorage.getItem(user);
	//COMPARA CON EL ID DE LA VENTANA...SI ES CORRECTO LO DEJA ENTRAR
	var permiso=perfil&2;
	if(permiso==0){
		window.stop();
		alert("No tiene permisos para acceder a esta funcion");
		window.history.back();
	}
});

$("#comboBoxFiltro").on("input",function(){	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$tipo);
	
	
});


//---FIN FILTRO

 //FILTRO PARTES
loadComboFromDB("#comboBoxFiltroPartes","cargarComboBoxTiposPartes",function(){
	$tipoPartes=$("#comboBoxFiltroPartes").val();
	loadTableFromDb("#tablaVehiculosPartes","cargarTablaVehiculosPartes",$tipoPartes,$vehiculoActual);
	
	
	
	
		
});

$("#comboBoxFiltroPartes").on("input",function(){	
	
    $tipoPartes=$("#comboBoxFiltroPartes").val();
	loadTableFromDb("#tablaVehiculosPartes","cargarTablaVehiculosPartes",$tipoPartes,$vehiculoActual);
		
	
});




//---FIN FILTRO

/*
$("#tablaVehiculos").on("click",'tr',function() {
	$('tr.seleccionFila:first').removeClass("seleccionFila");
    $(this).addClass("seleccionFila");
});*/

$("#btnDetalles").on("click",this,function(){
	
	 mostrarDetalles();
	 
	
});

function mostrarDetalles(){
	
	if($estadoDetalle==0){
		$("#btnDetalles").text("Ocultar detalle");
		$("#detalleVehiculos").toggle("slow");
		$('html,body').animate({
        scrollTop: $("#formVehiculo").offset().top
    }, 2000);
		mostrarVehiculo();
		$estadoDetalle=1;
	}else{
		$("#btnDetalles").text("Ver detalle");
		$('html,body').animate({
        scrollTop: $("#formVehiculo").offset().top
    }, 2000);
		$("#detalleVehiculos").toggle("slow");
		$estadoDetalle=0;
	}
}


$('#tablaVehiculos').not("first").on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	$("#btnDetalles").css("display","block");
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$vehiculoActual=item.innerHTML;
			}
	});
	
	if($("#detalleVehiculos").is(':visible')){
		
		if($estado=="nuevo"||$estado=="modificar"){
			if(confirm("Los datos se perderan ¿desea continuar?")){
				$('tr.seleccionFila:first').removeClass("seleccionFila");
    			$(this).closest("tr").addClass("seleccionFila");
               mostrarVehiculo();
			}
		}else{
				$('tr.seleccionFila:first').removeClass("seleccionFila");
   				$(this).closest("tr").addClass("seleccionFila");
				mostrarVehiculo();
								  
			}
		
	}else{
		$('tr.seleccionFila:first').removeClass("seleccionFila");
   		$(this).closest("tr").addClass("seleccionFila");
	}
});


$('#tablaVehiculosPartes').not("first").on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$vehiculoPartes=item.innerHTML;
			}
	});
	window.sessionStorage.idParte=$vehiculoPartes;
	sessionStorage.operacion="mostrar";
	
	$('tr.seleccionFila:first').removeClass("seleccionFila");
   	$(this).closest("tr").addClass("seleccionFila");
	
	
});

function mostrarVehiculo(){
	if($vehiculoActual!=0){
		loadTableFromDb("#tablaVehiculosPartes","cargarTablaVehiculosPartes",$tipoPartes,$vehiculoActual);
		$estado="mostrar";
		$("#listaTipos").css({"display":"none"});
		$("#btnModificarVehiculo").css({"display":"none"});
		$("#btnNuevoVehiculo").css({"display":"none"});
		$("#formVehiculo input").attr('readonly','readonly');
			$("#formVehiculo textarea").attr('readonly','readonly');
		sendAjaxJson({tarea:'getVehiculo',idVehiculo:$vehiculoActual},function(vehiculo){
			
			
			$("#numero").val(vehiculo.idInterno);
			$("#marca").val(vehiculo.marca);
			$("#modelo").val(vehiculo.modelo);
			$("#patente").val(vehiculo.patente);
			$("#año").val(vehiculo.año);
			$("#ot").val(vehiculo.ot);
			$("#km").val(vehiculo.km);
			$("#chasis").val(vehiculo.numeroDeChasis);
			$("#descripcion").val(vehiculo.descripcion);
			$("#modeloMotor").val(vehiculo.modeloMotor);
			$("#motor").val(vehiculo.numeroMotor);
			$("#consumo").val(vehiculo.consumo);
			$("#combustible").val(vehiculo.combustible);
		});
	}
	
	
}


function borrarVehiculo(){
	
	if($vehiculoActual!=0){
		$estado="borrar";
		if (confirm('¿Esta seguro que desea eliminar el vehiculo seleccionado?')){
			sendAjaxHtml({tarea:'borrarVehiculo',idInterno:$vehiculoActual},function(datos){
					alert(datos);
					loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$("#comboBoxFiltro").val());
				
				});	
		}
		
	}else{
		alert("Por favor seleccione un vehiculo para borrar");
	}
	
}

function modificarVehiculo(){
	
	if($("#detalleVehiculos").is(':visible')){
		cleanForm("#formVehiculo");
		mostrarVehiculo();
	}else{
		//$("#detalleVehiculos").css({'display':'block'});
		$("#detalleVehiculos").toggle("slow");
		mostrarVehiculo();
	}
	$('html,body').animate({
        scrollTop: $("#formVehiculo").offset().top
    }, 2000);
	
	$("#formVehiculo input").removeAttr('readonly');
	$("#formVehiculo textarea").removeAttr('readonly');
	$estado="modificar";
	
	$("#btnNuevoVehiculo").css({'display':'none'});
	$("#btnModificarVehiculo").css({'display':'block'});
	$("#listaTipos").css({'display':'none'});
			
	
}

function nuevoVehiculo(){
	$("#partes").css("display","none");
	if($("#detalleVehiculos").is(':visible')){
		cleanForm("#formVehiculo");	
	}else{
		//mostrarDetalles();
		$("#detalleVehiculos").css({'display':'block'});
		$("#btnDetalles").css({'display':'none'});
		
	}
	sendAjaxHtml({tarea:'getProximoVehiculo',tipo:$("#tipo").val()},function(response){
		$("#numero").val(response);
	});
	
	$("#tipo").on("change",this,function(){
		sendAjaxHtml({tarea:'getProximoVehiculo',tipo:$("#tipo").val()},function(response){
		$("#numero").val(response);
	});
	});
	
	$('html,body').animate({
        scrollTop: $("#formVehiculo").offset().top
    }, 2000);
	$("#formVehiculo input").removeAttr('readonly');
	$("#formVehiculo textarea").removeAttr('readonly');
	$("#btnModificarVehiculo").css({'display':'none'});
	$("#btnNuevoVehiculo").toggle("slow");
	$("#listaTipos").toggle("slow");
	$("#tipo").focus();
	$estado="nuevo";
	
	
}

//-----------MENU CONTEXTUAL TABLA VEHICULOS

 $("#tablaVehiculos tbody").bind("contextmenu", function(e){
    $("#menuPop").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
     return false;
 });
 
 //cuando hagamos click, el menú desaparecerá
            $(document).click(function(e){
                  if(e.button == 0){
                        $("#menuPop").css({'display':'none'});
                  }
            });
             
            //si pulsamos escape, el menú desaparecerá
            $(document).keydown(function(e){
                  if(e.keyCode == 27){
                        $("#menuPop").css({'display':'none'});
                  }
            });

//controlamos los botones del menú
            $("#menuPop").click(function(e){
                   
                  // El switch utiliza los IDs de los <li> del menú
                  switch(e.target.id){
                        
                        case "eliminar":
								
                              borrarVehiculo();
                              break;
						 case "nuevo":
						 	  if($estado=="nuevo"){
								  if(confirm("Los datos se perderan ¿desea continuar?")){
                              	nuevoVehiculo();
								  }
							  }else{
								  nuevoVehiculo();
								  
							  }
                              break;
						case "modificar":
							if($estado=="nuevo"){
								  if(confirm("Los datos se perderan ¿desea continuar?")){
                              	modificarVehiculo();
								  }
							  }else{
								 modificarVehiculo();
								  
							  }
                              
                              break;
                  }
                   
            });
			
 
// FIN MENU CONTEXTUAL TABLA VEHICULOS


//-----------MENU CONTEXTUAL TABLA VEHICULOS PARTES

 $("#tablaVehiculosPartes tbody").bind("contextmenu", function(e){
    $("#menuPopPartes").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
     return false;
 });
 
 //cuando hagamos click, el menú desaparecerá
            $(document).click(function(e){
                  if(e.button == 0){
                        $("#menuPopPartes").css({'display':'none'});
                  }
            });
             
            //si pulsamos escape, el menú desaparecerá
            $(document).keydown(function(e){
                  if(e.keyCode == 27){
                        $("#menuPopPartes").css({'display':'none'});
                  }
            });

//controlamos los botones del menú
            $("#menuPopPartes").click(function(e){
                   
                  // El switch utiliza los IDs de los <li> del menú
                  switch(e.target.id){
                        
                        case "eliminar":
							borrarParte();
                              
                              break;
						 case "nuevo":
						 	  altaPartesVehiculos();
                              break;
						case "modificar":
								modificarPartesVehiculo();
							
                              
                              break;
                  }
                   
            });
			
 
// FIN MENU CONTEXTUAL TABLA VEHICULOS PARTES
  
 $("#formVehiculo").on("submit",this,function(e){
	var datos;
	e.preventDefault();
	
	var $tipo=$("#tipo").val();
	var $numero=$("#numero").val();
	var $año=$("#año").val();
	var $combustible=$("#combustible").val();
	var $consumo=$("#consumo").val();
	var $descripcion=$("#descripcion").val();
	var $km=$("#km").val();
	var $marca=$("#marca").val();
	var $modelo=$("#modelo").val();
	var $modeloMotor=$("#modeloMotor").val();
	var $motor=$("#motor").val();
	var $ot=$("#ot").val();
	var $patente=$("#patente").val();
	var $chasis=$("#chasis").val();
	
	
	
	if($estado=="nuevo"){
		datos={tarea:"altaVehiculo",tipo:$tipo,numero:$numero,año:$año,combustible:$combustible,consumo:$consumo,descripcion:$descripcion,km:$km, marca:$marca, modelo:$modelo,modeloMotor:$modeloMotor, motor:$motor, ot:$ot, patente:$patente,chasis:$chasis};
	}else if($estado=="modificar"){
		datos={tarea:"modificarVehiculo",idInterno:$vehiculoActual,numero:$numero,año:$año,combustible:$combustible,consumo:$consumo,descripcion:$descripcion,km:$km, marca:$marca, modelo:$modelo,modeloMotor:$modeloMotor, motor:$motor, ot:$ot, patente:$patente,chasis:$chasis};
	}
	sendAjaxHtml(datos,function(dato){
		//$(location).attr('href','vehiculos.php');
		$("#prueba").empty();
		$("#prueba").append(dato);
		loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$("#comboBoxFiltro").val());
		cleanForm("#formVehiculo");
		mostrarVehiculo();
		
		
	});
	
	
});                       
   

function borrarParte(){
	
	if($vehiculoPartes!=0){
		$estado="borrar";
		if (confirm('¿Esta seguro que desea eliminar el componente seleccionado?')){
			sendAjaxHtml({tarea:'borrarParte',idPartes:$vehiculoPartes},function(datos){
					alert(datos);
					loadTableFromDb("#tablaVehiculosPartes","cargarTablaVehiculosPartes",$tipoPartes,$vehiculoActual);
				
				});	
		}
		
	}else{
		alert("Por favor seleccione un componente a borrar");
	}
	
	
}

function mostrarModalPartes(titulo){
	$('#partesVehiculos_Modal').load('panel_alta_partes.php');
		 $('#partesVehiculos_Modal').dialog({
			 resizable: false,
			 title: titulo,
			  height:500,
			  width:900,
			  modal: true,
			  close: function(e,ui){
				loadTableFromDb("#tablaVehiculosPartes","cargarTablaVehiculosPartes",$tipoPartes,$vehiculoActual);
				  
			  }
      		
    	});
	
}

function altaPartesVehiculos(){
	sessionStorage.operacion='nuevo';
	sessionStorage.removeItem("idParte");
	mostrarModalPartes("Nuevo componente");	
}

function modificarPartesVehiculo(){
	sessionStorage.operacion='modificar';
	var valorTipo=$("#comboBoxFiltroPartes").val();
	mostrarModalPartes("Modificar "+valorTipo);
	
}
function mostrarPartesVehiculos(){
	var valorTipo=$("#comboBoxFiltroPartes").val();
	mostrarModalPartes("Detalles "+valorTipo);
	
}

$('#tablaVehiculosPartes tbody').on("dblclick",this,function(){
	sessionStorage.operacion='mostrar';
	 mostrarPartesVehiculos();
});

function cerrarModalPartes(){
	$("#partesVehiculos_Modal").dialog("close");
	loadComboFromDB("#comboBoxFiltroPartes","cargarComboBoxTiposPartes",function(){
	$tipoPartes=$("#comboBoxFiltroPartes").val();
	loadTableFromDb("#tablaVehiculosPartes","cargarTablaVehiculosPartes",$tipoPartes,$vehiculoActual);
		
	});

}
 
</script>
<div class="modalWait"><!-- Place at bottom of page --></div>
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
