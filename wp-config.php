<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'o+{fSrBdd46yy74{|q(}i0BF3K8(nY;a[,I8U:|,9dXs+/,14@~X}zZA%6ID89#u');
define('SECURE_AUTH_KEY',  '^}O]K_p-Ta-@R4S#4UBDhf*i!U:8o]t&+>Y>k!x12,XPo1ZQ9t915@Fe--ezC{[M');
define('LOGGED_IN_KEY',    '_|=t75#f9{]p+^qQ.GyLjMA.y-ns|/q {Cpp7Z-u,Mt~+[34)>A>U70_C{E.{Z%H');
define('NONCE_KEY',        'c?Y)6,-G_ppBm@(mai_ogZ@%9|FK+7M8PI>S[%`mW+@_Q-~pSqFX-n$dNhl@999^');
define('AUTH_SALT',        'COe8W9~5ph?Qcm#KGWb1O81I9T>n;#P4YT^7p6,G%|(B1/f5oj|JL^LKEATLe+H^');
define('SECURE_AUTH_SALT', 'Iv^Aki.|c+Pa3Q_}g.^%-;$a?u|t^$h3@zeY>R!`!ZA=nK#PtwyBJ$Pz4tN=+G@x');
define('LOGGED_IN_SALT',   'ov7dW{-)<3ss$e2_Ja4OIQvu{Ec^+AO~P[6Q>#es]@?>b3+c,dVJw4=GIV~kBd90');
define('NONCE_SALT',       '2f]Leb[JZzYLg{Y3lSYc Q61HK6Er?kY+eS!8wH@b-.2T>g|0L|}RJF*&!,[P|E~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tinhot';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
