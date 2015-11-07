<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>


				<?php $the_query = new WP_Query( $args ); ?>
					<?php while ( have_posts() ) : the_post(); ?>				
<?php
$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
?>					
<div class="headerPost" style="background: url('<?php echo $src[0]; ?>') no-repeat center center fixed; -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
</div>
<div class="container row">				
	<article class="col span_12">
				<h1 style="margin-bottom:15px">
						<?php the_title(); ?>
				</h1>
				<h4 style="margin-bottom:50px">
						<?php the_field ('role'); ?>
				</h4>
				<div class="gutters col span_4">
				<?php $values = get_field('overview');
				  if($values) {
				    echo '<strong>OVERVIEW</strong><br/>' . $values ;
				  } else {
				  }
				  ?>
				</div>
				<div class="gutters col span_4">
				<? $values = get_field('process');
				  if($values) {
				    echo '<strong>PROCESS</strong><br/>' . $values ;
				  } else {
				  }
				  ?>
				</div>
				<div class="gutters col span_4">
				<? $values = get_field('finally');
				  if($values) {
				    echo '<strong>FINALLY</strong><br/>' . $values ;
				  } else {
				  }
				  ?>
				</div>
	</article>
</div>		
		
		<div class="clear"></div>
		

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
				
		
<?php get_footer(); ?>