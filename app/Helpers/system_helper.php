<?php

/**
 * [Función que redirige una página a otra, con mensajes, requiere recabar e la url message, tipo, icono, titulo, url]
 * @param  boolean $page         [description]
 * @param  [type]  $message      [description]
 * @param  [type]  $message_type [description]
 * @return [type]                [description]
 */
function redirect_us($page = FALSE, $message = NULL, $message_type = NULL){
	if(is_string ($page)){
		$location = $page;
	}else{
		$location = $_SERVER ['SCRIPT_NAME'];
	}

	// Check for the message
	if($message != NULL){
		// Set Message
		$_SESSION['message'] = $message;
	}
	// Check for type
	if($message_type != NULL){
		// Set message type
		$_SESSION['message_type'] = $message_type;
	}

	// Redireccionamiento
	header ('Location: ' .$location);
	exit;
}

function enviarMail($solicitante, $email, $asunto, $email_area, $mensaje){
	$headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n" .'X-Mailer: PHP/' . phpversion();
	@mail($email_area, $asunto, $mensaje, $headers);
}

/**
 * [Función que redirige una página a otra, con mensajes, requiere recabar e la url message, tipo, icono, titulo, url]
 * @param  boolean $page         [description]
 * @param  [type]  $message      [description]
 * @param  [type]  $message_type [description]
 * @return [type]                [description]
 */
function redireccionar($page = FALSE, $text_msg = NULL, $tipo_msg = NULL, $icono_msg = NULL, $titulo_msg  = NULL, $url_msg = NULL){
	if(is_string ($page)){
		$location = $page;
	}else{
		$location = $_SERVER ['SCRIPT_NAME'];
	}

	// Check for the message
	if($text_msg != NULL){
		// Set Message
		$_SESSION['text_msg'] = $text_msg;
	}
	// Check for type
	if($tipo_msg != NULL){
		// Set message type
		$_SESSION['tipo_msg'] = $tipo_msg;
	}

	if($icono_msg != NULL){
		// Set message type
		$_SESSION['icono_msg'] = $icono_msg;
	}

	if($titulo_msg != NULL){
		// Set message type
		$_SESSION['titulo_msg'] = $titulo_msg;
	}

	if($url_msg != NULL){
		// Set message type
		$_SESSION['url_msg'] = $url_msg;
	}

	// Redireccionamiento
	header ('Location: ' .$location);
	exit;
}

/**
 * [Función que envia un mensaje de notificación en pantalla, requiere de los siguientes datos
 * message, tipo, icono, titulo, url]
 * @return [type] [description]
 */
function mostrarMensaje(){
	if(!empty($_SESSION['text_msg'])){
		$message = $_SESSION['text_msg'];
		if(!empty($_SESSION['tipo_msg'])){
			$message_type 	= $_SESSION['tipo_msg'];
			$icono_msg 		= $_SESSION['icono_msg'];
			$titulo_msg 	= $_SESSION['titulo_msg'];
			$url_msg 		= $_SESSION['url_msg'];
			echo '<script language="javascript">notify_msg("'.$icono_msg.'", "'.$titulo_msg.'", "'.$message.'", "'.$url_msg.'", "'.$message_type.'");</script>';
			// Eliminar mensaje
			unset($_SESSION['text_msg']);
			unset($_SESSION['tipo_msg']);
		}else{
			echo '';
		}
	}
}

/**
 * [Función que envia un mensaje de notificación en pantalla, requiere de los siguientes datos
 * message, tipo, icono, titulo, url]
 * @return [type] [description]
 */
