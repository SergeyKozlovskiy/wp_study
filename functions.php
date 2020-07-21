<?php
// подключение стилей
add_action( 'wp_enqueue_scripts', 'style_theme' );
// подключение скриптов
add_action( 'wp_enqueue_scripts', 'my_scripts_method');
// регистрация меню
add_action( 'after_setup_theme', 'registerMenu');
// регистрация сайдбара
add_action( 'widgets_init', 'register_my_widgets' );




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
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails', array( 'post' ) );          // вывод превью Только для post
    add_theme_support( 'post-thumbnails', array( 'page' ) ); // вывод превью Только для page
    add_image_size('post_thumb', 1300, 500, true); //размер превью
    // удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

// выводим пагинацию
the_posts_pagination( array(
	'end_size' => 2,
) ); 
}


function register_my_widgets(){
	register_sidebar( array(
		'name'          => 'right sidebar',
		'id'            => "right_sidebar",
		'description'   => 'Правый сайдбар',
		'class'         => '',
		'before_widget' => '<div class="widget">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n",
    ) );
   
}