<?php
/*
 *	Redactor Editor Settings Page
 */

// Register function
function redactor_settings_register(){

	// Initialize
	$page_title = 'Redactor Editor Settings';
	$menu_title = 'Redactor';
	$capability = 'add_users';
	$menu_slug = str_replace(' ', '-', strtolower($page_title));
	$icon_url = plugins_url('redactor_editor/images/icon.png');
	$menu_position = 79;
	
	// Add page
	add_menu_page($page_title, $menu_title, $capability, $menu_slug, 'redactor_settings_main', $icon_url, $menu_position);

	// Register settings
	register_setting('redactor_settings_main', 'redactor_action_selector');
	register_setting('redactor_settings_main', 'redactor_content_selector');
	register_setting('redactor_settings_main', 'redactor_fixed_mode');
	register_setting('redactor_settings_main', 'redactor_wym_mode');
	register_setting('redactor_settings_main', 'redactor_air_mode');
	register_setting('redactor_settings_main', 'redactor_qtrans_mode');
	register_setting('redactor_settings_main', 'redactor_direction_mode');
	register_setting('redactor_settings_main', 'redactor_buttons');
}

// Hooks
add_action('admin_menu', 'redactor_settings_register');

// Display function
function redactor_settings_main(){ ?>
	<div class="wrap">
	<form method="post" action="options.php">
	    <?php settings_fields('redactor_settings_main'); ?>
	    <?php do_settings_sections('redactor_settings_main'); ?>
	    <h2>Redactor Editor</h2>
	    <table class="form-table">
	        <tr valign="top">
		        <th scope="row">jQuery selector to attach redactor click event to:</th>
		        <td><input type="text" name="redactor_action_selector" placeholder=".post-edit-link" value="<?php echo get_option('redactor_action_selector', '.post-edit-link'); ?>" /></td>
	        </tr>
	
	        <tr valign="top">
		        <th scope="row">jQuery selector for the editable content area:</th>
		        <td><input type="text" name="redactor_content_selector" placeholder=".entry-content" value="<?php echo get_option('redactor_content_selector', '.entry-content'); ?>" /></td>
	        </tr>
	    </table>
	
	    <h2>Editor Preferences</h2>
	    <table class="form-table">
	        <tr valign="top">
		        <th scope="row">Fixed toolbar:</th>
		        <td><input type="text" name="redactor_fixed_mode" placeholder="true" value="<?php echo get_option('redactor_fixed_mode', 'true'); ?>" /></td>
	        </tr>
	
	        <tr valign="top">
		        <th scope="row">Visual mode:</th>
		        <td><input type="text" name="redactor_wym_mode" placeholder="true" value="<?php echo get_option('redactor_wym_mode', 'true'); ?>" /></td>
	        </tr>
	
	        <tr valign="top">
		        <th scope="row">Air mode:</th>
		        <td><input type="text" name="redactor_air_mode" placeholder="false" value="<?php echo get_option('redactor_air_mode', 'false'); ?>" /></td>
	        </tr>
	    </table>
	    
	    <h2>Language Preferences</h2>
	    <table class="form-table">
	        <tr valign="top">
		        <th scope="row">qTranslate support:</th>
		        <td><input type="text" name="redactor_qtrans_mode" placeholder="false" value="<?php echo get_option('redactor_qtrans_mode', 'false'); ?>" /></td>
	        </tr>
	
	        <tr valign="top">
		        <th scope="row">Language direction:</th>
		        <td><input type="text" name="redactor_direction_mode" placeholder="ltr" value="<?php echo get_option('redactor_direction_mode', 'ltr'); ?>" /></td>
	        </tr>
	    </table>

<!--
	    <h2>Buttons</h2>
	    <table class="form-table">
	        <tr valign="top">
		        <th scope="row">Enabled:</th>
		        <td>
		        	<select name="redactor_buttons" placeholder="false" value="<?php echo get_option('redactor_buttons', 'false'); ?>" />
		        </td>
	        </tr>
	
	        <tr valign="top">
		        <th scope="row">Available:</th>
		        <td><input type="text" name="redactor_direction_mode" placeholder="ltr" value="<?php echo get_option('redactor_direction_mode', 'ltr'); ?>" /></td>
	        </tr>
	    </table>
-->
	    <p class="submit">
		    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	    </p>
	</form>
	</div>
<?php }