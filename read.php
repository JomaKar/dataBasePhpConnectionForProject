<?php


require 'connectionBase.php';
use Conn\DB\PDOFunc;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
	foreach ($_POST as $key => $value) {
		if(!empty($value)) PDOFunc\test_input($value);
	}

	extract($_POST);

	//uncomment for test
	//file_put_contents('res.txt', "$db, $name, $price, $amount_price, $imgPath");

	$mapperInTable = new PDOFunc\myDbQuerier($conn, $db);

	if(isset($id)){
		$matches = $mapperInTable->getAllOrOneFromTable($id);
	}else{
		$matches = $mapperInTable->getAllOrOneFromTable(null);
	}

	echo json_encode($matches);

	// if($db == 'ingredients'){
	
		
	// }
	// else if($db == 'recipe_ingredients'){
		
	// }else if($db == 'recipes'){
		
	// }else echo 'there is not such a table';

}