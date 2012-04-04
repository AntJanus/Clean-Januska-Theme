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
	<section id="slider">
<div id="innerSlide">
<?php 
  $custom_fields = get_post_custom();
  $my_custom_field = $custom_fields['slide'];
  foreach ( $my_custom_field as $key => $value ){
	echo "<article>";
    echo $value;
	echo "</article>";
  }
?> 
</div>
<div id="sNav">
<ul id="sNavList">
</ul>
</div>
</section>
     <?php the_content(); ?>

     

     

     

     </div>

                </article><!-- END OF POST -->

<?php endwhile; endif;?>



	</section><!-- end content posts -->

     

 <div class="clear"></div>

</section><!-- END MAIN CONTENT WRAPPER -->




<?php get_footer();?>