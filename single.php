<?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>

<section id="mainContent"><!-- MAIN CONTENT WRAPPER -->
  
  <section id="contentPosts"><!-- content posts -->
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php 

$columns = get_post_meta($post->ID,'columns', true);

if($columns == "false" || empty($columns)) { $colTrig = "no-col";} else{ $colTrig = "columns";}

$classes = "hentry hnews single ".$colTrig;

?>
    <?php 
	global $loopMeta, $loopMeta2, $loopExcerpt;
	$loopMeta = 1;
	$loopMeta2 = 1;
	$loopExcerpt = 0;
	
	include(locate_template('microLoop.php')); ?>
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
      <?php posts_nav_link( ' &#183 ', 'previous page &raquo;', ' &laquo; next page' ); ?>
    </div>
<?php get_footer();?>
