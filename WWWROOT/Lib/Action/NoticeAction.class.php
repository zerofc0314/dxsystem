<?php

/**
 * 通知管理
 *
 * @author KingStar
 */
class NoticeAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $this->title = '通知消息';
        $model = new NoticeModel();
        import('ORG.Util.Page'); // 导入分页类

        $user = session('rabc');

        if (!isset($user['cid'])) {
            $data = $model;
        } else {
            $data = $model->where('s_cid = ' . $user['cid'] . ' OR cid = ' . $user['cid']);
        }

        $count = $data->count();
        $Page = new Page($count, 25); // 实例化分页类 传入总记录数和每页显示的记录数

        if (!isset($user['cid'])) {
            $user['cid'] = 0;
            $data = $model;
        } else {
            $data = $model->where('s_cid = ' . $user['cid'] . ' OR cid = ' . $user['cid']);
        }

        $list = $data->limit($Page->firstRow . ',' . $Page->listRows)->order('look ASC,type DESC,id DESC')->select();

        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);

        $class = ClasssModel::model()->class;
        $this->assign('class', $class);
        $this->assign('data', $data);
        $this->assign('user', $user);
        $this->display();
    }

    public function add() {
        layout('layout/word');
        $this->title = '发送信息';
        $user = session('rabc');
        if (isset($_POST['content'])) {
            $model = new NoticeModel();
            $cid = $_POST['cid'];
            $data['content'] = stripslashes(htmlspecialchars_decode($_POST['content']));
            $data['s_cid'] = isset($user['cid']) ? $user['cid'] : 0;
            $data['title'] = $_POST['title'] = $_POST['title'];
            $data['date'] = time();
            $data['type'] = $_POST['type'];
            $result = 0;
            foreach ($cid as $key => $value) {
                $data['cid'] = $value;
                if (!$model->add($data)) {
                    $result++;
                }
            }
            if (!$result) {
                exit('消息发送成功！');
            }
            if ($result > 0 && $result != count($cid)) {
                exit('部分发送失败！');
            }
            exit('消息发送失败');
        }
        $class = ClasssModel::model()->class;
        $this->assign('class', $class);
        $this->assign('user', $user);
        $this->display();
    }

    public function showC() {
        layout('layout/content');
        $this->title = '通知消息';
        $id = $_GET['id'];
        if (!$id) {
            exit('信息不存在！请刷新后重试！');
        }
        $model = new NoticeModel();
        $data = $model->where(array('id' => $id))->select();
        if (!$data) {
            exit('信息不存在！请刷新后重试！');
        }
        $user = session('rabc');
        if (isset($user['cid']) && $user['cid'] == $data[0]['cid']) {
            $model->where(array('id' => $id))->save(array('look' => 1));
        }
        $this->assign('data', $data[0]);
        $class = ClasssModel::model()->class;
        $this->assign('class', $class);
        $this->display('show');
    }

    public function del() {
        $id = $_POST['id'];
        if ($id) {
            $model = new NoticeModel();
            $result = $model->where(array('id' => $id))->delete();
            if ($result) {
                exit('1');
            }
        }
        exit('0');
    }

}

?>
