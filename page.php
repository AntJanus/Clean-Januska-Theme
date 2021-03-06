<?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>

<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->
  
  <section id="contentPosts"><!-- content posts -->
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID();?>" <?php post_class('post hentry hreview');?>><!-- START OF POST -->
      
      <h1 class="entry-title url"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a></h1>
      <span class="meta  vcard unseen">
      <time class="updated" datetime="<?php

$postDate = get_the_date('c');

$postDate2 = get_the_date('d.m.Y');

echo $postDate ?>" pubdate> <?php echo $postDate2; ?></time>
      | <span class="byline fn author">
      <?php the_author();?>
      </span> |
      <?php the_category(''); ?>
      | <span class="source-org copyright">
      <?php bloginfo('name'); ?>
      </span></span></span>
      <div class="postContent entry-content">
        <?php the_content(); ?>
      </div>
    </article>
    <!-- END OF POST -->
    
    <?php endwhile; endif;?>
  </section>
  <!-- end content posts -->
  
  <?php get_sidebar();?>
  <div class="clear"></div>
</section>
<!-- END MAIN CONTENT WRAPPER -->

<?php get_footer();?>
