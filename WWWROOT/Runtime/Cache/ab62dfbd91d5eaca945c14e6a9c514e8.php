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

                --></style></head><body><div> 当前位置：<?php echo ($title); ?></div><div><form method="POST"><table width="90%" id="table"  border="1" class="t1"><thead><th colspan="2" >修改用户</th></thead><tr><td>所属单位：</td><td><select name='cid'><?php if(is_array($class)): foreach($class as $key=>$v2): ?><option value="<?php echo ($v2['id']); ?>" <?php if($data[0]['cid'] == $v2['id']){echo 'selected';} ?> ><?php echo ($v2['name']); ?></option><?php endforeach; endif; ?></select></td></tr><tr><td>考核科目：</td><td><input type="text" name='item' value ='<?php echo ($data[0]['item']); ?>'></td></tr><tr><td>分值</td><td><input type="text" name='point' value ='<?php echo ($data[0]['point']); ?>' ></td></tr><tr><td colspan="2"><input type='submit' value='修改' /></td></tr></table></form></div></body></html>