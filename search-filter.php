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
    echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>";
    echo "<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>";
    echo "<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>";

}



