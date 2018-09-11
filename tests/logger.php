<?php
/**
 * A custom Logger for helping with unit tests
 *
 * @since   1.10
 *
 * @package UFHealth\Multisite\WP_CLI
 *
 * @author  Chris Wiegman <cwiegman@ufl.edu>
 */

namespace UFHealth\Multisite\WP_CLI;

/**
 * PHPUnit logger
 */
class Logger {

	/**
	 * @param string $message Message to write.
	 *
	 * @since 1.10
	 */
	public function info( $message ) {

		print $message;
	}

	/**
	 * @param $message
	 *
	 * @since 1.10
	 */
	public function success( $message ) {

		print $message;
	}

	/**
	 * @param $message
	 *
	 * @since 1.10
	 */
	public function warning( $message ) {

		print $message;
	}

	/**
	 * @param $message
	 *
	 * @since 1.10
	 */
	public function error( $message ) {

		print $message;
	}

	/**
	 * @param $message_lines
	 *
	 * @since 1.10
	 */
	public function error_multi_line( $message_lines ) {

		$message = implode( "\n", $message_lines );

		print $message;
	}
}