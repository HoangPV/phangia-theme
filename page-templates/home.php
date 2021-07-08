<?php
/**
 * Template Name: Template Trang chủ
 */
$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$args = [
	'post_type' => 'slideshow',
	'posts_per_page' => -1,
	'orderby' => ['date'=>'DESC']
];
$context['slideshow'] = Timber::get_posts( $args );
//d($context['slideshow']);die;

Timber::render( ['page--home.twig'], $context );