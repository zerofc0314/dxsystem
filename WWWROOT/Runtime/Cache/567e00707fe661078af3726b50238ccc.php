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
            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><script type="text/javascript" src="./Tpl/static/js/suggest/js/coolautosuggest.js"></script><script type="text/javascript" src="./Tpl/static/js/suggest/js/coolfieldset.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/js/suggest/css/coolfieldset.css" /><link rel="stylesheet" type="text/css" href="./Tpl/static/js/suggest/css/coolautosuggest.css" /><script type="text/javascript">    function selectMid(adr) {
        $("#mid").empty(); //清空下拉框
        $("#mid").selectBox('destroy');
        $('#fid').val('');
        $.post("<?php echo U('Masses/search');?>", 'adr=' + adr, function(e) {
            if (e != 'null') {
                e = eval("(" + e + ")");
                $('#fid').val(e[0].fid);
                for (i = 0; i < e.length; i++) {
                    $("<option></option>")
                            .val(e[i].mid)
                            .text(e[i].name + '(' + e[i].sex + ')')
                            .appendTo("#mid");  //填充下拉
                }
            }
            $("#mid").selectBox();
        });

    }

</script><form method="post"><table width="100%" height='100%' border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="3%" colspan="4" >                增加受访信息
                <div id='htm'></div></td></tr><tr class="list"><td width="20%">家庭(房屋)地址：</td><td colspan="3" ALIGN="left"><input type="text" name="adr" id='adr' size="40" onblur="selectMid(this.value)"><label> * 支持模糊方式进行查询</label><script language="javascript" type="text/javascript">    $("#adr").coolautosuggest({
        url: "<?php echo U('Family/search?adr=');?>"
    });
                </script><input type="hidden" name="fid" id="fid"></td></tr><tr class="list"><td>姓名：</td><td ALIGN="left" colspan="3"><select name="mid" id="mid"></select><label>* </label></td></tr><tr class="list"><td>备注信息：</td><td colspan="3" ALIGN="left"><textarea name="remark"  style="height: 200px;width: 400px;"></textarea></tr><tr class="bar"><td colspan="4" ><input type="submit" value="增加"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>