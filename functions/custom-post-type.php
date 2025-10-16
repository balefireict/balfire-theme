<?php
/*
// Reviews Custom Post Type
*/
function bma_review() {

	$labels = array(
		'name'                  => 'Reviews',
		'singular_name'         => 'Review',
		'menu_name'             => 'Reviews',
		'name_admin_bar'        => 'Reviews',
		'archives'              => 'Reviews Archives',
		'attributes'            => 'Review Attributes',
		'parent_item_colon'     => 'Parent Review:',
		'all_items'             => 'All Reviews',
		'add_new_item'          => 'Add New Review',
		'add_new'               => 'Add Review',
		'new_item'              => 'New Review',
		'edit_item'             => 'Edit Review',
		'update_item'           => 'Update Review',
		'view_item'             => 'View Review',
		'view_items'            => 'View Reviews',
		'search_items'          => 'Search Review',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Reviews list',
		'items_list_navigation' => 'Reviews list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Review',
		'description'           => 'Customer reviews',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'review_categories' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-star-filled',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'reviews','with_front' => false ),
		'capability_type'       => 'page',
	);
	register_post_type( 'bmareviews', $args );

}
add_action( 'init', 'bma_review', 0 );


// Register Custom Taxonomy
function review_categories() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Category', 'text_domain' ),
		'all_items'                  => __( 'All Reviews', 'text_domain' ),
		'parent_item'                => __( 'Parent Review', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Review:', 'text_domain' ),
		'new_item_name'              => __( 'New Review Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Review', 'text_domain' ),
		'edit_item'                  => __( 'Edit Review', 'text_domain' ),
		'update_item'                => __( 'Update Review', 'text_domain' ),
		'view_item'                  => __( 'View Review', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Reviews', 'text_domain' ),
		'search_items'               => __( 'Search Reviews', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Reviews list', 'text_domain' ),
		'items_list_navigation'      => __( 'Reviews list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);
	register_taxonomy( 'review_categories', array( 'bmareviews' ), $args );

}
add_action( 'init', 'review_categories', 0 );


// Customize results per page for Reviews
function set_posts_per_page_for_reviews_cpt( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'bmareviews' ) ) {
		$query->set( 'posts_per_page', '9999' );
	}
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_reviews_cpt' );

/*
// END Reviews Custom Post Type
*/
