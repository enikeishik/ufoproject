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
define('STORAGE', __DIR__ . '/data/modules.php');
define('MKDIR_MODE', 0755);

require_once __DIR__ . '/vendor/autoload.php';

/**
 * @param string $src
 * @param string $dst
 * @throws \Exception
 */
function xcopy(string $src, string $dst): void
{
    $files = @scandir($src);
    if (!$files) {
        throw new \Exception('Call scandir(' . $src . ') failed');
    }
    if (!file_exists($dst)) {
        if (!@mkdir($dst, MKDIR_MODE, true)) {
            throw new \Exception('Call mkdir(' . $dst . ') failed');
        }
    }
    
    foreach ($files as $file) {
        if ('.' == $file || '..' == $file) {
            continue;
        }
        $srcItm = $src . '/' . $file;
        $dstItm = $dst . '/' . $file;
        if (is_dir($srcItm)) {
            if (!@mkdir($dstItm, MKDIR_MODE, true)) {
                throw new \Exception('Call mkdir(' . $dstItm . ') failed');
            }
            xcopy($srcItm, $dstItm);
        } else {
            if (!@copy($srcItm, $dstItm)) {
                throw new \Exception('Call copy(' . $srcItm . ', ' . $dstItm . ') failed');
            }
        }
    }
}

/**
 * @param array $modules
 * @return string
 */
function getModulesStorageCode(array $modules): string
{
    if (0 == count($modules)) {
        return '<?php' . PHP_EOL . 'return [' . PHP_EOL . '];' . PHP_EOL;
    }
    
    return '<?php' . PHP_EOL . 
        'return [' . PHP_EOL . 
        '    \\' . implode('::class,' . PHP_EOL . '    \\', $modules) . '::class,' . PHP_EOL . 
        '];' . PHP_EOL;
}

/**
 * @param array $package
 * @return bool
 */
function loadModuleData(array $package): bool
{
    $mspCls = 'Ufo\Modules\\' . 
        ucfirst($package[0]) . '\\' . ucfirst($package[1]) . 
        '\\ServiceProvider';

    $modules = @include STORAGE;
    if (!is_array($modules)) {
        $modules = [];
    }

    if (!in_array($mspCls, $modules) && class_exists($mspCls)) {
        $modules[] = $mspCls;
        return false !== @file_put_contents(STORAGE, getModulesStorageCode($modules));
    }
    
    return true;
}

/**
 * @param array $package
 * @return bool
 */
function loadModuleTemplates(array $package, bool $overwrite): bool
{
    $src = __DIR__ . '/vendor/' . $package[0] . '/' . $package[1] . '/resources/templates';
    $trg = __DIR__ . '/resources/templates/default/' . $package[0] . '/' . $package[1];

    if (file_exists($src) && (!file_exists($trg) || $overwrite)) {
        try {
            xcopy($src, $trg);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    return true;
}



if (empty($argv[1])) {
    exit(USAGE);
}

$package = explode('/', $argv[1]);
if (2 != count($package)) {
    exit(USAGE);
}

$overwrite = !empty($argv[2]) && '--overwrite' == $argv[2];

if (!loadModuleData($package)) {
    exit('Load module data failed' . PHP_EOL);
}
if (!loadModuleTemplates($package, $overwrite)) {
    exit('Load module templates failed' . PHP_EOL);
}
