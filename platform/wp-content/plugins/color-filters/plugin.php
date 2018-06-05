<?php
/*
  Plugin Name: Color Filters for WooCommerce
  Plugin URI: https://www.etoilwebdesign.com/plugins/color-filters/
  Description: Filter WooCommerce products by color from a sidebar widget.
  Author: Etoile Web Design
  Author URI: https://www.etoilewebdesign.com
  Version: 1.2.2
*/

define( 'CF_VERSION', '1.2.2' );
define( 'CF_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'CF_INCLUDES_PATH', CF_PLUGIN_PATH . '/includes' );
define( 'CF_PLUGIN_FOLDER', basename( CF_PLUGIN_PATH ) );
define( 'CF_PLUGIN_URL', plugins_url() . '/' . CF_PLUGIN_FOLDER );

require CF_PLUGIN_PATH . '/color-filters.php';
require CF_INCLUDES_PATH . '/widgets.php';

$color_filters = new NM_Color_Filters();

// Install plugin
register_activation_hook( __FILE__, array( $color_filters, 'install' ) );
