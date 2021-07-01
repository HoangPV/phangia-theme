<?php
/**
 * Template Name: Template Trang chủ
 */
$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

$settings = \Kenhana\PgTheme\Model\Config::get_instance();

$context = array_merge($context, [
	't_settings' => $settings
]);

Timber::render( ['page--home.twig'], $context );