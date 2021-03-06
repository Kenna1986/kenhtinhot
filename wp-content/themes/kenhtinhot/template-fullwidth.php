<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>
	
 <?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

<?php if ($wpzoom_topside_placement == 'On all pages' ) {  include(TEMPLATEPATH . '/wpzoom-topside.php');  } ?>


	<div id="main" class="fullwidth">
 
 		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
		<div class="post">
		
			<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				
				<div class="meta"><?php edit_post_link( __('Edit', 'wpzoom'), '', ''); ?></div>
  				<div class="entry">
					<?php the_content(); ?>
					 
				</div>
				
				<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
 
		
		 
		</div> <!-- /.post -->
 		<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'wpzoom'); ?></p>

		<?php endif; ?>
		
	</div> <!-- /#main -->
   	<?php wp_reset_query(); ?>
 
<?php if ($wpzoom_bottomside_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-bottomside.php');  } ?>

<?php if ($wpzoom_slider_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-slider.php');  } ?>
 
<?php get_footer(); ?>