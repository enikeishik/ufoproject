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

$package = $argv[1];

$src = 'vendor/' . $package . '/composer.json';
$trg = 'resources/templates/default/' . $package . '.json';

if (file_exists($src) && !file_exists($trg)) {
    copy($src, $trg);
}
