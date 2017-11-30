function get_enqueued_scripts()
{
	$scripts = wp_scripts();
	var_dump(array_keys($scripts->groups));
	die;
}

add_action('wp_head', 'get_enqueued_scripts');