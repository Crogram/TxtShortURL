<?php
/**
 * 本文件直接运行，跳转或展示内容
 * 若为链接则跳转
 * 若为文本则显示文本，若为 HTML 标签则显示
 */
include_once './includes/common.php';
include('./includes/public.php');

$u = isset($_GET['u']) == 8 ? $_GET['u'] : exit;
$f = ROOT_PATH . '/data/txt/' . $u . '.txt';
if (file_exists($f) == false) {
    http_response_code(404);
    // include('./includes/404.html');
    echo 404;
    exit();
}
$url = file_get_contents($f);
$arr = substr($url, 0, 6);
$protocol = '/http|https|ftp|ftps|mailto|news|mms|rtmp|rtmpt|e2dk/i';
if (preg_match($protocol, $arr)) {
    header('location:' . $url);
} else {
    echo $url;
}
