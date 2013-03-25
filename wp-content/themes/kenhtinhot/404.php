<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<?php get_header(); ?>

<?php if ($wpzoom_topside_placement == 'On all pages' ) {  include(TEMPLATEPATH . '/wpzoom-topside.php');  } ?>

<?php get_sidebar(); ?>
	<div id="main">
 	
		<h3 class="catname"><?php _e('Error 404 - Nothing Found', 'wpzoom'); ?></h3>
		
		<?php if (have_posts()) : $count = 0; ?>
		<?php while (have_posts()) : the_post(); $count++; ?>
		
		
		<?php endwhile; else: ?>
		<div class="post">
			<div class="entry">
				<h3><?php _e('The page you are looking for could not be found.', 'wpzoom');?> </h3>
			</div>
		</div>
		<?php endif; ?>  
 
	</div> 
 
<?php if ($wpzoom_bottomside_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-bottomside.php');  } ?>

<?php if ($wpzoom_slider_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-slider.php');  } ?>
 
<?php get_footer(); ?>