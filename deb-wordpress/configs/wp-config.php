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

// If WordPress is behind reverse proxy 
// which proxies https to http
if ( (!empty( $_SERVER['HTTP_X_FORWARDED_HOST'])) ||
     (!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) { 
 
    // http://wordpress.org/support/topic/wordpress-behind-reverse-proxy-1
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
 
    define('WP_HOME', 'https://blog.albert.es');
    define('WP_SITEURL', 'https://blog.albert.es');
 
    // rewrite blog word with wordpress
    #$_SERVER['REQUEST_URI'] = str_replace("wordpress", "blog",
    #$_SERVER['REQUEST_URI']);
 
    // http://wordpress.org/support/topic/compatibility-with-wordpress-behind-a-reverse-proxy
    $_SERVER['HTTPS'] = 'on';
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wp_usr');

/** MySQL database password */
define('DB_PASSWORD', 'W0rdPr3$$');

/** MySQL hostname */
define('DB_HOST', 'mysql.devinfra');

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
define('AUTH_KEY',         'lpNR=QE+2&NmUhy4wQ@ilFGQNqu+|NdsX&-BBl8Btuct$|s(U@@h*-B.*;:p%Y*u');
define('SECURE_AUTH_KEY',  'z-==/@f|d0A#}KB?d*=|FP}1<09nm])%l3d(B|=BVe#<):;+^2!~5Oc?1|6@(E9@');
define('LOGGED_IN_KEY',    'rnQ#n&#d;:1ms|U{GmE-qX$*]g)qfrmak#G8+>*rJ*.JhX;-pxmb>y7^Uho/wLpc');
define('NONCE_KEY',        'g[+9?c1vR2}3>[t|N/&L*i4Oeq:7yNw2N5$B|7=g%7X%s-6mS+kOE=4:q7Mn+@!b');
define('AUTH_SALT',        'R<dL1nzvL7[5S795F2(SR0[*-o.XjQtRA*20+MBXu5t1)*r/]U#OfYU&dE]2eNSB');
define('SECURE_AUTH_SALT', 'Lc<U95#FOwM#d+jeL`&-xog!eDZ8F{/FU48oMlE~X9VXvBX%a{QK85aEd!dJOy&,');
define('LOGGED_IN_SALT',   'hG~nKNn7Kz$FZ~^5d{2?7p!CF1i^x^y]?m5oS7H.#mXsyQE$H?h$LUn-=WHwk0IR');
define('NONCE_SALT',       'JRKg.NdT#0-9{odg]e}~A|/M7hn}9`yCy5qygl]Zjt8gCwd+U[U^-!EFgrR<*/e{');

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