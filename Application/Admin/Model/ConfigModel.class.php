<?php
namespace Admin\Model;
/**
 * Created by PhpStorm.
 * User: xuexiaofeng
 * Date: 2015-11-3 0003
 * Time: 22:36
 */
class ConfigModel extends BaseModel {


    /**
     * @param array $param  综合条件参数
     * @return array
     */
   public function getList($param = array()) {
        if(!empty($param['page_size'])) {
            $total      = $this->alias('c')->where($param['where'])->count();
            $Page       = $this->getPage($total, $param['page_size'], $param['parameter']);
            $page_show  = $Page->show();
        }

        $model  = $this->alias('c')
            ->field('c.*')
            ->where($param['where'])
            ->order($param['order']);

        //是否分页
        !empty($param['page_size'])  ? $model = $model->limit($Page->firstRow,$Page->listRows) : '';

        $list = $model->select();

        return array('list'=>$list,'page'=>!empty($page_show) ? $page_show : '');
    }

    /**
     * @param $param
     * @return mixed
     */
   public function findRow($param = array()) {

        $row = $this->alias('c')
            ->field('c.*')
            ->where($param['where'])
            ->find();

        return $row;
    }
}