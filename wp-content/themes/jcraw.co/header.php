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

[endif]-->

<!-- JS HERE-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory') ?>/js/respond.min.js"></script>

<!--END JS-->

<!-- STYLE-->

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

<!-- END STYLE-->

<?php wp_head(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body <?php body_class(); ?>>
<?php  if ( is_front_page() ) { ?>
<a id="nav-toggle"><span></span></a>
<div class="menu" style="display: none;">
  <div id="centerNav">
    <ul id="home-nav">
      <li><a href="/category/featured-work/">see the portfolio</a></li>
    </ul>
  </div>
  <?php } elseif ( is_category( 'featured-work') ) { ?>
  <a id="nav-toggle"><span></span></a>
<div class="menu" style="display: none;">
  <div id="centerNav">
    <ul id="home-nav">
    	<li><a href="/">take me home</a></li>
    </ul>
  </div> 
  <?php } else { ?>
 <a id="nav-toggle"><span></span></a>
<div class="menu" style="display: none;">
  <div id="centerNav">
    <ul id="home-nav">
    	<li><a href="/">take me home</a></li>
      	<li><a href="/category/featured-work/">see the portfolio</a></li>
    </ul>
  </div> 
  
  <?php } ?>
 
 
 
 
 <?php assert( "locate_template( array('template_contact.php'), true, false )" ); ?>
  
</div>
