<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>


	<?php if ( $paged < 2 ) { ?>
	<div id="featured">
 	
	<?php 
	$featid = $wpzoom_featured_article;
	$feat = get_category($featid,false);
 	$featcat = "cat=$featid";
 	?>
	
	<?php $feat_art = new WP_Query('showposts=1&' .  $featcat ); while($feat_art->have_posts()) : $feat_art->the_post(); ?>
 
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> </h2>
		<div class="date"><?php echo time_ago(); ?></div>

		<div class="content">
		
 			<div class="thumb">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				 <?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
				 if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
				$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
				<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=300&amp;h=350&amp;zc=1" alt="<?php the_title(); ?>" /> 
				<?php the_post_thumbnail_caption(); ?>
				<?php }
			  
				else { if (!$photo) {$photo = catch_that_image($post->ID);}
					if ($photo)	{ ?><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=300&amp;h=350&amp;zc=1" alt="<?php the_title(); ?>" /> 
					<?php  }
 				} ?> 
				</a>
			</div>
 
			<div class="entry">
				<?php if ($wpzoom_feat_cont == 'Post Excerpt') {  the_excerpt(); } ?>
				<?php if ($wpzoom_feat_cont == 'Full Content') {  the_content(); } ?>
					
				<div class="meta">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="nextActions"><?php _e('Read full story', 'wpzoom'); ?> &rarr;</a>
					<span class="comments"><?php comments_popup_link(__('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom')); ?></span>
				</div>
			</div><!-- /.entry -->
		</div><!-- /.content -->
 	<?php endwhile; ?>
		
	</div> <!-- /#featured -->
	<?php } ?>

			<!-- home banner code -->
			<div id="home_ad">
				<?php if (strlen($wpzoom_ad_feat_imgpath) > 1 && $wpzoom_ad_feat_select == 'Yes') {?>
					 <?php if (strlen($wpzoom_ad_feat_imgpath) > 1) { echo stripslashes($wpzoom_ad_feat_imgpath); }?> 
				<?php } ?>
			</div>
			
			
 
<?php if ($wpzoom_topside_placement == 'On all pages' || $wpzoom_topside_placement == 'Homepage only') {  include(TEMPLATEPATH . '/wpzoom-topside.php');  } ?>

<?php get_sidebar(); ?>

<div id="main">

	<?php if ( $paged < 2 && $wpzoom_homepage_style == 'Magazine Style') {  
		 include(TEMPLATEPATH . '/wpzoom-home.php'); //calling homepage featured categories
	  }  ?> 
	  
	  
	<?php if ($wpzoom_homepage_style == 'Traditional Blog' || $paged > 1)  { ?>
		
		<?php $z = count($wpzoom_exclude_cats_home);if ($z > 0) { 
			$x = 0; $que = ""; while ($x < $z) {
			$que .= "-".$wpzoom_exclude_cats_home[$x]; $x++;
			if ($x < $z) {$que .= ",";} } }		 
			query_posts($query_string . "&cat=$que");if (have_posts()) : 
		?>
 
			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
		   

			<div class="post">
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>	</h2>
 
 				<div class="meta">
 				<?php if ($wpzoom_homepost_date == 'Show') { ?><span class="date"><?php the_time("$dateformat $timeformat"); ?></span><?php } ?>
 				<?php if ($wpzoom_homepost_comm == 'Show') { ?><span class="comments"><?php comments_popup_link(__('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom')); ?></span><?php } ?>
  				<?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?>
				</div> 
 
				<div class="entry">
					<?php if ($wpzoom_homepost_type == 'Post Excerpts') {  the_excerpt(); } ?>
					<?php if ($wpzoom_homepost_type == 'Full Content') {  the_content(); } ?>
				</div>
	 
 				
			</div> <!-- /.post -->
			

		<?php endwhile; ?>

		<div class="pagenav">
 			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
 				<div class="floatleft"><?php next_posts_link( __('&larr; Older Entries', 'wpzoom') ); ?></div>
				<div class="floatright"><?php previous_posts_link( __('Newer Entries &rarr;', 'wpzoom') ); ?></div>
 			<?php } ?>
 		</div> 
		
	<?php endif; ?>
	
	<?php } ?>

</div><!-- /#main -->

 
<?php if ($wpzoom_bottomside_placement == 'On all pages' || $wpzoom_bottomside_placement == 'Homepage only') {  include(TEMPLATEPATH . '/wpzoom-bottomside.php');  } ?>
 
<?php if ($wpzoom_slider_placement == 'On all pages' || $wpzoom_slider_placement == 'Homepage only') {  include(TEMPLATEPATH . '/wpzoom-slider.php');  } ?>
 
<?php get_footer(); ?>