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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'team2devhostserv_ako' );

/** Database username */
define( 'DB_USER', 'team2devhostserv_ako' );

/** Database password */
define( 'DB_PASSWORD', 'Ako@!@#$%^' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ';(E?jl /C`cxE=g)6ey7$Z[1EKs7Ysu^z`?7cT5GgF*P>E<iejONez8m3XqA(M v' );
define( 'SECURE_AUTH_KEY',  '%:f9Y*pvi1H8a15Qg.`?`nSWRxWHqB{dfPzp?ph{-J^!w0,,*5/o#`VW-*P5vL%H' );
define( 'LOGGED_IN_KEY',    'Cadjexsqcw0o!_i_Nlm1HhLdF/(`LfOO`3XAG@)t8|0bZ3Dexe1uH&c}*CyhyaO{' );
define( 'NONCE_KEY',        'WLc3$PZj@g=aMf7-YiHZW,itm}2x&4|gtD{FhQ*11sm1r,ZA$xwf-%u*8uHU5twg' );
define( 'AUTH_SALT',        '6KY7psf>Kj!S>:yXO~(;Ub7AZ( f>Y)Qp]T{79TLgCtWsM8rWbfq.N.nPuB3xZhf' );
define( 'SECURE_AUTH_SALT', 'g@JQaVi9qFza{mucdWJ:(0]3V_U(5$N,WIQdR`cVsh6=;:cdZvz9e[o$LA*uOIZ(' );
define( 'LOGGED_IN_SALT',   '#7Epl)cx1.S {eClX,YDkiOZC )G6H!#[Rt}gW #m|KYEe^9UA:Wtm6UCbXan?t*' );
define( 'NONCE_SALT',       '!zU%jv}N-tzCIt![,,Q_`ipmhuZ v^ 5~ZQryI]9m|QZ-pb 3Ky*GiLnK?YHjI7F' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
