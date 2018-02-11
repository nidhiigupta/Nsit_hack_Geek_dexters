<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'webassnp_wordpress');

/** MySQL database username */
define('DB_USER', 'webassnp_wp');

/** MySQL database password */
define('DB_PASSWORD', '9elOaFNgVFl1XYjIKE');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Vd]^gm-1w`D8l}fJY; aevP)Mn6gZYN 456T7Ci]Xk^W],a(_*<|vB+$o4&$gdqf');
define('SECURE_AUTH_KEY',  '/-0--]5CD7Nc7#,p,1h31~3[?F@iV`o|wIU]JHG]9W N9VkO;&g<wf%dvNw.Hv 6');
define('LOGGED_IN_KEY',    'l`OlF2G[PL 5bI.W,X(Q8/Pe|iCSi&Br#O 3s:}2(!9#dB(3ZU7RO@U5s{rLD4x0');
define('NONCE_KEY',        'gR#M!0_i2O3W-ejV9VY>)1,EXZ:glP?l$HkDSC6;L1#Jknktz~:$0S]jZK*%&+?S');
define('AUTH_SALT',        'J60]c~TEKV9<VLbCl6~rRVAyDuHcl3; ]E=Kg~5|3RH+-h$SHT!.%H6/e0DipU]G');
define('SECURE_AUTH_SALT', 'L|6]okRe?caRd$pn%q:{Mgc--(DP;]i>iTV%:3 mZHb!gZ,UBy}w!8us<~:8imE|');
define('LOGGED_IN_SALT',   'EAKMGK6n(B.Z]Q%o.(jgV^N9iqYx.WQVus/l}dNK:?OQ<>w$+23b,LO;{Nia<l|}');
define('NONCE_SALT',       'E20rsVWu3:MMoC4&9xh_)jpo^MHP:X]hRXH5NOK]HGOk+apj1wTkJRc222 %cZdw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
