<?php
/*
Plugin Name: WP Redirect Mobile
Plugin URI: http://defaulttricks.com/
Description: This plugin redirects all mobile users to mobile website link.
Author: Mohit Bumb
Version: 1.0
Author URI: http://defaulttricks.com/
*/
define('PATH', plugin_dir_url(__FILE__));
?>

<?php
	add_action('wp_enqueue_scripts', 'wprm_scripts');
	add_action('admin_menu','wprm_menu');
	add_action('admin_init','wprm_settings');
	add_action('wp_head','wprm_code');
	
	function wprm_code(){
	?>
	<script type="text/javascript">
		<?php if(get_option('wprm_link')): ?>
		jQuery(document).ready(function(){
			if(jQuery.browser.mobile){
				window.location='<?php echo "http://".get_option('wprm_link');  ?>'
			}
		});
		<?php endif; ?>
	</script>	
	<?php
    }
	
	function wprm_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'jquery.mobile.browser', PATH."/jQuery.mobile.browser.js");
		wp_enqueue_script( 'jquery.mobile.browser' );
	}    
	
	function wprm_menu(){
		add_submenu_page( 'options-general.php', 'WP Redirect Mobile', 'WP Redirect Mobile', 'manage_options', 'WP-Redirect-Mobile', 'wp_redirect_mobile' );
	}
	
	function wprm_settings(){
		register_setting('wprm-settings','wprm_link');
	}
	
	function wp_redirect_mobile(){
		?>
        <div style="margin-left:415px;margin-top:54px;" id="wrap">
        <p>Write the link where you wants to redirect your mobile visitors.<br />
        Leave blank for stop redirecting.<br />
        <strong>Note : Do Not Add "http://"</strong></p>
        <form method="post" action="options.php">
		<?php settings_fields('wprm-settings') ?>
        <table>
        	<tr>
            <td>Link</td><td>http://<input type="text" name="wprm_link" id="wprm_link" value="<?php echo get_option('wprm_link') ?>"></td>
            </tr>
            <tr>
            <td></td><td><input type="submit" name="submit" id="submit" value="Save"></td>
            </tr>
        </table>
        </form>
        </div>
		<?php
	}
?>