<?php
/**
 * Plugin Name: UF Health Easy Last Updated
 * Description: Shows the last updated time for content on the content type tables for easier auditing.
 * Version: 1.0
 * Text Domain: ufhealth-easy-last-updated
 * Domain Path: /languages
 * Author: UF Health
 * Author URI: http://webservices.ufhealth.org
 * License: GPLv2
 *
 * @package UFHealth\Easy_Last_Updated
 */

define( 'UFHEALTH_EASY_LAST_UPDATED_VERSION', '1.0' );
define( 'UFHEALTH_EASY_LAST_UPDATED_URL', plugin_dir_url( __FILE__ ) );

add_action( 'plugins_loaded', 'ufhealth_easy_last_updated_loader' );

/**
 * Load plugin functionality.
 */
function ufhealth_easy_last_updated_loader() {

	// Remember the text domain.
	load_plugin_textdomain( 'ufhealth-easy-last-updated', false, dirname( dirname( __FILE__ ) ) . '/languages' );

	require dirname( __FILE__ ) . '/includes/class-easy-last-updated.php';

	new \UFHealth\Easy_Last_Updated\Easy_Last_Updated();

}
