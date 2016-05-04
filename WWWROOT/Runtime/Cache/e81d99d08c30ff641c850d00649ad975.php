<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" src="./Tpl/static/js/jquery.js"></script><script type="text/javascript" src="./Tpl/static/js/edit/kindeditor-min.js"></script><script type="text/javascript" src="./Tpl/static/js/edit/lang/zh_CN.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/css/css.css" /><script type="text/javascript" src="./Tpl/static/js/asyncbox/AsyncBox.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/js/asyncbox/skins/ZCMS/asyncbox.css" /><style type="text/css"><!--
                #table{
                    font-size:12px;
                }
                #table{
                    table-layout:fixed;
                    empty-cells:show; 
                    border-collapse: collapse;
                    margin:0 auto;
                }
                #table td{
                    height:20px;
                    text-align: center;
                }
                #table h1,h2,h3{
                    font-size:12px;
                    margin:0;
                    padding:0;
                }

                .title { background: #FFF; border: 1px solid #9DB3C5; padding: 1px; width:90%;margin:20px auto; }
                .title h1 { line-height: 31px; text-align:center;  background: #2F589C url(th_bg2.gif); background-repeat: repeat-x; background-position: 0 0; color: #FFF; }
                .title th, .title td { border: 1px solid #CAD9EA; padding: 5px; }


                /*这个是借鉴一个论坛的样式*/
                #table.t1{
                    border:1px solid #cad9ea;
                    color:#666;
                }
                #table.t1 th {
                    background-image: url(th_bg1.gif);
                    background-repeat:repeat-x;
                    height:30px;
                }
                #table.t1 td,table.t1 th{
                    border:1px solid #cad9ea;
                    padding:0 1em 0;
                }
                #table.t1 tr.a1{
                    background-color:#f5fafe;
                }

                --></style><script type='text/javascript'>                function show(url, title) {
                    asyncbox.open({
                        url: url,
                        title: title,
                        width: 500,
                        height: 400,
                        scrolling: 'auto',
                        callback: function(action) {
                            asyncbox.tips('Pass', 'success');
                        }
                    });
                }
                function return_msg(msg) {

                }
            var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
                
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script type="text/javascript">    function check() {
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
    function checko() {
        var obj = $('input[flag=check]');
        for (var i = 0; i < obj.length; i++) {
            if (obj[i].checked == true) {
                obj[i].checked = false;
            } else {
                obj[i].checked = true;
            }
        }
    }
</script><form method="post"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">信息查看</td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="1" class="table"><tr><th class="td" style="width: 260px">接收单位<br>                                        (<input type='checkbox' id='checked' onclick="check()"/>全选<br><input type='checkbox' id='checkohter' onclick="checko()"/>反选)
                                    </th><td class="td" ><?php $i=0; if(is_array($class)): foreach($class as $key=>$value): ?><input type="checkbox" name='cid[]' value='<?php echo ($value['id']); ?>' flag="check"><?php echo ($value['name']); $i++; if($i==4){ $i=0; echo '<br>'; } endforeach; endif; ?></td></tr><tr><th class="td" style="width: 260px">标题</th><td class="td" ><input name="title" type="text" /></td></tr><tr><th class="td" style="width: 260px">信息内容</th><td width="741" class="td" align="center"><textarea name="content" style="width:350px;height:200px;visibility:hidden;"></textarea></td></tr><tr><th class="td" style="width: 260px">消息类型</th><td width="741" class="td" align="center"><select name='type'><?php if(!isset($user['cid'])):?><option value="2">通知</option><?php endif;?><option value="2">普通消息</option></select></td></tr><tr><th class="td" style="width: 260px">时间</th><td  class="td" align="center"><?php echo date('Y-m-d H:i:s',time()); ?></td></tr><tr><td colspan="2" class="td"align="center"><input name="发送" type="submit" class="button" value="确认"  id="button"                                   /></td></tr></table></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></form></div></body></html>