<?php

/* 
Function Name: getCategories 
Version: 1.0 
Description: Gets the list of categories. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

function getCategories($parent) {
    global $wpdb, $table_prefix;

    $tb1 = "$table_prefix"."terms";
    $tb2 = "$table_prefix"."term_taxonomy";

    if ($parent == '1') {
        $qqq = "AND $tb2".".parent = 0";
    } else {
        $qqq = "";
    }

    $q = "SELECT $tb1.term_id,$tb1.name,$tb1.slug FROM $tb1,$tb2 WHERE $tb1.term_id = $tb2.term_id AND $tb2.taxonomy = 'category' $qqq AND $tb2.count > 0 ORDER BY $tb1.name ASC";
    $q = $wpdb->get_results($q);

    foreach ($q as $cat) {
        $categories[$cat->term_id] = $cat->name;
    } // foreach

    return($categories);
} // end func

/* 
Function Name: getPages 
Version: 1.0 
Description: Gets the list of pages. Represents a workaround for the get_categories bug in WP 2.8 
Author: Dumitru Brinzan
Author URI: http://www.brinzan.net 
*/ 

function getPages() {
    global $wpdb, $table_prefix;

    $tb1 = "$table_prefix"."posts";

    $q = "SELECT $tb1.ID,$tb1.post_title FROM $tb1 WHERE $tb1.post_type = 'page' AND $tb1.post_status = 'publish' ORDER BY $tb1.post_title ASC";
    $q = $wpdb->get_results($q);

    foreach ($q as $pag) {
        $pages[$pag->ID] = $pag->post_title;
    } // foreach
    return($pages);
} // end func

 
 
/*
Plugin Name: Limit Posts http://labitacora.net/comunBlog/limit-post.phps
*/

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "<div>";
      echo $content;
      echo "</div>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "<p>";
        echo $content;
        echo "...";
        echo "</p>";
   }
   else {
      echo "<p>";
      echo $content;
      echo "</p>";
   }
}

function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago', 'wpzoom');
}

 
/*this function controls the meta titles display*/
function wpzoom_titles() {
	global $shortname;
	
	#if the title is being displayed on the homepage
	if (is_home()) {
 
			if (get_option('wpzoom_seo_home_title') == 'Site Title - Site Description') echo get_bloginfo('name').get_option('wpzoom_title_separator').get_bloginfo('description'); 
			if ( get_option('wpzoom_seo_home_title') == 'Site Description - Site Title') echo get_bloginfo('description').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_home_title') == 'Site Title') echo get_bloginfo('name');
 	}
	#if the title is being displayed on single posts/pages
	if (is_single() || is_page()) { 

			if (get_option('wpzoom_seo_posts_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
			if ( get_option('wpzoom_seo_posts_title') == 'Page Title') echo wp_title('',false,'');
					
	}
	#if the title is being displayed on index pages (categories/archives/search results)
	if (is_category() || is_archive() || is_search()) { 
		if (get_option('wpzoom_seo_pages_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('wpzoom_title_separator').wp_title('',false,''); 
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('wpzoom_title_separator').get_bloginfo('name');
		if ( get_option('wpzoom_seo_pages_title') == 'Page Title') echo wp_title('',false,'');
		 }	  
} 

 
function wpzoom_index(){
		global $post;
		global $wpdb;
		if(!empty($post)){
			$post_id = $post->ID;
		}
 
		/* Robots */	
		$index = 'index';
		$follow = 'follow';

		if ( is_tag() && get_option('wpzoom_index_tag') != 'index') { $index = 'noindex'; }
		elseif ( is_search() && get_option('wpzoom_index_search') != 'index' ) { $index = 'noindex'; }  
		elseif ( is_author() && get_option('wpzoom_index_author') != 'index') { $index = 'noindex'; }  
		elseif ( is_date() && get_option('wpzoom_index_date') != 'index') { $index = 'noindex'; }
		elseif ( is_category() && get_option('wpzoom_index_category') != 'index' ) { $index = 'noindex'; }
		echo '<meta name="robots" content="'. $index .', '. $follow .'" />' . "\n";
		
	}
	
function meta_post_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$meta_post_keywords .= $tag->name . ',';
	}
	echo '<meta name="keywords" content="'.$meta_post_keywords.'" />';
}


function meta_home_keywords() {
 global $wpzoom_meta_key;
 
 if (strlen($wpzoom_meta_key) > 1 ) {
  
 echo '<meta name="keywords" content="'.get_option('wpzoom_meta_key').'" />';
 
 }
}
 

function wpzoom_rss()
{	 global $wpzoom_misc_feedburner;
    if (strlen($wpzoom_misc_feedburner) < 1) {
        bloginfo('rss2_url');
    } else {
        echo $wpzoom_misc_feedburner;
    }
}
 

function wpzoom_js()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        echo '<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/js/' . $arg . '.js"></script>' . "\n";
    }
}


 
/*this function controls canonical urls*/
function wpzoom_canonical() {
 	
 	if(get_option('wpzoom_canonical') == 'Yes' ) {
 	
	#homepage urls
	if (is_home() )echo '<link rel="canonical" href="'.get_bloginfo('url').'" />';
	
	#single page urls
	global $wp_query; 
	$postid = $wp_query->post->ID; 

	if (is_single() || is_page()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	
	
	#index page urls
	
		if (is_archive() || is_category() || is_search()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	}
}


function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="commbody">
	<div class="commleft">
		  <div class="comment-author vcard">
			 <?php echo get_avatar($comment,$size='60',$default='<path_to_url>' ); ?>

			 <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		  </div>
 
		  <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s <br/> %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      </div>

      <?php comment_text() ?>
		 <?php if ($comment->comment_approved == '0') : ?>
			 <em><?php _e('Your comment is awaiting moderation.', 'wpzoom') ?></em>
			 <br />
		  <?php endif; ?>
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <div class="clear"></div>
     </div>
<?php }

 

function catch_that_image ($post_id=0, $width=60, $height=60, $img_script='') {
	global $wpdb;
	if($post_id > 0) {

		 // select the post content from the db

		 $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
		 $row = $wpdb->get_row($sql);
		 $the_content = $row->post_content;
		 if(strlen($the_content)) {

			  // use regex to find the src of the image

			preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
			if(!$matches) {
				preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
			
			$the_image = '';
			$the_image_src = $matches[2];
			$frags = preg_split("/(\"|')/", $the_image_src);
			if(count($frags)) {
				$the_image_src = $frags[0];
			}

			  // if src found, then create a new img tag

			  if(strlen($the_image_src)) {
				   if(strlen($img_script)) {

					    // if the src starts with http/https, then strip out server name

					    if(preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
						     $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
						     $frags = split("\/", $the_image_src);
						     array_shift($frags);
						     $the_image_src = '/' . join("/", $frags);
					    }
					    $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
				   }
				   else {
					    $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
				   }
			  }
			  return $the_image_src;
		 }
	}
}

function the_content_imgstrip($more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = preg_replace("/<img[^>]+\>/i", "", $content);
    echo $content;
}

 
 
 
 function wpzoom_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
     global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      // the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
  }
}




