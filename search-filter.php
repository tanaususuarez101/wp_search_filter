<?php
/*
Plugin Name: search filter
Plugin URI: localhost
Description: Product search plugin using filter
Version: 1.0
Author: Tana-HP
*/

/**
 * TODO - Modificar la ruta del CSS
*/

wp_register_style( 'style_search.css', 'http://localhost/wordpress/wp-content/plugins/search/assets/css/search.css' );
wp_register_script( 'search.js', 'http://localhost/wordpress/wp-content/plugins/search/assets/js/search.js');
add_shortcode( "custom_filter", "custom_filter");


function custom_filter() {


    init_config();
    include( "filter.php" );
}

function init_config() {

    wp_enqueue_style('style_search.css');
    wp_enqueue_script('search.js');

    echo "<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">";


}



