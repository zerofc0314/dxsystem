<?php

/**
 * 走访信息
 *
 * @author KingStar
 */
class InterviewAction extends RabcAction {

    protected $layout = 'layout/p';

    public function index() {
        $this->title = '走访信息';
        $model = new InterviewModel();
        $where = ' f.id = i.fid AND m.id = i.mid AND f.cid IN ('.$this->getCid().')';
        

        $count = $model->field(' f.no,m.name,m.phone,i.date,i.remark')
                ->table(' dx_family AS f,dx_masses AS m,dx_interview AS i ')
                ->where($where)
                ->count();
        $Page = new CPage($count, 16); // 实例化分页类 传入总记录数和每页显示的记录数 
        $list =  $model->field(' f.no,m.name,m.phone,i.date,i.remark ,i.id')
                ->table(' dx_family AS f,dx_masses AS m,dx_interview AS i ')
                ->where($where)
                ->limit($Page->firstRow . ',' . $Page->listRows)->order('i.id desc')
                ->select();
        $show = $Page->show(); // 分页显示输出 
        $this->assign("page", $show);
        $this->assign("list", $list);



        $this->display();
    }

    public function add() {
        $this->layout = 'layout/p_msg';
        $this->title = '增加受访信息';
        if ($_POST) {
            $data = $_POST;
            $data['date'] = time();
            $model = new InterviewModel();
            $result = $model->add($data);

            if ($result) {
                $this->return_msg('增加受访信息成功', 1, 'success');
            }
            $this->return_msg('增加受访信息失败！可能是目标信息未找到', 0, 'error');
        }
        $this->display();
    }
     public function del() {
        $id = $_POST['id'];
        if (!$id || !intval($id)) {
            exit('0');
        }
        $model = new InterviewModel();
        if ($model->where(array('id' => $id))->delete()) {
            exit('1');
        }
        exit('0');
    }

}

?>
