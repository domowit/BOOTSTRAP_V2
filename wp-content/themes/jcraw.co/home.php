<?php
/**
Template Name: Home
 */

get_header(); ?>
<!--<script>
var windw = this;

$.fn.followTo = function ( pos ) {
    var $this = this,
        $window = $(windw);
    
    $window.scroll(function(e){
        if ($window.scrollTop() > pos) {
            $this.css({
                position: 'absolute',
                top: pos
            });
        } else {
            $this.css({
                position: 'fixed',
                top: 0
            });
        }
    });
};

$('#f').followTo(250);

</script>-->
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>
<?php $the_query = new WP_Query( $args ); ?>
<?php while ( have_posts() ) : the_post(); ?>

<!-- Edge Added Here -->
<?php assert( "locate_template( array('template_home.php'), true, false )" ); ?>
<!-- Close Edge -->



<div class="container row introduction" >


		<article class="col span_12"> 
				<!-- <h1><?php the_field('introduction');?> </h1> -->
				<h3>
						<?php the_field('tell_me_more');?>
				</h3>
		</article>
</div>
<?php echo do_shortcode('[ess_grid alias="portfolio_home"]');?>
<div class="row interests" >
		<div class="container">
		<article class="col span_12">
				<h1>
						<?php the_field('other_points_of_interest');?>
				</h1>
				</div>
		</article>
</div>
<?php endwhile; // end of the loop. ?>
<?php wp_reset_postdata(); ?>
<script>
var windw = this;

$.fn.followTo = function ( pos ) {
    var $this = this,
        $window = $(windw);
    
    $window.scroll(function(e){
        if ($window.scrollTop() > pos) {
            $this.css({
                position: 'absolute',
                top: pos
            });
        } else {
            $this.css({
                position: 'fixed',
                top: 0
            });
        }
    });
};

$('#f').followTo(1000);

</script> 
<?php get_footer(); ?>
