<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
autoSubmit(); //funcion en javascript para autosubmit de formularios
titulo($titulo_actual);
//la variable $zona contiene la zona donde está actualmente el usuario. 
//zonas posibles: armaHorario, descargaMaterial, buscaPersonas, colaCursos, acercaDe.
//NOTA: TODO: cambiar nombre a las zonas para que sea mas organizado y general.
?>
	<link rel="stylesheet" type="text/css" media="all" href="incluidos/style.css" />
</head>
<body>

<div id="encabezado">
<div id="logo">
	<h1><a href="index.php">Ardillasybits.com</a></h1>
</div>
	<div id="contenedor_menu">
		<ul id="menu">

			<li><a title="Arma tu horario" href="armaHorario.php" <?php if ($zona == "armaHorario") { echo "class='activo'"; } ?>>Horarios</a></li>
			<li><a title="Descarga material de estudio" href="descargaMaterial.php" <?php if ($zona == "descargaMaterial") { echo "class='activo'"; } ?>>Material</a></li>
			<li><a title="Busca personas" href="buscaPersonas.php" <?php if ($zona == "buscaPersonas") { echo "class='activo'"; } ?>>Personas</a></li>
			<li><a title="Entra a otros cursos" href="colaCursos.php" <?php if ($zona == "colaCursos") { echo "class='activo'"; } ?>>Cursos</a></li>
			<li><a href="acercaDe.php" <?php if ($zona == "acercaDe") { echo "class='activo'"; } ?>>Acerca de</a></li>
		</ul>
	</div>
</div>

