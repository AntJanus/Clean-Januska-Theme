<?php

if ( ! isset( $content_width ) ) $content_width = 750;

add_theme_support('post-formats',  array( 'aside', 'link', 'status', 'quote', 'image', 'nocolumn' ));
function register_my_menus() {
register_nav_menus(
		array(
		  'main' => 'Main navigation menu',
		  'footerNav' => 'Footer Navigation'
		)
);
}

add_action( 'init', 'register_my_menus' );
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}

/* SIDEBAR */
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'main',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array('name'=>'footerLeft',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array('name'=>'footerMid',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',

));
register_sidebar(array('name'=>'footerRight',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',

));



/* EDITOR CHANGES */
function fb_change_mce_options($initArray) {
	// Comma separated string od extendes tags
	// Command separated string of extended elements
	$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]';
	if ( isset( $initArray['extended_valid_elements'] ) ) {
	$initArray['extended_valid_elements'] .= ',' . $ext;
	} else {
		$initArray['extended_valid_elements'] = $ext;
	}

	// maybe; set tiny paramter verify_html
	//$initArray['verify_html'] = false;
	return $initArray;
}
add_filter('tiny_mce_before_init', 'fb_change_mce_options');


function my_editor_style() {
	global $current_screen;
	switch ($current_screen->post_type) {
		case 'post':
		add_editor_style('editor-style-post.css');
		break;

		case 'page':
		add_editor_style('editor-style-page.css');
		break;

		case 'quote':
		add_editor_style('editor-style-quote.css');
		break;

		case 'image':
		add_editor_style('editor-style-image.css');
		break;
	}
}

add_action( 'admin_head', 'my_editor_style' );




add_filter( 'default_content', 'writingEncouragement' );
function writingEncouragement( $content ) {
			global $post_type;
			if($post_type == "post"){
			$encArray = array( "Welcome! Please write a nice and informative page or post!", 
									"Now I know this will be some great piece you're going to write!",
									"<h1>Don't procrastinate!</h1>",
									"Finally started, huh? Okay then!",
									"Blah blah blah. Why don't you write something good this time?",
									"You were just SO GOOD last time, I hope you measure up now too ;)",
									"Error 404.... Just kidding",
									"If you have an SEO plugin, don't forget to add the meta title and meta description infomration",
									"Thank our <a href=\"http://antjanus.com\">Overlord Ant Janus</a> for this messsage",
									"You are now participating on what is called \"on-site SEO \" where you create useful content, put keywords into the URL and optimize your meta information",
									"This little piece of code can be used to create a wordpress signature or to automatically populate advertisement code"
									);
			$content = $encArray[array_rand($encArray)];
	return $content;
			}
}


function title_text_input( $title ){
    	$title = array( "Enter a GOOD, CREATIVE Title!",
									"404 Post Not Found, I guess you can just rewrite it",
									"Title rich in KEYWORDS goes here",
									"Enter Title",
									"Enter Writing Mode",
									"How To: Write a GOOD post",
									"Top 10 whatever"
									);
			return $title[array_rand($title)];
}
add_filter( 'enter_title_here', 'title_text_input' );



