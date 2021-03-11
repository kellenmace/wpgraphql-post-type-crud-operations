<?php

namespace HwpRockers\PostTypes;

use HwpRockers\Interfaces\Hookable;
use HwpRockers\Interfaces\CustomPostType;

class ProjectPostType implements Hookable, CustomPostType {
    use PostTypeLabelUtility;

    const KEY = 'project';
    const GRAPHQL_SINGLE_NAME = 'Project';

    public function register_hooks(): void {
        add_action( 'init', [ $this, 'register' ] );
    }

    public function register(): void {
        register_post_type( self::KEY, [
			'labels'              => $this->generate_labels( 'Project', 'Projects' ),
            'public'              => true,
            'menu_icon'           => 'dashicons-portfolio',
            'supports'            => ['title', 'editor'],
            'show_in_graphql'     => true,
            'graphql_single_name' => self::GRAPHQL_SINGLE_NAME,
            'graphql_plural_name' => 'Projects',
		] );
    }
}
