<?php

/**
 * 家庭（房屋） 类
 *
 * @author KingStar
 */
class FamilyModel extends Model {

    public $type = array(0 => '自住', 1 => '租住');
    public $use = array(
        10 => '住宅',
        20 => '工业  交通  仓储',
        30 => '商业  金融  信息',
        40 => '教育 医疗卫生 科研',
        50 => '文化  娱乐  体育',
        60 => '办公',
        70 => '军事',
        80 => '其他',
    );
    protected $tableName = 'family';

}

?>
