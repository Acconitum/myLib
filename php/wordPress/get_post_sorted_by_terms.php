function get_post_sorted_by_category() {
    $posts_sorted = array();
    $terms = get_terms( array(
        'taxonomy' => 'partner_category',
        'hide_empty' => true,
    ));

    foreach($terms as $term) {

        $args = array(
            'post_type'     => 'partner',
            'posts_per_page'   => -1,
            'tax_query'     => array(
                array(
                    'taxonomy'  => 'partner_category',
                    'field'     => 'slug',
                    'terms'     => $term->slug
                )
            )
        );
        $posts_sorted[$term->name] = get_posts($args);
    }
    return $posts_sorted
}
