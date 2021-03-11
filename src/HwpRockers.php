<?php

namespace HwpRockers;

use HwpRockers\Interfaces\Hookable;

/**
 * Main plugin class.
 */
final class HwpRockers {
	/**
	 * Class instances.
	 */
	private $instances = [];

	/**
	 * Main method for running the plugin.
	 */
	public function run() {
		$this->create_instances();
		$this->register_hooks();
	}

	private function create_instances() {
		$this->instances['project_post_type']       = new PostTypes\ProjectPostType();
		$this->instances['project_object_type']     = new WPGraphQL\Type\ObjectType\Project();
		$this->instances['create_project_mutation'] = new WPGraphQL\Mutation\CreateProject();
		$this->instances['update_project_mutation'] = new WPGraphQL\Mutation\UpdateProject();
	}

	private function register_hooks() {
		foreach ( $this->get_hookable_instances() as $instance ) {
            $instance->register_hooks();
        }
	}

	private function get_hookable_instances() {
        return array_filter( $this->instances, function( $instance ) {
			return $instance instanceof Hookable;
		} );
    }
}
