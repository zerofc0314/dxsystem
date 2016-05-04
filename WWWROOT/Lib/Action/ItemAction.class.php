<?php

/**
 * 考核科目管理
 *
 * @author KingStar
 */
class ItemAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $this->title = '考核科目设置';
        $item = ItemModel::model()->get();
        $this->assign('data', $item);
        $this->display();
    }

    public function add() {
        layout('layout/msg');
        $this->title = '增加考核项目';
        if ($_POST) {
            $model = new ItemModel();
            $model->create();
            if ($model->add()) {
                exit('增加成功');
            }
            exit('增加失败');
        }
        $class = ClasssModel::model()->class; // 部门
        $this->assign('class', $class);
        $this->display();
    }

    public function edit() {
        layout('layout/msg');
        $this->title = '修改用户';
        $id = $_GET['id'];
        if (!$id) {
            exit('无此信息');
        }
        $model = new ItemModel();
        if ($_POST) {
            $model->create();
            if ($model->where(array('id' => $id))->save()) {
                exit('保存成功');
            }
            exit('保存失败！1.未进行更改，2.数值不正确');
        }
        $class = ClasssModel::model()->class; // 部门
        $this->assign('class', $class);
        $item = $model->get($id);
        $this->assign('data', $item);
        $this->display();
    }

    public function del() {
        $model = new ItemModel();
        if ($_POST['id']) {
            if ($model->where(array('id' => $_POST['id']))->delete()) {
                exit('1');
            }
        }
        exit('0');
    }

}

?>
