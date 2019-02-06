<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-md navbar-light ltr main-menu px-0">
				<a class="navbar-brand mr-0" href="<?php echo esc_url( home_url() ); ?>">
					<img src="<?php if( esc_url( get_theme_mod( 'pbxv1_logo' ) ) ){ echo esc_url( get_theme_mod( 'pbxv1_logo' ) ); }else{ echo esc_url( get_template_directory_uri() ); ?>/dist/images/logo.png<?php } ?>" alt="logo">
					<?php if(is_home()){ ?><h1 class="site-name"><?php bloginfo('name'); ?></h1><?php }else{ ?><strong class="site-name"><?php bloginfo('name'); ?></strong><?php } ?>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse ltr" id="navbarSupportedContent">
					<?php wp_nav_menu(array('theme_location'=>'top-menu', 'container'=>'' ,'menu_class' =>'navbar-nav float-left pl-3')); ?>
					<ul class="header-icon ml-auto">
						<li>
							<a><i class="fas fa-search"></i></a>
						</li>
					</ul><!--./header-icon-->
				</div><!--./collapse-->
			</nav><!--./navbar-->

			<div class="srch-input text-center">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<input type="search" class="search-field py-3" placeholder="<?php printf( esc_html__( 'Search here...', 'flat-personal-blog' ) ); ?>" value="<?php echo get_search_query() ?>" name="s" />
				</form>
			</div><!--./srch-input-->

		</div>	
	</header>
	<div class="border-bottom-header"></div>
