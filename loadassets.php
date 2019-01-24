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
    exit('Usage: php -f loadassets.php vendor/module');
}

define('MKDIR_MODE', 0755);

/**
 * @param string $src
 * @param string $dst
 * @throws \Exception
 */
function xcopy($src, $dst) {
    $files = @scandir($src);
    if (!$files) {
        exit('Call scandir for `' . $src . '` failed');
    }
    if (!file_exists($dst)) {
        if (!@mkdir($dst, MKDIR_MODE, true)) {
            exit('Call mkdir for `' . $dst . '` failed');
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
                exit('Call mkdir for `' . $dstItm . '` failed');
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

$src = __DIR__ . '/vendor/' . $package . '/resources';
$trg = __DIR__ . '/resources/templates/default/' . $package;

if (file_exists($src) && !file_exists($trg)) {
    xcopy($src, $trg);
}
