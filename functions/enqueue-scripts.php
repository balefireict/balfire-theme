<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

/**
 * Check if current domain is a development domain (.test, .local, .dev, etc.)
 * This is a general utility function for the entire theme
 */
function is_development_domain(): bool
{
    $current_domain = $_SERVER['HTTP_HOST'] ?? '';
    
    // List of development TLDs
    $dev_tlds = ['.test', '.local', '.dev', '.localhost', '.localdomain'];
    
    foreach ($dev_tlds as $tld) {
        if (substr($current_domain, -strlen($tld)) === $tld) {
            return true;
        }
    }
    
    // Also check for common development patterns
    $dev_patterns = ['localhost', '127.0.0.1', '192.168.', '10.0.', '172.16.'];
    foreach ($dev_patterns as $pattern) {
        if (strpos($current_domain, $pattern) !== false) {
            return true;
        }
    }
    
    return false;
}

/**
 * Properly handle jQuery enqueuing
 */
function replace_jquery(): void
{
    // Only modify jQuery on the front-end
    if (!is_admin() && !is_customize_preview()) {
        // Deregister both jquery and jquery-core
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        
        // Register jquery-core first (this is the actual jQuery library)
        wp_register_script(
            'jquery-core',
            'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js',
            [],
            '3.7.1',
            false
        );
        
        // Register jquery as a wrapper that depends on jquery-core (WordPress standard)
        wp_register_script(
            'jquery',
            false, // No source needed since it's just a dependency wrapper
            ['jquery-core'],
            '3.7.1',
            false
        );
        
        wp_enqueue_script('jquery');
    }
}

add_action('wp_enqueue_scripts', 'replace_jquery', 1);

// Script versioning is handled by WordPress automatically

// Force version number by modifying the style tag directly
function balefire_style_loader_tag($tag, $handle)
{
    if ($handle === 'balefire-styles') {
        $theme_version = wp_get_theme()->get('Version');
        $search = get_stylesheet_directory_uri() . '/style.css';
        $replace = $search . '?ver=' . $theme_version;
        return str_replace($search, $replace, $tag);
    }
    return $tag;
}

add_filter('style_loader_tag', 'balefire_style_loader_tag', 10, 2);

// Remove -js suffix from jquery-core script tag id
function balefire_jquery_core_tag($tag, $handle)
{
    if ($handle === 'jquery-core') {
        $tag = str_replace('id="jquery-core-js"', 'id="jquery-core"', $tag);
    }
    return $tag;
}

add_filter('script_loader_tag', 'balefire_jquery_core_tag', 5, 2);

// Enqueue assets
function enqueue_assets()
{
    // Get theme version
    $theme_version = wp_get_theme()->get('Version');

    // Force style registration with specific version
    wp_deregister_style('balefire-styles');
    wp_register_style('balefire-styles', get_stylesheet_directory_uri() . '/style.css', array(), $theme_version, 'all');
    wp_enqueue_style('balefire-styles');

    // Force script registration with specific version
    wp_deregister_script('balefire-scripts');
    wp_register_script('balefire-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), $theme_version, true);
    wp_enqueue_script('balefire-scripts');
}

add_action('wp_enqueue_scripts', 'enqueue_assets', 100);

remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

add_action('wp_enqueue_scripts', function () {
    // https://github.com/WordPress/gutenberg/issues/36834
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');

    // https://stackoverflow.com/a/74341697/278272
    wp_dequeue_style('classic-theme-styles');

    // Or, go deep: https://fullsiteediting.com/lessons/how-to-remove-default-block-styles
});

add_filter('should_load_separate_core_block_assets', '__return_true');

add_action('wp_head', 'myoverride', 1);

function myoverride()
{
    if (class_exists('Vc_Manager')) {
        remove_action('wp_head', array(visual_composer(), 'addMetaData'));
    }
}
