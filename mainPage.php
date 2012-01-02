<?php

/*

Template Name: Main Page

*/

?>



<?php get_header();?>

<?php $templateUri = get_template_directory_uri(); ?>





<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->



	<section id="contentPosts" class="fullSize" ><!-- content posts -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID();?>" <?php post_class('post hentry hreview');?>><!-- START OF POST -->

          

   <div class="postContent entry-content">

     <?php the_content(); ?>

     

     

     

     </div>

                </article><!-- END OF POST -->

<?php endwhile; endif;?>



	</section><!-- end content posts -->

     

 <div class="clear"></div>

</section><!-- END MAIN CONTENT WRAPPER -->

<div id="blogNav">

<?php /* posts_nav_link( ' ', '<img src="' . get_stylesheet_directory_uri() . '/images/prev.jpg" />', '<img src="' . get_stylesheet_directory_uri() . '/images/next.jpg" />' ); */

 wp_link_pages(); ?>

</div>



<?php get_footer();?>