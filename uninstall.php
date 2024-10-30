<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$names = array(
	'know__forms__element__input_styles',
	'know__forms__element__input_classes',
	'know__forms__element__select_styles',
	'know__forms__element__select_classes',
	'know__forms__element__button_styles',
	'know__forms__element__button_classes',
	'know__forms__element__textarea_styles',
	'know__forms__element__textarea_classes'
);

foreach($names as $name){
	delete_option($name);
	delete_site_option($name);// for site options in Multisite
}