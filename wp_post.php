<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$wphead = str_replace('wp-content/plugins/redactor_editor/redactor/wp-post.php', '', __FILE__) . 'wp-blog-header.php';
	include($wphead);
		
	// Extract variables from post
	extract($_POST);
	
	// Setup post array
    $post = array();
    $post['ID'] = $id;
    $post['post_content'] = $content;

    // Update the post into the database
	wp_update_post($post);

	
