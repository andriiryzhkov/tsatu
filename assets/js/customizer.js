/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Widget area 1.
	wp.customize( 'tsatu_columns_1', function( value ) {
		value.bind( function( to ) {
			switch ( to ) {
				case 0:
					$( '#customize-control-tsatu_home_area_1_1' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_2' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_3' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_4' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_5' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_6' ).css( { 'display': 'none' } );
					break;
				case 1:
					$( '#customize-control-tsatu_home_area_1_1' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_2' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_3' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_4' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_5' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_6' ).css( { 'display': 'none' } );
					break;
				case 2:
					$( '#customize-control-tsatu_home_area_1_1' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_2' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_3' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_4' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_5' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_6' ).css( { 'display': 'none' } );
					break;
				case 3:
					$( '#customize-control-tsatu_home_area_1_1' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_2' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_3' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_4' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_5' ).css( { 'display': 'none' } );
					$( '#customize-control-tsatu_home_area_1_6' ).css( { 'display': 'none' } );
					break;
				case 4:
					$( '#customize-control-tsatu_home_area_1_1' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_2' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_3' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_4' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_5' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_6' ).css( { 'display': 'none' } );
					break;
				case 5:
					$( '#customize-control-tsatu_home_area_1_1' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_2' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_3' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_4' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_5' ).css( { 'display': 'list-item' } );
					$( '#customize-control-tsatu_home_area_1_6' ).css( { 'display': 'list-item' } );
					break;
			}
		} );
	} );
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
} )( jQuery );
