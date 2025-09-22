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
        * {
            margin: 0;
        }
        html,
        body {
            height: 100%;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
                Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji',
                'Segoe UI Symbol';
            color: #333;
            text-align: center;
        }
        p { margin-top: 4px; }

        .brandname {
            padding-top: 100px;
            color: #333;
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
        .footer { margin-top: 10px; }
    </style>
</head>

<body>
    <div>
        <div class="brandname"><?php echo $config['site_title']; ?></div>
        <textarea id="url" type="text" value="" rows="5" placeholder="输入 URL(以http(s)://开头)
或文本"></textarea>
        <br />
        <button id="btn">生成链接</button>
        <div class="desc">
            <p>演示：<a href="<?php echo $site_url; ?>/s.php?u=CROGRAM" target="_blank"><?php echo $site_url; ?>/s.php?u=CROGRAM</a></p>
            <p>本系统可以将超长链接缩短，还可以储存文本信息。非链接信息，系统默认以文本方式输出。</p>
        </div>
        <div class="footer">
            <hr />
            <p>Copyright © <?php echo date('Y'); ?> TxtShortURL All Rights Reserved.</p>
            <p><a href="https://github.com/Crogram/TxtShortURL" target="_blank">Github</a> <a href="https://gitee.com/crogram/TxtShortURL" target="_blank">Gitee</a></p>
            <p>Powered by <a href="https://crogram.org" target="_blank">Crogram</a></p>
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