<?php

/**
 * 获取ip地址
 * 七星瓢虫
 * 2018/12/27
 */
function getIp(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
       $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
       $ip = getenv("HTTP_X_FORWARDED_FOR");
  else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
       $ip = getenv("REMOTE_ADDR");
  else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
           $ip = $_SERVER['REMOTE_ADDR'];
       else
           $ip = "unknown";
       return($ip);
}


/**
 * 获取操作系统
 */
function getOs() {
    $os = '';
    $Agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/win/i', $Agent) && strpos($Agent, '95')) {
        $os = 'Win 95';
    } elseif (preg_match('/win 9x/i', $Agent) && strpos($Agent, '/4.90/i')) {
        $os = 'Win ME';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/98/i', $Agent)) {
        $os = 'Win 98';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 5.0/i', $Agent)) {
        $os = 'Win 2000';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.0/i', $Agent)) {
        $os = 'Win Vista';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.1/i', $Agent)) {
        $os = 'Win 7';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 5.1/i', $Agent)) {
        $os = 'Win XP';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.2/i', $Agent)) {
        $os = 'Win 8';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.3/i', $Agent)) {
        $os = 'Win 8.1';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt 10/i', $Agent)) {
        $os = 'Win 10';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/nt/i', $Agent)) {
        $os = 'Win NT';
    } elseif (preg_match('/win/i', $Agent) && preg_match('/32/i', $Agent)) {
        $os = 'Win 32';
    } elseif (preg_match('/Mi/i', $Agent)) {
        $os = '小米';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/LG/i', $Agent)) {
        $os = 'LG';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/M1/i', $Agent)) {
        $os = '魅族';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/MX4/i', $Agent)) {
        $os = '魅族4';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/M3/i', $Agent)) {
        $os = '魅族';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/M4/i', $Agent)) {
        $os = '魅族';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/Huawei/i', $Agent)) {
        $os = '华为';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/HM201/i', $Agent)) {
        $os = '红米';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/KOT/i', $Agent)) {
        $os = '红米4G版';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/NX5/i', $Agent)) {
        $os = '努比亚';
    } elseif (preg_match('/Android/i', $Agent) && preg_match('/vivo/i', $Agent)) {
        $os = 'Vivo';
    } elseif (preg_match('/Android/i', $Agent)) {
        $os = 'Android';
    } elseif (preg_match('/linux/i', $Agent)) {
        $os = 'Linux';
    } elseif (preg_match('/unix/i', $Agent)) {
        $os = 'Unix';
    } elseif (preg_match('/iPhone/i', $Agent)) {
        $os = '苹果';
    } else if (preg_match('/sun/i', $Agent) && preg_match('/os/i', $Agent)) {
        $os = 'SunOS';
    } elseif (preg_match('/ibm/i', $Agent) && preg_match('/os/i', $Agent)) {
        $os = 'IBM OS/2';
    } elseif (preg_match('/Mac/i', $Agent) && preg_match('/PC/i', $Agent)) {
        $os = 'Macintosh';
    } elseif (preg_match('/PowerPC/i', $Agent)) {
        $os = 'PowerPC';
    } elseif (preg_match('/AIX/i', $Agent)) {
        $os = 'AIX';
    } elseif (preg_match('/HPUX/i', $Agent)) {
        $os = 'HPUX';
    } elseif (preg_match('/NetBSD/i', $Agent)) {
        $os = 'NetBSD';
    } elseif (preg_match('/BSD/i', $Agent)) {
        $os = 'BSD';
    } elseif (preg_match('/OSF1/i', $Agent)) {
        $os = 'OSF1';
    } elseif (preg_match('/IRIX/i', $Agent)) {
        $os = 'IRIX';
    } elseif (preg_match('/FreeBSD/i', $Agent)) {
        $os = 'FreeBSD';
    } elseif (preg_match('/Mac OS/i', $Agent)) {
        $os = 'Mac OS';
    }else if ($os == ''){
        $os = '未知';
    }
    return $os;
}

?>       