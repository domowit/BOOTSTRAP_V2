<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>
<div class="container row introduction" >
                          <article class="col span_12">
				<?php $the_query = new WP_Query( $args ); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						
                           
                            <?php echo do_shortcode('[ess_grid alias="portfolio_page"]');?>
                            
                         
					<?php endwhile; // end of the loop. ?>
				<?php wp_reset_postdata(); ?>
	 </article>
</div>			
	
<?php get_footer(); ?>

