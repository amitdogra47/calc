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
define('DB_NAME', 'calc');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'Bp&DB3imrd)+R#g5z$iq?/k DJaKx$IhhW2Bc+8E%u]zz)>6N=60|^$zJiY#]#t?');
define('SECURE_AUTH_KEY',  '8e.H4AELfKNAwBfot8%dM~c&Ons-/E-h6}R*W1,NQEm)@9dh?w#c:5bv|L){nPpo');
define('LOGGED_IN_KEY',    'r] f=mARD1 I oOI2kMw5^v%4of]q0G1dQ&qy+%T3STb!Ec6B:FnhAA%?l>RC7d(');
define('NONCE_KEY',        'la~Z)(z{S.m@O7n#v6akokV7<dGF=r*wlX]Hu>?)>4emv@ g;A,S$xt7PrMIGt15');
define('AUTH_SALT',        '+(grJ*d:~K %fT6?Z|H~Hy{,SBFZ%fh!h.i<mG)EG+qI=_N^.MMbV,-*<?H]V=#=');
define('SECURE_AUTH_SALT', 'T;&9exq|no6B&eBy5NQ<xR{6q];qIT.$ h&wUf@9_4_OXD[7b2hkq9pMBwnCLePh');
define('LOGGED_IN_SALT',   '@^UAW18E)84;{-tzKYz4U56dBux1aodJo>)`ihh|aji6.Gl7O)G}=`=d(G:E@?A@');
define('NONCE_SALT',       'XCso#+-o_@00]OuFys/+JnLpN;65[iEf0H.r?JCk:b.ntrz=aAD%x(-,n!j/dT5b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'clclcllclc_';

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
