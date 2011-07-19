<?php
function conectar() { //crea conector a la base de datos! no mires la clave :B
$HOSTNAME = "localhost";//SERVIDOR localhost
$USERNAME = "usuario";	
$PASSWORD = "clave";	
$DATABASE = "basededatos";	

	$idcnx = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD) or DIE(mysql_error());

	mysql_select_db($DATABASE, $idcnx);

	return $idcnx;
}
$cnx = conectar ();
global $cnx;

//autosubmit, usado en colaCursos.php
function autoSubmit() {
echo ("
<script language='JavaScript'>
function autoSubmit()
{
    var formObject = document.forms['theForm'];
    formObject.submit();
}

</script>
");
}

//mensajes de error divertidos...vaya que diversion! si!
function mensajeError() {
$mensajes_error[0] = "<b>Cada ves que te equivocas escribiendo un código, una ardilla muere. sabias?</b>";
$mensajes_error[1] = "<b>Deja de pensar en venados y mira bien el código que escribiste!</b>";
$mensajes_error[2] = "<b>Si la página se llama ardillasybits, por qué veo pinguinos? escribe bien el código!</b>";
$mensajes_error[3] = "<b>Hola! soy un mensaje de error. Si me estas viendo es que escribiste mal el codigo</b>";
$random = rand(0,3);

return $mensajes_error[$random];
}

function limpiar($variable) { //limpia variables, ayuda a prevenir posibles inyecciones SQL
	if(!is_string($variable))
	{
		return false;
	}
	else
	{
		$variable = trim($variable);
		$variable = mysql_real_escape_string($variable);
		return $variable;
	}
}


function titulo($titulo) { //establece el titulo de una pagina.
echo "<title>".$titulo."</title>";
}

function ipReal() { //saca la IP del usuario, usese con precaucion! xD...
if ($_SERVER) { 

	if ( $_SERVER[HTTP_X_FORWARDED_FOR] ) { 

		$realip = $_SERVER["HTTP_X_FORWARDED_FOR"]; } 
		
	elseif ( $_SERVER["HTTP_CLIENT_IP"] ) { 
		
		$realip = $_SERVER["HTTP_CLIENT_IP"]; } 
		
	else { 
		
		$realip = $_SERVER["REMOTE_ADDR"]; } 
} 

else {
	if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) { 
	
		$realip = getenv( 'HTTP_X_FORWARDED_FOR' ); } 
		
	elseif ( getenv( 'HTTP_CLIENT_IP' ) ) { 
	
		$realip = getenv( 'HTTP_CLIENT_IP' ); } 
		
	else { 
	
	$realip = getenv( 'REMOTE_ADDR' ); 
	
	} 
	
} 

return $realip;
}


function getBrowser() { //saca el navegador del usuario...
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 
?>
