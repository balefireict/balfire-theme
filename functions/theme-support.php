<?php
/**
 * Theme Support Configuration
 * 
 * @package Balefire
 */

if (!defined('ABSPATH')) exit;

// Adding WP Functions & Theme Support
function balefire_theme_support() {


	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('coach-xlarge', 1280, '', true); // Custom Thumbnail Size call using the_post_thumbnail('coach-xlarge');
    add_image_size('coach-large', 800, '', true); // Custom Thumbnail Size call using the_post_thumbnail('coach-large');
    add_image_size('coach-medium', 600, 361, array( 'center', 'center' ) ); // Hard crop center center
	

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );
	

	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );
	
	
	// Add HTML5 Support
	add_theme_support( 'html5', 
	         array( 
	         	'comment-list', 
	         	'comment-form', 
	         	'search-form', 
	         ) 
	);
	

	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'balefire_theme_support', 1280 );	
	

	// Set content width
	if (!isset($content_width)) {
		$content_width = 1280;
	}


	// Add Block Theme Support
	// add_theme_support( 'block-templates' );
	// add_theme_support( 'block-template-parts' );
	// add_theme_support( 'wp-block-styles' );
	// add_theme_support( 'align-wide' );
	// add_theme_support( 'editor-styles' );
	
	// Add WooCommerce Support
	//add_theme_support( 'woocommerce' );
	
	/*
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	*/
	
	// Adding post format support
	/*
	 add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); 
	*/
	
} /* end theme support */

add_action( 'after_setup_theme', 'balefire_theme_support' );