function displayMessage(){
	if(!empty($_SESSION['message'])){
		// Assign message to a variable
		$message = $_SESSION['message'];

		if(!empty($_SESSION['message_type'])){
			// Assign type to a variable
			$message_type = $_SESSION['message_type'];
			// Create output glyphicon 
			if ($message_type == 'error'){
				echo '<script language="javascript">mensaje("Error en el nombre de usuario o contraseña", "danger", "glyphicon glyphicon-warning-sign", "", "#");</script>';
				//echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '.$message.'</div>';
			}else{
				echo '<script language="javascript">mensaje("Has iniciado sesión.", "success", "glyphicon glyphicon-ok-sign", "", "#");</script>';
				//echo '<div class="alert alert-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ' . $message . '</div>';
			}
			// Eliminar mensaje
			unset($_SESSION['message']);
			unset($_SESSION['message_type']);
		}else{
			echo '';
		}
	}
}

function getFechaElSalvadot(){
	date_default_timezone_set('America/El_Salvador');
	$timezone = date_default_timezone_get();
	return date("Y-m-d H:i:s");
}

function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}

function fraseAleatoria($length=8){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function obtIconArchivo($ext) {
	$icon = "fa fa-file";
	switch ($ext) {
		case 'pdf':
			$icon = " fa fa-file-pdf ";
			break;
		case 'doc':
			$icon = " fa fa-file-word ";
			break;
		case 'mp3':
			$icon = " fa fa-file-audio ";
			break;
		case 'docx':
			$icon = " fa fa-file-word ";
			break;
		case 'xls':
			$icon = " fa fa-file-excel ";
			break;
		case 'xlsx':
			$icon = " fa fa-file-excel ";
			break;
		case 'txt':
			$icon = " fa fa-file-text ";
			break;
		case 'ppt':
		case 'pptx':
			$icon = " fa fa-file-powerpoint ";
			break;
		case 'jpg':
		case 'jpeg':
		case 'png':
			$icon = " fa fa-file-image ";
			break;
		default:
			$icon = " fa fa-file-text ";
			break;
	}
	return $icon;
}


function obtTipoArchivo($ext) {
	$tipo = "";
	switch ($ext) {
		case 'application/wps-office.doc':
		case 'application/msword':
			$tipo = "doc";
			break;
		case 'application/pdf':
			$tipo = "pdf";
			break;
		case 'application/wps-office.docx':
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			$tipo = "docx";
			break;
		case 'application/wps-office.xls':
		case 'application/vnd.ms-excel':
			$tipo = "xls";
			break;
		case 'application/wps-office.xlsx':
		case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			$tipo = "xlsx";
			break;
		case 'application/wps-office.ppt':
		case 'application/vnd.ms-powerpoint':
			$tipo = "ppt";
			break;
		case 'application/wps-office.pptx':
		case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
			$tipo = "pptx";
			break;
		case 'image/png':
			$tipo = "png";
			break;
		case 'image/jpeg':
			$tipo = "jpeg";
			break;
		case 'image/gif':
			$tipo = "gif";
			break;
		case 'image/jpg':
			$tipo = "jpg";
			break;
	}
	return $tipo;
}

function formatBytes($bytes, $precision) { 
	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
	$bytes = max($bytes, 0); 
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	$pow = min($pow, count($units) - 1); 
	return round($bytes, $precision) . ' ' . $units[$pow]; 
}

function stripHTMLtags($str){
	$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	$t = htmlentities($t, ENT_QUOTES, "UTF-8");
	return $t;
}

function splitArraySearch($array){
	$words = array();
	$i = 0;
	foreach ($array as $ele) {
		if ($ele!="el" && $ele!="lo" && $ele!="los" && $ele!="las" && $ele!="con" && $ele!="más" && $ele!="mas" && $ele!="el" && $ele!="de" && $ele!="del" && $ele!="otro" && $ele!="y" && $ele!="o" && $ele!="a" && $ele!="otros" && $ele!="mejor" && $ele!="solo" && $ele!="unico") {
			$words[$i] = $ele;
		}
		$i++;
	}
	return $words;
}

function get_words($sentence, $count = 10) {
	preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $sentence, $matches);
	return $matches[0];
}

