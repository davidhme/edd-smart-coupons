<?php

/**
 * Plugin Name: Easy Digital Downloads - Smart Coupons
 * Plugin URI: https://fatcatapps.com/
 * Description: Smart coupons for Easy Digital Downloads
 * Version: 1.0
 * Author: Fatcat Apps
 * Author URI: https://fatcatapps.com/
 */

define( 'EDD_SMART_COUPONS_ARGUMENT', 'show_coupon' );
define( 'EDD_SMART_COUPONS_COOKIE', 'edd_smart_coupons_enabled' );
define( 'EDD_SMART_COUPONS_EXPIRE', time() + ( 60 * 60 * 24 * 365 ) ); // now + 1 year

function edd_smart_coupons_request() {
	if ( ! empty( $_REQUEST[ EDD_SMART_COUPONS_ARGUMENT ] ) && empty( $_COOKIE[ EDD_SMART_COUPONS_COOKIE ] ) ) {
		setcookie( EDD_SMART_COUPONS_COOKIE, true, EDD_SMART_COUPONS_EXPIRE );
		wp_redirect( remove_query_arg( EDD_SMART_COUPONS_ARGUMENT ) );
		exit;
	}
}

add_action( 'init', 'edd_smart_coupons_request', -1 );

function edd_smart_coupons_styles() {
	if ( empty( $_COOKIE[ EDD_SMART_COUPONS_COOKIE ] ) ) {
		?>
		<style>
			#edd_discount_code {
				display: none;
			}
		</style>
		<?php
	}
}

add_action( 'wp_head', 'edd_smart_coupons_styles' );
