/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Header text color.
	wp.customize( 'education_master_site_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, .site-description' ).css( {
				'color': to
			} );
		} );
	} );
	
} )( jQuery );
