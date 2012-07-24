<?php

/**
 * Represents the response from running a fetch request against Factual, such as
 * a geolocation based query for specific places entities.
 * This is a refactoring of the Factual Driver by Aaron: https://github.com/Factual/factual-java-driver
 * @author Tyler
 * @package Factual
 * @license Apache 2.0
 */
class ResolveResponse extends FactualResponse {

	/**
	 * Checks whether query was resolved
	 * @return bool
	 */
	public function isResolved() {
		return (bool) $this->data[0]['resolved'];
	}

	/**
	 * Gets resolved entity as array
	 * @return array | false on no resolution
	 */
	public function getResolved() {
		if ($this->isResolved()) {
			return $this->data[0];
		} else {
			return null;
		}
	}



}
?>