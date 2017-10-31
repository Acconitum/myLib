<?php
public function registerPostType()
{
	$labels = apply_filters(
		'post-type-labels',
		array(
		'name'               => _x('Products', 'Bottle', 'wpplugin-'
		'singular_name'      => _x('Product', 'Bottle', 'wpplugin-'
		'menu_name'          => __('Product', 'wpplugin-'
		'name_admin_bar'     => __('Product', 'wpplugin-'
		'parent_item_colon'  => __('Parent Product', 'wpplugin-'
		'all_items'          => __('All Products', 'wpplugin-'
		'add_new_item'       => __('New Product', 'wpplugin-'
		'add_new'            => __('New Product', 'wpplugin-'
		'new_item'           => __('New Product', 'wpplugin-'
		'edit_item'          => __('Edit Product', 'wpplugin-'
		'update_item'        => __('Update Product', 'wpplugin-'
		'view_item'          => __('View Product', 'wpplugin-'
		'search_items'       => __('Search Product', 'wpplugin-'
		'not_found'          => __('No Product found', 'wpplugin-'
		'not_found_in_trash' => __('No Product found in trash', 'wpplugin-'));
	$args = apply_filters(
		'post-type-args',
		array(
		'label'               => __('Bottles', 'wpplugin-'
		'description'         => __('Registered bottles', 'wpplugin-'
		'labels'              => $labels,
		'supports'            => array(),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 30,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'rewrite'             => array('slug' => 'bottle'),
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-cart'));
	register_post_type('ct_bottle', $args);
}
