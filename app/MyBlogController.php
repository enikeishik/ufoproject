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
use Ufo\Core\Result;
use Ufo\Core\Section;
use Ufo\Modules\ControllerInterface;
use Ufo\Modules\View;

class MyBlogController extends DIObject implements ControllerInterface
{
    /**
     * Main controller method.
     * @param Section $section = null
     * @return Result
     */
    public function compose(Section $section = null): Result
    {
        $config = $this->container->get('config');
        
        $model = new MyBlogModel();
        
        $data = [
            'title'     => $section->title, 
            'items'     => $model->getItems(), 
        ];
        
        $view = new View('myblog', $data);
        $view->inject($this->container);
        
        return new Result($view);
    }
}
