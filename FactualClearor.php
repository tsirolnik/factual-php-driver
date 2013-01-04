<?php
/**
 * Factual Submittor vars collector for clearing values
 * @author Tyler
 * @package Factual
 * @license Apache 2.0
 */
 require_once("FactualPost.php");
 class FactualClearor extends FactualPost{
	//Required Params	
	protected $values = array();	//values to be cleared	
	 		
 	/**
 	 * Overrides parent class
 	 * @return array
 	 */	
 	public function getPostVars(){
 		return array_merge(parent::getPostVars(),array("values"));
 	}
 		
 	/**
 	 * Checks whether required params are included before writing
 	 * @return bool
 	 */
 	public function isValid(){
 		//all submits require a table name, a user token, and Factual ID
 		if (empty($this->tableName)| empty($this->user)|empty($this->factualID)){
			return false;
 		} 
 		return true;
 	}
 			
 	/**
 	 * Clears attribute of Factual entity
 	 * @param string key Field/Column name
 	 * @return array cleared values
 	 */
 	public function ClearValue($key){
 		$this->values[] = $key;
 		return $this->values;
 	} 	
 	
 	/**
 	 * Clears numerous attributes of a Factual entity
 	 * @param array data array of attribute names to clear
 	 * @return array set values
 	 */
 	public function clearValues($data){
 		if (!is_array($data)){
 			throw new exception (__METHOD__." Parameter must be array of attribute names to clear");
 		}
 		foreach ($data as $value){
 			$this->values[] = $value;	
 		}
 		return $this->values;
 	} 	 	
 }
?>
