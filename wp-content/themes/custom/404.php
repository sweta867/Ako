<?php 
get_header();
$right_arrow = get_field('right_arrow','option');
$page_title = get_field('404_page_title','option');
$page_image = get_field('404_page_image','option');
$page_description = get_field('404_page_description','option');
?>
<main>

    <section class="text-center mt-5 mb-5">
        <div class="container">
            <img src="<?php echo $page_image;?>" class="img-fluid" alt="">
            <h3 class="mt-5"><?php echo $page_title;?></h3>
            <p><?php echo $page_description;?></p>
            <a href="<?php echo site_url();?>" class="btn mt-4 mb-5">
            	<span class="btn-img"><img src="<?php echo $right_arrow;?>" alt=""></span>
            	<span class="btn-txt"><?php _e('GO TO HOMEPAGE');?></span>
            </a>
        </div>
    </section>

</main>

<?php get_footer();?>