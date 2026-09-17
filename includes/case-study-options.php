<?php
/**
 * Case study options — the portrait cover used in listings.
 *
 * The featured image stays landscape on purpose. It is the banner at the top of
 * the case study and the image Open Graph hands to Facebook and LinkedIn, and
 * both of those want a wide crop.
 *
 * The listing grid wants the opposite. 'case-study-list' is a hard 536x670
 * portrait crop, so a landscape featured image gets its sides sliced off and
 * usually loses its subject with them.
 *
 * This box adds a second, optional image used only by the listing cards — the
 * case studies archive, the category archives and the "More case studies" rows.
 * Left empty, the cards fall back to the featured image, so every case study
 * that already looks right keeps looking right and nothing has to be refilled.
 *
 * A native meta box rather than a Secure Custom Fields group, matching
 * includes/post-options.php: it ships with the theme, keeps working if the
 * plugin is deactivated, and stays in version control next to the templates
 * that read it. The meta key is underscore-prefixed so it stays out of the
 * Custom Fields panel.
 */

if ( ! defined( 'BP_CASE_STUDY_COVER_KEY' ) ) {
	define( 'BP_CASE_STUDY_COVER_KEY', '_bp_case_study_cover_id' );
}


/**
 * Register the box on case studies only, in the sidebar under Featured image.
 */
function bp_add_case_study_options_meta_box() {
	add_meta_box(
		'bp_case_study_options',
		__( 'Listing cover image', 'beepossible' ),
		'bp_render_case_study_options_meta_box',
		'case-study',
		'side'
	);
}
add_action( 'add_meta_boxes', 'bp_add_case_study_options_meta_box' );


/**
 * The media modal is not loaded on an editor screen by default. Only pull it in
 * on a case study, rather than on every post type that will never show the box.
 */
function bp_case_study_options_admin_assets( $hook ) {
	if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( ! $screen || 'case-study' !== $screen->post_type ) {
		return;
	}

	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'bp_case_study_options_admin_assets' );


/**
 * Attachment id in a hidden field, with a thumbnail so the choice is visible
 * without opening the modal again.
 */
function bp_render_case_study_options_meta_box( $post ) {
	wp_nonce_field( 'bp_save_case_study_options', 'bp_case_study_options_nonce' );

	$cover_id = bp_case_study_cover_id( $post->ID );
	$preview  = $cover_id
		? wp_get_attachment_image( $cover_id, 'medium', false, [ 'style' => 'max-width:100%;height:auto;display:block;border-radius:4px;' ] )
		: '';
	?>
	<p class="description" style="margin-top:0;">
		<?php esc_html_e( 'Portrait image for the case studies archive and the "More case studies" rows. Cropped to 536 × 670, so upload it taller than it is wide. Leave empty to use the featured image.', 'beepossible' ); ?>
	</p>

	<div data-bp-cover>
		<div data-bp-cover-preview style="margin-bottom:.5rem;"><?php echo $preview; ?></div>

		<input type="hidden" name="bp_case_study_cover_id" value="<?php echo esc_attr( $cover_id ); ?>" data-bp-cover-input>

		<p>
			<button type="button" class="button" data-bp-cover-select><?php esc_html_e( 'Select image', 'beepossible' ); ?></button>
			<button type="button" class="button-link delete" data-bp-cover-remove<?php echo $cover_id ? '' : ' hidden'; ?>><?php esc_html_e( 'Remove', 'beepossible' ); ?></button>
		</p>
	</div>

	<script>
	jQuery( function ( $ ) {
		$( '[data-bp-cover]' ).each( function () {
			var box     = $( this ),
			    input   = box.find( '[data-bp-cover-input]' ),
			    preview = box.find( '[data-bp-cover-preview]' ),
			    remove  = box.find( '[data-bp-cover-remove]' ),
			    frame;

			box.on( 'click', '[data-bp-cover-select]', function ( e ) {
				e.preventDefault();

				if ( frame ) {
					frame.open();
					return;
				}

				frame = wp.media( {
					title: <?php echo wp_json_encode( __( 'Listing cover image', 'beepossible' ) ); ?>,
					button: { text: <?php echo wp_json_encode( __( 'Use this image', 'beepossible' ) ); ?> },
					library: { type: 'image' },
					multiple: false
				} );

				frame.on( 'select', function () {
					var attachment = frame.state().get( 'selection' ).first().toJSON(),
					    src        = attachment.sizes && attachment.sizes.medium
						    ? attachment.sizes.medium.url
						    : attachment.url;

					input.val( attachment.id );
					preview.html(
						$( '<img>', { src: src, style: 'max-width:100%;height:auto;display:block;border-radius:4px;' } )
					);
					remove.prop( 'hidden', false );
				} );

				frame.open();
			} );

			box.on( 'click', '[data-bp-cover-remove]', function ( e ) {
				e.preventDefault();
				input.val( '' );
				preview.empty();
				remove.prop( 'hidden', true );
			} );
		} );
	} );
	</script>
	<?php
}


/**
 * Save the choice. Bails on autosave, bad nonce or missing capability, and
 * deletes the meta when cleared so a case study without a cover carries no row.
 */
function bp_save_case_study_options( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['bp_case_study_options_nonce'] )
		|| ! wp_verify_nonce( $_POST['bp_case_study_options_nonce'], 'bp_save_case_study_options' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$cover_id = isset( $_POST['bp_case_study_cover_id'] ) ? absint( $_POST['bp_case_study_cover_id'] ) : 0;

	if ( $cover_id ) {
		update_post_meta( $post_id, BP_CASE_STUDY_COVER_KEY, $cover_id );
	} else {
		delete_post_meta( $post_id, BP_CASE_STUDY_COVER_KEY );
	}
}
add_action( 'save_post_case-study', 'bp_save_case_study_options' );


/**
 * Chosen cover attachment id, or 0 when the card should use the featured image.
 *
 * @param int|null $post_id Defaults to the current post.
 * @return int
 */
function bp_case_study_cover_id( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();

	return $post_id ? (int) get_post_meta( $post_id, BP_CASE_STUDY_COVER_KEY, true ) : 0;
}


/**
 * Print the listing image: the cover when one is set, the featured image when
 * not. Templates call this instead of the_post_thumbnail() so the fallback
 * lives in one place.
 *
 * Falls through to the featured image if the cover attachment has since been
 * deleted from the media library, rather than rendering an empty card.
 *
 * @param string   $size    Registered image size.
 * @param array    $attr    Image tag attributes.
 * @param int|null $post_id Defaults to the current post.
 */
function bp_case_study_cover( $size = 'case-study-list', $attr = [], $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	$cover_id = bp_case_study_cover_id( $post_id );

	if ( $cover_id ) {
		$html = wp_get_attachment_image( $cover_id, $size, false, $attr );

		if ( $html ) {
			echo $html;
			return;
		}
	}

	echo get_the_post_thumbnail( $post_id, $size, $attr );
}
