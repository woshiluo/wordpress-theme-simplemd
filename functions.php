<?php
/**
 * simplemd functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package simplemd
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

if ( ! function_exists( 'simplemd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function simplemd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on simplemd, use a find and replace
		 * to change 'simplemd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'simplemd', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'simplemd_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'simplemd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simplemd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simplemd_content_width', 640 );
}
add_action( 'after_setup_theme', 'simplemd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simplemd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'simplemd' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'simplemd' ),
			'before_widget' => '<div id="%1$s" class="mdui-panel-item mdui-panel-item-open widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="mdui-panel-item-header widget-title">',
			'after_title'   => '</div><div class="mdui-panel-item-body mdui-typo">',
		)
	);
}

add_action( 'widgets_init', 'simplemd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simplemd_scripts() {
	wp_enqueue_style( 'simplemd-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'mdui', get_template_directory_uri() . '/libs/mdui-v1.0.0/css/mdui.min.css', array(), _S_VERSION, false );
	wp_enqueue_style( 'prism', "https://cdn.jsdelivr.net/npm/prismjs/themes/prism.min.css" );
	wp_enqueue_style( 'prism-line', "https://cdn.jsdelivr.net/npm/prismjs@1.17.1/plugins/line-numbers/prism-line-numbers.min.css" );
	wp_enqueue_style( 'lightgallery', "https://cdn.jsdelivr.net/npm/lightgallery@1.6.12/dist/css/lightgallery.min.css" );


	// wp_style_add_data( 'simplemd-style', 'rtl', 'replace' );
	wp_enqueue_script("jquery");
	wp_enqueue_script( 'mdui', get_template_directory_uri() . '/libs/mdui-v1.0.0/js/mdui.min.js', array(), _S_VERSION, false );

	wp_enqueue_script( 'mathjax-config', get_template_directory_uri() . '/js/mathjax.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'highlight-config', get_template_directory_uri() . '/js/highlight.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), _S_VERSION, true );

	wp_enqueue_script( 'mathjax',  "https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js", array( 'mathjax-config' ) );
	wp_enqueue_script( 'prism',  "https://cdn.jsdelivr.net/npm/prismjs/prism.min.js" );
	wp_enqueue_script( 'prism-core',  "https://cdn.jsdelivr.net/npm/prismjs/components/prism-core.min.js" );
	wp_enqueue_script( 'prism-line',  "https://cdn.jsdelivr.net/npm/prismjs/plugins/line-numbers/prism-line-numbers.min.js" );
	wp_enqueue_script( 'prism-autoloader',  "https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js" );
	wp_enqueue_script( 'lightgallery',  "https://cdn.jsdelivr.net/npm/lightgallery@1.6.12/dist/js/lightgallery-all.min.js" );
	wp_enqueue_script( 'nicescrool',  "https://cdn.jsdelivr.net/npm/jquery.nicescroll@3.7.6/jquery.nicescroll.min.js" );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simplemd_scripts' );

function format_comment($comment, $args, $depth) { ?>
        <li <?php comment_class( 'comment-li' ); ?> id="comment-<?php comment_ID() ?>">
            <div class="comment-intro">
				<?php echo get_avatar( get_comment_author_email(), 48 ); ?>
				<div class="comment-intro-details">
					<div class="comment-author-link">
						<?php echo get_comment_author_link(); ?>
					</div>
					<div class="comment-permalink"><?php echo get_comment_date() . ' ' . get_comment_time() ?></div>
				</div>
            </div>
            
            <?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
            <?php endif; ?>
            
            <?php comment_text(); ?>
            
            <div class="reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
		</li>
<?php } 

function simplemd_comment_form_fileds( $fileds ) {
	$commenter     = wp_get_current_commenter();
	$fileds['email'] = '
		<div class="mdui-textfield mdui-textfield-floating-label">
			<i class="mdui-icon material-icons">email</i>
			<label class="mdui-textfield-label">Email*</label>
			<input required id="email" name="email" type="email" class="mdui-textfield-input"
					value="' . esc_attr( $commenter['comment_author_email'] ) . '"/>
			<div class="mdui-textfield-error">Please input email address.</div>
		</div>';
	$fileds['author'] = '
		<div class="mdui-textfield mdui-textfield-floating-label">
			<i class="mdui-icon material-icons">account_circle</i>
			<label class="mdui-textfield-label">Name*</label>
			<input required id="author" name="author" type="author" class="mdui-textfield-input"
					value="' . esc_attr( $commenter['comment_author'] ) . '"/>
			<div class="mdui-textfield-error">Please input name.</div>
		</div>';
	$fileds['url'] = '
		<div class="mdui-textfield mdui-textfield-floating-label">
			<i class="mdui-icon material-icons">links</i>
			<label class="mdui-textfield-label">Website</label>
			<input id="url" name="url" type="url" class="mdui-textfield-input"
					value="' . esc_attr( $commenter['comment_author_url'] ) . '"/>
		</div>';
	$fileds['cookies'] = '
		<div id="cookies-checker" class="mdui-container">
			<label class="mdui-switch">
				<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox"/>
				<i class="mdui-switch-icon"></i>
				<span>Save my name, email, and website in this browser for the next time I comment.</span>
			</label>
		</div>';
	return $fileds;
}

add_filter('comment_form_default_fields','simplemd_comment_form_fileds');


function simplemd_pagenavi() {  
	global $wp_query,$wp_rewrite;  
	$wp_query->query_vars['paged'] > 1 ?$current=$wp_query->query_vars['paged'] :$current= 1;  
	$pagination=array(  
		'base'=> @add_query_arg('paged','%#%'),  
		'format'=>'',  
		'total'=>$wp_query->max_num_pages,  
		'current'=>$current,  
		'show_all'=> false,  
		'type'=>'plain',  
		'end_size'=>'2',
		'mid_size'=>'1',
		'prev_text'=>'<i class="mdui-icon material-icons">chevron_left</i>',  
		'next_text'=>'<i class="mdui-icon material-icons">chevron_right</i>'  
	);  
	if( $wp_rewrite -> using_permalinks() )  
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) .'page/%#%/','paged');  
	if( !empty($wp_query->query_vars['s']) )  
		$pagination['add_args'] =array('s'=>get_query_var('s'));  
	$output = '<div class="navigation posts-navigation mdui-btn-group">' . paginate_links($pagination) . '</div>';
	$output = str_replace( '<span class="page-numbers dots">', '<span class="page-numbers dots mdui-btn mdui-btn-dense mdui-ripple" disabled>', $output );
	$output = str_replace( 'aria-current="page"', 'aria-current="page" disabled', $output );
	$output = str_replace( '"next page-numbers"', '"page-numbers next mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple"', $output );
	$output = str_replace( '"prev page-numbers"', '"page-numbers prev mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple"', $output );
	$output = str_replace( '"page-numbers current"', '"page-numbers current mdui-btn mdui-btn-dense mdui-ripple"', $output );
	$output = str_replace( '"page-numbers"', '"page-numbers mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple"', $output );
	echo $output;
}  

// Creating the widget 
class hitokoto_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'hitokoto_widget', 
			__('Hitokoto Widget', 'hitokoto_widget_domain'), 
			array( 'description' => __( 'Hitokoto', 'hitokoto_widget_domain' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		$hitokoto_id = "hitokoto-" . mt_rand();
?>
	<div id="<?php printf( "%s", $hitokoto_id ); ?>" class="hitokoto-card">
		<div class="mdui-spinner mdui-center hitokoto-loading"></div>
		<blockquote class="hitokoto">
			<p class="hitokoto-content"></p>
			<footer class="hitokoto-from"></footer>
		</blockquote>
	</div>
	<script> 
		jQuery.get('https://hitokoto.woshiluo.com/', function (data) {
			if (typeof data === 'string') data = JSON.parse(data);
			let selector = jQuery( "#<?php printf( "%s", $hitokoto_id ); ?>" );
			selector.find('.hitokoto-loading').css('display', 'none').removeClass('mdui-center');
			selector = selector.find('.hitokoto');
			selector.css('display', 'block');
			selector.find('.hitokoto-content').css('display', '').text(data.hitokoto);
			if (data.source) {
				selector.find('.hitokoto-from').css('display', '').text( '「' + data.source + '」' );
			}
		});
	</script>
<?php

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Hitokoto', 'hitokoto_widget_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} 


// Register and load the widget
function hitokoto_load_widget() {
	register_widget( 'hitokoto_widget' );
}
add_action( 'widgets_init', 'hitokoto_load_widget' );

require get_template_directory() . '/custom-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
