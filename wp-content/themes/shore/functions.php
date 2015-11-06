<?php
/*
 * @package Shore Wordpress Theme by HighGrade
 * @since version 1.0
 */
 
 // Enqueue CSS and JS script to frontend header and footer
 if( !function_exists('hgr_enqueue') ) {
	function hgr_enqueue() {
		// Include framework glogal
			global $redux_options;
		// CSS
		wp_enqueue_style( 'css-bootstrap', 				get_template_directory_uri() . '/highgrade/css/bootstrap.min.css', '', '3.1.1' );
		wp_enqueue_style( 'hgr-icons', 					get_template_directory_uri() . '/highgrade/css/icons.css', '', '1.0.0' );
		
		wp_enqueue_style( 'css-fontawesome', 			get_template_directory_uri() . '/highgrade/css/font-awesome.min.css', '', '1.0.0' );
		wp_enqueue_style( 'css-component', 				get_template_directory_uri() . '/highgrade/css/component.css', '', '1.0.0' );
		
		wp_enqueue_style( 'css-venobox', 				get_template_directory_uri() . '/highgrade/css/venobox.css', '', '1.0.0' );		
		
		wp_enqueue_style( 'theme-css', 					get_stylesheet_uri() );
		
		//wp_enqueue_style( 'theme-dinamic-css', 			get_template_directory_uri() . '/highgrade/theme-style.css', '', '1.0.0' );
		
		// JS
		wp_enqueue_script( 'bootstrap-min',				get_template_directory_uri() . '/highgrade/js/bootstrap.min.js', array('jquery'), '3.1.0', true );
		
		wp_enqueue_script( 'hgr-imagesloaded',			get_template_directory_uri() . '/highgrade/js/imagesloaded.js', array(), '3.1.4', true );
		wp_enqueue_script('isotope'); 					// included from VC
		wp_enqueue_script('waypoints'); 					// included from VC
		
		wp_enqueue_script( 'hgr-modernizr-custom',		get_template_directory_uri() . '/highgrade/js/modernizr.custom.js', array(), '1.0', false );
		
		wp_enqueue_script( 'hgr-venobox',				get_template_directory_uri() . '/highgrade/js/venobox.min.js', array(), '1.0.0', true );
		
		wp_enqueue_script( 'hgr-js',						get_template_directory_uri() . '/highgrade/js/app.js', array(), '1.0.0', true );
		
		// Visual composer - move styles to head
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_style('js_composer_custom_css');

	}
 }
 add_action( 'wp_enqueue_scripts', 'hgr_enqueue' );

 // Setup $content_width - REQUIRED
 if ( ! isset( $content_width ) ) {$content_width = 1180;}
	
 // Custom pagination for posts
 if( !function_exists('hgr_pagination') ) {
	function hgr_pagination( $args = '' ) {
		$defaults = array(
			'before' => '<p id="post-pagination">' . __( 'Pages:', 'hgr_lang' ), 
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => __( 'Next page', 'hgr_lang' ),
			'previouspagelink' => __( 'Previous page', 'hgr_lang' ),
			'pagelink' => '%',
			'echo' => 1
		);
	
		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );
	
		global $page, $numpages, $multipage, $more, $pagenow;
	
		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '<li>';
						$output .= _wp_link_page( $i );
					}
					else {
						$output .= '<li class="active">';
						$output .= _wp_link_page( $i );
					}
	
					$output .= $j;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '</a>';
						$output .= '</li>';
					}
					else {
						$output .= '</a>';
						$output .= '</li>';
					}
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}
		if ( $echo )
			echo $output;
		return $output;
	}
 }
 
 // Search only in blog posts
 function hgr_search_filter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
 }
 add_filter('pre_get_posts','hgr_search_filter');
 
 // Include Mobile detect class
 require_once dirname( __FILE__ ) . '/highgrade/Mobile_Detect.php';
 
  /**
 * @package	TGM-Plugin-Activation
 * @version	2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright Copyright (c) 2012, Thomas Griffin
 * @license	http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
// Include the TGM_Plugin_Activation class
	require_once dirname( __FILE__ ) . '/highgrade/plugins/class-tgm-plugin-activation.php';
	add_action( 'tgmpa_register', 'hgr_register_required_plugins' );


// Register the required / recommended plugins for theme
 if( !function_exists('hgr_register_required_plugins') ) {
		function hgr_register_required_plugins() {
		$plugins = array(
			// Visual Composer
			array(
				'name'     				=> 'WPBakery Visual Composer', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'default_path' 			=> '',
				'source'   				=> get_template_directory() . '/highgrade/plugins/js_composer.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 					=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 		=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			// Revolution Slider
			array(
				'name'     				=> 'Revolution Slider', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'default_path' 			=> '',
				'source'   				=> get_template_directory() . '/highgrade/plugins/revslider.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 					=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 		=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			// HighGrade Extender for Visual Composer
			array(
				'name'     				=> 'HighGrade Extender for Visual Composer', // The plugin name
				'slug'     				=> 'hgr_vc_extender', // The plugin slug (typically the folder name)
				'default_path' 			=> '',
				'source'   				=> get_template_directory() . '/highgrade/plugins/hgr_vc_extender.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 					=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 		=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			// Video & Parallax Backgrounds For Visual Composer
			array(
				'name'     				=> 'Video & Parallax Backgrounds For Visual Composer', // The plugin name
				'slug'     				=> 'vc-row-parallax', // The plugin slug (typically the folder name)
				'default_path' 			=> '',
				'source'   				=> get_template_directory() . '/highgrade/plugins/vc-row-parallax.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			// Essential Grid
			array(
				'name'     				=> 'Essential Grid', // The plugin name
				'slug'     				=> 'essential-grid', // The plugin slug (typically the folder name)
				'default_path' 			=> '',
				'source'   				=> get_template_directory() . '/highgrade/plugins/essential-grid.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 					=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 		=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			// Contact Form 7
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' => false,
			),
			// Wordpress Importer
			array(
				'name' 		=> 'Wordpress Importer',
				'slug' 		=> 'wordpress-importer',
				'required' => false,
			),
		);
		
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'hgr_lang';
	
		$config = array(
            
            'default_path' 		=> '',                         	/* Default absolute path to pre-packaged plugins */
            'menu'         		=> 'tgmpa-install-plugins', 		/* Menu slug */
            'has_notices'      	=> true,                       	/* Show admin notices or not */
            'is_automatic'    	=> true,					   		/* Automatically activate plugins after installation or not */
           
        );
    
        tgmpa( $plugins, $config );
	 }
 }
 
 
 // Some basic setup after theme setup
 add_action( 'after_setup_theme', 'hgr_theme_setup' );
 function hgr_theme_setup(){
		// Add theme support for featured image, menus, etc
		if ( function_exists( 'add_theme_support' ) ) { 
			$hgr_defaults = array(
				'default-image'          => ''/*get_template_directory_uri() . '/highgrade/images/header-image-2560.jpg'*/,
				'random-default'         => false,
				'width'                  => 2560,
				'height'                 => 1440,
				'flex-height'            => true,
				'flex-width'             => true,
				'default-text-color'     => '#fff',
				'header-text'            => false,
				'uploads'                => true,
				'wp-head-callback'       => '',
				'admin-head-callback'    => '',
				'admin-preview-callback' => '',
			);
		add_theme_support( 'custom-header', $hgr_defaults );
		
		// Add theme support for featured image
		add_theme_support( 'post-thumbnails', array( 'post','hgr_portfolio','hgr_testimonials' ) );
		
		// Add theme support for feed links
		add_theme_support( 'automatic-feed-links' );
		
		// Add theme support for woocommerce
		add_theme_support( 'woocommerce' );
		
		// Add theme support for menus
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'header-menu' => 'Header Menu'
				)
			);
		}

	 }
	 
	// Add multilanguage support
	load_theme_textdomain( 'hgr_lang', get_template_directory() . '/highgrade/languages' );
	
	// Widgets
	// Enables wigitized sidebars
 	if ( function_exists('register_sidebar') ) {
	register_sidebar(array(	'name'=>'Blog',
								'id'=>	'blog-widgets',
								'description' => __( 'Widgets in this area will be shown into the blog sidebar.', 'hgr_lang'),
								'before_widget' => '<div class="col-md-12 blog_widget">',
								'after_widget' => '</div>',
								'before_title' => '<h4>',
								'after_title' => '</h4>',
							)
					);
	}
 	// END Widgets
	
 }
 
 // Create post type: Portfolio, Testimonials
 add_action( 'init', 'hgr_create_post_type' );
 function hgr_create_post_type() {
	register_post_type( 'hgr_portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'hgr_lang' ),
				'singular_name' => __( 'Portfolio', 'hgr_lang' )
			),
		'public' => true,
		'menu_icon' =>'dashicons-format-image',
		'has_archive' => true,
		'rewrite' => array('slug' => 'portfolio'),
		'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
		'taxonomies' => array('post_tag','portfolio-category')
		)
	);
	
	register_post_type( 'hgr_testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials', 'hgr_lang' ),
				'singular_name' => __( 'Testimonial','hgr_lang' )
			),
		'public' => true,
		'menu_icon'=>'dashicons-editor-quote',
		'has_archive' => true,
		'rewrite' => array('slug' => 'testimonials'),
		'supports' => array('title','editor','thumbnail')
		)
	);}

 // Create portfolio categories taxonomy
 add_action( 'init', 'hgr_portfolio_tax' );
	function hgr_portfolio_tax() {
		register_taxonomy(
			'portfolio-category',
			array('hgr_portfolio'),
			array(
				'hierarchical'=> true,
				'label' => __( 'Categories','hgr_lang' ),
				'rewrite' => array( 'slug' => 'portfolio-category' ),
			)
		);
	}
	
 // Portfolio Metaboxes	
	function hgr_portfoliometaboxes() {
    	$screens = array( 'hgr_testimonials' );
    	foreach ( $screens as $screen ) {
       		add_meta_box(
           	'hgr_testimetaboxid',
            	__( 'Testimonial details', 'hgr_lang' ),
            	'hgr_testi_custom_box',
            	$screen
        	);
    	}
	}
	add_action( 'add_meta_boxes', 'hgr_portfoliometaboxes' );
	function hgr_testi_custom_box($post) {
		// Add an nonce field so we can check for it later
		wp_nonce_field( 'hgr_testi_custom_box', 'hgr_testi_custom_box_nonce' );

		// Get metaboxes values from database
		$hgr_testi_author			=	get_post_meta( $post->ID, '_hgr_testi_author', true );
		$hgr_testi_role				=	get_post_meta( $post->ID, '_hgr_testi_role', true );
		
		// Construct the metaboxes and print out
		
		// Testimonial author name
		echo '<div class="settBlock"><label for="testi_author">';
		   _e( "Testimonial author", 'hgr_lang' );
		echo '</label> ';
		echo '<input type="text" id="testi_author" name="testi_author" value="' . esc_attr( $hgr_testi_author ) . '" size="25" placeholder="Jon Doe" /></div>';
	  
	  	// Testimonial author company and job
	  	echo '<div class="settBlock"><label for="testi_role">';
		   _e( "Company and Position", 'hgr_lang' );
		echo '</label> ';
	  	echo '<input type="text" id="testi_role" name="testi_role" value="' . esc_attr( $hgr_testi_role ) . '" size="25" /></div>';
	}
	function hgr_save_testidata( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['hgr_testi_custom_box_nonce'] ) ) {
    		return $post_id;
		}

		$nonce = $_POST['hgr_testi_custom_box_nonce'];

		// Verify that the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'hgr_testi_custom_box' ) ) {
			return $post_id;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'hgr_testimonials' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}
		
		// OK to save data
		// Sanitize user input
		$hgr_testi_author	= sanitize_text_field( $_POST['testi_author'] );
 		$hgr_testi_role		= sanitize_text_field( $_POST['testi_role'] );

		
		// Update the meta field in the database
		update_post_meta( $post_id, '_hgr_testi_author',		$hgr_testi_author );
		update_post_meta( $post_id, '_hgr_testi_role',	$hgr_testi_role );
	}
	add_action( 'save_post', 'hgr_save_testidata' );
	
	

 
 // Pages Metaboxes
	// Generate the metabox
	function hgr_metaboxes() {
    	$screens = array( 'page' );
    	foreach ( $screens as $screen ) {
       		add_meta_box(
           	'hgr_metaboxid',
            	__( 'Page settings', 'hgr_lang' ),
            	'hgr_inner_custom_box',
            	$screen
        	);
    	}
	}
	add_action( 'add_meta_boxes', 'hgr_metaboxes' );

	// Print the box content
	function hgr_inner_custom_box($post) {
		// Add an nonce field so we can check for it later
		wp_nonce_field( 'hgr_inner_custom_box', 'hgr_inner_custom_box_nonce' );

		// Get metaboxes values from database
		$hgr_page_bgcolor			=	get_post_meta( $post->ID, '_hgr_page_bgcolor', true );
		$hgr_page_top_padding		=	get_post_meta( $post->ID, '_hgr_page_top_padding', true );
		$hgr_page_btm_padding		=	get_post_meta( $post->ID, '_hgr_page_btm_padding', true );
		$hgr_page_color_scheme		=	get_post_meta( $post->ID, '_hgr_page_color_scheme', true );
		$hgr_page_height			=	get_post_meta( $post->ID, '_hgr_page_height', true );
		
		// Construct the metaboxes and print out
		// Page color scheme
		echo '<div class="settBlock"><label for="page_color_scheme">';
		   _e( "Page color scheme", 'hgr_lang' );
		echo '</label> ';
		if($hgr_page_color_scheme == 'dark_scheme'){
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme" selected="selected">Dark scheme</option><option value="light_scheme" name="light_scheme">Light scheme</option></select></div>';
		}
		elseif($hgr_page_color_scheme == 'light_scheme'){
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme">Dark scheme</option><option value="light_scheme" name="light_scheme" selected="selected">Light scheme</option></select></div>';
		}
		else{
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="light_scheme" name="light_scheme" selected="selected">Light scheme</option><option value="dark_scheme" name="dark_scheme">Dark scheme</option></select></div>';
		}
		
		// Page background color
		echo '<div class="settBlock"><label for="page_bgcolor">';
		   _e( "Page background color", 'hgr_lang' );
		echo '</label> ';
		echo '<input type="text" id="page_bgcolor" name="page_bgcolor" value="' . esc_attr( $hgr_page_bgcolor ) . '" size="25" placeholder="#000" /></div>';
	  
	  	// Page top padding
	  	echo '<div class="settBlock"><label for="page_top_padding">';
		   _e( "Page top padding", 'hgr_lang' );
		echo '</label> ';
	  	echo '<input type="text" id="page_top_padding" name="page_top_padding" value="' . esc_attr( $hgr_page_top_padding ) . '" size="25" /> <em>pixels</em></div>';
	  
	  	// Page bottom padding
	  	echo '<div class="settBlock"><label for="page_btm_padding">';
		   _e( "Page bottom padding", 'hgr_lang' );
	  	echo '</label> ';
	  	echo '<input type="text" id="page_btm_padding" name="page_btm_padding" value="' . esc_attr( $hgr_page_btm_padding ) . '" size="25" /> <em>pixels</em></div>';
		
		// Page height
	  	echo '<div class="settBlock"><label for="page_height">';
		   _e( "Page height", 'hgr_lang' );
	  	echo '</label> ';
	  	echo '<input type="text" id="page_height" name="page_height" value="' . esc_attr( $hgr_page_height ) . '" size="25" /> <em>pixels. If not set, auto-height is set.</em></div>';
	}
	
	// Save the metabox data to database
	function hgr_save_postdata( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['hgr_inner_custom_box_nonce'] ) ) {
    		return $post_id;
		}

		$nonce = $_POST['hgr_inner_custom_box_nonce'];

		// Verify that the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'hgr_inner_custom_box' ) ) {
			return $post_id;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}
		
		// OK to save data
		// Sanitize user input
		$page_bgcolor				= sanitize_text_field( $_POST['page_bgcolor'] );
 		$hgr_page_top_padding		= sanitize_text_field( $_POST['page_top_padding'] );
 		$hgr_page_btm_padding		= sanitize_text_field( $_POST['page_btm_padding'] );
		$hgr_page_color_scheme		= sanitize_text_field( $_POST['page_color_scheme'] );
		$hgr_page_height			= sanitize_text_field( $_POST['page_height'] );
		
		// Update the meta field in the database
		update_post_meta( $post_id, '_hgr_page_bgcolor',			$page_bgcolor );
		update_post_meta( $post_id, '_hgr_page_top_padding',		$hgr_page_top_padding );
		update_post_meta( $post_id, '_hgr_page_btm_padding',		$hgr_page_btm_padding );
		update_post_meta( $post_id, '_hgr_page_color_scheme',	$hgr_page_color_scheme );
		update_post_meta( $post_id, '_hgr_page_height',			$hgr_page_height );
	}
	add_action( 'save_post', 'hgr_save_postdata' );
 // END Pages Metaboxes





 // Custom search form
 function hgr_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search" />
    <input type="submit" id="searchsubmit" value="'. __( 'Search','hgr_lang' ) .'" />
    </div>
    </form>';

    return $form;
 }
 add_filter( 'get_search_form', 'hgr_search_form' );
 
 
 // Icons shortcode
	add_shortcode( 'icon', 'hgr_icons_shortcode' );
	function hgr_icons_shortcode( $content = null ) {
		$addColor = '';
		$addSize = '';
		$addHeight='';
		extract( shortcode_atts( array(
					'name' => 'default',
					'color'=>'',
					'size'=>'',
					'height'=>''
				), $content ) );
		
		if( !empty($color) ) {
			$addColor=' color:' . $color . '; ';
		}
		if( !empty($size) ) {
			$addSize=' font-size:' . $size . '!important; ';
		}
		if( !empty($height) ) {
			$addHeight=' line-height:' . $height . '!important; ';
		}
		return '<i class="icon ' . $name . '" style="'. $addColor . $addSize . $addHeight.'"></i>';
 	}
 
 
 // Include the HighGrade Framework
	if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/highgrade/framework/framework.php' ) ) {require_once( dirname( __FILE__ ) . '/highgrade/framework/framework.php' );}
	if ( file_exists( dirname( __FILE__ ) . '/highgrade/config.php' ) ) {require_once( dirname( __FILE__ ) . '/highgrade/config.php' );}

