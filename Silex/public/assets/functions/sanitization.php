<?php
/**
 * Generic sanitization functions.
 */

/**
 * Sanitizes integer input while differentiating zero from empty string.
 *
 * @param int|string $input Input value to sanitize.
 * @return int|string Integer value, 0, or an empty string otherwise.
 */
function ci_theme_sanitize_intval_or_empty( $input ) {
	if ( false === $input || '' === $input || is_null( $input ) ) {
		return '';
	}

	if ( 0 === intval( $input ) ) {
		return 0;
	}

	return intval( $input );
}

function ci_theme_get_text_align_choices() {
	return apply_filters( 'ci_theme_text_align_choices', array(
		'left'   => esc_html__( 'Left', 'ci-theme-plugin' ),
		'center' => esc_html__( 'Center', 'ci-theme-plugin' ),
		'right'  => esc_html__( 'Right', 'ci-theme-plugin' ),
	) );
}

function ci_theme_sanitize_text_align( $value ) {
	$choices = ci_theme_get_text_align_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'ci_theme_sanitize_text_align_default', 'left' );
}

function ci_theme_get_image_repeat_choices() {
	return apply_filters( 'ci_theme_image_repeat_choices', array(
		'no-repeat' => esc_html__( 'No repeat', 'ci-theme-plugin' ),
		'repeat'    => esc_html__( 'Tile', 'ci-theme-plugin' ),
		'repeat-x'  => esc_html__( 'Tile Horizontally', 'ci-theme-plugin' ),
		'repeat-y'  => esc_html__( 'Tile Vertically', 'ci-theme-plugin' ),
	) );
}

function ci_theme_sanitize_image_repeat( $value ) {
	$choices = ci_theme_get_image_repeat_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'ci_theme_sanitize_image_repeat_default', 'no-repeat' );
}

function ci_theme_get_image_position_x_choices() {
	return apply_filters( 'ci_theme_image_position_x_choices', array(
		'left'   => esc_html__( 'Left', 'ci-theme-plugin' ),
		'center' => esc_html__( 'Center', 'ci-theme-plugin' ),
		'right'  => esc_html__( 'Right', 'ci-theme-plugin' ),
	) );
}

function ci_theme_sanitize_image_position_x( $value ) {
	$choices = ci_theme_get_image_position_x_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'ci_theme_sanitize_image_position_x_default', 'center' );
}

function ci_theme_get_image_position_y_choices() {
	return apply_filters( 'ci_theme_image_position_y_choices', array(
		'top'    => esc_html__( 'Top', 'ci-theme-plugin' ),
		'center' => esc_html__( 'Center', 'ci-theme-plugin' ),
		'bottom' => esc_html__( 'Bottom', 'ci-theme-plugin' ),
	) );
}

function ci_theme_sanitize_image_position_y( $value ) {
	$choices = ci_theme_get_image_position_y_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'ci_theme_sanitize_image_position_y_default', 'center' );
}

function ci_theme_get_image_attachment_choices() {
	return apply_filters( 'ci_theme_image_attachment_choices', array(
		'scroll' => esc_html__( 'Scroll', 'ci-theme-plugin' ),
		'fixed'  => esc_html__( 'Fixed', 'ci-theme-plugin' ),
	) );
}

function ci_theme_sanitize_image_attachment( $value ) {
	$choices = ci_theme_get_image_attachment_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'ci_theme_sanitize_image_attachment_default', 'scroll' );
}

function ci_theme_sanitize_rgba_color( $str, $return_hash = true, $return_fail = '' ) {
	if ( false === $str || empty( $str ) || 'false' === $str ) {
		return $return_fail;
	}

	// Allow keywords and predefined colors
	if ( in_array( $str, array( 'transparent', 'initial', 'inherit', 'black', 'silver', 'gray', 'grey', 'white', 'maroon', 'red', 'purple', 'fuchsia', 'green', 'lime', 'olive', 'yellow', 'navy', 'blue', 'teal', 'aqua', 'orange', 'aliceblue', 'antiquewhite', 'aquamarine', 'azure', 'beige', 'bisque', 'blanchedalmond', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgrey', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkslategrey', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dimgrey', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'greenyellow', 'grey', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgray', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightslategrey', 'lightsteelblue', 'lightyellow', 'limegreen', 'linen', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'oldlace', 'olivedrab', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'skyblue', 'slateblue', 'slategray', 'slategrey', 'snow', 'springgreen', 'steelblue', 'tan', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'whitesmoke', 'yellowgreen', 'rebeccapurple' ), true ) ) {
		return $str;
	}

	preg_match( '/rgba\(\s*(\d{1,3}\.?\d*\%?)\s*,\s*(\d{1,3}\.?\d*\%?)\s*,\s*(\d{1,3}\.?\d*\%?)\s*,\s*(\d{1}\.?\d*\%?)\s*\)/', $str, $rgba_matches );
	if ( ! empty( $rgba_matches ) && 5 === count( $rgba_matches ) ) {
		for ( $i = 1; $i < 4; $i++ ) {
			if ( strpos( $rgba_matches[ $i ], '%' ) !== false ) {
				$rgba_matches[ $i ] = ci_theme_sanitize_0_100_percent( $rgba_matches[ $i ] );
			} else {
				$rgba_matches[ $i ] = ci_theme_sanitize_0_255( $rgba_matches[ $i ] );
			}
		}
		$rgba_matches[4] = ci_theme_sanitize_0_1_opacity( $rgba_matches[ $i ] );
		return sprintf( 'rgba(%s, %s, %s, %s)', $rgba_matches[1], $rgba_matches[2], $rgba_matches[3], $rgba_matches[4] );
	}

	// Not a color function either. Let's see if it's a hex color.

	// Include the hash if not there.
	// The regex below depends on in.
	if ( substr( $str, 0, 1 ) !== '#' ) {
		$str = '#' . $str;
	}

	preg_match( '/(#)([0-9a-fA-F]{6})/', $str, $matches );

	if ( 3 === count( $matches ) ) {
		if ( $return_hash ) {
			return $matches[1] . $matches[2];
		} else {
			return $matches[2];
		}
	}

	return $return_fail;
}

function ci_theme_sanitize_0_100_percent( $val ) {
	$val = str_replace( '%', '', $val );
	if ( floatval( $val ) > 100 ) {
		$val = 100;
	} elseif ( floatval( $val ) < 0 ) {
		$val = 0;
	}

	return floatval( $val ) . '%';
}

function ci_theme_sanitize_0_255( $val ) {
	if ( intval( $val ) > 255 ) {
		$val = 255;
	} elseif ( intval( $val ) < 0 ) {
		$val = 0;
	}

	return intval( $val );
}

function ci_theme_sanitize_0_1_opacity( $val ) {
	if ( floatval( $val ) > 1 ) {
		$val = 1;
	} elseif ( floatval( $val ) < 0 ) {
		$val = 0;
	}

	return floatval( $val );
}
