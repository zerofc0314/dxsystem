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
            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><form method="post"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="3%" colspan="4" >                增加警员
            </td></tr><tr class="list"><td width="20%">警员编号：</td><td colspan="3" ALIGN="left"><input type="text" name="no" size="20"><label>* 警员唯一编号</label></td></tr><tr class="list"><td>密码：</td><td colspan="3" ALIGN="left"><input type="text" name="pass"  size="15"><label>* 用于登录评警系统密码</label></td></tr><tr class="list"><td>姓名：</td><td ALIGN="left"><input type="text" name="name" size="8"><label>*</label></td><td width="10%">性别：</td><td ALIGN="left"><select name="sex"><option> 男</option><option>女</option></select></td></tr><tr class="list"><td>所属部门：</td><td colspan="3" ALIGN="left"><select name="cid"><?php  if(isset($data['user']['c_cid']) && NULL != $data['user']['c_cid']){ $cid = explode(',', $data['user']['c_cid']); foreach($cid as $v){ echo '<option value="'.$data['class']['$v']['id'].'">'.$data['class'][$v]['name'].'</option>'; } }elseif(!isset($data['user']['cid'])){ foreach($data['class'] as $v){ echo '<option value="'.$v['id'].'">'.$v['name'].'</option>'; } } ?><option value="<?php echo ($data['user']['cid']); ?>"><?php echo ($data['class'][$data['user']['cid']]['name']); ?></option></select></td></tr><tr class="list"><td>警衔：</td><td colspan="3" ALIGN="left"><input type="text" name="type"><label>*警员警衔</label></td></tr><tr class="list"><td>手机：</td><td colspan="3" ALIGN="left"><input type="text" name="phone"><label>*如：18070390000</label></td></tr><tr class="list"><td>电话：</td><td colspan="3" ALIGN="left"><input type="text" name="tphone"></td></tr><tr class="list"><td>入警时间：</td><td colspan="3" ALIGN="left"><input type="text" name="in_date"  class="Wdate" onClick="WdatePicker()"><label>*如：2013-03-26</label></td></tr><tr class="list"><td>联系地址：</td><td colspan="3" ALIGN="left"><input type="text" name="address" size="60"></td></tr><tr class="list"><td>状态：</td><td colspan="3" ALIGN="left"><select name="status"><option value="0">正常</option><option value="1">停用</option></select></td></tr><tr class="bar"><td colspan="4" ><input type="submit" value="增加"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>