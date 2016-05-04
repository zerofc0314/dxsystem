<?php

/**
 * Description of SmsAction
 *
 * @author KingStar
 */
class SmsAction extends RabcAction {

    protected $layout = 'layout/p';

    public function index() {
        $this->title = '消息群发管理';
        $model = new SmsModel();
        $user = $this->user;
        $pno = isset($user['name']) ? $user['name'] : '';
        if ($_POST) {
            $data = $_POST;
            $phone = $data['phone'];
            $phone = explode("\n", $phone);
            if (strlen($phone[0]) > 11) {
                $phone = explode(" ", $phone[0]);
            }
            if (!$phone) {
                echo('<script>alert("手机号码有误!");history.go(-1);</script>');
            }
            $phone = array_unique($phone); //将号码中的重复号码进行过滤,保留一个有效的重复号码
            $data['pno'] = $pno;
            $data['date'] = time();
            foreach ($phone as $key => $value) {
                if (strlen($value) < 11) {
                    continue;
                }
                if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[01235689]{1}[0-9]{8}$/", $value)) {
                    $data['phone'] = $value;
                    $result = $model->add($data);
                }
            }

            if ($result) {
                $this->redirect('Sms/list');
            }
            echo('<script>alert("发送失败!");history.go(-1);</script>');
        }
        $this->assign('type', $model->type);
        $this->display();
    }

    public function listC() {
        $this->title = '消息发送记录';
        $model = new SmsModel();
        $user = $this->user;
        $where = '1 = 1';

        $count = $model->where($where . ' AND (pno = \'' . $user['name'] . '\' OR pno IN('.$this->getPno().')')
                ->count();
        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list = $model->where($where . ' AND pno = \'' . $user['name'] . '\'')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->order(' id DESC ')
                ->select();

        if (!isset($user['cid']) || $user['is_unit'] == 1) {
            $cid = implode(',', array_keys($this->getClass()));

            $count += $model->field('s.*')
                    ->table('dx_police AS p,dx_sms AS s ')
                    ->where('p.cid IN(' . $cid . ') AND p.no = s.pno')
                    ->count();
            $list1 = $model->field('s.*')
                    ->table('dx_police AS p,dx_sms AS s ')
                    ->where(' p.cid IN(' . $cid . ') AND p.no = s.pno ')
                    ->limit($Page->firstRow . ',' . $Page->listRows)
                    ->order(' s.id DESC ')
                    ->select();

            $list = $list1 ? array_merge($list, $list1) : $list;
        }
        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->assign('attribute', array('ptype' => $model->type, 'type' => $model->smsType, 'status' => $model->status));
        $this->display('list');
    }

    public function del() {
        $id = $_POST['id'];
        if (!$id) {
            exit('0');
        }
        $model = new SmsModel();
        $result = $model->where('id IN(' . $id . ')')->delete();
        if ($result) {
            exit('1');
        }
        exit('0');
    }

    public function send() {
        $id = $_POST['id'];
        if (!$id) {
            exit('0');
        }
        $model = new SmsModel();
        $result = $model->where('id IN(' . $id . ')')->save(array('status' => 0));
        if ($result) {
            exit('1');
        }
        exit('0');
    }

    public function sendMsg() {
        $this->title = '发送短信';
        if ($_POST) {
            $data = $_POST;
            $data['phone'] = $_GET['phone'];
            if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[01235689]{1}[0-9]{8}$/", $value)) {
                $date['ptype'] = 7;
                $data['date'] = time();
                $user = $this->user;
                $pno = isset($user['name']) ? $user['name'] : '';
                $model = new SmsModel();
                if ($model->add($data)) {
                    echo('<script>alert("成功!");</script>');
                    exit;
                }
                echo('<script>alert("发送失败!");history.go(-1);</script>');
                exit;
            }
        }

        $this->display('oneSMS');
    }

}

?>
