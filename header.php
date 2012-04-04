<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats please -->
<title>
<?php wp_title(); ?>
</title>
<?php wp_head(); ?>
<!-- BELOW IS A SAMPLE DUBLIN CORE META DATA HEADER -->
<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/">
<meta name="DC.title" content="<?php wp_title(''); ?>">
<meta name="DC.description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>">
<meta name="viewport" content="width=device-width" />
<meta name="DC.language" scheme="ISO639-1" content="en">
<meta name="DC.publisher" content="<?php bloginfo('name');?>">
<!-- END DUBLIN CORE -->
<meta name="title" content="<?php wp_title(''); ?>" />
<!-- FAVICON -->
<link rel="shortcut icon" href="favicon.ico" />
<link href="http://fonts.googleapis.com/css?family=Poly" rel="stylesheet" type="text/css">
<meta name="readability-verification" content="nbLkAUkYEnQWqhp75Ds5gpZT4wuTDt2NcGhLTXrJ"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Ubuntu:400,700,400italic' rel='stylesheet' type='text/css'>
<?php $templateUri = get_template_directory_uri(); ?>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="<?php echo $templateUri;?>/jquerycycle.js"></script>
<script>
	$(document).ready(function(){ 
		$(document).ready( function() {
$('#slideInner').cycle({ 
    fx:     'fade', 
    speed: 1500,
timeout: 6000,
    pager:  '#nav', 
    // callback fn that creates a thumbnail to use as pager anchor 
    pagerAnchorBuilder: function(idx, slide) { 
        return '<li><a href="#">&bull;</a></li>'; 
    } 
  
});

});
	
	
	});
	</script>
<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script>
jQuery(document).ready(function(){
jQuery('#innerSlide').cycle({ 
    fx:     'scrollRight', 
    speed: 2000,
    timeout: 3000,
    pager:  '#sNavList', 
        pagerAnchorBuilder: function(idx, slide) { 
        // return selector string for existing anchor 
        return '<li><a href="#"><img src="' + jQuery(" img", slide).attr("src") +'" alt="" height="72px" /></a></li>';
    }  
});

});
</script>
</head>

<body <?php body_class();?>>
<header><!-- header -->
  <div id="innerHeader"><!-- inner header -->
    <hgroup>
      <h1><a href="<?php echo home_url();?>">
        <?php bloginfo('name'); ?>
        </a></h1>
      <h2 class="headTag unseen"><a href="#">developer</a> &bull; <a href="#">writer</a> &bull; <a href="#">designer</a></h2>
    </hgroup>
    <nav>
      <?php wp_nav_menu( array('menu' => 'main', 'depth' => 3 )); ?>
      <div class="clearfix"></div>
    </nav>
    <div class="clearfix"></div>
  </div>
  <!-- end inner header --> 
</header>
<!-- end header -->