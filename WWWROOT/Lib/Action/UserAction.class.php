<?php

/**
 * 用户管理
 *
 * @author KingStar
 */
class UserAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $this->title = '用户管理';
        $model = new UserModel();
        $this->assign('data', $model->getUser());
        $this->display();
    }

    public function add() {
        layout('layout/msg');
        $this->title = '增加用户';
        if ($_POST) {
            $model = new UserModel();
            $data = $model->create();
            if ($data && $model->add($data)) {
                exit('增加成功！');
            }
            exit('增加失败！');
        }
        $sort = SortModel::model()->sort; //类别
        $class = ClasssModel::model()->class; // 部门
        $this->assign('class', $class);
        $this->assign('sort', $sort);
        $this->display();
    }

    public function del() {
        $id = $_POST['id'];
        if ($id) {
            if (UserModel::model()->where(array('id' => $id))->delete()) {
                exit('1');
            }
        }
        exit('0');
    }

    public function edit() {
        layout('layout/msg');
        $this->title = '修改用户';
        $id = $_GET['id'];
        if (!$id) {
            exit('无此用户');
        }
        $model = new UserModel();
        if ($_POST) {
            if ($model->where(array('id' => $id))->save(array('pass' => $_POST['pass'], 'unit' => $_POST['unit'], 'cid' => $_POST['cid']))) {
                exit('修改成功！');
            }
            exit('修改失败！');
        }

        $user = $model->getUser($id);

        $sort = SortModel::model()->sort; //类别
        $class = ClasssModel::model()->class; // 部门
        $this->assign('class', $class);
        $this->assign('sort', $sort);
        $this->assign('user', $user);
        $this->display();
    }

    public function user() {
        layout('layout/content');
        $this->title = '修改密码';
        $user = session('rabc');
        $model = new UserModel();
        if ($_POST) {
            $user['name'] = $user['name'] == '管理员' ? 'admin' : $user['name'];
            if ($model->changePass($user['name'], $_POST['sub_pwd'], $_POST['admin_pwd1'])) {
                session('rabc', NULL);
                exit('<script>alert("密码修改成功！请使用新密码进行登录");parent.window.location.href = \'' . U('Index/index') . '\';</script>');
            } else {
                $this->error('密码修改失败！');
            }
        }
        $this->assign('user', $user);
        $this->display('pass');
    }

}

?>
