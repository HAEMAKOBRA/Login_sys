<?php
ob_start();

require 'index_initializer_require.php';

if(loggedin()){
	header('location: user_control/user_page.php');
}else{
	require 'design/html_code/login_design.php';
	require 'user_control/user_login.php';
}
?>