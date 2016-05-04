<?php

/**
 * 号码库管理
 *
 * @author KingStar
 */
class NOBankAction extends RabcAction {

    protected $layout = 'layout/p';
    private $Model;

    public function __construct() {
        parent::__construct();
        $this->Model = new NOBankModel();
    }

    public function index() {
        $this->title = '号码库管理';
        $model = $this->Model;
        $where = ' pno IN (' . $this->getPno() . ')';
        $where .= isset($_GET['type']) ? ' AND b.type=' . $_GET['type'] : '';
        $count = $model->field(' b.* ')->table(' dx_NOBank AS b ')
                ->where($where)
                ->count();
        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list = $model->field(' b.* ')->table(' dx_NOBank AS b ')
                ->where($where)
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->select();
        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->assign('attribute', array('type' => $model->type));
        $this->display();
    }

    public function add() {
        $this->layout = 'layout/p_msg';
        $this->title = '号码库管理';
        $user = session('rabc');
        if (!isset($user['cid']) || $user['is_unit'] == 1) {
            $this->close('系统允许警员以外的人员进行添加!', 'error');
        }
        $model = $this->Model;
        if ($_POST) {
            $phone = $_POST['phone'];
            //进行相似度检查
            $phone = explode("\n", $phone);
            $phone_search = implode(',', $phone);
            $time = strtotime(date('Y-m-01', time())); //当月时间
            $result = $model->where('phone IN (' . $phone_search . ') AND type = 4 AND date>= ' . $time . ' AND date <= ' . ($time + 86400 * 30))->select();
            if (count($result) > (count($phone) / 2)) {
                $this->close('您增加的号码不符合规则,请勿进行复制其他警员号码.', 'error');
            } else {
                $data['name'] = '其他';
                $data['type'] = 4;
                $data['pno'] = $user['name'];
                $this->addNo($data);
                $this->close('号码增加成功!请刷新', 'success');
            }
            $this->close('号码增加失败!请刷新', 'error');
        }
        $this->assign('attribute', array('type' => $model->type));
        $this->display();
    }

    /**
     * 号码整理
     */
    public function neaten() {
        $user = session('rabc');
        if (!isset($user['cid']) || $user['is_nuit'] == 1) {
            $this->police();
        }
        $this->family();
        $this->masses();
        $this->close('号码整理完毕!请刷新', 'success');

        //进行民警号码整理
    }

    private function police() {
        $model = new PoliceModel();
        $user = $this->user;
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        $reslut = $model->field('name,phone,no')->where('cid IN (' . $cid . ')')->select();
        foreach ($reslut as $key => $value) {
            $data['pno'] = $value['no'];
            $data['name'] = $value['name'];
            if ($value['phone'] != NULL && strlen($value['phone'] >= 7)) {
                $data['type'] = 0;
                $data['phone'] = $value['phone'];
                $this->addNo($data);
            }
        }
    }

    private function family() {
        $model = new FamilyModel();
        $user = $user = session('rabc');
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        $reslut = $model->field('link_phone,phone,link_name,pno')->where('cid IN (' . $cid . ')')->select();
        foreach ($reslut as $key => $value) {
            $data['pno'] = $value['pno'];
            $data['name'] = $value['link_name'];
            if ($value['phone'] != NULL && strlen($value['phone'] >= 7)) {
                $data['type'] = 1;
                $data['phone'] = $value['phone'];
                $this->addNo($data);
            }
            if ($value['link_phone'] != NULL && strlen($value['link_phone'] >= 7)) {
                $data['type'] = 2;
                $data['phone'] = $value['phone'];
                $this->addNo($data);
            }
        }
    }

    private function masses() {
        $model = new MassesModel();
        $user = $user = session('rabc');
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        $reslut = $model->field('m.phone,m.name,f.pno')->table('dx_masses AS m,dx_family AS f')
                ->where('f.cid IN (' . $cid . ') AND m.fid = f.id ')
                ->select();
        foreach ($reslut as $key => $value) {
            $data['pno'] = $value['pno'];
            $data['name'] = $value['name'];
            if ($value['phone'] != NULL && strlen($value['phone'] >= 7)) {
                $data['type'] = 3;
                $data['phone'] = $value['phone'];
                $this->addNo($data);
            }
        }
    }

    private function addNo($data) {
        $model = $this->Model;
        $data['date'] = strtotime(date('Y-m-01', time()));
        if (!$model->where($data)->select()) {
            $model->add($data);
        }
    }

    public function del() {
        $id = $_POST['id'];
        if (!$id || !intval($id)) {
            exit('0');
        }
        $model = new NOBankModel();
        if ($model->where(array('id' => $id))->delete()) {
            exit('1');
        }
        exit('0');
    }

    public function getNO() {
        $user = session('rabc');
        $where = ' p.no = n.pno';
        $type = $_GET['type'];
        if ($type != 0 && !intval($type)) {
            exit;
        }
        //进行权限获取
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $where.=' AND n.pno = ' . $user['name']; //如果是警员的话则只可以获取自己名下的号码
        } else {

            $where .= ' AND p.cid IN(' . $this->getCid() . ')';
        }

        $model = $this->Model;
        $select_model = $model->field('n.phone')->table(' dx_NOBank AS n,dx_police AS p');

        if ($type == 0) { //全体人员
            $result = $select_model->where($where)->select();
        } elseif ($type == 1) {//所有警员的
            $result = $select_model->where($where . ' AND n.type = 0 AND p.cid IN(' . $this->getCid() . ')')->select();
        } elseif ($type == 2) {//所有派出所的警员
            $result = $model->field('n.phone')
                    ->table(' dx_NOBank AS n,dx_police AS p,dx_class AS c ')
                    ->where($where . ' AND n.pno = p.no AND p.cid = c.id AND c.sid = 3 AND n.type=0 ')
                    ->select();
        } elseif ($type == 3) {//非派出所的警员
            $result = $model->field('n.phone')
                    ->table(' dx_NOBank AS n,dx_police AS p,dx_class AS c ')
                    ->where($where . ' AND n.pno = p.no AND p.cid = c.id AND c.sid <> 3 AND n.type=0 ')
                    ->select();
        } elseif ($type == 4) {
            $result = $select_model->where($where . ' AND n.type = 3 ')->select();
        } elseif ($type == 5) {
            $result = $select_model->where($where . ' AND n.type = 2')->select();
        } elseif ($type == 6) {
            $result = $select_model->where($where . ' AND n.type = 4 ')->select();
        }
        // $result =  ? json_encode($result) : '0';
        exit(json_encode($result));
    }

}

?>
