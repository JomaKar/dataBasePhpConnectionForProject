<?php

class updateProcess{
	private $sentence = '';
	private $array = array();

	public function createSentence($columnsArray, $equivalenceValuesArray){
		for ($i=0; $i < count($columnsArray); $i++) { 
			$this->sentence .= ($i < count($columnsArray) -1) ? "{$columnsArray[$i]} = :{$equivalenceValuesArray[$i]}, " : "{$columnsArray[$i]} = :{$equivalenceValuesArray[$i]}";
		}
		return $this->sentence;
	}

	public function createPDOArray($equivalenceValuesArray, $valuesArray){
		for ($i=0; $i < count($equivalenceValuesArray); $i++) {
			$this->array[ $equivalenceValuesArray[$i] ] = $valuesArray[$i];
		}
		return $this->array;
	}

}