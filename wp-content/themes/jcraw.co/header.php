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


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<body <?php body_class(); ?>>


 
    
    
    

	
        	
<?php // if ( is_front_page() ) { ?>


<a id="nav-toggle"><span></span></a>
<div class="menu" style="display: none;">
  <div id="centerNav">
      <ul id="home-nav">
      <?php // wp_nav_menu( $args ); ?>
        <li>Button1</li>
        <li>Button2</li>
        <li>Button3</li>
      </ul>
	</div>
  <form class="contact_form" action="" method="post" name="contact_form">
    <input type="text" name="name" placeholder="Your Name"  required />
    <input type="text" name="email" placeholder="Your Email" required />
    <input type="text" name="website" placeholder="Your Message" required/>
    <button class="submit" type="submit">Send it</button>
  </form>
</div> 





    <!-- <header class="banner row navHome">
    <div class="container row">				
		<article class="col span_16">
    	<?php wp_nav_menu( $args ); ?>
    	</article>
    </div>	
	</header> -->
<?php // } else { ?>
	<!-- <header class="banner row">
	<div class="container row">				
		<article class="col span_16">
    	<?php wp_nav_menu( $args ); ?>
    	</article>
    </div>	
    </header> 
<?php // } ?>	
