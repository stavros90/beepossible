<?php 
/**
 * Hide email from Spam Bots using a shortcode.
 *
 * @param array  $atts    Shortcode attributes. Not used.
 * @param string $content The shortcode content. Should be an email address.
 * @return string The obfuscated email address. 
 */

function hide_email_shortcode( $atts , $content = null ) {
    if ( ! is_email( $content ) ) {
        return;
    }
    return '<a href="' . esc_url('mailto:' . antispambot( $content ) ) . '">' . esc_html( antispambot( $content ) ) . '</a>';
}
add_shortcode( 'email', 'hide_email_shortcode' );