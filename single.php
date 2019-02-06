<?php
	get_header(); 
	global $post;
?>
	<main>
		<div class="container">
			<?php if(get_post_meta($post->ID,'_audio',true)){?>
				<section>
					<article class="text-left my-3 voice-box"> 
						<div class="row mx-0 border py-3">
							<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 text-left">
								<small><?php echo esc_attr(get_post_meta($post->ID,'_audio_name',true));?></small>
							</div><!--./col-lg-6-->

							<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 text-right">
								<span class="audio-icon controls">
									<li class="play"><i class="fas fa-play"></i></li>
									<li class="pause pl-3"><i class="fas fa-pause"></i></li>
									<li class="pl-3 time">00 : 00</li>
									<li class="pl-3 mute"><i class="fas fa-volume-up"></i></li>	
								</span><!--./audio-icon-->
							</div><!--./col-lg-5-->
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div id="waveform"></div>
							</div>
						</div><!--./row-->
						<input type="hidden" name="audio" id="audio" value="<?php echo esc_attr(get_post_meta($post->ID,'_audio',true));?>"/>
					</article><!--./voice-box-->
				</section><!--/section-->
			<?php } ?>
			<section>
				<article class="text-left my-4 post-content">
					<?php 
						if (have_posts()) : while (have_posts()) : the_post();
					?>
					<div class="row mx-0 ltr">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12 px-0">
							<h1><?php the_title(); ?></h1>
							<ul class="detail py-1">
								<li class="font-xs">
									<i class="<?php echo esc_attr(get_post_meta($post->ID,'_icon_class',true));?> font-xl"  style="color:<?php echo esc_attr(get_post_meta($post->ID,'_icon_color',true));?>"></i>
									<ul class="cat-list">
									<?php 
										$categories = get_the_category();
										foreach( $categories as $category ) {
									?>
											<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="color-blue"><?php echo esc_html( $category->name ) ?></a></li>
									<?php
										}
									?>
									</ul><!--./cat-list-->
								</li>
								<li class="font-xs px-1 tags">
									<span class="color-light"><?php the_tags(); ?></span>
								</li>
								<li class="font-xs px-1 color-light">
									<?php echo esc_html( get_the_time( 'j F Y' ) ); ?>
								</li>
								<li class="font-xs px-1">
									<span class="color-light pl-1">
										<?php echo get_avatar(25); ?>
										<?php esc_html_e('posted by', 'flat-personal-blog'); ?>
									</span>
									<span><?php echo get_the_author(); ?></span>
								</li>
							</ul><!--./detail-->
							<?php
								the_content();
									
							 	$defaults = array(
									'before'           => '<p>' . __( 'Pages:', 'flat-personal-blog' ),
									'after'            => '</p>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => __( 'Next page', 'flat-personal-blog'),
									'previouspagelink' => __( 'Previous page', 'flat-personal-blog' ),
									'pagelink'         => '%',
									'echo'             => 1
								);
							        wp_link_pages( $defaults );

							?>

						</div><!--./col-lg-12-->
					</div><!--./row-->
					<?php endwhile; endif; wp_reset_query(); ?>
				</article><!--./post-content-->
			</section><!--/section-->
			<section>
				<article class="text-left my-5 next-prev-post">
					<div class="row mx-0 border border-left-0 border-right-0 border-dash py-5">

						<div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left pl-0">
							<h2 class="prev-link"><?php next_post_link( '%link',__('Previous post', 'flat-personal-blog') )?></h2>
						</div><!--./col-lg-6-->
						<div class="col-lg-6 col-md-6 col-sm-6 col-6 text-right pr-0">
							<h2 class="nex-link"><?php previous_post_link( '%link',__('Next post', 'flat-personal-blog') ) ?></h2>
						</div><!--./col-lg-6-->

					</div><!--./row-->
				</article><!--./next-prev-post-->
			</section><!--/section-->
			<section>
				<div class="row mx-0 ltr comment">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
				</div><!--./comment-->
			</section><!--./section-->
		</div>
		<section>
			<article class="mt-5 bg-lights latest-post">
				<div class="container">
					<div class="row mx-0">
						<div class="col-lg-4 col-md-4 col-sm-4 col-12 mx-auto text-center pt-5">
							<h5><?php esc_html_e('Related Posts', 'flat-personal-blog'); ?></h5>
						</div>
					</div><!--./row-->
					<div class="row ltr py-5">
						<?php
							$tag_slugs = wp_get_post_tags( $post->ID, array( 'fields' => 'slugs' ) );
							$args = array(
								'posts_per_page' => '4',
								'post__not_in' => array($post->ID),
								'tag' => $tag_slugs
							);
							$poststag =new WP_Query($args );
							if ($poststag->have_posts()) : while ($poststag->have_posts()) : $poststag->the_post();
							$cats = get_the_category();
						?>
						<div class="col-lg-3 col-md-3 col-sm-6 col-12 d-flex align-items-stretch">
							<div class="card text-left border-0 border-rad-0">
								<div class="card-body">
									<h6 class="card-title pb-5 font-normal"><a href="<?php the_permalink(); ?>"><?php  the_title();?></a></h6>
									<div class="d-flex align-items-center">
										<?php 
											$image_id = esc_attr(get_term_meta ( $cats[0]->term_id, 'category-image-id', true )); 
											if ( $image_id ) { 
												echo wp_get_attachment_image ( $image_id, 'thumbnail' ); 
											}
										?>
										<span class="ml-3 cat-title"><a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" class="card-link font-xxs"><?php echo esc_html( $cats[0]->name ); ?></a></span>
									</div>
								</div><!--./card-body-->
							</div><!--./card-->
						</div><!--./col-lg-3-->
						<?php endwhile; endif; wp_reset_query(); ?>
					</div><!--./row-->
				</div><!--./container-->
			</article><!--./latest-post-->
		</section>
	</main>
<?php get_footer(); ?>