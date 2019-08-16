<?php
class db_handler{
	
	private $_sql_host = 'localhost';
	private $_sql_user = 'root';
	private $_sql_pass = '';
	private $_db_name = 'db';
	private $_conn;
	private $_query;
	private $_stmt;
	private $_var_values = array();
	 
	function __construct(){
		try{
			$this -> _conn = new PDO("mysql:host=".$this -> _sql_host.";dbname=".$this -> _db_name, $this -> _sql_user, $this -> _sql_pass);
			$this -> _conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//temporary code line;
			echo 'Connection established'.'<br />';
			
		}catch(PDOException $e){
			echo 'Connection failed: '.$e -> getMessage();
		}
   	}
	
	public function set_data($query, $f_var_values){
		$this -> _query = $query;
		foreach($f_var_values as $values){
			$this -> _var_values = $f_var_values;
		}
	}
	
	public function query_handler(){
		$this -> _stmt = $this -> _conn -> prepare($this -> _query);
		$this -> _stmt -> execute($this -> _var_values);
		
		//temporary code line;
		echo 'Query handler ok!'.'<br />';	
	}
	
	public function num_rows(){
		return $this -> _stmt -> rowCount(); 
	}
	
	public function output_result(){
		$this -> _stmt -> setFetchMode(PDO::FETCH_ASSOC);
		return $this -> _stmt -> fetch(); 
	}
	
	function __destruct(){
		$this -> _con = null;
		
		//temporary code line;
		echo '<br />Connection terminated!';
	}
	
}
?>