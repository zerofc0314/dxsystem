<?php

/**
 * 申诉通知控制器
 *
 * @author KingStar
 */
class MsgAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $this->title = '申诉信息';
        $model = new MessageModel();
        $data = $model->get();
        $class = ClasssModel::model()->class;
        $this->assign('data', $data);
        $this->assign('class', $class);
        $this->display();
    }

    public function send() {
        layout('layout/content');
        $sid = $_GET['sid'];
        $iid = $_GET['iid'];
        $this->title = '考核申诉';
        if ($_POST) {
            $cid = session('rabc');

            $item = $_POST['item'];
            $sid = $_GET['sid'];
            $msg = $_POST['msg'];
            $cid = $cid['cid'];
            $data['item'] = $item;
            $data['cid'] = $cid;
            $data['a_cid'] = $sid;
            $data['msg'] = $msg;
            $data['send_date'] = time();
            $model = new MessageModel();
            $result = $model->add($data);
            if ($result) {
                exit('申诉信息已经递交至主评单位，请等待处理');
            }
            exit('申诉失败');
        }
        $model = new ItemModel();
        $item = $model->field('item')->where(array('id' => $iid))->select();
        if (!$item) {
            exit('参数错误！未找到相关的考核项目');
        }
        $this->assign('item', $item);
        $this->display();
    }

    public function showC() {
        layout('layout/content');
        $this->title = '查看';
        $id = $_GET['id'];
        if (!$id) {
            exit('参数错误！');
        }
        $model = new MessageModel();
        $data = $model->get($id);
        $class = ClasssModel::model()->class;
        $user = session('rabc');
        $user = isset($user['unit']) && $data[0]['a_cid'] == $user['cid'] ? TRUE : FALSE;
        if ($user) {
            if ($_POST) {
                $result = $model->where(array('id' => $id))->save(array('reply_date' => time(), 'reply' => $_POST['reply']));
                if ($result) {
                    exit('处理成功！');
                }
                exit('处理失败！');
            }
            $model->where(array('id' => $id))->save(array('read_date' => time()));
        } else {
            $model->where(array('id' => $id))->save(array('ok' => 2));
        }
        $this->assign('user', $user);
        $this->assign('data', $data[0]);
        $this->assign('class', $class);


        $this->display('show');
    }

    public function repaly() {
        layout('layout/content');
        $this->display();
    }

}

?>
