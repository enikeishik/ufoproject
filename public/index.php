<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use \Ufo\Core\Config;
use \Ufo\Core\Debug;
use \Ufo\Core\App;

if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $_SERVER['DOCUMENT_ROOT'] = __DIR__; //tests
}

$config = new Config();
$config->loadFromIni($config->projectPath . '/.config', true);
$config->routeStorageData = require $config->projectPath . '/data/RouteStorageData.php';
$config->widgetsStorageData = require $config->projectPath . '/data/WidgetsStorageData.php';
$debug = new Debug();
$app = new App($config, $debug);

$debug->trace('execute');
$_GET['path'] = '/blog';
$app->execute();
$debug->traceEnd();

echo 
    PHP_EOL . 
    'execution time: ' . round(100 * $debug->getExecutionTime(), 2) . ' ms; ' . 
    'mem: ' . number_format(memory_get_peak_usage()) . 
    PHP_EOL;
//var_dump($debug->getTrace());
