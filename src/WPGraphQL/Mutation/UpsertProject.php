<?php

namespace HwpRockers\WPGraphQL\Mutation;

use GraphQL\Error\UserError;

/**
 * Code used for both Project creation and updates.
 */
trait UpsertProject {
    private function get_upsert_input_fields(): array {
        return [
            'projectNumber' => [
                'type'        => [ 'non_null' => 'String' ],
                'description' => __( 'Project number', 'hwp-rockers' ),
            ],
        ];
    }

    private function validate_project_number( string $project_number ): void {
        $min_length = 6;
        $is_valid_length = strlen( $project_number ) >= $min_length;

        if ( ! $is_valid_length ) {
            throw new UserError( "Project numbers must be at least {$min_length} characters long." );
        }

        $is_alphanumeric = ctype_alnum( $project_number );

        if ( ! $is_alphanumeric ) {
            throw new UserError( 'Project numbers must contain only letters and numbers.' );
        }
    }

    private function save_additional_upsert_data( int $post_id, array $input ): void {
        $project_number_sanitized = sanitize_text_field( $input['projectNumber'] );

        update_post_meta( $post_id, 'project_number', $project_number_sanitized );
    }
}
