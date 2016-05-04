<?php

/**
 * 排名信息
 *
 * @author KingStar
 */
class RankModel extends Model {

    protected $tableName = 'rank';

    /**
     * 保存分数 当前季度
     * @param type $point 分数
     * @param type $time  考核时间
     * @return type       保存成功与否
     */
    public function savePoint($point = 0, $time = NULL, $cid = NULL) {
        $time = NULL == $time ? session('exame') : $time;
        $cid = $cid == NULL ? session('rabc') : $cid;
        $cid = $cid['cid'];
        $result = $this->where(array('year' => $time['year'], 'quarter' => $time['quarter'], 'cid' => $cid))
                ->select();
        if (!$result) {
            $result = $this->add(array('year' => $time['year'], 'quarter' => $time['quarter'], 'cid' => $cid, 'point' => $point));
        } else {
            $result = $this->where(array('year' => $time['year'], 'quarter' => $time['quarter'], 'cid' => $cid))
                    ->save(array('point' => $result[0]['point'] + $point));
        }
        return $result ? TRUE : FALSE;
    }

    /**
     * 获取排名
     * @param type $cid
     * @return boolean
     */
    public function getRank($cid, $year, $quarter = 0) {
        if (!$cid || !$year) {
            return FALSE;
        }
        if ($quarter == 0) {
            $point = 'sum_point';
            $sql = '';
        } else {
            $point = 'point';
            $sql = ' AND g.quarter = ' . $quarter;
        }

        $model = new RulesGetModel();
        $result = $model->field('SUM(g.get_point) AS ' . $point . ',g.cid')
                ->table('dx_rules AS r,dx_rules_get AS g')
                ->where('g.ok = 1 AND r.year = ' . $year .$sql. '  AND r.id = g.rid AND g.cid IN (' . $cid . ')')
                ->group('g.cid')
                ->order($point.' DESC')
                ->select();
        return $result ? $result : FALSE;
    }

    /**
     * 获取年度排行
     * @param type $cid
     * @param type $year
     * @return boolean
     */
    public function getYearRank($cid, $year) {
        if (!$cid || !$year) {
            return FALSE;
        }
        $count = $this->field('COUNT(*)')->where('cid IN ( ' . $cid . ' ) AND year = ' . $year)
                ->select();
        // if ($count != (count(explode(',', $cid) * 4))) {
        // return FALSE;
        // }
        $result = $this->field('*,SUM(point) AS sum_point')
                ->where('cid IN ( ' . $cid . ' ) AND year = ' . $year)
                ->group('cid')
                ->order(' sum_point DESC')
                ->select();
        return $result ? $result : FALSE;
    }

}

?>