function connectWithMe($args) {

  extract($args);
	$settings = get_option( 'widget_social_connect' );
  
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
?>
		<ul class="social">
				<?php if ($settings[ 'rss' ] != '') echo"<li><a href=\"$settings[rss]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/rss.png\" alt=\"$settings[rss_name] \" />$settings[rss_name]<span>$settings[rss_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'email' ] != '') echo"<li><a href=\"mailto:$settings[email]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/email.png\" alt=\"$settings[rss_email] \" />$settings[email_name]<span>$settings[email_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'twitter' ] != '') echo"<li><a href=\"$settings[twitter]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/twitter.png\" alt=\"$settings[rss_twitter] \" />$settings[twitter_name]<span>$settings[twitter_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'tumblr' ] != '') echo"<li><a href=\"$settings[tumblr]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/tumblr.png\" alt=\"$settings[rss_tumblr] \" />$settings[tumblr_name]<span>$settings[tumblr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'delicious' ] != '') echo"<li><a href=\"$settings[delicious]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/delicious.png\" alt=\"$settings[rss_delicious] \" />$settings[delicious_name]<span>$settings[delicious_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'digg' ] != '') echo"<li><a href=\"$settings[digg]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/digg.png\" alt=\"$settings[rss_digg] \" />$settings[digg_name]<span>$settings[digg_sub]</span></a></li>"; ?>
 				<?php if ($settings[ 'stumble' ] != '') echo"<li><a href=\"$settings[stumble]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/stumble.png\" alt=\"$settings[rss_stumble] \" />$settings[stumble_name]<span>$settings[stumble_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'facebook' ] != '') echo"<li><a href=\"$settings[facebook]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/facebook.png\" alt=\"$settings[rss_facebook] \" />$settings[facebook_name]<span>$settings[facebook_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'linkedin' ] != '') echo"<li><a href=\"$settings[linkedin]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/linkedin.png\" alt=\"$settings[rss_linkedin] \" />$settings[linkedin_name]<span>$settings[linkedin_sub]</span></a></li>"; ?>
  				<?php if ($settings[ 'flickr' ] != '') echo"<li><a href=\"$settings[flickr]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/flickr.png\" alt=\"$settings[rss_flickr] \" />$settings[flickr_name]<span>$settings[flickr_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'picasa' ] != '') echo"<li><a href=\"$settings[picasa]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/picasa.png\" alt=\"$settings[rss_picasa] \" />$settings[picasa_name]<span>$settings[picasa_sub]</span></a></li>"; ?>
				<?php if ($settings[ 'youtube' ] != '') echo"<li><a href=\"$settings[youtube]\"><img src=\"". get_bloginfo('stylesheet_directory') ."/images/icons/youtube.png\" alt=\"$settings[rss_youtube] \" />$settings[youtube_name]<span>$settings[youtube_sub]</span></a></li>"; ?>
 
 		</ul>
		<div class="cleaner">&nbsp;</div>
<?php
  echo $after_widget;

}

