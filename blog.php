<?php

/*

Template Name: Blog


*/

?>
<?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>

<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->
  
  <section id="contentPosts"><!-- content posts -->
    <?php
 wp_reset_postdata();
global $paged;
query_posts( array( 'posts_per_page' => 5, 'paged' => get_query_var('page') ) );
while ($wp_query->have_posts()) : $wp_query->the_post();
?>
    <article id="post-<?php the_ID();?>" <?php post_class('post hentry hreview');?>><!-- START OF POST -->
      
      <h1 class="entry-title url"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a></h1>
      <span class="meta  vcard">
      <time class="updated" datetime="<?php

$postDate = get_the_date('c');

$postDate2 = get_the_date('d.m.Y');

echo $postDate ?>" pubdate> <?php echo $postDate2; ?></time>
      | <span class="byline fn author">
      <?php the_author_posts_link(); ?>
      </span> | <a href="mailto:<?php the_author_meta('email'); ?>" class="email author">email</a> |
      <?php the_category(', '); ?>
      </span></span>
      <div class="postContent entry-content">
         <?php 	if ( has_post_thumbnail() ) {the_post_thumbnail('thumbnail', array('class' => 'alignleft')); }?>
		 <?php the_excerpt(); ?>
        <div class="clearfix"></div>
      </div>
    </article>
    <!-- END OF POST -->
    
    <?php endwhile; ?>
<div id="blogNav">
      <?php posts_nav_link( ' &#183 ', 'previous page &raquo;', ' &laquo; next page' ); ?>
    </div>
  </section>
  <!-- end content posts -->
  
  <?php get_sidebar();?>
  <div class="clear"></div>
</section>
<!-- END MAIN CONTENT WRAPPER -->
<?php get_footer();?>
