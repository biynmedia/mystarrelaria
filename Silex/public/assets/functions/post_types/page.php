<?php
//
// Page listing template meta box
//

add_action('admin_init', 'ci_add_page_listing_meta');
add_action('save_post', 'ci_update_page_listing_meta');

if ( ! function_exists( 'ci_add_page_listing_meta' ) ):
	function ci_add_page_listing_meta() {
		add_meta_box( 'ci_page_columns_listing_meta', __( 'Listing Options', 'ci_theme' ), 'ci_add_page_columns_listing_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'ci_page_front_template_meta', __( 'Frontpage Options', 'ci_theme' ), 'ci_add_page_frontpage_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'ci_add_page_hero_background_meta', __( 'Hero Background Options', 'ci_theme' ), 'ci_add_page_hero_background_meta_box', 'page', 'normal', 'high' );
	}
endif;

if( !function_exists('ci_update_page_listing_meta') ):
function ci_update_page_listing_meta($post_id) {
	if ( !ci_can_save_meta('page') ) return;

	update_post_meta( $post_id, 'listing_columns', intval( $_POST['listing_columns'] ) );
	update_post_meta( $post_id, 'listing_isotope', ci_sanitize_checkbox( $_POST['listing_isotope'] ) );
	update_post_meta( $post_id, 'listing_posts_per_page', intval( $_POST['listing_posts_per_page'] ) );

	update_post_meta( $post_id, 'base_slider_category', intval( $_POST['base_slider_category'] ) );

	update_post_meta( $post_id, 'hero_bg_color', sanitize_hex_color( $_POST['hero_bg_color'] ) );
	update_post_meta( $post_id, 'hero_image_id', ci_theme_sanitize_intval_or_empty( $_POST['hero_image_id'] ) );
	update_post_meta( $post_id, 'hero_image_repeat', ci_theme_sanitize_image_repeat( $_POST['hero_image_repeat'] ) );
	update_post_meta( $post_id, 'hero_image_position_x', ci_theme_sanitize_image_position_x( $_POST['hero_image_position_x'] ) );
	update_post_meta( $post_id, 'hero_image_position_y', ci_theme_sanitize_image_position_y( $_POST['hero_image_position_y'] ) );
	update_post_meta( $post_id, 'hero_image_attachment', ci_theme_sanitize_image_attachment( $_POST['hero_image_attachment'] ) );
	update_post_meta( $post_id, 'hero_image_cover', isset( $_POST['hero_image_cover'] ) ? 1 : 0 );
}
endif;

if ( ! function_exists( 'ci_add_page_columns_listing_meta_box' ) ):
function ci_add_page_columns_listing_meta_box( $object, $box ) {
	ci_prepare_metabox( 'page' );

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( '' );
			$options = array();
			for ( $i = 2; $i <= 4; $i ++ ) {
				$options[ $i ] = sprintf( _n( '1 Column', '%s Columns', $i, 'ci_theme' ), $i );
			}
			ci_metabox_dropdown( 'listing_columns', $options, __( 'Listing columns:', 'ci_theme' ) );
			ci_metabox_checkbox( 'listing_isotope', 'on', __( 'Isotope effect (ignores <em>Items per page</em> setting.', 'ci_theme' ) );
			ci_metabox_guide( sprintf( __( 'Set the number of items per page that you want to display. Setting this to <strong>-1</strong> will show <strong>all items</strong>>, while setting it to zero or leaving it empty, will follow the global option set from <em>Settings -> Reading</em>, currently set to <strong>%s items per page</strong>.', 'ci_theme' ), get_option( 'posts_per_page' ) ) );
			ci_metabox_input( 'listing_posts_per_page', __( 'Items per page:', 'ci_theme' ) );
		ci_metabox_close_tab();
	?></div><?php

	ci_bind_metabox_to_page_template( 'ci_page_columns_listing_meta', array(
		'template-artists.php',
		'template-discography.php',
		'template-galleries.php',
		'template-videos.php',
	), 'columns_listing_metabox' );
}
endif;

