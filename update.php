<?php


require 'connectionBase.php';
require 'updateClass.php';
use Conn\DB\PDOFunc;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
	foreach ($_POST as $key => $value) {
		if(!empty($value)) PDOFunc\test_input($value);
	}

	extract($_POST);

	$uc = explode('-', $uc);
	$ev = explode('-', $ev);
	$v = explode('-', $v);

	$updateProcess = new updateProcess();
	$mySentence = $updateProcess->createSentence($uc, $ev);
	$myArray = $updateProcess->createPDOArray($ev, $v);

	$myArray['id'] = $id;

	$mapperInTable = new PDOFunc\myDbQuerier($conn, $db);

	$update = $mapperInTable->update("UPDATE $db SET $mySentence WHERE id = :id", $myArray);
									

	echo ($update) ? 'new ingredient correctly updated' : 'a mistake happen, try again';

}


