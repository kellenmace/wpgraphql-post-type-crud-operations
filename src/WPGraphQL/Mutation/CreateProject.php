<?php

namespace HwpRockers\WPGraphQL\Mutation;

use WP_Post_Type;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use HwpRockers\Interfaces\Hookable;
use HwpRockers\PostTypes\ProjectPostType;

class CreateProject implements Hookable {
    use UpsertProject;

    public function register_hooks(): void {
        add_action( 'graphql_register_types',                              [ $this, 'register_input_fields'] );
        add_action( 'graphql_before_resolve_field',                        [ $this, 'validate' ], 10, 7 );
        add_action( 'graphql_post_object_mutation_update_additional_data', [ $this, 'save_additional_data' ], 10, 4 );
    }

    public function register_input_fields(): void  {
        $input_type = 'Create' . ProjectPostType::GRAPHQL_SINGLE_NAME . 'Input';

        register_graphql_fields( $input_type, $this->get_upsert_input_fields() );
    }

       /**
     * @param mixed           $source         Source passed down the Resolve Tree.
     * @param array           $args           Args for the field.
     * @param AppContext      $context        AppContext passed down the ResolveTree.
     * @param ResolveInfo     $info           ResolveInfo passed down the ResolveTree.
     * @param mixed           $field_resolver Field resolver.
     * @param string          $type_name      Name of the type the fields belong to.
     * @param string          $field_key      Name of the field.
     * @param FieldDefinition $field          Field Definition for the resolving field.
     */
    public function validate( $source, array $args, AppContext $context, ResolveInfo $info, $field_resolver, string $type_name, string $field_key ): void {
        if ( 'RootMutation' !== $type_name || ! $this->is_create_project_mutation( $field_key ) ) {
            return;
        }

        $this->validate_project_number( $args['input']['projectNumber'] );
    }

    public function save_additional_data( int $post_id, array $input, WP_Post_Type $post_type_object, string $mutation_name ): void {
        if ( ! $this->is_create_project_mutation( $mutation_name ) ) {
            return;
        }

        $this->save_additional_upsert_data( $post_id, $input );
    }

    private function is_create_project_mutation( string $mutation_name ): bool {
        return 'create' . ProjectPostType::GRAPHQL_SINGLE_NAME === $mutation_name;
    }
}
