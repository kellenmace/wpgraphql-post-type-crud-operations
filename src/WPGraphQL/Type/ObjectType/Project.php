<?php

namespace HwpRockers\WPGraphQL\Type\ObjectType;

use WPGraphQL\Model\Post;
use HwpRockers\Interfaces\Hookable;
use HwpRockers\PostTypes\ProjectPostType;

class Project implements Hookable {
    public function register_hooks(): void {
        add_action( 'graphql_register_types', [ $this, 'register_fields' ] );
    }

    public function register_fields(): void {
        register_graphql_fields(
            ProjectPostType::GRAPHQL_SINGLE_NAME,
            [
                'projectNumber' => [
                    'type'        => 'String',
                    'description' => __( 'Project number', 'hwp-rockers' ),
                    'resolve'     => function( Post $project ) {
                        $project_number = get_post_meta( $project->ID, 'project_number', true );

                        return $project_number ?: null;
                    }
                ],
            ]
        );
    }
}
