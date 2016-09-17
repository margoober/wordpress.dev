<?php
   /*
   Plugin Name: Margot's JSON Converter
   Description: Pulls data from a JSON endpoint and outputs & formats the results
   Version: 1.0
   Author: Margot McMahon
   Author URI: http://margot.dog
   License: GPL2
   */



   $posts = file_get_contents('local-json-file.php');
   $posts = json_decode($posts, true);

   foreach ($posts as $post) {
   	print_r($post['title'] . PHP_EOL . $post['content']);
   }


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
