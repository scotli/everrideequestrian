<?php

use Automattic\Jetpack\Connection\Manager;
use Automattic\Jetpack\Connection\Package_Version;
use Automattic\Jetpack\Status;
use Automattic\Jetpack\Status\Host;

if ( ! class_exists( 'WC_Connect_Jetpack' ) ) {
	class WC_Connect_Jetpack {
		const JETPACK_PLUGIN_SLUG = 'woocommerce-services';

		public static function get_connection_manager() {
			return new Manager( self::JETPACK_PLUGIN_SLUG );
		}

		/**
		 * Returns the Blog Token.
		 *
		 * @return stdClass|WP_Error
		 */
		public static function get_blog_access_token() {
			return self::get_connection_manager()->get_tokens()->get_access_token();
		}

		/**
		 * Helper method to get if Jetpack is in offline mode
		 *
		 * @return bool
		 */
		public static function is_offline_mode() {
			$status = new Status();

			return $status->is_offline_mode();
		}

		/**
		 * Helper method to get if Jetpack is connected (aka active).
		 *
		 * @deprecated 2.3.0 Use self::is_connected() instead.
		 *
		 * @return bool
		 */
		public static function is_active() {
			return self::is_connected();
		}

		/**
		 * Helper method to get if the current Jetpack website is marked as staging
		 *
		 * @return bool
		 */
		public static function is_staging_site() {
			$jetpack_status = new Status();

			return $jetpack_status->in_safe_mode();
		}

		/**
		 * Helper method to get whether the current site is an Atomic site
		 *
		 * @return bool
		 */
		public static function is_atomic_site() {
			return ( new Host() )->is_woa_site();
		}

		public static function get_connection_owner_wpcom_data() {
			$connection_owner = self::get_connection_owner();

			if ( ! $connection_owner ) {
				return false;
			}

			return self::get_connection_manager()->get_connected_user_data( $connection_owner->ID );
		}

		/**
		 * Helper method to get the Jetpack connection owner, IF we are connected
		 *
		 * @return WP_User | false
		 */
		public static function get_connection_owner() {
			if ( ! self::is_connected() ) {
				return false;
			}

			return self::get_connection_manager()->get_connection_owner();
		}

		/**
		 * Records a Tracks event
		 *
		 * @param $user
		 * @param $event_type
		 * @param
		 */
		public static function tracks_record_event( $user, $event_type, $data ) {
			$tracking = new Automattic\Jetpack\Tracking();

			return $tracking->tracks_record_event( $user, $event_type, $data );
		}

		/**
		 * Determines if the current user is the site's Jetpack connection owner.
		 *
		 * @return bool Whether the current user is the Jetpack connection owner.
		 */
		public static function is_current_user_connection_owner() {
			return self::get_connection_manager()->is_connection_owner();
		}

		/**
		 * Determines if both the blog and a blog owner account are connected to Jetpack.
		 *
		 * @return bool Whether or nor Jetpack is connected
		 */
		public static function is_connected() {
			return self::get_connection_manager()->is_connected() &&
					self::get_connection_manager()->has_connected_owner();
		}

		/**
		 * Connects the site to Jetpack.
		 * This code performs a redirection, so anything executed after it will be ignored.
		 *
		 * @param $redirect_url
		 */
		public static function connect_site( $redirect_url ) {
			$connection_manager = self::get_connection_manager();

			// Register the site to wp.com.
			if ( ! $connection_manager->is_connected() ) {
				$result = $connection_manager->try_registration();
				if ( is_wp_error( $result ) ) {
					wp_die( esc_html( $result->get_error_message() ), 'wc_services_jetpack_register_site_failed', 500 );
				}
			}

			// Redirect the user to the Jetpack user connection flow.
			add_filter( 'jetpack_use_iframe_authorization_flow', '__return_false' );

			// phpcs:ignore WordPress.Security.SafeRedirect.wp_redirect_wp_redirect -- URL generated by the Jetpack Connection package.
			wp_redirect(
				add_query_arg(
					array( 'from' => self::JETPACK_PLUGIN_SLUG ),
					$connection_manager->get_authorization_url( null, $redirect_url )
				)
			);
			exit;
		}

		/**
		 * Jetpack Connection package version.
		 *
		 * @return string
		 */
		public static function get_jetpack_connection_package_version() {
			return Package_Version::PACKAGE_VERSION;
		}

		/**
		 * Get the WPCOM or self-hosted site ID.
		 *
		 * @return int|WP_Error
		 */
		public static function get_wpcom_site_id() {
			return Manager::get_site_id();
		}
	}
}
