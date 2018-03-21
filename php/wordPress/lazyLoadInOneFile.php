<?php

/******************************* functions.php **************************************/

// this function will get executed for every ajax call
function lazyLoadPosts() 
{

    // prevent tampering with our data-attribute
    if(isset($_POST['offset']) && $_POST['offset'] !== '' && $_POST['offset'] !== 'NaN' && !is_array($_POST['offset'])) 
    {
        $offset = $_POST['offset'];
        
    } else {
            // return 400 Bad Request -> we can't proceed
            wp_send_json_error('Offset not defined', 400);
            exit; 
    }

    // setup the query arguments
    // we assume 20 more posts to load -> decide for your own how many posts should be loaded
    $args = array(
                    'numberposts'   => 20,              // default 5 / -1 for infinite
                    'orderby'       => 'menu_order',    // change this to your needs (most customers like to handle the order for their own)
                    'offset'        => $offset          // the magic happens here
                );

    // query the posts
    $posts = get_posts($args);

    if(!empty($posts)){

        // add some custom values
        foreach($posts as $post) {

            // get the link to the post
            $post->post_link = get_permalink($post->ID);

            // add text to the link for frontend output (can be an options field which is defined in backend if you like)
            $post->post_link_text = 'Read more';
        }

        // success -> send data back
        wp_send_json_success([
                                'message'   => 'Posts successfully loaded',
                                'posts'     => $posts
                            ], 200);
        exit;
    } else {

        // return 404 Not found -> no posts loaded
            wp_send_json_error('No posts loaded', 404);
            exit;
    }
}

// finally we can add this function with add_action
add_action('wp_ajax_lazyLoadPosts', 'lazyLoadPosts');
add_action('wp_ajax_nopriv_lazyLoadPosts', 'lazyLoadPosts');

/******************************* end functions.php **************************************/


/******************************* archive-whatever.php **************************************/

?>

<main class="main-content">
    <section class="overview">
        <header class="overview-header">
            <h1 class="overview-title">Overview</h1>
        </header>
        <div class="overview-container" data-result-container data-offset="20">
            
        </div>
        <footer class="overview-footer">
            <a class="button" href="#" data-load-posts>Click me for more posts!</a>
            <script type="text/template" data-post-template>
                <article class="article">
                    <header class="article-header">
                        <h2 class="article-title">{{post-title}}</h2>
                    </header>

                    <main class="article-main">
                        <div class="article-excerpt">
                            {{post-excerpt}}
                        </div>
                    </main>        

                    <footer class="article-footer">
                        <a class="post-link" href="{{post-link}}">{{post-link-text}}</a> 
                    </footer>
                </article>
            </script>
        </footer>
    </section>
</main>

<script>
    
    function parseCards(posts) 
    {
		
		// prepare an empty string for the output
		var postListHTML ='';

		// get the text/template of a post
		var postTemplate = jQuery('[data-post-template]').html();

		// count of posts retrieved from call
		// will be used to update the data-offset attributes
		var postsLoaded = posts.length;

		// check if posts are loaded
		if(postsLoaded > 0 ) 
        {

			// take the post template and replace the placeholders with the right values
			for (var index = 0; index < postsLoaded; index++) 
            {

                postListHTML += postTemplate.replace(/{{post-title}}/g, posts[index].post_title)
                                            .replace(/{{post-excerpt}}/g, posts[index].post_excerpt)
                                            .replace(/{{post-link}}/g, posts[index].post_link)
                                            .replace(/{{post-link-text}}/g, posts[index].post_link_text)
			}
			
			// append the newly generated posts to the result-container
			jQuery('[data-result-container]').append(postListHTML);

			// set the new offset value
			var actualOffset = parseInt(jQuery('[data-offset]').attr('data-offset'));
			jQuery('[data-offset]').attr('data-offset', actualOffset + postsLoaded);
		}
    }
    
    function loadMorePosts(offset) {
        
        jQuery.ajax({
            method: 'POST',                     // HTTP Method
            url: '/wp-admin/admin-ajax.php',    // WordPress ajax url
            dataType: "json",                   
            data: {
                'action': 'lazyLoadPosts',      // our function definied in php
                'offset': offset                // the offset -> remember to adjust this value after a successful call
            },
            success: function(response) {

                // here we define what happens on a successful call
                // in our case we take the text/template, replace the placeholders and append the created HTML to the result-container
                // finally we update the data-offset attributes aswell
                parseCards(response.data.posts);
            },
            error: function() {
                // add your error handling here
            }
        });
    }

    // wait until DOM is loaded
    jQuery('document').ready(function() {

        // listen for click events on our button
        // first params are events
        // second is a selector (in this case it points to our button with the data-attribute data-load-posts)
        // third param is our callback function where we decide what to do after our events where triggered
        jQuery('[data-load-posts]').on('click touchstart', function(event) {

            // prevent window scrolling to the top on click on the button
            event.preventDefault();

            // get the offset
            var offset = parseInt(jQuery('[data-offset]').attr('data-offset'));

            // check if we have a number
            if(!isNaN(offset)) {
            
                // get the posts with ajax
                loadMorePosts(offset);
            }
        });
    });
</script>

<?php
/******************************* end archive-whatever.php **************************************/