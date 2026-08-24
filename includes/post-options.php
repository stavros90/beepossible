<?php
/**
 * Article options — per-post display toggles for blog posts.
 *
 * A native meta box rather than a Secure Custom Fields group: the toggle ships
 * with the theme, keeps working if the plugin is deactivated, and stays in
 * version control next to the template that reads it.
 *
 * The meta key is underscore-prefixed so it stays out of the Custom Fields panel.
 */


/**
 * Register the Article Options box on standard posts only.
 */
function bp_add_post_options_meta_box() {
	add_meta_box(
		'bp_post_options',
		__( 'Article Options', 'beepossible' ),
		'bp_render_post_options_meta_box',
		'post',
		'side'
	);
}
add_action( 'add_meta_boxes', 'bp_add_post_options_meta_box' );


/**
 * One checkbox, unchecked by default so existing posts and new drafts keep the
 * current byline-free layout until someone opts in.
 */
function bp_render_post_options_meta_box( $post ) {
	wp_nonce_field( 'bp_save_post_options', 'bp_post_options_nonce' );
	?>
	<p>
		<label for="bp_show_author">
			<input type="checkbox"
			       id="bp_show_author"
			       name="bp_show_author"
			       value="1"
			       <?php checked( bp_show_author( $post->ID ) ); ?> />
			<?php esc_html_e( 'Show author name', 'beepossible' ); ?>
		</label>
	</p>
	<?php
}


/**
 * Save the toggle. Bails on autosave, bad nonce or missing capability, and
 * deletes the meta when unchecked so posts without a byline carry no row.
 */
function bp_save_post_options( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['bp_post_options_nonce'] )
		|| ! wp_verify_nonce( $_POST['bp_post_options_nonce'], 'bp_save_post_options' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['bp_show_author'] ) ) {
		update_post_meta( $post_id, '_bp_show_author', '1' );
	} else {
		delete_post_meta( $post_id, '_bp_show_author' );
	}
}
add_action( 'save_post_post', 'bp_save_post_options' );


/**
 * Whether this post should print the author name. Templates handle the markup.
 *
 * @param int|null $post_id Defaults to the current post.
 * @return bool
 */
function bp_show_author( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();

	return $post_id ? (bool) get_post_meta( $post_id, '_bp_show_author', true ) : false;
}
