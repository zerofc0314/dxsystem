<?php

/**
 * 列别
 *
 * @author KingStar
 */
class SortModel extends Model {

    protected $tableName = 'sort';
    public $sort = array(); //部门列表

    public function __construct() {
        parent::__construct();
        $result = $this->select();
        if ($result) {
            foreach ($result as $key => $value) {
                $this->sort[$value['sid']] = $value;
            }
        }
    }

    public static function model() {
        $model = new self;
        return $model;
    }

    public function getData($sid) {
        if (!$sid || !intval($sid)) {
            return FALSE;
        }
        $result = $this->where(array('sid' => $sid));
        if ($result) {
            session('rabc', $result[0]);
            return TRUE;
        }
        return FALSE;
    }

}

?>
