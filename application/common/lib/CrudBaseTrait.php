<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午10:49
 */

namespace app\common\lib;


use think\Model;

trait CrudBaseTrait
{
    /**
     * 当前控制器对应的模型，需要在手动initialize中初始化
     * @var $model Model
     */
    protected $model = null;

    /**
     * 执行add方法后的返回值类型,可选model或者null或者pk
     * 默认返回pk(主键)
     * model即为刚创建的model
     * @var string
     */
    protected $addAfterResponseType = 'pk';
    public function index()
    {
        $order = input('order', 'desc');
        $page = input('page', 1);
        $size = input('size', 10);
        $list = $this->model
            ->where('id', $order)
            ->page($page, $size)
            ->select();

        return success($list);
    }

    public function read($id)
    {
        return success($this->model->where($this->model->getPk(),$id)->findOrFail());
    }

    public function add()
    {
        $this->model->allowField(true)->save(input());
        switch ($this->addAfterResponseType){
            case 'model':
                return success($this->model);
            case 'pk':
                $pk = $this->model->getpk();
                return success([$pk => $this->model->$pk]);
            default:
                return success();
        }
    }

    public function delete()
    {
        $this->model
            ->where('id', input('id'))
            ->delete();

        return success();
    }

    public function update()
    {
        $this->model
            ->isUpdate(true)
            ->save(input());

        return success();
    }
}