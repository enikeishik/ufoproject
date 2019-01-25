<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


// This little utility copy module templates into project resources dir.

if (empty($argv[1])) {
    exit('Usage: php -f loadassets.php vendor/module [--overwrite]');
}

define('MKDIR_MODE', 0755);

/**
 * @param string $src
 * @param string $dst
 */
function xcopy($src, $dst) {
    $files = @scandir($src);
    if (!$files) {
        exit('Call scandir(' . $src . ') failed');
    }
    if (!file_exists($dst)) {
        if (!@mkdir($dst, MKDIR_MODE, true)) {
            exit('Call mkdir(' . $dst . ') failed');
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
                exit('Call mkdir(' . $dstItm . ') failed');
            }
            xcopy($srcItm, $dstItm);
        } else {
            if (!@copy($srcItm, $dstItm)) {
                exit('Call copy(' . $srcItm . ', ' . $dstItm . ') failed');
            }
        }
    }
}

$package = $argv[1];
$overwrite = !empty($argv[2]) && '--overwrite' == $argv[2];

$src = __DIR__ . '/vendor/' . $package . '/resources/templates';
$trg = __DIR__ . '/resources/templates/default/' . $package;

if (file_exists($src) && (!file_exists($trg) || $overwrite)) {
    xcopy($src, $trg);
}
