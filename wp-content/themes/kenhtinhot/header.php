<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php wpzoom_titles(); ?></title>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php meta_post_keywords(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php if (strlen($wpzoom_meta_desc) < 1) { bloginfo('description');} else {echo"$wpzoom_meta_desc";}?>" />
<?php meta_home_keywords(); ?>
<?php endif; ?>
<?php wpzoom_index(); ?>
<?php wpzoom_canonical(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php wpzoom_rss(); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/dropdown.css" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie6.css" /><![endif]-->
<!--[if IE 7 ]><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css" /><![endif]-->
 <?php if (strlen($wpzoom_misc_favicon) > 1 ) { ?><link rel="shortcut icon" href="<?php echo "$wpzoom_misc_favicon";?>" type="image/x-icon" /><?php } ?> 
<?php if ($wpzoom_sidebar == 'Left') { ?><style type="text/css">#sidebar { float:left; margin-right:10px;} </style> <?php } ?>
<?php if ($wpzoom_thumb_pos == 'Right') { ?><style type="text/css">.post .entry .thumb img {float:right; margin:3px 0 5px 10px;} </style> <?php } ?>
<?php if (is_home()) { ?><style type="text/css"> .dropdown ul li.current_page_item a, .dropdown ul li.current-cat a { color:#fff;</style> <?php } ?>

<?php remove_action('wp_print_styles', 'pagenavi_stylesheets'); ?>
<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>	
<?php wp_head(); ?>
<?php wpzoom_js("tools", "dropdown", "tooltip", "autocolumn", "util"); ?>

</head>

<body onload="fix()">
<div id="wrapper"><div id="inner-wrapper">
	<div id="header">
		<div id="head-bar">
			<?php if ($wpzoom_date_show == 'Yes') { ?>
			<div id="date">
				<strong><?php echo date("l"); ?></strong>, <?php echo date("F jS"); ?> 
			</div>
			<?php } ?>
 			
			<div id="navigation" class="dropdown">
				 <?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'sort_column' => 'menu_order', 'theme_location' => 'secondary' ) ); ?>
 			</div>
		</div><!-- /#header-bar -->
			
		<div id="inner">
			<!-- Logo -->
			<div id="logo">
				<a href="<?php echo get_option('home'); ?>/">
					<?php if (strlen($wpzoom_misc_logo_path) > 1) { ?>
						<img src="<?php echo "$wpzoom_misc_logo_path";?>" alt="<?php bloginfo('name'); ?>" />
					<?php } else { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /><?php } ?>
				</a>
			</div> 
			<div id="head_banner">
				<?php if (strlen($wpzoom_ad_head_imgpath) > 1 && $wpzoom_ad_head_select == 'Yes') {?>
					 <?php if (strlen($wpzoom_ad_head_imgpath) > 1) { echo stripslashes($wpzoom_ad_head_imgpath); }?> 
				<?php } ?>
				 
			</div>
			
			<div id="right">
				<div id="social">
					<ul>
						<?php if (strlen($wpzoom_twitter) > 0) { ?><li class="button"><a href="http://twitter.com/<?php echo $wpzoom_twitter; ?>" title="<?php echo"$wpzoom_twitter_heading"; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/twitter.png" alt="Twitter" /></a></li><?php } ?>
						
						<?php if (strlen($wpzoom_facebook) > 0) { ?><li class="button"><a href="<?php echo $wpzoom_facebook; ?>" title="<?php echo"$wpzoom_facebook_heading"; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/facebook.png" alt="Facebook" /></a></li><?php } ?>
						
						<?php if (strlen($wpzoom_rssicon) > 0) { ?><li class="button"><a href="<?php echo $wpzoom_rssicon; ?>" title="<?php echo"$wpzoom_rssicon_heading"; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/rss.png" alt="RSS" /></a></li><?php } ?>
						
  					</ul>
				</div>
				
				<div id="search">
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				</div>
			</div><!-- /#right -->
			
		</div><!-- /#inner -->
				
		<!-- Main Menu -->
		<div id="menu" class="dropdown">
				<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'sort_column' => 'menu_order', 'theme_location' => 'primary' ) ); ?>
		</div> <!-- /#menu -->
		
		
		<?php if ($wpzoom_alert_show == 'Yes') { ?>
 		<div id="breakingNews">
			<?php echo stripslashes($wpzoom_alert);?>
 		</div>
		<?php } ?>
 
		
	</div><!-- /#header -->
	
	<div id="content">