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
/** The name of the database for WordPress xbnewqlk_mysoremile */

define('DB_NAME', 'xercextx_mysoremile');

/** MySQL database username */

define('DB_USER', 'xercextx_mysore');


/** MySQL database password */
define('DB_PASSWORD', 'Xerces@1985');

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
define('AUTH_KEY',         '1g Sn6q5T*.EM2;)~N# 1td->(z=tf`gvC,>X:m#:}p&aR3ih0F_d1S=AQV)3.YD');
define('SECURE_AUTH_KEY',  'wyidbw~),F0!jKS>:9sk$_(1i)Fk1$Yd!*H^::aTNc}nDU@w[XxG`AeSp;l_7I@i');
define('LOGGED_IN_KEY',    '2V{P&CE^=jy}XO~9ZxNyRL$MdAFK.RbxvA9uOD=0~DxLQB9_2% @G u+ucjLrtL0');
define('NONCE_KEY',        'y-}NqH!~22x/8JB<xKSkE?RKbi{taeu:s:}h1?Qdj ,n>C6&M1T6ERI)qMB.@*jy');
define('AUTH_SALT',        'q5z:R&P@9oPT/e&W808&m&B5@8o`umATM<mb*<}WHt1XlBNeRdc,7zh3%HvTF,XD');
define('SECURE_AUTH_SALT', 'ff*^v1Kg_Nw^clg[jR]M#ZAD5G.KlIgSx.VEGp!]_KaBUhCIj0`uhHILgIkgxh,l');
define('LOGGED_IN_SALT',   '_j(Zl5{o/JCJ7@OuaA>f$w2$w9ow.EGgRm@B~g-4[WtPCMaJ3X!)[%j##-^&YS/6');
define('NONCE_SALT',       'vUsgp+f#MK9li6lA&>1);#!f:r7U^Zc>-b.i=9ZX.m|wTQ1aA{*U:D&2Dn3LY6ri');

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