<?php
/*
CLASS JsonContentParser
Description: Classes for JSON converter
Version: 1.0
Author: Margot McMahon
Author URI: http://margot.dog
*/

class jsonManipulation {
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
	public function get_contents($endpoint) {
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$endpoint);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);

		// Will dump the json
		return json_decode($result, true);
	}
}

?>