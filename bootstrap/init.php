<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('SRC', ROOT . 'src' . DIRECTORY_SEPARATOR);
define('DB', ROOT . 'db' . DIRECTORY_SEPARATOR);
define('VIEWS', ROOT . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('LAYOUTS', VIEWS . 'layouts' . DIRECTORY_SEPARATOR);

require(ROOT . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
$routes = require('routes.php');
