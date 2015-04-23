<?php

/**
 * Plugin Name: Easy Digital Downloads - Smart Coupons
 * Plugin URI: https://fatcatapps.com/
 * Description: Smart coupons for Easy Digital Downloads
 * Version: 1.0
 * Author: Fatcat Apps
 * Author URI: https://fatcatapps.com/
 */

define( 'EDD_SMART_COUPONS_ARGUMENT', 'discount' );
define( 'EDD_SMART_COUPONS_COOKIE', 'edd_smart_coupons_enabled' );
define( 'EDD_SMART_COUPONS_EXPIRE', time() + ( 60 * 60 * 24 * 365 ) ); // now + 1 year

function edd_smart_coupons_setup() {
	if ( empty( $_COOKIE[ EDD_SMART_COUPONS_COOKIE ] ) ) {
		?>
		<style>
			#edd_discount_code {
				display: none;
			}
		</style>
		<script>
			if ( window.location.href.match( <?php echo '/[?&]' . EDD_SMART_COUPONS_ARGUMENT . '=/' ?> ) ) {
				document.cookie =
					'<?php echo EDD_SMART_COUPONS_COOKIE ?>=1; ' +
					'expires=' + new Date(<?php echo EDD_SMART_COUPONS_EXPIRE * 1000 ?>).toUTCString() + '; ' +
					'path=/';

				var params = {};

				window.location.search.slice( 1 ).split( '&' ).forEach(function( part ) {
					var param = part.split( '=' );
					if ( param[0] != '<?php echo EDD_SMART_COUPONS_ARGUMENT ?>' ) {
						params[ param[0] ] = param[1];
					}
				});

				window.location.href = ( window.location.pathname + '?' + jQuery.param( params ) ).replace( /\?$/, '' );
			}
		</script>
		<?php
	}
}

add_action( 'wp_head', 'edd_smart_coupons_setup' );
