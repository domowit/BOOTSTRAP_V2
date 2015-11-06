 <?php
 /*
 Template Name: 		Full-Width OnePage Section
 * @package:			WordPress
 * @subpackage:			Pops Theme
 * @version:			1.1
 * @since:				1.0
 */

 /* Does this page have a featured image to be used as row background with paralax?! */
 	$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 5600,1000 ), false, '' );
 ?>
 <!-- Page with ID: <?php the_ID(); ?> -->
 
 <?php
	// Get metaboxes values from database
	$hgr_page_bgcolor		=	get_post_meta( get_the_ID(), '_hgr_page_bgcolor', true );
	$hgr_page_top_padding	=	get_post_meta( get_the_ID(), '_hgr_page_top_padding', true );
	$hgr_page_btm_padding	=	get_post_meta( get_the_ID(), '_hgr_page_btm_padding', true );
	$hgr_page_color_scheme	=	get_post_meta( get_the_ID(), '_hgr_page_color_scheme', true );
 ?>
 
 <?php
 	/* If the page has a featured image set, we use the full width template
		and we put the featured image with full width on page gackground, animated with parallax
	*/
	if(!empty($src[0])) :
 ?>
 <div class="row parallax pagesection <?php echo $hgr_page_color_scheme;?>" style="background-image:url(<?php echo $src[0];?>)" id="<?php echo $post->post_name;?>">
  <div class="col-md-12">
    <div style="padding-top:<?php echo ( !empty($hgr_page_top_padding) ? $hgr_page_top_padding.'px' : '0' );?>!important; padding-bottom:<?php echo ( !empty($hgr_page_btm_padding) ? $hgr_page_btm_padding .'px' : '0' );?>!important; <?php echo ( !empty($hgr_page_bgcolor) ? 'background-color:'.$hgr_page_bgcolor.'!important;' : '' );?>">
      <div class="slideContent gu12" data-adaptive-background="1">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
 <?php
 	/* If the page does not have a featured image set, we use the fixed width template
		with no image on background and no paralax
	*/
	else :	
 ?>
 <div class="row pagesection <?php echo $hgr_page_color_scheme;?>" id="<?php echo $post->post_name;?>">
  <div class="col-md-12">
    <div style="margin-left: -15px; margin-right: -15px; padding-top:<?php echo ( !empty($hgr_page_top_padding) ? $hgr_page_top_padding.'px' : '0' );?>!important; padding-bottom:<?php echo ( !empty($hgr_page_btm_padding) ? $hgr_page_btm_padding .'px' : '0' );?>!important; <?php echo ( !empty($hgr_page_bgcolor) ? 'background-color:'.$hgr_page_bgcolor.'!important;' : '' );?>">
      <div class="slideContent gu12">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
 <?php
 	endif;
 ?>
 <!-- / Page with ID: <?php the_ID(); ?> -->