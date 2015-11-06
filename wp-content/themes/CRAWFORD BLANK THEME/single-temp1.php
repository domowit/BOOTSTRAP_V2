<?php
/**
Template Name Posts: [Template1]
 */
?>
<div class="template1">


<div class="main">
	<a href="<?php the_permalink ();?>">
		<?php $image = wp_get_attachment_image_src(get_field('image_1'), 'Main Thumb'); ?>
		<img src="<?php echo $image[0]; ?>" alt="<?php get_the_title(get_field('image_1')) ?>" />
                    </a>
</div> 

<a href="<?php the_permalink ();?>"><h2><?php the_field ('group_name');?></h2></a>
<a href="<?php the_permalink ();?>"><h2><?php the_field ('album_name');?></h2></a>
<div class="released">Released <?php the_field ('release_date');?></div>

<a href="<?php the_permalink ();?>"><div class="button">full details</div></a>
<a href="/category/catalog"><div class="buttonDL">Buy Now</div></a>

<div class="thumb left">

		<a href="<?php the_permalink ();?>">
		<?php $image = wp_get_attachment_image_src(get_field('image_2'), 'thumbnail'); ?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php get_the_title(get_field('image_2')) ?>" />
                                        </a>
                                        </div>
                                        <div class="thumb right"> 
                                        <a href="<?php the_permalink ();?>"> 
                                        <?php $image = wp_get_attachment_image_src(get_field('image_3'), 'thumbnail'); ?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php get_the_title(get_field('image_3')) ?>" />
                                        </a> 
                                        </div> 
		

</div>
  <hr/> 

