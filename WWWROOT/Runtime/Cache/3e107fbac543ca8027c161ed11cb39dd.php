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

            </script></head><body><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="30" background="./Tpl/static/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="12" height="30"><img src="./Tpl/static/images/tab_03.gif" width="12" height="30" /></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="90%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="5%"><div align="center"><img src="./Tpl/static/images/tb.gif" width="16" height="16" /></div></td><td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：【短信评警】— 【<?php echo ($title); ?>】</td></tr></table></td><td width="54%"></td></tr></table></td><td width="16"><img src="./Tpl/static/images/tab_07.gif" width="16" height="30" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0" id='get_content'><tr><td width="8" background="./Tpl/static/images/tab_12.gif">&nbsp;</td><td><script type="text/javascript">    function check() {
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

    function del() {
        var obj = $('input[flag=check]');
        var id = new Array();
        for (var i = 0; i < obj.length; i++) {
            if (obj[i].checked == true) {
                id.push(obj[i].value);
            }
        }
        if (id.length < 1) {
            alert('未选择任何消息');
            return;
        }
        asyncbox.confirm('您确定要删除当前信息吗？删除后不可恢复！', '删除确认', function(action) {
            //confirm 返回三个 action 值，分别是 'ok'、'cancel' 和 'close'。
            if (action == 'ok') {
                $.post("<?php echo U('Sms/del');?>", 'id=' + id, function(e) {
                    if (e == '1') {
                        asyncbox.tips('删除成功 ! ', 'success');
                        for (var i = 0; i < obj.length; i++) {
                            if (obj[i].checked == true) {
                                $('.list[flag=C_' + obj[i].value + ']').remove();
                            }
                        }

                    } else {
                        asyncbox.tips('删除失败 !', 'error');
                    }
                });
            }

        }
        );
    }
    function send() {
        var obj = $('input[flag=check]');
        var id = new Array();
        for (var i = 0; i < obj.length; i++) {
            if (obj[i].checked == true) {
                id.push(obj[i].value);
            }
        }
        if (id.length < 1) {
            alert('未选择任何消息');
            return;
        }
        asyncbox.confirm('您确定要重发当前选择的信息吗?', '重发确认', function(action) {
            //confirm 返回三个 action 值，分别是 'ok'、'cancel' 和 'close'。
            if (action == 'ok') {
                $.post("<?php echo U('Sms/send');?>", 'id=' + id, function(e) {
                    if (e == '1') {
                        asyncbox.tips('重发成功 ! ', 'success');
                        for (var i = 0; i < obj.length; i++) {
                            if (obj[i].checked == true) {
                                $('td[flag=S_' + obj[i].value + ']').html('队列中');
                            }
                        }

                    } else {
                        asyncbox.tips('重发失败 !', 'error');
                    }
                });
            }

        }
        );
    }
</script><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"><tr class="bar"><td colspan="10"><table border="0" align="right" cellpadding="0" cellspacing="0"><tr><td width="100"><table width="90%" border="0" cellpadding="0" cellspacing="0"><tr><td id="del" style="cursor: hand" onclick='del()' title='删除选中的信息'><img src="./Tpl/static/images/del.gif" width="16" height="16" />删除
                                </td><td id="del" style="cursor: hand" onclick='send()' title='重发选中的信息'><img src="./Tpl/static/images/22.gif" width="14" height="14" />重发
                                </td></tr></table></td></tr></table></td></tr><tr><td colspan="10"></td></tr><tr class="bar"><td width="3%"><input type="checkbox" id='checked' onclick='check()'></td><td width="3%">序号</td><td width="6%">发送人</td><td width="6%">接受号</td><td width="5%">消息类型</td><td width="6%">接受人群</td><td >消息内容</td><td width="14%">签名</td><td width="6%">状态</td><td width="6%">时间</td></tr><?php  foreach ($list as $key =>$v){ ?><tr class="list" flag='C_<?php echo ($v['id']); ?>'><td><input type="checkbox" name="id[]" value="<?php echo ($v['id']); ?>" flag='check'></td><td><?php echo ($key); ?></td><td><?php echo ($v['pno']); ?></td><td><?php echo ($v['phone']); ?></td><td><?php echo ($attribute['type'][$v['type']]); ?></td><td><?php echo ($attribute['ptype'][$v['ptype']]); ?></td><td><?php echo ($v['content']); ?></td><td><?php echo ($v['sign']); ?></td><td flag="S_<?php echo ($v['id']); ?>"><?php  if($v['status'] == 0){ echo $attribute['status'][$v['status']]; }elseif($v['status'] == 1){ echo '<font color=green>'.$attribute['status'][$v['status']].'</font>'; }else{ echo '<font color=red>'.$attribute['status'][$v['status']].'</font>'; } ?></td><td><?php echo date('Y-m-d',$v['date']); ?></td></tr><?php } ?><tr><td  colspan="10" class="bar"><?php echo ($page); ?></td></tr></table></td><td width="8" background="./Tpl/static/images/tab_15.gif">&nbsp;</td></tr></table></td></tr></table></body></html>