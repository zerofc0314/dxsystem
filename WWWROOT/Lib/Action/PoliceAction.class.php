<?php

/**
 * 警员管理
 *
 * @author KingStar
 */
class PoliceAction extends RabcAction {

    protected $layout = 'layout/p';

    public function listC() {
        $this->title = '警员列表';
        $model = new PoliceModel();
        
        $user= $this->user;
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        $where = 'cid IN ( ' . $cid . ') ';
        //进行筛选部门
        $where .= isset($_GET['cid']) && intval($_GET['cid']) ? ' AND cid = ' . $_GET['cid'] : '';
        //进行入警时间筛选
        $where .= isset($_GET['indate_1']) && strtotime($_GET['indate_1']) ? ' AND in_date >= ' . strtotime($_GET['indate_1']) : '';
        $where .= isset($_GET['indate_2']) && strtotime($_GET['indate_2']) ? ' AND in_date <= ' . strtotime($_GET['indate_2']) : '';
        //进行状态筛选
        $where .= isset($_GET['status']) && intval($_GET['status']) ? ' AND status = ' . $_GET['status'] : '';

        $count = $model->where($where)->count();
        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list = $model->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id desc')->select();
        $show = $Page->show(); // 分页显示输出 

        $this->assign("page", $show);
        $this->assign("list", $list);
        $class = isset($class) ? $class : ClasssModel::model()->class;
        $this->assign('class', $class);
        $this->assign('getPwd', UserModel::model());
        $this->display('list');
    }

    public function add() {
        $this->layout = 'layout/p_msg';
        $this->title = '增加警员';

        if ($_POST) {
            $data = $_POST;
            $data['in_date'] = strtotime($data['in_date']);
            if (!$data['pass'] || strlen($data['no']) < 5 || strlen($data['phone']) < 11 || !$data['in_date']) {
                $this->return_msg('警员信息填写错误！', 0, 'error');
            }
            $model = new PoliceModel();
            $result = $model->where(array('no' => $data['no']))->select();
            if (!$result) {
                $result = $model->add($data);
                if ($result) {
                    $this->return_msg('警员信息增加成功', 1, 'success');
                }
            }
            $this->return_msg('警员信息增加失败', 1, 'error');
        }
        $class = ClasssModel::model()->class;
        $user = session('rabc');
        $this->assign('data', array('class' => $class, 'user' => $user));
        $this->display();
    }

    public function edit() {
        $this->layout = 'layout/p_msg';
        $id = $_GET['id'];
        if (!$id || !intval($id)) {
            $this->return_msg('警员信息获取失败', 1, 'error');
        }
        $model = new PoliceModel();
        $data = $model->where(array('id' => $id))->select();
        if (!$data) {
            $this->return_msg('警员信息获取失败', 1, 'error');
        }
        if ($_POST) {
            $data = $_POST;
            $data['in_date'] = strtotime($data['in_date']);
            if (!$data['pass'] || strlen($data['phone']) < 11 || !$data['in_date']) {
                $this->return_msg('警员信息填写错误！', 0, 'error');
            }
            $result = $model->where(array('id' => $id))->select();
            if ($result) {
                $result = $model->where(array('id' => $id))->save($data);
                if ($result) {
                    $this->return_msg('警员信息修改成功', 1, 'success');
                }
            }
            $this->return_msg('警员信息修改失败', 1, 'error');
        }

        $class = ClasssModel::model()->class;
        $this->assign('class', $class);
        $this->assign('data', $data[0]);
        $this->display();
    }

    public function del() {
        $id = $_POST['id'];
        $model = new PoliceModel();
        if (!$id || !intval($id)) {
            exit('0');
        }
        $result = $model->where(array('id' => $id))->delete();
        if ($result) {
            exit('1');
        }
        exit('0');
    }

    public function Police() {
        $cid = $_GET['cid']; //获取所属但闻
        if (!$cid || !intval($cid)) {
            exit;
        }
        $model = new PoliceModel();
        
        if (isset($user['is_unit']) && $user['is_unit'] == 0) {
            $data = $model->where('cid IN ('.$this->getCid().')')->select();
        } else {
            $data = $model->where(array('cid' => $cid))->select();
        }
        exit(json_encode($data));
    }

}

?>
