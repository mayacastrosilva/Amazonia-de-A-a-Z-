<?php

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Path Eva/Paths. */
require_once(ABSPATH . 'config/paths.php');

/** Path vendor/autoload. */
require_once(ABSPATH . 'vendor/autoload.php');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
