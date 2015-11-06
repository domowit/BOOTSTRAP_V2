<?php
/*
Template Name: Portfolio Page
*/
?>
<!-- Portfolio <?php the_ID(); ?> -->

<?php
	// Get metaboxes values from database
	$hgr_page_bgcolor			=	get_post_meta( get_the_ID(), '_hgr_page_bgcolor', true );
	$hgr_page_top_padding		=	get_post_meta( get_the_ID(), '_hgr_page_top_padding', true );
	$hgr_page_btm_padding		=	get_post_meta( get_the_ID(), '_hgr_page_btm_padding', true );
	$hgr_page_color_scheme	=	get_post_meta( get_the_ID(), '_hgr_page_color_scheme', true );
 ?>
<?php $hgr_options = get_option( 'redux_options' ); ?>

<div class="row <?php echo $hgr_page_color_scheme;?>" id="<?php echo $post->post_name;?>" style="padding-top:<?php echo ( !empty($hgr_page_top_padding) ? $hgr_page_top_padding.'px' : '0' );?>!important; padding-bottom:<?php echo ( !empty($hgr_page_btm_padding) ? $hgr_page_btm_padding .'px' : '0' );?>!important; <?php echo ( !empty($hgr_page_bgcolor) ? 'background-color:'.$hgr_page_bgcolor.'!important;' : '' );?>">
  <div class="container">
    <div class="col-md-12">
      <?php the_content(); ?>
    </div>
  </div>
  
  <!-- portfolio item viewer -->
  <div id="item-container" class="animated hidden"></div>
  <!-- portfolio item viewer -->
  
  <?php
 // Get portfolio taxonomies
 $args = array(
    'orderby'       => 'name', 
    'order'         => 'ASC',
    'hide_empty'    => true, 
    'exclude'       => array(), 
    'exclude_tree'  => array(), 
    'include'       => array(),
    'number'        => '', 
    'fields'        => 'all', 
    'slug'          => '', 
    'parent'         => '',
    'hierarchical'  => false, 
    'child_of'      => 0, 
    'get'           => '', 
    'name__like'    => '',
    'pad_counts'    => false, 
    'offset'        => '', 
    'search'        => '', 
    'cache_domain'  => 'core'
 ); 
 $portfolio_categories = get_terms( 'portfolio-category', $args );
 $count_portfolio_categs = count($portfolio_categories);
 ?>
  <?php if ( $count_portfolio_categs > 0 ): ?>
  <div class="row" id="portfolio-pills">
    <div class="container">
      <ul id="filters" class="nav nav-pills">
        <li class="active"><a href="#filter" data-filter="*">Show all</a></li>
        <?php foreach ( $portfolio_categories as $term ) : ?>
        <li><a href="#filter" data-filter=".<?php echo $term->slug;?>"><?php echo $term->name;?></a></li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
  <?php endif;?>
  
  <!--portfolio items -->
  <div class="row" id="portfolio-items">
    <?php
			$posts_per_page = $hgr_options['portfolio-items-select'];
			$args = array( 'post_type' => 'hgr_portfolio', 'posts_per_page' => $posts_per_page, 'orderby' => $hgr_options['portfolio-order-by'], 'order' => $hgr_options['portfolio-order']);
			$loop = new WP_Query( $args );
						
			while ( $loop->have_posts() ) : $loop->the_post();
				
				$postTerms = get_the_terms( get_the_ID(), 'portfolio-category' );
				$item_terms ='';
				$item_terms_array = array();
				if($postTerms) {
					foreach ( $postTerms as $term ) {
						$item_terms_array[] = $term->slug;
					}
					$item_terms = join( " ", $item_terms_array );
				}
				
				$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 5600,1000 ), false, '' );
				echo '<div class="portfolio-item '.$item_terms.' ">';
				echo '<div class="portfolio_item_hover">';
					echo '<img src="'.$src[0].'" class="grow "/>';
					echo '<div class="hover-info animated hidden" data-id="'.get_the_ID().'"><h3>';
						the_title();
					echo '</h3><p>'.get_the_excerpt().'</p>';
					echo '</div>';
				echo '</div>';
				echo '</div>';
			endwhile;
		?>
  </div>
  <!--/ portfolio items --> 
  <!--/ Section <?php the_ID(); ?> --> 
</div>