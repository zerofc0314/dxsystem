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
            </script></head><body><div id='url' style="float:left;clear: both;width: 100%;text-align: left">当前位置：<?php echo ($title); ?></div><div><script type="text/javascript">    /**
     * 清理当前季度的考核成绩
     * @returns {undefined}
     */
    function delExam() {
        var obj = $('#cid');
        var cid = obj.val();
        var className = obj.find("option:selected").text();
        if (!obj || !cid || !className) {
            asyncbox.tips('选择的科室出现了问题，请稍后进行选择 !', 'error');
            return;
        }
        asyncbox.confirm('您确定要清理当前【' + className + '】的当前确认数据？,\n 确认后该单位需要重新确认分数', '信息清理', function(action) {
            if (action == 'ok') {
                $.post("<?php echo U('Data/clearExam');?>", 'cid=' + cid, function(e) {
                    if (e == '1') {
                        asyncbox.tips('当前科室的季度成绩成功! ', 'success');
                    } else {
                        asyncbox.tips('清理失败，可能是未开启考核或未进行确认分数 !', 'error');
                    }
                });
            }
        }
        );
    }
    /**
     * 考核成绩批量入库
     * @returns {unresolved}     
     */
    function affirm() {
        asyncbox.confirm('您确定要将当前考核成绩全部入库吗？入库后将变更为历史记录，不允许任何人员更改', '信息入库', function(action) {
            if (action == 'ok') {
                $.post("<?php echo U('Data/affirm');?>", 'ok=ok', function(e) {
                    if (e == '1') {
                        asyncbox.tips('信息入库成功! ', 'success');
                    } else {
                        asyncbox.tips('信息入库失败,可能有单位未进行确认分数!' + e, 'error');
                    }
                });
            }
        }
        );
    }


</script><table width="60%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_1.jpg" width="52" height="55" /></td><td background="./Tpl/static/images/main_2.jpg" class="title1">                        数据整理
                    </td><td width="52"><img src="./Tpl/static/images/main_3.jpg" width="52" height="55" /></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="15" background="./Tpl/static/images/main_4.gif">　</td><td background="./Tpl/static/images/main_9.gif"><span class="right_body"></span><table width="99%" border="0" cellpadding="0" cellspacing="1" class="table"><tr><th width="20%" class="td2">操作类型</th><th class="td2" width="35%">科室名称</th><th class="td2" width="10%">操作</th></tr><tr><td class='td' width='16%'  align='center'>清理当前考核</td><td class='td' width='18%' align='center'><select name="classId" id="cid"><?php if(is_array($class)): foreach($class as $k=>$v): ?><option value="<?php echo ($k); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?></select></td><td class='td' width='4%' align='center' id='exam_score'><input type="button" class="button" onclick="delExam()" value="清理"/></td></tr><!--
                            <tr><td class='td' width='16%'  align='center'>数据入库</td><td class='td' width='18%' align='center'>                                    当前考核成绩计入历史考核
                                </td><td class='td' width='4%' align='center' id='exam_score'><input type="button" class="button" onclick="affirm()" value="入库"/></td></tr>                            --></table><span class="right_body"></span></td><td width="15" background="./Tpl/static/images/main_5.gif"></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="52"><img src="./Tpl/static/images/main_6.gif" width="52" height="16" /></td><td background="./Tpl/static/images/main_7.gif" width="100%"></td><td width="52"><img src="./Tpl/static/images/main_8.gif" width="52" height="16" /></td></tr></table></td></tr></table></div></body></html>