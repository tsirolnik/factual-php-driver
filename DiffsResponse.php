<?php

/**
 * The response from running a FLag query
 * @author Tyler
 * @package Factual
 * @license Apache 2.0
 */
class DiffsResponse extends ArrayIterator {
	
	protected $diffStart = null; //Start time. Unix timestamp in milliseconds
	protected $diffEnd = null; //Optional end time. Unix timestamp in milliseconds
	protected $duration = null; //Duration of Diffs window in microseconds
  	protected $version = array(); 
  	protected $status = array();
  	protected $data = array();
  	protected $json = null;
  	protected $responseHeaders = array();
  	protected $responseCode = null;
  	protected $request = null;	
	
  /**
   * Constructor, parses return values from CURL in factual::request() 
   * @param array response The JSON response String returned by Factual.
   */
  public function __construct($apiResponse) {
    try {
    	$this->json = $apiResponse['body'];
    	$this->parseResponse($apiResponse);
    } catch (Exception $e) {
    	//add note about json encoding borking here
      throw $e ();
    }
  }

	/**
	 * Gets Diffs start time in milliseconds
	 * @param bool human Human Readable (RFC 2822) rather than timestamp
	 * @return mixed diffs start time
	 */
	public function getStart($human = false){
		if ($human){
			return $this->timestampReadable($this->diffStart);
		}
		return $this->diffStart;
	}

	/**
	 * Gets Diffs end time in milliseconds
	 * @param bool human Human Readable (RFC 2822) rather than timestamp	 * 
	 * @return mixed diffs end time
	 */
	public function getEnd($human = false){
		if ($human){
			return $this->timestampReadable($this->diffEnd);
		}		
		return $this->diffEnd;
	}

	protected function timestampReadable($timeStamp){
		return date('r',$timeStamp);
	}

	/**
	 * Gets Diffs duration
	 * @param bool human Human Readable rather than milliseconds 
	 * @return mixed duration in milliseconds | H:m:s
	 */
	public function getDuration($human = false){
		if ($human){
			//$mod = round($this->duration % 1000,3);
			//$seconds = floor($this->duration / 1000);
			$seconds = $this->duration / 1000;
			return date("H:i:s",$seconds);
		}
		return $this->duration;
	}

	/**
	 * Parses response from CURL
	 * @param array apiResponse response from curl
	 * @return void
	 */
	protected function parseResponse($apiResponse){	
		$this->diffStart = $apiResponse['diffsmeta']['start'];
		$this->diffEnd = $apiResponse['diffsmeta']['end'];
		$this->duration = $apiResponse['diffsmeta']['end'] - $apiResponse['diffsmeta']['start'];
		//convert JSON to array
		$rootJSON = json_decode($apiResponse['body'],true);
		//assign status value
    	$this->status = $rootJSON['status'];
    	//assign version
    	$this->version = $rootJSON['version'];
    	//assign indivitual diffs to array
		foreach ($rootJSON['data'] as $diff){
			$this->append($diff);
		}	
		//assign headers
		$this->responseHeaders = $apiResponse['headers'];
		//assign response
		$this->responseCode = $apiResponse['code'];
		//assign request string
		$this->request = $apiResponse['request'];
	}

	/**
	 * Test for success (n 200 status return)
	 */
	 public function success(){
	 	if ($this->status = 200){
	 		return true;
	 	} else {
	 		return false;
	 	}
	 }

  /**
   * Get the entire JSON response from Factual
   * @return string 
   */
  public function getJson() {
    return $this->json;
  }

  /**
   * Get the status returned by the Factual API server, e.g. "ok".
   * @return string
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * Get the version returned by the Factual API server, e.g. "3".
   * @return numeric
   */
  public function getVersion() {
    return $this->version;
  }



}
?>