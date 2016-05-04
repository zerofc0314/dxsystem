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
                
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script type="text/javascript">    function getRules() {
        asyncbox.open({
            url: "<?php echo U('Rules/getRules');?>",
            title: '细则调取',
            btnsbar: $.btn.OKCANCEL,
            id:'getRules',
            callback: function(action, iframe, returnValue) {
                //判断 action 值。
                        if (action == 'ok') {
                    //预设 $.returnValue 后可以在 page 模式中使用 returnValue。
                          var a= iframe.fun();
                          
                    }
                }
        });
       
    }
</script><table width="690" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1"><?php echo ($title); ?></td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><form method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="1" class="table"><tr><th style="width: 957px" class="td">细则内容:</th><td width="1243" class="td" ><textarea name="content" style="width:550px;height:200px;visibility:hidden;"></textarea><!-- <input type="button" class="button" onclick="getRules()" value="调取细则"/>--></td></tr><tr><th class="td" style="width: 957px">评分单位:</th><td width="1243" class="td"><?php $user=session('rabc');echo $user['name']; ?></td></tr><tr><th class="td" style="width: 957px">考核项目:</th><td width="1243" class="td"><select name="item_name"size="1"  id="item_name"><?php if(is_array($item)): foreach($item as $key=>$value): ?><option value='<?php echo ($value['id']); ?>'><?php echo ($value['item']); ?></option><?php endforeach; endif; ?></select><select name="sub_name" id="sub_name"><option value='细则相同'>通用细则</option><?php if(is_array($class)): foreach($class as $key=>$value2): ?><option value='<?php echo ($value2[0]['id']); ?>'><?php echo ($value2[0]['name']); ?></option><?php endforeach; endif; ?></select></td></tr><tr><th class="td">考核时间:</th><td width="1243" class="td"><select name="year" size="1" ><?php  echo '<option>'.(date('Y',time())-1).'</option>'; echo '<option selected>'.date('Y',time()).'</option>'; echo '<option>'.(date('Y',time())+1).'</option>'; ?></select>年
                                    </td></tr><tr><th class="td">分值:</th><td width="1243" class="td"><input type="text" name="point" id="exam_value" size="3">分</td></tr><tr><td colspan="2" class="td"align="center"><input type="submit" class="button" value="确认添加" onclick="chack_exam_value()" /><input type="button" class="button" onClick="javascript:window.history.go(-1);" value="返回" /></form></td></tr></form></table></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>