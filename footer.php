	<footer class="footer">
		<div class="container">
			<p class="text-left py-3 mb-0 font-m">
			<?php esc_html_e('Follow us in ', 'flat-personal-blog'); ?>
			<a href="<?php echo esc_url( get_theme_mod( 'pbxv1_twitter_url' ) ); ?>" class="color-blue"><?php esc_html_e('Twitter', 'flat-personal-blog'); ?></a>,  
			<a href="<?php echo esc_url( get_theme_mod( 'pbxv1_instagram_url' ) ); ?>" class="color-blue"><?php esc_html_e('Github', 'flat-personal-blog'); ?></a>,  
			<a href="<?php echo esc_url( get_theme_mod( 'pbxv1_github_url' ) ); ?>" class="color-blue"><?php esc_html_e('Instagram', 'flat-personal-blog'); ?></a>
			</p>
		</div><!--./container--> 
	</footer><!--./footer--> 
	<?php wp_footer(); ?>	
</body>
</html>