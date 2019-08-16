<?php
class input_checker{
	
	private $_c_input_name;
	private $_c_input;
	private $_c_input_name_array = array();
	
	public function return_input(){
		$returned_input = $this -> _c_input;
		$returned_input = trim($returned_input);
		$returned_input = stripslashes($returned_input);
		$returned_input = htmlentities($returned_input, ENT_COMPAT, "UTF-8");		
		return $returned_input;
	}
	
	private function _if_not_empty(){
		if(!empty($_POST[$this -> _c_input_name])){
			$this -> _c_input = $_POST[$this -> _c_input_name];
			$this -> return_input();
		}else{
			$this -> _c_input_name_array[] = $this -> _c_input_name;
		}
	}
	
	private function _if_isset(){
		if(isset($_POST[$this -> _c_input_name])){
			$this -> _if_not_empty();
		}
	}

	public function set_input($si_input){
		$this -> _c_input_name = $si_input;
		$this -> _if_isset();
	}
	
	public function not_empty_error_show(){
		return $this -> _c_input_name_array;
	}
	
	function __destruct(){
		$this -> _c_input_name = null;
		$this -> _c_input = null;
		$this -> _c_input_name_array = null;
	}
	}
?>