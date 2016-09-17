<?php
   /*
   Plugin Name: Margot's JSON Converter
   Description: Pulls data from a JSON endpoint and outputs & formats the results
   Version: 1.0
   Author: Margot McMahon
   Author URI: http://margot.dog
   License: GPL2
   */


	function wporg_shortcodes_init()
	{
		function wporg_shortcode($atts = [], $content = null)
		{
	        // do something to $content
	 
	        // always return
	        echo "shortcode ran! ring the bells";;
	        return $content;
	    }
	    add_shortcode('wporg', 'wporg_shortcode');
	}
	add_action('init', 'wporg_shortcodes_init');



   $posts = file_get_contents('/vagrant/sites/wordpress.dev/public/wp-content/plugins/margot-json-converter/local-json-file.php');
   //NOTE: Why did I have to include the entire path name?
   $posts = json_decode($posts, true);

//foreach through the posts and titles
   // foreach ($posts as $post) {
   // 	print_r($post['title'] . PHP_EOL . $post['content']);
   // }

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
