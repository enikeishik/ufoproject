<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


// This little utility add module service provider 
// and copy module templates into project resources dir.
declare(strict_types=1);

define('USAGE', 'Usage: php -f loadmodule.php vendor/module [--overwrite]');

require_once __DIR__ . '/vendor/autoload.php';


if (empty($argv[1])) {
    exit(USAGE);
}

$package = explode('/', $argv[1]);
if (2 != count($package)) {
    exit(USAGE);
}

$overwrite = !empty($argv[2]) && '--overwrite' == $argv[2];

$modules = new \Utils\Modules(__DIR__);

try {
    $modules->loadModuleData($package);
    $modules->loadModuleTemplates($package, $overwrite);
    $modules->loadModuleDump($package);
} catch (\Utils\FilesystemException $e) {
    echo 'Load module data failed with error: ' . $e->getMessage() . PHP_EOL;
} catch (\Ufo\Core\ConfigParameterEmptyException $e) {
    echo 'Load module dump failed, connection parameters not set in .config' . PHP_EOL;
} catch (\Ufo\Core\DbConnectException $e) {
    echo 'Load module dump failed, connection error, check connection parameters in .config and try again' . PHP_EOL;
} catch (\Ufo\Core\DbQueryException $e) {
    echo 'Load module dump failed, query execution error' . PHP_EOL;
}
