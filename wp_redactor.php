<?php
/*
 *	Plugin Name: Redactor Editor
 *	Plugin URI: http://someisteee.com
 *	Version: 1.0 beta
 *	Author: Jeff Hays
 *	Author URI: http://offthewallmedia.com
 */

function redactor_scripts(){

	// Set script locations
	$redactorjs = plugins_url('redactor/redactor.js', __FILE__);
	$pluginjs = plugins_url('wp_redactor.js', __FILE__);
	$postID = get_the_id();

	// Load jQuery
	wp_register_script('jquery');
	wp_enqueue_script('jquery');

	// Redactor script
	wp_register_script('redactor', $redactorjs, 'jquery');
	wp_enqueue_script('redactor');

	// Redactor plugin scripts
	wp_register_script('redactor-plugin', $pluginjs, 'jquery');
	wp_enqueue_script('redactor-plugin');
	
	// Redactor language support with qtranslate
	if(function_exists('qtrans_getLanguage') && qtrans_getLanguage() != 'en'){
		wp_register_script('redactor-language-' . qtrans_getLanguage(), plugins_url('lang/' . qtrans_getLanguage() . '.js', __FILE__), 'jquery');
		wp_enqueue_script('redactor-language-' . qtrans_getLanguage());
	}
	
	// Wordpress upload scripts
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');

	// Grab settings from admin
	$action_selector = get_option('redactor_action_selector', '.post-edit-link');
	if(strlen($action_selector) <= 0) $action_selector = '.post-edit-link';
	$content_selector = get_option('redactor_content_selector', '.entry-content');
	if(strlen($content_selector) <= 0) $content_selector = '.entry-content';
	$redactor_fixed_mode = get_option('redactor_fixed_mode', 'true');
	if(strlen($redactor_fixed_mode) <= 0) $redactor_fixed_mode = 'true';
	$redactor_wym_mode = get_option('redactor_wym_mode', 'true');
	if(strlen($redactor_wym_mode) <= 0) $redactor_wym_mode = 'true';
	$redactor_air_mode = get_option('redactor_air_mode', 'false');
	if(strlen($redactor_air_mode) <= 0) $redactor_air_mode = 'false';
	$redactor_qtrans_mode = get_option('redactor_qtrans_mode', 'false');
	if(strlen($redactor_qtrans_mode) <= 0) $redactor_qtrans_mode = 'false';
	$redactor_direction_mode = get_option('redactor_direction_mode', 'ltr');
	if(strlen($redactor_direction_mode) <= 0) $redactor_direction_mode = 'ltr';

	// Ghetto echo to set WordPress variables we need in js - this should be changed eventually
	echo "<script type='text/javascript'>
		var redactorURL = '". plugins_url('', __FILE__) ."';
		var adminURL = '". admin_url() ."';
		var postID = '{$postID}';
		var action_selector = '{$action_selector}';
		var content_selector = '{$content_selector}';
		var redactor_fixed_mode = {$redactor_fixed_mode};
		var redactor_wym_mode = {$redactor_wym_mode};
		var redactor_air_mode = {$redactor_air_mode};
		var redactor_qtrans_mode = {$redactor_qtrans_mode};
		var redactor_direction_mode = '{$redactor_direction_mode}';
	</script>";
}

function redactor_styles(){

	// Set style locations
	$redactorstyle = plugins_url('css/style.css', __FILE__);
	$redactorcss = plugins_url('redactor/redactor.css', __FILE__);
	
	// Load redactor stylesheet
	wp_register_style('redactor', $redactorcss);
	wp_enqueue_style('redactor');

	// Load redactor customizations
	wp_register_style('redactor-style', $redactorstyle);
	wp_enqueue_style('redactor-style');
	
	// Wordpress upload styles
	wp_enqueue_style('thickbox');
}

// Hook into WordPress events
add_action('wp_print_styles', 'redactor_styles');
add_action('wp_enqueue_scripts', 'redactor_scripts');

// Setup settings page
include "wp_settings.php";