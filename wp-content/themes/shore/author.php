 <?php
/**
 * Shore Theme: Blog page, posts by author
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

<div class="row blog blogPosts <?php echo (isset($hgr_options['blog_color_scheme']) ? $hgr_options['blog_color_scheme'] : '');?>">
  <div class="container"> 
    <!-- posts -->
    <div class="col-md-9">
      <?php 
		$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	?>
      <h1 class="titleSep">Posts by <?php echo $curauth->nickname; ?></h1>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="post">
        <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                      the_post_thumbnail('full', array('class' => 'img-rounded img-responsive'));
                    } 
                ?>
        <!-- Display the Title as a link to the Post's permalink. -->
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
          <?php if(has_excerpt()) : ?>
          <?php the_excerpt(); ?>
          <?php else : ?>
          <?php the_content(); ?>
          <?php endif;?>
        </div>
        <div class="entry-meta">
          <?php the_tags(); ?>
        </div>
      </div>
      <?php endwhile; ?>
      <?php if(is_paged()) : ?>
      <div class="navigation">
        <div class="alignleft">
          <?php previous_posts_link('&larr; Previous') ?>
        </div>
        <div class="alignright">
          <?php next_posts_link('Next &rarr;','') ?>
        </div>
      </div>
      <?php endif;?>
      <?php else: ?>
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