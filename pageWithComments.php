<?php

/*

Template Name: Page With Comments


*/

?><?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>

<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->
  
  <section id="contentPosts"><!-- content posts -->
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php 

$columns = get_post_meta($post->ID,'columns', true);

if($columns == "false" || empty($columns)) { $colTrig = "no-col";} else{ $colTrig = "columns";}

$classes = "hentry hnews single ".$colTrig;

?>
    <article id="post-<?php the_ID();?>" <?php post_class($classes);?> ><!-- START OF POST -->
      
      <h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="url">
        <?php the_title(); ?>
        </a></h1>
      <span class="meta  vcard unseen">
      <time class="updated" datetime="<?php

$postDate = get_the_date('c');

$postDate2 = get_the_date('d.m.Y');

echo $postDate ?>" pubdate> <?php echo $postDate2; ?></time>
      | <span class="byline fn author">
      <?php the_author_posts_link(); ?>
      </span> | <a href="mailto:<?php the_author_meta('email'); ?>" class="email author">email</a> |
      <?php the_category(', '); ?>
      </span></span>
      <div class="rdbWrapper" data-show-read="1" data-show-send-to-kindle="1" data-show-print="1" data-show-email="1" data-orientation="0" data-version="1" data-bg-color="transparent"></div>
      <script type="text/javascript">(function() {var s = document.getElementsByTagName("script")[0],rdb = document.createElement("script"); rdb.type = "text/javascript"; rdb.async = true; rdb.src = document.location.protocol + "//www.readability.com/embed.js"; s.parentNode.insertBefore(rdb, s); })();</script>
      <div class="postContent entry-content">
        <?php the_content(); ?>
        <p class="postmetadata unseen">Posted in
          <?php the_category(', '); ?>
          <br />
          <?php the_tags(); ?>
          <br />
          Source: <span class="vcard"><span class="source-org copyright">
          <?php bloginfo('name'); ?>
          </span></span></p>
      </div>
    </article>
    <!-- END OF POST -->
    
    <?php endwhile; endif;?>
    <div style="clear:both; height: 1px"></div>
    <aside id="comments" >
      <?php comments_template(); ?>
      <div class="clearfix"></div>
    </aside>
  </section>
  <!-- end content posts -->
  
  <?php get_sidebar();?>
  <!-- END SIDEBAR -->
  
  <div class="clear"></div>
</section>
<!-- END MAIN CONTENT WRAPPER -->

<div id="blogNav">
  <?php posts_nav_link( ' ', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/prev.jpg" />', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/next.jpg" />' ); ?>
</div>
<?php get_footer();?>
