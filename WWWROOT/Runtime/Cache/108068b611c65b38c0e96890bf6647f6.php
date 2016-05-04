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
            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><script type="text/javascript" src="./Tpl/static/js/suggest/js/coolautosuggest.js"></script><script type="text/javascript" src="./Tpl/static/js/suggest/js/coolfieldset.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/js/suggest/css/coolfieldset.css" /><link rel="stylesheet" type="text/css" href="./Tpl/static/js/suggest/css/coolautosuggest.css" /><script type="text/javascript">    function selectCid() {
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
</script><form method="post"><table width="100%" height='100%' border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="3%" colspan="4" >                增加群众信息
                <div id='htm'></div></td></tr><tr class="list"><td width="20%">家庭(房屋)地址：</td><td colspan="3" ALIGN="left"><input type="text" name="fid" id='fid' size="40"><label> * 支持模糊方式进行查询</label><script language="javascript" type="text/javascript">                    $("#fid").coolautosuggest({
                        url: "<?php echo U('Family/search?adr=');?>"
                    });
                </script></td></tr><tr class="list"><td>姓名：</td><td ALIGN="left"><input type="text" name="name" size="6"><label>* </label></td><td>性别：</td><td ALIGN="left"><select name="sex" class="select"><option value="男">男</option><option value="女">女</option></select></td></tr><tr class="list"><td>状态：</td><td ALIGN="left"><select name='type' class="select"><?php if(is_array($data['type'])): foreach($data['type'] as $key=>$v1): ?><option value="<?php echo ($key); ?>"><?php echo ($v1); ?></option><?php endforeach; endif; ?></select></td><td width="15%">家庭身份：</td><td ALIGN="left"><select name="identity" class="select"><?php if(is_array($data['identity'])): foreach($data['identity'] as $key=>$v2): ?><option value="<?php echo ($key); ?>"><?php echo ($v2); ?></option><?php endforeach; endif; ?></select></td></tr><tr class="list"><td>职业：</td><td colspan="3" ALIGN="left"><input type="text" name="vocation"></td></tr><tr class="list"><td>手机：</td><td colspan="3" ALIGN="left"><input type="text" name="phone"><label> * </label></td></tr><tr class="list"><td>电话：</td><td colspan="3" ALIGN="left"><input type="text" name="tphone"></td></tr><tr class="list"><td>身份证：</td><td colspan="3" ALIGN="left"><input type="text" name="idcard" size="22"><label>* </label></td></tr><tr class="list"><td>居住地：</td><td colspan="3" ALIGN="left"><input type="text" name="now_address" size="60"></td></tr><tr class="list"><td>备注信息：</td><td colspan="3" ALIGN="left"><textarea name="remark" style="width: 80%"></textarea></tr><tr class="bar"><td colspan="4" ><input type="submit" value="增加"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>