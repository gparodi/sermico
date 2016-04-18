// JavaScript Document


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
	}
	});
	
}

function loadTableFromDb(table,task,attr1,attr2,attr3){
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
		$(table + " > tbody:last").append(response);
		
		// Change the selector if needed
		var $table = $('table.scroll'),
			$bodyCells = $table.find('tbody tr:first').children(),
			colWidth;
		
		
		

	},
	error: function(){
	}
	});
}

function loadTable(table,task,attr1,attr2,attr3){
    
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
	}
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
	}
	});

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



