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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script type="text/javascript">    $(document).ready(function() {
        $('#add').click(function() {
            show("<?php echo U('Notice/add');?>", '发送信息');
        });
    });
    function edit(id,cid) {
        var url = '<?php echo U('Notice/showC?id');?>' + id;
          asyncbox.open({
                        url: url,
                        title: '消息查看',
                        width: 500,
                        height: 400,
                        scrolling: 'auto',
                        btnsbar : $.btn.OK,
                        callback: function(action) {
                            if (action =='ok') {
                               if(cid == <?php echo ($user['cid']); ?>){
                                $('.td[flag=R_'+id+']').html('已读');
                                }
                            } 
                        }
                    });
    }
    function del(id) {
        asyncbox.confirm('您确定要删除当前信息吗？删除后不可恢复！', '删除确认', function(action) {
            //confirm 返回三个 action 值，分别是 'ok'、'cancel' 和 'close'。
            if (action == 'ok') {
                $.post('<?php echo U('Notice/del');?>', 'id=' + id, function(e) {
                    if (e == '1') {
                        asyncbox.tips('删除成功 ! ', 'success');
                        $('tr[flag=C_'+id+']').remove();   
                    } else {
                        asyncbox.tips('删除失败 !', 'error');
                    }
                });
            }
        }
        );
    }
</script><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">消息管理</td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><span class="right_body"></span><table width="99%" border="0" cellpadding="0" cellspacing="1" class="table"><tr><th class="td2" style="width: 10%">类型</th><th class="td2" style="width: 10%">发送单位</th><th class="td2" style="width: 10%">接受单位</th><th class="td2" style="width: 10%">消息概要</th><th class="td2" style="width: 20%">消息概要</th><th class="td2" style="width: 5%">已读</th><th class="td2" style="width: 20%">时间</th><th class="td2">操作</th></tr><?php  if($list){ foreach($list as $value){ ?><tr flag='C_<?php echo ($value['id']); ?>'><td class="td" align='center'><?php echo (1 == $value['type'] ? '<font color=red>公告</font>':'普通消息'); ?></td><td class="td" align='center'><?php echo ($class[$value['s_cid']]['name']); ?></td><td class="td" align='center'><?php echo ($class[$value['cid']]['name']); ?></td><td class="td" align='center'><?php echo ($value['title']); ?></td><td class="td" align='center'><?php echo substr(strip_tags($value['content']),0,30)?>..</td><td class="td" align='center' flag ="R_<?php echo ($value['id']); ?>"><?php echo 1==$value['look'] ? '已读':'<font color=red>未读</font>' ?></td><td class="td" align='center'><?php echo date('Y-m-d H:i:s',$value['date']); ?></td><td class="td"><input name="Button2" type="button" class="button" onclick="edit(<?php echo ($value['id']); ?>,<?php echo ($value['cid']); ?>)"  value="查看" ><?php if(!isset($user['cid']) || $user['cid'] == $value['s_cid']): ?><input name="Button2" type="button" class="button" onclick="del(<?php echo ($value['id']); ?>)"  value="删除" ><?php endif; ?></td></tr><?php }?><tr><td class='td' align='center' colspan='8'><?php echo ($page); ?></td></tr><?php }else{ ?><tr><td class='td' align='center' colspan='8'>无任何记录</td></tr><?php } ?><tr><td class="td" align="center" colspan="8"><input name="Button2" type="button" class="button" id='add' value="发送消息" ></td></tr></table><span class="right_body"></span></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>