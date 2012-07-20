<?php
/**
 * Factual Flag vars collector
 * @author Tyler
 * @package Factual
 * @license Apache 2.0
 */
 class FactualFlagger{
	//Required Params
	public $tableName = null; //The name of the table in which the entites is found you wish to flag (e.g. "places")
	public $factualID = null; //The Factual ID
	public $user = null; //Arbitrary User token
	public $problem = null;   //duplicate|nonexistent|inaccurate|inappropriate|spam|other
	//Optional Params
	public $comment = null;
	public $debug = null;
	public $reference = null;		
 	
 	//Getters
 	public function getTableName(){
 		return $this->tableName;
 	} 	
 	public function getFactualID(){
 		return $this->factualID;
 	} 
 	//Setters
 	public function setTableName($var){
 		$this->tableName = $var;
 	}
 	public function setFactualID($var){
 		$this->factualID = $var;
 	} 	
 	public function setUserToken($var){
 		$this->user = $var;
 	} 	
 	public function setComment($var){
 		$this->comment = $var;
 	} 	 	
 	public function setReference($var){
 		$this->reference = $var;
 	} 	
 	public function debug(){
 		$this->debug = true;
 	} 	  	  	
 	public function setProblem($var){
 		$var = strtolower($var);
 		$validProblems = array(
		"duplicate",
		"nonexistent",
		"inaccurate",
		"inappropriate",
		"spam",
		"other");
 		if (in_array($var,$validProblems)){
 			$this->problem = $var;	
 			return true;
 		} else {
 			throw new Exception("Problem must be one of: ".implode("|",$validProblems));
 			return false;
 		}
 	}  	  	
 	
 	protected function getPostVars(){
 		return array("user","problem","comment","debug","reference");
 	}
 	 	
 	/**
 	 * Returns key/value pairs
 	 */
 	public function toUrlParams(){
 		$params = $this->getPostVars();
 		$temp = array();
 		foreach ($params as $var){
 			if ($this->$var){ //non empty values only
 				$temp[$var] = rawurlencode($this->$var); //raw encode
 			}
 		}  		 		
 		return $temp;		
 	}

 	/**
 	 * Returns single URL string
 	 */ 	
 	public function toURLString(){
 		$temp = $this->toUrlParams();
 		foreach ($temp as $key => $value){
 				$temp2[] = $key."=".$value;
 		} 	 		
 		return implode("&", $temp2);
 	}
 	
 	
 	/**
 	 * Dumps vars
 	 */
 	public function dump(){
 		return get_object_vars($this);
  	}
 	 	
 	/**
 	 * Clears the object
 	 */
 	public function clear(){
 		foreach (get_object_vars($this) as $var){
 			$this->$var = null;
 		}
 		return true;
 	}
 	
 	/**
 	 * Checks whether required params are included
 	 */
 	public function isValid(){
 		if (empty($this->tableName)| empty($this->factualID)|empty($this->user)|empty($this->problem)){
 			return false;
 		} else {
 			return true;
 		}
 		
 	}
 	
 }
 
 
?>
