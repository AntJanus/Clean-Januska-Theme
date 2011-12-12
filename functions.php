<?php

if ( !empty($GLOBALS['content_width']) ) {
    $max_width = $GLOBALS['content_width'];
}
else
    $max_width = 900;

/* MENUS AND POST FORMATS */
register_post_type( 'book', array( 'title' ) );
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

/* SIDEBAR */
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'main',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array('name'=>'topSide',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array('name'=>'rightSide',
'before_widget' => '',
'after_widget' => '',

));
register_sidebar(array('name'=>'footer',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h4>',
'after_title' => '</h4>',

));


/* IMAGE CROP */

/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

    // this is an attachment, so we have the ID
    if ( $attach_id ) {
    
        $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
        $actual_file_path = get_attached_file( $attach_id );
    
    // this is not an attachment, let's use the image url
    } else if ( $img_url ) {
        
        $file_path = parse_url( $img_url );
        $actual_file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
        
        $actual_file_path = ltrim( $file_path['path'], '/' );
        $actual_file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
        $orig_size = getimagesize( $actual_file_path );
        
        $image_src[0] = $img_url;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
    }
    
    $file_info = pathinfo( $actual_file_path );
    $extension = '.'. $file_info['extension'];

    // the image path without the extension
    $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

    $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

    // checking if the file size is larger than the target size
    // if it is smaller or the same size, stop right here and return
    if ( $image_src[1] > $width || $image_src[2] > $height ) {

        // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
        if ( file_exists( $cropped_img_path ) ) {

            $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
            
            $vt_image = array (
                'url' => $cropped_img_url,
                'width' => $width,
                'height' => $height
            );
            
            return $vt_image;
        }

        // $crop = false
        if ( $crop == false ) {
        
            // calculate the size proportionaly
            $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
            $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;            

            // checking if the file already exists
            if ( file_exists( $resized_img_path ) ) {
            
                $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                $vt_image = array (
                    'url' => $resized_img_url,
                    'width' => $proportional_size[0],
                    'height' => $proportional_size[1]
                );
                
                return $vt_image;
            }
        }

        // no cache files - let's finally resize it
        $new_img_path = image_resize( $actual_file_path, $width, $height, $crop );
        $new_img_size = getimagesize( $new_img_path );
        $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

        // resized output
        $vt_image = array (
            'url' => $new_img,
            'width' => $new_img_size[0],
            'height' => $new_img_size[1]
        );
        
        return $vt_image;
    }

    // default output - without resizing
    $vt_image = array (
        'url' => $image_src[0],
        'width' => $image_src[1],
        'height' => $image_src[2]
    );
    
    return $vt_image;
}

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



// add this to your functions.php file for your wordpress them. Strip the php tags if needed or you get errors 
/*
AUTHOR: Antonin Januska
DESCRIPTION: These two filters will create a "welcome" placeholder text for a new post. The first function will add random body text form the array.
The second function will do the same except for a title instead of body.
Enjoy!



*/
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

?>