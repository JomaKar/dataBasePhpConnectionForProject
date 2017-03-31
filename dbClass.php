<?php namespace Conn\DB\PDOFunc;

function connect($config){
//works fine
	try{
	
	$conn = new \PDO('mysql:host=localhost;dbname=recipes', $config['usr'], $config['pass']);
	$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

	return $conn;

	}catch(\PDOException $e){
		echo 'Maldito error' . $e->getMessage();
		return false; 
	}

}


class myDbQuerier{
	private $table;
	private $conn;

	public function __construct($pdo, $tbl){
		$this->conn = $pdo;
		$this->table = $tbl;
	}

	public function getAllOrOneFromTable($id){
		return (!isset($id)) ? 
			$this->tryOrDie("SELECT * FROM {$this->table}", null, 'g') 
			: $this->tryOrDie("SELECT * FROM {$this->table} WHERE id = :id", ['id' => $id], 'g');
	}

	public function getQuering($query, $bindings){
		return (!isset($query) || !isset($bindings)) ? false : $this->tryOrDie($query, $bindings, 'g');
	}

	public function insertRAW($query, $bindings){
		return (!isset($query) || !isset($bindings)) ? false : $this->tryOrDie($query, $bindings, 's');
	}

	public function update($query, $bindings){
		return (!isset($query) || !isset($bindings)) ? false : $this->tryOrDie($query, $bindings, 's');
	}

	private function checkConnection(){
		return (!$this->conn) ? false : true;
	}

	private function tryOrDie($query, $bindings, $flag){

		try{

			$stmt = $this->conn->prepare($query);
			(!isset($bindings)) ? $stmt->execute() : $stmt->execute($bindings);
			
			if($flag === 'g'){
				$result = $stmt->fetchAll(\PDO::FETCH_OBJ);
				return (!empty($result)) ? $result : false;
			
			}

			return ($stmt) ? true : false;	

		}catch(\PDOException $e){

			echo 'Maldito error' . $e->getMessage();
			return false; 
		}

	}
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}