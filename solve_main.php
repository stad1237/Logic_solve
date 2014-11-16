<?php

class admin{
	private $problemArrays = array("column" => array(array(5),array(0),array(1,3),array(1,1),array(3)),
			"row" => array(array(1,1),array(1),array(1,1,1),array(1,1,1),array(5)));
	public function exec(){
		$checkLine = new checkLine($this->problemArrays);
		$checkLine->setlowest();
		$checkLine->setHighest();
	}
	public function execArrayAll(){
		$allayAll = new allayAll(6,3);
		$theArray = $allayAll->makeTestArray();
		$allayAll->setArray($theArray);
		$allayAll->showArray();
	}
}


class allayAll{
	private $showArray;
	private $rowSize;
	private $lineSize;
	public function __construct($rowSize, $lineSize){
		$this->rowSize = $rowSize;
		$this->lineSize = $lineSize;
	}
	public function setArray($inputArray){
		$this->showArray = $inputArray;
	}
	public function showArray(){
		$showString = '';
		for($i=0; $i < $this->rowSize; $i ++){
			for($j=0; $j < $this->lineSize; $j ++){
				$showString .= $this->showArray[$i][$j];
			}
			$showString .= "\n";
		}
		echo($showString);
	}
	//テスト用配列
	public function makeTestArray(){
		$theArray = array();
		for($i=0; $i < $this->rowSize; $i ++){
			for($j=0; $j < $this->lineSize; $j ++){
				$theArray[$i][$j] = $i + 2 * $j;
			}
		}
		return $theArray;
	}
}
class checkLine{
	private $problemArrays;
	private $convertedArrays;
	private $answerArray;

	private $checkingArray;

	public function __construct($problemArrays){
		$this->problemArrays = $problemArrays;
		$initArrays = new initArrays;
		$this->convertedArrays = $initArrays->convertProblemArrays($this->problemArrays);
		$this->answerArray = $initArrays->initAnswerArray(10, 10);
		$this->checkingArray = $this->convertArray($targetarray = array());
	}
	public function setLowest(){
		$arrayLength = count($this->answerArray);
		$checkingPoint = 0;
		$comparingValue = $this->checkingArray[$checkingPoint];
		for($nowCount = 0; $nowCount < $arrayLength; $nowCount++){
			if($nowCount >= $comparingValue && $checkingPoint + 1 < count($this->checkingArray)){
				$checkingPoint += 1;
				$comparingValue += $this->checkingArray[$checkingPoint];
			}
			$this->answerArray[$nowCount]['lowest'] = $checkingPoint;
			echo("  " . $nowCount . "is" . $checkingPoint . " ");
		}
		echo("setlow \n");
	}
	public function setHighest(){
		$arrayLength = count($this->answerArray);
		$checkingPoint = count($this->checkingArray) - 1;
		$comparingValue = $this->checkingArray[$checkingPoint];
		for($nowCount = 0; $nowCount < $arrayLength; $nowCount++){
			if($nowCount >= $comparingValue && $checkingPoint > 0){
				$checkingPoint -= 1;
				$comparingValue += $this->checkingArray[$checkingPoint];
			}
			$this->answerArray[$arrayLength - $nowCount]['lowest'] = $checkingPoint;
			echo("  " . ($arrayLength - $nowCount) . "is" . $checkingPoint . " ");
		}
		echo("sethigh \n");
	}
	//const_now
	public function convertArray($targetArray){
		return array(2,1,5);
	}
}

class initArrays{
	//const_now
	public function convertProblemArrays($problemArrays){
		$convertedArray = array();
		$rowLength = count($problemArrays["row"]);
		for($i = 0; $i < $rowLength; $i++){
			$arrayLength = count($problemArrays["row"][$i]);
			$convertedArray["row"][$i][0] = $problemArrays["row"][$i][0];
			for($j = 1; $j < $arrayLength; $j++){
				array_push($convertedArray["row"][$i], 1);
				array_push($convertedArray["row"][$i], $problemArrays["row"][$i][$j]);
			}
		}
		$columnLength = count($problemArrays["column"]);
		for($i = 0; $i < $columnLength; $i++){
			$arrayLength = count($problemArrays["column"][$i]);
			$convertedArray["column"][$i][0] = $problemArrays["column"][$i][0];
			for($j = 1; $j < $arrayLength; $j++){
				array_push($convertedArray["column"][$i], 1);
				array_push($convertedArray["column"][$i], $problemArrays["column"][$i][$j]);
			}
		}
		// var_export($convertedArray);
	}
	public function initAnswerArray($rowSize, $lineSize){
		$answerArray = array();
		for($i=0; $i < $rowSize; $i ++){
			for($j=0; $j < $lineSize; $j ++){
				$answerArray[$i][$j] = array();
			}
		}
		return $answerArray;
	}
}