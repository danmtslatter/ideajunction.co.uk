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
define('DB_NAME', 'ij');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'ykuaPsKfYK');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '5 !^]cM|e^NSE}|W)c/ef-n/?5q p+kzaMr|!(Ro}Xh#cH]/ITyJ50sN3nO*KsPC');
define('SECURE_AUTH_KEY',  'OVn,g?qTdqW^0gI,-6vd%VG$0<Bz9B&Wt#7AhG>]?n(>R#{Im+UZ09s+d,V*Tu|8');
define('LOGGED_IN_KEY',    '/|jsATEdq0SsW6HLxi+;a4z0Cf(#~U`z[$+,fO%LZ {Oo%W+u8Cu[j+x>;N#ZF1c');
define('NONCE_KEY',        'TS%=GFM9aB6PL ^ImH]+EY>lm8xKqopPWIOR|hgL|-O0+6Bub:Of&W48J!N]8bJy');
define('AUTH_SALT',        '7|Nb2&-<*q^oWC vecDM=2$JyN;U:;fxa}8#Hr-3;=V4Rn)$JwA}k%Om^~DL1:@Z');
define('SECURE_AUTH_SALT', 'YQ3|Xydy*=RsTIqqRnT9>e/wC/c8++Hf1GMD%*1||?$!jvbnG]1u<0X{Ku@~3F)]');
define('LOGGED_IN_SALT',   'Z;t(_CFJW5n&#{kVoSbayaO[54EA|9=|iT@P1>XcLs(7TQ98@y>We q*})He(jir');
define('NONCE_SALT',       'I)Y>,w&|gumLNr7=;!Kc_O#Zs0TtzV--q=f.|;gbVercr:l-&jkOM|RQR^qB>zAK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
