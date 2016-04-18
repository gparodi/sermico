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
<table id="tablaPlanMantenimiento"><thead>
    <th>ID</th><th>Titulo</th><th>Km</th><th>Horas</th><th>Dias</th>
    <th>Meses</th><th>Años</th><th>Descripcion</th><th>Estado</th>
   </thead><tbody>
    
    </tbody>    
</table>
<div id="prueba"></div>
<button id="btnDetalles" style="display:none"> Ver detalles </button>
<button id="btnEjecutar" style="display:none"> Ejecutar plan </button>

<div  id="detallePlanMantenimiento" style="display:none">
<form id="formPlanMantenimiento" >

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


<h2>Alertas</h2>

<li><label>Km antes:</label>
<input type="text" id="kmAntes" /></li>

<li><label>Horas antes:</label>
<input type="text" id="horasAntes" /></li>

<li><label>Dias antes:</label>
<input type="text" id="diasAntes" /></li>

<li><label>Meses antes:</label>
<input type="text" id="mesesAntes" /></li>

<h3>Lista de mails para distribucion de alertas</h3><p id="leyendaAlertas" style="display:none">Por favor escriba lo mails separados por ;</p>
<li><textarea id="listaMails" cols="40" rows="5"></textarea></li>

<li><button id="btnAltaPlan" type="submit" style="display:none">Aceptar</button></li>
</form>

<div id="detallesVehiculos">
<h2>Vehiculos incluidos en el plan de mantenimiento</h2>
<table id="tablaVehiculosEnPlan"><thead>
    <th>Numero</th><th>Marca</th><th>Modelo</th><th>Año</th>
   </thead><tbody></tbody>

</table>

<h2>Tareas de plan de mantenimiento</h2>
<table id="tablaTareasPorPlan"><thead>
    <th>ID</th><th>Titulo</th><th>Operacion</th><th>Descripcion</th>
    </thead><tbody></tbody>

</table>


</div>

</div>

<!-- MODALS	-->
<div id="menuPopVehiculosPorPlan" class="menuPopUp" style="display:none">
      <ul>
            <li id="modificar">Modificar</li>
            
        </ul>
</div>

<div id="vehiculosPorPlan_Modal">
 	
</div>


<div id="menuPopPlanMantenimiento" class="menuPopUp" style="display:none">
      <ul>
            <li id="modificar">Modificar</li>
            <li id="nuevo">Nuevo</li>
        </ul>
</div>


<div id="menuPopTareasPorPlan" class="menuPopUp" style="display:none">
      <ul>
            <li id="modificar">Modificar</li>
        </ul>
</div>

<div id="tareasPorPlan_Modal">
 	
</div>






 <script>
var $planActual;
var $estado="";
var estadoModal;


$(document).ready(function(e) {
	
	
	var user=window.sessionStorage.getItem('user_name');
	var perfil=window.sessionStorage.getItem(user);
	//COMPARA CON EL ID DE LA VENTANA...SI ES CORRECTO LO DEJA ENTRAR
	var permiso=perfil&16;
	if(permiso==0){
		window.stop();
		alert("No tiene permisos para acceder a esta funcion");
		window.history.back();
	}

	
	
	
	//CARGA LA TABLA DE PLANES DE MANTENIMIENTO
    loadTableFromDb("#tablaPlanMantenimiento","listarPlanDeMantenimiento");
	//EVENTO AL HACER CLICK EN UNA FILA. TOMA EL PLAN ACTUAL COMO EL ID DE LA FILA
	$('#tablaPlanMantenimiento').not("first").on( 'click', 'td', function (e) {
    var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	$('tr.seleccionFila:first').removeClass("seleccionFila");
   	$(this).closest("tr").addClass("seleccionFila");
    jQuery.each($columns, function(i, item) {
        if(i==0){
            $planActual=item.innerHTML;
			//localStorage['planActual']=$planActual;
        }

 	});
	//MOSTRAR BOTON
	$("#btnDetalles").css("display","block");
	mostrarDetalles();
	
	});
 	//EVENTO AL HACER CLICK EN DETALLES
 	$("#btnDetalles").on("click",this,function(){
		if($planActual!=null&&$planActual!=0){
			if(!$("#detallePlanMantenimiento").is(":visible")){
				$("#btnDetalles").text("Ocultar detalle");
				$("#detallePlanMantenimiento").css({'display':'block'});
			 	
			}else{
				$("#btnDetalles").text("Ver detalles");
				$("#detallePlanMantenimiento").css({'display':'none'});
			}
			mostrarDetalles();
		}   
        
});


function mostrarDetalles(){
        if($("#detallePlanMantenimiento").is(":visible")){
                
        	mostrar();
      
        }
}


function mostrar(){
	
        if($planActual!=0){
			$("#detallesVehiculos").css("display","block");
			$('html,body').animate({
        	scrollTop: $("#detallePlanMantenimiento").offset().top}, 2000);
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
				$("#kmAntes").val(plan.kmAntes);
				$("#diasAntes").val(plan.diasAntes);
				$("#horasAntes").val(plan.horasAntes);
				$("#mesesAntes").val(plan.mesesAntes);
				$("#listaMails").val(plan.listaMails);
                loadTableFromDb("#tablaVehiculosEnPlan","listarVehiculosPorPlanDeMantenimiento",$planActual);
				loadTableFromDb("#tablaTareasPorPlan","listar_tareas_por_planmantenimiento",$planActual);
			            
         	});
			
				
        }
        
        
}

