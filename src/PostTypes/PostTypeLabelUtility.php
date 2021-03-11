<?php

namespace HwpRockers\PostTypes;

trait PostTypeLabelUtility {
    /**
     * Generate labels for a post type.
	 *
	 * @param string $singular          Uppercase, singular label.
	 * @param string $plural            Uppercase, plural label.
	 * @param array  $additional_labels Additional labels.
	 *
	 * @return array Labels.
     */
	protected function generate_labels( string $singular, string $plural, array $additional_labels = [] ): array {
		$labels = [
			'name'                  => _x( $plural, 'post type general name', 'hwp-rockers' ),
			'singular_name'         => _x( $singular, 'post type singular name', 'hwp-rockers' ),
			'menu_name'             => _x( $plural, 'admin menu', 'hwp-rockers' ),
			'name_admin_bar'        => _x( $singular, 'add new on admin bar', 'hwp-rockers' ),
			'add_new'               => _x( 'Add New', $singular, 'hwp-rockers' ),
			'add_new_item'          => __( "Add New {$singular}", 'hwp-rockers' ),
			'new_item'              => __( "New {$singular}", 'hwp-rockers' ),
			'edit_item'             => __( "Edit {$singular}", 'hwp-rockers' ),
			'view_item'             => __( "View {$singular}", 'hwp-rockers' ),
			'all_items'             => __( "All {$plural}", 'hwp-rockers' ),
			'search_items'          => __( "Search {$plural}", 'hwp-rockers' ),
			'parent_item_colon'     => __( "Parent {$plural}:", 'hwp-rockers' ),
			'not_found'             => __( "No {$plural} found.", 'hwp-rockers' ),
			'not_found_in_trash'    => __( "No {$plural} found in Trash.", 'hwp-rockers' ),
			'archives'              => __( "{$singular} Archives", 'hwp-rockers' ),
            'update_item'           => __( "Update {$singular}", 'hwp-rockers' ),
            'insert_into_item'      => __( "Insert into {$singular}", 'hwp-rockers' ),
            'uploaded_to_this_item' => __( "Uploaded to this {$singular}", 'hwp-rockers' ),
            'items_list'            => __( "{$plural} list", 'hwp-rockers' ),
            'items_list_navigation' => __( "{$plural} list navigation", 'hwp-rockers' ),
            'filter_items_list'     => __( "Filter {$plural} list", 'hwp-rockers' ),
		];

		return array_merge( $labels, $additional_labels );
	}
}
