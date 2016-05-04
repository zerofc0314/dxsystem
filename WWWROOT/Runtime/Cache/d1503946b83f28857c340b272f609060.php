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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><table width="842" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">考试时间管理</td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" class="table"><tr bgcolor="#FFFFFF"><td width="26%" height="15" align="center" bgcolor="#83AED6" class="td2">年份</td><td width="18%" height="15" align="center" bgcolor="#83AED6" class="td2">季度</td><td width="22%" height="15" align="center" bgcolor="#83AED6" class="td2"> 是否开启</td><td height="15" class="td2" width="11%" align="center">操作</td></tr><form method="post"><tr><td height="6" align="center" bgcolor="#83AED6" class="td"><input type="text" name="year" style="width: 63px" value="<?php echo ($data['year']); ?>">年</td><td height="6" align="center" bgcolor="#83AED6" class="td"><select name="quarter" style="width: 101px"><option value="1" <?php echo $data['quarter'] == 1? 'selected':'' ?> >第一季度</option><option value="2" <?php echo $data['quarter'] == 2? 'selected':'' ?> >第二季度</option><option value="3" <?php echo $data['quarter'] == 3? 'selected':'' ?> >第三季度</option><option value="4" <?php echo $data['quarter'] == 4? 'selected':'' ?> >第四季度</option></select></td><td height="6" align="center" bgcolor="#83AED6" class="td"><input name="on" type="checkbox" style="width: 21px; height: 20px;" value="1" <?php echo $data['on'] ? 'checked="checked"':'' ;?>  ></td><td height="4" class="td" width="11%" align="center">&nbsp;<input name="提交" type="submit" class="button" value="修改" ></td></tr></form></table></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" ></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" ></td></tr></table></td></tr></table></div></body></html>