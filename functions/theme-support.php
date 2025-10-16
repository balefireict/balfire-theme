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


/**
 * Custom Excerpt Lengths
 * 
 * Usage in templates:
 * echo balefire_excerpt_small();   // 15 words
 * echo balefire_excerpt_medium();  // 30 words (default)
 * echo balefire_excerpt_large();   // 55 words
 * 
 * Or with custom length:
 * echo balefire_custom_excerpt(20);
 */

// Small excerpt - 15 words
function balefire_excerpt_small() {
    return balefire_custom_excerpt(15);
}

// Medium excerpt - 30 words (default WordPress length)
function balefire_excerpt_medium() {
    return balefire_custom_excerpt(30);
}

// Large excerpt - 55 words
function balefire_excerpt_large() {
    return balefire_custom_excerpt(55);
}

// Custom excerpt with specified word count
function balefire_custom_excerpt($word_count = 30) {
    global $post;
    
    // Get the excerpt or content
    if (has_excerpt()) {
        $excerpt = get_the_excerpt();
    } else {
        $excerpt = $post->post_content;
    }
    
    // Strip shortcodes and HTML tags
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = wp_strip_all_tags($excerpt);
    
    // Trim to word count
    $excerpt = wp_trim_words($excerpt, $word_count, '...');
    
    return $excerpt;
}

// Override default excerpt length (optional - uncomment to use globally)
/*
function balefire_excerpt_length($length) {
    return 30; // Change default excerpt length
}
add_filter('excerpt_length', 'balefire_excerpt_length', 999);
*/

// Change excerpt "more" text (optional - uncomment to use)
/*
function balefire_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'balefire_excerpt_more');
*/
