<?php
/**
 * UFO Framework.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace App;

use Ufo\Core\Result;
use Ufo\Core\Section;
use Ufo\Modules\ControllerInterface;
use Ufo\Modules\Renderable;

class MyStubController implements ControllerInterface
{
    /**
     * Main controller method.
     * @param Section $section = null
     * @return Result
     */
    public function compose(Section $section = null): Result
    {
        return new Result(new Renderable('My stub output'));
    }
}
