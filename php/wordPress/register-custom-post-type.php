<?php
public function registerPostType()
{
	$labels = apply_filters(
		'post-type-labels',
		array(
		'name'               => _x('Products', 'Bottle', 'wpplugin_republica_product'),
		'singular_name'      => _x('Product', 'Bottle', 'wpplugin_republica_product'),
		'menu_name'          => __('Product', 'wpplugin_republica_product'),
		'name_admin_bar'     => __('Product', 'wpplugin_republica_product'),
		'parent_item_colon'  => __('Parent Product', 'wpplugin_republica_product'),
		'all_items'          => __('All Products', 'wpplugin_republica_product'),
		'add_new_item'       => __('New Product', 'wpplugin_republica_product'),
		'add_new'            => __('New Product', 'wpplugin_republica_product'),
		'new_item'           => __('New Product', 'wpplugin_republica_product'),
		'edit_item'          => __('Edit Product', 'wpplugin_republica_product'),
		'update_item'        => __('Update Product', 'wpplugin_republica_product'),
		'view_item'          => __('View Product', 'wpplugin_republica_product'),
		'search_items'       => __('Search Product', 'wpplugin_republica_product'),
		'not_found'          => __('No Product found', 'wpplugin_republica_product'),
		'not_found_in_trash' => __('No Product found in trash', 'wpplugin_republica_product'),
		)
	);
	$args = apply_filters(
		'post-type-args',
		array(
		'label'               => __('Bottles', 'wpplugin_republica_product'),
		'description'         => __('Registered bottles', 'wpplugin_republica_product'),
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
		'menu_icon'           => 'dashicons-cart'
		)
	);
	register_post_type('ct_bottle', $args);
}
