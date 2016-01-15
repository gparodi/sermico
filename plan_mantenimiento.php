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
<link rel="stylesheet" href="Includes/Remodal-1.0.6/dist/remodal.css">
<link rel="stylesheet" href="Includes/Remodal-1.0.6/dist/remodal-default-theme.css">
</head>

<script src="Includes/Remodal-1.0.6/dist/remodal.min.js"></script>
<body>
<div class="superior">



    <?php include("Includes/Menu.php"); ?>
    
    <!-- end .header -->
  
</div>
<div class="container">
    
  <!-- InstanceBeginEditable name="EditRegion2" -->
<table id="tablaPlanMantenimiento"><thead><tr>
    <th>ID</th><th>Titulo</th><th>Km</th><th>Horas</th><th>Dias</th>
    <th>Meses</th><th>Años</th><th>Descripcion</th><th>Estado</th>
    </tr></thead><tbody>
    
    </tbody>    
</table>

<button id="btnDetalles"> Ver detalles </button>

<div  id="detallePlanMantenimiento" style="display:none">
<form id="formPlanMantenimiento" action="" title="" method="post">

<li><label>Titulo:</label>
<input id="titulo" type="text" /></li>

<li><label>Estado:</label>
<select id="estado">
<option>Activo</option>
<option>Inactivo</option>
</select></li>


<li><label>Km:</label>
<input id="km" type="text" /></li>

<li><label>Horas:</label>
<input id="horas" type="text" /></li>

<li><label>Dias:</label>
<input id="dias" type="text" /></li>

<li><label>Meses:</label>
<input id="meses" type="text" /></li>

<li><label>Años:</label>
<input id="años" type="text" /></li>

<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="40" rows="5"></textarea></li>

<h2>Vehiculos incluidos en el plan de mantenimiento</h2>
<table id="vehiculosPorPlan"><thead><tr>
    <th>Numero</th><th>Marca</th><th>Modelo</th><th>Año</th>
    </tr></thead><tbody></tbody>

</table>

<h2>Tareas de plan de mantenimiento</h2>
<table id="tareasPorPlan"><thead><tr>
    <th>ID</th><th>Titulo</th><th>Operacion</th><th>Descripcion</th>
    </tr></thead><tbody></tbody>

</table>




<li> <button id="btnNuevoPlan" type="submit" style="display:none" >Aceptar</button> 
</li>
<li> <button id="btnModificarPlan" type="submit" style="display:none">Aceptar</button> 
</li>

</form>
</div>


<div id="menuPop" class="menuPopUp" style="display:none">
      <ul>
            <li id="nuevo">Nuevo</li>
            <li id="eliminar">Eliminar</li>
            <li id="modificar">Modificar</li>
            <li id="agregarParte">Agregar Parte/Accesorio</li>
        </ul>
</div>

<div id="modal">
 	
</div>

 <script>
var $planActual;
var $estadoDetalle=0;
var $estado;
var estadoModal;
////////////-----------EVENTOS---------------////////



$("#btnDetalles").on("click",this,function(){
         //mostrarDetalles();
		 $('#modal').load('panel_vehiculos_planmantenimiento.php');
		 $('#modal').dialog({
			 resizable: false,
			  height:500,
			  width:900,
			  modal: true   
      		
    	});
		 loadTableFromDb("#vehiculosPorPlan1","listarVehiculosPorPlanDeMantenimiento",$planActual);
		// estadoModal.open();     
        
});



$('#tablaPlanMantenimiento').not("first").on( 'click', 'td', function (e) {
    var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	
    jQuery.each($columns, function(i, item) {
        if(i==0){
            $planActual=item.innerHTML;
        }
    });
    
    
        
    if($("#detallePlanMantenimiento").is(':visible')){
                
        if($estado=="nuevo"||$estado=="modificar"){
            if(confirm("Los datos se perderan ¿desea continuar?")){
                $('tr.seleccionFila:first').removeClass("seleccionFila");
                $(this).closest("tr").addClass("seleccionFila");
                mostrar();
            }
        }else{
            $('tr.seleccionFila:first').removeClass("seleccionFila");
            $(this).closest("tr").addClass("seleccionFila");
            mostrar();
                                                                  
            }
                
    }else{
        $('tr.seleccionFila:first').removeClass("seleccionFila");
        $(this).closest("tr").addClass("seleccionFila");
    }
});

$("#formPlanMantenimiento").on("submit",this,function(e){
    var datos;
    e.preventDefault();
        
    if($estado=="nuevo"){
         datos={tarea:"altaVehiculo"};
    }else if($estado=="modificar"){
        datos={tarea:"modificarVehiculo"};
    }
    sendAjaxHtml(datos,function(dato){
        //$(location).attr('href','vehiculos.php');
        //$("#prueba").empty();
        //$("#prueba").append(dato);
        loadTableFromDb("#tablaPlanMantenimiento","cargarTablaVehiculos",$("#comboBoxFiltro").val());
        cleanForm("#formPlanMantenimiento");
        mostrar();
                
    });
        
        
}); 

