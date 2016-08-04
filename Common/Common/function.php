<?php
/**
 * 
 * @authors	YANG DINGYUAN (yangdingyuan@itcast.cn)
 * @date    2016-05-28 00:28:20
 * @url 	http://dwz.cn/920815
 * @desc	thinkphp自定义函数库...
 *
 */

/**  
 *字符串截取函数
 *最好开启mbstring扩展
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(mb_strlen($str,$charset)>$length)
    {
        if(function_exists("mb_substr")){
            if($suffix)
                return mb_substr($str, $start, $length, $charset)."...";
            else
                return mb_substr($str, $start, $length, $charset);
        }elseif(function_exists('iconv_substr')) {
            if($suffix)
                return iconv_substr($str,$start,$length,$charset)."...";
            else
                return iconv_substr($str,$start,$length,$charset);
        }
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        if($suffix) return $slice."…";
        return $slice;
    }
    else
    {
        return $str;
    }
}

/**
 * GET 请求
 * 需要curl扩展支持
 */
function http_get($url){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}

/**
 * POST 请求
 * 需要curl扩展支持
 */
function http_post($url,$param,$post_file=false){
    $oCurl = curl_init();
    if(stripos($url,"https://") !== FALSE){
        curl_setopt($oCurl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($oCurl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($oCurl,CURLOPT_SSLVERSION,1);
    }
    if (is_string($param) || $post_file){
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach($param as $key => $val){
            $aPOST[] = $key."=" . urlencode($val);
        }
        $strPOST = join("&",$aPOST);
    }
    curl_setopt($oCurl,CURLOPT_URL,$url);
    curl_setopt($oCurl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($oCurl,CURLOPT_POST,true);
    curl_setopt($oCurl,CURLOPT_POSTFIELDS,$strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"]) == 200){
        return $sContent;
    }else{
        return false;
    }
}

/**
 * 空格换行符过滤
 */
function trimAll($parma){
    if(is_array($parma)){
        return array_map('trimAll',$parma);
    }
    $before = array(" ","   ","\t","\r","\n");
    $after = array('','','','','');
    return str_replace($before,$after,$parma);
}

//使用htmlpurifier实现防止xss攻击
function fangXSS($string){
    require_once './Common/Plugin/htmlpurifier/HTMLPurifier.auto.php';
    // 生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();
    // 以下就是配置：
    $cfg->set('Core.Encoding', 'UTF-8');
    // 设置允许使用的HTML标签
    $cfg->set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,span[style],img[width|height|alt|src]');
    // 设置允许出现的CSS样式属性
    $cfg->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
    // 设置a标签上是否允许使用target="_blank"
    $cfg->set('HTML.TargetBlank', TRUE);
    // 使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);
    // 过滤字符串
    return $obj->purify($string);
}

// 發送郵件的函數
    function sendMail($to, $title, $content){
    require_once('./Common/Plugin/phpmailer/class.phpmailer.php');
    $mail = new PHPMailer();
    $mail->IsSMTP();// 设置为要发邮件
    $mail->IsHTML(TRUE);// 是否允许发送HTML代码做为邮件的内容
    $mail->CharSet='UTF-8';
    $mail->SMTPAuth=TRUE;// 是否需要身份验证
    /*  邮件服务器上的账号是什么 -> 到163注册一个账号即可 */
    $mail->From="phpseven@163.com";
    $mail->FromName="phpseven";
    $mail->Host="smtp.163.com";  //发送邮件的服务协议地址
    $mail->Username="phpseven";
    $mail->Password="phpseven777";
    $mail->Port = 25;// 发邮件端口号默认25
    $mail->AddAddress($to);// 收件人
    $mail->Subject=$title;// 邮件标题
    $mail->Body=$content;// 邮件内容

    return($mail->Send());
}