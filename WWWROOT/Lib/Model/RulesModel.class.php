<?php

/**
 * 细则信息
 *
 * @author KingStar
 */
class RulesModel extends Model {

    protected $tableName = 'rules';

    /**
     * 通过主考cid获取当下细则部分
     * @param type $cid     主考id
     * @param type $id      细则id
     */
    static function model() {
        return new self;
    }

    public function get($cid, $id = NULL) {
        $con = NULL == $id ? '' : ' AND c.id = ' . $id;
        $time = session('exame');
        if ($time) {
            $con .= ' AND c.year = ' . $time['year'];
        }
        $result = $this->field('c.*,u.item')
                ->table($this->tablePrefix . 'item AS u, ' . $this->tablePrefix . 'rules AS c')
                ->where('c.iid = u.id AND c.cid = ' . $cid . $con)
                ->order('c.date ASC')
                ->select();
        return $result ? $result : FALSE;
    }

    public function getRid($iid, $time = NULL) {
        if (NULL == $time) {
            $time = session('exame');
        }
        $result = $this->field('*')
                ->where(array('iid' => $iid, 'year' => $time['year']))
                ->select();
        return $result ? $result : FALSE;
    }

}

?>
