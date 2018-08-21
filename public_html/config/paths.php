<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 08/12/2017
 * Time: 17:55
 */

/** Definicao do ambiente no conf do site no Apache*/
define('ENVIRONMENT', $_SERVER['ENVIRONMENT']);

/** The name of the database for WordPress */
define('DB_NAME', 'amazoniaaz'.strtolower(ENVIRONMENT));
//define('DB_NAME', 'amazoniaazdevbce');

/** MySQL database username */
define('DB_USER', 'amazoniaaz'.strtolower(ENVIRONMENT));
//define('DB_USER', 'amazoniaazdevbce');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', '10.100.103.25');
//define('DB_HOST', '192.168.157.44');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'j(;,|$dSibQ[we -BkrpDau:{`0z];o0Q/f]5VYYN5!Ux896)E )u*s#@3x~i^!D');

define('SECURE_AUTH_KEY',  '2M{2`a^E~Rz`Xh`:FUlY*#)(p8XR~FN$&!&eD1*QTRW:jXy$gyQb<F: ;]kl|-?`');

define('LOGGED_IN_KEY',    'S&`=n}u!FG*ze$15p5Qj]|f*>lzU1{hW2 !0[g_eJ32)Y(LKJ}y>Qpns-d.2mNd7');

define('NONCE_KEY',        'O}=dg[c&jO_>iD{g4S66k2CIl?fdHJJ^&P|/o!>L:*0LSx?9)u<P4LrVB[}?kE]R');

define('AUTH_SALT',        '@?~eTBoYOT- Ix?TJ-HZ#O4uDi)Yf5P)_Qx]pKF$?PEe)xbc~$CI#>W@]v#RoF+ ');

define('SECURE_AUTH_SALT', 'KE$^Gz}Y5zrD _jcCo/n7g5%e/l]w|).2xU!g|hJ<)b-Q-|U:U!t8&&pI,ai.I8Y');

define('LOGGED_IN_SALT',   'C.:OS[f5c|>X<8uUGqouz*sIdMM9c7O*jn- 0*DgF7W.,Q,5EXpA-VSb(4S6y{,|');

define('NONCE_SALT',       't-%~ 2:boxinz[u!$Ztn.qEase3kSEJFx>FjayEK0%5au`3U![i,hs-}^&;Qrw6<');

define('WP_DEBUG', false);

//ID do site pertencente ao Sumauma
define('WP_SITE_ID', 2);

define('WP_SITE_BLOGNAME', 'Amazônia de AZ');

define('WP_SITE_PROTOCOL', 'http');

//URL publica
define('WP_SITE_URL', 'http://www.amazoniadeaaz.com.br');

/** Path destino dos uploads */
define('UPLOADS', 'data');

//Revisões desabilitadas
define('WP_POST_REVISIONS', false );

$table_prefix  = 'wp_';

/** Path Eva/libs/functions e callbacks */
require_once(ABSPATH . 'config/functions.php');
