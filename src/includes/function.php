<?php

if (!function_exists("is_https")) {
    function is_https()
    {
        if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
            return true;
        } elseif (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_CLIENT_SCHEME']) && $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https') {
            return true;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            return true;
        } elseif (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') {
            return true;
        } elseif (isset($_SERVER['HTTP_EWS_CUSTOME_SCHEME']) && $_SERVER['HTTP_EWS_CUSTOME_SCHEME'] == 'https') {
            return true;
        }
        return false;
    }
}
/**
 * 是否微信浏览器内核
 */
function is_weixin()
{
    return !strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false;
}

/**
 * 是否QQ浏览器内核
 */
function is_qq()
{
    return !strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') === false;
}

function get_curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0, $addheader = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $httpheader[] = "Accept: */*";
    $httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
    $httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
    $httpheader[] = "Connection: close";
    if ($addheader) {
        $httpheader = array_merge($httpheader, $addheader);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if ($header) {
        curl_setopt($ch, CURLOPT_HEADER, true);
    }
    if ($cookie) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if ($referer) {
        if ($referer == 1) {
            curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
        } else {
            curl_setopt($ch, CURLOPT_REFERER, $referer);
        }
    }
    if ($ua) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    } else {
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0");
    }
    if ($nobaody) {
        curl_setopt($ch, CURLOPT_NOBODY, 1);
    }
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}

function jsonShow($code, $msg = NULL, $data = array())
{
    $json = array(
        'code' => $code
    );
    if (!empty($msg)) $json['msg'] = $msg;
    if (!empty($data)) $json['data'] = $data;
    exit(json_encode($json));
}
function alert($text, $url = NULL, $isExit = true)
{
    $str = '<script>alert("' . $text . '");';
    if (!empty($url)) $str2 = 'location.href = "' . $url . '";';
    if ($url == '-1') $str2 = 'history.back("-1");';
    $str .= $str2;
    $str .= '</script>';
    if ($isExit) exit($str);
    echo $str;
}
function get_ip()
{
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches[0] : '';
}
function get_browse()
{
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $br = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE/i', $br)) {
            $br = 'MSIE';
        } else if (preg_match('/Firefox/i', $br)) {
            $br = 'Firefox';
        } else if (preg_match('/Edg/i', $br)) {
            $br = 'Edge';
        } else if (preg_match('/MicroMessenger/i', $br)) {
            $br = 'WeChat';
        } else if (preg_match('/Chrome/i', $br)) {
            $br = 'Chrome';
        } else if (preg_match('/Safari/i', $br)) {
            $br = 'Safari';
        } else if (preg_match('/Opera/i', $br)) {
            $br = 'Opera';
        } else {
            $br = 'Other';
        }
        return $br;
    } else {
        return 'unknow';
    }
}
function get_os()
{
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $os = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/win/i', $os)) {
            $os = 'Windows';
        } else if (preg_match('/mac/i', $os)) {
            $os = 'macOS';
        } else if (preg_match('/Android/i', $os)) {
            $os = 'Android';
        } else if (preg_match('/linux/i', $os)) {
            $os = 'Linux';
        } else if (preg_match('/unix/i', $os)) {
            $os = 'Unix';
        } else if (preg_match('/bsd/i', $os)) {
            $os = 'BSD';
        } else {
            $os = 'Other';
        }
        return $os;
    } else {
        return 'unknow';
    }
}
// 读取数据
function rdata($path)
{
    $articles = explode("\n", file_get_contents($path));
    // $articles = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . $path));
    // echo "<pre>";print_r($articles['1']);echo "</pre>";exit;
    return json_decode($articles['1'], true); // 解码并以数组返回，取消true则为->对象
}

//储存数据
function wdata($path, $arr = array())
{
    file_put_contents($path, "<?php exit; ?>" . "\n" . json_encode($arr, JSON_UNESCAPED_UNICODE));
}

function spider()
{
    $agent = addslashes(strtolower($_SERVER['HTTP_USER_AGENT'])); // 把请求头转为小写并转义引号
    // 如果不为假就赋值
    if (strpos($agent, 'googlebot') !== false) {
        $bot = 'Google';
    } elseif (strpos($agent, 'mediapartners-google') !== false) {
        $bot = 'Google Adsense';
    } elseif (strpos($agent, 'baiduspider') !== false) {
        $bot = 'Baidu';
    } elseif (strpos($agent, 'sogou spider') !== false) {
        $bot = 'Sogou';
    } elseif (strpos($agent, 'sogou web') !== false) {
        $bot = 'Sogou web';
    } elseif (strpos($agent, 'sosospider') !== false) {
        $bot = 'SOSO';
    } elseif (strpos($agent, '360spider') !== false) {
        $bot = '360Spider';
    } elseif (strpos($agent, 'yahoo') !== false) {
        $bot = 'Yahoo';
    } elseif (strpos($agent, 'msn') !== false) {
        $bot = 'MSN';
    } elseif (strpos($agent, 'msnbot') !== false) {
        $bot = 'msnbot';
    } elseif (strpos($agent, 'sohu') !== false) {
        $bot = 'Sohu';
    } elseif (strpos($agent, 'yodaoBot') !== false) {
        $bot = 'Yodao';
    } elseif (strpos($agent, 'twiceler') !== false) {
        $bot = 'Twiceler';
    } elseif (strpos($agent, 'ia_archiver') !== false) {
        $bot = 'Alexa_';
    } elseif (strpos($agent, 'iaarchiver') !== false) {
        $bot = 'Alexa';
    } elseif (strpos($agent, 'slurp') !== false) {
        $bot = '雅虎';
    } elseif (strpos($agent, 'bot') !== false) {
        $bot = '其它蜘蛛';
    }
    if (@$bot) {
        exit;
    }
}

function make_coupon_card()
{
    $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $rand = $code[rand(0, 25)]
        . strtoupper(dechex(date('m')))
        . date('d') . substr(time(), -5)
        . substr(microtime(), 2, 5)
        . sprintf('%02d', rand(0, 99));
    for (
        $a = md5($rand, true),
        $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
        $d = '',
        $f = 0;
        $f < 8;
        $g = ord($a[$f]),
        $d .= $s[($g ^ ord($a[$f + 8])) - $g & 0x1F],
        $f++
    );
    return $d;
}

function get_mysql($DB)
{
    $data = $DB->query('SELECT VERSION() AS version')->fetch(PDO::FETCH_ASSOC);
    return $data['version'];
}

function insertSql($table, $data)
{
    $sql = "INSERT INTO `{$table}`(";

    foreach ($data as $k => $v) {
        $sql .= "`{$k}`,";
    }

    $sql = trim($sql, ',') . ')VALUES(';

    foreach ($data as $v) {
        $sql .= "'{$v}',";
    }

    $sql = trim($sql, ',') . ')';

    return $sql;
}
function updateSql($table, $data, $where = false, $buy = false)
{
    $sql = "UPDATE `{$table}` SET ";

    if (!$buy) {
        foreach ($data as $k => $v) {
            $sql .= "`{$k}` = '{$v}',";
        }
    } else {
        foreach ($data as $k => $v) {
            $sql .= "`{$k}` = {$v},";
        }
    }

    $sql = trim($sql, ',');

    if ($where) $sql .= " WHERE {$where}";
    return $sql;
}
function sqlSafe($ary)
{
    $ary = array_map('filter', $ary);
    return $ary;
}
function filter($str)
{
    if (is_array($str)) return array_map('filter', $str);
    return htmlspecialchars($str);
}
