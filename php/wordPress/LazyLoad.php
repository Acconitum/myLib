
Skip to content

    Pull requests
    Issues
    Marketplace
    Explore

    @menthacubetech

1
0

    0

cubetech/wptheme.4teamwork Private
Code
Issues 0
Pull requests 1
Projects 0
Wiki
Insights
wptheme.4teamwork/src/Packages/LazyLoad.php
9002f26 a day ago
@menthacubetech menthacubetech added filter and lazyloading
275 lines (249 sloc) 6.31 KB
<?php
namespace Cubetech\Theme\Packages;
use Timber\Timber;
use Timber\Image;
/**
 * Registers REST endpoints
 * Handles inital calls for frontend if lazyload is enabled
 * Handles calls for lzyloading more posts
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @version 1.0
 */
class LazyLoad
{
	protected const BASE_ROUTE = '/lazyload/';
	protected $postTypes;
	protected $response;
	protected $segments;
	/**
	 * add posttypes for lazyloading here
	 * watch exactly, how html structure should be in
	 * views/components/post-list-success
	 */
	public function __construct()
	{
		$this->postTypes = ['post', 'success'];
	}
	/**
	 * neede for initializing via packages in src/Theme.php
	 *
	 * @return [type] [description]
	 */
	public function run()
	{
		add_action('rest_api_init', [$this, 'registerRoutes']);
		add_action('wp_enqueue_scripts', [$this, 'localizeScript'], 20);
	}
	/**
	 * addREST routs for every postType given in constructor
	 *
	 * @return void
	 */
	public function registerRoutes()
	{
		foreach ($this->postTypes as $endpoint) {
			register_rest_route('cubetech', self::BASE_ROUTE . $endpoint .'(/.+)', array(
			'methods' => 'GET',
			'callback' => [$this, 'handleRequest']
			));
		}
	}
	/**
	 * handles incoming requests
	 *
	 * @param  \WP_REST_Request $request incoming request
	 * @return \WP_REST_Response $this->response A response with data and HTTP Statuscode
	 */
	public function handleRequest(\WP_REST_Request $request)
	{
		$this->setSegments($request->get_route());
		if (!$this->checkSegments()) {
			$this->setForbiddenRequest();
		} else {
			$this->callAction();
		}
		return $this->response;
	}
	/**
	 * extrcats segments for url to decide if and which action should be done
	 *
	 * @param  string $url restroute called
	 * @return array      segmented url
	 */
	private function setSegments($url)
	{
		$segments = explode('/', $url);
		$this->segments = new \stdClass();
		if ($this->postTypeMatches($segments[3])) {
			$this->segments->postType = $segments[3];
		} else {
			$this->segments->postType = false;
		}
		if (isset($segments[4])) {
			$this->segments->action = $segments[4];
		} else {
			$this->segments->page = false;
		}
		if (isset($segments[5])) {
			$this->segments->page = $segments[5];
		} else {
			$this->segments->page = false;
		}
	}
	/**
	 * checks if url segements are valid
	 *
	 * @param  array $segments segmented url
	 * @return boolean          true if segments are correct
	 */
	private function checkSegments()
	{
		if (!$this->getSegment('postType')) {
			return false;
		}
		
		if (!$this->getSegment('action')) {
			return false;
		}
		return true;
	}
	/**
	 * Get a url segment by key
	 * @param  string $key segment name
	 * @return string segment
	 */
	private function getSegment($key)
	{
		return $this->segments->$key;
	}
	/**
	 * checks if segment 3 is of a given posttype
	 *
	 * @param  string $postType from segmented url
	 * @return bool          if posttype is in $this->postTypes
	 */
	private function postTypeMatches($postType)
	{
		return in_array($postType, $this->postTypes);
	}
	/**
	 * if segments are valid call the right method
	 *
	 * @param  string $postType from segemnted url
	 * @param  string $action   from segemnted urö
	 * @return void
	 */
	private function callAction()
	{
		switch ($this->getSegment('action')) {
			case 'lazyloadavailable':
				$this->isLazyLoadAvailable();
				break;
			case 'loadposts':
				$this->loadPosts();
				break;
			default:
				$this->setBadRequest();
		}
	}
	/**
	 * gets all posts from given postype and count them
	 * if count is > 10 returns lazyload true to javascript calling restroute
	 * js is found in assets/src/ct-lazyload.js
	 *
	 * @param  string $postType  from segemnted url
	 * @return void
	 */
	private function isLazyLoadAvailable()
	{
		$posts = get_posts([
			'numberposts' 	=> -1,
			'post_type'		=> $this->getSegment('postType')
		]);
		if (count($posts) > 10) {
			$this->response = new \WP_REST_Response(['message' => 'Success', 'lazyLoad' => true, 'postType' => $this->getSegment('postType')]);
			$this->response->set_status(200);
		} else {
			$this->response = new \WP_REST_Response(['message' => 'Success', 'lazyLoad' => false]);
			$this->response->set_status(200);
		}
	}
	/**
	 * loads posts per page and append them to response
	 *
	 * @return void
	 */
	private function loadPosts()
	{
		if (!$this->getSegment('page')) {
			$this->setBadRequest();
			return;
		}
		$posts = Timber::get_posts([
			'numberposts'	=> 10,
			'post_type'		=> $this->getSegment('postType'),
			'paged'			=> $this->getSegment('page')
		]);
		if (count($posts) > 10) {
			$posts = $this->addImageSoruceToPosts($posts);
			$this->response = new \WP_REST_Response(['message' => 'Success', 'lazyLoad' => true, 'posts' => $posts, 'postType' => $this->getSegment('postType')]);
			$this->response->set_status(200);
		} else if (count($posts) > 0) {
			$posts = $this->addImageSoruceToPosts($posts);
			$this->response = new \WP_REST_Response(['message' => 'Success', 'lazyLoad' => false, 'posts' => $posts, 'postType' => $this->getSegment('postType')]);
			$this->response->set_status(200);
		} else {
			$this->setBadRequest();
		}
	}
	/**
	 * It's not possible to get image sources within twigjs templates
	 * this function ensures, that we get the required image sources
	 *
	 * @param TmberPosts $posts Array with TimberPosts
	 */
	private function addImageSoruceToPosts($posts)
	{
		$postsWithImageSource = [];
		foreach ($posts as $post) {
			$image = new Image($post->thumbnail);
			$post->imageSource = $image->guid;
			$image = new Image($post->icon);
			$post->iconSource = $image->guid;
			$postsWithImageSource[] = $post;
		}
		return $postsWithImageSource;
	}
	/**
	 * Get rest nounce and route available in js files
	 *
	 * @return void
	 */
	public function localizeScript()
	{
		wp_localize_script('main', 'ctRestNounce', [
			'root' => esc_url_raw(rest_url()) . 'cubetech/lazyload/',
			'nonce' => wp_create_nonce('wp_rest')
		]);
	}
	/**
	 * Sets Bad Request if request is not valid
	 *
	 * @return void
	 */
	private function setBadRequest()
	{
		$this->response = new \WP_REST_Response('Bad Request');
		$this->response->set_status(400);
	}
	
	/**
	 * Sets Forbidden request if request is not valid
	 *
	 * @return void
	 */
	private function setForbiddenRequest()
	{
		$this->response = new \WP_REST_Response('Forbidden');
		$this->response->set_status(403);
	}
}

    © 2018 GitHub, Inc.
    Terms
    Privacy
    Security
    Status
    Help

    Contact GitHub
    Pricing
    API
    Training
    Blog
    About

Press h to open a hovercard with more details.