add_filter( 'display_post_states', 'custom_post_state' );
function custom_post_state( $states ) {	
global $post;
$show_custom_state = get_post_meta( $post->ID, '_status' );
if ( $show_custom_state ) $states[] = '' . $show_custom_state[0] . '';
return $states;
}
add_action( 'admin_head', 'status_css' );
function status_css() {
echo '
<style type="text/css">
.default{font-weight:bold;}
.custom{border-top:solid 1px #e5e5e5;}
.custom_state{font-size:9px; color:#666; background:#e5e5e5; padding:3px 6px 3px 6px; -moz-border-radius:3px; border-radius:3px;}
.spelling{background:#4BC8EB;color:#fff;}
.review{background:#CB4BEB;color:#fff;}
.errors{background:#FF0000;color:#fff;}
.source{background:#D7E01F;color:#333;}	
.rejected{background:#000000;color:#fff;}
.final{background:#DE9414;color:#333;}
</style>';
}
if ( current_user_can( 'publish_posts' ) ) {
add_action( 'post_submitbox_misc_actions', 'custom_status_metabox' );	
add_action( 'save_post', 'save_status' );
function custom_status_metabox() {
global $post;
$custom = get_post_custom( $post->ID );
$status = $custom["_status"][0];
$i = 0;
// Available Statuses
$custom_status = array( 'None', 'Spelling', 'Review', 'Errors', 'Source', 'Rejected', 'Final' );

echo '<div class="misc-pub-section custom">Custom status: <select name="ourstatus">';
for ( $i = 0; $i < count( $custom_status ); $i++ ) {
	echo '<option value="' . $custom_status[$i] .'"';
 if ( $status == $custom_status[$i] ) echo ' selected="selected"';echo '>' . $custom_status[$i] . '</option>';
 }


echo '</select></div>';
}
function save_status( $post_id ) {

if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

// If the status is set to "None" we want to delete this setting.

if ( $_POST["ourstatus"] == 'None' ) delete_post_meta( $post_id, "_status", $_POST["ourstatus"] );

else update_post_meta( $post_id, "_status", $_POST["ourstatus"] );

}
}


/** FEEDS ***/
add_theme_support( 'automatic-feed-links' );
add_custom_background();

/* EXCERPTS */
function excerpt_read_more_link($output) {
 global $post;
 return $output . '<div class="excerptLink"><a href="'. get_permalink($post->ID) . '"> Read More...</a></div>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

function custom_trim_excerpt($text) { // Fakes an excerpt if needed
global $post;
if ( '' == $text ) {
$text = get_the_content('');
$text = apply_filters('the_content', $text);
$text = str_replace(']]>', ']]>', $text);
$text = strip_tags($text);
$excerpt_length = 80;
$words = explode(' ', $text, $excerpt_length + 1);
if (count($words) > $excerpt_length) {
array_pop($words);
array_push($words, '...');
$text = implode(' ', $words);
}
}
return $text;
}


/************* SHORTCODES ****************/
// 
function showBlogPosts( $atts ) {
	extract( shortcode_atts( array(
	// what categories to show, default = all. 
		'cat' => '',
	// number of posts
		'num' => 5,
		'p' => '',
	// The following variables work on an "on/off" switch, 1 to allow, 0 to disallow
	// excerpt or content. default = excerpt
		'excerpt' => 1,
	// show meta or not. default = yes
		'meta' => 1,
		'meta2' => 1,

	//paged. default on no. Determines if page should be paginated or not
		'pnavi' => 0
	), $atts ) );
	global $loopMeta, $loopExcerpt, $loopMeta2;
	$loopMeta = $meta;
	$loopExcerpt = $excerpt;
	$loopMeta2 = $meta2;
	if ($p != ''){
	$posts_per_page = '';	
	}
	
 wp_reset_query();
global $paged;
$args = array( 'posts_per_page' => $num, 'cat'=> $cat, 'p' => $p );
if($pnavi == 1){
$args['paged'] = get_query_var('page');
}
query_posts($args );
 while ( have_posts() ) : the_post();
/* for the loop part, use your own loop.php that contains only the post format. 
** See my "micrLoopPart.php" to see how all the options play out
*/
include(locate_template('microLoop.php'));
   endwhile; 

if($pnavi == 1){
echo'<div id="blogNav">';
posts_nav_link( ' ', '&raquo;', '&laquo;' );
echo '</div>';
}
 wp_reset_query();
}
add_shortcode( 'blogPosts', 'showBlogPosts' );

function cycle_method() {
   // register your script location, dependencies and version
   wp_register_script('cycle',
       get_template_directory_uri() . '/cycle.js',
       array('jquery'),
       '1.0' );
   // enqueue the script
   wp_enqueue_script('cycle');
}
add_action('wp_enqueue_scripts', 'cycle_method');
?>