<?php
/**
 * Shore Theme: Blog page, single post display
 * @package WordPress
 * @subpackage Shore Theme
 * @since 1.0
 */
 ?>
<?php 
	get_header();
 ?>
<?php
	$hgr_options = get_option( 'redux_options' );
 ?>

<!-- single.php -->
<div class="row blog blogPosts <?php echo (isset($hgr_options['blog_color_scheme']) ? $hgr_options['blog_color_scheme'] : '');?>" id="blogPosts">
  <div class="container"> 
    <!-- posts -->
    <div class="col-md-9">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div <?php post_class('post'); ?>>
        <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                      the_post_thumbnail('full', array('class' => 'img-rounded img-responsive'));
                    } 
                ?>
        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h1>
        <small><span class="highlight"><i class="icon blog-date"></i>
        <?php the_time('F jS, Y') ?>
        </span> <span class="highlight"><i class="icon blog-user"></i>Posted by
        <?php the_author_posts_link() ?>
        </span> <span class="highlight"><i class="icon blog-category"></i>
        <?php the_category(', '); ?>
        </span> <span class="highlight"><i class="icon blog-comments"></i>
        <?php comments_number('No Comment yet','1 comment','% comments'); ?>
        </span></small> 
        <!-- Display the Post's content in a div box. -->
        <div class="entry">
          <?php the_content(); ?>
        </div>
        <?php // Paginated post
						$args = array(
							'before'           => '<ul class="pagination">',
							'after'            => '</ul>',
							'link_before'      => '',
							'link_after'       => '',
							'next_or_number'   => 'number',
							'separator'        => ' ',
							'nextpagelink'     => __( 'Next page','hgr_lang' ),
							'previouspagelink' => __( 'Previous page','hgr_lang' ),
							'pagelink'         => '%',
							'echo'             => 1
						);
						//hgr_pagination( $args );
						wp_link_pages( $args );
					 ?>
        <div class="clear"></div>
        <small>
        <?php the_tags('Tags: <span class="highlight">', ', ', '</span>'); ?>
        </small> 
        <!-- Display a comma separated list of the Post's Categories. --> 
        
      </div>
      <!-- closes the first div box --> 
      
      <!-- comments-->
      <?php if(is_paged()) : ?>
      <?php paginate_comments_links(); ?>
      <?php endif;?>
      <?php comments_template(); ?>
      <?php if(is_paged()) : ?>
      <?php paginate_comments_links(); ?>
      <?php endif;?>
      <?php endwhile; else: ?>
      <p>
        <?php _e('Sorry, no posts matched your criteria.', 'hgr_lang'); ?>
      </p>
      <?php endif; ?>
    </div>
    <!-- / posts --> 
    
    <!-- sidebar -->
    <div class="col-md-3">
      <?php 
		get_sidebar();
	 ?>
    </div>
    <!-- / sidebar --> 
  </div>
</div>
<?php 
 	get_footer();
 ?>