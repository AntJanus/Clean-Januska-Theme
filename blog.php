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
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=5'.'&paged='.$paged);
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
        <?php the_excerpt(); ?>
      </div>
    </article>
    <!-- END OF POST -->
    
    <?php endwhile; ?>
    <?php $wp_query = null; $wp_query = $temp;?>

  </section>
  <!-- end content posts -->
  
  <?php get_sidebar();?>
  <div class="clear"></div>
</section>
<!-- END MAIN CONTENT WRAPPER -->

<div id="blogNav">
  <?php posts_nav_link( ' ', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/prev.jpg" />', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/next.jpg" />' ); ?>
</div>
<?php get_footer();?>
