<?php
/**
 * Adds functions and hooks to filter Post Type tables
 *
 * @since 1.0
 *
 * @package UFHealth\Easy_Last_Updated
 *
 * @author Chris Wiegman <cwiegman@ufl.edu>
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

		add_filter( 'manage_users_columns', array( $this, 'filter_manage_users_columns' ) );
		add_filter( 'manage_users_custom_column', array( $this, 'filter_manage_users_custom_column' ), 10, 3 );

	}

	/**
	 * Filter manage_users_columns
	 *
	 * Adds a column to the user table for each public post type.
	 *
	 * @since 1.0
	 *
	 * @param array $columns Array of user table columns.
	 *
	 * @return array Filtered array of user table columns
	 */
	function filter_manage_users_columns( $columns ) {

		$args = array(
			'public' => true,
		);

		$post_types = get_post_types( $args, 'objects' );

		foreach ( $post_types as $post_type ) {

			if ( 'Posts' !== $post_type->label ) {
				$columns[ $post_type->name ] = $post_type->label;
			}
		}

		return $columns;

	}

	/**
	 * Filter manage_users_custom_column
	 *
	 * Filters the display output of custom columns in the Users list table.
	 *
	 * @since 1.0
	 *
	 * @param string $output Custom column output. Default empty.
	 * @param string $column_name Column name.
	 * @param int    $user_id ID of the currently-listed user.
	 *
	 * @return string The output to populate the user table cell.
	 */
	function filter_manage_users_custom_column( $output, $column_name, $user_id ) {

		$args = array(
			'public' => true,
		);

		$post_types = get_post_types( $args, 'objects' );

		foreach ( $post_types as $post_type ) {

			if ( 'posts' !== $column_name && $post_type->name === $column_name ) {

				$post_counts = count_many_users_posts( array( $user_id ), $post_type->name );
				$post_count  = $post_counts[ $user_id ];
				$output      = '';

				if ( $post_count > 0 ) {

					$output .= '<a href="edit.php?post_type=' . esc_attr( $post_type->name ) . '&author=' . absint( $user_id ) . '" class="edit">';
					$output .= '<span aria-hidden="true">' . absint( $post_count ) . '</span>';
					// translators: 1 the number of posts of this post type by the author 2. the post type.
					$output .= '<span class="screen-reader-text">' . sprintf( _n( '%1$d %2$s by this author', '%1$d %2$s by this author', $post_count, 'ufhealth-who-wrote-what' ), number_format_i18n( $post_count ), $post_type->name ) . '</span>';
					$output .= '</a>';

				} else {

					$output .= 0;

				}
			}
		}

		return $output;

	}
}
