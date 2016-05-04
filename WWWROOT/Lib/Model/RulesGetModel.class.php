<?php

/**
 * 详细评分细则
 *
 * @author KingStar
 */
class RulesGetModel extends Model {

    protected $tableName = 'rules_get';

    public function __construct() {
        parent::__construct();
        //检查表ok字段是否正常
        $fields = $this->getField('quarter');
        if (!$fields) {
            //数据库附加季度属性
            $result = $this->query('ALTER TABLE ' . $this->getTableName() . ' ADD COLUMN quarter int(1) DEFAULT 1 ;');
            if ($result)
                exit('数据升级失败，请稍后重试');
        }
    }

    /**
     * 增加细则得分
     * 当前单位cid
     * @return boolean
     */
    public function addRulesGet($nowCid) {
        $time = session('exame');
        if (!$time) {
            return FALSE;
        }
        $user = session('rabc');
        if (!isset($user['cid'])) {
            return FALSE;
        }

        $rules_model = new RulesModel();
        $rules_data = $rules_model->get($user['cid']); //获取细则
        if (!$rules_data){
            return FALSE;
        }
        foreach ($rules_data as $key => $value) {
            if ($this->where(array('rid' => $value['id'], 'quarter' => $time['quarter'], 'cid' => $nowCid))->select()) {
                continue;
            }
            $data['rid'] = $value['id'];
            $data['cid'] = $nowCid;
            $data['date'] = time();
            $data['quarter'] = $time['quarter'];
            $this->add($data);
        }
        return TRUE;
    }

    /**
     * 获取当前选择的部门细则信息
     * @param type $cid
     * @param type $id
     * @return type
     */
    public function getNow($cid, $id = NULL) {
        unset($GLOBALS['refresh']);
        $con = NULL == $id ? '' : ' AND r.id = ' . $id;
        $time = session('exame');
        $user = session('rabc');
        if ($user) {
            $con .= ' AND r.cid = ' . $user['cid'];
        }
        if ($time) {
            $con .= ' AND r.year = ' . $time['year'];
        }
        $result = $this->field('r.*,r.id AS rid, g.*,i.item')
                ->table($this->tablePrefix . 'rules AS r, '
                        . $this->tablePrefix . 'rules_get AS g, '
                        . $this->tablePrefix . 'item AS i '
                )
                ->where('r.id = g.rid AND g.cid = ' . $cid . ' AND i.id = r.iid AND g.quarter = ' . $time['quarter'] . $con
                )
                ->order('r.date ASC')
                ->select();

        if (!$result || count(RulesModel::model()->get($user['cid'])) != count($result)) {
            if ($this->addRulesGet($cid)) {
                $this->getNow($cid);
            }
            $GLOBALS['refresh'] = '<input type=button class=button value=\'请刷新页面\' onclick="javascript:location.reload()"/>';
        }
        return $result ? $result : FALSE;
    }

    /**
     * 获取要进行确认分数的信息
     * @param type $cid 被考核人员
     * @return boolean
     */
    public function getAffirm($time = null, $cid = NULL) {
        $time = NULL == $time ? session('exame') : $time;
        if (NULL == $cid) {
            $cid = session('rabc');
            $cid = $cid['cid'];
        }
        $result = $this->field('i.item,i.id,r.iid,r.cid,SUM(r.point) AS point ,SUM(g.over) AS over , SUM(g.ok) AS ok ,SUM(g.get_point) AS get_point,COUNT(r.id) AS count')
                ->table($this->tablePrefix . 'rules AS r, ' . $this->tablePrefix . 'rules_get AS g, '
                        . $this->tablePrefix . 'item AS i')
                ->where('r.id = g.rid AND r.year = ' . $time['year'] . ' AND g.quarter = ' . $time['quarter']
                        . ' AND g.cid = ' . $cid
                        . ' AND i.id = r.iid')
                ->group('r.iid')
                ->select();
        return $result ? $result : FALSE;
    }

    /**
     * 确认分数(不会入库)
     * @param type $iid     考核科目编号
     * @param type $cid     被确认部门 cid
     * @return boolean      确认是否成功
     */
    public function doAffirm($iid, $cid = NULL) {
        if (!$iid)
            return FALSE;
        if (NULL == $cid) {
            $cid = session('rabc');
            $cid = $cid['cid'];
        }
        $model = new RulesModel();
        $data = $model->field('id')->where('iid=' . $iid . ' AND(bcid = 0 OR bcid = ' . $cid . ') ')->select();
        if ($data) {
            $rid = array();
            foreach ($data as $key => $value) {
                $rid[] = $value['id'];
            }
        } else {
            return FALSE;
        }
        if (!$this->where('cid = ' . $cid . ' AND rid IN (' . implode(',', $rid) . ') AND ok = 0 ')->select()) {
            return FALSE;
        }
        $result = $this->where('cid = ' . $cid . ' AND rid IN (' . implode(',', $rid) . ')')
                ->save(array('ok' => '1'));

        $point = $this->field('SUM(get_point) AS point')->where('cid = ' . $cid . ' AND rid IN (' . implode(',', $rid) . ')')
                ->select();
        if ($point) {
            $point_model = new RankModel();
            $do_result = $point_model->savePoint($point[0]['point']);
        }

        return isset($do_result) && $do_result ? TRUE : FALSE;
    }

    public function get($rid, $cid = NULL) {
        if (!$rid) {
            return FALSE;
        }
        if (NULL == $cid) {
            $cid = session('rabc');
            $cid = $cid['cid'];
        }
        $result = $this->field('*')
                ->where('rid IN ( ' . implode(',', $rid) . ') AND cid = ' . $cid)
                ->select();
        return $result ? $result : FALSE;
    }

}

?>
