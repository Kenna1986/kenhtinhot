<div id="departments">
	<h4><?php echo $wpzoom_slider_head; ?></h4>
 
 	<div class="items-out">
		<ul class="items">
		
		<?php wp_reset_query(); ?>
		<?php 
 		  if (is_array($wpzoom_slider_cat)) {
        $que = implode(",", $wpzoom_slider_cat);
		}
		query_posts("&cat=$que&showposts=".$wpzoom_slider_posts."");
		if (have_posts()) : ?>
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
		
		
			<li class="item">
			   <span class="category"><?php the_category(' ') ?></span>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
				if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
				$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
				 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=180&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
					<?php } 
					else { if (!$photo) { $photo = catch_that_image($post->ID); }
					if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=180&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
					<?php  }
					else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" width=\"180px\" />";
						 } // if $photo still does not exist
					 } ?>
 				</a>
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink() ?>" class="more" title="<?php the_title(); ?>"><?php _e('Read more', 'wpzoom'); ?> &rarr;</a>
			</li>
			 
		<?php endwhile; ?>	 
		<?php endif; ?>
  		</ul>
	</div>
	
	<div class="nav">
		<a href="#" class="prev">&larr; <?php _e('previous', 'wpzoom'); ?></a>
		<a href="#" class="next"><?php _e('next', 'wpzoom'); ?> &rarr;</a>
	</div>
</div>