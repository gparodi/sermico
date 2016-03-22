// JavaScript Document
function getDbId(div,tabla){
$(document).ready(function() {

		$(div).on("click",tabla,function() {
			var celda = $('td:first', $(this).parents('tr')).text();
			alert(celda);
		});
	
	});

}

function sendAjaxHtml(datos,callBack){
	var respuesta="";
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	timeout:8000,
	dataType:"html",
	data: datos,
	success: function(response){
		callBack(response);	
		
	},
	error: function(jqXHR, textStatus, errorThrown){
	alert(textStatus);
	}
	});
}

function sendAjaxJson(datos,callBack){
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"json",
	data: datos,
	success: function(response){
		callBack(response);	
		
	},
	error: function(jqXHR, textStatus, errorThrown){
	alert(textStatus);
	}
	});
	
}

function loadTableFromDb(table,task,attr1,attr2,attr3){
	$(document).ready(function(e) {    
    
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:task,atributo1:attr1,atributo2:attr2,atributo3:attr3},
	success: function(response) {
		
		$(table +" tr").each(function(index, element) {
            if(index!=0){
				$(this).remove();
			}
        });
		var tabla=table+" tr:last";
		$(table + " > tbody:last").append(response);
	},
	error: function(){
	alert('Error!');
	}
	});
});
}

function loadTable(table,task,attr1,attr2,attr3){
	$(document).ready(function(e) {    
    
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:task,atributo1:attr1,atributo2:attr2,atributo3:attr3},
	success: function(response) {
		//$(table+'tr').remove();
		$(table).after(response);
	},
	error: function(){
	alert('Error!');
	}
	});
});
}



function loadComboFromDB(idComboBox,task,callBackFunction){
        
    
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:task},
	success: function(response) {
		$(idComboBox).html(response);
		callBackFunction();
	},
	error: function(){
	alert('Error en combo');
	}
	});

}

function loadComboFromDBWithType(idComboBox,task,type,callBackFunction){
        
    
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:task,tipo:type},
	success: function(response) {
		$(idComboBox).html(response);
		callBackFunction();
	},
	error: function(){
	alert('Error en combo');
	}
	});

}


function loadParts(tabla,id){
	
}

function addRowAtTableOnClick(div,table,btnId){
$(div).on("click", btnId, function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$(table).append(values);
});
}

function addRowAtTable(div,table){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$(table).append(values);
}

function deleteRow(table1Id,table2Id,btnId,div){

$(table2Id).on("click",btnId, function(){
	$(this).closest ('tr').remove ();
});

}


function cleanForm(formId){
	$(formId).each(function(index, element) {
            this.reset();
        });
}


function setValues(formId){
$(document).ready(function(e) {
        
    
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: $(formId).serialize(),
	success: function(response) {
		$(idComboBox).html(response);
	},
	error: function(){
	alert('Error en combo');
	}
	});
});	
}
