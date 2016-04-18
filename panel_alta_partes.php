
<div id="panel_alta_partes">
<h1>Descripcion</h1>
<form id="formAltaPartes" class="dataform">

<li><label>Tipo</label></li>
<li><select id="tipoParte">
<option>Componentes</option>
<option>Documentacion</option>
<option>Accesorios</option>
<option>Lubricantes</option>
<option>Filtros</option>
<option>Cubiertas</option>
<option>Seguridad</option>
</select></li>

<li><label>Nombre</label></li>
<li><input id="nombreParte" type="text" /></li>
<li><label>Descripcion:</label></li>
<li><textarea id="descripcionParte" cols="40" rows="5"></textarea></li>

<li> <button id="btnSubmitParte" type="submit">Agregar</button></li>
</form>
</div>

<div id="prueba">
</div>
<script>


var tipoParte="";
var idParte="";

$(document).ready(function(e) {
	if(sessionStorage.getItem("idParte")!=null){
		sendAjaxJson({tarea:'getPartes','idparte':sessionStorage.getItem("idParte")},function(data){
			idParte=sessionStorage.getItem("idParte");
			sessionStorage.removeItem("idParte");
			tipoParte=data.tipo;
			agregarCampo();
			$("#nombreParte").val(data.nombre);
			$("#tipoParte").val(data.tipo);
			$("#descripcionParte").val(data.descripcion);
			$("#especificacionesParte").val(data.especificaciones);
			$("#fechaFin").val(data.fechaVencimiento);
			$("#kmColocacion").val(data.kmInicial);
			$("#kmVencimiento").val(data.kmFinal);
			
		});
	}else{
		tipoParte=$("#tipoParte").val();
	}
    if(sessionStorage.getItem("operacion")=="mostrar"){
		$('#btnSubmitParte').css('display','none');
		$("#tipoParte").prop("disabled", true);
	}else if(sessionStorage.getItem("operacion")=="nuevo"){
		$('#btnSubmitParte').css('display','block');
	}else if(sessionStorage.getItem("operacion")=="actualizarParte"){
		$('#btnSubmitParte').css('display','block');
	}else if(sessionStorage.getItem("operacion")=="modificar"){
		$('#btnSubmitParte').css('display','block');
		$("#btnSubmitParte").text("Modificar");
		$("#tipoParte").prop("disabled", true);
	}
	
	
	
	$("#tipoParte").on("change",function(){
	tipoParte=$("#tipoParte").val();
	$("#formAltaPartes input").each(function(index, element) {
        $(this).val("");
		;	
    });
	
	$("#formAltaPartes textarea").each(function(index, element) {
        $(this).val("");
    });
	agregarCampo();
	
});
	agregarCampo();	
});

$("#formAltaPartes").on("submit",this,function(e){
	e.preventDefault();
	if(sessionStorage.getItem("operacion")=="nuevo"){
		if(tipoParte=='Accesorios'){
			var nombre=$("#nombreParte").val();
			var descripcion=$("#descripcionParte").val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:null,descripcion:descripcion,especificaciones:null};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}else if(tipoParte=='Documentacion'){
			var nombre=$("#nombreParte").val();
			var fechaFin=$("#fechaFin").val();
			var descripcion=$("#descripcionParte").val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:null};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}else if(tipoParte=='Componentes'){
			var nombre=$("#nombreParte").val();
			var descripcion=$("#descripcionParte").val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:null,descripcion:descripcion,especificaciones:null};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}else if(tipoParte=='Lubricantes'){
			var nombre=$("#nombreParte").val();
			var descripcion=$("#descripcionParte").val();
			var especificaciones=$('#especificacionesParte').val();
			var kmColocacion=$('#kmColocacion').val();
			var kmVencimiento=$('#kmVencimiento').val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:kmColocacion,kmFinal:kmVencimiento,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:especificaciones};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}else if(tipoParte=='Filtros'){
			var nombre=$("#nombreParte").val();
			var descripcion=$("#descripcionParte").val();
			var especificaciones=$('#especificacionesParte').val();
			var kmColocacion=$('#kmColocacion').val();
			var kmVencimiento=$('#kmVencimiento').val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:kmColocacion,kmFinal:kmVencimiento,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:especificaciones};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}else if(tipoParte=='Seguridad'){
			var nombre=$("#nombreParte").val();
			var fechaFin=$("#fechaFin").val();
			var descripcion=$("#descripcionParte").val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:null,kmFinal:null,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:null};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}else if(tipoParte=='Cubiertas'){
			var nombre=$("#nombreParte").val();
			var descripcion=$("#descripcionParte").val();
			var especificaciones=$('#especificacionesParte').val();
			var kmColocacion=$('#kmColocacion').val();
			var kmVencimiento=$('#kmVencimiento').val();
			var datos={tarea:'altaPartesVehiculo',padre:null,vehiculo:$vehiculoActual,nombre:nombre,tipo:tipoParte,kmInicial:kmColocacion,kmFinal:kmVencimiento,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:especificaciones};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
		}
	}else if(sessionStorage.getItem("operacion")=="modificar"){
			var nombre=$("#nombreParte").val();
			var descripcion=$("#descripcionParte").val();
			var especificaciones=$('#especificacionesParte').val();
			var kmColocacion=$('#kmColocacion').val();
			var fechaFin=$("#fechaFin").val();
			var kmVencimiento=$('#kmVencimiento').val();
			var datos={tarea:'modificarPartesVehiculo',idParte:idParte,nombre:nombre,kmInicial:kmColocacion,kmFinal:kmVencimiento,fechaInicio:null,fechaFin:fechaFin,descripcion:descripcion,especificaciones:especificaciones};
			sendAjaxHtml(datos,function(datos){
				cerrarModalPartes();
			});
	}
	
	
});




function agregarCampo(){
	
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






</script> 
<div class="modalWait"><!-- Place at bottom of page --></div>