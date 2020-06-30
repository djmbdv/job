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
define('DB_NAME', 'remotepc_aquionline');

/** MySQL database username */
define('DB_USER', 'remotepc_aqui');

/** MySQL database password */
define('DB_PASSWORD', 'aquionline');

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
define('AUTH_KEY',         'o,y|CLM@ckXzG^thTh/h!XidDU>%[x73<{U!DfX1P(3iRN% N4tn).fNi!woYhjs');
define('SECURE_AUTH_KEY',  'h))/6lq;2WcVJG-rq$<8m__Gt*ebrW$QSkn?|slW9>PZQ6SOlak4y:B1G/{DEiJ_');
define('LOGGED_IN_KEY',    '}ZJk~)+o)/D6Jd@i]3WZ>-b5+ok0[_XY)@{*q!#=ydD=EV8..ap;HwF^$Y=LKS.r');
define('NONCE_KEY',        '77ky0GRe gi<8y[;x5}_vBzzADBt]+5{1%8RkPvr|!Qz5Y`JOhW+|I`U4gF[6hMd');
define('AUTH_SALT',        'bsr~0l!$OG%@4/l^d}SVGI{Rq.If8^>%pej{nON<IKBfH-zG7P9!PbYvd2Y->b*%');
define('SECURE_AUTH_SALT', '0UT=T9;D*;xd2)W4X:}^y +S&&+r]wE]x2]M7-4&:|.*?mk@?oA%)f_P.4+nVg=o');
define('LOGGED_IN_SALT',   'Ka>Nv.~W04TWrx=]/k3/&6v7x*|EB%*zO>_NHkZG:d$wXw],6GqD.I4|mq+ `1.$');
define('NONCE_SALT',       '(EEXNglyd-SA`u|+7^YPY/c`eZ/,Rh?ZRtoXF730:[Ij}4k]MO3-bw!!`cwNw85_');

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
