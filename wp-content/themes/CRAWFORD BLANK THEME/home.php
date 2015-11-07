<?php
/**
Template Name: Home
 */

get_header(); ?>

<?php // GET QUERIES TO PULL IN OTHER PAGES ?>
<?php $the_query = new WP_Query( $args ); ?>
<?php while ( have_posts() ) : the_post(); ?>


<div class="homeIntro">
	<?php echo do_shortcode('[rev_slider home]');?>	
</div>

		
				
						
					



<div class="container row">				
		<article class="col span_12">
			<h1><?php the_field('introduction');?> Introduction</h1>
			<h3><?php the_field('tell-me-more');?> Tell me more</h3>
		</article>
</div>
<?php echo do_shortcode('[ess_grid alias="portfolio_home"]');?>	


<div class="row interests">	
	<div class="container">			
		<article class="col span_12">
<h1>Other Points of Interest</h1>

	</div>
		</article>
</div>



<?php endwhile; // end of the loop. ?>
<?php wp_reset_postdata(); ?>





<?php get_footer(); ?>
