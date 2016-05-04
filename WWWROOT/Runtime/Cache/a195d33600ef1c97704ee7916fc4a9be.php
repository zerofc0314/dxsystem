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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><table width="840" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">信息浏览(当前被评分单位:<?php echo $class[$_GET['cid']]['name'] ?>)</td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><form method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0"/><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="1" class="table"/><tr><th style="width: 243px" class="td">绩效细则</th><td class="td" ><table border="1" id="table1" height="278" style="border-collapse: collapse; width: 85%;" bordercolor="#000000"><tr><td valign="top" style="width: 600px"><div  style="overflow-y: scroll;height: 300px;background-color: white;text-align:left;"><?php echo ($data['content']); ?></div></td></tr></table></td></tr><tr><th class="td" style="width: 243px">评分单位</th><td class="td"><?php echo $class[$data['cid']]['name'] ?></td></tr><tr><th class="td" style="width: 243px">细则分值</th><td class="td" ><input type="text" name="point"  size="6"value="<?php echo ($data['point']); ?>" disabled />分
                    </td></tr><tr><th class="td" style="width: 243px">得分</th><td class="td"><input type="text" name="get_point" value="<?php echo ($data['get_point']); ?>" size="6" />  分 
                    </td></tr><tr><th class="td" style="width: 243px">备注</th><td class="td"><textarea rows="6" name="review" cols="76" id="exam_remarks"><?php echo ($data['review']); ?></textarea></td></tr><tr><th class="td">录入时间</th><td width="1243" class="td"><?php echo date('Y-m-d,H:i:s',$data['date']); ?></td></tr><tr><td colspan="2" class="td"align="center"><input type="submit" class="button" value="提交评分" <?php if($data['ok']){echo 'disabled title=单位已经确认分数，不可评分';} ?> /><input type="button" class="button" onClick="javascript:window.history.go(-1);" value="返回" /></form></td></tr></table></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>