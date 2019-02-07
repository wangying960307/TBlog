<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-6
 * Time: 上午12:16
 */

namespace app\api\controller;


use app\common\controller\ArticleBase;
use app\common\lib\CrudBaseTrait;
use app\common\lib\StarControllerTrait;

class ArticleController extends ArticleBase
{
    use CrudBaseTrait;
    use StarControllerTrait;
}