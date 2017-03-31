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

	if($db == 'ingredients'){
		$insertion = $mapperInTable->insertRAW("INSERT INTO $db (name, price, amount_price, imgPath) VALUES(:nm, :prc, :a_pr, :imP)", ['nm' => $name, 'prc' => $price, 'a_pr' => $amount_price, 'imP' => $imgPath]);

		echo ($insertion) ? 'new ingredient correctly added' : 'a mistake happen, try again';
	}
	else if($db == 'recipe_ingredients'){
		$insertion = $mapperInTable->insertRAW("INSERT INTO $db (id_ingredients, id_recipe) VALUES(:idI, :idR)", ['idI' => $idI, 'idR' => $idR]);

		echo ($insertion) ? 'new ingredient-recipe correctly added' : 'a mistake happen, try again';

	}else if($db == 'recipes'){
		$insertion = $mapperInTable->insertRAW("INSERT INTO $db (name, imgPath, description, popularity, ingredients) VALUES(:nm, :imP, :dsc, :pp, :ing)", ['nm' => $name, 'imP' => $imgPath, 'dsc' => $description, 'pp' => $popularity, 'ing' => $ingredients]);

		echo ($insertion) ? 'new recipe correctly added' : 'a mistake happen, try again';

	}else echo 'there is not such a table';

}

