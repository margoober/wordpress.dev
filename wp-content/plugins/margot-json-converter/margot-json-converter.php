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
		$jsonString = file_get_contents($jsonManipulation->endpoint);
		$jsonArray = json_decode($jsonString, true);
   		print_r("shortcode ran");
   		var_dump($jsonManipulation);

   		//foreach through the posts? set counter? move this to the class?
   		$counter = 0; //counter
   		foreach ($jsonArray as $post) if ($post['terms']['category'][0]['slug'] == $jsonManipulation->category) {
   			print_r("post number " . ($counter + 1) . PHP_EOL);
   			print_r($post['title'] . PHP_EOL . $post['content']);
   			if (++$counter == $jsonManipulation->limit) {
					break;
				}
			}
		}

   	add_shortcode('margot-json-converter', 'json_converter_shortcode');
   }
   add_action('init', 'shortcode_init');
			



   // print_r($posts[0]["title"]);


   // CURL ATTEMPT WORKS BUT PERMISSION STILL DENIED
	// function file_get_contents_curl($url) {
	//     $ch = curl_init();

	//     curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	//     curl_setopt($ch, CURLOPT_HEADER, 0);
	//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//     curl_setopt($ch, CURLOPT_URL, $url);
	//     //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

	//     $data = curl_exec($ch);
	//     curl_close($ch);

	//     print_r($data);
	// }
	
	// file_get_contents_curl("/local-json-file.php");

   //END CURL ATTEMPT 

?>
