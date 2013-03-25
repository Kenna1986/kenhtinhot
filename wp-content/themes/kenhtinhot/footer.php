<?php
 global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
</div> <!-- /#content -->
</div> <!-- /#inner-wrap -->
</div> <!-- /#wrapper -->


<div id="footer-wrap">
	<div id="footer">
  		<div id="left">
			<div class="logo">
				<a href="<?php echo get_option('home'); ?>/">
					<?php if (strlen($wpzoom_misc_footerlogo_path) > 1) { ?>
						<img src="<?php echo "$wpzoom_misc_footerlogo_path";?>" alt="<?php bloginfo('name'); ?>" />
					<?php } else { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/footer-logo.png" alt="<?php bloginfo('name'); ?>" /><?php } ?>
				</a>
			</div>
			 
			<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'sort_column' => 'menu_order', 'theme_location' => 'tertiary', 'depth' => '1' ) ); ?>
			 
		</div>
			
		<div id="footer_right">
 			 
 			<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-footer', 'theme_location' => 'four', 'depth' => '1' ) ); ?>
			
			<div id="footer_search">
				<strong><?php _e('search', 'wpzoom');?>:</strong>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>
				
 			<span class="copyright">&copy; <?php _e('Copyright', 'wpzoom') ?> <?php echo date("Y"); ?> &mdash; <a href="<?php echo get_option('home'); ?>/" class="on"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved', 'wpzoom') ?></span>
 			<span class="designed"><?php _e('Designed by', 'wpzoom') ?> <a href="http://www.wpzoom.com" target="_blank" title="WPZOOM WordPress Themes"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/wpzoom.png" alt="WPZOOM" /></a></span>
		</div><!-- /#right -->
 	</div> <!-- /#footer -->
</div> <!-- /#footer_wrap -->
 
 
<?php if ($wpzoom_misc_analytics != '' && $wpzoom_misc_analytics_select == 'Yes')
{
  echo stripslashes($wpzoom_misc_analytics);
} ?> 

 
<?php wp_footer(); ?>
</body>
</html>