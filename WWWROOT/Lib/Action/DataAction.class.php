<?php

/* 2013年7月14日
 * 
 */

class DataAction extends RabcAction {

    protected $layout = 'layout/content';

    public function index() {
        $this->title = '数据整理';
        $this->assign('class', $this->getClass());
        $this->display();
    }

    /**
     * 清理考试成绩
     */
    public function clearExam() {
        $cid = $_POST['cid'];
        if (!$cid)
            exit('0');
        //不在考核时间
        $time = session('exame');
        if (!$time)
            exit('0');
        $model = new RulesGetModel();
        $result = $model->table( 'dx_rules_get AS g, '
                        . 'dx_rules AS r ')
                ->where(
                        'g.cid = ' . $cid . ' AND g.quarter = ' . $time['quarter']
                        . ' AND  r.year = ' . $time['year'] . ' AND  r.id=g.rid'
                )
                ->save(array('ok' => 0));
        if ($result)
            exit('1');
        exit('0');
    }

    /**
     * 信息批量入库
     */
    public function affirm() {
        $time = session('exame');
        $class = $this->getClass();
        if (!$time) {
            exit('考核时间未开启');
        }

        $model = new RulesModel();
        $model2 = new RulesGetModel();
        $fail_class = array(); //记录未进行确认的科室

        foreach ($class as $key => $value) {
            //获取当前所有考核的
            $data = $model->field('id')
                    ->where('(bcid = 0 OR bcid = ' . $key . ') AND year =  ' . $time['year'] . ' AND quarter = ' . $time['quarter'])
                    ->select();
            if ($data) {
                $rid = array();
                foreach ($data as $value2) {
                    $rid[] = $value2['id'];
                }
            }
            $fail_affirm = $model2->where('cid = ' . $key . ' AND rid IN (' . implode(',', $rid) . ') AND ok = 0')
                    ->select();
            if ($fail_affirm) {
                // exit('有单位未进行分数确认');
            }
            $point = $model2->field('SUM(get_point) AS point')
                    ->where('cid = ' . $key . ' AND rid IN (' . implode(',', $rid) . ') AND ok = 1')
                    ->select();
            var_dump($key);
            var_dump($point);

            if ($point) {
                $point_model = new RankModel();
                // $point_model->savePoint($point[0]['point'], NULL, $key);
            }
        }
        exit('1');
    }

}

?>
