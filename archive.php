<?php
/**
 * The template for displaying Archive pages
 *
 * @package Flat Persoanl Blog
 */

get_header(); ?>

	<div class="container">
		<main>
			<article class="text-left my-3">
			<h1 class="xl-font"><?php echo single_cat_title( '', false ); ?></h1> 
				<ul class="post-list">
					<?php
						if( have_posts() ) :
							while( have_posts() ) : the_post();
					?>
					<li class="border-bottom pb-2 pt-3">
						<strong>
							<a class="font-xl font-normal" href="<?php the_permalink(); ?>"><?php the_title(); ?>
								<i class="float-left <?php echo esc_attr( get_post_meta( $post->ID,'_icon_class',true ) ); ?> xl-font pr-2" style="color:<?php echo esc_attr( get_post_meta( $post->ID, '_icon_color', true ) ); ?>"></i>
							</a>
						</strong>
						<span>
							<a class="float-right font-xxs" href="<?php comments_link(); ?>"><?php if( get_comments_number( $post->ID ) ){ ?>
								<i class="far fa-comment-alt"><?php comments_number( $post->ID ); ?></i><?php } ?>
							</a>
						</span>
						<span class="font-xxs d-block mt-2"><?php esc_html_e( 'posted on', 'flat-personal-blog' ); ?><span class="px-1"><?php the_time( 'j F Y' ); ?></span><?php esc_html_e( 'by', 'flat-personal-blog' ); ?> <span class="pr-1"><?php echo get_the_author(); ?></span></span>
					</li><!--/li-->
					<?php endwhile; ?>
					<li class="text-center mt-5 mx-auto">
						<?php
							the_posts_pagination();
						?>
					</li><!--./text-center-->
					<?php
						endif;
						wp_reset_postdata();
					?>
				</ul><!--./post-list-->
			</article><!--./article-->
		</main><!--/main-->
	</div>
<?php get_footer(); ?>