function nuevoPlan(){
        if($estado=="nuevo"){
			if($("#detallePlanMantenimiento").is(':visible')){
					cleanForm("#formPlanMantenimiento");     
			}else{
					//mostrarDetalles();
					$("#detallePlanMantenimiento").css({'display':'block'});
					$("#btnDetalles").css({'display':'none'});
					cleanForm("#formPlanMantenimiento");
			}
		}else{
			if($("#detallePlanMantenimiento").is(':visible')){
				mostrarDetalles();    
			}else{
					//mostrarDetalles();
					$("#detallePlanMantenimiento").css({'display':'block'});
					$("#btnDetalles").css({'display':'none'});
					mostrarDetalles();
					
			}
			
		}
		$("#leyendaAlertas").css("display","block");
        $('html,body').animate({
        scrollTop: $("#formPlanMantenimiento").offset().top
    }, 2000);
		$("#detallesVehiculos").css("display","none");
        $("#formPlanMantenimiento input").removeAttr('readonly');
        $("#formPlanMantenimiento textarea").removeAttr('readonly');
		$("#btnAltaPlan").css("display","block");

        
}

//ALTA NUEVO/MODIFICAR PLAN DE MANTENIMIENTO
$("#formPlanMantenimiento").on("submit",this,function(e){
    var datos;
    e.preventDefault();
	
	var km=$("#km").val();
	var titulo=$("#titulo").val();
	var estado=$("#estado").val();
	var horas=$("#horas").val();
	var dias=$("#dias").val();
	var meses=$("#meses").val();
	var años=$("#años").val();
	var descripcion=$("#descripcion").val();
	
	//ALERTAS
	
	var kmAntes=$("#kmAntes").val();
	var diasAntes=$("#diasAntes").val();
	var mesesAntes=$("#mesesAntes").val();
	var horasAntes=$("#horasAntes").val();
	var listaMails=$("#listaMails").val();
	
        
    if($estado=="nuevo"){
		datos={tarea:"altaPlanMantenimiento",titulo:titulo,estado:estado,km:km,horas:horas,dias:dias,meses:meses,años:años,descripcion:descripcion,kmAntes:kmAntes,diasAntes:diasAntes,mesesAntes:mesesAntes,horasAntes:horasAntes,listaMails:listaMails};      
    }else if($estado=="modificar"){
        datos={tarea:"modificarPlanMantenimiento",idPlan:$planActual,titulo:titulo,estado:estado,km:km,horas:horas,dias:dias,meses:meses,años:años,descripcion:descripcion,kmAntes:kmAntes,diasAntes:diasAntes,mesesAntes:mesesAntes,horasAntes:horasAntes,listaMails:listaMails};
    }
    sendAjaxHtml(datos,function(dato){
		alert("El plan fue creado con exito");
		loadTableFromDb("#tablaPlanMantenimiento","listarPlanDeMantenimiento");
		$planActual=dato;
		mostrarDetalles();
        //$(location).attr('href','vehiculos.php');
        //$("#prueba").empty();
        //$("#prueba").append(dato);
        //loadTableFromDb("#tablaPlanMantenimiento","cargarTablaVehiculos",$("#comboBoxFiltro").val());
        //cleanForm("#formPlanMantenimiento");
        
                
    });
	
	
        
        
}); 




///////////--------FIN EVENTOS






/////////////////////_______________________________________________________________
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



