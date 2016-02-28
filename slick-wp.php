<?php
/*
Plugin Name: Slick Slider
Plugin URI:  https://wordpress.org/plugins/slick-wp/
Description: Turn your native WordPress galleries into beautiful sliders using the awesome “slick” slider.
Version:     1.0
Author:      Philipp Bammes
Text Domain: slick-wp
Domain Path: /languages/
License:     GPL2

Slick Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Slick Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Slick Slider. If not, see {URI to Plugin License}.
*/


/* Quit */
defined( 'ABSPATH' ) OR exit;

define( 'SLICK_DIR', dirname( __FILE__ ) );
define( 'SLICK_FILE', __FILE__ );
define( 'SLICK_BASE', plugin_basename( __FILE__ ) );
define( 'SLICK_MIN_PHP', 5.6 );


require_once sprintf(
	'%s/inc/_%s.class.php',
	SLICK_DIR,
	( is_admin() ? 'be' : 'fe' )
);

spl_autoload_register(
	'slick_autoload'
);

add_action(
	'plugins_loaded',
	array(
		'Slick',
		'init'
	)
);


register_activation_hook(
	__FILE__,
	array(
		'Slick',
		'install'
	)
);

register_uninstall_hook(
	__FILE__,
	array(
		'Slick',
		'uninstall'
	)
);


function slick_autoload( $class ) {

	$available = array(
		'Slick_Cache' => 'cache',
		'Slick_Feedback' => 'feedback',
		'Slick_Options' => 'options',
		'Slick_Output' => 'output',
		'Slick_GUI' => 'gui',
		'Slick_Template' => 'template',
	);

	if ( isset( $available[$class] ) ) {
		require_once(
			sprintf(
				'%s/inc/%s.class.php',
				SLICK_DIR,
				$available[$class]
			)
		);
	}

}