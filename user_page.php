<?php
require 'user_initializer_require.php';

if(loggedin()){
	echo 'welcome';
	}else{
		echo 'you must log in';
	}
?>

<a href = "user_logout.php">Log out</a>