<?php

/**
 * 分数确认.排名.管理
 *
 * @author KingStar
 */
class ExameAction extends RabcAction {

    /**
     * 分数确认浏览
     */
    public function affirm() {
        layout('layout/content');
        $this->title = '分数确认';
        $class = ClasssModel::model()->class; //加载所有部门
        if (isset($_GET['year'])) {
            $time['year'] = $_GET['year'];
            $time['quarter'] = $_GET['quarter'];
        } else {
            $time = session('exame');           //加载当前考试的信息 
        }
        $user = array();
        if (isset($_GET['cid'])) {
            $cid = $_GET['cid'];
            $user['cid'] = $cid;
        } else {
            $user = session('rabc');             //加载当前登录的用户信息

            if (!isset($user['cid'])) {
                exit('分数确认是被考核部分当前时间考试的快捷确认途径.您是管理员,无法使用本功能.');
            }
        }
        if (!$time) {
            $this->error('考试暂为开启,或不在考试时间允许内.请等待考试开始后进行分数确认');
        }
        $model = new RulesGetModel();
        $data = !isset($_GET['cid']) ? $model->getAffirm() : $model->getAffirm($time, $cid);
        $this->assign('data', $data);
        $this->assign('class', $class); //传入部门信息
        $this->assign('user', $user);    //传入当前用户信息
        $this->assign('time', $time);   //传入考试信息
        $this->display((isset($_GET['cid']) ? 'list' : 'affirm'));
    }

    public function doAffirm() {
        $iid = $_POST['iid']; //获取要确认的科目id
        $model = new RulesGetModel();
        if ($model->doAffirm($iid)) {
            exit('1');
        }
        exit('0');
    }

    public function rank() {
        layout('layout/content');
        $this->title = '排名查看';
        if ($_POST) {
            $year = $_POST['year'];  //获取年费
            $quarter = $_POST['quarter']; //获取季度
            $sid = $_POST['sid'];   //查询类别
            $class = ClasssModel::model()->getClassBySid($sid);
            $class_name = ClasssModel::model()->class; //部门名称
            $model = new RankModel();
            if ($class) {
                  $cid = array();
                  foreach ($class as $key => $value) {
                  $cid[] = $value['id'];
                  }
                  $cid = implode(',', $cid);
                    if(!$quarter){
                        $quarter =  0; 
                        $display = 'year';
                    }else{
                        $display = 'quarter';
                    }
                    $result = $model->getRank($cid, $year, (int)$quarter);
                    if (!$result) {
                        $this->error('您查询的信息出现错误，请返回！');
                    }
                    $this->assign('class', $class_name);
                    $this->assign('data', $result);
                    $this->display($display);
                exit;
            }
        }
        $this->display();
    }

    public function rules() {
        layout('layout/content');
        $this->title = '细则查看';
        $model = new RulesGetModel();
        $mode_1 = new RulesModel();
        //需要查看的时间
        $time['year'] = $_GET['year'];
        $time['quaryer'] = $_GET['quarter'];
        $iid = $_GET['item'];   //获取项目id
        //获取被考的cid
        if (isset($_GET['cid'])) {
            $cid = $_GET['cid'];
        } else {
            $cid = session('rabc');
            $cid = $cid['cid'];
        }

        $data = $mode_1->getRid($iid, $time);  //获取相应的细则部分
        $rid = array();
        $rules = array();
        if ($data) {
            foreach ($data as $key => $value) {
                $rid[] = $value['id'];
                $rules[$value['id']] = $value;
            }
            $rules_get = $model->get($rid, $cid);
        }

        $this->assign('rules', $rules);
        $this->assign('cid', $cid);
        $this->assign('data', $rules_get);
        $class = ClasssModel::model()->class; //加载所有部门
        $this->assign('class', $class); //传入部门信息
        $this->display();
    }

}

?>
