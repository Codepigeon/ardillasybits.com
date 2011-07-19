<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Herramientas para la matrícula</title>
<link rel="stylesheet" type="text/css" media="all" href="style.css" />

<script type="text/javascript"> 
	function buscador(){ 
	   var actual;
	   actual = codigo.options[codigo.selectedIndex].value;
		document.formsito.codigo.value = actual;	
	}
</script> 

</head>
<body>

<div id="encabezado">
<div id="logo">
	<h1><a href="index.html"></a></h1>
</div>
	<div id="contenedor_menu">
		<ul id="menu">
			<li><a title="Arma tu horario" href="horarios.php">Horarios</a></li>
			<li><a title="Descarga material de estudio" href="repo.php">Material</a></li>
			<li><a title="Busca personas" href="escribe.php">Personas</a></li>
			<li><a title="Entra a otros cursos" href="cursos.php">Cursos</a></li>
			<li><a href="acercade.php">Acerca de</a></li>
		</ul>
	</div>
</div>
<div id="principal">

<form name='formsito' action='' method='post'>
<br>
Código a buscar: <input type='textbox' name='codigo' size='10'> <input type='submit' name='buscar' value='Buscar'>

<br>
<br>
<a href='busqueda_horarios.php'><font size='2'>¿Quieres colarte a alguna clase?</a> [BETA]</font><br>
<br>
<font size='1'><a href='busqueda_simple.php?modo=1'>[Activa la busqueda no tan simple de personas (BETA)]</a></font>
<br>
<font size='1'>Si no estás matriculado en alguno de esos cursos o no quieres que tu nombrea aparesca, enviame un mensaje personal y  tu información será completamente removida.</font>
<br>
<br>
<b>Total de busquedas hasta ahora: </b> 9706<br>

<br>
<font size='2'>Aburrido de buscar a personas? Relajate con este juego creado dentro de los calabozos de ardillasybits! : <a href='http://codemonkey.ardillasybits.com/cuerditas.php' target='_blank'>Cuerditas</a></font>
<br>
<br>

<a href='index.php'>Regresar</a></form>


</div>
<div id="pie">
	<p>Ardillas y bits© todos los izquierdos y la mayoría de derechos reservados. Cada vez que usas IE Dios mata una ardillita OMG!.</p>
</div>

</body>
</html>