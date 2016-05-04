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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script type="text/javascript">    function showC(id) {
    var url = '<?php echo U('Msg/showC?id');?>' + id;
            show(url, '申诉信息');
    }
</script><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">申诉信息</td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><span class="right_body"></span><table width="99%" border="0" cellpadding="0" cellspacing="1" class="table"><tr><th width="16%" class="td2">申诉单位</th><th width="16%" class="td2">主考单位</th><th class="td2" width="16%">申诉项目</th><th class="td2" width="16%">申诉时间</th><th class="td2" width="20%">进度</th><th class="td2" >操作</th></tr><?php  $user = session('rabc'); if($data){ foreach ( $data as $key => $value){ ?><tr><td class='td' width='16%'  align='center'><?php echo ($class[$value['cid']]['name']); ?></td><td class='td' width='16%' align='center'><?php echo ($class[$value['a_cid']]['name']); ?></td><td class='td' width='16%' align='center'><?php echo ($value['item']); ?></td><td class='td' width='16%' align='center'><?php echo date('Y-m-d H:i:s',$value['send_date']); ?></td><td class='td' width='20%' align='center' id='exam_score'><?php  if(!$value['read_date'] && !$value['reply_date']){ echo '<font color=red>等待主评单位读取</font>'; }elseif(!$value['read_date']){ echo '<font color=red>未阅读</font>'; }elseif(!$value['reply_date']){ echo '<font color=red>未回复</font>'; }else{ echo '处理完成'; } ?></td><td class='td' align='center'><input type='button' class='button' value=' <?php  echo (isset($user['unit']) && $value['a_cid'] == $user['cid'] ? '查看/处理':'查看'); ?> '  onclick="showC(<?php echo ($value['id']); ?>)">&nbsp;
                                </td></tr><?php  }} ?></table><span class="right_body"></span></td><td width="15" background="./Tpl/static/images/main_5.gif">　</td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>