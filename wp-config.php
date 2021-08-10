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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'buoyant_wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'HijkLMNO$$1234$$' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'd{C8i:x^H!_ilsl.NUkH1w^zBRG,{|lOvv6f#M(+;g?zKTbt=$9L`TO7JtOWE^Y]' );
define( 'SECURE_AUTH_KEY',  'dnlq$xB}WqmF+QWUY2y-Xjh@7R?3#mJ5|f^Y2K`EAi<[(R0|J.vuCo1.X0*E9o]j' );
define( 'LOGGED_IN_KEY',    'Zh%p9R.c$[2{t;[Cat>,cQBM<n|`N;69Y]<o0}Mm^M7LP9Y%=c51P)}WU:)Fh&;4' );
define( 'NONCE_KEY',        'T 0i75k@meAkvwSo[6UGz4.]CWrYJ}1Dd45_ej%/ z%qUshyr KW*3B{ERqjOU;m' );
define( 'AUTH_SALT',        '?st?aq*0i{`k06~yVq.Oh&MyQ](i-hqTk4+Z)Oqg.TS?t!y_:OfK9MeYOLAz;a=}' );
define( 'SECURE_AUTH_SALT', 'ucD<BQK`yF}IE@3jY]X1,xS:Lz)WE5Ne#sDNaJ`t`Y)|u_n@5~5yWImius6k/^(y' );
define( 'LOGGED_IN_SALT',   'NZrm7M3Vsuz-yb}FkCuL;PZX<2L#ljB#FH$a:0@N.US;l*q+tQ<M)rNiZ` Bi: ,' );
define( 'NONCE_SALT',       ',ff,fSV_{S!.g/l7k=crq;;(h?]2tL=w-&^,.drr&kvfm$PB_p$^&zWR*]vU%D.u' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
