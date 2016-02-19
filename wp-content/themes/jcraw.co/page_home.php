<?php
/**
Template Name: Home
 */

get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>
<?php $the_query = new WP_Query( $args ); ?>
<?php while ( have_posts() ) : the_post(); ?>

<!-- Edge Added Here -->
<?php assert( "locate_template( array('template_home.php'), true, false )" ); ?>
<!-- Close Edge -->
<div id="aboutdown"></div>
<div class="container row introduction" >
  <article class="col span_12">
   
      <?php the_field('tell_me_more');?>
    
  </article>
</div>
<?php echo do_shortcode('[ess_grid alias="HomePage-031729"]');?>
<div class="row interests" >
  <div class="container">
  <article class="col span_12">  
    
      <?php the_field('other_points_of_interest');?>
    
    </div>
  </article>
</div>
<!--
<div class="row" >
  <div class="container">
  <article class="col span_12">
    <h1>
      about
    </h1>
    I’m Johnathan Crawford. A graphic designer, living in Chicago. I have operated Domowit, which is a multidisciplinary design studio, for the last seven years. It’s focus has been on web development and user experiences, as well as traditional design and art direction. 

By nature, I’m a very curious and tactile person, relentlessly striving for a high level of craftsmanship. This perseverance has given me a broad and unique skill set. My work spans many mediums. From print, web, video, photography, furniture design, creative direction. Jack of all trades, master of some.
    </div>
  </article>
</div>-->
<?php endwhile; // end of the loop. ?>
<?php wp_reset_postdata(); ?>
<script>
var windw = this;

$.fn.followTo = function ( elem ) {
    var $this = this,
        $window = $(windw),
        $bumper = $(elem),
        bumperPos = $bumper.offset().top,
        thisHeight = $this.outerHeight(),
        setPosition = function(){
            if ($window.scrollTop() > (bumperPos - thisHeight)) {
                $this.css({
                    position: 'absolute',
                    top: (bumperPos - thisHeight)
                });
            } else {
                $this.css({
                    position: 'fixed',
                    top: 0
                });
            }
        };
    $window.resize(function()
    {
        bumperPos = pos.offset().top;
        thisHeight = $this.outerHeight();
        setPosition();
    });
    $window.scroll(setPosition);
    setPosition();
};

$('#one').followTo('#two');
</script>
<?php get_footer(); ?>
