public function lazyLoadPosts() {
	if(isset($_POST['page']) && $_POST['page'] !== '' && !is_array($_POST['page'])) {
		$page = intval($_POST['page']);
	   
	} else {
		 // return 400 Bad Request
		 wp_send_json_error('page not defined', 400);
		 exit; 
	}
	// get posts to load in frontend
	$posts = Timber::get_posts([
		'posts_per_page'   => 20,
		'paged'        => $page
	]);
	$response = array();
	foreach ($posts as $post) {
			
		//create a card entry and add it to the response list
		$card = new PostCard($post);
		if ($card->has_image) {
			$card->background = $card->background->src('original');
		}
		$response[] = $card;
	}
	// success
	wp_send_json_success([
		'message'   => 'Posts successfully loaded',
		'posts'     => $response
	], 200);
	exit;
}

