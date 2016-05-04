<?php

/**
 * 群众信息
 *
 * @author KingStar
 */
class MassesAction extends RabcAction {

    protected $layout = 'layout/p';

    public function index() {
        $this->title = '群众信息管理';
        $model = new MassesModel();
         $user = $this->user;
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        
        $where = 'm.fid = f.id AND f.pno = p.no AND f.cid IN ('.$cid.')';

        /* $where .= isset($_GET['cid']) && intval($_GET['cid']) ? ' AND f.cid = ' . $_GET['cid'] : '';
          $where .= isset($_GET['pno']) && intval($_GET['pno']) ? ' AND f.pno = ' . $_GET['pno'] : '';
          $where .= isset($_GET['type']) && intval($_GET['type']) ? ' AND f.type = ' . $_GET['type'] : '';
          $where .= isset($_GET['use']) && intval($_GET['use']) ? ' AND f.type = ' . $_GET['use'] : '';
          $where .= isset($_GET['address']) && intval($_GET['address']) ? ' AND f.address LIKE \'% ' . $_GET['use'] . '%\' ' : '';
         */
        $count = $model->field(' f.no,p.name AS pname,m.* ')
                ->table(' dx_police AS p,dx_family AS f,dx_masses AS m ')
                ->where($where)
                ->count();
        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list = $model->field(' f.no,p.name AS pname,m.* ')
                ->table(' dx_police AS p,dx_family AS f,dx_masses AS m ')
                ->where($where)
                ->limit($Page->firstRow . ',' . $Page->listRows)->order('m.id desc')
                ->select();
        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->assign('attribute', array('type' => $model->type, 'identity' => $model->identity));
        $this->display();
    }

    public function add() {
        $this->layout = 'layout/p_msg';
        $this->title = '增加群众信息';
        $user = session('rabc');
        if (!isset($user['is_unit']) || $user['is_unit'] != 0) {
            $this->close('当前账户不是警员账户，不允许进行录入', 'error');
        }
        $model = new MassesModel();
        if ($_POST) {
            $data = $_POST;
            $fid = $data['fid'];
            if (!$fid) {
                $this->return_msg('请输入家庭（房屋）地址', 0, 'error');
            }
            $family_model = new FamilyModel();
            $result = $family_model->where(array('address' => $fid))->select();
            if (!$result) {
                $this->return_msg('您输入家庭（房屋）地址不存在！', 0, 'error');
            }
            if ($result[0]['pno'] != $user['name']) {
                $this->return_msg('您输入家庭（房屋）地址不属于您管理！', 0, 'error');
            }
            $data['fid'] = $result[0]['id'];
            $result = $model->add($data);
            if ($result) {
                $this->return_msg('信息增加完成！请刷新', 1, 'success');
            }
            $this->return_msg('群众信息增加失败！', 0, 'error');
        }
        $this->assign('data', array('type' => $model->type, 'identity' => $model->identity));
        $this->display();
    }

    public function del() {
        $id = $_POST['id'];
        if (!$id || !intval($id)) {
            exit('0');
        }
        $model = new MassesModel();
        if ($model->where(array('id' => $id))->delete()) {
            exit('1');
        }
        exit('0');
    }

    public function edit() {
        $this->layout = 'layout/p_msg';
        $this->title = '修改群众信息';
        $id = $_GET['id'];
        if (!$id || !intval($id)) {
            $this->close('参数错误', 'error');
        }
        $model = new MassesModel();
        //进行提交保存操作
        if ($_POST) {

            $data = $_POST;
            $fid = $data['fid'];
            if (!$fid) {
                $this->return_msg('请输入家庭（房屋）地址', 0, 'error');
            }
            $user = session('rabc');
            if (!isset($user['is_unit']) || $user['is_unit'] != 0) {
                $this->close('当前账户不是警员账户，不允许更改', 'error');
            }
            //进行地址检测
            $family_model = new FamilyModel();
            $result = $family_model->where(array('address' => $fid))->select();
            if (!$result) {
                $this->return_msg('您输入家庭（房屋）地址不存在！', 0, 'error');
            }
            if ($result[0]['pno'] != $user['name']) {
                $this->return_msg('您输入家庭（房屋）地址不属于您管理！', 0, 'error');
            }
            $data['fid'] = $result[0]['id'];
            $result = $model->where(array('id' => $id))->save($data);
            if ($result) {
                $this->return_msg('信息保存完成！请刷新', 1, 'success');
            }
            $this->return_msg('群众信息修改失败！', 0, 'error');
        }

        $data = $model->field(' f.address,m.* ')
                        ->table(' dx_family AS f,dx_masses AS m ')
                        ->where(array('m.id' => $id))->select();
        if (!$data) {
            $this->close('未获取到信息！', 'error');
        }

        $this->assign('attribute', array('type' => $model->type, 'identity' => $model->identity));
        $this->assign('data', $data[0]);
        $this->display();
    }

    public function search() {
        $adr = $_POST['adr'];
        if (!$adr) {
            exit('');
        }
        $model = new MessageModel();
        $reslut = $model->field(' m.id AS mid,m.name,m.sex,f.id AS fid ')
                ->table('dx_family AS f,dx_masses AS m ')
                ->where('f.address = \'' . $adr . '\' AND f.id =m.fid')
                ->select();
        echo(json_encode($reslut));
        exit();
    }

}

?>
