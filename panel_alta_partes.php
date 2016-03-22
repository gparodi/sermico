
<h2>Descripcion de parte</h2>
<form id="formAltaPartes" action="" title="" method="post">

<li><label>Tipo:</label>
<select id="tipoParte">
<option>Componentes</option>
<option>Documentacion</option>
<option>Accesorios</option>

<option>Lubricantes</option>
<option>Filtros</option>
<option>Cubiertas</option>
<option>Seguridad</option>
</select></li>
<li><label>Nombre:</label>
<input id="nombreParte" type="text" /></li>
<li><label>Descripcion:</label></li>
<li><textarea id="descripcionParte" cols="40" rows="5"></textarea>

<li> <button id="submitParte" type="submit">Agregar</button> 
</form></li>

<div id="prueba">
</div>
<script>
var tipoParte=$("#tipoParte").val();

$(document).ready(function(e) {
    if($estadoModal=="mostrar"){
		$('#submitParte').css('display','none');	
	}else{
		$('#submitParte').css('display','block');
	}
});

$("#formAltaPartes").on("submit",this,function(e){
	e.preventDefault();
	if(tipoParte=='Accesorios'){
		var nombre=$("#nombreParte").val();
		var descripcion=$("#descripcionParte").val();
		var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:null,descripcion:descripcion,especificaciones:null};
		sendAjaxHtml(datos,function(datos){
			cerrarModalPartes()
		});
	}else if(tipoParte=='Documentacion'){
		var nombre=$("#nombreParte").val();
		var fechaFin=$("#fechaFin").val();
		var descripcion=$("#descripcionParte").val();
		var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:null};
		sendAjaxHtml(datos,function(datos){
			cerrarModalPartes()
		});
	}else if(tipoParte=='Componentes'){
		var nombre=$("#nombreParte").val();
		var descripcion=$("#descripcionParte").val();
		var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:null,descripcion:descripcion,especificaciones:null};
		sendAjaxHtml(datos,function(datos){
			cerrarModalPartes()
		});
	}else if(tipoParte=='Lubricantes'){
		var nombre=$("#nombreParte").val();
		var descripcion=$("#descripcionParte").val();
		var especificaciones=$('#especificacionesParte').val();
		var kmColocacion=$('#kmColocacion').val();
		var kmVencimiento=$('#kmVencimiento').val();
		alert(kmVencimiento);
		var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:kmColocacion,kmFinal:kmVencimiento,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:especificaciones};
		sendAjaxHtml(datos,function(datos){
			cerrarModalPartes()
		});
	}else if(tipoParte=='Filtros'){
		var nombre=$("#nombreParte").val();
		var descripcion=$("#descripcionParte").val();
		var especificaciones=$('#especificacionesParte').val();
		var kmColocacion=$('#kmColocacion').val();
		var kmVencimiento=$('#kmVencimiento').val();
		var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:kmColocacion,kmFinal:kmVencimiento,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:especificaciones};
		sendAjaxHtml(datos,function(datos){
			cerrarModalPartes()
		});
	}else if(tipoParte=='Seguridad'){
		var nombre=$("#nombreParte").val();
		var fechaFin=$("#fechaFin").val();
		var descripcion=$("#descripcionParte").val();
		var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:null};
		sendAjaxHtml(datos,function(datos){
			cerrarModalPartes()
		});
	}
	
	
});

$("#tipoParte").on("change",function()
{
	$("#formAltaPartes input").each(function(index, element) {
        $(this).val("");
    });
	
	$("#formAltaPartes textarea").each(function(index, element) {
        $(this).val("");
    });
	agregarCampo();	
});

function agregarCampo(){
	tipoParte=$("#tipoParte").val();
	var nuevoCampo="";
	
	
	
	if(tipoParte=='Filtros'){
		nuevoCampo+="<li><label class=\"agregado\" >Colocacion (Km):</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmColocacion\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Vencimiento (Km):</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmVencimiento\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Especificaciones:</label></li>";
		nuevoCampo+="<li><textarea id=\"especificacionesParte\" class=\"agregado\" cols=\"40\" rows=\"5\"></textarea> </li>";
		sendAjaxJson({tarea:'getKm',vehiculo:$vehiculoActual},function(dato){
			if(dato!=null){
				$('#kmColocacion').val(dato.km);
				var kmInt=parseInt(dato.km);
				$('#kmVencimiento').val(kmInt+10000);
			}
		});
			
		
	}
	if(tipoParte=='Cubiertas'){
		nuevoCampo+="<li><label class=\"agregado\" >Colocacion (Km):</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmColocacion\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Vencimiento (Km):</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmVencimiento\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Especificaciones:</label></li>";
		nuevoCampo+="<li><textarea id=\"especificacionesParte\" class=\"agregado\" cols=\"40\" rows=\"5\"></textarea></li>";
		sendAjaxJson({tarea:'getKm',vehiculo:$vehiculoActual},function(dato){
			if(dato!=null){
				$('#kmColocacion').val(dato.km);
				var kmInt=parseInt(dato.km);
				$('#kmVencimiento').val(kmInt+50000);
			}
		});
			
		
	}
	if(tipoParte=='Lubricantes'){
		nuevoCampo+="<li><label class=\"agregado\" >Colocacion (Km):</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmColocacion\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Vencimiento (Km):</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmVencimiento\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Especificaciones:</label></li>";
		nuevoCampo+="<li><textarea id=\"especificacionesParte\" class=\"agregado\" cols=\"40\" rows=\"5\"></textarea></li>";
		sendAjaxJson({tarea:'getKm',vehiculo:$vehiculoActual},function(dato){
			if(dato!=null){
				$('#kmColocacion').val(dato.km);
				var kmInt=parseInt(dato.km);
				$('#kmVencimiento').val(kmInt+10000);
			}
		});
			
		
	}
	if(tipoParte=='Documentacion'){
		
		
		nuevoCampo+="<li><label class=\"agregado\" >Fecha de vencimiento:</label>";
		nuevoCampo+="<input type=\"date\" id=\"fechaFin\" class=\"agregado\" required /></li>";
			
		
	}
	if(tipoParte=='Seguridad'){
		
		
		nuevoCampo+="<li><label class=\"agregado\" >Fecha de vencimiento:</label>";
		nuevoCampo+="<input type=\"date\" id=\"fechaFin\" class=\"agregado\" required /></li>";
			
		
	}
	$(".agregado").remove();
	$("#nombreParte").after(nuevoCampo);
	
	var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

$('#fechaInicio').val(today);
$('#fechaFin').val(today);
}



$(window).on("load",this,function(){
	agregarCampo();
	
});




</script> 
<div class="modalWait"><!-- Place at bottom of page --></div>