



<?php

switch($_POST["tarea"]){ 
case 'cargar_tabla': cargarTabla();
		break;
}

function cargarTabla(){
	
	$link = @mysql_connect("localhost", "root","1234")
		  or die ("Error al conectar a la base de datos.");
	  @mysql_select_db("control_vehiculos", $link)
		  or die ("Error al conectar a la base de datos.");
	
	  $query = "CALL listar_vehiculos()";
	  $result = mysql_query($query);
	  $numero = 0;
	   echo "<table class=\"tablas_vista_gral\"><tr>
<td><font face=\"verdana\"><b>Numero</b></font></td>
<td><font face=\"verdana\"><b>Marca</b></font></td>
<td><font face=\"verdana\"><b>Modelo</b></font></td>
<td><font face=\"verdana\"><b>Patente</b></font></td>
<td><font face=\"verdana\"><b>Año</b></font></td>
<td><font face=\"verdana\"><b>Tipo</b></font></td>
<td><font face=\"verdana\"><b>Kilometros</b></font></td>
<td><font face=\"verdana\"><b>Estado</b></font></td>
</tr>";	
	   
	while($row = mysql_fetch_array($result))
	  {
		echo "<tr><td width=\"25%\"><font face=\"verdana\">" . 
			$row["numero"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["marca"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["modelo"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["patente"]. "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["año"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["tipo"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["kilometros"] . "</font></td>";
		echo "<td width=\"25%\"><font face=\"verdana\">" . 
			$row["estado"] . "</font></td></tr>";
		
		
		$numero++;
	  }
	 
	  echo "</table>";
	  mysql_free_result($result);
	  mysql_close($link);
	  return;
}

?>

</table>