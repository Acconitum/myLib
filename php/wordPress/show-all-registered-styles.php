function get_enqueued_scripts()
{
	$scripts = wp_styles();
	var_dump(array_keys($scripts->groups));
	die;
}

add_action('wp_head', 'get_enqueued_scripts');