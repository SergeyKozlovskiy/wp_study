<?php

add_action( 'wp_enqueue_scripts', 'style_theme' );
add_action( 'wp_enqueue_scripts', 'my_scripts_method');
add_action( 'after_setup_theme', 'registerMenu');



function style_theme(){
    wp_enqueue_style('style', get_stylesheet_directory_uri());
    wp_enqueue_style( 'default_css', get_template_directory_uri() . '/assets/css/default.css');
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/assets/css/fonts.css');
    wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/layout.css');
    wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/assets/css/media-queries.css');
}

function my_scripts_method() {
	// отменяем зарегистрированный jQuery
	// вместо "jquery-core", можно вписать "jquery", тогда будет отменен еще и jquery-migrate
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', get_template_directory_uri() . '/assets/js/jquery-1.10.2.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), null, true);
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array('jquery'), null, true);
    wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js', array('jquery'), null, true);
    wp_enqueue_script( 'init', get_template_directory_uri() . '/assets/js/init.js', array('jquery'), null, true);
}

function registerMenu() {
    register_nav_menu( 'top', 'главное меню' );
    register_nav_menu( 'bottom', 'меню в подвале' );
}
