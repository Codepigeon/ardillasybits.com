<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("incluidos/funciones.php");

$titulo_actual = "Ardillas y bits - Colate a cursos"; //establece el <title> de la pagina
$zona = "colaCursos"; //explicado en cabecera.php
include("incluidos/cabecera.php");

//defino variables porsiacaso...
$facultad = $curso = $profe = $city = null;

//verifico siempre que sea tipo NUMERO, facultad
if(isset($_GET["facultad"]) && is_numeric($_GET["facultad"]))
{
    $facultad = $_GET["facultad"];
}

//curso
if(isset($_GET["curso"]) && is_numeric($_GET["curso"]))
{
    $curso = $_GET["curso"];
}

//profesor
if(isset($_GET["profe"]))
{
    $profe = $_GET["profe"];
}

if(isset($_GET["city"]) && is_numeric($_GET["city"]))
{
    $city = $_GET["city"];
}
?>

<!-- inicio el formulario, notese que estoy pasando las variables como GET -->
<form name="theForm" method="get">

<div id="principal">
	<p><h2>Búsqueda de horarios por curso y profesor.</h2></p>
<div class="bloque">
		<p id="primer">
    <!-- seleccion de facultad -->
<?php
$sql_facultades = "SELECT idfacultades, nombre FROM facultades";
$query_facultades = mysql_query($sql_facultades);
?>
    
    <select name="facultad" onChange="autoSubmit();">
        <option value="null">Selecciona una facultad</option>
<?php
while($facultades = mysql_fetch_array($query_facultades)) {
?>
<option value="<?php echo $facultades[idfacultades] ?>" <?php if($facultad == $facultades[idfacultades]) echo "SELECTED" ?>><?php echo $facultades[nombre] ?></option>
<?php
}
?>
    </select>
<!-- FIN DE SELECCION DE FACULTAD -->

    <br><br>

    <!-- seleccion de curso basado en facultad -->      
    <?php    
    if($facultad != null && is_numeric($facultad))
    {
    ?>   
    <select name="curso" onChange="autoSubmit();">        
        <option value="null">Selecciona un curso</option>     
        <?php      
	$sql_cursos = "SELECT idcursos, nombre, facultades_idfacultades FROM cursos WHERE facultades_idfacultades=".$facultad."";
	$query_cursos = mysql_query($sql_cursos);

        while($resultado_cursos = mysql_fetch_array($query_cursos))
        {        
            echo ("<option value='$resultado_cursos[idcursos]'  " . ($curso == $resultado_cursos[idcursos] ? 'SELECTED' : '') . ">".$resultado_cursos[nombre]."</option>");        
        }        
        ?>        
    </select> 
    <?php   
    }    
    ?>

<!-- FIN SELECCION DE CURSO BASADO EN FACULTAD -->

    <br><br>
 
<!-- seleccion de profesor basado en CURSO -->   
    <?php
    if($curso != null && is_numeric($curso) && $facultad != null)
    {  
    ?>   
    <select name="profe" onChange="autoSubmit();">
        <option value="null">Selecciona un profesor</option>
        
        <?php       
	$sql_profes = "SELECT DISTINCT profe FROM horarios WHERE cursos_idcursos=".$curso."";
	$query_profes = mysql_query($sql_profes);

        while($resultado_profes = mysql_fetch_array($query_profes))
        {
            echo ("<option value='$resultado_profes[profe]' " . ($profe == $resultado_profes[profe] ? ' SELECTED' : '') . ">".$resultado_profes[profe]."</option>");        
        }        
        ?>           
    </select>   
    <?php  
    }   
    ?>
<!-- FIN DE SELECCION DE PROFESOR BASADO EN CURSO -->

<!-- muestro la informacion -->
    <br><br>
    
    <?php
if($profe != null  && $facultad != null && $curso != null) {
echo '<a href="colaCursos.php">BORRAR</a><br>';

//SE INSERTA BUSQUEDA A LA BASE DE DATOS...
$ua = getBrowser();
$ipreal = ipReal();
$profe = mysql_real_escape_string($profe);
$insertar = "INSERT INTO busquedascursos (facultades_idfacultades,ip,browser,versionBrowser,so,time, profesor, cursos_idcursos) VALUES (".$facultad.",'".$ipreal."','".$ua[name]."','".$ua[version]."','".$ua[platform]."',NOW(), '".$profe."', ".$curso.")";
$query_insertar = mysql_query($insertar) or die(mysql_error());

	$sql_profes_2 = "SELECT * FROM horarios WHERE profe='".$profe."' AND cursos_idcursos=".$curso."";
	$query_profes_2 = mysql_query($sql_profes_2);

	echo "<br><b>Profesor: " . $profe . "</b><br><br>";
	echo "<b>Horarios:</b><br>";
	while($profes_2 = mysql_fetch_array($query_profes_2)) {
	echo "<b>".$profes_2[horario] . "</b> => " . $profes_2[hora] . "<br>";
	}
}
?>

</p>
</div>
</div>
<?php
include("incluidos/pie.php");
?>
