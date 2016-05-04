<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" src="./Tpl/static/js/jquery.js"></script><script type="text/javascript" src="./Tpl/static/js/DatePicker/WdatePicker.js"></script><script type="text/javascript" src="./Tpl/static/js/selectBox.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/css/selectBox.css" /><style type="text/css"><!--
                body {
                    margin-left: 0px;
                    margin-top: 0px;
                    margin-right: 0px;
                    margin-bottom: 0px;
                    font-size: 12px;
                }
                .bar td{
                    background-image: url(./Tpl/static/images/bg.gif);
                    background-repeat: repeat-x;
                    background-color: #FFFFFF;
                    height: 22px;
                    text-align: center;
                }
                .list {
                    background-color: #FFFFFF;
                    text-align: center;
                }
                label{
                    color: red;
                    margin-left: 10px;
                }
                --></style><script type=text/javascript>                $(document).ready( function() {
                    $("select").selectBox();
                });
            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><form method="post"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="3%" colspan="4" >                编辑警员
            </td></tr><tr class="list"><td width="20%">警员编号：</td><td colspan="3" ALIGN="left"><input type="text" name="no" size="20" readonly disabled value="<?php echo ($data['no']); ?>"><label>* 警员唯一编号</label></td></tr><tr class="list"><td>密码：</td><td colspan="3" ALIGN="left"><input type="text" name="pass"  size="15" value="<?php echo ($data['pass']); ?>"><label>* 用于登录评警系统密码</label></td></tr><tr class="list"><td>姓名：</td><td ALIGN="left"><input type="text" name="name" size="8" value="<?php echo ($data['name']); ?>"><label>*</label></td><td width="10%">性别：</td><td ALIGN="left"><select name="sex"><option><?php echo ($data['sex']); ?></option><option>男</option><option>女</option></select></td></tr><tr class="list"><td>所属部门：</td><td colspan="3" ALIGN="left"><select name="cid"><option value="<?php echo ($data['cid']); ?>"><?php echo ($class[$data['cid']]['name']); ?></option><?php  $user = session('rabc'); var_dump($user); if(isset($user['c_cid']) && NULL != $user['c_cid']){ $cid = explode(',', $user['c_cid']); foreach($cid as $v){ echo '<option value="'.$class['$v']['id'].'">'.$class[$v]['name'].'</option>'; } }elseif(!isset($user['cid'])){ foreach($class as $v){ echo '<option value="'.$v['id'].'">'.$v['name'].'</option>'; } } ?></select></td></tr><tr class="list"><td>警衔：</td><td colspan="3" ALIGN="left"><input type="text" name="type" value="<?php echo ($data['type']); ?>"><label>*警员警衔</label></td></tr><tr class="list"><td>手机：</td><td colspan="3" ALIGN="left"><input type="text" name="phone" value="<?php echo ($data['phone']); ?>"><label>*如：18070390000</label></td></tr><tr class="list"><td>电话：</td><td colspan="3" ALIGN="left"><input type="text" name="tphone" value="<?php echo ($data['tphone']); ?>"></td></tr><tr class="list"><td>入警时间：</td><td colspan="3" ALIGN="left"><input type="text" name="in_date"  class="Wdate" onClick="WdatePicker()" value="<?php echo date('Y-m-d',$data['in_date']); ?>"><label>*如：2013-03-26</label></td></tr><tr class="list"><td>联系地址：</td><td colspan="3" ALIGN="left"><input type="text" name="address" size="60" value="<?php echo ($data['address']); ?>"></td></tr><tr class="list"><td>状态：</td><td colspan="3" ALIGN="left"><select name="status"><option value="0">正常</option><option value="1">停用</option></select></td></tr><tr class="bar"><td colspan="4" ><input type="submit" value="保存"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>