<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>




				<?php $the_query = new WP_Query( $args ); ?>
					<?php while ( have_posts() ) : the_post(); ?>				
					
<div class="headerPost" style="background: url('<?php the_field('header_image') ?>') no-repeat center center fixed; -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
  
  <a class="jumper pageJump" href="#godown"><div class="container"><h1><?php the_title(); ?></h1></div></a>

</div>
<div id="godown"></div>	
<div class="container row gallery">
		
	
				
				<h3 style="bottom:0">
						<?php the_title(); ?> | <?php the_field ('role'); ?>
				</h3>
				<h3 style="margin-bottom:35px">
						 
				</h3>
				<div class="overview col span_6">
				<?php $values = get_field('overview');
				  if($values) {
				    echo '<strong>OVERVIEW</strong>' . $values .'<br/><br/>';
				  } else {
				  }
				  ?>
				</div>
				<div class="process col span_6">
				<? $values = get_field('process');
				  if($values) {
				    echo '<strong>PROCESS</strong>' . $values ;
				  } else {
				  }
				  ?>
				</div>
				<!--<div class="gutters col span_4">
				<? $values = get_field('finally');
				  if($values) {
				    echo '<strong>FINALLY</strong><br/>' . $values ;
				  } else {
				  }
				  ?>
				</div>-->
	
	</div>
	<div class="gallery">
	
	<?php if( have_rows('flex_gallery') ):

     // loop through the rows of data
    while ( have_rows('flex_gallery') ) : the_row(); ?>

       <?php if( get_row_layout() == 'one' ): ?>

        	<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
		<img src="<?php echo $image[0]; ?>" alt="<?php get_the_title(get_sub_field('image')) ?>" /> 

        <?php elseif( get_row_layout() == 'one_with_text' ): ?>
		<div class="quote">
		<div class="clear"></div>
        	 <?php the_sub_field('text'); ?>
		</div>
	<?php elseif( get_row_layout() == 'two' ): ?>
		<div class="galleryGrid">
			<div class="col span_6">
			 	<?php $image = wp_get_attachment_image_src(get_sub_field('image_1'), 'large'); ?>
				<img src="<?php echo $image[0]; ?>" alt="<?php get_the_title(get_sub_field('image')) ?>" />
			</div> 
			<div class="col span_6">
			 	<?php $image = wp_get_attachment_image_src(get_sub_field('image_2'), 'large'); ?>
				<img src="<?php echo $image[0]; ?>" alt="<?php get_the_title(get_sub_field('image')) ?>" />
			</div>
		</div> 
	<?php elseif( get_row_layout() == 'two_with_text' ): ?>

        	 get_sub_field('image');
		 get_sub_field('text');	 

        <?php endif;

    endwhile;

else :

    // no layouts found

endif;

?>
<div class="clear"></div>
	
	
	
	
	
	<?php if(get_field('images')): ?>
	<?php while(the_repeater_field('images')): ?>
	<?php $values = get_sub_field('say_something');
		if($values) { ?>
			<div class="clear"></div>
			<div class="container row galleryNote">
				<div class="gutters col span_6 galleryNoteSub">
					<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'large'); ?>
					<img src="<?php echo $image[0]; ?>" alt="<?php  the_sub_field('image');?>" rel="<?php echo $thumb[0]; ?>" />
				</div>
				<div class="gutters col span_6 galleryNoteSub">
					<?php the_sub_field('say_something');?>
				</div>
			</div>
		<?php } else { ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php  the_sub_field('image');?>" rel="<?php echo $thumb[0]; ?>" />
		<?php  } ?>
	
			
			
	<?php endwhile; ?>                                                                                                   
<?php endif; ?>
</div> 
		
		
		
		

		<script type="text/javascript">
		jQuery(window).bind("scroll", function() {
		if (jQuery(this).scrollTop() > 250) {
		jQuery(".navigationPost").fadeIn();
		} else {
		jQuery(".navigationPost").stop().fadeOut();
		}
		});
		</script>
		

		<div class="navigationPost">
			  <?php  next_post_link( '%link', '<div class="nav-previous"><i class="fa fa-chevron-right"></i></div>', TRUE ) ?>
          		<?php previous_post_link( '%link', '<div class="nav-next"><i class="fa fa-chevron-left"></i></div>', TRUE ) ?>
		</div>












					<?php endwhile; // end of the loop. ?>
				<?php wp_reset_postdata(); ?>


<script>
$(".jumper").on("click", function( e ) {
    
    e.preventDefault();

    $("body, html").animate({ 
        scrollTop: $( $(this).attr('href') ).offset().top 
    }, 600);
    
});
</script>				
		
<?php get_footer(); ?>