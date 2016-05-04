<?php

/**
 * 消息类，包括申诉信息
 *
 * @author KingStar
 */
class MessageModel extends Model {

    protected $tableName = 'message';

    /**
     * 申诉信息的id号码
     * @param type $id 申诉消息的id
     */
    public function __construct() {
        parent::__construct();
        //检查表ok字段是否正常
        $fields_ok = $this->getField('ok');
        if (!$fields_ok) {
            $result = $this->query('ALTER TABLE dx_message ADD COLUMN ok int(1)DEFAULT 0 ;');
            if ($result)
                exit('数据升级失败，请稍后重试');
        }
    }

    public function get($id = NULL) {
        $where = ' 1 = 1';
        $user = session('rabc');
        if ($id == NULL) {
            if (isset($user['unit']) && $user['unit'] != 4) {
                $where = $where . ' AND (cid=' . $user['cid'] . ' OR a_cid = ' . $user['cid'] . ')';
            }
        } else {
            $where = $where . ' AND id=' . $id;
        }
        $reslut = $this->where($where)->order('id DESC')->select();
        return $reslut ? $reslut : FALSE;
    }

}

?>
