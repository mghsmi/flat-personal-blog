<?php get_header(); ?>
<main role="main" class="page">
	<div class="container mt-5 rtl pt-5">
		<div class="row">
			<section class="col-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="xxl-font font-normal"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endwhile; ?>
			</section>
			<aside class="col-4">
				<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
			    <ul id="sidebar">
			        <?php dynamic_sidebar( 'main-sidebar' ); ?>
			    </ul>
				<?php else: ?>
			    <ul id="sidebar">
			        <li><?php esc_html_e( 'Please choose a sidebar', 'flat-personal-blog' ); ?></li>
			    </ul>
				<?php endif; ?>
			</aside>
		</div>
	</div>
</main><!-- ./page -->

<?php get_footer(); ?>
