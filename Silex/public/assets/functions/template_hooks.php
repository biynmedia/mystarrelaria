<?php
// Change default color scheme to modern, for new installations only.
add_filter( 'ci_theme_panel_default_stylesheet', 'ci_theme_panel_change_default_stylesheet' );
function ci_theme_panel_change_default_stylesheet( $stylesheet ) {
	return 'modern_default.css';
}


add_filter( 'ci_panel_menu_title', 'ci_theme_panel_menu_title_change', 10, 2 );
if ( ! function_exists( 'ci_theme_panel_menu_title_change' ) ):
function ci_theme_panel_menu_title_change( $menu_title, $whitelabeled ) {
	// We always want it to say "Theme Settings", independently of white-label status.
	return __( 'Theme Settings', 'ci_theme' );
}
endif;

add_action( 'template_redirect', 'ci_content_width' );
if ( ! function_exists( 'ci_content_width' ) ):
function ci_content_width() {
	if ( is_page_template( 'template-fullwidth.php' ) ) {
		global $content_width;
		$content_width = 1140;
	}
}
endif;

add_filter( 'gallery_widget_content_width', 'ci_jetpack_gallery_widget_content_width' );
if ( ! function_exists( 'ci_jetpack_gallery_widget_content_width' ) ):
function ci_jetpack_gallery_widget_content_width() {
	return 360;
}
endif;

add_filter( 'body_class', 'ci_body_class_color_scheme_group', 20 );
if ( ! function_exists( 'ci_body_class_color_scheme_group' ) ):
function ci_body_class_color_scheme_group( $classes ) {
	$ci_classes = array();
	$scheme     = $classes['theme_color_scheme'];

	if ( substr_left( $scheme, 10 ) == 'ci-scheme-' ) {
		$scheme = str_replace( 'ci-scheme-', '', $scheme );

		if ( substr_left( $scheme, 6 ) == 'white_' ) {
			$ci_classes['theme_color_scheme_group'] = 'ci-light-scheme';
		} else {
			$ci_classes['theme_color_scheme_group'] = 'ci-dark-scheme';
		}
	}

	return array_merge( $classes, $ci_classes );
}
endif;

add_filter( 'ci_automatic_video_thumbnail_field', 'ci_theme_automatic_video_thumbnail_field' );
if ( ! function_exists( 'ci_theme_automatic_video_thumbnail_field' ) ):
function ci_theme_automatic_video_thumbnail_field() {
	return 'ci_cpt_videos_url';
}
endif;

add_filter( 'ci_footer_credits', 'ci_theme_footer_credits' );
if ( ! function_exists( 'ci_theme_footer_credits' ) ) :
function ci_theme_footer_credits( $string ) {
	return '';
}
endif;

add_filter( 'ci_footer_credits_secondary', 'ci_theme_footer_credits_secondary' );
if ( ! function_exists( 'ci_theme_footer_credits_secondary' ) ) :
function ci_theme_footer_credits_secondary( $string ) {
	return '';
}
endif;

// Enable custom header background
add_ci_theme_support( 'custom_header_background' );

function ci_theme_header_bg_element() {
	return '.section-title-wrap .section-title';
}

add_filter( 'ci_custom_header_background_applied_element', 'ci_theme_header_bg_element' );
