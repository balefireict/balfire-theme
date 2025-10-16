<?php

// Simple shortcode that does nothing visible
function balefire_silent_shortcode($atts) {
    // You could do some processing here if needed
    // Like logging, setting variables, etc.
    
    // Return empty string - no output
    return '';
}
add_shortcode('silent', 'balefire_silent_shortcode');

/**
 * AJAX handler for loading one random review
 * This bypasses WPE caching by loading reviews dynamically
 */
function handle_reviews_ajax() {
    // Get parameters from the AJAX request
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
    $show_more_button = isset($_GET['show_more_button']) ? sanitize_text_field($_GET['show_more_button']) : '';
    
    // First, get all review IDs to pick from
    $args = array(
        'posts_per_page' => -1, // Get all posts
        'post_type' => 'bmareviews',
        'post_status' => 'publish',
        'fields' => 'ids' // Only get IDs for efficiency
    );
    
    // Add taxonomy filter if category is specified
    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'review_categories',
                'field' => 'slug',
                'terms' => array(sanitize_title($category))
            )
        );
    }
    
    $review_ids = get_posts($args);
    
    // Start output buffering
    ob_start();
    
    if (empty($review_ids)) {
        echo '<div class="no-reviews-found"><p>No reviews found.</p></div>';
    } else {
        // Pick a random review ID using PHP's random functions with microsecond seeding
        mt_srand(microtime(true) * 1000000); // Seed with microseconds for better randomness
        $random_id = $review_ids[array_rand($review_ids)];
        
        // Now get the specific random post
        $loop = new WP_Query(array(
            'post__in' => array($random_id),
            'post_type' => 'bmareviews',
            'posts_per_page' => 1
        ));
        
        if ($loop->have_posts()) {
            echo '<ul class="nostyle" id="review-block-list">';
            
            while ($loop->have_posts()) {
                $loop->the_post();
                $bma_review_author = get_field('bma_review_author');
                $bma_review_link = get_field('bma_review_link');
                
                echo '<li>';
                echo '<div class="review-stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="147.163" height="22.074" viewBox="0 0 147.163 22.074">
                        <path id="Path_157" data-name="Path 157" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" fill="#fcb002"/>
                        <path id="Path_158" data-name="Path 158" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(30.981)" fill="#fcb002"/>
                        <path id="Path_159" data-name="Path 159" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(61.964)" fill="#fcb002"/>
                        <path id="Path_160" data-name="Path 160" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(92.945)" fill="#fcb002"/>
                        <path id="Path_161" data-name="Path 161" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(123.927)" fill="#fcb002"/>
                    </svg>
                </div>';
                
                echo '<div class="review-content">';
                $content = get_the_content();
                if (empty($content)) {
                    // If no content, try to get the title as the review text
                    $content = get_the_title();
                }
                echo $content;
                echo '</div>';
                
                echo '<div class="review-author">&mdash; ' . esc_html($bma_review_author) . '</div>';
                echo '</li>';
            }
            
            echo '</ul>';
        }
        
        wp_reset_postdata();
        
        // Add "Read Reviews" button if specified
        if ($show_more_button === 'true') {
            echo '<div><a href="/reviews/" class="btn-more-reviews" title="Read more review">Read Reviews</a></div>';
        }
    }
    
    // Get the buffered content and clean the buffer
    $content = ob_get_clean();
    
    // Output the content
    echo $content;
    
    // Always die in AJAX handlers
    wp_die();
}

// Hook the AJAX handler to WordPress
add_action('wp_ajax_load_reviews', 'handle_reviews_ajax');
add_action('wp_ajax_nopriv_load_reviews', 'handle_reviews_ajax');

/**
 * Debug shortcode to test reviews - only shows on development domains
 */
