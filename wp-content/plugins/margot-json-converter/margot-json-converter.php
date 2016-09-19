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
	function json_converter_shortcode($attsArray = [], $posts = null) {
	//normalizing attributes:
		$attsArray = array_change_key_case((array)$attsArray, CASE_LOWER);

   		$jsonManipulation = new jsonManipulation;
   		//assign attributes to object
   		$jsonManipulation->set_endpoint('/vagrant/sites/wordpress.dev/public/wp-content/plugins/margot-json-converter/local-json-file.php');
		$jsonManipulation->set_limit(3);
		$jsonManipulation->set_category('news');

		//glean & stringify json from endpoint
		$jsonArray = $jsonManipulation->get_contents('https://mind.sh/are/wp-json/posts');

		$jsonManipulation->iterate($jsonArray);
		
	}

add_shortcode('margot-json-converter', 'json_converter_shortcode');
}
add_action('init', 'shortcode_init');
			



   // print_r($posts[0]["title"]);


	// }
	
	// file_get_contents_curl("/local-json-file.php");

   //END CURL ATTEMPT 

?>
