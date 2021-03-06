<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Chriswiegman_Plugin
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

define( 'WP_CLI', true );
define( 'WP_CLI_RUNNING_PHP_UNIT_TESTS', true );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run tests/bin/install-wp-tests.sh ?" . PHP_EOL;
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

if ( ! defined( 'WP_CLI_ROOT' ) ) {
	define( 'WP_CLI_ROOT', dirname( dirname( __FILE__ ) ) . '/vendor/wp-cli/wp-cli' );
}

include WP_CLI_ROOT . '/php/utils.php';
include WP_CLI_ROOT . '/php/dispatcher.php';
include WP_CLI_ROOT . '/php/class-wp-cli.php';
include WP_CLI_ROOT . '/php/class-wp-cli-command.php';

\WP_CLI\Utils\load_dependencies();

require dirname( __FILE__ ) . '/logger.php';

\WP_CLI::set_logger( new \UFHealth\Multisite\WP_CLI\Logger() );

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {

	require dirname( dirname( __FILE__ ) ) . '/ufhealth-easy-last-updated.php';

}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';