function debug_reviews_shortcode() {
    // Only show on development domains
    if (!is_development_domain()) {
        return '';
    }
    
    $current_domain = $_SERVER['HTTP_HOST'] ?? '';
    
    $output = '<div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0; background: #f9f9f9;">';
    $output .= '<h3>Reviews Debug Info (Development Only)</h3>';
    $output .= '<p><em>This debug info only shows on development domains (.test, .local, .dev, etc.)</em></p>';
    
    // Check if post type exists
    $output .= '<p><strong>Post type exists:</strong> ' . (post_type_exists('bmareviews') ? 'Yes' : 'No') . '</p>';
    
    // Count total reviews
    $count = wp_count_posts('bmareviews');
    $output .= '<p><strong>Total reviews:</strong> ' . $count->publish . '</p>';
    
    // Get a sample of reviews
    $sample_reviews = get_posts(array(
        'post_type' => 'bmareviews',
        'posts_per_page' => 5,
        'post_status' => 'publish'
    ));
    
    $output .= '<p><strong>Sample reviews found:</strong> ' . count($sample_reviews) . '</p>';
    
    if (!empty($sample_reviews)) {
        $output .= '<ul>';
        foreach ($sample_reviews as $review) {
            $output .= '<li>' . $review->post_title . ' (ID: ' . $review->ID . ')</li>';
        }
        $output .= '</ul>';
    }
    
    // Add current domain info
    $output .= '<p><strong>Current domain:</strong> ' . esc_html($current_domain) . '</p>';
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode('debug_reviews', 'debug_reviews_shortcode');

/**
 * Shortcode to display random reviews
 * Usage: [reviews category="service" show_more_button="true"]
 */
function balefire_reviews_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'show_more_button' => 'false',
        'count' => 1
    ), $atts);
    
    
    // Get parameters
    $category = $atts['category'];
    $show_more_button = $atts['show_more_button'] === 'true';
    
    // First, get all review IDs to pick from
    $args = array(
        'posts_per_page' => -1, // Get all posts
        'post_type' => 'bmareviews',
        'post_status' => 'publish',
        'fields' => 'ids' // Only get IDs for efficiency
    );
    
    // Add taxonomy filter if category is specified
    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'review_categories',
                'field' => 'slug',
                'terms' => array(sanitize_title($category))
            )
        );
    }
    
    $review_ids = get_posts($args);
    
    // Start output buffering
    ob_start();
    
    echo '<div class="reviews-container">';
    
    if (empty($review_ids)) {
        echo '<div class="no-reviews-found"><p>No reviews found.</p></div>';
    } else {
        // Pick a random review ID using PHP's random functions with microsecond seeding
        mt_srand(microtime(true) * 1000000); // Seed with microseconds for better randomness
        $random_id = $review_ids[array_rand($review_ids)];
        
        // Now get the specific random post
        $loop = new WP_Query(array(
            'post__in' => array($random_id),
            'post_type' => 'bmareviews',
            'posts_per_page' => 1
        ));
        
        if ($loop->have_posts()) {
            echo '<ul class="nostyle" id="review-block-list">';
            
            while ($loop->have_posts()) {
                $loop->the_post();
                $bma_review_author = get_field('bma_review_author');
                $bma_review_link = get_field('bma_review_link');
                
                echo '<li>';
                echo '<div class="review-stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="147.163" height="22.074" viewBox="0 0 147.163 22.074">
                        <path id="Path_157" data-name="Path 157" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" fill="#fcb002"/>
                        <path id="Path_158" data-name="Path 158" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(30.981)" fill="#fcb002"/>
                        <path id="Path_159" data-name="Path 159" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(61.964)" fill="#fcb002"/>
                        <path id="Path_160" data-name="Path 160" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(92.945)" fill="#fcb002"/>
                        <path id="Path_161" data-name="Path 161" d="M11.618,0l3.631,7.261,7.987,1.162-5.809,5.664,1.307,7.987L11.618,18.3,4.5,22.074l1.307-7.987L0,8.423,7.987,7.261Z" transform="translate(123.927)" fill="#fcb002"/>
                    </svg>
                </div>';
                
                echo '<div class="review-content">';
                $content = get_the_content();
                if (empty($content)) {
                    // If no content, try to get the title as the review text
                    $content = get_the_title();
                }
                echo $content;
                echo '</div>';
                
                echo '<div class="review-author">&mdash; ' . esc_html($bma_review_author) . '</div>';
                echo '</li>';
            }
            
            echo '</ul>';
        }
        
        wp_reset_postdata();
        
        // Add "Read Reviews" button if specified
        if ($show_more_button) {
            echo '<div><a href="/reviews/" class="btn-more-reviews" title="Read more review">Read Reviews</a></div>';
        }
    }
    
    echo '</div>'; // Close reviews-container
    
    return ob_get_clean();
}
add_shortcode('reviews', 'balefire_reviews_shortcode');