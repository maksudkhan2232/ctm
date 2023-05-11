<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Kolkata");
ini_set('post_max_size','1024M');
define('SITE','http://'.$_SERVER['HTTP_HOST'].'/ctm/');  //url
define('ROOT_PATH',''.$_SERVER['DOCUMENT_ROOT'].'/ctm/'); //physical path
define('UPLOAD_FOLDER',''.ROOT_PATH.'uploaded/');
//-------------admin----------------
define('ADMIN_SITE',''.SITE.'administrator/');  //admin url
define('BOXOFFICE_SITE',''.SITE.'boxoffice/');
define('SITE_DASHBOARD',''.SITE.'dashboard/');
define('MAX_FILE_SIZE', 1500240); //max 1 MB file size


require("mysql.inc.php");
$sql_host = "localhost";
$sql_db = "ctm";
$sql_user = "root";
$sql_pass = "";
if(!isset($db)){
	$db = new Database($sql_host, $sql_user, $sql_pass, $sql_db);
	$db->connectctm();
}
require('functions.inc.php');
$menuname =  basename($_SERVER['PHP_SELF']);
$menuheadname =  basename($_SERVER['PHP_SELF']);
$title = "Cinema Software";
$description = "Cinema Software";
$author = "Cinema Software";
?>