<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("incluidos/funciones.php");

$titulo_actual = "Ardillas y bits - Buscador de personas"; //establece el <title> de la pagina
$zona = "buscaPersonas"; //explicado en cabecera.php
include("incluidos/cabecera.php");
?>

<div id="principal">
	<p><h2>Buscador de personas.</h2></p>
<div class="bloque">
		<form name='formsito' action='#' method='post'>
		<p id="primer">Código a buscar: <input type='textbox' name='codigo' size='10'> <input type='submit' name='buscar' value='Buscar'></p>
		</form>
</div>

<?php

if(isset($_POST[buscar]) AND isset($_POST[codigo])) {
$codigo = (int)$_POST[codigo]; //se guarda el CODIGO buscado como numero ENTERO

if($codigo > 1) { //TODO: implementar mejor verificación...

//obtengo datos del usuario que ha buscado...porsiacaso!
$ua = getBrowser();
$ipreal = ipReal();

//guardo la info del usuario en la base de datos...
$basedatos = "INSERT INTO busquedasalumnos (codigoBuscado,ip,browser,versionBrowser,so,time) VALUES (".$codigo.",'".$ipreal."','".$ua[name]."','".$ua[version]."','".$ua[platform]."',NOW())";
$query_basedatos = mysql_query($basedatos) or die(mysql_error());

//se busca el código en la base de datos...
$sql_buscar = "SELECT * FROM alumnos WHERE codigo=".$codigo."";
$query_buscar = mysql_query($sql_buscar) or die(mysql_error());
$query_buscar_2 = mysql_query($sql_buscar) or die(mysql_error());

$resultado = mysql_fetch_array($query_buscar);

 //si el codigo es menor que 1 entonces no se ha devuelto ningun codigo!
if($resultado[codigo]>1) {

//NOTA: MEJORAR ESTO SI O SI
echo "<div class='bloque'>";
echo "<p id='primer'>";

//se genera HTML con información del código devuelto...
echo "<b>Código</b>: " . $resultado[codigo] . "<br><br>";
echo "<b>Nombre</b>: " . $resultado[nombre] . "<br>";
echo "<b>Correo</b>: " . $resultado[correo] . "<br><br>";
echo "<b>Cursos que está llevando</b>: <br>";

$nombre_persona = $resultado[nombre];
$creditos = 0; //número de créditos
$contador = 1; //número de cursos

//se itera sobre el resultado devuelto para leer los cursos...
while($resultado_2 = mysql_fetch_array($query_buscar_2)) {

$horario = $resultado_2[horario];

//se busca información de los horarios de los cursos
$sql_horario = "SELECT * FROM horarios WHERE horario='0".$horario."' AND cursos_idcursos=".$resultado_2[cursos_idcursos]."";
$query_horario = mysql_query($sql_horario);
$resultado_horario = mysql_fetch_array($query_horario);

//se busca el curso en sí...
$sql_curso = "SELECT * FROM cursos WHERE idcursos='".$resultado_2[cursos_idcursos]."' LIMIT 1";
$query_curso = mysql_query($sql_curso) or die(mysql_error());
$resultado_curso = mysql_fetch_array($query_curso);

//se muestra información del  nombre del curso, horario, etc...TODO: mejorar cómo se muestra...
echo "<b>" . $contador . ".</b>" . $resultado_curso[nombre] . "<font size='1'> [" .$resultado_curso[codigo]. "] < ".$resultado_2[horario]." > ".$resultado_horario[profe]." -> ".$resultado_horario[hora]."</font><br>";

//se suman los créditos de cada curso en un contador...y además el número de cursos
$creditos += $resultado_curso[creditos];
$contador++;
}
echo "<br><b>Total de créditos: </b>" . $creditos;

//MEJORAR ESTO SI O SI
echo "</p></div>";

}
//si es que no se ha devuelto un código (<1) entonces se muestra un mensaje de error...
else {
echo mensajeError();
}

}
}

//recogo información sobre el total de busquedas...
$sql_total = "SELECT idbusquedasalumnos AS total FROM busquedasalumnos ORDER BY idbusquedasalumnos DESC LIMIT 1";
$query_total = mysql_query($sql_total);
$total_busquedas = mysql_fetch_array($query_total);
?>
<br><br>
<b>Total de busquedas hasta ahora: </b> <?php echo $total_busquedas[total] ?>

</div>
<?php
include("incluidos/pie.php");
?>
