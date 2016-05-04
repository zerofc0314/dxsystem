<?php

/**
 * 考核项目
 *
 * @author KingStar
 */
class ItemModel extends Model {

    protected $tableName = 'item';

    public static function model() {
        $model = new self;
        return $model;
    }

    public function get($id = NULL) {
        if ($id == NULL) {
            $result = $this->field('u.*,c.name AS class_name')
                    ->table($this->tablePrefix . 'item AS u, ' . $this->tablePrefix . 'class AS c')
                    ->where('u.cid = c.id')
                    ->order('u.cid ASC')
                    ->select();
            return $result ? $result : FALSE;
        }
        $result = $this->where(array('id' => $id))->select();
        return $result ? $result : FALSE;
    }

}

?>
