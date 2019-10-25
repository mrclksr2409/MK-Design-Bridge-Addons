<?php
add_action( 'rest_api_init', 'custom_api_get_all_posts' );

function custom_api_get_all_posts() {
    register_rest_route( 'mkd-locations/v1', '/all-locations', array(
        'methods' => 'GET',
        'callback' => 'custom_api_get_all_posts_callback'
    ));
}

function custom_api_get_all_posts_callback( $request ) {
    // Initialize the array that will receive the posts' data.
    $posts_data = array();
    // Receive and set the page parameter from the $request for pagination purposes
    $paged = $request->get_param( 'page' );
    $paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1;
    // Get the posts using the 'post' and 'news' post types
    $posts = get_posts( array(
            'paged' => $paged,
            'post__not_in' => get_option( 'sticky_posts' ),
            'posts_per_page' => 10,
            'post_type' => array( 'mkd-locations' ) // This is the line that allows to fetch multiple post types.
        )
    );
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    foreach( $posts as $post ) {
        $id = $post->ID;

        $posts_data[] = (object) array(
            'title' => $post->post_title,
						'hauptsitz' => get_post_meta( $post->ID, "mkd_standort_hauptsitz", true),
						'ansprechpartner' => get_post_meta( $post->ID, "mkd_standort_ansprechpartner", true),
						'strasse' => get_post_meta( $post->ID, "mkd_standort_strasse", true),
						'hausnummer' => get_post_meta( $post->ID, "mkd_standort_hausnummer", true),
						'land' => get_post_meta( $post->ID, "mkd_standort_land", true),
						'plz' => get_post_meta( $post->ID, "mkd_standort_plz", true),
						'ort' => get_post_meta( $post->ID, "mkd_standort_ort", true),
						'telefon' => get_post_meta( $post->ID, "mkd_standort_telefon", true),
						'telefax' => get_post_meta( $post->ID, "mkd_standort_telefax", true),
						'e_mail' => get_post_meta( $post->ID, "mkd_standort_e_mail", true),
						'maps' => get_post_meta( $post->ID, "mkd_standort_maps", true),
        );
    }
    return $posts_data;
}
