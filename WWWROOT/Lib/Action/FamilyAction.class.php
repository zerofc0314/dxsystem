<?php

/**
 * 家庭（房屋） 管理
 *
 * @author KingStar
 */
class FamilyAction extends RabcAction {

    protected $layout = 'layout/p';

    public function index() {
        $this->title = '家庭（房屋）管理';
        $this->getClass(); //将房屋可以用的部门进行输出
        //进行分页输出
        $model = new FamilyModel();
        
        $user = $this->user;
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        
        $where = 'f.pno = p.no AND f.cid IN ('.$cid.')';
        $where .= isset($_GET['cid']) && intval($_GET['cid']) ? ' AND f.cid = ' . $_GET['cid'] : '';
        $where .= isset($_GET['pno']) && intval($_GET['pno']) ? ' AND f.pno = ' . $_GET['pno'] : '';
        $where .= isset($_GET['type']) && intval($_GET['type']) ? ' AND f.type = ' . $_GET['type'] : '';
        $where .= isset($_GET['use']) && intval($_GET['use']) ? ' AND f.type = ' . $_GET['use'] : '';
        $where .= isset($_GET['address']) && intval($_GET['address']) ? ' AND f.address LIKE \'% ' . $_GET['use'] . '%\' ' : '';

        $count = $model->field(' f.*,p.name AS pname ')->table(' dx_police AS p,dx_family AS f ')->where($where)->count();
        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list = $model->field(' f.*,p.name AS pname ')->table(' dx_police AS p,dx_family AS f ')
                ->where($where)
                ->limit($Page->firstRow . ',' . $Page->listRows)->order('f.date desc')
                ->select();
        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->assign('attribute', array('type' => $model->type, 'use' => $model->use));
        $this->display();
    }

    public function add() {
        $user = session('rabc');
        $this->layout = 'layout/p_msg';
        $this->title = '增加家庭（房屋）管理';
        if ($_POST) {
            if (!isset($_POST['idcard']) || strlen($_POST['idcard']) < 18) {
                $this->return_msg('身份证填写错误', 0, 'error');
            }
            $data = $_POST;
            $data['date'] = time();
            if (!isset($_POST['pno']) || !$_POST['pno'] || !intval($_POST['pno'])) {
                $this->return_msg('当前警员未正确选择', 0, 'error');
            }
            $model = new FamilyModel();
            if ($model->add($data)) {
                $this->return_msg('信息增加完成！请刷新', 1, 'success');
            }
            $this->return_msg('信息增加失败！可能必要信息未填写', 0, 'error');
        }
        $this->getClass();
        $this->display();
    }

    public function edit() {
        $this->layout = 'layout/p_msg';
        $this->title = '修改家庭（房屋）信息';
        $id = $_GET['id'];
        if (!$id || !intval($id)) {
            $this->close('参数错误', 'error');
        }
        $model = new FamilyModel();

        if ($_POST) {
            if (!isset($_POST['idcard']) || strlen($_POST['idcard']) < 18) {
                $this->return_msg('身份证填写错误', 0, 'error');
            }
            $data = $_POST;
            if (!isset($_POST['pno']) || !$_POST['pno'] || !intval($_POST['pno'])) {
                $this->return_msg('当前警员未正确选择', 0, 'error');
            }

            if ($model->where(array('id' => $id))->save($data)) {
                $this->return_msg('信息保存成功！请刷新', 1, 'success');
            }
            $this->return_msg('信息修改失败！未做任何修改或数据有误！', 0, 'error');
        }

        $data = $model->field(' f.*,p.name AS pname')->table(' dx_police AS p,dx_family AS f ')->where(array('f.id' => $id))->select();
        if (!$data) {
            $this->close('未获取到信息！', 'error');
        }
        $this->assign('attribute', array('type' => $model->type, 'use' => $model->use));
        $this->assign('data', $data[0]);
        $this->getClass();
        $this->display();
    }

    public function del() {
        $id = $_POST['id'];
        if (!$id || !intval($id)) {
            exit('0');
        }
        $model = new FamilyModel();
        if ($model->where(array('id' => $id))->delete()) {
            exit('1');
        }
        exit('0');
    }

    public function search() {
        $adr = $_GET['adr'];
        if (!$adr) {
            exit('');
        }
        $model = new FamilyModel();
        $reslut = $model->field(' id,address,no ')->where('address LIKE \'%' . $adr . '%\' ')->select();
        echo(json_encode($reslut));
        exit();
    }

}

?>
