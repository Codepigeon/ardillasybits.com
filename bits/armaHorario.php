<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("incluidos/funciones.php");

$titulo_actual = "Ardillas y bits - Arma tu Horario"; //establece el <title> de la pagina
$zona = "armaHorario"; //explicado en cabecera.php
include("incluidos/cabecera.php");
?>

<div id="principal">
	<p><h2>Se viene la matrícula y con ella los dolores de cabeza para tener el horario adecuado. Aquí encontrarás las herramientas para tener tu horario listo en unos cuantos minutos y sin problemas.</h2></p>
<div class="bloque">
		<p id="primer">Decide bien los cursos que quieres llevar y haz una lista de todas tus actividades extracurriculares (academia, inglés, etc).</p>
</div>
<div class="bloque">
		<p id="segundo">Entra al <a href="horarios.php">constructor de horarios</a> e ingresa aquellos cursos que consideres fijos en tu horario.</p>
</div>
<div class="bloque">
		<p id="tercero">Deja que el constructor complete tu horario con los cursos que mejor se acomoden. Puedes modificarlo como quieras, agregar nuevos cursos, actividades extra, tiempos muertos y más.</p>
</div>
<div class="enlace"><a href="horarios.php">Armar tu horario fácil.</a></div></div>
<?php
include("incluidos/pie.php");
?>
