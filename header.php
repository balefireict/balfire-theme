<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <link rel="dns-prefetch" href="//apis.google.com">
        <link rel="preconnect" href="https://ajax.googleapis.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700&family=Barlow:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
        <!-- Google Tag Manager -->
        <!-- End Google Tag Manager -->
        <meta name="author" content="<?php echo get_bloginfo('name'); ?>">
    </head>
    <body <?php body_class(); ?>>
        <!-- Google Tag Manager (noscript) -->
        <!-- End Google Tag Manager (noscript) -->

        <a class="skip-link" href="#main-content">Skip to main content</a>

        <header id="header">
            <div class="wrapper">
                <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                    <?php get_template_part('inc/logo'); ?>
                </a>
                <?php if (has_nav_menu('primary-nav')): ?>
                    <nav class="nav" role="navigation" id="nav-main-wrapper">
                        <?php balefire_primary_nav(); ?>
                    </nav>
                <?php endif; ?>
                <?php if (has_nav_menu('secondary-nav')): ?>
                    <nav class="nav secondary-nav" role="navigation" id="nav-secondary-wrapper">
                        <?php balefire_secondary_nav(); ?>
                    </nav>
                <?php endif; ?>
                <?php get_template_part('inc/off-canvas-menu'); ?>       
            </div><!-- wrapper -->
        </header>

        <a name="main-content"></a>