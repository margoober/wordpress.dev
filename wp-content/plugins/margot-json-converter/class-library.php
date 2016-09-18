<?php
/*
CLASS JsonContentParser
Description: Classes for JSON converter
Version: 1.0
Author: Margot McMahon
Author URI: http://margot.dog
*/

class jsonManipulation {
	function __construct() {
		//initiate shortcode
		print_r("shortcode class instantiated!");
	}
	//methods to send parameters where they need to go
	public function set_endpoint($new_endpoint) {
		$this->endpoint = $new_endpoint;
	}
	public function set_limit($new_limit) {
		if (is_null($new_limit)) {
			$this->limit = 15; //default!
		} else {
			$this->limit = $new_limit;
		}
	}
	public function set_category($new_category) {
		$this->category = $new_category;
	}
}

?>