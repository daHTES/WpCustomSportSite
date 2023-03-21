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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'WP_21_03_23' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'OY7*#52Mr+lX0;b,<8KuQwCd(br!O^I(wk2HkR3;?(tJDDS`Wr&6XV1W@L6Wi>TJ' );
define( 'SECURE_AUTH_KEY',  '@SN>g5<~sg85UQ#3u7^~He hTi0>[Q!Z<G7mCEl`nnCLQI5T<[v)A9KXhF:etBgx' );
define( 'LOGGED_IN_KEY',    'JcS2|=,Kow)FhYxT|yrnOKJz>B?7kE] 40(kbLQ&J|6v/:P-ilP4lfhFx|^RQI^t' );
define( 'NONCE_KEY',        'guors^+IW|^Y&9=.G-WMXIGd:GEPQ(ku#y{{Gq41%kyU2^1 q48ooS?G~]C:#xG5' );
define( 'AUTH_SALT',        'B(4{|jyT5at1hzpLAJmElW=E(]/Ufnj0XqDE8ziNT>`*G3t0QtE =]p()nOhFeim' );
define( 'SECURE_AUTH_SALT', '>zL1EUtL<o{MqT%dHVR?i-VhSXp0<.&wrHah<jep#]|Lh&`fPnMH|<Ti*f2;ugr@' );
define( 'LOGGED_IN_SALT',   'Z/e]$!5@0)U;g@J~=TL%;Hwbk+=Xc`AGpXhBI#&Ec557&Uq[0 @W6g.1}y,f}bjM' );
define( 'NONCE_SALT',       'DIk:VZUFMZk`@#g6I~l,Ln/a`$O<o>:-)Uj#1_FF(qT}8)|G^NIE#QXc UgX&QIJ' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
