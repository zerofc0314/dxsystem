<?php if (!defined('THINK_PATH')) exit();?><html><head><meta http-equiv="Content-Language" content="zh-cn"><title>德兴市公安局网上绩效考核系统</title><style type="text/css">            html,body{
                width: 100%;height: 100%;font-size: 12px;
            }
            body{
                margin:0px auto ;
                text-align:center;
                background-image:url('./Tpl/static/images/bg.jpg');
                background-repeat:repeat-x;
                font-size:12px;
            }
            #index{
                width:1194px;
                margin:0px auto ;
                height:570px;
                background-image:url('./Tpl/static/images/index_bg.jpg');
                background-repeat:no-repeat;
                overflow: hidden;
            }
            #login{
                width:265px;
                height:170px;
                float: right;
                background-image:url('./Tpl/static/images/login.gif');
                background-repeat:no-repeat;
                margin: 0 auto;
                margin-right: 200px;
                margin-top: 200px;
                text-align: left;
                padding-left: 30px;
                color: white;
                    padding-top: 8px;
            }
            #login span{
                width: 50px;
                display: inline-table;
            }
            #login .text{
                line-height: 20px
            }
            #login .text input{
                height:20px
            }
        </style></head><body><div id="index"><form method="post" id="form1" onkeypress="subMit(event)"><div id="login"><div class="text"><span>用户名：</span><input type="text" name="user" id="user" style="width: 118px"></div><div class="text" style="margin-top:8px;"><span>密&nbsp;&nbsp;码：</span><input type="password" name="pass" id="pass" style="width: 118px;margin-left:-2px"></div><div class="text" style="margin-top:10px;"><span>验证码：</span><input type="text" name="code" id="code" style="width: 55px"><img src="<?php echo U('Index/code');?>" id="codeImg" style="width:60px;cursor:pointer; height:20px;" onClick="refreshCode()" title="点击更换验证码！"/></div><div id="button" style="height: 30px;margin-top:10px;"><table style="width: 100%"><tr><td style="width: 10px; height: 28px"></td><td style="height: 28px; width: 66px;cursor:pointer" onClick="onLogin()"></td><td style="height: 28px; width: 31px"></td><td style="height: 28px; width: 65px;cursor:pointer" onClick="onReset()"></td><td style="height: 28px"></td></tr></table></div></div></form></div></body><script type="text/javascript">                function subMit(e) {
                    var keyCode = e.keyCode;
                    if (keyCode == 13) {
                        onLogin();
                    }
                }
                function onLogin() {
                    var user = document.getElementById('user').value;
                    var pwd = document.getElementById('pass').value;
                    var code = document.getElementById('code').value;
                    if (user == '' || pwd == '') {
                        alert('用户名或密码未填写，请填写');
                        return;
                    }
                    if (code == '') {
                        alert('请填写验证码！');
                        return;
                    }
                    form1.submit();
                }
                function onReset() {
                    document.getElementById('user').value = '';
                    document.getElementById('pass').value = '';
                    document.getElementById('code').value = '';
                }
                function refreshCode() {
                    document.getElementById('codeImg').src = "<?php echo U('Index/code?code=');?>" + parseInt(Math.random() * 1000);
                }
    </script></html>