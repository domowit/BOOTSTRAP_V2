<?php
/**
 * Shore Theme footer file
 * @package WordPress
 * @subpackage Shore Theme
 * @since 1.0
 * TO BE INCLUDED IN ALL OTHER PAGES
 */
 ?>
  <?php
 $hgr_options = get_option( 'redux_options' );
 ?>
 
  <?php if ( dynamic_sidebar('Footer') ) : ?>
<?php endif; ?>
 
<?php if ( !empty($hgr_options['footer-copyright']) ) : ?>
<div class="row bka_footer <?php echo $hgr_options['footer_color_scheme'];?>" style="padding:10px; <?php echo( !empty($hgr_options['footer-bgcolor']) ? ' background-color:'.$hgr_options['footer-bgcolor'].';' : '');?>">
    <div class="container">
        <div class="col-md-12" style="text-align:center;">
            <?php echo $hgr_options['footer-copyright'];?>
        </div>
    </div>
</div>
<?php endif; ?>

  <script type="text/javascript">
	var home_url					=	'<?php echo home_url();?>';
	var template_directory_uri	=	'<?php echo get_template_directory_uri();?>';
	var retina_logo_url			=	'<?php echo( !empty($hgr_options['retina_logo']['url']) ? $hgr_options['retina_logo']['url'] : '' );?>';
	var menu_style				=	'<?php echo( !empty($hgr_options['menu-style']) ? $hgr_options['menu-style'] : '' );?>';
	var is_front_page			=	'<?php echo( is_front_page() ? 'true' : 'false' );?>';
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