<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting"><!-- InstanceBegin template="/Templates/Template_Base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" type="image/x-icon" href="Imagenes/sermico.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SERMICO SRL</title>
 
 
<!-- InstanceEndEditable -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="Includes/JS_Cookies/jquery.cookie.js"></script>
<script type="text/javascript" src="Includes/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="Includes/Utilities.js"></script>
<script type="text/javascript" src="Includes/js/jquery.leanModal.min.js"></script>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>
</head>


<body>
<div class="superior">
<?php include("Includes/Cabecera.php"); ?>
  <div class="header">
    <div class="clearfloat"></div>
    <?php include("Includes/Menu.php"); ?>
    
    <!-- end .header -->
  </div>

</div>
<div class="container">
    
  <!-- InstanceBeginEditable name="EditRegion2" -->

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>

</div>

<nav id="opciones">Acciones:
<button id="btnBorrar">Borrar</button>
<button id="btnModificar">Modificar</button>
</nav>


<div>
<table id="tablaVehiculos">
<th>Numero</th><th>Marca</th><th>Modelo</th><th>Patente</th><th>Año</th><th>Tipo</th><th>Kilometros</th><th>Estado</th>
<tbody>

</tbody>

</table>
</div>

<button id="botonDetalles"> Ver detalles </button>

<div  id="detalleVehiculos" style="display:none">
<form id="formVehiculo" action="" title="" method="post">


<li><label>Numero:</label>
<input id="numero" type="text" /></li>

<li><label>Marca:</label>
<input id="marca" type="text" /></li>

<li><label>OT:</label>
<input id="ot" type="text" /></li>


<li><label>Modelo:</label>
<input id="modelo" type="text" /></li>

<li><label>Patente:</label>
<input id="patente" type="text" /></li>

<li><label>Kilometros:</label>
<input id="km" type="text" /></li>

<li><label>Año:</label>
<input id="año" type="text" /></li>

<li><label>Modelo de motor:</label>
<input id="modeloMotor" type="text" /></li>

<li><label>Codigo de motor:</label>
<input id="motor" type="text" /></li>

<li><label>Numero de chasis:</label>
<input id="chasis" type="text" /></li>

<li><label>Consumo promedio:</label>
<input id="consumo" type="text" /></li>

<li><label>Combustible:</label>
<select id="combustible">
<option>Gasoil grado 2</option>
<option>Nafta grado 2</option>
<option>Gasoil grado 3</option>
<option>Nafta grado 3</option>
</select></li>


<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="40" rows="5"></textarea></li>

<li> <button id="btnModificarVehiculo" type="submit" style="display:none">Aceptar</button> 
</li></form>
</div>

<div id="menuPop" class="menuPopUp" style="display:none">
      <ul>
            <li id="eliminar">Eliminar</li>
            <li id="modificar">Modificar</li>
            <li id="agregarParte">Agregar Parte/Accesorio</li>
        </ul>
</div>



 <script>
 var $vehiculoActual=0;
 //FILTRO
var $vehiculoActual;
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$tipo);
		
});

$("#comboBoxFiltro").on("input",function(){	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$tipo);
	
	
});


//---FIN FILTRO


$("#botonDetalles").on("click",this,function(){
	$("#detalleVehiculos").css({'display':'block'});
	if($vehiculoActual!=0){
		sendAjaxJson({tarea:'getVehiculo',idVehiculo:$vehiculoActual},function(vehiculo){
			
			mostrarVehiculo(vehiculo);
		});
	}
});

function mostrarVehiculo(vehiculo){
	$("#formVehiculo input").attr('readonly','readonly');
	$("#formVehiculo textarea").attr('readonly','readonly');
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
	
}

$('#tablaVehiculos').not("first").on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$vehiculoActual=item.innerHTML;
			}
	});
	$(this).addClass("seleccionFila");
});





function borrarVehiculo(){
	
	if($vehiculoActual!=0){
		if (confirm('¿Esra seguro que desea eliminar el vehiculo seleccionado?')){
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
	$("#formVehiculo input").removeAttr('readonly');
	$("#formVehiculo textarea").removeAttr('readonly');
	$("#btnModificarVehiculo").css({'display':'block'});
			
	
}



 $("#tablaVehiculos").bind("contextmenu", function(e){
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
						case "modificar":
                              modificarVehiculo();
                              break;
                  }
                   
            });
             
                         
   


 
</script>
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
