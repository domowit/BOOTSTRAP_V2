<?php
/**
 * Shore Single view for portfolio
 * @package WordPress
 * @subpackage Shore Theme
 * @since 1.0
 * TO BE INCLUDED IN ALL OTHER PAGES
 */
// Theme options
	$hgr_options = get_option( 'redux_options' );
	
	// Get metaboxes values from database
	$hgr_page_bgcolor			=	get_post_meta( get_the_ID(), '_hgr_page_bgcolor', true );
	$hgr_page_top_padding		=	get_post_meta( get_the_ID(), '_hgr_page_top_padding', true );
	$hgr_page_btm_padding		=	get_post_meta( get_the_ID(), '_hgr_page_btm_padding', true );
	$hgr_page_color_scheme		=	get_post_meta( get_the_ID(), '_hgr_page_color_scheme', true );
	$hgr_page_height			=	get_post_meta( get_the_ID(), '_hgr_page_height', true );
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo ( !empty($hgr_options['retina_favicon']['url']) ? '<link href="'.$hgr_options['retina_favicon']['url'].'" rel="icon">'."\r\n" : '<link href="'.$hgr_options['favicon']['url'].'" rel="icon">'."\r\n" ); ?>
<?php echo ( !empty($hgr_options['iphone_icon']['url']) ? '<link href="'.$hgr_options['iphone_icon']['url'].'" rel="apple-touch-icon">'."\r\n" : ''); ?>
<?php echo ( !empty($hgr_options['retina_iphone_icon']['url']) ? '<link href="'.$hgr_options['retina_iphone_icon']['url'].'" rel="apple-touch-icon" sizes="76x76" />'."\r\n" : ''); ?>
<?php echo ( !empty($hgr_options['ipad_icon']['url']) ? '<link href="'.$hgr_options['ipad_icon']['url'].'" rel="apple-touch-icon" sizes="120x120" />'."\r\n" : ''); ?>
<?php echo ( !empty($hgr_options['ipad_retina_icon']['url']) ? '<link href="'.$hgr_options['ipad_retina_icon']['url'].'" rel="apple-touch-icon" sizes="152x152" />'."\r\n" : ''); ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php if ( !empty($hgr_options['css-code']) ) : ?>
<!-- Custom CSS -->
<style type="text/css">
<?php echo $hgr_options['css-code'];?>
</style>
<?php endif;?>
<style>
.wpb_btn-success, #itemcontainer-controller {
    background-color: <?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.hoveredIcon {
	color:<?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.bka_menu {
    background-color: <?php echo $hgr_options['menu-bgcolor'];?>!important;
}
#itemcontainer-controller {
    background-color: #49D0BE!important;
}
</style>

 <!-- VC COMBINED STYLES -->
 <?php echo '<style type="text/css" data-type="vc-shortcodes-custom-css">';?>
 <?php echo hgr_get_post_meta_by_key('_wpb_shortcodes_custom_css');?>
 <?php echo '</style>';?>
 <!-- / VC COMBINED STYLES -->
<?php wp_head(); ?>
</head>
<body <?php body_class(''); ?>>
 
 <!-- Custom post: portfolio -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="itemcontainer-controller">
		<i class="icon highgrade-grid"></i>
	</div>
	
	<div class="item-viewer">
		
		<div class="container">
		  <?php the_content();?>
		</div>
		<div class="clearfix"></div>
	</div>
<?php endwhile; endif; wp_reset_query(); ?>
<!--/ Custom post: portfolio --> 

  <script type="text/javascript">
	var home_url					=	'<?php echo home_url();?>';
	var template_directory_uri	=	'<?php echo get_template_directory_uri();?>';
	var retina_logo_url			=	'<?php echo( !empty($hgr_options['retina_logo']['url']) ? $hgr_options['retina_logo']['url'] : '' );?>';
	var menu_style				=	'<?php echo( !empty($hgr_options['menu-style']) ? $hgr_options['menu-style'] : '' );?>';
	var is_front_page			=	'<?php echo( is_front_page() ? 'true' : 'false' );?>';
  </script>
  
   <script>
 jQuery(document).ready(function() {
 /* Flexslider customization*/
	jQuery(".flexslider").flexslider({ prevText: "", nextText: "", });
 });
 </script>
 
 <?php if ( !empty($hgr_options['js-code']) ) : ?>
 <!-- Custom JS code -->
 <script>
 <?php echo $hgr_options['js-code'];?>
 </script>
 <?php endif;?>

 <?php if ( !empty($hgr_options['tracking-code']) ) : ?>
 <!-- Custom tracking code -->
 <?php echo $hgr_options['tracking-code'];?>
 <?php endif;?>
	<?php wp_footer();?>
 </body>
</html>