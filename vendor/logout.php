<?php  
	session_start();
	unset($_SESSION['user_email']);
	unset($_SESSION['user_password']);
	unset($_SESSION['user_view_id']);
	unset($_SESSION['chat_view_id']);
	header('location: ../');
?>