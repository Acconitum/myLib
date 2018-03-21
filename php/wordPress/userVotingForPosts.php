<?php
class AjaxHandler
{
    
    public function init() {
        add_action('wp_ajax_assignUserVote', [$this, 'assignUserVote']);
        add_action('wp_ajax_nopriv_assignUserVote', [$this, 'assignUserVote']);
        add_action('wp_ajax_removeUserVote', [$this, 'removeUserVote']);
        add_action('wp_ajax_nopriv_removeUserVote', [$this, 'removeUserVote']);
    }

    public static function assignUserVote() {
        
        
        // check if user is logged in and have the permission to vote
        if(is_user_logged_in()) {
            $context['user'] = wp_get_current_user();
        }

        // check if isset, is int or someone tampered around to make the post_id an array
        // the (int) cast on a string returns 0
        if (isset($_POST['post_id']) && (int)$_POST['post_id'] !== 0 && !is_array($_POST['post_id'])) {

            $post = get_post($_POST['post_id']);
            $postmeta = get_post_meta($post->ID);
            $usermeta = get_user_meta($user->ID);

            // check if user already voted once
            // we can figure it out by querying the user metafield user_votings
            if (isset($usermeta['user_votings'])) {
                // user already voted and got the user_votings field
                //check if user already voted for the given post
                if(in_array($post->ID, $usermeta['user_votings'])) {

                    // return 400 Bad Request
                    wp_send_json_error(_x('User already voted for this post', 'Voting failure message', 'wptheme-xaver'), 400);
                    exit;
                } else {

                    // update usermeta
                    add_user_meta($user->ID, 'user_votings', $post->ID);

                    // finally we can add 1 to the posts voting count
                    update_post_meta($post->ID, 'voting_count', (int)$postmeta['voting_count'][0] + 1);
                    wp_send_json_success(_x('Voting successful', 'Return voting success', 'wptheme-xaver'), 200);
                    exit;
                }
            } else {

                // create the user meta field user_votings
                add_user_meta($user->ID, 'user_votings', $post->ID);
                
                // add post_votings + 1
                update_post_meta($post->ID, 'voting_count', (int)$postmeta['voting_count'][0] + 1);
            }
        } else {

            // return 400 Bad Request
            wp_send_json_error(_x('Malformed Request', 'Voting failure message', 'wptheme-xaver'), 400);
            exit;           
        }
    }


    public static function removeUserVote() {

        // check if user is logged in
        if(is_user_logged_in()) {
            $context['user'] = wp_get_current_user();
        }

        // check if isset, is int or someone tampered around to make the post_id an array
        // the (int) cast on a string returns 0
        if (isset($_POST['post_id']) && (int)$_POST['post_id'] !== 0 && !is_array($_POST['post_id'])) {

            $post = get_post($_POST['post_id']);
            $postmeta = get_post_meta($post->ID);
            $usermeta = get_user_meta($user->ID);

            // check if user already voted once
            // we can figure it out by querying the user metafield user_votings
            if (isset($usermeta['user_votings'])) {

                //check if User voted for the given post
                if(in_array($post->ID, $usermeta['user_votings'])) {
                    
                    // user did vote for the post! we can proceed
                    // remove post id from the users voted-property(usermeta)
                    delete_user_meta($user->ID, 'user_votings', $post->ID);
                    
                    // substract one vote of post-votes for the given post
                    update_post_meta($post->ID, 'voting_count', (int)$postmeta['voting_count'][0] - 1);
                    // success
                    wp_send_json_success(_x('Voting successfully removed', 'Return voting success', 'wptheme-xaver'), 200);
                    exit;
                                   
                } else {

                    // user didn't vote for this post
                    // return 400 Bad Request
                    wp_send_json_error(_x('User did not vote for this Project', 'Voting failure message', 'wptheme-xaver'), 400);
                    exit; 
                }
            } else {
                
                // user did not vote for the post
                // return 400 Bad Request
                wp_send_json_error(_x('User did not vote for this Project', 'Voting failure message', 'wptheme-xaver'), 400);
                exit; 
            }
        }
    }
}

// change project to post and check the id with in_array()
?>
<div class="button voting-button <?php echo (in_array(project.id, component.user_votings) ? 'voted' : '');?>" data-voted="<?php echo (in_array(project.id, component.user_votings) ? 'true' : 'false');?>" data-user-is-logged-in="<?php echo (component.user ? 'true' : 'false');?>" data-post-id="<?php echo project.id;?>">
	<?php _x('Vote', 'Voting button text', 'wptheme-xaver');?>
</div>

<script type="text/javascript">
    /**
     * gets and checks if the post_id is valid
     * @param {jQuery-Oject} element 
     * @return {int} post_id or false onerror
     */
    function getPostId(element) {

        // gather all data we need for the call
        if (element.attr('data-post-id')) {
            var post_id = parseInt(element.attr('data-post-id'));

            // let's see if somebody tampered around whith the HTML
            if(isNaN(post_id)) {
                
                return false;
            } else {

                return post_id;
            }
        }
    }

    /**
     * Changes data-attributes and adds the voted css class after succesfull vote 
     * @param {jQuery-object} element 
     */
    function successfullVoted(element) {
        
        // set data attributes to the new values
        element.attr('data-voted', true);
        element.addClass('voted');
    }

    /**
     * Changes data-attributes and removes the voted css class after succesfull devote 
     * @param {jQuery-object} element 
     */
    function successfullDevoted(element) {
        // set data attributes to the new values
        element.attr('data-voted', false);
        element.removeClass('voted');
    }

    function handleErrors(errorCode, status, errorMessage) {

        //console.log(errorCode);
        //console.log(status);
        //console.log(errorMessage);
    }

    /**
     * fullfill an ajax call for giving a vote to a project
     * @param {jQuery-object} element 
     */
    function upVoteAjaxCall(element) {
        // Action: assignUserVote
        
        var post_id = getPostId(element);

        jQuery.ajax({
            method: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: "json",
            data: {
                'action': 'assignUserVote',
                'post_id': post_id
            },
            success: function(response) {
                successfullVoted(element);
            },
            error: function(request, status, error) {
                var data = request.responseJSON;

                handleErrors(request.status, error, data.data);
            }
        });   
    }

    /**
     * fullfill an ajax call for removing a vote to a project
     * @param {jQuery-object} element 
     */
    function deVoteAjaxCall(element) {
        // Action: removeUserVote

        var post_id = getPostId(element);

        jQuery.ajax({
            method: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: "json",
            data: {
                'action': 'removeUserVote',
                'post_id': post_id
            },
            success: function(response) {
                successfullDevoted(element);
            },
            error: function(request, status, error) {
                var data = request.responseJSON;

                handleErrors(request.status, error, data.data);
            }
        });
        
    }

    jQuery(document).ready( function() {

        // user is logged in and pressed the button
        jQuery('[data-user-is-logged-in="true"]').on('click touchstart', function() {

            // now we need to decide to call an up- or a devote
            if (jQuery(this).attr('data-voted') === "false") {

                // call the upvote ajax
                upVoteAjaxCall(jQuery(this));
            } else if (jQuery(this).attr('data-voted') === "true") {

                // call the devote ajax
                deVoteAjaxCall(jQuery(this));
            }
        });

        jQuery('[data-user-is-logged-in="false"]').on('click touchstart', function() {
            jQuery('#login-modal').foundation('open');
        });
    });
</script>