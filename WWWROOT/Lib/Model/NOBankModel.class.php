<?php

/**
 * 号码库
 *
 * @author KingStar
 */
class NOBankModel extends Model {

    public $type = array(
        0 => '民警号码',
        1 => '房屋号码',
        2 => '房屋负责',
        3 => '群众号码',
        4 => '其他号码'
    );
    protected $tableName = 'NOBank';

}

?>
