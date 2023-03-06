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
define( 'DB_NAME', 'Hendon' );

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
define( 'AUTH_KEY',         '=+#vO8v.|nK]Vb<%3~}5KgPl<~u, _g]rXso&@b7lZ]RdKnKO./Qyi:!HrP30{R}' );
define( 'SECURE_AUTH_KEY',  '}_1bh4_A8|WR&3sbI_n^L)Mm-[>Yi|~(r)KZ,:rP5mUI1mN$X#;1%W?m]dV+q;dp' );
define( 'LOGGED_IN_KEY',    'jK{HHn#$X?(P_a}Wj^]/%,bieZ+j:VB_3o6u|esX&8%Xv%F]]HxMOgXf$-W%>eDs' );
define( 'NONCE_KEY',        '.cWajE/s[*&l^nng*S#Sy0r!FT^^nPrR_Xc[9hdv_*W<HbgRf%ArObNRGo+hp2vE' );
define( 'AUTH_SALT',        'T${BX$rP=fhqPeAe^rU|NZA{^<7{1Hsz9aiv#:*?5$.>Ir+1t{F(f;B}^[}Y*tZk' );
define( 'SECURE_AUTH_SALT', '4hL2ZIsr-p>uHv/V7=<F#<C44hD,5}YX/eW7c9%WX8_zs{x*};)9!hvp |S~vd6`' );
define( 'LOGGED_IN_SALT',   'XQl~0}>fDh,=X 6BF0Oa8KobdvI#h{5o|@%r0WFh2%s0HYpp@&6jX|h+4WfusDps' );
define( 'NONCE_SALT',       'dD8~}KRUc, &R[A-w&P2~EC:p~6S!M2/D.UuQdz(PqYV*},ze}rEfi6-u4C2+mqq' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_Hendon';

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
