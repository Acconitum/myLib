<?php
public function registerTaxonomies()
{
	$labels = apply_filters('taxonomy-labels', array(
		'name'              => _x('Produktkategorien', 'taxonomy general name', 'wpplugin_'),
		'singular_name'     => _x('Produktkategorie', 'taxonomy singular name', 'wpplugin_'),
		'search_items'      => __('Suche Produktkategorien', 'wpplugin_'),
		'all_items'         => __('Alle Produktkategorien', 'wpplugin_'),
		'parent_item'       => __('Übergeordnete Produktkategorie', 'wpplugin_'),
		'parent_item_colon' => __('Übergeordnete Produktkategorie:', 'wpplugin_'),
		'edit_item'         => __('Produktkategorie bearbeiten', 'wpplugin_'),
		'update_item'       => __('Produktkategorie aktualisieren', 'wpplugin_'),
		'add_new_item'      => __('Neue Produktkategorie hinzufügen', 'wpplugin_'),
		'new_item_name'     => __('Neue Produktkategorie', 'wpplugin_'),
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
