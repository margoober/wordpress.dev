<?php
   /*
   Plugin Name: Margot's JSON Converter
   Description: Pulls data from a JSON endpoint and outputs & formats the results
   Version: 1.0
   Author: Margot McMahon
   Author URI: http://margot.dog
   License: GPL2
   */

//shorcode test
	function shortcode_init()
	{
		function json_converter_shortcode($atts = [], $posts = null)
		{
			//normalizing attributes:
			$atts = array_change_key_case((array)$atts, CASE_LOWER);

			$posts = file_get_contents('/vagrant/sites/wordpress.dev/public/wp-content/plugins/margot-json-converter/local-json-file.php');
			//NOTE: Why did I have to include the entire path name?
			$posts = json_decode($posts, true);
			$i = 0; //counter
			$limit = $atts['limit'];
			foreach ($posts as $post) {
				print_r("post number " . ($i + 1) . PHP_EOL);
				print_r($post['title'] . PHP_EOL . $post['content']);
				if (++$i == $limit) {
					break;
				}
			}
	        // // do something to $content
	        // // always return
	        // return $content;
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
