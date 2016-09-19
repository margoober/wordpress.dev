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
			$this->limit = 5; //default!
		} else {
			$this->limit = $new_limit;
		}
	}
	public function set_category($new_category) {
		$this->category = $new_category;
	}
	public function get_contents($endpoint) {
		$curl_session = curl_init();
		curl_setopt($curl_session,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) curl_sessionrome/52.0.2743.116 Safari/537.36');
		curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
		// Set url
		curl_setopt($curl_session, CURLOPT_URL,$endpoint);
		// Execute
		$result=curl_exec($curl_session);
		curl_close($curl_session);
		return json_decode($result, true);
	}

	public function category_search() {
		if (isset($this->category)) {
			return true;
		} else {
			return false;
		}
	}
	//iterates across jsonArray to display results
	public function iterate($jsonArray) {
		$counter = 0;
		foreach ($jsonArray as $post)
			if (isset($this->category)) {
				if ($post['terms']['category'][0]['slug'] == $this->category) {
				echo "<p class='title'>" . $post['title'] . "</p>";
			}

			if (++$counter == $this->limit) {
					break;
			}
		}
	}
}

?>