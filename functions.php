<?php
	
function additional_theme_scripts() {


	wp_register_script ( 'ajax-functions', get_stylesheet_directory_uri() . '/js/ajax-functions.js', array( 'jquery' ), '', true );
	
	// Localize Scripts
	$php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) );
	wp_localize_script( 'ajax-functions', 'php_array', $php_array );

	wp_enqueue_script( 'ajax-functions' );

}
add_action( 'wp_enqueue_scripts', 'additional_theme_scripts', 5 );


// Ajax Post
add_action( 'wp_ajax_theme_post_example', 'theme_post_example_init' );
add_action( 'wp_ajax_nopriv_theme_post_example', 'theme_post_example_init' );
function theme_post_example_init() {

	// Make Query
	$args = array( 'p' => $_POST['id'] );
	
	$theme_post_query = new WP_Query( $args );
	
	while ( $theme_post_query->have_posts() ) : $theme_post_query->the_post();
	
		get_template_part( 'inc/content', get_post_format() );
				
	endwhile;
	
	wp_reset_postdata();		
	exit;
	
}