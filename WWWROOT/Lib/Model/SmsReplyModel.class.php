<?php

/**
 * 短信回复记录
 *
 * @author KingStar
 */
class SmsReplyModel extends Model {

    protected $tableName = 'smsReply';
    public $type = array(
        'A' => '评论信息',
        'B' => '建议信息',
        'C' => '评警信息',
        'D' => '异常信息'
    );

}

?>
