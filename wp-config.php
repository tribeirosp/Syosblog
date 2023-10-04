<?php
define( 'WP_CACHE', true );

//Begin Really Simple SSL session cookie settings
//@ini_set('session.cookie_httponly', true);
//@ini_set('session.cookie_secure', true);
//@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings
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
define('DB_NAME', 'jonat537_wp623');

/** MySQL database username */
define('DB_USER', 'jonat537_wp623');

/** MySQL database password */
define('DB_PASSWORD', 'Q!29qS)2kp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME', 'https://syos.com');
define('WP_SITEURL', 'https://syos.com');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ljy0iptymcy2c4msnoz5oyemv3sacrgbxojzhdqjvalagnorjiq9xqqdkte6zbz5');
define('SECURE_AUTH_KEY',  'hsqd0hfbwgkjpmlhfvlk6epkvkfypvg27kjwsbsgvhoziyiyeeap1rj2edq14tnw');
define('LOGGED_IN_KEY',    'abj7eq1fntysn6ojct9q64atl5ci4hbrmuztwm9gst5tu40dgogui3nrqv5ubwr0');
define('NONCE_KEY',        '9f2jpl8egw2x5kbgqf05tiqofcwbwvhmxdvwmgp9nvf67aijkbnow8f1spnuurdp');
define('AUTH_SALT',        'tiq7ocdvxfhaun0kvsjfs1uy6bwwcxasdds6syijqyybdam3kjqklc315xsty2wn');
define('SECURE_AUTH_SALT', 'z6f4j0mesiovnmgzruzbq2zoley8jq0dykrd8nzsh9meku9f7ncpi2qpogwvrrcd');
define('LOGGED_IN_SALT',   '0v7kygkoxaywo4xoelbkqbxzmhmi4jmo4zitheyxwni8ikpcs8eorvkamdcecc06');
define('NONCE_SALT',       'ki6x3xnnejz8zpo5boj7aj8bhh1od17zhf02hqcpc5glr1cwsuxdkmzh7jlcdp7s');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpar_';

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
