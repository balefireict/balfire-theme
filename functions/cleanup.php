<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

// Fire all our initial functions at the start
add_action('after_setup_theme', 'balefire_start', 16);

/*
 * ******** CORE FRONTEND *******************************************
 */
function balefire_start()
{
    add_action('init', 'balefire_head_cleanup');  // launching operation cleanup
    add_filter('gallery_style', 'balefire_gallery_style');  // clean up gallery output in wp
    add_filter('excerpt_more', 'balefire_excerpt_more');  // cleaning up excerpt
}

function balefire_head_cleanup()
{
    remove_action('wp_head', 'feed_links_extra', 3);  // Remove category feeds
    remove_action('wp_head', 'feed_links', 2);  // Remove post and comment feeds
    remove_action('wp_head', 'rsd_link');  // Remove EditURI link
    remove_action('wp_head', 'wlwmanifest_link');  // Remove Windows live writer
    remove_action('wp_head', 'index_rel_link');  // Remove index link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);  // Remove previous link
    remove_action('wp_head', 'start_post_rel_link', 10, 0);  // Remove start link
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);  // Remove links for adjacent posts
    remove_action('wp_head', 'wp_generator');  // Remove WP version
    remove_action('app_head', 'the_generator');
    remove_action('atom_head', 'the_generator');
    remove_action('comments_atom_head', 'the_generator');
    remove_action('commentsrss2_head', 'the_generator');
    remove_action('rdf_header', 'the_generator');
    remove_action('rss_head', 'the_generator');
    remove_action('rss2_head', 'the_generator');
    remove_action('opml_head', 'the_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'wp_resource_hints', 2);  // remove <link rel='dns-prefetch' href='//s.w.org' />
    remove_action('shutdown', 'wp_ob_end_flush_all', 1);  // fixes shared IP SSLs
    add_filter('wp_is_application_passwords_available', '__return_false');  // turn off api application passwords

    // Emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('embed_head', 'print_emoji_detection_script');
    add_filter('emoji_svg_url', '__return_false');
    add_filter('tiny_mce_plugins', function ($plugins) {
        return array_diff($plugins, array(
            'wpemoji'
        ));
    });

    // Embed
    global $wp;
    $wp->public_query_vars = array_diff($wp->public_query_vars, array(
        'embed'
    ));
    wp_deregister_script('wp-embed');
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
    add_filter('embed_oembed_discover', '__return_false');
    add_filter('tiny_mce_plugins', function ($plugins) {
        return array_diff($plugins, array(
            'wpembed'
        ));
    });
    add_filter('rewrite_rules_array', function ($rules) {
        foreach ($rules as $rule => $rewrite) {
            if (strpos($rewrite, 'embed=true') !== false) {
                unset($rules[$rule]);
            }
        }
        return $rules;
    });

    // REST API
    remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);

    /*
     * add_filter ( 'rest_authentication_errors', function ($result) {
     *     if (empty ( $result ) && ! is_admin ()) {
     *         return new WP_Error ( 'rest_authentication_error', __ ( 'Forbidden', 'bf' ), array (
     *             'status' => 403
     *         ) );
     *     }
     *     return $result;
     * }, 20 );
     */
    // XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    add_filter('pings_open', '__return_false', 9999);
    add_filter('wp_headers', function ($headers) {
        unset($headers['X-Pingback'], $headers['x-pingback']);
        return $headers;
    });
}

// redirects for turned off feeds
function disable_feed()
{
    wp_safe_redirect(home_url());
}

add_action('do_feed', 'disable_feed', 1);
add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);
add_action('do_feed_rss2_comments', 'disable_feed', 1);
add_action('do_feed_atom_comments', 'disable_feed', 1);

// remove jquery migrate
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery']) && !empty($scripts->registered['jquery']->deps)) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, array('jquery-migrate'));
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');

// comments
function optimize_comment_js_loading()
{
    if (is_singular() && comments_open() && get_comments_number() > 0 && get_option('thread_comments') === '1') {
        wp_enqueue_script('comment-reply');
    } else {
        wp_dequeue_script('comment-reply');
    }
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
        remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }
    add_filter('show_recent_comments_widget_style', '__return_false');
    remove_filter('comment_text', 'make_clickable', 9);
}