///////////--------FIN FUNCIONES








//////////----------POPUP MENU PLAN VEHICULOS

 $("#tablaVehiculosEnPlan").bind("contextmenu", function(e){
    $("#menuPopVehiculosPorPlan").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
     return false;
 });
 
 //cuando hagamos click, el menú desaparecerá
$(document).click(function(e){
    if(e.button == 0){
        $("#menuPopVehiculosPorPlan").css({'display':'none'});
    }
});
             
//si pulsamos escape, el menú desaparecerá
$(document).keydown(function(e){
    if(e.keyCode == 27){
        $("#menuPopVehiculosPorPlan").css({'display':'none'});
    }
});

//controlamos los botones del menú
$("#menuPopVehiculosPorPlan").click(function(e){

    // El switch utiliza los IDs de los <li> del menú
    switch(e.target.id){

        
        case "modificar":
            modificarVehiculosPorPlan()
        break;
    }

});
                        
///////////-------- FIN POUP MENU





//////////----------POPUP MENU PLAN MANTEMIENTO

 $("#tablaPlanMantenimiento").bind("contextmenu", function(e){
    $("#menuPopPlanMantenimiento").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
     return false;
 });
 
 //cuando hagamos click, el menú desaparecerá
$(document).click(function(e){
    if(e.button == 0){
        $("#menuPopPlanMantenimiento").css({'display':'none'});
    }
});
             
//si pulsamos escape, el menú desaparecerá
$(document).keydown(function(e){
    if(e.keyCode == 27){
        $("#menuPopPlanMantenimiento").css({'display':'none'});
    }
});

//controlamos los botones del menú
$("#menuPopPlanMantenimiento").click(function(e){

    // El switch utiliza los IDs de los <li> del menú
    switch(e.target.id){
		case "eliminar":
	
        borrarVehiculo();
        break;
		case "nuevo":
			$estado="nuevo";
			nuevoPlan();
			/*
			if($estado=="nuevo"){
			  if(confirm("Los datos se perderan ¿desea continuar?")){
              	nuevoPlan();
			  }
			  }else{
				  	$estado=="nuevo";
					nuevoPlan();
								  
				}*/
              break;
			case "modificar":
				$estado="modificar";
				nuevoPlan();
                              
                break;
                  		
    }

});
                        
///////////-------- FIN POUP MENU




//////////----------POPUP MENU TAREAS

 $("#tablaTareasPorPlan").bind("contextmenu", function(e){
    $("#menuPopTareasPorPlan").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
     return false;
 });
 
 //cuando hagamos click, el menú desaparecerá
$(document).click(function(e){
    if(e.button == 0){
        $("#menuPopTareasPorPlan").css({'display':'none'});
    }
});
             
//si pulsamos escape, el menú desaparecerá
$(document).keydown(function(e){
    if(e.keyCode == 27){
        $("#menuPopTareasPorPlan").css({'display':'none'});
    }
});

//controlamos los botones del menú
$("#menuPopTareasPorPlan").click(function(e){

    // El switch utiliza los IDs de los <li> del menú
    switch(e.target.id){

        
        case "modificar":
            modificarTareasPorPlan()
        break;
    }

});
                        
///////////-------- FIN POUP MENU



////////////-----------FUNCIONES ---------------////////


function modificarVehiculosPorPlan(){
	$('#vehiculosPorPlan_Modal').load('panel_vehiculos_planmantenimiento.php');
		 $('#vehiculosPorPlan_Modal').dialog({
			 resizable: false,
			  height:500,
			  width:900,
			  modal: true,
			  close: function(e,ui){
				  loadTableFromDb("#tablaVehiculosEnPlan","listarVehiculosPorPlanDeMantenimiento",$planActual);
				  
			  }
      		
    	});
		
}

function modificarTareasPorPlan(){
	$('#tareasPorPlan_Modal').load('panel_tareas.php');
		 $('#tareasPorPlan_Modal').dialog({
			 resizable: false,
			  height:500,
			  width:900,
			  modal: true,
			  close: function(e,ui){
					loadTableFromDb("#tablaTareasPorPlan","listar_tareas_por_planmantenimiento",$planActual);
			  }
      		
    	});
		
}

function cerrarModalTareas(){
	$("#tareasPorPlan_Modal").dialog("close");
}
function cerrarModal(){
	$("#vehiculosPorPlan_Modal").dialog("close");	
	
}

});
</script>


 

  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
