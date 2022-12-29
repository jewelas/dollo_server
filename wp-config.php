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

define( 'DB_NAME', 'bitnami_wordpress' );


/** MySQL database username */

// define( 'DB_USER', 'bn_wordpress' );
define( 'DB_USER', 'root' );


/** MySQL database password */

// define( 'DB_PASSWORD', '335f3531b105e6c1d60becd1aecab6ec330d7b217a395d0628ae55258cee2564' );
define( 'DB_PASSWORD', '' );


/** MySQL hostname */

define( 'DB_HOST', 'localhost:3307' );


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

define( 'AUTH_KEY',         ',IB`;M;(seJXO6=tpl:Q~T=Eo@.M0f^2&r0>n+?#i[L#2)LhFrKw8~4cP]r8AF?z' );

define( 'SECURE_AUTH_KEY',  'DB3ih hF>$|xe f<W)Y!5+h!?2o,`FoGI|$7W.bkMr;2qN7VLexvGIt 7G%3h+Or' );

define( 'LOGGED_IN_KEY',    'T!Iuhi`3Ln#iQj#|.Pi&]m7H`@T|4.2U gaiU^w3@XXPT*Zw=0n:;R:S0/%NkI8:' );

define( 'NONCE_KEY',        '(g|<jubxSEI$mr|L4gk6_&TVQD2S;>(-n7LY(Db(d!cE9>wZfwE9/Z mn~b,x~Zu' );

define( 'AUTH_SALT',        '7kDM.SD+:2LG>D)8f IN~&$x:qN7L 9jzzd5B#|<fL<1x1Ka@Om*|.n-(DiZxdqi' );

define( 'SECURE_AUTH_SALT', 'vyMyx)I-eG(jZ>X}_-Q nv]5[O`+0AqHv k[K BJcn,n^.Ko_m>LjFB~0KS&3JJX' );

define( 'LOGGED_IN_SALT',   '7316D`|35ta#hE7l@#gA:TQ`*Rcc.hQ|BzZ:#Lup>%;`]/[Ivqyw0M~2!6G(NW*y' );

define( 'NONCE_SALT',       'EHI!iMN2_a(o_h|<.zskBZ~>%*!({v@$__;{(d7R+/L1g+bO][GD=#H$P2I[Jvg;' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
