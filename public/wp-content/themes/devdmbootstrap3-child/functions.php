<?php
require_once('lib/wp_bootstrap_pagination.php');

/*
 * wp_dequeue bootstrap.css of the parent DevDemBootStrap3 theme
*/
function dmbs_dequeue_enqueue_scripts() {
	global $version;
	wp_dequeue_style( 'bootstrap.css' );
	wp_dequeue_script('theme-js');
	wp_enqueue_script('child-theme-js', get_stylesheet_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'dmbs_dequeue_enqueue_scripts', 100 );


function wbmv_theme_stylesheets() {
    wp_enqueue_style( 'theme',  get_stylesheet_directory_uri() . '/css/theme.min.css', array(), '1.0.0', 'all' );


}
add_action( 'wp_enqueue_scripts', 'wbmv_theme_stylesheets' );

function wbmv_theme_js() {	

	wp_enqueue_script('main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ),'1',true );
}
add_action('wp_enqueue_scripts', 'wbmv_theme_js');


function wbmv_custom_theme_setup() {
    add_theme_support( 'html5', array( 'comment-list' ) );
}
add_action( 'after_setup_theme', 'wbmv_custom_theme_setup' );


function wbmv_create_basic_post_type($domain, $singular, $plural, $desc, $slug, $icon='dashicons-admin-post') {
	$labels = array(
		'name'                  => _x( $plural, 'Post Type General Name', $domain ),
		'singular_name'         => _x( $singular, 'Post Type Singular Name', $domain ),
		'menu_name'             => __( $plural, $domain ),
		'name_admin_bar'        => __( $plural, $domain ),
		'archives'              => __( $singular.' Archives', $domain ),
		'attributes'            => __( $singular.' Attributes', $domain ),
		'parent_item_colon'     => __( "Parent $singular:", $domain ),
		'all_items'             => __( 'All '.$plural, $domain ),
		'add_new_item'          => __( 'Add '.$singular, $domain ),
		'add_new'               => __( 'Add New '.$singular, $domain ),
		'new_item'              => __( 'New '.$singular, $domain ),
		'edit_item'             => __( 'Edit '.$singular, $domain ),
		'update_item'           => __( 'Update '.$singular, $domain ),
		'view_item'             => __( 'View '.$singular, $domain ),
		'view_items'            => __( 'View '.$plural, $domain ),
		'search_items'          => __( 'Search '.$plural, $domain ),
		'not_found'             => __( 'Not found', $domain ),
		'not_found_in_trash'    => __( 'Not found in Trash', $domain ),
		'featured_image'        => __( 'Featured Image', $domain ),
		'set_featured_image'    => __( 'Set featured image', $domain ),
		'remove_featured_image' => __( 'Remove featured image', $domain ),
		'use_featured_image'    => __( 'Use as featured image', $domain ),
		'insert_into_item'      => __( 'Insert into item', $domain ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', $domain ),
		'items_list'            => __( 'Items list', $domain ),
		'items_list_navigation' => __( 'Items list navigation', $domain ),
		'filter_items_list'     => __( 'Filter items list', $domain ),
	);
	$rewrite = array(
		'slug'                  => $slug,
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( $singular, $domain ),
		'description'           => __( $desc, $domain ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
		'taxonomies'            => array(),//array( 'pjc_news_taxonomy', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => $icon,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	return $args;
}


function wbmv_create_basic_taxonomy($domain, $singular, $plural, $slug) {
	$labels = array(
		'name'                       => _x( $plural, 'Taxonomy General Name', $domain ),
		'singular_name'              => _x( $singular, 'Taxonomy Singular Name', $domain ),
		'menu_name'                  => __( $plural, $domain ),
		'all_items'                  => __( 'All '.$plural, $domain ),
		'parent_item'                => __( 'Parent '.$singular, $domain ),
		'parent_item_colon'          => __( "Parent $singular:", $domain ),
		'new_item_name'              => __( 'New '.$singular, $domain ),
		'add_new_item'               => __( 'Add New '.$singular, $domain ),
		'edit_item'                  => __( 'Edit '.$singular, $domain ),
		'update_item'                => __( 'Update '.$singular, $domain ),
		'view_item'                  => __( 'View '.$singular, $domain ),
		'separate_items_with_commas' => __( 'Separate items with commas', $domain ),
		'add_or_remove_items'        => __( 'Add or remove items', $domain ),
		'choose_from_most_used'      => __( 'Choose from the most used', $domain ),
		'popular_items'              => __( 'Popular Items', $domain ),
		'search_items'               => __( 'Search Items', $domain ),
		'not_found'                  => __( 'Not Found', $domain ),
		'no_terms'                   => __( 'No items', $domain ),
		'items_list'                 => __( 'Items list', $domain ),
		'items_list_navigation'      => __( 'Items list navigation', $domain ),
	);
	$rewrite = array(
		'slug'                       => $slug,
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	return $args;
}


function wbmv_get_primary_term($post_id, $taxonomy) {
	$primaryTerm = false;
	if(class_exists('WPSEO_Primary_Term')) {
		$primary = new WPSEO_Primary_Term($taxonomy, $post_id);
		if($primary) {
			$primary = $primary->get_primary_term();
			if(!empty($primary)) {
				$primary = get_term( $primary );
				if ( $primary instanceof WP_Term ) {
					$primaryTerm = $primary;
				}
			}
		}
	}

	if(empty($primaryTerm)) {
		$data = get_the_terms($post_id, $taxonomy);
		if(is_array($data) && !empty($data)) {
			if($data[0] instanceof  WP_Term) {
				$primaryTerm = $data[0];
			}
		}
	}
	return $primaryTerm;
}


function wbmv_custom_posts_per_page($query) {
/*
	if (!$query->is_main_query())
		return $query;
	else if ($query->is_post_type_archive('pjc_service') || $query->is_tax('pjc_service_type'))
		$query->set('posts_per_page', '30');
	else if ($query->is_post_type_archive('pjc_news-item') || $query->is_tax('pjc_news_category'))
		$query->set('posts_per_page', '30');
	else if ($query->is_post_type_archive('pjc_aircraft') || $query->is_tax('pjc_aircraft_category'))
		$query->set('posts_per_page', '30');
	else if ($query->is_post_type_archive('pjc_aircraft') || $query->is_tax('pjc_aircraft_manufacturer'))
		$query->set('posts_per_page', '30');
	else if ($query->is_post_type_archive('pjc_airport'))
		$query->set('posts_per_page', '50');
*/		
		
	return $query;
}

// Apply pre_get_posts filter - ensure this is not called when in admin
if (!is_admin()) {
	add_filter('pre_get_posts', 'wbmv_custom_posts_per_page');
}


function fontawesome_dashboard() {
	wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', '', '4.7.0', 'all');
}
add_action('admin_init', 'fontawesome_dashboard');

function fontawesome_icon_dashboard() {
	$customPostTypes = array(	
        /*
		'pjc_aircraft' => '\f072',
		'pjc_airport' => '\f0ac',
		'pjc_service' => '\f2b5',
        'pjc_news-item' => '\f1ea'
        */
	);
	echo '<style type="text/css" media="screen">' . "\n";
	foreach($customPostTypes as $sel => $code) {
		echo "#adminmenu #menu-posts-{$sel} .wp-menu-image:before {\n";
		echo "font-family: Fontawesome !important;\n";
		echo "content: '{$code}';\n";
		echo "}\n";
	}
	echo "</style>\n";
}
add_action('admin_head', 'fontawesome_icon_dashboard');




// Example Register Service Custom Post Type
/*
function pjc_service_post_type() {
	$postType = wbmv_create_basic_post_type('pjc', 'Service', 'Services', 'PJC Services', 'services');
	$taxType = wbmv_create_basic_taxonomy('pjc', 'Service Type', 'Service Types', 'service-types');

	$postType['taxonomies'] = array( 'pjc_service_type' );
	register_post_type( 'pjc_service', $postType );
	register_taxonomy( 'pjc_service_type', array( 'pjc_service' ), $taxType );

}
add_action( 'init', 'pjc_service_post_type', 0 );
*/
