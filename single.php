<?php get_header();?>
<?php $templateUri = get_template_directory_uri(); ?>


<section id="slideshow unseen" class="clear unseen"><!-- SLIDESHOW -->
	<span id="leftArrow"><a href="#"><img src=""></a></span>
     	<div id="slideInner">
              <?php $args = array(
    'numberposts'     => 4,
     'category'        => 'mainSlide',
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

	<section id="contentPosts"><!-- content posts -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
$columns = get_post_meta($post->ID,'columns', true);
if($columns == "false" || empty($columns)) { $colTrig = "no-col";} else{ $colTrig = "columns";}
$classes = "hentry hnews".$colTrig;
?>
                <article id="post-<?php the_ID();?>" <?php post_class($classes);?> ><!-- START OF POST -->
          
<h1 class="entry-title url"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<span class="meta  vcard"><time class="updated" datetime="<?php
$postDate = get_the_date('c');
$postDate2 = get_the_date('d.m.Y');
echo $postDate ?>" pubdate>
<?php echo $postDate2; ?></time> | <span class="byline fn author"><?php the_author();?></span> | <?php the_category(', '); ?></span></span> 
   <div class="rdbWrapper" data-show-read="1" data-show-send-to-kindle="1" data-show-print="1" data-show-email="1" data-orientation="0" data-version="1" data-bg-color="transparent"></div><script type="text/javascript">(function() {var s = document.getElementsByTagName("script")[0],rdb = document.createElement("script"); rdb.type = "text/javascript"; rdb.async = true; rdb.src = document.location.protocol + "//www.readability.com/embed.js"; s.parentNode.insertBefore(rdb, s); })();</script>
 <div class="postContent entry-content">
     <?php the_content(); ?>
     
     

     <p class="postmetadata">Posted in <?php the_category(', '); ?> <br /><?php the_tags(); ?> <br /> Source: <span class="vcard"><span class="source-org copyright"><?php bloginfo('name'); ?></span></span></p>
     
     </div>
                </article><!-- END OF POST -->
<?php endwhile; endif;?>
<div style="clear:both; height: 1px"></div>
<aside id="comments" >
<?php comments_template(); ?> 
<div class="clearfix"></div>
</aside>
	</section><!-- end content posts -->
     
     <aside id="sidebar"><!-- START SIDEBAR -->
     
     
     	<article id="topAside">
     		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('topSide') ) : else : ?>
			<?php endif; ?>
		</article>
          
          
		<article id="bottomAside">
			<div id="bottomLeftAside">
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('main') ) : else : ?>

				<?php endif; ?>
			</div>
			<div id="bottomRightAside">
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('rightSide') ) : else : ?>

				<?php endif; ?>
			</div>
         </article>
     
     </aside><!-- END SIDEBAR -->
<div class="clear"></div>
</section><!-- END MAIN CONTENT WRAPPER -->
<div id="blogNav">
<?php posts_nav_link( ' ', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/prev.jpg" />', '<img src="' . get_bloginfo('stylesheet_directory') . '/images/next.jpg" />' ); ?>
</div>

<?php get_footer();?>