<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

/**
 * Menu Functions
 */
// Register menus
register_nav_menus(
    array(
        'primary-nav' => __('Primary Navigation', 'balefirewp'),  // Main nav in header
        'secondary-nav' => __('Secondary Navigation', 'balefirewp'),  // Secondary nav
        'ancillary-nav' => __('Ancillary Navigation', 'balefirewp'),  // Secondary nav
        // 'offcanvas-nav'	=> __( 'Off-Canvas Menu', 'balefirewp' ),			// Off-Canvas nav
        'footer-nav' => __('Footer Navigation', 'balefirewp')  // Secondary nav in footer
    )
);

// The Top Menu
function balefire_primary_nav()
{
    wp_nav_menu(array(
        'container' => false,  // Remove nav container
        'menu_id' => 'nav-main',  // Adding custom nav ID
        'menu_class' => 'nostyle',  // Adding custom nav class
        // 'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
        // 'items_wrap'		=> '<ul class="nav">%3$s</ul>',
        'theme_location' => 'primary-nav',  // Where it's located in the theme
        'depth' => 5,  // Limit the depth of the nav
        'fallback_cb' => false,  // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
}

// The Secondary Menu (if you need one)
function balefire_secondary_nav()
{
    wp_nav_menu(array(
        'container' => false,  // Remove nav container
        'menu_id' => 'nav-secondary',
        'menu_class' => 'nostyle',  // Adding custom nav class
        // 'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
        // 'items_wrap'		=> '<ul id="%1$s" class="nav">%3$s</ul>',
        'theme_location' => 'secondary-nav',  // Where it's located in the theme
        'depth' => 5,  // Limit the depth of the nav
        'fallback_cb' => false,  // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
}

// The Ancillary Menu
function balefire_ancillary_nav()
{
    wp_nav_menu(array(
        'container' => false,  // Remove nav container
        'menu_id' => 'ancillary-nav',  // Adding custom nav id
        'menu_class' => 'nostyle',  // Adding custom nav class
        // 'items_wrap'		=> '<ul id="%1$s" class="nav">%3$s</ul>',
        'theme_location' => 'ancillary-nav',  // Where it's located in the theme
        'depth' => 0,  // Limit the depth of the nav
        'fallback_cb' => '',  // Fallback function (see below)
    ));
}

// The Footer Menu
function balefire_footer_nav()
{
    wp_nav_menu(array(
        'container' => 'false',  // Remove nav container
        'menu_id' => 'nav-footer',  // Adding custom nav id
        'menu_class' => 'nostyle',  // Adding custom nav class
        // 'items_wrap'		=> '<ul id="%1$s" class="nav">%3$s</ul>',
        'theme_location' => 'footer-nav',  // Where it's located in the theme
        'depth' => 0,  // Limit the depth of the nav
        'fallback_cb' => ''  // Fallback function
    ));
}  /* End Footer Menu */

// Extend Walker_Nav_Menu to add sub-menu class
class Topbar_Menu_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = Array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}

// Add active class to menu
function required_active_nav_class($classes, $item)
{
    // Get post type
    $post_type = get_post_type();

    // If menu item is current page or ancestor
    if ($item->current == 1 || $item->current_item_ancestor == true) {
        $classes[] = 'active';
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'required_active_nav_class', 10, 2);
