<?php
public function registerTaxonomies()
{
	$labels = apply_filters('taxonomy-labels', array(
		'name'              => _x('Produktkategorien', 'taxonomy general name', 'wpplugin.products'),
		'singular_name'     => _x('Produktkategorie', 'taxonomy singular name', 'wpplugin.products'),
		'search_items'      => __('Suche Produktkategorien', 'wpplugin.products'),
		'all_items'         => __('Alle Produktkategorien', 'wpplugin.products'),
		'parent_item'       => __('Übergeordnete Produktkategorie', 'wpplugin.products'),
		'parent_item_colon' => __('Übergeordnete Produktkategorie:', 'wpplugin.products'),
		'edit_item'         => __('Produktkategorie bearbeiten', 'wpplugin.products'),
		'update_item'       => __('Produktkategorie aktualisieren', 'wpplugin.products'),
		'add_new_item'      => __('Neue Produktkategorie hinzufügen', 'wpplugin.products'),
		'new_item_name'     => __('Neue Produktkategorie', 'wpplugin.products'),
		'menu_name'         => __('Produktkategorien'),
	));
	$args = apply_filters('taxonomy-args', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	));
	register_taxonomy('taxonomy-name', array( 'post-type-slug' ), $args);
}
