<?php

/**
 * Description of UserModel
 *
 * @author KingStar
 */
class UserModel extends Model {

    protected $tableName = 'user';
    protected $_validate = array(array('name', '', '帐号名称已经存在！', 0, 'unique', 1)); // 在新增的时候验证name字段是否唯一    

    public static function model() {
        $model = new self;
        return $model;
    }

    public function checkUser() {
        $where['name'] = $_POST['user'];
        $result = $this->where($where)->select();
        //直接在用户表中查询
        if ($result && $result[0]['pass'] == $_POST['pass']) {
            cookie('user', $result[0], 86400); //记录cookie 有效期一天
            if ($result[0]['unit'] == 0) {
                session('rabc', array('name' => '管理员'));
            } else {
                session('rabc', $result[0]);
            }
            $model = new UserLogModel();
            $data['user_name'] = $result[0]['name'];
            $data['cid'] = $result[0]['cid'];
            $model->addLog($data);
            if($result[0]['is_unit'] == 0){
                 $police_model = new PoliceModel();
                 $result = $police_model->where(array('no' => $_POST['user'], 'status' => '0'))->select();
                 if(!$result){
                     return FALSE;
                 }
            }
            return TRUE;
            
        } else {
            //进行在警员数据库中查看
            $police_model = new PoliceModel();
            $no = $_POST['user'];
            $pass = $_POST['pass'];
            $result = $police_model->where(array('no' => $no, 'status' => '0'))->select();
            if (!$result) {
                return FALSE;
            }
            if ($result[0]['pass'] != $pass) {
                return FALSE;
            }
            $cid = $result[0]['cid'];
            $result = $this->addPoliceUser($no, $cid, $pass);
            return $result ? $this->checkUser() : FALSE;
        }

        return FALSE;
    }

    public function getUser($id = NULL) {
        if (NULL == $id) {
            $result = $this->field('u.*,c.name AS class_name,s.name AS sort_name')
                    ->table($this->tablePrefix . 'user AS u, ' . $this->tablePrefix . 'class AS c, ' . $this->tablePrefix . 'sort AS s')
                    ->where('u.unit = s.sid AND u.cid = c.id AND u.is_unit <> 0')
                    ->select();
            return $result ? $result : FALSE;
        }
        $result = $this->where(array('id' => $id))->select();
        return $result ? $result : FALSE;
    }

    public function saveDate($data = '', $options = array()) {
        $this->_validate = '';
        parent::save($data, $options);
    }

    public function changePass($user, $oldPass, $newPass) {
        if (!$oldPass || !$newPass || !$user) {
            return FALSE;
        }
        $result = $this->where(array('name' => $user, 'pass' => $oldPass))
                ->save(array('pass' => $newPass));
        return $result ? TRUE : FALSE;
    }

    /**
     * 获取警员信息如果没有则自动新增加一个
     * @param type $no
     * @return boolean
     */
    public function addPoliceUser($no, $cid, $pass) {
        $data['name'] = $no;
        $data['cid'] = $cid;
        $data['pass'] = $pass;
        $data['is_unit'] = 0;
        $class = ClasssModel::model()->class;
        $data['unit'] = $class[$cid]['sid'];
        $result = $this->add($data);
        return $result ? true : FALSE;
    }

}

?>
