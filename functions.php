<?php 
function twentynineteen_child_enqueue_styles() {

    // Enqueue Parent Theme CSS
    wp_enqueue_style( 'twentynineteen-parent-styles', get_template_directory_uri() .'/style.css');

    // Enqueue Child Theme JS file
    wp_enqueue_script( 'twentynineteen-child-js', get_stylesheet_directory_uri() .'/js/child-scripts.js');

}
add_action( 'wp_enqueue_scripts', 'twentynineteen_child_enqueue_styles' );

// Text domain
function twentynineteen_child_setup() {
    // Prepare theme for transition
    load_child_theme_textdomain('twentynineteen_child', get_stylesheet_directory() . '/languages' );
}
add_action('after_setup_theme', 'twentynineteen_child_setup');

// Post tag modification
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function twentynineteen_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    printf(
        '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
        twentynineteen_get_icon_svg( '', 16 ),
        esc_url( get_permalink() ),
        $time_string
    );
    
    /* translators: used between list items, there is a space after the comma. */
    $categories_list = get_the_category_list( __( ', ', 'twentynineteen' ) );
    if ( $categories_list ) {
        printf(
            /* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of categories. */
            '<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
            twentynineteen_get_icon_svg( '', 16 ),
            __( 'Posted in', 'twentynineteen' ),
            $categories_list
        ); // WPCS: XSS OK.
    }
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function twentynineteen_entry_footer() {

    // Hide author, post date, category and tag text for pages.
    if ( 'post' === get_post_type() ) {

    }


}