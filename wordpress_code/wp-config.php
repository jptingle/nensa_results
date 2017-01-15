<?php
/** Enable W3 Total Cache */
define('WP_CACHE', false); // Added by W3 Total Cache

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

/** The $wpdb and $wpdb_results database are instantiated in wp-includes/load.php   */
/** The name of the database for WordPress */
define('DB_NAME', 'nensa-jeff');

/** The name of the results database for WordPress */
define('DB_NAME_RESULTS', 'nensa_results_db');

/** MySQL database username */
define('DB_USER', 'nensa');

/** MySQL database password */
define('DB_PASSWORD', 'nensa');

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
define('AUTH_KEY',         't7opkuiapu3c8yklkya5yrtv2csrgvra0yxuk7ugzhoamvnkiwb7i8grothhqprr');
define('SECURE_AUTH_KEY',  'pg5iy1df3rdobkhm4cvxyzqdssbxjzmdgpvnyagj1ps735lgr1lshiid06kfcooz');
define('LOGGED_IN_KEY',    'sjsmfhzvs2vm2xiahxzjj93unxbqclgtgkrtaqkypivf9btv3fbfzsy4bkvpshd0');
define('NONCE_KEY',        'xxydqwhwqb2hlsrbxj9bnlkrn8qc48lylbkwmtdicti0mpwycr5dautt7yaa9qpn');
define('AUTH_SALT',        '571kuehzy2nmtkuass1jppcr8ciczkmgpzmx0pwxrvijpwddnkbndmjkbz6giv4w');
define('SECURE_AUTH_SALT', 'iniru4kemfpv4ptim8roa5oub0gwgrkvdkgap4nb8vxfppr69htph39vkp3bqtss');
define('LOGGED_IN_SALT',   'f3g8wapawli3pwn9t5v1u3yecgow3zzxsnslch1li5rf8ptiaodes93rlgfmzthr');
define('NONCE_SALT',       's0rkw9venjpkd5tchbxr0rkvh9nfijc8b4igkhyzqpohhh00hlk8zxfkxgbmmh7m');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp6e_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
