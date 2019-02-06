	<?php get_header(); ?>
	<main>
		<div class="container">
			<section>			
				<article class="text-left my-3"> 
					<ul class="post-list">
						<?php 
							$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
							$args = array(
								'paged' => $paged,
							);
							$posts =new WP_Query($args );
							if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post();
						?>
								<li class="border-bottom pb-2 pt-3 " <?php post_class(); ?>>
									<strong>
										<a class="font-xl font-normal" href="<?php the_permalink(); ?>"><?php the_title(); ?>
											<i class="float-left <?php echo esc_attr(get_post_meta($post->ID,'_icon_class',true));?> xl-font pr-2" style="color:<?php echo esc_attr(get_post_meta($post->ID,'_icon_color',true));?>"></i>
										</a>
									</strong>
									<span>
										<a class="float-right font-xxs" href="<?php comments_link(); ?>"><?php if(get_comments_number( $post->ID )){?>
											<i class="far fa-comment-alt"><?php echo esc_html( get_comments_number( $post->ID ) ); ?></i><?php } ?>
										</a>
									</span>
									<span class="font-xxs d-block mt-2"><?php esc_html_e('posted on', 'flat-personal-blog'); ?><span class="px-1"><?php echo esc_html( get_the_time('j F Y') ); ?></span><?php esc_html_e('by', 'flat-personal-blog'); ?> <span class="pr-1"><?php echo get_the_author(); ?></span></span>
								</li><!--/li-->
							<?php endwhile;?>
							<li class="text-center mt-5 mx-auto">
								<?php
									the_posts_pagination();
								?>
							</li><!--./text-center-->
						<?php endif;wp_reset_query(); ?>
					</ul><!--./post-list-->
				</article><!--./article-->
			</section><!--/section-->
		</div>
		<section>
			<article class="mt-5 bg-lights latest-post">
				<div class="container">
					<div class="row mx-0">
						<div class="col-lg-4 col-md-4 col-sm-4 col-12 mx-auto text-center pt-5">
							<h5><?php esc_html_e('Featured', 'flat-personal-blog'); ?></h5>
						</div>
					</div>
					<div class="row ltr py-5">
						<?php
							$cat= intval( get_theme_mod( 'cats_elect', 1 ) ); 
							$args = array(
								'posts_per_page' => '4',
								'cat' =>$cat
							);
							$postslist =new WP_Query($args );
							if ($postslist->have_posts()) : while ($postslist->have_posts()) : $postslist->the_post();
						?>
						<div class="col-lg-3 col-md-3 col-sm-6 col-12 d-flex align-items-stretch">
							<div class="card text-left border-0 border-rad-0">
								<div class="card-body">
									<h6 class="card-title pb-5 font-normal"><a href="<?php the_permalink(); ?>"><?php  the_title();?></a></h6>
									<div class="d-flex align-items-center">
										<?php 
											$image_id = esc_attr(get_term_meta ( $cat, 'category-image-id', true )); 
											if ( $image_id ) { 
												echo wp_get_attachment_image ( $image_id, 'thumbnail' ); 
											}
										?>
										<span class="ml-3 cat-title"><a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="card-link font-xxs"><?php echo esc_html( get_cat_name( $cat ) ); ?></a></span>
									</div>
								</div><!--./card-body-->
							</div><!--./card-->
						</div><!--./col-lg-3-->
						<?php endwhile;endif;wp_reset_query(); ?>
					</div>
				</div>
			</article><!--./latest-post-->
		</section>
	</main>
	<?php get_footer(); ?>