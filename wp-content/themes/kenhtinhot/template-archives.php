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
Template Name: Archives Page
*/
?>
<?php get_header(); ?>

<?php if ($wpzoom_topside_placement == 'On all pages' ) {  include(TEMPLATEPATH . '/wpzoom-topside.php');  } ?>

<?php get_sidebar(); ?>
 		
	<div id="main">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
		<div class="post">
			 
 			<h1>
 				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
 			</h1>
 		
 		
 		<div class="col_arch">
			
			<div class="left">
			<?php _e('By Months:', 'wpzoom'); ?>	 
			</div>
			<div class="right"> 
				<ul>											  
					<?php wp_get_archives('type=monthly&show_post_count=1') ?>	
				</ul>	
			</div>
			
		</div>
		
		
		
 		<div class="col_arch">
			
			<div class="left">
			<?php _e('By Categories:', 'wpzoom'); ?>	 
			</div>
			<div class="right"> 
				<ul>											  
					<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
				</ul>	
			</div>
			
		</div>
		
		
 		
		<div class="col_arch">
			
			<div class="left">
			<?php _e('By Tags:', 'wpzoom'); ?>	 
			</div>
			<div class="right"> 
				<ul>	
					<?php wp_tag_cloud('format=list&smallest=12&largest=12&unit=px'); ?>
 				</ul>	
			</div>
			
		</div>
		
		<div class="meta"> <?php edit_post_link( __('Edit this post'), ' ', ''); ?> </div> 
  	 
		</div> <!-- /.post -->
		
 	</div> <!-- /#main -->
		
		
   	<?php endwhile; endif; ?>
   	<?php wp_reset_query(); ?>
  
<?php if ($wpzoom_bottomside_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-bottomside.php');  } ?>

<?php if ($wpzoom_slider_placement == 'On all pages') {  include(TEMPLATEPATH . '/wpzoom-slider.php');  } ?>
 
<?php get_footer(); ?>