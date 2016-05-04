<?php

/**
 * 短信回复操作
 *
 * @author KingStar
 */
class SmsReplyAction extends RabcAction {

    protected $layout = 'layout/p';

    public function index() {
        $this->title = '消息回复管理';
        $model = new SmsReplyModel();
        $where = ' pno IN('.$this->getPno().') ';
        $user = $this->user;
        if (isset($user['is_unit']) && $user['is_unit'] == 0) {
            $where .= ' AND pno =\'' . $_GET['pno'] . '\'';  //传入警员号码进行
        } else {
            $pm = new PoliceModel();
            $cid = implode(',', array_keys($this->getClass()));
            $police = $pm->field('no')->where('cid IN ( ' . $cid . ')')->select();
            if (!$police) {
                $where = '1=-1';
            } else {
                $where .= isset($_GET['pno']) && in_array(array('no' => '20050881'), $police) ? ' AND pno =\'' . $_GET['pno'] . '\'' : '';  //传入警员号码进行
            }
        }

        $where .=isset($_GET['type']) ? ' AND type=\'' . $_GET['type'] . '\'' : '';
        $where .= isset($_GET['indate_1']) && strtotime($_GET['indate_1']) ? ' AND date >= ' . strtotime($_GET['indate_1']) : '';
        $where .= isset($_GET['indate_2']) && strtotime($_GET['indate_2']) ? ' AND date <= ' . strtotime($_GET['indate_2']) : '';

        $count = $model->where($where)->count();

        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list = $model->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('date desc')->select();

        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);
        $this->assign('type', $model->type);
        $this->display();
    }

    /* 进行生成数据
      public function addReply() {
      $text = $_GET['text'];
      $phone = $_GET['phone'];
      $model = new SmsReplyModel();
      for ($i = 1; $i < 1000; $i++) {
      $data['type'] = substr($text, 0, 1);
      $data['phone'] = $phone;
      $temp_int1 = strpos($text, 'M');
      $data['content'] = substr($text, $temp_int1 + 1);
      $temp_int2 = strpos($text, 'S');
      //未找到分值信息的时候则不是评警信息,或评警信息为空
      if (!$temp_int2) {
      $data['pno'] = substr($text, 1, $temp_int1 - 1);
      } else {
      $data['pno'] = substr($text, 1, $temp_int1 - 3);
      $data['point'] = substr($text, $temp_int2 + 1, $temp_int1 - $temp_int2 - 1);
      }
      $data['date'] = time();
      $data['text'] = $text;
      $model->add($data);
      }
      exit;
      }
     */
    /*     * 随机数据填充
      public function a() {
      $model = new PoliceModel();
      $result = $model->select();
      $sms = new SmsReplyModel();

      foreach ($result as $key => $value) {
      $data['type'] = 'C';
      $data['date'] = time();
      $data['point'] = rand(0, 10);
      $data['phone'] = '1807039'.rand(1000, 9999);
      $data['pno'] = $value['no'];
      $data['content'] = '民警服务态度较好!';
      $data['text'] = 'A'.$data['pno'].'S'.$data['point'].'M'.$data['content'];
      $sms->add($data);
      }
      exit('完成');

      } */

    public function del() {
        $id = $_POST['id'];
        if (!$id) {
            exit('0');
        }
        if ((isset($this->user['cid']) && $this->user['is_unit'] != 0) || !isset($this->user['cid'])) {
            $model = new SmsReplyModel();
            $result = $model->where('id IN(' . $id . ')')->delete();
            if ($result) {
                exit('1');
            }
        }
        exit('0');
    }

}

?>
