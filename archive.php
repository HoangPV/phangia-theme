<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} elseif ( is_category() ) {
	$category         = get_category( get_query_var( 'cat' ) );
	$timber_term = new \Timber\Term($category->term_id);
//d($category, new \Timber\Term($category->term_id));
	$context['timber_term'] = $timber_term;
	//$banner = $timber_term->get_field('banner')['guid']??'';
	$context['title'] = single_cat_title( '', false );
	//$context['category_banner'] = $timber_term->get_field('banner')['guid']?:'';
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
	array_unshift( $templates, 'archive-' . $category->category_nicename . '.twig' );
	//d($context);die;

} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$context['posts'] = new Timber\PostQuery();
if (is_category()) {
	$args = [
		'orderby' => 'name',
		'order' => 'ASC'
	];
	$categories=get_categories($args);
	$context['category_banner'] = $timber_term->get_field('banner')['guid'];
	//$context['hoang']='hello world';
	$context['categories'] = $categories;
}

Timber::render( $templates, $context );
