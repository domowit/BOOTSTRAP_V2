<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>

<main role="main" class="row gutters">
		<article class="col span_12">
				
						<?php if ( have_posts() ) : ?>
						<?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?>
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<a href="<?php the_permalink(); ?>">
								<?php the_title( ); ?><?php the_excerpt(); ?>
								</a>
						
						<?php endwhile; ?>
						<?php else : ?>
						<?php _e( 'Nothing Found', 'twentytwelve' ); ?>
						<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?>
						<?php get_search_form(); ?>
						<?php endif; ?>
					
		</article>
		<aside role="complimentary" class="col span_4"> 
			Sidebar 
		</aside>
</main>
<?php get_footer(); ?>
