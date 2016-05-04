<?php

/**
 * 评警管理
 *
 * @author KingStar
 */
class ReviewAction extends RabcAction {

    protected $layout = 'layout/p';

    public function index() {
        $model = new SmsReplyModel();
        $cid = $this->getClass();
        $this->assign('class', $cid);
       
        $where = isset($_GET['indate_1']) && strtotime($_GET['indate_1']) ? ' AND s.date >= ' . strtotime($_GET['indate_1']) : '';
        $where .= isset($_GET['indate_2']) && strtotime($_GET['indate_2']) ? ' AND s.date <= ' . strtotime($_GET['indate_2']) : '';

        $result = $model->field('c.name AS cname,p.name,p.no,SUM(s.point) AS point,COUNT(*) AS scount, AVG(s.point) AS avgPoint')
                ->table('dx_police AS p,dx_class AS c, dx_smsreply AS s')
                ->where('c.id = p.cid AND p.no = s.pno AND s.type=\'C\' AND c.id IN(' . $this->getCid() . ')' . $where)
                ->GROUP('p.no')
                ->order('avgPoint DESC')
                ->select();
        $this->assign('date', $result);
        $this->title = '评警信息查看';
        $this->display();
    }

}

?>
