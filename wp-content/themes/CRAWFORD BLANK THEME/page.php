<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>

<main role="main" class="row gutters">
		<article class="col span_12">
				<?php $the_query = new WP_Query( $args ); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; // end of the loop. ?>
				<?php wp_reset_postdata(); ?>
		</article>
		<aside role="complimentary" class="col span_4"> 
			Sidebar 
		</aside>
</main>
<?php get_footer(); ?>

