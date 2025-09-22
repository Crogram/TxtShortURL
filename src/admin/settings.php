<?php
include_once '../includes/common.php';
include_once '../includes/admin.php';

// 更新配置
if (isset($_REQUEST['act']) and $_REQUEST['act'] == 'update') {
    if (@strlen($_POST['site_title']) > 0) {
        $config['site_title'] = $_POST['site_title'];
    }
    if (@strlen($_POST['web']) > 3) {
        $config['site_closed'] = $_POST['web'];
    }
    if (@strlen($_POST['site_keywords']) > 0) {
        $config['site_keywords'] = $_POST['site_keywords'];
    }
    if (@strlen($_POST['site_description']) > 0) {
        $config['site_description'] = $_POST['site_description'];
    }
    if (@strlen($_POST['wechat']) > 3) {
        $config['ban_wechat'] = $_POST['wechat'];
    }
    if (@strlen($_POST['spider']) > 3) {
        $config['ban_spider'] = $_POST['spider'];
    }
    if (@strlen($_POST['admin_username']) > 4) {
        $config['admin_username'] = $_POST['admin_username'];
    }
    if (@strlen($_POST['admin_password']) > 4) {
        $config['admin_password'] = md5($_POST['admin_password']);
    }
    // print_r($config);
    wdata(ROOT_PATH . '/data/config.php', $config); //储存最新的配置
    unset($config['admin_password']);
    // print_r($config);
    // exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <title><?php echo $config['site_title']; ?> - 管理后台</title>
    <link type="text/css" href="../assets/css/admin.css" rel="stylesheet" />
    <script>
        function d_post(url, data) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open('POST', url, true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(data);
            httpRequest.onreadystatechange = function() {
                if (httpRequest.status == 200) {
                    if (httpRequest.responseText == 1) {
                        location.reload();
                    }
                }
            };
        }

        function p_post(url, data) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open('POST', url, true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send(data);
            httpRequest.onreadystatechange = function() {
                // if (httpRequest.status == 200) {
                //     console.log(httpRequest.responseText);
                // }
            };
        }

        function check0() {
            p_post("settings.php?act=update", "web=" + document.getElementById("check0").checked);
        }

        function check1() {
            p_post("settings.php?act=update", "wechat=" + document.getElementById("check1").checked);
        }

        function check2() {
            p_post("settings.php?act=update", "spider=" + document.getElementById("check2").checked);
        }

        function postadmin() {
            var data = "admin_username=" + document.getElementById("admin_username").value;
            data += "&admin_password=" + document.getElementById("admin_password").value;
            data += "&site_title=" + document.getElementById("site_title").value;
            data += "&site_keywords=" + document.getElementById("site_keywords").value;
            data += "&site_description=" + document.getElementById("site_description").value;
            p_post("settings.php?act=update", data);
        }

        function unlogin() {
            document.cookie = "username=";
            document.cookie = "token=";
            location.reload();
        }
    </script>
</head>

<body>
    <div class="header">
        <h1>TxtShortURL</h1>
    </div>

    <div class="nav">
        <a class="btn" href="<?php echo $site_url; ?>" title="站点首页" target="_blank">站点首页</a>
        <a class="btn" href="<?php echo $site_url; ?>/admin" title="后台首页">链接管理</a>
        <a class="btn" href="<?php echo $site_url; ?>/admin/?act=indexes" title="更新索引">更新索引</a>
        <a class="btn" href="<?php echo $site_url; ?>/admin/settings.php" title="系统设置">系统设置</a>
        <div style="float: right;">
            <span class="btn" onclick="unlogin()">退出登录</span>
        </div>
    </div>
    <div class="content">
        <div class="form">
            <div class="form-item">
                <div class="form-label"></div>
                <div class="">
                    <?php if ($config['site_closed'] == "true") { ?>
                        关闭站点 <input onclick="check0()" id="check0" checked type="checkbox" />
                    <?php } else { ?>
                        关闭站点 <input onclick="check0()" id="check0" type="checkbox" />
                    <?php } ?>
                    <?php if ($config['ban_wechat'] == "true") { ?>
                        屏蔽微信 <input onclick="check1()" id="check1" checked type="checkbox" />
                    <?php } else { ?>
                        屏蔽微信 <input onclick="check1()" id="check1" type="checkbox" />
                    <?php } ?>
                    <?php if ($config['ban_spider'] == "true") { ?>
                        蜘蛛屏蔽 <input onclick="check2()" id="check2" checked type="checkbox" />
                    <?php } else { ?>
                        蜘蛛屏蔽 <input onclick="check2()" id="check2" type="checkbox" />
                    <?php } ?>
                </div>
            </div>
            <div class="form-item">
                <div class="form-label">网站标题</div>
                <input type="text" value="<?php echo $config['site_title']; ?>" id="site_title" class="form-input" />
            </div>
            <div class="form-item">
                <div class="form-label">网站关键字</div>
                <input type="text" value="<?php echo $config['site_keywords']; ?>" id="site_keywords" class="form-input" />
            </div>
            <div class="form-item">
                <div class="form-label">网站描述</div>
                <input type="text" value="<?php echo $config['site_description']; ?>" id="site_description" class="form-input" />
            </div>
            <div class="form-item">
                <div class="form-label">管理账号</div>
                <input type="text" value="<?php echo $config['admin_username']; ?>" id="admin_username" class="form-input" />
            </div>
            <div class="form-item">
                <div class="form-label">管理密码</div>
                <input type="text" value="" id="admin_password" class="form-input" placeholder="留空不修改" />
            </div>
            <div class="form-item">
                <div class="form-label"></div>
                <div class="form-input1">
                    <div class="btn" onclick="postadmin()">保存</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>