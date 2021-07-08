<?php
/**
 * Template Name: Template Giới thiệu
 */
$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

$settings = \Kenhana\PgTheme\Model\Config::get_instance();



Timber::render( ['page--about.twig'], $context );