function connectWithMe_admin() {
	$settings = get_option( 'widget_social_connect' );
	
	if( isset( $_POST[ 'update_social_connect' ] ) ) {
    $settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_title' ] ) );
    
    
	$settings[ 'rss' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss' ] ) );
    $settings[ 'rss_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss_name' ] ) );
    $settings[ 'rss_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_rss_sub' ] ) );	
    
    $settings[ 'email' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email' ] ) );
    $settings[ 'email_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email_name' ] ) );
    $settings[ 'email_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_email_sub' ] ) );
    
    $settings[ 'twitter' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter' ] ) );
    $settings[ 'twitter_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter_name' ] ) );
    $settings[ 'twitter_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_twitter_sub' ] ) );	
    
    $settings[ 'tumblr' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr' ] ) );
    $settings[ 'tumblr_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr_name' ] ) );
    $settings[ 'tumblr_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_tumblr_sub' ] ) );		
    
    $settings[ 'delicious' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious' ] ) );
    $settings[ 'delicious_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious_name' ] ) );
    $settings[ 'delicious_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_delicious_sub' ] ) );
    
    $settings[ 'digg' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg' ] ) );
    $settings[ 'digg_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg_name' ] ) );
    $settings[ 'digg_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_digg_sub' ] ) );	
    
    $settings[ 'stumble' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble' ] ) );
    $settings[ 'stumble_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble_name' ] ) );
    $settings[ 'stumble_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_stumble_sub' ] ) );	
    
    $settings[ 'facebook' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook' ] ) );
    $settings[ 'facebook_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook_name' ] ) );
    $settings[ 'facebook_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_facebook_sub' ] ) );	
    
    $settings[ 'linkedin' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin' ] ) );
    $settings[ 'linkedin_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin_name' ] ) );
    $settings[ 'linkedin_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_linkedin_sub' ] ) );	
    
    $settings[ 'flickr' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr' ] ) );
    $settings[ 'flickr_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr_name' ] ) );
    $settings[ 'flickr_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_flickr_sub' ] ) );	
    
    $settings[ 'picasa' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa' ] ) );
    $settings[ 'picasa_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa_name' ] ) );
    $settings[ 'picasa_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_picasa_sub' ] ) );	
     
    $settings[ 'youtube' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube' ] ) );
    $settings[ 'youtube_name' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube_name' ] ) );
    $settings[ 'youtube_sub' ] = strip_tags( stripslashes( $_POST[ 'widget_social_connect_youtube_sub' ] ) );	
    
		update_option( 'widget_social_connect', $settings );
	}

?>
	<p>
		<label for="widget_social_connect_title">Widget Title</label><br />
		<input type="text" id="widget_social_connect_title" name="widget_social_connect_title" value="<?php echo $settings['title']; ?>" size="35" /><br />
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/rss.png" />
		<label for="widget_social_connect_rss"><strong>RSS Feed</strong> URL</label> 
		<input type="text" id="widget_social_connect_rss" name="widget_social_connect_rss" value="<?php echo $settings['rss']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_rss">Heading</label><br />
		<input type="text" id="widget_social_connect_rss_name" name="widget_social_connect_rss_name" value="<?php echo $settings['rss_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_rss">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_rss_sub" name="widget_social_connect_rss_sub" value="<?php echo $settings['rss_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/email.png" />
		<label for="widget_social_connect_email"><strong>E-mail</strong></label> <br/>
		<input type="text" id="widget_social_connect_email" name="widget_social_connect_email" value="<?php echo $settings['email']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_email">Heading</label><br />
		<input type="text" id="widget_social_connect_email_name" name="widget_social_connect_email_name" value="<?php echo $settings['email_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_email">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_email_sub" name="widget_social_connect_email_sub" value="<?php echo $settings['email_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/twitter.png" />
		<label for="widget_social_connect_twitter"><strong>Twitter</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_twitter" name="widget_social_connect_twitter" value="<?php echo $settings['twitter']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_twitter">Heading</label><br />
		<input type="text" id="widget_social_connect_twitter_name" name="widget_social_connect_twitter_name" value="<?php echo $settings['twitter_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_twitter">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_twitter_sub" name="widget_social_connect_twitter_sub" value="<?php echo $settings['twitter_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/tumblr.png" />
		<label for="widget_social_connect_tumblr"><strong>Tumblr</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_tumblr" name="widget_social_connect_tumblr" value="<?php echo $settings['tumblr']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_tumblr">Heading</label><br />
		<input type="text" id="widget_social_connect_tumblr_name" name="widget_social_connect_tumblr_name" value="<?php echo $settings['tumblr_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_tumblr">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_tumblr_sub" name="widget_social_connect_tumblr_sub" value="<?php echo $settings['tumblr_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/delicious.png" />
		<label for="widget_social_connect_delicious"><strong>Delicious</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_delicious" name="widget_social_connect_delicious" value="<?php echo $settings['delicious']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_delicious">Heading</label><br />
		<input type="text" id="widget_social_connect_delicious_name" name="widget_social_connect_delicious_name" value="<?php echo $settings['delicious_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_delicious">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_delicious_sub" name="widget_social_connect_delicious_sub" value="<?php echo $settings['delicious_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/digg.png" />
		<label for="widget_social_connect_digg"><strong>Digg</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_digg" name="widget_social_connect_digg" value="<?php echo $settings['digg']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_digg">Heading</label><br />
		<input type="text" id="widget_social_connect_digg_name" name="widget_social_connect_digg_name" value="<?php echo $settings['digg_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_digg">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_digg_sub" name="widget_social_connect_digg_sub" value="<?php echo $settings['digg_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/stumble.png" />
		<label for="widget_social_connect_stumble"><strong>StumbleUpon</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_stumble" name="widget_social_connect_stumble" value="<?php echo $settings['stumble']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_stumble">Heading</label><br />
		<input type="text" id="widget_social_connect_stumble_name" name="widget_social_connect_stumble_name" value="<?php echo $settings['stumble_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_stumble">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_stumble_sub" name="widget_social_connect_stumble_sub" value="<?php echo $settings['stumble_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/facebook.png" />
		<label for="widget_social_connect_facebook"><strong>Facebook</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_facebook" name="widget_social_connect_facebook" value="<?php echo $settings['facebook']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_facebook">Heading</label><br />
		<input type="text" id="widget_social_connect_facebook_name" name="widget_social_connect_facebook_name" value="<?php echo $settings['facebook_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_facebook">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_facebook_sub" name="widget_social_connect_facebook_sub" value="<?php echo $settings['facebook_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/linkedin.png" />
		<label for="widget_social_connect_linkedin"><strong>Linkedin</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_linkedin" name="widget_social_connect_linkedin" value="<?php echo $settings['linkedin']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_linkedin">Heading</label><br />
		<input type="text" id="widget_social_connect_linkedin_name" name="widget_social_connect_linkedin_name" value="<?php echo $settings['linkedin_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_linkedin">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_linkedin_sub" name="widget_social_connect_linkedin_sub" value="<?php echo $settings['linkedin_sub']; ?>" size="30" /><br />
		</p>
		
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/flickr.png" />
		<label for="widget_social_connect_flickr"><strong>Flickr</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_flickr" name="widget_social_connect_flickr" value="<?php echo $settings['flickr']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_flickr">Heading</label><br />
		<input type="text" id="widget_social_connect_flickr_name" name="widget_social_connect_flickr_name" value="<?php echo $settings['flickr_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_flickr">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_flickr_sub" name="widget_social_connect_flickr_sub" value="<?php echo $settings['flickr_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/picasa.png" />
		<label for="widget_social_connect_picasa"><strong>Picasa</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_picasa" name="widget_social_connect_picasa" value="<?php echo $settings['picasa']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_picasa">Heading</label><br />
		<input type="text" id="widget_social_connect_picasa_name" name="widget_social_connect_picasa_name" value="<?php echo $settings['picasa_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_picasa">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_picasa_sub" name="widget_social_connect_picasa_sub" value="<?php echo $settings['picasa_sub']; ?>" size="30" /><br />
		</p>
		
		<p>
		<img style="float: left; margin-right: 3px;" src="<?php echo bloginfo('stylesheet_directory') ?>/images/icons/youtube.png" />
		<label for="widget_social_connect_youtube"><strong>Youtube</strong> Full URL</label> 
		<input type="text" id="widget_social_connect_youtube" name="widget_social_connect_youtube" value="<?php echo $settings['youtube']; ?>" size="30" />
		</p>
		<p style="margin-left:34px;">
  		<label for="widget_social_connect_youtube">Heading</label><br />
		<input type="text" id="widget_social_connect_youtube_name" name="widget_social_connect_youtube_name" value="<?php echo $settings['youtube_name']; ?>" size="30" /><br />
 		<label for="widget_social_connect_youtube">Sub-heading</label><br />
		<input type="text" id="widget_social_connect_youtube_sub" name="widget_social_connect_youtube_sub" value="<?php echo $settings['youtube_sub']; ?>" size="30" /><br />
		</p>
		
 
	</p>
	<input type="hidden" id="update_social_connect" name="update_social_connect" value="1" />
<?php }



 

/*
Plugin Name: Quick Flickr Widget
Plugin URI: http://kovshenin.com/wordpress/plugins/quick-flickr-widget/
Modified for WPZOOM by Dumitru Brinzan
*/

$flickr_api_key = "d348e6e1216a46f2a4c9e28f93d75a48"; // You can use your own if you like

function widget_quickflickr($args) {
	extract($args);
	
	$options = get_option("widget_quickflickr");
	if( $options == false ) {
		$options["title"] = "Flickr Photos";
		$options["rss"] = "";
		$options["items"] = 3;
		$options["target"] = "";
		$options["username"] = "";
		$options["user_id"] = "";
		$options["error"] = "";
	}
	
	$title = $options["title"];
	$items = $options["items"];
	$view = "_s";
	$before_item = "<li>";
	$after_item = "</li>";
	$before_flickr_widget = "<ul class=\"gallery\">";
	$after_flickr_widget = "</ul>";
	$more_title = $options["more_title"];
	$target = $options["target"];
	$username = $options["username"];
	$user_id = $options["user_id"];
	$error = $options["error"];
	$rss = $options["rss"];
	
	if (empty($error))
	{	
		$target = ($target == "checked") ? "target=\"_blank\"" : "";
		
		$flickrformat = "php";
		
		if (empty($items) || $items < 1 || $items > 20) $items = 3;
		
		// Screen name or RSS in $username?
		if (!ereg("http://api.flickr.com/services/feeds", $username))
			$url = "http://api.flickr.com/services/feeds/photos_public.gne?id=".urlencode($user_id)."&format=".$flickrformat."&lang=en-us".$tags;
		else
			$url = $username."&format=".$flickrformat.$tags;
		
      eval("?>". file_get_contents($url) . " ");
			$photos = $feed;

			if ($photos)
			{
			 $out .= $before_flickr_widget;
				
        foreach($photos["items"] as $key => $value)
				{
				
					if (--$items < 0) break;
					
					$photo_title = $value["title"];
					$photo_link = $value["url"];
					ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
					$photo_url = $regs[1];
					
					//$photo_url = $value["media"]["m"];
					$photo_medium_url = str_replace("_m.jpg", ".jpg", $photo_url);
					$photo_url = str_replace("_m.jpg", "$view.jpg", $photo_url);
					
//					$photo_title = ($show_titles) ? "<div class=\"qflickr-title\">$photo_title</div>" : "";
					$out .= $before_item . "<a $target href=\"$photo_link\"><img class=\"flickr_photo\" alt=\"$photo_title\" title=\"$photo_title\" src=\"$photo_url\" /></a>" . $after_item;

				}
				$flickr_home = $photos["link"];
				$out .= $after_flickr_widget;
			}
			else
			{
				$out = "Something went wrong with the Flickr feed! Please check your configuration and make sure that the Flickr username or RSS feed exists";
			}

		?>
 	<?php echo $before_widget; ?>
		<?php if(!empty($title)) { $title = apply_filters('localization', $title); echo $before_title . $title . $after_title; } ?>
		<?php echo $out ?>
		<?php if (!empty($more_title) && !$javascript) echo "<a href=\"" . strip_tags($flickr_home) . "\">$more_title</a>"; ?>
	<?php echo $after_widget; ?>
 	<?php
	}
	else // error
	{
		$out = $error;
	}
}

function widget_quickflickr_control() {
	$options = $newoptions = get_option("widget_quickflickr");
	if( $options == false ) {
		$newoptions["title"] = "Flickr photostream";
		$newoptions["error"] = "Your Quick Flickr Widget needs to be configured";
	}
	if ( $_POST["flickr-submit"] ) {
		$newoptions["title"] = strip_tags(stripslashes($_POST["flickr-title"]));
		$newoptions["items"] = strip_tags(stripslashes($_POST["rss-items"]));
		$newoptions["more_title"] = strip_tags(stripslashes($_POST["flickr-more-title"]));
		$newoptions["target"] = strip_tags(stripslashes($_POST["flickr-target"]));
		$newoptions["username"] = strip_tags(stripslashes($_POST["flickr-username"]));
		
		if (!empty($newoptions["username"]) && $newoptions["username"] != $options["username"])
		{
			if (!ereg("http://api.flickr.com/services/feeds", $newoptions["username"])) // Not a feed
			{
				global $flickr_api_key;
				$str = @file_get_contents("http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$flickr_api_key."&username=".urlencode($newoptions["username"])."&format=rest");
				ereg("<rsp stat=\\\"([A-Za-z]+)\\\"", $str, $regs); $findByUsername["stat"] = $regs[1];

				if ($findByUsername["stat"] == "ok")
				{
					ereg("<username>(.+)</username>", $str, $regs);
					$findByUsername["username"] = $regs[1];
					
					ereg("<user id=\\\"(.+)\\\" nsid=\\\"(.+)\\\">", $str, $regs);
					$findByUsername["user"]["id"] = $regs[1];
					$findByUsername["user"]["nsid"] = $regs[2];
					
					$flickr_id = $findByUsername["user"]["nsid"];
					$newoptions["error"] = "";
				}
				else
				{
					$flickr_id = "";
					$newoptions["username"] = ""; // reset
					
					ereg("<err code=\\\"(.+)\\\" msg=\\\"(.+)\\\"", $str, $regs);
					$findByUsername["message"] = $regs[2] . "(" . $regs[1] . ")";
					
					$newoptions["error"] = "Flickr API call failed! (findByUsername returned: ".$findByUsername["message"].")";
				}
				$newoptions["user_id"] = $flickr_id;
			}
			else
			{
				$newoptions["error"] = "";
			}
		}
		elseif (empty($newoptions["username"]))
			$newoptions["error"] = "Flickr RSS or Screen name empty. Please reconfigure.";
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option("widget_quickflickr", $options);
	}
	$title = wp_specialchars($options["title"]);
	$items = wp_specialchars($options["items"]);
	if ( empty($items) || $items < 1 ) $items = 3;
	
	$more_title = wp_specialchars($options["more_title"]);
	
	$target = wp_specialchars($options["target"]);
	$flickr_username = wp_specialchars($options["username"]);
	
	?>
	<p><label for="flickr-title"><?php _e("Title:"); ?> <input class="widefat" id="flickr-title" name="flickr-title" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="flickr-username"><?php _e("Flickr RSS URL or Screen name:"); ?> <input class="widefat" id="flickr-username" name="flickr-username" type="text" value="<?php echo $flickr_username; ?>" /></label></p>
	<p><label for="flickr-items"><?php _e("How many items?"); ?> <select class="widefat" id="rss-items" name="rss-items"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($items==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
	<p><label for="flickr-more-title"><?php _e("More link anchor text:"); ?> <input class="widefat" id="flickr-more-title" name="flickr-more-title" type="text" value="<?php echo $more_title; ?>" /></label></p>
	<p><label for="flickr-target"><input id="flickr-target" name="flickr-target" type="checkbox" value="checked" <?php echo $target; ?> /> <?php _e("Target: _blank"); ?></label></p>
	<input type="hidden" id="flickr-submit" name="flickr-submit" value="1" />
	<?php
}
 
 

/* Popular News
----------------------*/    

function wpzoom_popular_posts ($timeline = null) { 
 
        // Extract widget options
        $options = get_option('Wpzoom_popular_posts');
        $title = $options['title'];
        $maxposts = $options['maxposts'];
        if (!$timeline) {
            $timeline = $options['sincewhen'];
        }

         
        // Since we're passing a SQL statement, globalise the $wpdb var
        global $wpdb;
        $sql = "SELECT ID, post_title, comment_count FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ";
        
        // What's the chosen timeline?
        switch ($timeline) {
            case "thisday":
                $sql .= "AND DAY(post_date) = DAY(NOW()) AND WEEK(post_date) = WEEK(NOW()) AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW()) ";
                break;
            case "thisweek":
                $sql .= "AND WEEK(post_date) = WEEK(NOW()) AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW())";
                break;
            case "thismonth":
                $sql .= "AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW()) ";
                break;
            case "thisyear":
                $sql .= "AND YEAR(post_date) = YEAR(NOW()) ";
                break;
			default:
			    break;
 
        }
        
        // Make sure only integers are entered
        if (!ctype_digit($maxposts)) {
            $maxposts = 5;  
        } else {
            // Reformat the submitted text value into an integer
            $maxposts = $maxposts + 0;
            // Only accept sane values
            if ($maxposts <= 0 or $maxposts > 5) {
                $maxposts = 5;
            }
        }
        
        // Complete the SQL statement
        $sql .= "AND comment_count > 0 ORDER BY comment_count DESC LIMIT ". $maxposts;
        
        $res = $wpdb->get_results($sql);
        
        if($res) {
            $mcpcounter = 1;
            foreach ($res as $r) {
			 
                echo "<li><a href='".get_permalink($r->ID)."' rel='bookmark'>".htmlspecialchars($r->post_title, ENT_QUOTES)."</a> <span>".htmlspecialchars($r->comment_count, ENT_QUOTES)." " .__('comments', 'wpzoom'). "</span></li>\n";
                 $mcpcounter++;
            }
        } else {
            echo "<li>". __('No commented posts yet', 'wpzoom') . "</li>\n";
        }
 
    }
 
 
/* 
Recent News Widget
*/	

function recent_news($args) {
	
	extract($args);
	$settings = get_option( 'widget_recent_news' );  
	$number = $settings[ 'number' ];
	
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
  
?>
<div class="recent_news">
	<ul>
		<?php
			$recent = new WP_Query( 'caller_get_posts=1&showposts=' . $number );
			while( $recent->have_posts() ) : $recent->the_post(); 
				global $post; global $wp_query;
		?>
		<li>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
			if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
			$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
			 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=55&amp;h=55&amp;zc=1" alt="<?php the_title(); ?>" /> 
				<?php } 
				else { if (!$photo) { $photo = catch_that_image($post->ID); }
				if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=55&amp;h=55&amp;zc=1" alt="<?php the_title(); ?>" /> 
				<?php  }  } ?>
			</a>
			<span><?php echo time_ago(); ?></span><br/>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> 
		</li>
		 
		<?php
			endwhile;
		?>
	</ul>
</div>
 	  
<?php
echo $after_widget;
}

function recent_news_admin() {
	
	$settings = get_option( 'widget_recent_news' );

	if( isset( $_POST[ 'update_recent_news' ] ) ) {
		$settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_title' ] ) );
		$settings[ 'number' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_number' ] ) );
		update_option( 'widget_recent_news', $settings );
	}
?>
	<p>
		<label for="widget_recent_news_title">Title</label><br />
		<input type="text" id="widget_recent_news_title" name="widget_recent_news_title" value="<?php echo $settings['title']; ?>" size="40" /><br />
		
		
		<label for="widget_recent_news_number">How many items would you like to display?</label><br />
		<select id="widget_recent_news_number" name="widget_recent_news_number">
			<?php
				$settings = get_option( 'widget_recent_news' );  
				$number = $settings[ 'number' ];
				
				$numbers = array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10" );
				foreach ($numbers as $num ) {
					$option = '<option value="' . $num . '" ' . ( $number == $num? " selected=\"selected\"" : "") . '>';
						$option .= $num;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
		<input type="hidden" id="update_recent_news" name="update_recent_news" value="1" />

<?php  }
 


/* 
Popular Tabs Widget
*/	

function popular_tabs($args) {
	
	extract($args);
	$settings = get_option( 'widget_popular_tabs' );  
	
	if( $settings == false ) {
		$settings["commented"] = "Most Commented";
		$settings["viewed"] = "Most Viewed";
 	}
  	$commented = $settings[ 'commented' ];
	$viewed = $settings[ 'viewed' ];

     
?>
<div class="tabs-out">
	<ul class="tabs">
		<li><a href="#"><?php echo "$settings[commented]";?></a></li>
 		
		<?php if (function_exists('tptn_show_pop_posts')) { ?>
 		<li><a href="#"><?php echo "$settings[viewed]";?></a></li>
		<?php } ?>
 	</ul>
	<div class="panes">
 
		<div><!-- first pane -->
			<ol>
				<?php wpzoom_popular_posts(); ?>
 			</ol>
		</div>
		
		<?php if (function_exists('tptn_show_pop_posts')) { ?>
		<div><!-- second pane -->
  				<ol><?php tptn_show_pop_posts(); ?></ol>
 		</div>
		<?php } ?>
		
	</div>
</div>
 	  
<?php
 }

function popular_tabs_admin() {
	
	$settings = $newoptions = get_option( 'widget_popular_tabs' );
	
	if( $settings == false ) {
 		$newoptions["commented"] = "Most Commented";
		$newoptions["viewed"] = "Most Viewed";
	}
 
 
	if( isset( $_POST[ 'update_popular_tabs' ] ) ) {
 		$settings[ 'commented' ] = strip_tags( stripslashes( $_POST[ 'widget_popular_tabs_commented' ] ) );
		$settings[ 'viewed' ] = strip_tags( stripslashes( $_POST[ 'widget_popular_tabs_viewed' ] ) );
 		update_option( 'widget_popular_tabs', $settings );
	}
?>
	<p>
		<label for="widget_popular_tabs_commented"><b>Title for Most Commented tab</b></label><br />
		<input type="text" id="widget_popular_tabs_commented" name="widget_popular_tabs_commented" value="<?php echo $settings['commented']; ?>" size="30" /><br />
		
		
		<label for="widget_popular_tabs_viewed"><b><br />Title for Most Viewed tab</b></label><br />
		<p><em>You will need to install & activate <a href='http://wwww.wpzoom.com/documentation/top-10.zip'>Top 10 plugin</a> to make this tab work.</em></p>
		<input type="text" id="widget_popular_tabs_viewed" name="widget_popular_tabs_viewed" value="<?php echo $settings['viewed']; ?>" size="30" /><br />
 
	</p>
		<input type="hidden" id="update_popular_tabs" name="update_popular_tabs" value="1" />

<?php  }

 

/* 
Recent Comments http://mtdewvirus.com/code/wordpress-plugins/ 
*/ 

function dp_recent_comments($no_comments = 10, $comment_len = 55) { 
    global $wpdb; 
	
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password ='' AND comment_type = ''"; 
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments"; 
		
	$comments = $wpdb->get_results($request);
		
	if ($comments) { 
		foreach ($comments as $comment) { 
			ob_start();
			?>
				<li>
					 <?php echo get_avatar($comment,$size='40' ); ?> 
					<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?>:</a>
					<?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>
 				</li>
			<?php
			ob_end_flush();
		} 
	} else { 
		echo "<li>No comments</li>";
	}
}

function dp_get_author($comment) {
	$author = "";

	if ( empty($comment->comment_author) )
		$author = __('Anonymous');
	else
		$author = $comment->comment_author;
		
	return $author;
}


	
/* Recent Comments Widget
-----------------------------*/	

function recent_comments($args) {

	extract($args);
	$settings = get_option( 'widget_recent_comments' );  
	$number = $settings[ 'number' ];
	
  echo $before_widget;
  echo "$before_title"."$settings[title]"."$after_title";
 
 
?>
	<ul class="recent_comments">
	<?php dp_recent_comments($settings['number_comments']); ?>
	</ul>
	
 <?php
  echo $after_widget;
}

function recent_comments_admin() {
	
	$settings = get_option( 'widget_recent_comments' );
	 
	if( isset( $_POST[ 'update_recent_comments' ] ) ) {
			$settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_comments_title' ] ) );
			$settings[ 'number_comments' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_comments_number_comments' ] ) );
			update_option( 'widget_recent_comments', $settings );
		}
	
	 
?>	
	<p>
		<label for="widget_recent_comments_title_comments">Title</label><br />
		<input type="text" id="widget_recent_comments_title" name="widget_recent_comments_title" value="<?php echo $settings['title']; ?>" />
	</p>
	
	<p>
		<label for="widget_recent_comments_number_comments">Number of comments</label><br />
		<input type="text" id="widget_recent_comments_number_comments" name="widget_recent_comments_number_comments" value="<?php echo $settings['number_comments']; ?>" />
	</p>
	
<input type="hidden" id="update_recent_comments" name="update_recent_comments" value="1" />
<?php }

 
register_widget_control("WPZOOM: Flickr Photos", "widget_quickflickr_control");
register_sidebar_widget("WPZOOM: Flickr Photos", "widget_quickflickr");

register_sidebar_widget( 'WPZOOM: Social Widget', 'connectWithMe' );
register_widget_control( 'WPZOOM: Social Widget', 'connectWithMe_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Recent News', 'recent_news' );
register_widget_control( 'WPZOOM: Recent News', 'recent_news_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Most Popular Tab', 'popular_tabs' );
register_widget_control( 'WPZOOM: Most Popular Tab', 'popular_tabs_admin', 300, 200 );

register_sidebar_widget( 'WPZOOM: Recent Comments', 'recent_comments' );
register_widget_control( 'WPZOOM: Recent Comments', 'recent_comments_admin', 300, 200 );

?>