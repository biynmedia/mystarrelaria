jQuery(document).ready(function($) {
	$('.ci-theme-color-picker').wpColorPicker();

	$( "#ci_cpt_discography_date" ).datepicker({
		dateFormat: 'yy-mm-dd'
	});

	//
	// Events
	//
	$( "#ci_cpt_events_date" ).datepicker({
		dateFormat: 'yy-mm-dd'
	});

	$( "#ci_cpt_events_time" ).timepicker({
		ampm: false,
		timeFormat: 'HH:mm',
		stepMinute: 5
	});

	var isEnabled = $('#ci_cpt_event_recurrent').prop('checked');
	var datetime = $('#event_datetime');
	var recurrent = $('#event_recurrent');

	if (isEnabled) { 
		datetime.hide();
		recurrent.show(); 
	} 
	else { 
		datetime.show();
		recurrent.hide(); 
	}

	$('#ci_cpt_event_recurrent').click(function(){
		var datetime = $('#event_datetime');
		var recurrent = $('#event_recurrent');
		if ($(this).prop('checked')) {
			datetime.hide();
			recurrent.show(); 
		}
		else {
			datetime.show();
			recurrent.hide(); 
		}
	});


	//
	// Discography tracks (repeating fields)
	//
	$('#ci_repeating_tracks .tracks').sortable({
		update: renumberTracks
	});


	// Repeating fields
	_sortable();

	var repeating_fields = $('.ci-repeating-fields');
	repeating_fields.each(function(){
		var add_field = $(this).find('.ci-repeating-add-field');
		add_field.click(function(){
			var repeatable_area = $(this).siblings('.inner');
			var fields = repeatable_area.children('.field-prototype').clone(true).removeClass('field-prototype').removeAttr('style').appendTo(repeatable_area);
			renumberTracks();
			return false;
		});
	})

	$('body').on('click', '.ci-repeating-remove-field', function() {
		var field = $(this).parents('.post-field');
		field.remove();
		renumberTracks();
		return false;
	});


	function renumberTracks() {
		var $i = 1;
		var $tbody = $( "table.tracks" ).find( "tbody:not(.field-prototype)" );

		$tbody.each( function() {
			$( this ).find( ".track-num" ).text( $i );
			$i++;
		} );
	}

	//
	// Media Manager links
	//
	$( 'body' ).on( 'click', '.ci-media-button', function( e ) {
		e.preventDefault();

		var ciButton = $( this );

		var target_id      = ciButton.siblings( '.ci-uploaded-id' );
		var target_url     = ciButton.siblings( '.ci-uploaded-url' );
		var target_preview = ciButton.siblings( '.upload-preview' );

		var bMulti = ciButton.data( 'multi' ); // Although data-multi="true" works, it's not handled.
		var bFrame = ciButton.data( 'frame' );

		if( typeof bMulti == 'undefined' ) {
			bMulti = false;
		}
		if( typeof bFrame == 'undefined' ) {
			bFrame = 'select';
		}

		var ciMediaUpload = wp.media( {
			frame: bFrame, // Only 'post' and 'select' seem to work with the set of options below.
			title: bMulti == true ? 'Select files' : 'Select file',
			button: {
				text: bMulti == true ? 'Use these files' : 'Use this file'
			},
			multiple: bMulti
		} ).on( 'select', function(){
			// grab the selected images object
			var selection = ciMediaUpload.state().get( 'selection' );

			// grab object properties for each image
			selection.map( function( attachment ){
				var attachment = attachment.toJSON();
				/*
				// Properties exposed
				alt: "",
				author: "2",
				authorName: "Anastis",
				caption: "",
				date: 1441717373000,
				dateFormatted: "September 8, 2015",
				editLink:"http://.../wp-admin/post.php?post=181&action=edit",
				filename: "las-erinias-fotoviajero.jpg",
				filesizeHumanReadable: "63 kB",
				filesizeInBytes: 64881,
				height: 600,
				icon:"http://.../wp-includes/images/media/default.png",
				id: 181,
				link: "http://.../las-erinias-fotoviajero/",
				menuOrder: 0,
				meta: false,
				modified: 1441717373000,
				name: "las-erinias-fotoviajero",
				orientation: "portrait",
				sizes:Object {
					full:Object {
						height:600,
						orientation:"portrait",
						url:"http://.../las-erinias-fotoviajero.jpg",
						width:504
					},
					medium:Object {
						height:300,
						orientation:"portrait",
						url:"http://.../las-erinias-fotoviajero-252x300.jpg"
						width:252
					},
					...
				},
				status:"inherit",
				subtype:"jpeg",
				title:"las-erinias-fotoviajero",
				type:"image",
				uploadedTo:66,
				uploadedToLink:"http://.../wp-admin/post.php?post=66&action=edit",
				uploadedToTitle:"Manchester City needs huge performance against Barcelona",
				uploading:false,
				url:"http://.../las-erinias-fotoviajero.jpg",
				width:504,
				*/

				if( bMulti == false ) {
					if( target_id.length > 0 ) {
						target_id.val( attachment.id ).trigger( 'change' );
					}
					if( target_url.length > 0 ) {
						target_url.val( attachment.url ).trigger( 'change' );
					}
					if( target_preview.length > 0 ) {
						// For some reason, attachment.sizes doesn't include additional image sizes.
						// Only 'thumbnail', 'medium' and 'full' are exposed, so we use 'thumbnail' instead of 'ci_theme_plugin_featgal_small_thumb'
						var html = '<img src="' + attachment.sizes.thumbnail.url + '" /><a href="#" class="close media-modal-icon" title="Remove image"></a>';
						target_preview.html( html );
					}
				}
			});
		} ).open();
	}); // on click

	$( 'body' ).on( 'click', '.ci-upload-preview a.close', function( e ) {
		e.preventDefault();
		$( this ).parent().html( '' ).siblings('.ci-uploaded-id' ).val('');
	} );
});

_sortable = function() {
	jQuery('.ci-repeating-fields .inner').sortable({ placeholder: 'ui-state-highlight' });
}
