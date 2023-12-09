<?php
include_once './includes/common.php';
// 中国区域显示，国家屏蔽，微信/QQ显示屏蔽，访客统计，足迹，机器人拦截，蜘蛛拦截，欺诈拦截，攻击拦截，状态开启关闭
include('./includes/public.php');

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
    <meta name="keywords" content="<?php echo $config['site_keywords']; ?>" />
    <meta name="description" content="<?php echo $config['site_description']; ?>" />
    <meta property="og:title" content="<?php echo $config['site_title']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $site_url; ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" mce_href="favicon.ico">
    <style>
        html, body {
            margin: 0;
            height: 100%;
        }
        body {
            background-image: linear-gradient(#9198e5, #6D26F0);
            text-align: center;
        }

        .brandname {
            padding-top: 100px;
            color: #fff;
            font-size: 2rem;
        }

        #url {
            width: 60%;
            margin-top: 30px;
            border: 1px solid #6D26F0;
            border-radius: 5px;
            padding: 10px;
        }

        #btn {
            cursor: pointer;
            margin-top: 38px;
            color: #fff;
            width: 150px;
            height: 50px;
            border: 1px solid #6D26F0;
            background-color: #6D26F0;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 700;
        }

        #btn:hover {
            border: 1px solid #333;
            background-color: #333;
        }

        @media(max-width:960px) {
            .brandname {
                padding-top: 50px;
            }

            #url {
                width: 90%;
            }
        }

        .desc {
            margin-top: 180px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div>
        <div class="brandname"><?php echo $config['site_title']; ?></div>
        <textarea id="url" type="text" value="" rows="4" placeholder="输入URL(以http(s)://开头)或文本"></textarea>
        <br />
        <button id="btn">生成链接</button>
        <div class="desc">
            <p>演示：<a href="<?php echo $site_url; ?>/s.php?u=CROGRAM" target="_blank"><?php echo $site_url; ?>/s.php?u=CROGRAM</a></p>
            <div>本系统可以将超长链接缩短，还可以储存文本信息<br/>非链接信息，系统默认以文本方式输出。</div><br />
            <div>© 2023 <?php echo $config['site_title']; ?> Powered by <a href="https://crogram.org" target="_blank">CROGRAM</a></div>
        </div>
    </div>
    <script>
        function d_post(url, data) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open('POST', url, true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(data);
            httpRequest.onreadystatechange = function() {
                if (httpRequest.status == 200) {
                    document.getElementById("url").value = httpRequest.responseText;
                }
            };
        }
        document.getElementById("btn").addEventListener('click', function() {
            var value = document.getElementById("url").value;
            if (value) {
                var data = "url=" + value;
                d_post('api.php', data);
            }
        })
    </script>

</body>

</html>