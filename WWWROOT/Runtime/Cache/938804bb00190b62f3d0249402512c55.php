<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" src="./Tpl/static/js/jquery.js"></script><script type="text/javascript" src="./Tpl/static/js/asyncbox/AsyncBox.js"></script><link rel="stylesheet" type="text/css" href="./Tpl/static/js/asyncbox/skins/ZCMS/asyncbox.css" /><link rel="stylesheet" type="text/css" href="./Tpl/static/css/css.css" /><style type="text/css"><!--
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
                           // asyncbox.tips('Pass', 'success');
                        }
                    });
                }
                function return_msg(msg) {
                    
                }
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script language="javascript">    function change_admin() {
        if (document.getElementById("admin_pwd").value == document.getElementById("sub_pwd").value) {
            alert('不能和原密码相同');
            return false;
        }
        if (document.getElementById("admin_pwd1").value != document.getElementById("admin_pwd").value) {
            alert("您两次输入的密码不相同!请重新输入!");
            return false;
        }
        form1.submit();

    }
</script><body><div id="content"><div id="right"><div class="right_body"><br /></div></div><div class="clear"></div></div><table width="42%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="102%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">密码修改</td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="102%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><span class="right_body"></span><table width="99%" border="0" cellpadding="0" cellspacing="1" class="table"><tr><th class="td2" colspan="2">用户密码修改</th></tr><tr><td class="td" align="center" width="25%">用户名:</td><td class="td" align="center" width="73%"><?php echo ($user['name']); ?></td></tr><form method="post" name="form1" id="form1"><tr><td class="td" align="center" width="25%">原始密码:</td><td class="td" align="center" width="73%"><input type="password" name="sub_pwd" id="sub_pwd" size="16" /></td></tr><tr><td class="td" align="center" width="25%">修改密码:</td><td class="td" align="center" width="73%"><input name="admin_pwd"  type="password" id="admin_pwd"  size="16"  /></td></tr><tr><td class="td" align="center" width="25%">确认密码:</td><td class="td" align="center" width="73%"><input type="password" name="admin_pwd1" id="admin_pwd1" size="16" /></td></tr><tr><td class="td" align="center" width="98%" colspan="2"><input type="button" class="button" onClick="change_admin()" value="确认修改" />　</td></tr></form></table><span class="right_body"></span></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="102%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="80%"></td><td width="59"><img src="./Tpl/static/images/main_8.gif" width="59" height="16" /></td></tr></table></td></tr></table></div></body></html>