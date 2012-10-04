<?php
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
?>

// Ghetto echo to set WordPress variables we need in js - this should be changed eventually
	var redactorURL = "<?php plugins_url('redactor', __FILE__); ?>";
	var adminURL = "<?php admin_url(); ?>";
	var postID = "<?php echo $postID; ?>";
	var action_selector = "<?php echo $action_selector; ?>";
	var content_selector = "<?php echo $content_selector; ?>";
	var redactor_fixed_mode = <?php echo $redactor_fixed_mode; ?>;
	var redactor_wym_mode = <?php echo $redactor_wym_mode; ?>;
	var redactor_air_mode = <?php echo $redactor_air_mode; ?>;
	var redactor_qtrans_mode = <?php echo $redactor_qtrans_mode; ?>;
	var redactor_direction_mode = "<?php echo $redactor_direction_mode; ?>";