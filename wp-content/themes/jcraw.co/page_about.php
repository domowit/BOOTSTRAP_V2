<?php
/** Template Name: About */

get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>
<?php $the_query = new WP_Query( $args ); ?>
<?php while ( have_posts() ) : the_post(); ?>



<?php endwhile; // end of the loop. ?>
<?php wp_reset_postdata(); ?>


<?php get_footer(); ?>