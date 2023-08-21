<?php 
get_header();
$id = get_the_ID();
$image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'single-post-thumbnail'); 
$right_arrow = get_field('right_arrow','option');
?>

<section class="breadcrumbs">
  <div class="container">  
      <ul>
        <li><a href="<?php echo home_url(); ?>">Home</a> / <?php the_title();?></li>
      </ul>
  </div>
</section>

<section class="section pb-0">
  <div class="container">
    <div class="row mt-md-5 mb-md-5 blog-page">
        <?php if (have_posts()) : ?>  
              <?php while (have_posts()) : the_post(); 
                        $news_img = get_post_thumbnail_id(get_the_id());
                        $news_feature_img = wp_get_attachment_image_src($news_img, 'full');
                        ?>
                        
                     <div class="col-md-9 mb-4 blog-list">
                            <img class="w-100 radious-10" src="<?php echo $news_feature_img['0'];?>" alt="<?php the_title(); ?>" >
                      <div class="col-md-9">
                          <h3><?php the_title(); ?></h3> 
                      </div>
                    <?php the_content(); ?> 
                    </div>
                    <?php endwhile; ?> 
         <?php else: ?>  
            <div class="error"><?php _e('Not found.'); ?></div> 
          <?php endif; ?>
          <div class="col-md-3 mt_18">
             <div class="category_section mb-5">
                 <h5 class="title mb-3">Categories</h5>
                 <div class="category_list">
                    <?php
                       $args = array(
                                   'taxonomy' => 'category',
                                   'orderby' => 'name',
                                   'order'   => 'ASC'
                               );
                       $cats = get_categories($args);
                       
                       foreach($cats as $cat) {
                        ?>
                          <div class="category_name">
                            <a href="<?php echo get_category_link( $cat->term_id)?>">
                                 <?php echo $cat->name; ?>
                            </a>
                          </div>
                      <?php } ?>
                 </div>
             </div>

             
             
              <?php $post_tags = get_terms(array(
                                'taxonomy' => 'post_tag',
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'number'  => 10,
                ));
                if(!empty($post_tags)):?>
                  <div class="tag_section mb-5">
                     <h5 class="title mb-3">Tags</h5>
                        <div class="tag_list">
                          <?php
                            foreach($post_tags as $post_tag):?>
                              <div class="tag_name">
                                  <a href="<?php echo get_tag_link($post_tag->term_id);?>">
                                    <?php echo $post_tag->name; ?></a>
                              </div>
                          <?php endforeach; ?>
                        </div>
                  </div>
             <?php endif;?>

             <div class="new_section">
                <h5 class="title mb-3"><?php echo 'Related News' ?></h5>
                <div class="related_news_list">
                    <?php
                      $args = array(
                          'numberposts' => 2,
                          'post_type' => 'post',
                          'exclude'=>$id,
                      );
                      $news = get_posts($args);
                      foreach ($news as $news) {
                          $id = $news->ID;
                          $title = $news->post_title;
                          $content = $news->post_content;
                          $image = wp_get_attachment_image_src(get_post_thumbnail_id($news->ID), 'single-post-thumbnail');
                          ?>
                          <div class="news_list mb-4">
                             <a href="<?php echo get_permalink($id);?>"> <img src="<?php echo $image[0];?>" alt="" class="img-fluid mb-4"></a>
                              <a href="<?php echo get_permalink($id);?>"><p class="mb-3 redcolor"><strong><?php echo $title; ?></strong></p></a>
                              <p class="mb-3">
                                <?php echo customExcerpt( $content, 17, ' ...' ); ?>
                              </p>
                              <a href="<?php echo get_permalink($id);?>" class="btn btnsmall">
                                                                   
                                  <span class="btn-img"><img src="<?php echo $right_arrow; ?>" alt=""></span>
                            <span class="btn-txt"><?php _e('READ MORE'); ?></span> 
                                  
                              </a>
                          </div>
                      <?php } ?>
                </div>
             </div>
          </div>
  </div>
  </div>
</section>
<?php get_footer();?>