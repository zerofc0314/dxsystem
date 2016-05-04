<?php

/**
 * 用户登录信息
 *
 * @author KingStar
 */
class UserLogModel extends Model {

    protected $tableName = 'user_log';

    public function __construct() {
        parent::__construct();
        $this->where('time < ' . (time() - 60 * 86400))->delete();
    }

    public function addLog($data = array()) {
        if (!is_array($data) || !$data) {
            return FALSE;
        }
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['date'] = time();
        $this->add($data);
        return TRUE;
    }

}

?>
