<?php
add_action('init', 'ci_register_theme_styles');
if( !function_exists('ci_register_theme_styles') ):
function ci_register_theme_styles()
{
	//
	// Register all front-end and admin styles here. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//

	wp_register_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic' );
	wp_register_style( 'google-font-lato-poppins', '//fonts.googleapis.com/css?family=Lato:400,700,900,400italic|Poppins:300,500,700' );
	wp_register_style( 'ci-base', get_child_or_parent_file_uri( '/css/base.css' ) );
	wp_register_style( 'mmenu', get_child_or_parent_file_uri( '/css/mmenu.css' ) );
	wp_register_style( 'flexslider', get_child_or_parent_file_uri( '/css/flexslider.css' ) );
	wp_register_style( 'magnific', get_child_or_parent_file_uri( '/css/magnific.css' ) );
	wp_register_style( 'font-awesome', get_child_or_parent_file_uri( '/css/font-awesome.css' ) );
	wp_register_style( 'jquery-ui-style', get_child_or_parent_file_uri( '/css/jquery-ui.css' ), array(), '1.10.4' );
	wp_register_style( 'jquery-ui-timepicker', get_child_or_parent_file_uri( '/css/jquery-ui-timepicker-addon.css' ) );	

	wp_register_style( 'ci-repeating-fields', get_child_or_parent_file_uri( '/css/repeating-fields.css' ) );
	wp_register_style( 'ci-post-edit-screens', get_child_or_parent_file_uri( '/css/post_edit_screens.css' ), array(
		'ci-repeating-fields',
		'wp-color-picker',
	) );

	wp_register_style( 'ci-color-scheme', get_child_or_parent_file_uri( '/colors/' . ci_setting( 'stylesheet' ) ) );

	wp_register_style( 'ci-theme-dependencies', false, array(
		'flexslider',
		'font-awesome',
		'magnific',
		'mmenu',
		'wp-mediaelement',
		'ci-base',
		'dashicons',
	), CI_THEME_VERSION );

	if ( is_child_theme() ) {
		wp_register_style( 'ci-theme-style-parent', get_template_directory_uri() . '/style.css', array(
			'ci-theme-dependencies',
		), CI_THEME_VERSION );
	}

	wp_register_style( 'ci-style', get_stylesheet_uri(), array(
		'ci-theme-dependencies',
	), CI_THEME_VERSION );


}
endif;


add_action('wp_enqueue_scripts', 'ci_enqueue_theme_styles');
if( !function_exists('ci_enqueue_theme_styles') ):
function ci_enqueue_theme_styles()
{
	//
	// Enqueue all (or most) front-end styles here.
	//
	if ( wp_style_is( 'woocommerce_prettyPhoto_css', 'enqueued' ) ) {
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	}

	if ( is_child_theme() ) {
		wp_enqueue_style( 'ci-theme-style-parent' );
	}

	$color_scheme = ci_setting( 'stylesheet' );

	if ( strpos( $color_scheme, 'modern' ) !== false ) {
		wp_enqueue_style( 'google-font-lato-poppins' );
	} else {
		wp_enqueue_style( 'google-font-lato' );
	}

	wp_enqueue_style( 'ci-style' );
	wp_enqueue_style( 'ci-color-scheme' );


	remove_action( 'ci_custom_header_background', 'ci_custom_header_background_handler' );

	ob_start();
	ci_custom_header_background_handler( ci_panel_get_custom_background_values( 'header' ) );
	$panel_header_css = ob_get_clean();

	wp_add_inline_style( 'ci-style', $panel_header_css );
	wp_add_inline_style( 'ci-style', ci_theme_base_get_hero_styles() );
}
endif;


if( !function_exists('ci_enqueue_admin_theme_styles') ):
add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_styles');
function ci_enqueue_admin_theme_styles() 
{
	global $pagenow, $typenow;

	//
	// Enqueue here styles that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here styles that are to be loaded only on CSSIgniter Settings panel.
		//
	}

}
endif;
