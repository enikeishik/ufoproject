<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Utils;

class Filesystem
{
    public static $mode = 0755;
    /**
     * @param string $src
     * @param string $dst
     * @throws \Utils\FilesystemException
     */
    public static function xcopy(string $src, string $dst): void
    {
        $files = @scandir($src);
        if (!$files) {
            throw new FilesystemException('Call scandir(' . $src . ') failed');
        }
        if (!file_exists($dst)) {
            if (!@mkdir($dst, static::$mode, true)) {
                throw new FilesystemException('Call mkdir(' . $dst . ') failed');
            }
        }
        
        foreach ($files as $file) {
            if ('.' == $file || '..' == $file) {
                continue;
            }
            $srcItm = $src . '/' . $file;
            $dstItm = $dst . '/' . $file;
            if (is_dir($srcItm)) {
                if (!@mkdir($dstItm, static::$mode, true)) {
                    throw new FilesystemException('Call mkdir(' . $dstItm . ') failed');
                }
                static::xcopy($srcItm, $dstItm);
            } else {
                if (!@copy($srcItm, $dstItm)) {
                    throw new FilesystemException('Call copy(' . $srcItm . ', ' . $dstItm . ') failed');
                }
            }
        }
    }
}
