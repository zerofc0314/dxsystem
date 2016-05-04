<?php

/**
 * Description of LogAction
 *
 * @author KingStar
 */
class LogAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $this->title = '登录信息';

        $model = new UserLogModel(); //实例
        import('ORG.Util.Page'); // 导入分页类
        $user = session('rabc');
        
        $data = isset($user['cid']) ? $model->where(array('cid' => $user['cid'])) : $model;
        $count = $data->count();

        $Page = new Page($count, 5); // 实例化分页类 传入总记录数和每页显示的记录数 

        $data = isset($user['cid']) ? $model->where(array('cid' => $user['cid'])) : $model;
        $list = $data->limit($Page->firstRow . ',' . $Page->listRows)->order('id desc')->select();

        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);
        $class = isset($class) ? $class : ClasssModel::model()->class;
        $this->assign('class', $class);
        $this->display();
    }

}

?>
