<?php 
session_start();
if(isset($_SESSION['suraj_admin_id'])){
    unset($_SESSION['suraj_admin_name']);  
    unset($_SESSION['suraj_admin_right']);
    unset($_SESSION['book_moviename']);  
	unset($_SESSION['book_screen_number']);
	unset($_SESSION['book_show_time']);  
	unset($_SESSION['book_date']);
	unset($_SESSION['sheet_ticket_rate']);  
	unset($_SESSION['sofa_ticket_rate']);
	unset($_SESSION['movie_assign_show']);
	unset($_SESSION['suraj_ticket_print']);
	unset($_SESSION['last_page']);   
  	session_destroy();
}
header('Location: http://'.$_SERVER['HTTP_HOST'].'/ticketbookscp/index.php');
?>



