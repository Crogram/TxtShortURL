<?php
// 本文件输出根据内容类型自动展示信息
include_once './includes/common.php';
include('./includes/public.php');

$u = isset($_GET['u']) == 8 ? $_GET['u'] : exit;
if (file_exists(ROOT_PATH . '/data/txt/' . $u . '.txt') == false) {
  header('status: 404 Not Found');
  http_response_code(404);
  include('./includes/404.html');
  exit;
}

$url = file_get_contents(ROOT_PATH . '/data/txt/' . $u . '.txt');
$protocol = substr($url, 0, 6);
$arr = '/http|https|ftp|ftps|mailto|news|mms|rtmp|rtmpt|e2dk/i';

if (preg_match($arr, $protocol)) {
  header('location:' . $url);
  exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <meta name="renderer" content="webkit" />
  <meta name="force-rendering" content="webkit" />
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta name="robots" content="none, nofollow, noarchive, nocache">
  <meta name="referrer" content="never" />
  <title><?php echo $config['site_title']; ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="generator" content="TxtShortURL" />
  <meta name="keywords" content="CROGRAM,TxtShortURL,PHP-SHORTURL,PHP-URL" />
  <meta name="description" content="" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" mce_href="favicon.ico">
  <style>
    .header {
      margin-top: 50px;
      color: #6D26F0;
    }

    #url {
      width: 60%;
      height: 400px;
      /* margin-top: 30px; */
      border: 1px solid #6D26F0;
      border-radius: 5px;
      padding-left: 10px
    }

    .footer {
      color: #ccc;
    }


    @media(max-width:960px) {
      .header {
        margin-top: 30px;
        color: #6D26F0;
      }

      #url {
        width: 90%;
        margin-top: 10px;
      }

      .footer {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <div align="center">
    <h1 class="header">查看链接内容</h1>
    <textarea id="url" type="text"><?php echo htmlspecialchars($url); ?></textarea>
    <p class="footer">本系统可以将超长链接缩短，还可以储存文本信息，非链接信息，系统默认以文本方式输出。</p>
  </div>
</body>

</html>