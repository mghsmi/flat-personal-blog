<?php 

function pbxv1_sanitize_array( $input ) {
    return array_map( function( $val ) {
        return sanitize_text_field( $val );
    }, $input );
}
/*
 * set theme languages directory
 */
add_action( 'after_setup_theme', 'pbxv1_theme_setup' );
function pbxv1_theme_setup(){
    load_theme_textdomain( 'flat-personal-blog', get_template_directory() . '/languages' );
}
/*
 * Enable support for Post Thumbnails on posts and pages and title.
 */
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links');
register_nav_menus( array(
    'top-menu'   => __( 'Top Menu', 'flat-personal-blog' )
) );

if ( ! isset( $content_width ) ) $content_width = 1140;

/**
 * Add a sidebar.
 */
function pbxv1_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'flat-personal-blog' ),
        'id'            => 'main-sidebar',
        'description'   => __( 'Widgets for all pages.', 'flat-personal-blog' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'pbxv1_widgets_init' );

/**
 * add style and script files
 */
function pbxv1_front_scripts(){
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/dist/css/bootstrap.min.css' );
    wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/dist/css/fontawesome-all.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/dist/js/bootstrap.min.js', array( 'jquery' ), true );
    wp_enqueue_script( 'customjs', get_template_directory_uri() . '/dist/js/custom.js', array( 'jquery' ), true );
    if ( is_singular()) {
	    wp_enqueue_script( 'wavesurfer', get_template_directory_uri() . '/dist/js/wavesurfer.min.js', array( 'jquery' ), true );
	    wp_enqueue_script( 'player', get_template_directory_uri() . '/dist/js/player.js', array( 'jquery' ), true );
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'pbxv1_front_scripts' );

function pbxv1_admin_scripts(){
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/dist/css/fontawesome-all.css' );
    wp_enqueue_style( 'icon-css', get_stylesheet_directory_uri() . '/dist/css/icon.css' );
    wp_enqueue_script( 'icon-js', get_template_directory_uri() . '/dist/js/icon.js', array( 'jquery' ) );
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('post');
}
add_action( 'admin_enqueue_scripts', 'pbxv1_admin_scripts' );

/**
 * add icon meta  to post
 */
function pbxv1_icon_metabox(){
    add_meta_box('info_icon_meta_title',__( 'post icon', 'flat-personal-blog' ),'pbxv1_add_icon_metabox','post','normal','high');
}
add_action('add_meta_boxes','pbxv1_icon_metabox');

function pbxv1_add_icon_metabox(){
    global $post;
    if(is_admin()){
    	global $post_id;
        wp_enqueue_script('media-upload');
        wp_enqueue_script('post');
        wp_enqueue_media( array( 'post' => $post_id ) );
    }
?>
    <div>
        <button type="button" class="button-primary select-icon"><?php esc_html_e('select icon', 'flat-personal-blog'); ?></button>
        <ul id="ficon" class="">
            <li><i class="fab fa-php"></i></li>
            <li><i class="fas fa-level-up-alt"></i></li>
            <li><i class="fab fa-android"></i></li>
            <li><i class="fas fa-check"></i></li>
            <li><i class="fas fa-exclamation"></i></li>
        </ul>
    </div>
    <div class="show-icon">       
        <input type="text" class="box-ficon" name="icon_class" value="<?php echo esc_attr(get_post_meta($post->ID,'_icon_class',true));?>">
        <span class="box-ficons"><i class=""></i></span>
        <span class="icon-class"><i class="<?php echo esc_attr(get_post_meta($post->ID,'_icon_class',true));?>" style="color:<?php echo esc_attr(get_post_meta($post->ID,'_icon_color',true));?>"></i>
    </div>
    <div class="icon-color">
        <input name="icon_color" type="text" id="icon_color" value="<?php echo esc_attr(get_post_meta($post->ID,'_icon_color',true));?>" data-default-color="#ffffff">
    </div>
<?php
}

function pbxv1_save_icon_information(){
    global $post;
    if( isset( $_POST['icon_class'] ) ){
	    $icon_class = sanitize_text_field( wp_unslash( $_POST['icon_class'] ) );
	    update_post_meta( $post->ID,'_icon_class',$icon_class );
	}
    if( isset( $_POST['icon_color'] ) ){
	    $icon_color = sanitize_text_field( wp_unslash( $_POST['icon_color'] ) );
	    update_post_meta( $post->ID,'_icon_color',$icon_color );
    }
}
add_action('save_post','pbxv1_save_icon_information'); 

/**
 * add audio meta to post
 */
function pbxv1_audio_metabox(){
    add_meta_box('info_audio_meta_title',__( 'post audio', 'flat-personal-blog' ),'pbxv1_add_audio_metabox','post','normal','high');
}
add_action('add_meta_boxes','pbxv1_audio_metabox');

function pbxv1_add_audio_metabox(){
    global $post;
?>
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label"><?php esc_html_e('Audio name', 'flat-personal-blog'); ?></label><br>
        <input type="text" name="audio_name" id="audio_name" value="<?php echo esc_attr(get_post_meta($post->ID,'_audio_name',true));?>" placeholder="<?php esc_html_e('Audio name', 'flat-personal-blog'); ?>"/>
    </div>

    <div class="form-group row">
        <label  class="col-sm-2 col-form-label"><?php esc_html_e('Select audio', 'flat-personal-blog'); ?></label><br>
        <input type="text" name="audio" id="audio" value="<?php echo esc_attr(get_post_meta($post->ID,'_audio',true));?>" placeholder="<?php esc_html_e('upload audio', 'flat-personal-blog'); ?>"/>
        <button type="button" class="wpanel-uploader button-primary"><?php esc_html_e('upload audio', 'flat-personal-blog'); ?></button>
    </div>
<?php
}

function pbxv1_save_audio_information(){
    global $post;
    if(isset($_POST['audio'])){
	    $audio = sanitize_text_field( wp_unslash( $_POST['audio'] ) );
	    update_post_meta( wp_unslash( $post->ID,'_audio',$audio ) );
	}
    if(isset($_POST['audio_name'])){
	    $audio_name = sanitize_text_field( wp_unslash( $_POST['audio_name'] ) );
	    update_post_meta($post->ID,'_audio_name',$audio_name);
    }
}
add_action('save_post','pbxv1_save_audio_information'); 

/**
 * top customizer settings
 */
function pbxv1_top_customizer_settings($wp_customize) {
    // add a setting for the site logo
    $wp_customize->add_setting('pbxv1_top_logo', 
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    // Add a control to upload the logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pbxv1_top_logo',
        array(
        'label' => 'Upload Logo',
        'section' => 'title_tagline',
        'settings' => 'pbxv1_top_logo',
        ) ) 
    );
}
add_action('customize_register', 'pbxv1_top_customizer_settings');

