<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" src="./Tpl/static/js/jquery.js"></script><style type="text/css"><!--
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

                --></style></head><body><div> 当前位置：<?php echo ($title); ?></div><div><script type="text/javascript">    function check() {
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

</script><form method="POST"><input type="hidden" name="s" value='true'><table width="90%" id="table"  border="1" class="t1"><thead><th width="30%">所属类别</th><th width="20%">部门名称</th><th width="30%">可考核<br>(
            <input type='checkbox' id='checked' onclick="check()"/>全选
            <input type='checkbox' id='checkohter' onclick="checko()"/>反选
            )</th></thead><?php if($data['class']){ if(is_array($data['class'])): foreach($data['class'] as $key=>$value): ?><tr class="a1" flag='C_<?php echo ($value['id']); ?>'><td><?php echo ($data['sort'][$value['sid']]['name']); ?></td><td><?php echo ($value['name']); ?></td><td><input type="checkbox" name="classC[]" value="<?php echo ($value['id']); ?>" flag="check"
                           <?php echo in_array($value['id'],$control_class) ? 'checked' : '' ?> ></td></tr><?php endforeach; endif; }else{ ?><tr><td colspan="3">没有任何信息，请先添加部门添加</td></tr><?php }?><tr><td colspan="3"><input type="submit" value="保存"></td></tr></table></form></div></body></html>