<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
$dateformat = get_option('date_format');
$timeformat = get_option('time_format');
?>

<?php get_header(); ?>

<?php if ($wpzoom_topside_placement == 'On all pages' || $wpzoom_topside_placement == 'Posts and Pages only'  ) {  include(TEMPLATEPATH . '/wpzoom-topside.php');  } ?>

<?php get_sidebar(); ?>
 		
	<div id="main">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 
		<div class="post">
			 
			<?php if ($wpzoom_singlepost_bread == 'Show') { ?><div class="breadcrumbs"><?php _e('You are here:', 'wpzoom'); ?> <?php wpzoom_breadcrumbs(); ?></div><?php } ?>
			 
 			<h1> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> </h1>
			
			<div class="meta">
 				<?php if ($wpzoom_singlepost_date == 'Show') { ?><span class="date"><?php the_time("$dateformat $timeformat"); ?></span><?php } ?>
 				<?php if ($wpzoom_singlepost_comm == 'Show') { ?><span class="comments"><?php comments_popup_link(__('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom')); ?></span><?php } ?>
				<?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?>
				<?php if ($wpzoom_singlepost_views == 'Show') { ?><span class="views"><?php if(function_exists('echo_tptn_post_count')) echo_tptn_post_count(); ?></span><?php } ?>
			</div> 
			
			
			<?php if ($wpzoom_singlepost_share == 'Show') { ?>
			<div class="meta_box">
				<h4><?php _e('Share this Article', 'wpzoom'); ?></h4>
				
				<ul>
					<li><a href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo get_bloginfo('url')."/?p=".$post->ID; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/small/twitter.png" alt="Twitter" />Twitter</a></li>
					 
					<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/small/facebook.png" alt="Facebook" />Facebook</a></li>
					 
					<li><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/small/delicious.png" alt="Delicious" />Delicious</a></li>
					<li><a href="http://digg.com/submit?phase=2&url=<?php the_permalink();?>&title=<?php the_title();?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/small/digg.png" alt="Digg" />Digg</a></li>
					<li><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/small/stumble.png" alt="Stumbleupon" />Stumble</a></li>
					<li><a href="http://reddit.com/submit?url=<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/small/reddit.png" alt="Reddit" />Reddit</a></li>
 				</ul>
				
				<div class="hr"></div>
				<h4><?php _e('Author:', 'wpzoom'); ?></h4>
				<?php echo get_avatar( get_the_author_id() , 60 ); ?>
 				<strong><?php the_author_posts_link(); ?></strong>
				
 				<?php the_tags( __( '<div class="hr"></div><h4>Tags:</h4><span class="tag-links">', 'wpzoom' ), "  ", "</span>\n" ) ?>
 					
			</div><!-- /.meta_box -->
			<?php } ?>	
			
					
			<div class="entry">
 				<?php the_content(); ?>
   			</div>
 			
			<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
 
 			
		</div> <!-- /.post -->
 
		<div id="comments">
			<?php comments_template(); ?>
		</div> <!-- end #comments -->
		
	</div> <!-- /#main -->
		
		
   	<?php endwhile; endif; wp_reset_query(); ?>
  

<?php if ($wpzoom_bottomside_placement == 'On all pages' || $wpzoom_bottomside_placement == 'Posts and Pages only') {  include(TEMPLATEPATH . '/wpzoom-bottomside.php');  } ?>

<?php if ($wpzoom_slider_placement == 'On all pages' || $wpzoom_slider_placement == 'Posts and Pages only') {  include(TEMPLATEPATH . '/wpzoom-slider.php');  } ?> 
 
<?php get_footer(); ?>