<?php
require_once 'autoload.conf.php';

setlocale(LC_TIME, 'fr_FR', 'fra');

define('DS', DIRECTORY_SEPARATOR);

// DEBUG
define('CORE_DEBUG', 1);

// ERRORS CONFIG
error_reporting((CORE_DEBUG ? (E_ALL | E_STRICT) : 0));
ini_set('display_errors', (CORE_DEBUG ? 1 : 0));

// PATHS
define('CONFIG_DIR', 'config');
define('ROOT_DIR', trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace(array('\\', CONFIG_DIR), array('/', ''), __DIR__)), '/'));
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.ROOT_DIR.'/');
define('ROOT_HTTP', 'http'.(!empty($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].'/'.ROOT_DIR.'/');

define('CURRENT_URI', trim(str_replace(ROOT_DIR, '', $_SERVER['REQUEST_URI']), '/'));
define('CURRENT_PATH', parse_url(CURRENT_URI, PHP_URL_PATH));

// CLASS PATH
define('CORE_PATH', ROOT_PATH.'class/core/');
define('MODELS_PATH', ROOT_PATH.'class/model/');
define('CONTROLLERS_PATH', ROOT_PATH.'class/controller/');

// VIEWS PATH
define('VIEWS_PATH', ROOT_PATH.'views/');

// STATIC PATH
define('STATICS_PATH', ROOT_PATH.'www/statics/');
define('STATICS_HTTP', ROOT_HTTP.'www/statics/');
define('IMG_PATH', STATICS_PATH.'img/');
define('IMG_HTTP', STATICS_HTTP.'img/');
define('LOCALE_PATH', ROOT_PATH.'lang/');

// REFERER
define('REFERER', !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');

// DB CONFIG
define('DB_ENGINE', 'mysql');

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'starter');
} else {
	define('DB_HOST', '');
	define('DB_USER', '');
	define('DB_PASS', '');
	define('DB_NAME', '');
}