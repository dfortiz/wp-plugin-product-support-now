<?php
/**
 * @wordpress-plugin 
 * Plugin Name: 	product-support-now
 * Plugin URI: 		https://boliviahub.com/product-support-now
 * Description: 	Add a link to web-whatsapp chat on each product in a WooCommerce Store, with information about the product. You can schedule your support turn.
 * Version: 		1.0.0
 * Author: 			Frank Ortiz
 * Author URI: 		https://dfortiz.github.io
 * Text Domain: 	product-support-now
 * Tags: 			woo, woocommerce, contact, comments, support, whatsapp, chat, floating.
 * Requires at least: 4.7
 * Donate link: https://dfortiz.github.io
 * Domain Path: / 
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl.html
 * 
 *  PHP version 5.3.0
 *
 * @category    Wordpress_Plugin
 * @package     BH_Plugin
 * @author      Frank Ortiz <dfortiz@gmail.com>
 * @copyright   2021 Boliviahub
 * @license     GNU Public License
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/* Defines plugin's root folder. */
define( 'BH_PLGN_PSN_PATH', plugin_dir_path( __FILE__ ) );
define( 'BH_PLGN_PSN_URL', plugins_url('/', __FILE__ ) );
define( 'BH_PLGN_PSN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( "BH_PLGN_PSN_LICENSE", true );

/* General. */
require_once('inc/BH_PLGN_PSN-init.php');

new bhppsn_main();

?>