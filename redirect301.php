<?php

/**
 * Plugin Name: Redirecciones 301
 * Description: Redirige enlaces antiguos con el formato "Mes y nombre" al formato "nombre"
 * Author: Angel Aparicio
 * Author URI: http://angelaparicioprogramador.com/
 * License: GPLv2 or later
 * Version: 1.0
 */
 
add_filter( '404_template', 'redirect301_month_to_name' );

function redirect301_month_to_name( $template )
{
    if ( ! is_404() ){
        return $template;
	}

    global $wp, $wp_query;
	
	$aux = explode('/', $_SERVER['REQUEST_URI'] );
	
	if ( count($aux) < 4) {
	    return $template;
	}
	
	$year = $aux[ count($aux)-4 ];
	if ( strlen($year) != 4 ){
	    return $template;
	}
	
	$path = $aux[ count($aux)-2 ];
	
	if ( !$post = get_page_by_path( $path, OBJECT, 'post' ) ) {
        return $template;
	}

    $permalink = get_permalink( $post->ID );

    wp_redirect( $permalink, 301 );
    exit;
}

?>