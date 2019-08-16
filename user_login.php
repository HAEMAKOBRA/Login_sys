<?php
ob_start();

function filled_fields($to_be_loggedin_fields){
	if(empty($to_be_loggedin_fields)){
		return true;
	}else{
		foreach($to_be_loggedin_fields as $field){
			switch($field){
				case 'ld_username': echo 'Username field must be filled<br />';
				break;
				
				case 'ld_password': echo 'Password field must be filled<br />';
				break;
				
				case 'ld_activationCode': echo 'Activation code field must be filled<br />';
				break;
			}
		}
		
		return false;
	}
}

function user_data_found($udf_username, $udf_password, $udf_activationCode){	
	$login_password_hash = md5($udf_password);
	
	$user_data_checker = new db_handler;
	
	$user_data_array = array($udf_username, $login_password_hash, $udf_activationCode);
	$user_data_query = 'SELECT user_id FROM users WHERE user_name = ? AND password = ? AND activation_code = ?';
	
	$user_data_checker -> set_data($user_data_query, $user_data_array);
	$user_data_checker -> query_handler();
	$user_id = $user_data_checker -> output_result();
	
	unset($user_data_checker);
	
	$GLOBALS['user_id'] = $user_id['user_id'];
	
	if($GLOBALS['user_id'] > 0){		
		return true;
	}else{
		echo 'Please enter data correctly';
		return false;
	}
}

function log_user_in(){
	if(isset($_SESSION)){
		$_SESSION['user_id'] = $GLOBALS['user_id'];
	}else{
		session_start();
		$_SESSION['user_id'] = $GLOBALS['user_id'];
	}
	
	header('location: user_control/user_page.php');
}

$login = array('ld_username', 'ld_password', 'ld_activationCode');

$login_input = new input_checker;

foreach($login as $r){
	$login_input -> set_input($r);
	$login_data[] = $login_input -> return_input(); 
}

$login_username = $login_data[0];
$login_password = $login_data[1];
$login_activationCode = $login_data[2];

if(filled_fields($login_input -> not_empty_error_show())){
	if(user_data_found($login_username, $login_password, $login_activationCode)){
		log_user_in();
	}
}

unset($login_input);
?>