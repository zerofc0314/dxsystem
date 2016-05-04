<?php

/**
 * 部门管理
 *
 * @author KingStar
 */
class ClasssModel extends Model {

    protected $tableName = 'class';
    public $class = array();
    protected $_validate = array(array('name', '', '帐号名称已经存在！', 0, 'unique', 1)); // 在新增的时候验证name字段是否唯一    

    public function __construct() {
        parent::__construct();
        $result = $this->order('sid ASC')->select();
        foreach ($result as $key => $value) {
            $this->class[$value['id']] = $value;
        }
    }

    public static function model() {
        $model = new self;
        return $model; 
    }
    
    public function getClassBySid($sid){
        $sid = (int)$sid;
        if(!$sid){
            return FALSE;
        }
        $result = $this->where(array('sid'=>$sid))->select();
        return $result ? $result : FALSE;
        
    }
    
    


}

?>
