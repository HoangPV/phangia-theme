<?php
/**
 * Template Name: Template Dịch vụ
 */
$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;



Timber::render( ['page--services.twig'], $context );