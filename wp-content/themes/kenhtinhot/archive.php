<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>

<?php if ($wpzoom_topside_placement == 'On all pages' ) {  include(TEMPLATEPATH . '/wpzoom-topside.php');  } ?>

<?php get_sidebar(); ?>
	
	<div id="main">
	
<h3 class="catname">
	<?php /* category archive */ if (is_category()) { ?> <?php _e('Archive for Category:', 'wpzoom'); ?> <strong>"<?php single_cat_title(); ?>"</strong>
	<?php /* tag archive */ } elseif( is_tag() ) { ?><?php _e('Post Tagged with:', 'wpzoom'); ?> <strong>"<?php single_tag_title(); ?>"</strong>
	<?php /* daily archive */ } elseif (is_day()) { ?><?php _e('Archive for', 'wpzoom'); ?> <strong><?php the_time('F jS, Y'); ?></strong>
	<?php /* monthly archive */ } elseif (is_month()) { ?><?php _e('Archive for', 'wpzoom'); ?> <strong><?php the_time('F, Y'); ?></strong>
	<?php /* yearly archive */ } elseif (is_year()) { ?><?php _e('Archive for', 'wpzoom'); ?> <strong><?php the_time('Y'); ?></strong>
	<?php /* author archive */ } elseif (is_author()) { ?><?php _e('Author Archive', 'wpzoom'); ?><?php /* paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<?php _e('Archives', 'wpzoom'); ?><?php } ?>
</h3>
		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		
		
 		<div class="archive">
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				 <?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
				 if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) {
				$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
				<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=70&amp;h=65&amp;zc=1" alt="<?php the_title(); ?>" /> 
 				<?php }
			  
				else {  
				if (!$photo) {$photo = catch_that_image($post->ID);}
				if ($photo)	{ ?><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=70&amp;h=65&amp;zc=1" alt="<?php the_title(); ?>" /> 
					<?php  }
 				} ?>
			</a>
			<span class="date"><?php the_time("$dateformat $timeformat"); ?></span>
 			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			
  		 
		</div> <!-- /.archive -->
            
            
		<?php endwhile; ?>
         	
         	
 		<div class="pagenav">
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="floatleft"><?php next_posts_link( __('&larr; Older Entries', 'wpzoom') ); ?></div>
				<div class="floatright"><?php previous_posts_link( __('Newer Entries &rarr;', 'wpzoom') ); ?></div>
			<?php } ?>
		</div> 
 

	</div> <!-- /#main -->
		
		
   	<?php endif; ?>
   	<?php wp_reset_query(); ?>
 
<?php if ($wpzoom_bottomside_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-bottomside.php');  } ?>

<?php if ($wpzoom_slider_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-slider.php');  } ?>
 
<?php get_footer(); ?>
