<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'be^}-$h]q/g#4#)tUpmR[7=6G;!Z)#v34b[3hU!pa,v6)cj6jBYTFo|tB=?)2UF5' );
define( 'SECURE_AUTH_KEY',   '1b;!N[[?+BMG:dT%lEF|q7_*)(m9ujN$Zb1)7dpzjGj/tg,Ex|C.1o,fb~fsh/AX' );
define( 'LOGGED_IN_KEY',     '=UO}g9v22dhLe{i]9)lCmG^H.2<<!J$5P]lYm@,Dj,u^2$:2lLQ5lJ`+$7/|nd0G' );
define( 'NONCE_KEY',         'TiMPX6<eP?)VhD5xmTk*lHB0/nrr08D~c*Tj7@qTxv%oJo4|,-TdONy4fO}AzvF%' );
define( 'AUTH_SALT',         'UW(3e8Y-rqW.TZMPyy]y_ ARcKa/tu]Hm;P]Nb62a30,`T`[M77-N&tl0]!XGv9I' );
define( 'SECURE_AUTH_SALT',  '{C!X[rYRR G{o}m~!I=!u-Bq`kJ]0v_.7{e|/__3.ADf+(^rV>A8;6nai{X6D0x_' );
define( 'LOGGED_IN_SALT',    '*cAb_|K[ hHDmc`%=E2`kBLK@u8?PXmVrJa#/{zNS nlc;5i5ML1z7bX[C34&n46' );
define( 'NONCE_SALT',        'X7@~!8MpHiF0t3(z2XZL`}HS{]<HYsqKa5,# A&A/FCiG#kT%%rkC!rkFT5nq#,z' );
define( 'WP_CACHE_KEY_SALT', '-@I tRu)2v_}Tl8dRBhPcz`BAOJYzfB8  s+o-hLkqHj7LRGw5>R+A9{d@n`JOic' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
