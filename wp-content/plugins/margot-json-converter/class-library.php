<?php
/*
CLASS JsonContentParser
Description: Classes for JSON converter
Version: 1.0
Author: Margot McMahon
Author URI: http://margot.dog
*/

class jsonManipulation {

	public function endpoint_check($attsArray) {
		if (!array_key_exists('endpoint', $attsArray)) {
			print_r('Oops! You must specify a JSON endpoint in this shortcode. Example: [margot-json-converter endpoint="http://targetURL.biz" limit=3 category="news"]');
			exit();
		}
	}

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
	public function set_category($attsArray) {
		if (array_key_exists('category', $attsArray)) {
			$this->category = $attsArray['category'];	
		} else {
			$this->category = 'all';
		}
	}

	public function get_contents($endpoint) {
		$curl_session = curl_init();
		curl_setopt($curl_session,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) curl_sessionrome/52.0.2743.116 Safari/537.36');
		curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
		// Set url
		curl_setopt($curl_session, CURLOPT_URL,$endpoint);
		// Execute
		$result = curl_exec($curl_session);

		//Error message if URL invalid
		if ($result == false) {
			echo "Error! Invalid endpoint URL: " . $endpoint;
			exit();
		}

		curl_close($curl_session);
		return json_decode($result, true);
	}

	//iterates across jsonArray to display results
	public function iterate($jsonArray) {
		$counter = 0;
		foreach ($jsonArray as $post) {
			if ($this->category == 'all') {
				echo "<p class='title'>" . $post['title'] . "</p>";
			} else {
				if ($post['terms']['category'][0]['slug'] == $this->category) {
					echo "<p class='title'>" . $post['title'] . "</p>";
				}
			}
		}
	}
}

?>