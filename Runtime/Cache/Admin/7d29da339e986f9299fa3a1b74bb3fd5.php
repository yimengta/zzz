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
 
<script type="text/javascript">
  function show_attr(){
    var type_id = $('#type_id').val();
    // 使用ajax去服务器端，获得属性的信息
    $.ajax({
      url:'/index.php/Admin/Attribute/getAttributeByType',
      data:{'type_id':type_id},
      dataType:'json',
      success:function(msg){
        // console.log(msg);
        // 遍历msg与html 代码做结合显示
        var s = '';
        $.each(msg,function(){
          s+='<tr><td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center"><input type="checkbox" name="checkbox" id="checkbox" /></div></td><td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">'+this.attr_id+'</span></div></td><td width="10%" height="20" bgcolor="d3eaef" class="STYLE6" align="left"><div align="center"><span class="STYLE10">'+this.attr_name+'</span></div></td><td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">'+this.type_name+'</span></div></td><td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">'+this.attr_write+'</span></div></td><td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">'+this.attr_opt_vals+'</span></div></td><td height="20" bgcolor="d3eaef" class="STYLE6" align="center"><a href="<?php echo U('tianjia',array('type_id'=>$v['type_id']));?>"><span class="STYLE10">编辑|</span></a><a href=""><span class="STYLE10">删除|</span></a><a href="<?php echo U('Attribute/showlist',array('type_id'=>$v['type_id']));?>"><span class="STYLE10">属性列表|</span></a><a href=""><span class="STYLE10">查看</span></a></div></td></tr>';
        });
      //   // 再追加
        
      }
    });
        $('attrshow tr:not(:first)').remove();
        $('#attrshow').append(s);   
  }
</script>
 <tr>
   <td colspan="100" class="STYLE22" style="padding:4px;border:1px solid black; ">
   按照商品类型显示
     <select onchange="show_attr" id="type_id">
       <option value="0">请选择</option>
       <?php if(is_array($typeinfo)): $i = 0; $__LIST__ = $typeinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
     </select>
   </td>
 </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="attrshow">
      <tr>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE10">
        <div align="center">
        </div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">属性id</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6" align="left"><div align="center"><span class="STYLE10">属性名称</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6" align="left"><div align="center"><span class="STYLE10">商品类型</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6" align="left"><div align="center"><span class="STYLE10">录入方式</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">可选值</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
      </tr>
      <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
          <input type="checkbox" name="checkbox" id="checkbox" />
        </div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10"><?php echo ($v["attr_id"]); ?></span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6" align="left"><div align="center"><span class="STYLE10"><?php echo ($v["attr_name"]); ?></span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10"><?php echo ($v["type_name"]); ?></span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10"><?php echo ($v['attr_write']=='0'?'手工录入':'列表选择'); ?></span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10"><?php echo ($v["attr_opt_vals"]); ?></span></div></td>
        <td height="20" bgcolor="d3eaef" class="STYLE6" align="center">
        <a href="<?php echo U('tianjia',array('type_id'=>$v['type_id']));?>"><span class="STYLE10">编辑|</span></a>
        <a href=""><span class="STYLE10">删除|</span></a>
        <a href="<?php echo U('Attribute/showlist',array('type_id'=>$v['type_id']));?>"><span class="STYLE10">属性列表|</span></a>
        <a href=""><span class="STYLE10">查看</span></a></div></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    </td>
  </tr>
 
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%"><div align="left"><span class="STYLE22">&nbsp;&nbsp;&nbsp;&nbsp;共有<strong> 243</strong> 条记录，当前第<strong> 1</strong> 页，共 <strong>10</strong> 页</span></div></td>
        <td width="67%"><table width="312" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td width="49"><div align="center"><img src="/Public/Admin/images/main_54.gif" width="40" height="15" /></div></td>
            <td width="49"><div align="center"><img src="/Public/Admin/images/main_56.gif" width="45" height="15" /></div></td>
            <td width="49"><div align="center"><img src="/Public/Admin/images/main_58.gif" width="45" height="15" /></div></td>
            <td width="49"><div align="center"><img src="/Public/Admin/images/main_60.gif" width="40" height="15" /></div></td>
            <td width="37" class="STYLE22"><div align="center">转到</div></td>
            <td width="22"><div align="center">
              <input type="text" name="textfield" id="textfield"  style="width:20px; height:12px; font-size:12px; border:solid 1px #7aaebd;"/>
            </div></td>
            <td width="22" class="STYLE22"><div align="center">页</div></td>
            <td width="35"><img src="/Public/Admin/images/main_62.gif" width="26" height="15" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>




</table>
</body>
</html>