// Custom CSS for Highgrade Framework admin panel
	function hgr_addAndOverridePanelCSS() {
	  wp_dequeue_style( 'redux-css' );
	  wp_register_style(
		'highgrade-css',
		get_template_directory_uri().'/highgrade/css/framework.css',
		array(),
		time(),
		'all'
	  );    
	  wp_enqueue_style('highgrade-css');
	}
	add_action( 'redux/page/hgr_options/enqueue', 'hgr_addAndOverridePanelCSS' );
	
	add_action('admin_head', 'hgr_custom_meta_css');
	function hgr_custom_meta_css() {
	  echo '<style>
		#hgr_metaboxid label {
		  display: inline-block;
		  min-width:170px;
		} 
		#hgr_metaboxid .settBlock {
		  display: block;
		  margin-bottom:5px;
		} 
		#hgr_metaboxid input[type="text"], #hgr_metaboxid select {
		  width: 120px;
		} 
	  </style>';
	}
	
	function hgr_get_post_meta_by_key($key) {
		global $wpdb;
		$vc_styles = '';
		$meta = $wpdb->get_results("SELECT `meta_value` FROM `".$wpdb->postmeta."` WHERE meta_key='".$key."' ");

		if ( !empty($meta) ) {
			foreach($meta as $custom_style){
				$vc_styles .= $custom_style->meta_value;
			}
		}
		else {
			return false;
		}
		return $vc_styles;
	}
	
	
 // HGR Menu fallback
	function hgr_menu_fallback(){
		echo '<ul id="mainNavUl" class="nav navbar-nav navbar-right"><li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-480 current_page_item"><a href="'.home_url().'">Home</a></li></ul>';
	}



 // Boostrap Menu Walker ( from: https://github.com/twittem/wp-bootstrap-navwalker )
 // Register Custom Navigation Walker
	require_once(dirname( __FILE__ ) . '/highgrade/hgr_bootstrap_navwalker.php');
	
 // WOOCOMMERCE
 add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
 
 // Remove breadcrumb
 remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
 
 
 // Remove page title 
 add_filter('woocommerce_show_page_title', '__return_false');
 
 /**
 * Custom Add To Cart Messages
 * Add this to your theme functions.php file
 **/
 add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
 function custom_add_to_cart_message() {
	global $woocommerce;
 
	// Output success messages
	if (get_option('woocommerce_cart_redirect_after_add')=='yes') :
	 
	$return_to = get_permalink(woocommerce_get_page_id('shop'));
	 
	$message = sprintf('<a href="%s" class="button">%s</a> %s', $return_to, __('Continue Shopping &rarr;', 'woocommerce'), __('Product successfully added to your cart.', 'woocommerce') );
	 
	else :
	
	$message = '<i class="fa fa-icon fa-check" style="font-size:17px;margin-right:10px;"></i>';
	
	$message .= sprintf('<a href="%s" class="hgr_view_cart_link">%s <i class="fa fa-icon fa-angle-right" style="font-size:17px;margin-left:10px;"></i></a> %s', get_permalink(woocommerce_get_page_id('cart')), __('View Cart', 'woocommerce'), __('Product successfully added to your cart.', 'woocommerce') );
	 
	endif;
	 
	return $message;
 }
 /* Custom Add To Cart Messages */