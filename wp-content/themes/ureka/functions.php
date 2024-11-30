<?php
//Define text domain name
define('THEME_TD', 'ureka');
define('THEME_VER', '1.00');
define('THEME_ROOT', get_template_directory());
define('THEME_ROOT_URI', get_template_directory_uri());


// CPT TAXONOMY

include( 'configure/cpt-taxonomy.php' );

// Utilities

include( 'configure/utilities.php' );

// CONFIG

include( 'configure/configure.php' );

// JAVASCRIPT & CSS

include( 'configure/js-css.php' );

// SHORTCODES

include( 'configure/shortcodes.php' );

// ACF

include( 'configure/acf.php' );


// Menu Walker

include( 'configure/menu-walker.php' );

// HOOKS ADMIN

if(is_admin()) {
	include( 'configure/admin.php' );
}
