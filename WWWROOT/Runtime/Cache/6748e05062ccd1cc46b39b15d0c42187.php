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
            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><script type="text/javascript">    function selectCid() {
        var cid = $('#cid').val();
        $("#pno").empty(); //清空警员的下拉框
        $("#pno").selectBox('destroy');
        $.getJSON("<?php echo U('Police/Police?cid=');?>" + cid, function(e) {
            if (e) {
                for (i = 0; i < e.length; i++) {
                    $("<option></option>")
                            .val(e[i].no)
                            .text(e[i].name)
                            .appendTo("#pno");  //填充下拉
                }
            }
            $("#pno").selectBox();
        });
    }
</script><form method="post"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="3%" colspan="4" >                增加家庭（房屋）信息
                <div id='htm'></div></td></tr><tr class="list"><td width="20%">房舍编号：</td><td colspan="3" ALIGN="left"><input type="text" name="no" size="20"><label>* 如A区302室，或255412号</label></td></tr><tr class="list"><td>类型：</td><td ALIGN="left"><select name='type' class="select"><option value="0">自住</option><option value="1">租住</option></select><label>*</label></td><td width="10%">用途：</td><td ALIGN="left"><select name="use" class="select"><option value="10">住宅</option><option value="20">工业 / 交通 / 仓储</option><option value="30">商业 / 金融 / 信息</option><option value="40">教育 / 医疗卫生 / 科研</option><option value="50">文化 / 娱乐 / 体育</option><option value="60">办公</option><option value="70">军事</option><option value="80">其他</option></select></td></tr><tr class="list"><td>房屋电话：</td><td colspan="3" ALIGN="left"><input type="text" name="phone"><label>*家庭（房屋）使用的电话</label></td></tr><tr class="list"><td>负责人：</td><td ALIGN="left"><input type="text" name="link_name" size="6"><label>* 负责人</label></td><td>性别：</td><td ALIGN="left"><select name="link_sex" class="select"><option value="男">男</option><option value="女">女</option></select></td></tr><tr class="list"><td>身份证：</td><td colspan="3" ALIGN="left"><input type="text" name="idcard" size="22"><label>* </label></td></tr><tr class="list"><td>负责人电话：</td><td colspan="3" ALIGN="left"><input type="text" name="link_phone"><label>* 负责人使用的电话</label></td></tr><tr class="list"><td>录入部门：</td><td ALIGN="left"><select name="cid"  id='cid'  onchange="selectCid()"><?php if(is_array($class)): foreach($class as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?></select></td><td>录入警员：</td><td ALIGN="left"><select name="pno" id='pno'><option value=""></option></select></td></tr><tr class="list"><td>家庭（房屋）地址：</td><td colspan="3" ALIGN="left"><input type="text" name="address" size="60"><label> * 请保证地址的唯一，以便于输入群众信息</label></td></tr><tr class="list"><td>备注信息：</td><td colspan="3" ALIGN="left"><input type="text" name="remark" size="60"></td></tr><tr class="bar"><td colspan="4" ><input type="submit" value="增加"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>