if ( ! function_exists( 'ci_add_page_frontpage_meta_box' ) ):
function ci_add_page_frontpage_meta_box( $object, $box ) {
	ci_prepare_metabox( 'page' );

	$category = get_post_meta( $object->ID, 'base_slider_category', true );

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( '' );
			ci_metabox_guide( __( "Select the base slideshow category. Only items of the selected category will be displayed. If you don't select one (i.e. empty) slides from all categories will be shown.", 'ci_theme' ) );
			?><p><label for="base_slider_category"><?php _e( 'Base category:', 'ci_theme' ); ?></label> <?php
			wp_dropdown_categories( array(
				'selected'         => $category,
				'id'               => 'base_slider_category',
				'name'             => 'base_slider_category',
				'show_option_none' => ' ',
				'taxonomy'         => 'slider-category',
				'hierarchical'     => 1,
				'show_count'       => 1,
				'hide_empty'       => 0
			) );
			?></p><?php
		ci_metabox_close_tab();
	?></div><?php

	ci_bind_metabox_to_page_template( 'ci_page_front_template_meta', array(
		'template-frontpage1.php',
		'template-frontpage2.php',
		'template-frontpage3.php',
		'template-frontpage4.php',
	), 'page_front_template_metabox' );
}
endif;

if ( ! function_exists( 'ci_add_page_hero_background_meta_box' ) ):
function ci_add_page_hero_background_meta_box( $object, $box ) {
	ci_prepare_metabox( 'page' );

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( '' );

			$hero_image_id = get_post_meta( $object->ID, 'hero_image_id', true );

			?>
			<p class="ci-field-group ci-field-input">
				<?php ci_metabox_input( 'hero_bg_color', esc_html__( 'Background Color:', 'ci-theme-plugin' ), array( 'input_class' => 'ci-theme-color-picker widefat', 'before' => '', 'after' => '' ) ); ?>
			</p>

			<div class="ci-field-group ci-field-input">
				<label for="header_image_id"><?php esc_html_e( 'Hero image:', 'ci-theme-plugin' ); ?></label>
				<div class="ci-upload-preview">
					<div class="upload-preview">
						<?php if ( ! empty( $hero_image_id ) ) : ?>
							<?php
								$image_url = wp_get_attachment_image_url( $hero_image_id, 'thumbnail' );
								echo sprintf( '<img src="%s" /><a href="#" class="close media-modal-icon" title="%s"></a>',
									esc_url( $image_url ),
									esc_attr__( 'Remove image', 'ci-theme-plugin' )
								);
							?>
						<?php endif; ?>
					</div>
					<input name="hero_image_id" type="hidden" class="ci-uploaded-id" value="<?php echo esc_attr( $hero_image_id ); ?>" />
					<input id="hero_image_id" type="button" class="button ci-media-button" value="<?php esc_attr_e( 'Select Image', 'ci-theme-plugin' ); ?>" />
				</div>
			</div>
			<?php

			ci_metabox_dropdown( 'hero_image_repeat', ci_theme_get_image_repeat_choices(), esc_html__( 'Image repeat:', 'ci-theme-plugin' ), array( 'default' => 'no-repeat' ) );
			ci_metabox_dropdown( 'hero_image_position_x', ci_theme_get_image_position_x_choices(), esc_html__( 'Image horizontal position:', 'ci-theme-plugin' ), array( 'default' => 'center' ) );
			ci_metabox_dropdown( 'hero_image_position_y', ci_theme_get_image_position_y_choices(), esc_html__( 'Image vertical position:', 'ci-theme-plugin' ), array( 'default' => 'center' ) );
			ci_metabox_dropdown( 'hero_image_attachment', ci_theme_get_image_attachment_choices(), esc_html__( 'Image attachment:', 'ci-theme-plugin' ), array( 'default' => 'scroll' ) );
			ci_metabox_checkbox( 'hero_image_cover', 1, esc_html__( 'Scale the image to cover its container.', 'ci-theme-plugin' ), array( 'default' => 1 ) );

		ci_metabox_close_tab();
	?></div><?php
}
endif;
