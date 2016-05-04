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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><table width="900" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="900" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">                        细则查看(当前单位:<font color="#FF0000"><?php echo ($class[$cid]['name']); ?></font>                        时间:<font color="#FF0000"><?php echo $_GET['year']; ?></font>年<font color="#FF0000">第<?php echo $_GET['quarter'] ?>季度</font>)
                    </td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><span class="right_body"></span><table width="99%" border="0" cellpadding="0" cellspacing="1" class="table" align="left"><tr><th class="td2" width="40%"style="word-break:break-all;"> 细则</th><th class="td2" width="34%">评论备注</th><th class="td2" width="10%">分值</th><th class="td2" width="9%">得分</th></tr><?php if(is_array($data)): foreach($data as $key=>$value): ?><tr><td class='td' width='16%' align='center'><div style='width: 600px;height: 400px;overflow: scroll;text-align:left;'><?php echo ($rules[$value['rid']]['content']); ?></div></td><td class='td' width='12%' align='center'><?php echo ($value['review']); ?></td><td class='td' width='9%' align='center'><?php echo ($rules[$value['rid']]['point']); ?></td><td class='td' width='9%' align='center'><?php echo ($value['get_point']); ?></td></tr><?php endforeach; endif; ?><tr><td class="td" align="center" colspan="5"><input type="button" class="button" value="返回" onClick="javascript:window.history.go(-1);"></tr></table><span class="right_body"></span></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>