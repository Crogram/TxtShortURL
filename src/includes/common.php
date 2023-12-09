<?php
// ini_set('display_errors', 'On');
// error_reporting(E_ALL);
// error_reporting(-1);

header('Content-type:text/html;Charset=utf-8');
date_default_timezone_set('Asia/Shanghai');

define('IN_CRONLITE', true);
define('DEC', DIRECTORY_SEPARATOR); // 系统分隔符
define('ROOT_PATH', str_replace(strrchr(__DIR__, DEC), '', __DIR__)); // 根目录
define('INCLUDES_PATH', __DIR__ . DEC); // 引入目录

require_once INCLUDES_PATH . 'function.php';

// 获取网站基本参数
$config = rdata(ROOT_PATH . '/data/config.php');

if ($config['ban_wechat'] == "true" && is_weixin()) {
    die("请用浏览器打开");
}

if ($config['ban_spider'] == "true") {
    spider();
}

$site_url = (is_https() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
