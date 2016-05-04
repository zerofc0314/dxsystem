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
            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><script type="text/javascript">    var sub = 0;
    var arr = new Array();
    function zl() {
        var PhoneDate = document.getElementById("phone").innerText;
        if (PhoneDate != "") {
            arr = $.trim(PhoneDate).split("\n");
            arr = $.grep(arr, function(n, i) {
                if (n.length >= 11 && n.length <= 13) {
                    return n;
                }
            })

            arr = arr.sort();
            for (i = 0; i < arr.length; i++) {
                if (arr[i] == arr[i + 1]) {
                    delete arr[i];
                }
            }
            document.getElementById("phone").innerText = arr.join("\n");
            arr = $.trim(document.getElementById("phone").innerText).split("\n");
            arr = $.grep(arr, function(n, i) {
                if (n.length >= 11 && n.length <= 13) {
                    return n;
                }
            });

            var partten = /^1[3,5,8]\d{9}/;
            arr = $.grep(arr, function(n) {
                if (partten.test(n)) {
                    return n;
                }
            });
            document.getElementById("phone").innerText = arr.join("\n");
            $("#bt_msg").html("已将非手机号码与固话、小灵通号码过滤重复完毕,剩余号码个数为:" + arr.length + "个");
            document.getElementById("phone").innerText = arr.join("\n");
            sub = 1;
        }
        else {
            $("#bt_msg").html("<font color=red>未导入号码</font>")
        }
    }
    function FormSubmit(){
        if(sub==1){
            form.submit();
            return;
        }
        alert('未导入任何号码或号码未进行整理');
    }
</script><form method="post" id='form'><table width="100%" height='100%' border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="6%" colspan="4" >                增加其他号码
                <div id='htm'></div></td></tr><tr class="list"><td width='50px'>类型：</td><td ALIGN="left" colspan="3">                其他号码
            </td></tr><tr class="list"><td>号码：</td><td colspan="3" ALIGN="left" style="height: 200px;width:400px;"><textarea name="phone" id='phone' style="height: 200px;width:200px;"></textarea><label><br>注意: 将号码粘贴至此,多个号码请用回车键隔开,请勿重复导入相同的号码</label></tr><tr class="list"><td colspan="4" ><label id='bt_msg'></label><br><input type="button" value="整理" onclick="zl()"/></td></tr><tr class="bar"><td colspan="4" ><input type="button" value="增加" onclick="FormSubmit()"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>