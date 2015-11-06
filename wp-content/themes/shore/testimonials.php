 <?php
 /*
 Template Name: Testimonials Page
 */
 ?>
 
 <?php
	// Theme options
	$hgr_options = get_option( 'redux_options' );
	
	// Get metaboxes values from database
	$hgr_page_bgcolor			=	get_post_meta( get_the_ID(), '_hgr_page_bgcolor', true );
	$hgr_page_top_padding		=	get_post_meta( get_the_ID(), '_hgr_page_top_padding', true );
	$hgr_page_btm_padding		=	get_post_meta( get_the_ID(), '_hgr_page_btm_padding', true );
	$hgr_page_color_scheme	=	get_post_meta( get_the_ID(), '_hgr_page_color_scheme', true );
	$hgr_page_height			=	get_post_meta( get_the_ID(), '_hgr_page_height', true );
	
	// Does this page have a featured image to be used as row background with paralax?!
 	$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 5600,1000 ), false, '' );

 	if( !empty($src[0]) ) {
		$parallaxImageUrl =	" background-image:url('".$src[0]."'); ";
		$parallaxClass		=	' parallax ';
		$backgroundColor	=	'';
	} elseif( !empty($hgr_page_bgcolor) ) {
		$parallaxImageUrl =	'';
		$parallaxClass		=	' ';
		$backgroundColor	=	' background-color:'.$hgr_page_bgcolor.'!important; ';
	}
 ?>
 <!-- Testimonials <?php the_ID(); ?> -->

<style>
.testimonial_text{
	margin-bottom:60px;
}
</style>

 <div id="<?php echo $post->post_name;?>" class="pagesection <?php echo $parallaxClass;?> <?php echo $hgr_page_color_scheme;?>"  style=" <?php echo $parallaxImageUrl;?> <?php echo $backgroundColor;?> <?php echo ( !empty($hgr_page_height) ? ' height:'.$hgr_page_height.'px!important; ' : '');?> <?php echo ( !empty($hgr_page_top_padding) ? ' padding-top:'.$hgr_page_top_padding.'px!important;' : '' );?> <?php echo ( !empty($hgr_page_btm_padding) ? ' padding-bottom:'.$hgr_page_btm_padding.'px!important;' : '' );?> ">
<div class="row">
  <div class="col-md-12">
  <div class="container">
    <?php the_content(); ?>
    </div>
  </div>
</div>

<!-- testimonials -->
<div class="row <?php echo $hgr_page_color_scheme;?>"> 
  <div class="container">
  <!-- Carousel
    ================================================== -->
  <div id="testimonialsCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php
			wp_reset_query();
            $args = array( 'post_type' => 'hgr_testimonials', 'posts_per_page' => 20 );
			$loop = new WP_Query( $args );
			$i = 1;
			while ( $loop->have_posts() ) : $loop->the_post();
			
			// Does this page have a featured image to be used as row background with paralax?!
 			$testimonialImage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()));
			
			$hgr_testi_author	=	get_post_meta( get_the_ID(), '_hgr_testi_author', true );
			$hgr_testi_position	=	get_post_meta( get_the_ID(), '_hgr_testi_role', true );
			
			if($i == 1) {$isActive = ' active ';} else {$isActive = '';}
			$i++; ?>
				<div class="item <?php echo $isActive;?>"> 
                    <div class="container">
                      <div class="testimonial_text"><?php echo the_content();?></div>
                      <div class="testimonialAuthor">
                      	<div class="testimonial_image" style="background-image:url('<?php echo (!empty($testimonialImage[0]) ? $testimonialImage[0] : get_template_directory_uri().'/highgrade/images/testimonials-avatar.jpg');?>');"></div>
                        <div class="testimonial_title"><span style="color:<?php echo $hgr_options['theme_dominant_color'];?>;"><?php echo $hgr_testi_author;?></span><br><?php echo $hgr_testi_position;?></div>
                      </div>                   
                   </div>
             	</div>
        <?php endwhile; ?> 
        </div>
    <!--<a class="left carousel-control" href="#testimonialsCarousel" data-slide="prev"><span class="quote-left"></span></a> <a class="right carousel-control" href="#testimonialsCarousel" data-slide="next"><span class="quote-right"></span></a>-->
    
    <div class="row" style="display: block; height: 30px;">
     <!-- Indicators -->
      <ol class="carousel-indicators">
      <?php
			$i = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
			if($i == 0) {$isActive = ' active ';} else {$isActive = '';}
				echo '<li data-target="#testimonialsCarousel" data-slide-to="'.$i.'" class="'.$isActive.'"></li>';
				$i++;
		  	endwhile;
	 	?> 
        <?php wp_reset_query();?>
      </ol>
  </div>
  
   </div>
  <!-- /.carousel --> 
  </div>
</div>
<!--/ testimonials --> 
</div>
<!--/ Testimonials <?php the_ID(); ?> --> 