add_action('wp_print_scripts', 'optimize_comment_js_loading', 100);

// reduce wp heartbeat
function reduce_heartbeat_interval($settings)
{
    $settings['interval'] = 60;
    return $settings;
}

add_filter('heartbeat_settings', 'reduce_heartbeat_interval');

// disable author archives
remove_filter('template_redirect', 'redirect_canonical');
add_action('template_redirect', function () {
    if (is_author()) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
    } else {
        redirect_canonical();
    }
});

// Remove injected CSS from gallery
function balefire_gallery_style($css)
{
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

// This removes the annoying […] to a Read More link
function balefire_excerpt_more($more)
{
    global $post;
    // edit here if you like
    return '<a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read', 'balefirewp') . get_the_title($post->ID) . '">' . __('... Read more &raquo;', 'balefirewp') . '</a>';
}

//  Stop WordPress from using the sticky class (which conflicts with Foundation), and style WordPress sticky posts using the .wp-sticky class instead
function remove_sticky_class($classes)
{
    if (in_array('sticky', $classes)) {
        $classes = array_diff($classes, array('sticky'));
        $classes[] = 'wp-sticky';
    }
    return $classes;
}

add_filter('post_class', 'remove_sticky_class');

// This is a modified the_author_posts_link() which just returns the link. This is necessary to allow usage of the usual l10n process with printf()
function balefire_get_the_author_posts_link()
{
    global $authordata;
    if (!is_object($authordata))
        return false;
    $link = sprintf(
        '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
        get_author_posts_url($authordata->ID, $authordata->user_nicename),
        esc_attr(sprintf(__('Posts by %s', 'balefirewp'), get_the_author())),  // No further l10n needed, core will take care of this one
        get_the_author()
    );
    return $link;
}

// Add page slug to body class
add_filter('body_class', 'add_slug_to_body_class');

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}

// change archive titles
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});

// REMOVE UNNECESSARY CLASSES
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);

function my_css_attributes_filter($var)
{
    return is_array($var) ? array_intersect($var, array('current-menu-item', 'menu-item-has-children')) : '';
}

// optional, not used

/*
 * function remove_script_style_version_parameter( $src ) {
 *     if( is_admin() )
 *         return $src;
 *     return strpos( $src, 'ver=' ) ? remove_query_arg( 'ver', $src ) : $src;
 * }
 * add_filter( 'style_loader_src', 'remove_script_style_version_parameter' ), 9999 );
 * add_filter( 'script_loader_src', 'remove_script_style_version_parameter' ), 9999 );
 */

/*
 * ******** BLOCK EDITOR / GUTENBERG ********************************
 */
remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
remove_theme_support('core-block-patterns');
remove_theme_support('block-templates');

function block_editor_autoclose_welcome_guide()
{
    wp_add_inline_script('wp-data', "window.addEventListener( 'DOMContentLoaded', function() {
        const selectPost = wp.data.select( 'core/edit-post' );
        const selectPreferences = wp.data.select( 'core/preferences' );
        const isWelcomeGuidePost = selectPost.isFeatureActive( 'welcomeGuide' );
        const isWelcomeGuideWidget = selectPreferences.get( 'core/edit-widgets', 'welcomeGuide' );
        if( isWelcomeGuideWidget ) {
            wp.data.dispatch( 'core/preferences' ).toggle( 'core/edit-widgets', 'welcomeGuide' );
        }
        if( isWelcomeGuidePost ) {
            wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'welcomeGuide' );
        }
    } );");
}

add_action('enqueue_block_editor_assets', 'block_editor_autoclose_welcome_guide');

function block_editor_autoexit_fullscreen_mode()
{
    wp_add_inline_script('wp-data', "window.addEventListener( 'DOMContentLoaded', function() {
        const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' );
        if( isFullscreenMode ) {
            wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
        }
    } );");
}

add_action('enqueue_block_editor_assets', 'block_editor_autoexit_fullscreen_mode');

add_action('wp_print_styles', function () {
    wp_dequeue_style('wp-block-library');
}, 100);
