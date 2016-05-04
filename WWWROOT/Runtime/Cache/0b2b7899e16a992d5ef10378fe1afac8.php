<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" src="./Tpl/static/js/jquery.js"></script><script type="text/javascript" src="./Tpl/static/js/asyncbox/AsyncBox.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/js/asyncbox/skins/ZCMS/asyncbox.css" /><script type="text/javascript" src="./Tpl/static/js/DatePicker/WdatePicker.js"></script><script type="text/javascript" src="./Tpl/static/js/selectBox.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/css/selectBox.css" /><style type="text/css"><!--
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
                .list:hover{
                    background-color: rgb(193,235,255);
                }
                img{border-width: 0px;}

                .anniu{
                    background: transparent url('bg_button_span.gif') no-repeat;
                    display: block;
                    line-height: 14px;
                    padding: 5px 0 5px 18px;  
                }
                --></style><script type='text/javascript'>                function show(url, title) {
                    asyncbox.open({
                        id: 'msg',
                        url: url,
                        title: title,
                        width: 600,
                        height: 400,
                        scrolling: 'auto',
                        callback: function(action) {

                        }
                    });
                }
                function return_msg(close, msg, type) {
                    if (close == 1) {
                        $.close('msg');//关闭页面
                    }
                    //type 的值为 'success','error','other';
                    $.tips(msg, type);
                }
                function check() {
                    var obj = $('input[flag=check]');
                    if (document.getElementById('checked').checked == true) {
                        for (var i = 0; i < obj.length; i++) {
                            obj[i].checked = true;
                        }
                    } else {
                        for (var i = 0; i < obj.length; i++) {
                            obj[i].checked = false;
                        }
                    }
                }
                $(document).ready(function() {
                    $("select").selectBox();
                    var str = $("#get_content").html();
                    var m = /1[3,5,8]{1}[0-9]{9}/g;
                    var phone = str.match(m);
                    if (phone) {
                        for (var i = 0; i < phone.length; i++) {
                            var temp = $('.list').eq(i).html();
                            if (temp) {
                                temp = temp.replace(phone[i], '<a href="javascript:;" onclick="send_msg('+phone[i]+')">' + phone[i] + '</a>');
                                $('.list').eq(i).html(temp);
                            }
                        }
                    }
                });
                function send_msg(phone){
                    show('<?php echo U("Sms/sendMsg?phone=");?>'+phone,'发送短信');
                    
                }
                /**
                 * 管理弹窗并进行提示
                 * @param {type} msg
                 * @param {type} type
                 */
                function close(msg, type) {
                    $.close('msg');
                    $.tips(msg, type);
                }

            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="30" background="./Tpl/static/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="12" height="30"><img src="./Tpl/static/images/tab_03.gif" width="12" height="30" /></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="90%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="5%"><div align="center"><img src="./Tpl/static/images/tb.gif" width="16" height="16" /></div></td><td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：【短信评警】— 【<?php echo ($title); ?>】</td></tr></table></td><td width="54%"></td></tr></table></td><td width="16"><img src="./Tpl/static/images/tab_07.gif" width="16" height="30" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0" id='get_content'><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><script type="text/javascript">    function getPhone() {
        
        var ptype = $('#ptype').val();
        if(ptype == 7){
            return false;
        }
        $('#phone').html('');
        $.getJSON("<?php echo U('NOBank/getNO');?>", 'type=' + ptype, function(data) {
            if (!data) {
                alert('未获取到号码!请检查是否有相应的权限或号码');
                return;
            }
            var html = '';
            for (i = 0; i < data.length; i++) {
                html += data[i].phone + '\n';
            }
            $('#phone').html(html);
        });
    }

    function formSub() {
        if ($('#phone').html() == '' || $('#content').html() == '') {
            alert('请检查!号码和内容不为空');
            return;
        }
        form.submit();
    }

</script><form method="post" id="form"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td width="3%" colspan="4" >                消息群发
                <div id='htm'></div></td></tr><tr class="list"><td>类型：</td><td ALIGN="left"><select name='type' class="select"><option value="0">通知消息</option><option value="1">普通消息</option></select></td><td width="10%">人员类型：</td><td ALIGN="left"><select name="ptype" id="ptype" class="select"  onchange="getPhone()"><?php if(is_array($type)): foreach($type as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?></select></td></tr><tr class="list"><td>号码：</td><td ALIGN="left"><textarea name="phone" id="phone" style="width: 200px; height: 200px" ></textarea></td><td>内容：</td><td ALIGN="left"><textarea name="content" id="content" style="width: 200px; height: 200px" ></textarea></td></tr><tr class="list"><td>签名：</td><td ALIGN="left"  colspan="3" ><input type="sign"  size="100" name="sign"></td></tr><tr class="list"><td>注意：</td><td ALIGN="left"  colspan="3"  style="color:red">                1.请勿发送铭感词汇,2.短信内容+签名内容建议不超过70个字符.超出字符则按照两条短信进行计费.3.系统将自动过滤重复号码!
            </td></tr><tr class="bar"><td colspan="4" ><input type="button" value="发送" onclick="formSub()"/></td></tr></table></form></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>