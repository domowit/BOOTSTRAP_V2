<?php
/**
 * Shore Theme header file
 * @package WordPress
 * @subpackage Shore Theme
 * @since 1.0
 * TO BE INCLUDED IN ALL OTHER PAGES
 */
 $hgr_options = get_option( 'redux_options' );
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
<?php echo ( !empty($hgr_options['retina_favicon']['url']) ? '<link href="'.$hgr_options['retina_favicon']['url'].'" rel="icon">'."\r\n" : '' ); ?>
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
.bka_menu, .bka_menu .container, .navbar-collapse.in, .navbar-collapse.colapsing {
    background-color: <?php echo $hgr_options['menu-bgcolor'];?>;
}
.dropdown-menu {
    border-top:2px solid <?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.wpcf7 input[type="submit"] {
	background-color: <?php echo $hgr_options['theme_dominant_color'];?>;
}
.topborder h3 a {
    border-top: 1px solid <?php echo $hgr_options['theme_dominant_color'];?>;
}
ul.nav a.active {
    color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
<?php 
	if( !empty($hgr_options['woo_support']) && $hgr_options['woo_support'] == 1 ) :
?>
/* woocommerce */
body.woocommerce{
	background-color: <?php echo $hgr_options['shop_bg_color'];?>;;
}
.woocommerce span.onsale, .woocommerce-page span.onsale {
	background-color: <?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current {
    background: none repeat scroll 0% 0% <?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover {
    background-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
    border: 2px solid <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button {
    background: none repeat scroll 0% 0% <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active {
    border-bottom-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text {
    background-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce p.stars a, .woocommerce-page p.stars a{
	color:<?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.woocommerce #content .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page .quantity .plus:hover {
	background-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3 {
    font-size: <?php echo $hgr_options['shop_h3_font']['font-size'];?>!important;
	line-height: <?php echo $hgr_options['shop_h3_font']['line-height'];?>!important;
	color: <?php echo $hgr_options['shop_h3_font']['color'];?>!important;
}
.woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover {
	background-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info {	
	background-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.woocommerce table.shop_table thead span, .woocommerce-page table.shop_table thead span {
    border-bottom: 1px solid <?php echo $hgr_options['theme_dominant_color'];?>;
}
.proceed_button{
	border: 2px solid <?php echo $hgr_options['theme_dominant_color'];?>!important;
	background-color:<?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.woocommerce .cart-collaterals .shipping-calculator-button{
	color:<?php echo $hgr_options['theme_dominant_color'];?>;
}
.checkout_apply_coupon{
	border: 2px solid <?php echo $hgr_options['theme_dominant_color'];?>;
	background-color: <?php echo $hgr_options['theme_dominant_color'];?>;
}
#place_order {
    border: 2px solid <?php echo $hgr_options['theme_dominant_color'];?> !important;
    background-color: <?php echo $hgr_options['theme_dominant_color'];?> !important;
}
.login_btn_hgr, .hgr_woobutton{
	border: 2px solid <?php echo $hgr_options['theme_dominant_color'];?>;
	background-color: <?php echo $hgr_options['theme_dominant_color'];?>;
}
.thankyoutext{color:<?php echo $hgr_options['theme_dominant_color'];?>;}
#my-account h4.inline{
	border-bottom: 1px solid <?php echo $hgr_options['theme_dominant_color'];?>;
}
#my-account a{
color:<?php echo $hgr_options['theme_dominant_color'];?>;
}
.hgr_woo_minicart .woo_bubble{
	background-color: <?php echo $hgr_options['theme_dominant_color'];?>;
}
/* woocommerce end */
<?php
	endif; // end if woo_support enabled
?>
</style>

 <!-- VC COMBINED STYLES -->
 <?php echo '<style type="text/css" data-type="vc-shortcodes-custom-css">';?>
 <?php echo hgr_get_post_meta_by_key('_wpb_shortcodes_custom_css');?>
 <?php echo '</style>';?>
 <!-- / VC COMBINED STYLES -->

<?php wp_head(); ?>
</head>
<body <?php body_class(''); ?>>
<div class="row bkaTopmenu bka_menu <?php echo ( !is_front_page() ? '' : ( $hgr_options['menu-style'] == 1 ? 'hidden' : '') ); ?>">
  <div class="container">
    <nav class="navbar navbar-default" role="navigation"> 
      <div class="navbar-header">
      
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#hgr-navbar-collapse-1"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="<?php echo home_url();?>"><?php echo (!empty($hgr_options['logo']['url']) 
		? '<img src="'.$hgr_options['logo']['url'].'" width="'.$hgr_options['logo']['width'].'" height="'.$hgr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
		: '<img src="'.get_bloginfo('template_url').'/highgrade/images/logo.png"  alt="Initial Logo" class="logo" />' 
		);?></a></div>
      
      <?php 
            if( !empty($hgr_options['woo_support']) && $hgr_options['woo_support'] == 1 ) :
        ?>
        <!-- woocommerce minicart -->
        <div class="hgr_woo_minicart">
        	<div class="woo_bubble"><a class="hgr_woo_minicart_content" href="<?php global $woocommerce; echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a></div>
        </div>
        <!-- end woocommerce minicart -->
        <?php
        	endif;
        ?>
      
      <div class="collapse navbar-collapse" id="hgr-navbar-collapse-1">
        <?php
				$defaults = array(
					'theme_location'  => 'header-menu',
					'menu'            => 'header-menu',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'nav navbar-nav navbar-right',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'hgr_menu_fallback', // OR 'hgr_bootstrap_navwalker::fallback'
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="mainNavUl" class="%2$s">%3$s</ul>',
					'depth'           => 4,
					'walker'          => new hgr_bootstrap_navwalker()
				);
				wp_nav_menu( $defaults );
		?>
      </div>

    </nav>
    
  </div>
</div>
<!--/ header --> 

<div class="top">
<a href="#" class="back-to-top"><i class="icon fa fa-angle-double-up"></i></a>
</div>