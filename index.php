<?php
/*
Plugin Name:  Know Co. App Integration: Forms
Description:  Custom front end integration for the Know Platform Forms app.
Version:      1.1.6
Author:       Know Co.
Author URI:   https://getknow.co/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die();

add_action( 'admin_init', 'know__forms__register_settings' );
function know__forms__register_settings(){
	register_setting('know--forms--settings-group', 'know__forms__element__input_styles');
	register_setting('know--forms--settings-group', 'know__forms__element__input_classes');

	register_setting('know--forms--settings-group', 'know__forms__element__textarea_styles');
	register_setting('know--forms--settings-group', 'know__forms__element__textarea_classes');

	register_setting('know--forms--settings-group', 'know__forms__element__select_styles');
	register_setting('know--forms--settings-group', 'know__forms__element__select_classes');

	register_setting('know--forms--settings-group', 'know__forms__element__button_styles');
	register_setting('know--forms--settings-group', 'know__forms__element__button_classes');
}

add_action( 'wp_enqueue_scripts', 'know__forms__enqueue_scripts' ); 
function know__forms__enqueue_scripts() {
	//wp_enqueue_script('know--forms--vue', plugin_dir_url(__FILE__) . 'js/vue.js');
	wp_enqueue_script('know--forms--vue', plugin_dir_url(__FILE__) . 'js/vue.min.js');
	wp_enqueue_script('know--forms--axios', plugin_dir_url(__FILE__) . 'js/axios.min.js');
	wp_enqueue_script('know--forms--vue-http-loader', plugin_dir_url(__FILE__) . 'js/httpVueLoader.js', array('know--forms--vue'));
	wp_enqueue_script('know--forms--app', plugin_dir_url(__FILE__) . 'js/app.js', array('know--forms--vue-http-loader', 'jquery'), false, true);
}

add_action('admin_menu', 'know__forms__admin_menu', 11);
function know__forms__admin_menu(){
    
	add_submenu_page(
	    'know_settings', // Parent
	    'Forms Settings', // Page Title
	   	'Forms', // Menu Title
	    'manage_options', // Capability
	    'know_forms', // Menu Slug
	    'know__forms__settings_init' // Render Function
	);

}

function know__forms__settings_init(){


	?>

    <style>
    	.know--container{
    		padding-right: 10px;
    	}
    	.know--input{
    		width: 100%;
    	}
    </style>

    <div class="know--container">
	    <div class="wrap">
			<h1>Forms Settings</h1>

			Will include fields to apply CSS classes and custom styling to components.<br>
			<br>
			To use the event portal, copy and paste the following shortcode to your page.<br>
			Once you enter the shortcode, simply use a parameter to enter the API Name of your form. Example:<br>
			<code>[know--forms form="contact_form"]</code>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">
			    <?php settings_fields( 'know--forms--settings-group' ); ?>
			    <?php do_settings_sections( 'know--forms--settings-group' ); ?>

			    <h2>CSS</h2>
			    <table class="form-table">
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__input_classes">Input Classes</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__input_classes" class="know--input" id="know__forms__element__input_classes" value="<?php echo esc_attr( get_option('know__forms__element__input_classes') ); ?>">
			        	</td>
			        </tr>
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__input_styles">Input Styles</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__input_styles" class="know--input" id="know__forms__element__input_styles" value="<?php echo esc_attr( get_option('know__forms__element__input_styles') ); ?>">
			        	</td>
			        </tr>
			    </table>

			    <hr>

			    <table class="form-table">
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__textarea_classes">Textarea Classes</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__textarea_classes" class="know--input" id="know__forms__element__textarea_classes" value="<?php echo esc_attr( get_option('know__forms__element__textarea_classes') ); ?>">
			        	</td>
			        </tr>
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__textarea_styles">Textarea Styles</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__textarea_styles" class="know--input" id="know__forms__element__textarea_styles" value="<?php echo esc_attr( get_option('know__forms__element__textarea_styles') ); ?>">
			        	</td>
			        </tr>
			    </table>

			    <hr>

			    <table class="form-table">
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__select_classes">Dropdown Classes</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__select_classes" class="know--input" id="know__forms__element__select_classes" value="<?php echo esc_attr( get_option('know__forms__element__select_classes') ); ?>">
			        	</td>
			        </tr>
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__select_styles">Dropdown Styles</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__select_styles" class="know--input" id="know__forms__element__select_styles" value="<?php echo esc_attr( get_option('know__forms__element__select_styles') ); ?>">
			        	</td>
			        </tr>
			    </table>

			    <hr>

			    <table class="form-table">
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__button_classes">Button Classes</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__button_classes" class="know--input" id="know__forms__element__button_classes" value="<?php echo esc_attr( get_option('know__forms__element__button_classes') ); ?>">
			        	</td>
			        </tr>
			        <tr valign="top">
			        	<th scope="row">
			        		<label for="know__forms__element__button_styles">Button Styles</label>
			        	</th>
			        	<td>
			        		<input type="text" name="know__forms__element__button_styles" class="know--input" id="know__forms__element__button_styles" value="<?php echo esc_attr( get_option('know__forms__element__button_styles') ); ?>">
			        	</td>
			        </tr>
			    </table>
			    
			    <?php submit_button(); ?>

			</form>
		</div>
	</div>

    <?php

}

add_shortcode('know--forms', 'know__form');
function know__form($atts = [], $content = null, $tag = ''){
	
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
 
    $wporg_atts = shortcode_atts([
		'form' => '',
		'id' => ''
	], $atts, $tag);
	
	$know = new know();
	if($know->server == ''){

		$know->add_alert('Please activate your platform URL prior to configuring.', 'System Error', 'danger');
		$know->display_alerts();

	} else if($wporg_atts['form']==""){ 
		
		$know->add_alert('Please check your Form API Name.', 'System Error', 'danger');
		$know->display_alerts();
		
	}  else { 

		$form_api_name = $wporg_atts['form'];
		$know_server = $know->server;

		$css = know__forms__get_css();

		$css__input_classes = $css['know__forms__element__input_classes'];
		$css__input_styles = $css['know__forms__element__input_styles'];
		$css__textarea_classes = $css['know__forms__element__textarea_classes'];
		$css__textarea_styles = $css['know__forms__element__textarea_styles'];
		$css__select_classes = $css['know__forms__element__select_classes'];
		$css__select_styles = $css['know__forms__element__select_styles'];
		$css__button_classes = $css['know__forms__element__button_classes'];
		$css__button_styles = $css['know__forms__element__button_styles'];

		

		$output = <<<EOF
		<style>
			.know--forms--form_container {
				margin-bottom: 25px;
			}

			.know--forms--input {
				/*width: 100%;*/
			}

			.know--forms--button {
				/*width: 100%;*/
			}

			.know--forms--help_text {
				vertical-align: middle;
			}

			.know--forms--pre_help_text {
				margin-right: 20px;
			}

			.know--forms--post_help_text {
				margin-left: 15px;
			}

			.know--forms--label {
				vertical-align: middle;
			}

			.know--forms--radio_button,
			.know--forms--checkbox {
				vertical-align: top;
			}

			.know__forms__content {
				min-height: 20px;
			}

		</style>
		<div class="know__forms__content" data-know-server="$know_server" data-know-form-api-name="$form_api_name"></div>
		<script>
			var class_translation = {
				app: {
					classes: 'know--forms--form_container',
					override: false
				},
				no_content: {
					classes: '',
					override: false
				},
				form_page: {
					classes: '',
					override: false
				},
				form_element_container: {
					classes: '',
					override: false
				},
				form_element: {
					h1: {
						classes: '',
						override: false
					},
					h2: {
						classes: '',
						override: false
					},
					p: {
						classes: '',
						override: false
					},
					text_box_label: {
						classes: '',
						override: false
					},
					text_box: {
						classes: 'know--forms--input $css__input_classes',
						styles: '$css__input_styles',
						override: true
					},
					text_area_label: {
						classes: '',
						override: false
					},
					text_area: {
						classes: 'know--forms--input $css__textarea_classes',
						styles: '$css__textarea_styles',
						override: false
					},
					picklist_label: {
						classes: '',
						override: false
					},
					picklist: {
						classes: 'know--forms--input $css__select_classes',
						'styles' : '$css__select_styles',
						override: false
					},
					vertical_radio_buttons_label: {
						classes: '',
						override: false
					},
					vertical_radio_button_option_label: {
						classes: '',
						override: false
					},
					vertical_radio_button: {
						classes: 'know--forms--radio_button',
						override: false
					},
					horizontal_radio_buttons_label: {
						classes: '',
						override: false
					},
					horizontal_radio_button_option_label: {
						classes: 'know--forms--label',
						override: false
					},
					horizontal_radio_button_pre_help_text: {
						classes: 'know--forms--help_text know--forms--pre_help_text',
						override: true
					},
					horizontal_radio_button_post_help_text: {
						classes: 'know--forms--help_text know--forms--post_help_text',
						override: true
					},
					horizontal_radio_button: {
						classes: 'know--forms--radio_button',
						override: false
					},
					vertical_checkboxes_label: {
						classes: '',
						override: false
					},
					vertical_checkbox_option_label: {
						classes: 'know--forms--label',
						override: false
					},
					vertical_checkbox: {
						classes: 'know--forms--checkbox',
						override: false
					},
					horizontal_checkboxes_label: {
						classes: '',
						override: false
					},
					horizontal_checkbox_option_label: {
						classes: 'know--forms--label',
						override: false
					},
					horizontal_checkbox: {
						classes: 'know--forms--checkbox',
						override: false
					},
					datepicker_label: {
						classes: '',
						override: false
					},
					datepicker_select: {
						classes: '',
						override: false
					},
					timepicker_label: {
						classes: '',
						override: false
					},
					timepicker_select: {
						classes: '',
						override: false
					}
				},
				button_container: {
					classes: '',
					override: false
				},
				continue_button: {
					classes: 'know--forms--button $css__button_classes',
					'styles' : '$css__button_styles',
					override: true
				},
				submit_button: {
					classes: 'know--forms--button $css__button_classes',
					'styles' : '$css__button_styles',
					override: true
				}
			};
		</script>
EOF;

		return $output;
	}
	
}

function know__forms__get_css(){
	get_option('know--forms--settings-group');

	return array(
		'know__forms__element__input_styles' => get_option('know__forms__element__input_styles'),
		'know__forms__element__input_classes' => get_option('know__forms__element__input_classes'),
		'know__forms__element__textarea_styles' => get_option('know__forms__element__textarea_styles'),
		'know__forms__element__textarea_classes' => get_option('know__forms__element__textarea_classes'),
		'know__forms__element__select_styles' => get_option('know__forms__element__select_styles'),
		'know__forms__element__select_classes' => get_option('know__forms__element__select_classes'),
		'know__forms__element__button_styles' => get_option('know__forms__element__button_styles'),
		'know__forms__element__button_classes' => get_option('know__forms__element__button_classes')
	);
	
}