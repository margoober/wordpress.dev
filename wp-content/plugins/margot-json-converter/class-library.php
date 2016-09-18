<?php
/*
CLASS JsonContentParser
Description: Classes for JSON converter
Version: 1.0
Author: Margot McMahon
Author URI: http://margot.dog
*/


class shortcode {
	function __construct() {
		//methods to set parameters
		function set_endpoint($new_endpoint) {
			$this->endpoint = $new_endpoint;
		}
		function set_limit($new_limit) {
			$this->limit = $new_limit;
		}
		function set_category($new_category) {
			$this->category = $new_category;
		}
		//initiate shortcode
		function shortcode_init() {
			function json_converter_shortcode($atts = [], $posts = null)
			{
				print_r("shortcode ran");
			}
			add_shortcode('margot-json-converter', 'json_converter_shortcode');
		}
		add_action('init', 'shortcode_init');
		print_r("shortcode class instantiated!");
	}
}

?>