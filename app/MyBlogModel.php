<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace App;

/**
 * Module level model base class.
 */
class MyBlogModel
{
    /**
     * Some model method.
     * @return array
     */
    public function getItems(): array
    {
        return [
            ['id' => 1, 'title' => 'first item title', 'text' => 'first item text'], 
            ['id' => 2, 'title' => 'second item title', 'text' => 'second item text', 'disabled' => true], 
            ['id' => 3, 'title' => 'third item title', 'text' => 'third item text'], 
            ['id' => 4, 'title' => 'fourth item title', 'text' => 'fourth item text'], 
        ];
    }
}
