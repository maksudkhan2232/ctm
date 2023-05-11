<?php 
include("includes/config.php");
if(isset($_SESSION['user_session_id'])){
    unset($_SESSION['user_session_name']);  
    unset($_SESSION['user_session_id']);
    unset($_SESSION['user_session_right']);  
	session_destroy();
}
header('location:'.SITE.'index.php');   
?>



