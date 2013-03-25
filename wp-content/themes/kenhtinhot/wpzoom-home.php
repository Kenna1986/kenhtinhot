		<?php 
			$catid2 = $wpzoom_featured_category_2;
			$catid3 = $wpzoom_featured_category_3;
			$catid4 = $wpzoom_featured_category_4;
            $catid5 = $wpzoom_featured_category_5;
            $catid6 = $wpzoom_featured_category_6;
            $catid7 = $wpzoom_featured_category_7;
            $catid8 = $wpzoom_featured_category_8;
            $catid9 = $wpzoom_featured_category_9;
            $catid10 = $wpzoom_featured_category_10;
            $catid11 = $wpzoom_featured_category_11;
            
            $cat2 = get_category($catid2,false);
            $cat3 = get_category($catid3,false);
            $cat4 = get_category($catid4,false);
            $cat5 = get_category($catid5,false);
            $cat6 = get_category($catid6,false);
            $cat7 = get_category($catid7,false);
            $cat8 = get_category($catid8,false);
            $cat9 = get_category($catid9,false);
            $cat10 = get_category($catid10,false);
            $cat11 = get_category($catid11,false);
            
            $catlink2 = get_category_link($catid2);
            $catlink3 = get_category_link($catid3);
            $catlink4 = get_category_link($catid4);
            $catlink5 = get_category_link($catid5);
            $catlink6 = get_category_link($catid6);
            $catlink7 = get_category_link($catid7);
            $catlink8 = get_category_link($catid8);
            $catlink9 = get_category_link($catid9);
            $catlink10 = get_category_link($catid10);
            $catlink11 = get_category_link($catid11);
					
            $breaking_cat2 = "cat=$catid2";
            $breaking_cat3 = "cat=$catid3";
            $breaking_cat4 = "cat=$catid4";
            $breaking_cat5 = "cat=$catid5";
            $breaking_cat6 = "cat=$catid6";
            $breaking_cat7 = "cat=$catid7";
            $breaking_cat8 = "cat=$catid8";
            $breaking_cat9 = "cat=$catid9";
            $breaking_cat10 = "cat=$catid10";
            $breaking_cat11 = "cat=$catid11";
         ?>
 
   	<?php if ($catid2 && $catid2 > 0) { ?>
	<div class="homecat">
 		<h4><?php echo"<a href=\"$catlink2\">$cat2->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat2 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 
  					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat2 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink2\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
	
	
	
	<?php if ($catid3 && $catid3 > 0) { ?>
	<div class="homecat red">
 		<h4><?php echo"<a href=\"$catlink3\">$cat3->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat3 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
 					
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat3 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink3\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
 	
 	<?php if ($catid4 && $catid4 > 0) { ?>
	<div class="homecat grey">
 		<h4><?php echo"<a href=\"$catlink4\">$cat4->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat4 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
 					
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat4 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink4\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
 	
 	<?php if ($catid5 && $catid5 > 0) { ?>
	<div class="homecat">
 		<h4><?php echo"<a href=\"$catlink5\">$cat5->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat5 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat5 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink5\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
 	<?php if ($catid6 && $catid6 > 0) { ?>
	<div class="homecat red">
 		<h4><?php echo"<a href=\"$catlink6\">$cat6->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat6 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat6 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink6\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
 	 	<?php if ($catid7 && $catid7 > 0) { ?>
	<div class="homecat grey">
 		<h4><?php echo"<a href=\"$catlink7\">$cat7->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat7 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat7 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink7\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
 	 	<?php if ($catid8 && $catid8 > 0) { ?>
	<div class="homecat">
 		<h4><?php echo"<a href=\"$catlink8\">$cat8->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat8 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat8 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink8\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
 	 <?php if ($catid9 && $catid9 > 0) { ?>
	<div class="homecat red">
 		<h4><?php echo"<a href=\"$catlink9\">$cat9->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat9 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat9 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink9\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
	<?php if ($catid10 && $catid10 > 0) { ?>
	<div class="homecat grey">
 		<h4><?php echo"<a href=\"$catlink10\">$cat10->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat10 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat10 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink10\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>
 	
 	
	<?php if ($catid11 && $catid11 > 0) { ?>
	<div class="homecat">
 		<h4><?php echo"<a href=\"$catlink11\">$cat11->name</a>";?></h4>
			<ul> 
				<?php $slidethumb = new WP_Query('showposts=3&' . $breaking_cat11 ); while($slidethumb->have_posts()) : $slidethumb->the_post(); ?>
				<li>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php unset($photo); $photo = catch_that_image (get_the_id(), '', '');
						if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail() ) { 
						$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
						 <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $thumbURL[0]; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php } 
							else { if (!$photo) { $photo = catch_that_image($post->ID); }
							if ($photo) { ?> <img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $photo; ?>&amp;w=185&amp;h=115&amp;zc=1" alt="<?php the_title(); ?>" /> 
							<?php  }
							else {  echo"<img src=\""; bloginfo('template_directory'); echo"/images/blank.jpg\" />";
								 } // if $photo still does not exist
							 } ?>
							<span class="meta"><?php the_time("$dateformat"); ?><strong><?php comments_number('0','1','%', ' ', ' '); ?></strong></span>
						</a>
					</div>
 					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 					<?php the_content_limit(95); ?>
				  </li>
				  <?php endwhile; ?>
			</ul>		
					 
			<!-- more posts -->
			<ul class="stories">
				<?php $slidepost = new WP_Query('showposts=3&offset=3&' . $breaking_cat11 ); while($slidepost->have_posts()) : $slidepost->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>		 
						
			</ul>
			
			<?php echo"<a href=\"$catlink11\" class=\"nextActions\">"?> <?php _e('More in this category &rarr;', 'wpzoom'); ?> <?php echo"</a>";?>
 	</div>
 	<?php } ?>