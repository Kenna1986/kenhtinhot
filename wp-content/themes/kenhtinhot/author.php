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
		
	<?php the_post(); ?>

		<h3 class="catname"><?php printf( __( 'Articles By:  %s', 'wpzoom' ), "<strong><a href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a></strong>" ) ?> <?php echo get_avatar( get_the_author_id() , 60 ); ?></h3>
		
		
 		<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

		<?php rewind_posts() ?>	
		
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