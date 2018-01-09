<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_google_options', 100);
	if( !function_exists('ci_add_tab_google_options') ):
		function ci_add_tab_google_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Google Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet( 'google_analytics' );
	load_panel_snippet( 'google_maps_api' );
	$ci_defaults['map_styles'] = '';

?>
<?php else: ?>

	<?php load_panel_snippet( 'google_analytics' ); ?>
	<?php load_panel_snippet( 'google_maps_api' ); ?>


	<fieldset class="set">
		<legend><?php _e( 'Map Styles', 'ci_theme' ); ?></legend>
		<p class="guide"><?php _e('Paste a custom Google Maps styles object below to give the events map a unique look. You can either create one or use a service like <a href="https://snazzymaps.com" target="_blank">snazzymaps.com</a> and paste your design.', 'ci_theme'); ?></p>
		<?php
			ci_panel_textarea( 'map_styles', __( 'Google Maps styles object', 'ci_theme' ) );
		?>
	</fieldset>

<?php endif; ?>