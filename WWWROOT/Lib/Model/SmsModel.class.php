<?php

/**
 * 短信发送类
 *
 * @author KingStar
 */
class SmsModel extends Model {

    public $type = array(
        0 => '全部人员',
        1 => '全部警员',
        2 => '所有派出所警员',
        3 => '其他科室警员',
        4 => '所有群众',
        5 => '所有房屋负责人',
        6 => '其他号码',
        7 => '自定义号码',
    );
    public $smsType = array(
        0 => '通知消息',
        1 => '普通消息'
    );
    public $status = array(
        0 => '队列中',
        1 => '成功',
        2 => '失败'
    );
    protected $tableName = 'sms';

}

?>
