<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory') ?>/images/favicon.ico">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- JS HERE-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory') ?>/js/respond.min.js"></script>
<!--END JS-->

<!-- STYLE-->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<!-- END STYLE-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


 
    
    
    
<div class="container row">
	<header class="banner row ">
        	
		
		
			<?php wp_nav_menu( $args ); ?>
		
		
	
    </header>
    
<!-- INITIATES HEADESHIVE --><a id="startHeadhesive"></a>   
    


         