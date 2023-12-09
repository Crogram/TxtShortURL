<?php
include_once './includes/common.php';
include('./includes/public.php');

$url = strlen($_POST['url']) > 0 ? $_POST['url'] : exit;
$code = make_coupon_card();
if (file_exists(ROOT_PATH . '/data/txt/' . $code . '.txt') == false) {
    file_put_contents(ROOT_PATH . '/data/txt/' . $code . '.txt', $url);
} else {
    $code = make_coupon_card();
    file_put_contents(ROOT_PATH . '/data/txt/' . $code . '.txt', $url);
}

$durl = $site_url . '/s.php?u=' . $code;
echo $durl;
