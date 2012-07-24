<?php

/**
 * Represents the response from running a fetch request against Factual, such as
 * a geolocation based query for specific places entities.
  * This is a refactoring of the Factual Driver by Aaron: https://github.com/Factual/factual-java-driver
 * @author Tyler
 * @package Factual
 * @license Apache 2.0
 */
class ReadResponse extends FactualResponse {
	
  protected $totalRowCount = null; //int
  protected $includedRows = null; //int
  protected $data = array();
  protected $countTotal = null;
  
	/**
	 * Parses JSON as array and assigns object values
	 * @param string json JSON returned from API
	 * @return array structured JSON
	 */
	protected function parseJSON($json){
		$rootJSON = parent::parseJSON($json);
    	//assign total row count
    	if(isset($rootJSON['response']['total_row_count'])){
    		$this->countTotal = $rootJSON['response']['total_row_count'];
    	}
    	if(isset($rootJSON['response']['included_rows'])){
    		$this->includedRows = $rootJSON['response']['included_rows'];
    	}    	
    	//assign data
    	if (isset($rootJSON['response']['data'])){
    		$this->data = $rootJSON['response']['data'];
    	}
    	return $rootJSON;	
	}

	/**
   * Get count of all entities meeting query criteria, or null if unknown.
   * @return int | null
   */
  public function getTotalRowCount() {
    return $this->totalRowCount;
  }

  /**
   * Get count of result rows returned in this response.
   * @return int 
   */
  public function getIncludedRowCount() {
    return $this->includedRows;
  }
	

}
?>