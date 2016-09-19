<?php

   /*
   Plugin Name: Margot's JSON Converter
   Description: Pulls data from a JSON endpoint and outputs & formats the results
   Shortcode example: [margot-json-converter endpoint="http://targetURL.biz" limit=3 category="news"]] where endpoint is required, but limit & category are not.
   Version: 1.0
   Author: Margot McMahon
   Author URI: http://margot.dog
   License: GPL2
   */

include 'class-library.php';

function shortcode_init() {
	function json_converter_shortcode($attsArray = []) {

		$jsonManipulation = new jsonManipulation;

		//check for unsupported attributes
		$jsonManipulation->invalid_atts_check($attsArray);

		//show error message if $attsArray empty
		$jsonManipulation->endpoint_check($attsArray);

		//normalizing attributes:
		$attsArray = array_change_key_case((array)$attsArray, CASE_LOWER);

   		//assign attributes to object
   		$jsonManipulation->set_endpoint($attsArray['endpoint']);

		$jsonManipulation->set_limit($attsArray['limit']);

		$jsonManipulation->set_category($attsArray);

		//glean json from endpoint, change to array
		$jsonArray = $jsonManipulation->get_contents($attsArray['endpoint']);

		//iterate across array to display results
		$jsonManipulation->iterate($jsonArray);
	}

add_shortcode('margot-json-converter', 'json_converter_shortcode');
}

add_action('init', 'shortcode_init');

?>