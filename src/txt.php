<?php
// 本文件只输出文本
include_once './includes/common.php';
include('./includes/public.php');

$u = isset($_GET['u']) == 8 ? $_GET['u'] : exit;
$f = ROOT_PATH . '/data/txt/' . $u . '.txt';
if (file_exists($f) == false) {
    http_response_code(404);
    // include('./includes/404.html');
    echo '404';
    exit();
}

$url = file_get_contents($f);
header('Content-Type:text/plain;charset=utf-8');
echo $url;
