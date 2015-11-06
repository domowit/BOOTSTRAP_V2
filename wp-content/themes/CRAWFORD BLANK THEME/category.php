<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>

<main role="main" class="row gutters">
		<article class="col span_12">
				<?php $the_query = new WP_Query( $args ); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<a href="<?php the_permalink (); ?>">
							<?php the_title(); ?>
						</a>
					<?php endwhile; // end of the loop. ?>
				<?php wp_reset_postdata(); ?>
				<?php if(function_exists('wp_paginate')) {
				    wp_paginate();
				} ?>  
		</article>
		<aside role="complimentary" class="col span_4"> 
			Sidebar 
		</aside>
</main>
<?php get_footer(); ?>

