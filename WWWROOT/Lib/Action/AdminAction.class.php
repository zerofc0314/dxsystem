<?php

/**
 * Description of AdminAction
 *
 * @author KingStar
 */
class AdminAction extends RabcAction {

    public function index() {
        layout('layout/main');
        $this->display();
    }

    public function Aindex() {
        layout('layout/content');
        $this->title = '首页';
        $model = new NoticeModel();
        $user = session('rabc');
        $cid = isset($user['cid']) ? $user['cid'] : 0;
        $data = $model->where(array('cid' => $cid, 'look' => 0))->count();
        $model2 = new MessageModel();
        $data2 = $model2->where('(a_cid = ' . $cid . ' AND read_date IS NULL ) OR ( cid = '.$cid .' AND ok = 1 )')->count();
        $this->assign('data', array($data, $data2));
        $this->display('index');
    }

    /**
     * 用户管理
     */
    public function addUSer() {
        $model = new ClasssModel();
        $class = $model->field('u.*')
                ->table('dx_class AS u, dx_sort AS s')
                ->where('u.sid = s.sid ')
                ->select();
        $user = new UserModel();
        foreach ($class as $key => $value) {
            $user->add(array('name' => $value['name'], 'pass' => '123456', 'unit' => $value['sid'], 'cid' => $value['id']));
        }
    }

    public function open() {
        layout('layout/content');
        $model = new TimeModel();
        $data = $model->where('id=1')->select();
        if ($_POST) {
            $result = $model->where('id=1')->save(array('year' => $_POST['year'], 'quarter' => $_POST['quarter'], 'on' => $_POST['on']));
            if (is_int($result)) {
                $this->redirect('Admin/open');
            }
        }
        $this->assign('data', $data[0]);
        $this->display();
    }

    /**
     * 进行数据备份
     */
    public function export() {
        import('ORG.Util.DBExport');
        header('Content-type: text/plain; charset=UTF-8');
        $dbName = date('Ym-dHis');
        header("Content-Disposition: attachment; filename=\"{$dbName}.sql\"");
        echo DBExport::ExportAllData();
    }

}

?>
