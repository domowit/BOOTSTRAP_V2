<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>

<main role="main" class="row gutters">
		<article class="col span_12">
				
					
						<?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?>
						<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentytwelve' ); ?>
						<?php get_search_form(); ?>
					
		</article>
		<aside role="complimentary" class="col span_4"> 
			Sidebar 
		</aside>
</main>
<?php get_footer(); ?>