/**
 * footer customizer settings
 */

function pbxv1_footer_customizer( $wp_customize ) {           
    //footer customizer section
    $wp_customize->add_section( 
        'pbxv1_footer_customizer_your_section', 
        array(
            'title' => esc_html__( 'Footer Setting', 'flat-personal-blog' ),
            'priority' => 150
        )
    );                 
    //add setting to Twitter address
    $wp_customize->add_setting( 
        'pbxv1_twitter_url', 
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );  
    $wp_customize->add_control( 
        'pbxv1_twitter_url', 
        array(
            'label' => esc_html__( 'Your Twitter address', 'flat-personal-blog' ),
            'section' => 'pbxv1_footer_customizer_your_section',
            'type' => 'url',
        )
    );
    //add setting to Instagram address
    $wp_customize->add_setting( 
        'pbxv1_instagram_url', 
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );  
    $wp_customize->add_control( 
        'pbxv1_instagram_url', 
        array(
            'label' => esc_html__( 'Your Instagram address', 'flat-personal-blog' ),
            'section' => 'pbxv1_footer_customizer_your_section',
            'type' => 'url',
        )
    );
    //add setting to Github address
    $wp_customize->add_setting( 
        'pbxv1_github_url', 
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    ); 
    $wp_customize->add_control( 
        'pbxv1_github_url', 
        array(
            'label' => esc_html__( 'Your Github address', 'flat-personal-blog' ),
            'section' => 'pbxv1_footer_customizer_your_section',
            'type' => 'url',
        )
    );             
}
add_action( 'customize_register', 'pbxv1_footer_customizer' );

/**
 * featured_category customizer settings
 */

function pbxv1_featured_category_customizer( $wp_customize ) {           
    //featured category section
    $wp_customize->add_section( 
        'pbxv1_featured_category_customizer_your_section', 
        array(
            'title' => esc_html__( 'Featured Category', 'flat-personal-blog' ),
            'priority' => 150
        )
    );                 
    $cats = array();
    // loop over the categories
    foreach ( get_categories() as $categories => $category ){
        $cats[$category->term_id] = $category->name;
    }   
    //Featured Category  setting
    $wp_customize->add_setting( 'pbxv1_featured_category_select', array(
        'default' => 1,
        'sanitize_callback' => 'absint'
    ) );    
    $wp_customize->add_control( 'pbxv1_featured_category_selects', array(
        'settings' => 'pbxv1_featured_category_select',
        'label' => esc_html__( 'Select Featured Category', 'flat-personal-blog' ),
        'type' => 'select',
        'choices' => $cats,
        'section' => 'pbxv1_featured_category_customizer_your_section', 
    ) );   
     
}
add_action( 'customize_register', 'pbxv1_featured_category_customizer' );