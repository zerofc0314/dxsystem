<?php

/**
 * 通知类
 *
 * @author KingStar
 */
class NoticeModel extends Model {

    protected $tableName = 'notice';

    public static function model() {
        $model = new self;
        return $model;
    }

}

?>
