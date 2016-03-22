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
  
<span>Vehiculo
<select id="comboBoxVechiculoViajes">Vehiculo: </select>

</span>  
  







<div id="formularioAltaViaje">

 
 <form id="formAltaViaje" action="" title="" method="post">
        <li>
            <label class="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" required="required" >
        </li>
        <li>
            <label class="titulo">Destino</label>
            <input type="text" name="destino" id="destino" required="required" >
        </li>
        <li>
            <label class="titulo">Fecha de Partida</label>
            <input type="date" id="fechaPartida" name="fechaPartida" required="required"  />
            <label class="titulo">Hora</label> <input type="time" name="horaPartida" />
        </li>
        <li>
            <label class="titulo">Fecha de Regreso</label>
            <input type="date" id="fechaRegreso" name="fechaRegreso" required="required"/>
            <label class="titulo">Hora</label> <input type="time" name="horaRegreso" />
        </li>
        <li>
            <input type="submit" id="submitAltaViaje"  name="submitViajeButton" value="Agregar viaje">
        </li>
 </form>
 
 </div>


<script>
$vehiculoActual=0;

$(document).ready(function(e) {
    


loadComboFromDB("#comboBoxVechiculoViajes","cargarComboBoxVehiculos");

var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

$('#fechaPartida').val(today);
$('#fechaRegreso').val(today);


$("#formAltaViaje").on("submit",this,function(e){
   	e.preventDefault();
	
	/*
	var data = {tarea:"altaViaje"};
    var Form = this;

    //Gathering the Data
    //and removing undefined keys(buttons)
	
    $.each(this.elements, function(i, v){
            var input = $(v);
        data[input.attr("name")] = input.val();
        delete data["undefined"];
    });
	var formData =JSON.stringify(data);
	var dato=JSON.parse(formData);*/
	var $titulo=$("#titulo").val();
	
	var datos={tarea:"altaViaje",titulo:$titulo};	
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'html',
	data: datos,
	timeout:1000,
	success: function(data, textStatus, jqXHR) {
		alert(data);
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});
	
	//$(location).attr('href','alta_historial_viajes.php');
	
	
	
});

 


});

</script>

<!--
$("#tablas").on("click", ".add", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$("#mitabla2").append(values);
});

  
  <!--
deleteRow("#mitabla1","#mitabla2",".delete","#tablas");
addRowAtTableOnClick("#tablas","#mitabla",".add");
-->
  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
