<?php
/*
Template Name: Main Page
*/
?>

<?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>


<section id="slideshow" class="clear unseen"><!-- SLIDESHOW -->
	<span id="leftArrow"><a href="#"><img src=""></a></span>
     	<div id="slideInner">
              <?php $args = array(
    'numberposts'     => 4,
     'category'        => 85,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish' ); ?>
    <?php $posts_array = get_posts( $args );
    
    
    foreach ( $posts_array as $post ) {
		setup_postdata($post);
    
     ?> 
          	<article id="slide-<?php echo $post->ID;?>" class="slide">
               	<div class="slideLeft">
                    	<h2><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
          			<p><?php echo get_the_excerpt() ?></p>
          		</div>
                    <div class="slideRight">
                    <img src="<?php echo wp_get_attachment_url($post->ID); ?>" />
                    </div>
              </article>
            
     <?php } ?>
          
          </div>
     <span id="rightArrow"><a href="#"><img src=""></a></span>
     <div class="fill clear"></div>
     
   	<div id="slideNavDiv">
    		 <ul id="slideNav">
     	</ul>
     </div>
</section><!-- END OF SLIDESHOW -->

<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->

	<section id="contentPosts" class="fullSize" ><!-- content posts -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article class="post hentry hnews"><!-- START OF POST -->
          
   <div class="postContent entry-content">
     <?php the_content(); ?>
     
     
     
     </div>
                </article><!-- END OF POST -->
<?php endwhile; endif;?>

	</section><!-- end content posts -->
     
 <div class="clear"></div>
</section><!-- END MAIN CONTENT WRAPPER -->
<div id="blogNav">
<?php /* posts_nav_link( ' ', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/prev.jpg" />', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/next.jpg" />' ); */
 wp_link_pages(); ?>
</div>

<?php get_footer();?>