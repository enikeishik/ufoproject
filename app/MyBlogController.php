<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace App;

use Ufo\Core\DIObject;
use Ufo\Modules\Controller;
use Ufo\Modules\ModelInterface;
use Ufo\Modules\View;
use Ufo\Modules\ViewInterface;

class MyBlogController extends Controller
{
    /**
     * @see parent
     */
    protected function getModel(): ModelInterface
    {
        return new MyBlogModel();
    }
    
    /**
     * @see parent
     */
    protected function getView(): ViewInterface
    {
        $view = new View('myblog', $this->data);
        $view->inject($this->container);
        return $view;
    }
}
