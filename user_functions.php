<?php
function loggedin(){
	session_start();
	
	if(isset($_SESSION['user_id']) && !empty(['user_id'])){
		return true;
	}
}
?>