<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
$banner = get_field('banner',894);
$right_arrow = get_field('right_arrow', 'option');
?>
<section class="page-banner">
  <div class="imgwrap"><img src="<?php echo $banner;?>" class="img-fluid" alt=""></div>
  <div class="container">
    <div class="bannertext"><h2><?php echo single_cat_title( '', false );?></h2></div>
  </div>
</section>

<section class="section pb-0">
  <div class="container">

    <div class="row mt-5 mb-md-5 blog-page">

        <?php 
        $page_id = get_queried_object_id();
        
       
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array('cat'  => $page_id, 'posts_per_page' => 6, 'paged' => $paged, 'page' => $paged);
                          
                          
        $query = new WP_Query($args);
        //echo $query->request;
       
         if ($query->have_posts()) :?>  
              <?php  while ($query->have_posts()) : $query->the_post(); 
                        $news_img = get_post_thumbnail_id($query->ID);
                        $news_feature_img = wp_get_attachment_image_src($news_img, 'full');

                        ?>
                        
                         <div class="col-md-4 mb-5">
                            <a href="<?php echo get_permalink($query->ID);?>"><img src="<?php echo $news_feature_img['0']; ?>" alt="<?php echo get_the_title(); ?>" class="img-fluid mb-4"></a>
                           
                           <a href="<?php echo get_permalink($query->ID);?>"> <h5 class="mb-3"><?php echo get_the_title(); ?></h5></a>
                             <p class="mb-3">
                                 <?php echo customExcerpt( get_the_content(), 17, ' ...' ); ?>
                              </p>
                            <a href="<?php echo get_permalink($query->ID);?>" class="btn btnsmall">
                                 <span class="btn-img"><img src="<?php echo $right_arrow; ?>" alt=""></span>
                            <span class="btn-txt"><?php _e('READ MORE'); ?></span> 
                            </a>
                        </div>
                    <?php endwhile; ?> 
                     <div class="row">
                          <div class="col-md-12">
                             <nav aria-label="Page navigation example">
                                 <?php tt_pagination( $query->max_num_pages ) ?>
                              </nav>
                          </div>
                      </div>
         <?php else: ?>  
            <div class="error"><?php _e('Not found.'); ?></div> 
          <?php endif; ?>
           </div>
  </div>
</section>
<?php get_footer();?>