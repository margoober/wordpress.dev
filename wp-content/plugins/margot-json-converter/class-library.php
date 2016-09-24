<?php
/*
CLASS JsonContentParser
Description: Classes for JSON converter
Version: 1.0
Author: Margot McMahon
Author URI: http://margot.dog
*/

class jsonManipulation {

	//check for endpoint
	public function endpoint_check($attsArray) {
		if (!array_key_exists('endpoint', $attsArray)) {
			echo "<h2 class='error'>Oops! You must specify a JSON endpoint in this shortcode. Example: [margot-json-converter endpoint='http://targetURL.biz' limit=3 category='news']</h2>";
			exit();
		}
	}

	//check for unaccepted attributes
	public function invalid_atts_check($attsArray) {
		foreach ($attsArray as $att => $value) {
			if (array_key_exists($att, $attsArray) && ($att != 'endpoint' && ($att != 'category' && $att != 'limit'))) {
				echo "<h2 class='error'>Oops! Looks like you've included an unsupported attribute.</h2>";
			exit();
			}
		}
	}

	//methods to assign attributes to object
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

	//cURL
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

	public function trim_date($date){
		$createDate = new DateTime($date);
		$strip = $createDate->format('M d Y');
		return $strip;
	}
	public function display($post) {
		$date = self::trim_date($post['date']);
		echo "<h2 class='title'>" . $post['title'] . "</h2>" . "<p class='author'>by " . $post['author']['name'] . " on " . $date . "</p><p class='body'>" . $post['content'] . "</p> <hr>";
	}

	//iterates across jsonArray to display appropriate posts
	public function iterate($jsonArray) {
		$counter = 0;
		foreach ($jsonArray as $post) {
			if ($this->category == 'all') {
				self::display($post);
			} else {
				if ($post['terms']['category'][0]['slug'] == $this->category) {
					self::display($post);
				}
			}
			$counter = $counter + 1;
			if ($counter = $this->limit) {
				break;
			}
		}
	}
}

?>