function uuidv4($trim = false) {	
	$format = ($trim == false) ? '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' : '%04x%04x%04x%04x%04x%04x%04x%04x';
	
	return sprintf($format,
		// 32 bits for "time_low"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff),
		// 16 bits for "time_mid"
		mt_rand(0, 0xffff),
		// 16 bits for "time_hi_and_version",
		// four most significant bits holds version number 4
		mt_rand(0, 0x0fff) | 0x4000,
		// 16 bits, 8 bits for "clk_seq_hi_res",
		// 8 bits for "clk_seq_low",
		// two most significant bits holds zero and one for variant DCE1.1
		mt_rand(0, 0x3fff) | 0x8000,
		// 48 bits for "node"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
	);
}

function slugify($text){
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	// trim
	$text = trim($text, '-');
	// transliterate
	if (function_exists('iconv')){
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	}
	// lowercase
	$text = strtolower($text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	if(strlen($text)>=80){
		$text = substr($text, 0, 80);
	}

	if (empty($text)){
		return 'n-a';
	}
	return $text;
}

function delArtsStr($frase){
	$palabras = array();
	foreach ($frase as $palabra) {
		if(strlen($palabra)>2 && $palabra!="con" && $palabra!="del" && $palabra!="así" && $palabra!="asi" && $palabra!="las" && $palabra!="los" && $palabra!="que" && $palabra!="mas" && $palabra!="pero" && $palabra!="qué" && $palabra!="más"){
			$palabras[] = $palabra;
		}
	}
	return $palabras;
}

function genQueryWhere($lista_campos, $list_words){
	$b=0;
	$condicion = "";
	if (sizeof($list_words)==0) {
		$list_words[0] = "";
	}
	for ($i=0; $i < sizeof($lista_campos); $i++) { 
		$wh = " (";
		for ($j=0; $j < sizeof($list_words); $j++) { 
			$wh .= " ".$lista_campos[$i]." LIKE :b".$b;
			if (sizeof($list_words)>1 && $j < sizeof($list_words)-1) {
				$wh .= " or ";
			}
			$b++;
		}
		$wh .= ") ";
		if (sizeof($lista_campos)>1 && $i<sizeof($lista_campos)-1) {
			$wh .= " or ";
		}
		$condicion .=$wh;
	}
	return $condicion;
}

function genDataBind($lista_campos, $list_words){
	$data_bind = array();
	$b=0;
	if (sizeof($list_words)==0) {
		$list_words[0] = "";
	}
	for ($i=0; $i < sizeof($lista_campos); $i++) { 
		for ($j=0; $j < sizeof($list_words); $j++) { 
			$data_bind['b'.$b] = $list_words[$j];
			$b++;
		}
	}
	return $data_bind;
}

function cleanStr($s){
	return str_replace(array('¡','.',',','!','&','<','>','/','\\','"',"'",'?','+'), '', $s);
}


function timeago($date){
	if(empty($date)) {
		return "Fecha no proporcionada.";
	}
	
	$periods 	= array("seg", "min", "hora", "día", "semana", "mes", "año", "decada");
	$lengths 	= array("60","60","24","7","4.35","12","10");
	$now 		= time();
	$unix_date 	= strtotime($date);
	
	   // check validity of date
	if(empty($unix_date)) {    
		return "Error en la fecha";
	}

	// is it future date or past date
	if($now > $unix_date) {    
		$difference     = $now - $unix_date;
		$tense         = "hace";
		
	} else {
		$difference     = $unix_date - $now;
		$tense         = "justo ahora";
	}
	
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	
	$difference = round($difference);
	
	if($difference != 1) {
		if ($periods[$j]=="mes") {
			$periods[$j].= "es";
		}else{
			$periods[$j].= "s";
		}
	}
	
	return "{$tense} $difference $periods[$j]";
}


function mesDiaAnio($fecha){
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	return $meses[date("n", strtotime($fecha))-1]." ".date("d", strtotime($fecha)). ", ".date(date("Y", strtotime($fecha))) ;
}