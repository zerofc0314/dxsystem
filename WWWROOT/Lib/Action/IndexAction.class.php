<?php

class IndexAction extends Action {

    public function index() {
        if ($_POST) {
            if (session('verify') != md5($_POST['code'])) {
                $this->error('验证码错误！');
            }
            $model = new UserModel();
            if ($model->checkUser()) {
                $this->redirect('Admin/index');
            } else {
                exit('<script>alert("登录失败！请重新登录");parent.window.location.href = \'' . U('Index/index') . '\';</script>');
            }
        }
        session('rabc', NULL);
        session('exame',NULL);
        $this->display();
    }

    public function code() {
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }

}