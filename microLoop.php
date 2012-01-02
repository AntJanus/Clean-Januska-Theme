<article id="post-<?php the_ID();?>" <?php post_class($classes);?> ><!-- START OF POST -->
      
      <h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="url">
        <?php the_title(); ?>
        </a></h1>
      <span class="meta vcard <?php if($loopMeta == 0){ echo "unseen"; }?>">
      <time class="updated" datetime="<?php

$postDate = get_the_date('c');

$postDate2 = get_the_date('d.m.Y');

echo $postDate ?>" pubdate> <?php echo $postDate2; ?></time>
      | <span class="byline fn author">
      <?php the_author_posts_link(); ?>
      </span> | <a href="mailto:<?php the_author_meta('email'); ?>" class="email author">email</a> |
      <?php the_category(', '); ?>
      </span><g:plusone size="medium" href="<?php the_permalink();?>"></g:plusone><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink();?>" data-via="antjanus">Tweet</a></span>
      <div class="rdbWrapper" data-show-read="1" data-show-send-to-kindle="1" data-show-print="1" data-show-email="1" data-orientation="0" data-version="1" data-bg-color="transparent"></div>
      <script type="text/javascript">(function() {var s = document.getElementsByTagName("script")[0],rdb = document.createElement("script"); rdb.type = "text/javascript"; rdb.async = true; rdb.src = document.location.protocol + "//www.readability.com/embed.js"; s.parentNode.insertBefore(rdb, s); })();</script>
      <div class="postContent entry-content">
        <?php 
		if($loopExcerpt == 0){
		the_content();
		}
		else{
			if ( has_post_thumbnail() ) {
			 the_post_thumbnail('thumbnail', array('class' => 'alignleft')); 
	  		 
			}
		the_excerpt();
	   	echo '<div class="clearfix"></div>';
		}
		?>
        <p class="postmetadata <?php if($loopMeta2 == 0){ echo "unseen"; }?>">Posted in
          <?php the_category(', '); ?>
          <br />
          <?php the_tags(); ?>
          <br />
          Source: <span class="vcard"><span class="source-org copyright">
          <?php bloginfo('name'); ?>
          </span></span>
</p>
      </div>
    </article>