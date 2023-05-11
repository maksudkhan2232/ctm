<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Kolkata");
ini_set('post_max_size','1024M');
define('SITE','http://'.$_SERVER['HTTP_HOST'].'/ctm/');  //url
define('ROOT_PATH',''.$_SERVER['DOCUMENT_ROOT'].'/ctm/'); //physical path
define('UPLOAD_FOLDER',''.ROOT_PATH.'uploaded/');
//-------------admin----------------
define('ADMIN_SITE',''.SITE.'admin/');  //admin url
define('TICKET_SITE',''.SITE.'ticketbook/');
define('SITE_DASHBOARD',''.SITE.'dashboard/');
define('MAX_FILE_SIZE', 1500240); //max 1 MB file size
define('WEB_BASE', 'upd' );
define('UPLOADS_URL', 'https://'.$_SERVER['HTTP_HOST'].'/ctm/'.WEB_BASE );
$inactive = 42000;
if(isset($_SESSION['timeout']) ) {
     $session_life = time() - $_SESSION['timeout'];
     if($session_life > $inactive) {
         header("Location: ".SITE."logout.php");
     }
}
$_SESSION['timeout'] = time();
require("mysql.inc.php");
$sql_host = "localhost";
$sql_db = "ctm";
$sql_user = "root";
$sql_pass = "";
if(!isset($db)){
	$db = new Database($sql_host, $sql_user, $sql_pass, $sql_db);
	$db->connectmaksud();
}
require('functions.inc.php');
?>