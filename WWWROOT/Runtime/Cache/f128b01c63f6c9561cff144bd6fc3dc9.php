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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script type='text/javascript'>    function del(id) {
        asyncbox.confirm('您确定要删除当前信息吗？删除后不可恢复！', '删除确认', function(action) {
            //confirm 返回三个 action 值，分别是 'ok'、'cancel' 和 'close'。
            if (action == 'ok') {
                $.post("<?php echo U('Rules/del');?>", 'id=' + id, function(e) {
                    if (e == '1') {
                        asyncbox.tips('删除成功 ! ', 'success');
                        $('tr[flag=C_' + id + ']').remove();
                    } else {
                        asyncbox.tips('删除失败 !', 'error');
                    }
                });
        }
        }
        );
    }
</script><table width="960" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1"><?php echo ($title); ?></td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><span class="right_body"></span><table width="99%" border="0" cellpadding="0" cellspacing="1" class="table"><tr><th class="td2" width="34%">细则概要</th><th class="td2" width="10%">被考部门</th><th class="td2" width="8%">考核项目</th><th class="td2" width="12%">添加时间</th><th class="td2" width="12%">考核时间</th><th class="td2" width="10%">总分</th><th width="21%" class="td2">操作</th></tr><?php if($data): if(is_array($data)): foreach($data as $key=>$value): ?><tr flag ='C_<?php echo ($value['id']); ?>'><td class="td" width="34%" align="center" ><?php echo substr(strip_tags($value['content']),0,60)?>..
                                    </td><td class="td" width="10%" align="center"><?php  echo (0==$value['bcid']? '通用细则' :$class[$value['bcid']]['name']); ?></td><td class="td" width="8%" align="center"><?php echo ($value['item']); ?></td><td class="td" width="12%" align="center"><?php echo date('Y-m-d',$value['date']);?></td><td class="td" width="12%" align="center"><?php echo ($value['year']); ?>年</td><td class="td" width="10%" align="center"><?php echo ($value['point']); ?></td><td class="td" align="center"><input name="update" type="button" class="button" onClick="javascript:window.location.href = '<?php echo U('Rules/admin?id = '.$value['id']);?>';" value="查看/修改"/><input type="button" class="button" value="删除" onClick="del(<?php echo ($value['id']); ?>)"></td></tr><?php endforeach; endif; else: ?><tr><td class="td" colspan="7" align="center">没有信息，请添加</td></tr><?php endif; ?><tr><td class="td" align="center" colspan="7"><input type="button" class="button" value="增加细则内容" onClick="window.location.href = '<?php echo U('Rules/add');?>'">　</td></tr></table><span class="right_body"></span></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>