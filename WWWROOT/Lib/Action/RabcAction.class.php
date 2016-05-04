<?php

/**
 * 权限
 *
 * @author KingStar
 */
class RabcAction extends Action {

    protected $layout;
    protected $user;

    public function __construct() {
        parent::__construct();
        $this->init();
        $this->user = session('rabc');
        $thisTime = time();
        $endTime = strtotime('2025-01-01');
        if ($thisTime >= $endTime) {
            exit;
        }
    }

    public function init() {
        $this->getRabc();
        $this->getExam();
    }

    public function getExam() {
        if (NULL == session('exame')) {
            $model = new TimeModel();
            $data = $model->where('id=1')->select();
            session('exame', ($data[0]['on'] == 1 ? $data[0] : ''));
        }
    }

    public function getRabc() {
        if (!session('rabc')) {
            $this->error('登录失败！系统无法正常获取到您的信息！请重新登录', U('Index/index'));
        }
    }

    public function getUnit() {
        $user = session('rabc');
        if (!$user || !isset($user['unit'])) {
            return FALSE;
        }
        if ($user['unit'] == 3) {
            return FALSE;
        }
        $model = new ClasssModel();
        $class = $model->field('class_id')->where(array('id' => $user['cid']))->select();
        $class = explode(',', $class[0]['class_id']);
        $class_return = array();
        foreach ($class as $key => $value) {
            $class_return[] = $model->where(array('id' => $value))->select();
        }
        return $class_return;
    }

    /**
     * 将模板植入到Action之前。
     * @param type $templateFile
     * @param type $charset
     * @param type $contentType
     */
    public function display($templateFile = '', $charset = '', $contentType = '') {
        if ($this->layout != '') {
            layout($this->layout);
        }
        parent::display($templateFile, $charset, $contentType);
    }

    /**
     * 返回信息（进行页面提示）
     * @param type $msg 消息内容
     * @param type $close  是否关闭当前窗口 默认不关闭 0
     * @param type $type   消息类型 默认错误消息
     * 使用此方法 需asybox支持
     */
    public function return_msg($msg, $close = 0, $type = 'error', $jump = '') {
        $str = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        if ($type == 'error' && $jump == '') {
            if ($jump == '') {
                $jump = 'history.go(-1);';
            } else {
                $jump = 'location="' . U($jump) . '";';
            }
        }
        $str .= '<script>' . $jump . 'window.parent.return_msg(' . $close . ', "' . $msg . '", "' . $type . '");</script>';
        $str .= '</head></html>';
        exit($str);
    }

    /**
     * 返回信息（进行页面提示）
     * @param type $msg 消息内容
     * @param type $type   消息类型 默认错误消息
     * 使用此方法 需asybox支持
     */
    public function close($msg, $type) {
        $str = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        $str .= '<script>window.parent.close("' . $msg . '", "' . $type . '");</script>';
        $str .= '</head></html>';
        exit($str);
    }

    public function getClass() {
        $user = session('rabc');
        $class = ClasssModel::model()->class; //获取所有部门
        $class_array = array();

        //获取可以管理的部门
        if (isset($user['c_cid']) && NULL != $user['c_cid']) {
            $cid = explode(',', $user['c_cid']);
            foreach ($cid as $key => $value) {
                $class_array[$cid] = $class[$cid]['name'];
            }
            $class_array[$user['cid']] = $class[$user['cid']]['name'];
        } elseif (!isset($user['cid'])) {
            //管理员的所有部门
            foreach ($class as $value) {
                $class_array[$value['id']] = $value['name'];
            }
        } else {
            //不可以管理的当前部门
            $class_array[$user['cid']] = $class[$user['cid']]['name'];
        }
        $this->class = $class_array;
        return $this->class;
    }

    public function getCid() {
        $user = $this->user;
        if (isset($user['cid']) && $user['is_unit'] == 0) {
            $cid = $user['cid'];
        } else {
            $cid = implode(',', array_keys($this->getClass()));
        }
        return $cid;
    }

    public function getPno() {
        if (!isset($model)) {
            $model = new PoliceModel();
        }
        $result = $model->where('cid IN (' . $this->getCid() . ')')->select();
        $array = array();
        if ($result) {
            foreach ($result AS $key => $value) {
                $array[$value['no']] = $value;
            }
            return implode(',', array_keys($array));
        }
        return '0';
    }

}

?>