$(document).ready(function(e) {
    loadTableFromDb("#tablaPlanMantenimiento","listarPlanDeMantenimiento");
});


///////////--------FIN EVENTOS

////////////-----------FUNCIONES ---------------////////

function mostrarDetalles(){
        if($estadoDetalle==0){
                $("#btnDetalles").text("Ocultar detalle");
                $("#detallePlanMantenimiento").css({'display':'block'});
                mostrar();
                $estadoDetalle=1;
        }else{
                $("#btnDetalles").text("Ver detalle");;
                $("#detallePlanMantenimiento").css({'display':'none'});
                $estadoDetalle=0;
        }
}


function mostrar(){
        if($planActual!=0){
                $estado="mostrar";
                
                $("#btnModificarVehiculo").css({"display":"none"});
                $("#btnNuevoVehiculo").css({"display":"none"});
                $("#formPlanMantenimiento input").attr('readonly','readonly');
                $("#formPlanMantenimiento textarea").attr('readonly','readonly');
                sendAjaxJson({tarea:'getPlanDeMantenimiento',idPlanMantenimiento:$planActual},function(plan){
                    $("#titulo").val(plan.titulo);
                    $("#km").val(plan.km);
                    $("#horas").val(plan.horas);
                    $("#dias").val(plan.dias);
                    $("#meses").val(plan.meses);
                    $("#años").val(plan.años);
                    $("#descripcion").val(plan.descripcion);
                    $("#estado").val(plan.estado);
                    loadTableFromDb("#vehiculosPorPlan","listarVehiculosPorPlanDeMantenimiento",$planActual);
					loadTableFromDb("#tareasPorPlan","listar_tareas_por_planmantenimiento",$planActual);
					 
                        
                });
        }
        
        
}


function borrar(){
        
        if($planActual!=0){
                $estado="borrar";
                if (confirm('¿Esra seguro que desea eliminar el vehiculo seleccionado?')){
                        sendAjaxHtml({tarea:'borrarVehiculo',idInterno:$planActual},function(datos){
                                        alert(datos);
                                        loadTableFromDb("#tablaPlanMantenimiento","cargarTablaVehiculos",$("#comboBoxFiltro").val());
                                
                                });     
                }
                
        }else{
                alert("Por favor seleccione un vehiculo para borrar");
        }
        
}

function modificar(){
        
        if($("#detallePlanMantenimiento").is(':visible')){
                cleanForm("#formPlanMantenimiento");
                mostrar();
        }else{
                $("#detallePlanMantenimiento").css({'display':'block'});
                mostrar();
        }
        $('html,body').animate({
        scrollTop: $("#formPlanMantenimiento").offset().top
    }, 2000);
        
        $("#formPlanMantenimiento input").removeAttr('readonly');
        $("#formPlanMantenimiento textarea").removeAttr('readonly');
        $estado="modificar";
        
        $("#btnNuevoVehiculo").css({'display':'none'});
        $("#btnModificarVehiculo").css({'display':'block'});
        $("#listaTipos").css({'display':'none'});
                        
        
}

function nuevo(){
        
        if($("#detallePlanMantenimiento").is(':visible')){
                cleanForm("#formPlanMantenimiento");     
        }else{
                //mostrarDetalles();
                $("#detallePlanMantenimiento").css({'display':'block'});
                $("#btnDetalles").css({'display':'none'});
        }
        $('html,body').animate({
        scrollTop: $("#formPlanMantenimiento").offset().top
    }, 2000);
        $("#formPlanMantenimiento input").removeAttr('readonly');
        $("#formPlanMantenimiento textarea").removeAttr('readonly');
        $("#btnModificarVehiculo").css({'display':'none'});
        $("#btnNuevoVehiculo").css({'display':'block'});
        $("#listaTipos").css({'display':'block'});
        $("#tipo").focus();
        $estado="nuevo";
        
}

///////////--------FIN FUNCIONES








//////////----------POPUP MENU

 $("#tablaPlanMantenimiento").bind("contextmenu", function(e){
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

            borrar();
        break;
        case "nuevo":
            if($estado=="nuevo"){
            if(confirm("Los datos se perderan ¿desea continuar?")){
            nuevo();
            }
            }else{
            nuevo();

            }
        break;
        case "modificar":
            if($estado=="nuevo"){
            if(confirm("Los datos se perderan ¿desea continuar?")){
            modificar();
            }
            }else{
            modificar();                                                                  
            }

        break;
    }

});
                        
///////////-------- FIN POUP MENU


</script>


 

  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
