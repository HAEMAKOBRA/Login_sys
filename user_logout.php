<?php
ob_start();
session_start();

if(session_destroy()){
	header('Refresh: 1; url = ../control.php');
	echo '<strong>You logged out <br /> Redirecting to the log in page... <br /></strong>';
}
?>