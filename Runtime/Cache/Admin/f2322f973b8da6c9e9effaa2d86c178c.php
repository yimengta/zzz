<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<style type="text/css">
<!--
body { 
	margin-left: 3px;
	margin-top: 0px;
	margin-right: 3px;
	margin-bottom: 0px;
}
.STYLE1 {
	color: #e1e2e3;
	font-size: 12px;
}
.STYLE6 {color: #000000; font-size: 12; }
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {
	color: #344b50;
	font-size: 12px;
}
.STYLE21 {
	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {
	font-size: 12px;
	color: #295568;
}
a:link{
    color:#e1e2e3; text-decoration:none;
}
a:visited{
    color:#e1e2e3; text-decoration:none;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="/Public/Admin/images/tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1"> <?php echo ($daohang["first"]); ?> -> <?php echo ($daohang["second"]); ?></span></td>
              </tr>
            </table></td>
            <td><div align="right"><span class="STYLE1">
              <a href="<?php echo ($daohang["btn_link"]); ?>"target="_self"><img src="/Public/Admin/images/add.gif" width="10" height="10" /><?php echo ($daohang["btn"]); ?></a>   &nbsp; 
              </span>
              <span class="STYLE1"> &nbsp;</span></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Skiyo 后台管理工作平台 by Jessica</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css"/>
<script type="text/javascript" src="/Public/Admin/js/js.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery-1.8.3.js"></script>
</head>
<body>
<div id="top">  </div>
<form id="login" name="login" action="/Admin/Manager/login" method="post">
  <div id="center">
    <div id="center_left"></div>
    <div id="center_middle">
      <div class="user">
        <label>用户名：
        <input type="text" name="user" id="user" />
        </label>
      </div>
      <div class="user">
        <label>密　码：
        <input type="password" name="pwd" id="pwd" />
        </label>
      </div>
      <div class="chknumber">
        <label>验证码：
        <input name="chknumber" type="text" id="chknumber" maxlength="4" class="chknumber_input" onkeyup="check_verify()"/>
        </label>
        <img src="<?php echo U('captcha');?>" id="safecode" onclick="this.src=this.src+'?'+Math.random()" id="safecode"/><span id="verifyresult"></span>
      </div>
    </div>
    <div id="center_middle_right"></div>
    <div id="center_submit">
      <div class="button"> <img src="/Public/Admin/images/dl.gif" width="57" height="20" onclick="form_submit()"> </div>
      <div class="button"> <img src="/Public/Admin/images/cz.gif" width="57" height="20" onclick="form_reset()"> </div>
    </div>
    <div id="center_right"></div>
  </div>
</form>
<div id="footer"></div>
</body>
</html>
<script type="text/javascript">
var allow_access =false;//是否允许form表单提交
  function check_verify(){
    var code = $('#chknumber').val();
    if (code.length==4) {
      // alert('yanzheng');
      $.ajax({
        // ajax去服务器校验
        url: '/index.php/Admin/Manager/checkVerify',
        // type: 'default GET (Other values: POST)',
        dataType: 'json',
        data: {'code': code},
        success:function(msg){
        if (msg.flag==1) {
          allow_access = true;
          $('#verifyresult').html(msg.cont).css('color','green');
        }else{
          allow_access = false;
          $('#verifyresult').html(msg.cont).css('color','red');
        }
      }});
    }
  }

  function form_submit(){
    if(allow_access===true) {
      // alert('允许');
      // 触发事件执行
      $('#login').submit();
    }else{
      alert('验证码不正确');
    }
  }
</script>



</table>
</body>
</html>