<?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>

<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->
  
  <section id="contentPosts"><!-- content posts -->
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID();?>" <?php post_class('post hentry hnews');?>><!-- START OF POST -->
      
      <h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="url">
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
        <?php the_content(); ?>
        <p class="postmetadata">Posted in
          <?php the_category(', '); ?>
          |
          <?php the_tags(); ?>
        </p>
      </div>
    </article>
    <!-- END OF POST -->
    
    <?php endwhile; endif;?>
    <div id="blogNav">
      <?php posts_nav_link( ' ', '&raquo;', '&laquo;' ); ?>
    </div>
  </section>
  <!-- end content posts -->
  
  <?php get_sidebar();?>
  <div class="clear">&nbsp;</div>
</section>
<!-- END MAIN CONTENT WRAPPER -->

<?php get_footer();?>
