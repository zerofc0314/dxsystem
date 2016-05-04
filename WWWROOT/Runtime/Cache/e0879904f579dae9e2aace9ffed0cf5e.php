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
            show("<?php echo U('ClassC/add');?>", '增加部门');
        });
    });
    function edit(id) {
        var url = "<?php echo U('ClassC/edit?id');?>" + id;
                show(url, '修改部门');
    }
    function del(id) {
        asyncbox.confirm('您确定要删除当前信息吗？删除后不可恢复！', '删除确认', function(action) {
            //confirm 返回三个 action 值，分别是 'ok'、'cancel' 和 'close'。
            if (action == 'ok') {
                $.post("<?php echo U('ClassC/del');?>", 'id=' + id, function(e) {
                    if (e == '1') {
                        asyncbox.tips('删除成功 ! ', 'success');
                        $('.a1[flag=C_'+id+']').remove();   
                    } else {
                        asyncbox.tips('删除失败 !', 'error');
                    }
                });
            }
        }
        );
    }
</script><table width="90%" id="table"  border="1" class="t1"><thead><th width="30%">所属类别</th><th width="20%">部门名称</th><th width="30%">操作</th></thead><?php if($data['class']){ if(is_array($data['class'])): foreach($data['class'] as $key=>$value): ?><tr class="a1" flag='C_<?php echo ($value['id']); ?>'><td><?php echo ($data['sort'][$value['sid']]['name']); ?></td><td><?php echo ($value['name']); ?></td><td><input type="button" onclick="edit(<?php echo ($value['id']); ?>)" value="修改"/><input type="button" onclick="del(<?php echo ($value['id']); ?>)" value="删除"/></td></tr><?php endforeach; endif; }else{ ?><tr><td colspan="3">没有任何信息，请添加</td></tr><?php }?><tr><td colspan="3"><input type="button" value='增加' id ='add'></td></tr></table></div></body></html>