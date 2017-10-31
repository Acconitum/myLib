<?php
function enqueue_my_scripts()
{
	wp_enqueue_script('ajax-search', get_theme_file_uri('/assets/js/ajax-search.js'), array( 'jquery' ), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');
