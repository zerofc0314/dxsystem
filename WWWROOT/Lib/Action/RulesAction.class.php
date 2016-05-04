<?php

/**
 * 细则控制类
 *
 * @author KingStar
 */
class RulesAction extends RabcAction {

    public function index() {
        layout('layout/content');
        $this->title = '考核管理';
        $cid = $_GET['cid'];
        $model = new RulesGetModel();
        $class = ClasssModel::model()->class;
        $this->assign('class', $class);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($_POST) {
                $data['get_point'] = intval($_POST['get_point']) ? $_POST['get_point'] : 0;
                $data['review'] = $_POST['review'];
                $data['over'] = 1;
                //保存未进行分数确认的
                if ($id && $model->where(array('rid' => $id, 'cid' => $cid, 'ok' => 0))->save($data)) {
                    $this->redirect('Rules/index?cid=' . $cid);
                }
                $this->error('评分时保存失败！可能已经确认分数！请返回！');
            }
            $data = $model->getNow($cid, $id);
            $data = $data[0];
        } else {
            $data = $model->getNow($cid);
        }
        $this->assign('data', $data);
        $this->display((isset($_GET['id']) ? 'grade' : 'index'));
    }

    /**
     * 细则管理
     */
    public function admin() {
        layout((!isset($_GET['id']) ? 'layout/content' : 'layout/word'));
        $this->title = '细则管理';
        $user = session('rabc');
        $rules = new RulesModel();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($_POST) {
                $rules = new RulesModel();
                $data['iid'] = $_POST['item_name'];
                if (!intval($_POST['point'])) {
                    $this->error('修改失败！分数设置错误');
                }
                $data['point'] = $_POST['point'];
                $data['bcid'] = intval($_POST['sub_name']) ? $_POST['sub_name'] : 0;
                $data['content'] = stripslashes(htmlspecialchars_decode($_POST['content']));
                $data['year'] = $_POST['year'];
                //$data['quarter'] = $_POST['quarter'];
                if ($rules->where(array('id' => $id))->save($data)) {
                    $this->redirect('Rules/admin');
                }
                $this->error('修改失败！未做任何修改');
            }
            $class = $this->getUnit(); //可以被考核的部门
            $data = $rules->get($user['cid'], $id);
            if (!$data) {
                $this->error('您指定的数据不存在');
            }
            $data = $data[0];
            $model = new ItemModel();
            $item = $model->where(array('cid' => $user['cid']))->select();
            $this->assign('item', $item);   //所可以考核的科目
        } else {
            $data = $rules->get($user['cid']);
            $class = ClasssModel::model()->class;
        }
        $this->assign('class', $class);   //所有部门
        $this->assign('data', $data);   //已经添加的细则
        $this->display((!isset($_GET['id']) ? 'admin' : 'admin_edit'));
    }

    /**
     * 增加细则
     */
    public function add() {
        layout('layout/word');
        $this->title = '增加细则';
        $model = new ItemModel();
        $user = session('rabc');
        $class = $this->getUnit();
        if ($_POST) {
            $rules = new RulesModel();
            $data['iid'] = $_POST['item_name'];
            if (!intval($_POST['point'])) {
                exit('添加失败，分数设置错误');
            }
            $data['point'] = $_POST['point'];
            $data['cid'] = $user['cid'];
            $data['bcid'] = intval($_POST['sub_name']) ? $_POST['sub_name'] : 0;
            $data['content'] = stripslashes(htmlspecialchars_decode($_POST['content']));
            $data['year'] = $_POST['year'];
            // $data['quarter'] = $_POST['quarter'];
            $data['date'] = time();
            $pk = $rules->add($data); //获取插入后的主键
            if ($pk) {
                $this->redirect('Rules/admin');
            }
            exit('添加失败');
        }

        $item = $model->where(array('cid' => $user['cid']))->select();
        $this->assign('item', $item);   //所可以考核的科目
        $this->assign('class', $class);   //所可以考核的部门
        $this->display();
    }

    /**
     * 细则删除
     */
    public function del() {
        if (!isset($_POST['id'])) {
            exit('0');
        }
        $id = $_POST['id'];
        if (!$id) {
            exit('0');
        }
        $model1 = new RulesModel();
        $model2 = new RulesGetModel();
        if ($model1->where(array('id' => $id))->delete() && $model2->where(array('rid' => $id))->delete()) {
            exit('1');
        }
        exit('0');
    }

    public function getRules() {
        layout('layout/word');
        $this->display();
    }

}

?>
