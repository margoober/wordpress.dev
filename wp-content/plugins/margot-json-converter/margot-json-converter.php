<?php

   /*
   Plugin Name: Margot's JSON Converter
   Description: Pulls data from a JSON endpoint and outputs & formats the results
   Version: 1.0
   Author: Margot McMahon
   Author URI: http://margot.dog
   License: GPL2
   */

include 'class-library.php';

function shortcode_init() {
	function json_converter_shortcode($attsArray = []) {

		$jsonManipulation = new jsonManipulation;

		//show error message if $attsArray empty
		$jsonManipulation->endpoint_check($attsArray);

		//normalizing attributes:
		$attsArray = array_change_key_case((array)$attsArray, CASE_LOWER);

   		//assign attributes to object
   		$jsonManipulation->set_endpoint($attsArray['endpoint']);

		$jsonManipulation->set_limit(3);

		$jsonManipulation->set_category('news');

		//glean json from endpoint, change to array
		$jsonArray = $jsonManipulation->get_contents('https://mind.sh/are/wp-json/posts');

		//iterate across array to display results
		$jsonManipulation->iterate($jsonArray);
	}

add_shortcode('margot-json-converter', 'json_converter_shortcode');
}

add_action('init', 'shortcode_init');

?>