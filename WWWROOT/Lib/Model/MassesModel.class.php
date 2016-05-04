<?php

/**
 * 群众信息
 *
 * @author KingStar
 */
class MassesModel extends Model {

    public $type = array(0 => '本地', 1 => '外出');
    public $identity = array(//家庭身份
        0 => '户主', 1 => '租客', 2 => '配偶', 3 => '子女', 4 => '其他'
    );
    protected $tableName = 'masses';

    

}

?>
