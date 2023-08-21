<?php get_header();?>
<div id="primary" class="content-area">
    <div class="container clearfix">
        <div class="title-block">
            <!-- Search Article -->
            <div class="title-inner">
                <div class="row">
                    <div class="col-sm-9">
                        <h1>Search For : <?php echo get_search_query(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Article -->
        <!-- Start loop -->
            <?php if (have_posts()) : ?>            
                
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header"></header>
                        <div class="entry-summary">
                            <a href="<?php echo get_permalink(); ?>" class="readmore-list-link"><?php echo get_the_title(); ?></a>
                            <a href="<?php echo get_permalink(); ?>" class="readmore-link">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
                <nav class="navigation pagination" role="navigation" aria-label="Posts">
                    <div class="nav-links">
                        <?php
                           
                            global $wp_query;
                    
                            $big = 999999999; // need an unlikely integer
                            
                            echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages,
                                'next_text' => '>',
                                'prev_text' => '<',
                            ) );
                             wp_reset_query();
                        ?>
                    </div>               
                </nav>
                <?php else: ?>    
                    <p align="center">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
            <?php endif; ?>
        <!-- End Start loop -->
    </div>
</div>
<?php get_footer(); ?>