<?php

/**
 * 部门管理
 *
 * @author KingStar
 */
class ClassCAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $model = new ClasssModel(); //部门
        $class = $model->class;
        $sort = SortModel::model()->sort; //类别
        $this->assign('data', array('class' => $class, 'sort' => $sort));
        $this->title = '部门管理';
        $this->display();
    }

    public function add() {
        if ($_POST) {
            $model = new ClasssModel(); //部门
            if ($model->create(array('sid' => (int) $_POST['unit'], 'name' => $_POST['name']))) {
                if ($model->add()) {
                    exit('增加成功');
                }
            }
            exit('添加失败');
            //exit('增加时候出现错误！');
        }
        layout('layout/msg');
        $this->title = '增加部门';
        $sort = SortModel::model()->sort; //类别
        $this->assign('sort', $sort);
        $this->display();
    }

    public function edit() {
        $id = $_GET['id'];
        layout('layout/msg');
        $model = new ClasssModel();
        if ($_POST) {
            if ($model->where(array('id' => $id))->save(array('name' => $_POST['name'], 'sid' => $_POST['unit']))) {
                exit('保存成功');
            }
            exit('保存失败！');
        }
        $this->assign('data', $model->class);
        $this->assign('sort', SortModel::model()->sort);
        $this->display();
    }

    public function del() {
        $model = new ClasssModel();
        if ($_POST['id']) {
            if ($model->where(array('id' => $_POST['id']))->delete()) {
                exit('1');
            }
        }
        exit('0');
    }

    public function item() {
        layout('layout/content');
        $model = new ClasssModel(); //部门
        $class = $model->class;
        $sort = SortModel::model()->sort; //类别
        $this->assign('data', array('class' => $class, 'sort' => $sort));
        $this->title = '权限管理管理';
        $this->display();
    }

    /**
     * 查看可考核部门
     */
    public function showClass() {
        $id = $_GET['id'];
        layout('layout/msg');
        $model = new ClasssModel(); //部门

        $class = $model->class;
        $this_class = $class[$id];
        $this->title = $this_class['name'];
        $control_class = $this_class['class_id']; //获取被考核的id
        if ($control_class) {
            $control_class = explode(',', $control_class);
        }

        if ($_POST) {
            $class_array = $_POST['classC'];
            $class_array = $class_array ? implode(',', $class_array) : NULL;
            
            if ($model->where(array('id' => $id))->save(array('class_id' => $class_array))) {
                exit('更新成功！');
            }
            exit('权限更新失败！');
        }

        $sort = SortModel::model()->sort; //类别
        $this->assign('data', array('class' => $class, 'sort' => $sort));

        $this->assign('control_class', $control_class);
        $this->display('show');
    }

}

?>
