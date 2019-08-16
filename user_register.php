<?php
function filled_fields($to_be_registered_empty_fields){
	if(empty($to_be_registered_empty_fields)){
		return true;
	}else{
		foreach($to_be_registered_empty_fields as $field){
			switch($field){
				case 'rd_username': echo 'Username field must be filled<br />';
				break;
				
				case 'rd_password': echo 'Password field must be filled<br />';
				break;
				
				case 'rd_repeatPassword': echo 'Repeat password field must be filled<br />';
				break;
				
				case 'rd_firstName': echo 'First name field must be filled<br />';
				break;
				
				case 'rd_lastName': echo 'Last name field must be filled<br />';
				break;
				
				case 'rd_propertyName': echo 'Property name field must be filled<br />';
				break;
				
				case 'rd_address': echo 'Address field must be filled<br />';
				break;
				
				case 'rd_price': echo 'Price field must be filled<br />';
				break;
			}
		}
		
		return false;
	}
}

function input_length_match($to_be_checked_username, $to_be_checked_firstName, $to_be_checked_lastName, $to_be_checked_propertyName, $to_be_checked_address, $to_be_checked_price){
	if(strlen($to_be_checked_username) > 35){
		echo 'Username shouldn\'t exceed 35 characters, please try again';
		return false;
	}
	
	if(strlen($to_be_checked_firstName) > 35 ){
		echo 'First name shouldn\'t exceed 35 characters, please try again';
		return false;
	}
	
	if(strlen($to_be_checked_lastName) > 35){
		echo 'Last name shouldn\'t exceed 35 characters, please try again';
		return false;
	}
	
	if(strlen($to_be_checked_propertyName) > 200){
		echo 'Property name shouldn\'t exceed 200 characters, please try again';
		return false;
	}
	
	if(strlen($to_be_checked_address) > 200){
		echo 'Address shouldn\'t exceed 200 characters, please try again';
		return false;
	}
	
	if(strlen($to_be_checked_price) > 10){
		echo 'Price shouldn\'t exceed 10 characters, please try again';
		return false;
	}
	
	return true;
}


function password_match($first_password, $second_password){
	if($first_password != $second_password){
		echo 'You didn\'t repeat the password correctly, please try again';
		return false;
	}else{
		return true;
	}
}

function repeated($if_repeated_username, $if_repeated_propertyName, $if_repeated_address){ 
	$if_repeated_checker = new db_handler;
	
	$if_repeated_data = array($if_repeated_username, $if_repeated_propertyName, $if_repeated_address);	
	$if_repeated_query = 'SELECT user_name, property_name, address FROM users WHERE user_name = ? OR property_name = ? OR address = ?';
	
	$if_repeated_checker -> set_data($if_repeated_query, $if_repeated_data);
	$if_repeated_checker -> query_handler();
	$data_retrieved = $if_repeated_checker -> output_result();
	
	unset($if_repeated_checker);
	
	if($if_repeated_data[0] == $data_retrieved['user_name']){		
		echo 'The username that you have entered is already used, please choose another one';
		return true;
	}

	if($if_repeated_data[1] == $data_retrieved['property_name']){
		echo 'The property name that you have entered is already used, please choose another one';
		return true;
	}

	if($if_repeated_data[2] == $data_retrieved['address']){
		echo 'The address that you have entered is already used, please choose another one';
		return true;
	}
	
	return false;
}

function perform_registeration($pr_username, $pr_password, $pr_firstName, $pr_lastName, $pr_propertyName, $pr_address, $pr_price){    
	$password_hash = md5($pr_password);
	
	$registeration = new db_handler;
	
	$data = array($pr_username, $password_hash, $pr_firstName, $pr_lastName, $pr_propertyName, $pr_address, $pr_price);
	$register_query = 'INSERT INTO users (user_name, password, first_name, last_name, property_name, address, price) VALUES (?, ?, ?, ?, ?, ?, ?)';
	
	$registeration -> set_data($register_query, $data);
	$registeration -> query_handler();
	
	unset($registeration);
	
	echo 'Thanks for registeration :) please contact us to get your activation code in order to use this website';
}

$register = array('rd_username', 'rd_password', 'rd_repeatPassword', 'rd_firstName', 'rd_lastName', 'rd_propertyName', 'rd_address', 'rd_price');

$register_input = new input_checker;

foreach($register as $r){
	$register_input -> set_input($r);
	$register_data[] = $register_input -> return_input(); 
}

$register_username = $register_data[0];
$register_password = $register_data[1];
$register_repeatPassword = $register_data[2];
$register_firstName = $register_data[3];
$register_lastName = $register_data[4];
$register_propertyName = $register_data[5];
$register_address = $register_data[6];
$register_price = $register_data[7];

if(filled_fields($register_input -> not_empty_error_show())){
	if(input_length_match($register_username, $register_firstName, $register_lastName, $register_propertyName, $register_address, $register_price)){
		if(password_match($register_password, $register_repeatPassword)){
			if(!repeated($register_username, $register_propertyName, $register_address)){
				perform_registeration($register_username, $register_password, $register_firstName, $register_lastName, $register_propertyName, $register_address, $register_price);
			}
		}
	}
}

unset($register_input);
?>