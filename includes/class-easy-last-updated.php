<?php
/**
 * Adds functions and hooks to filter Post Type tables
 *
 * @since   1.0
 *
 * @package UFHealth\Easy_Last_Updated
 *
 * @author  Chris Wiegman <cwiegman@ufl.edu>
 */

namespace UFHealth\Easy_Last_Updated;

/**
 * Class Who_Wrote_What
 */
class Easy_Last_Updated {

	/**
	 * Who_Wrote_What constructor.
	 */
	public function __construct() {

		add_filter( 'manage_posts_columns', array( $this, 'filter_manage_posts_columns' ) );
		add_filter( 'manage_pages_columns', array( $this, 'filter_manage_posts_columns' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'filter_manage_posts_custom_column' ), 10, 2 );
		add_action( 'manage_pages_custom_column', array( $this, 'filter_manage_posts_custom_column' ), 10, 2 );

	}

	/**
	 * Filter manage_posts_columns
	 *
	 * Adds a column to the posts table to show last updated information.
	 *
	 * @since 1.0
	 *
	 * @param array  $posts_columns An array of column names.
	 *
	 * @return array Filtered array of post table columns
	 */
	function filter_manage_posts_columns( $posts_columns ) {

		$posts_columns['last_updated'] = esc_html__( 'Last Updated', 'ufhealth-uf-health-easy-last-updated' );

		return $posts_columns;

	}

	/**
	 * Filter manage_posts_custom_column
	 *
	 * Filters the display output of custom columns in the posts list table.
	 *
	 * @since 1.0
	 *
	 * @param string $column_name Column name.
	 * @param int    $post_id     The post id.
	 */
	function filter_manage_posts_custom_column( $column_name, $post_id ) {

		if ( 'last_updated' === $column_name ) {

			$post = get_post( $post_id );

			$current_time  = get_the_time( __( 'Y/m/d g:i:s a' ) );
			$modified_time = $post->post_modified;
			$time          = strtotime( $post->post_modified_gmt );

			$time_diff = time() - $time;

			if ( $time_diff > 0 && $time_diff < DAY_IN_SECONDS ) {

				$current_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );

			} else {

				$current_time = mysql2date( __( 'Y/m/d' ), $modified_time );

			}

			printf( '<abbr title="%s">%s</abbr>', esc_html( $modified_time ), esc_html( $current_time ) );

		}
	}
}
