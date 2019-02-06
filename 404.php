<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Flat Persoanl Blog
 */

get_header(); ?>
<section>
	<div class="container mt-5 ltr pt-5 text-left">
		<h1 class="xl-font">
			<?php esc_html_e( 'Sorry, Page Not Found!', 'flat-personal-blog' ); ?>
			<i class="far fa-frown color-blue"></i>
		</h1>
	</div><!--./container-->
</section>
<?php get_footer(); ?>
