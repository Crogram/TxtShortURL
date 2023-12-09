<?php
include_once '../includes/common.php';
include_once '../includes/admin.php';

function time13()
{
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}

$runtime = time13();

// 查找文件，建立索引
function file_indexes($path)
{
    $data = array();
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && $file != '.DS_Store') {
                if (is_dir($path . '/' . $file)) {
                    // file_list($path.'/'.$file); 
                } else {
                    array_push($data, str_replace('.txt', '', $file));
                }
            }
        }
        return $data;
    }
}

function filetime($path)
{
    return date('Y-m-d H:i:s', filectime($path));
}

function dellink($id)
{
    if (file_exists(ROOT_PATH . '/data/txt/' . $id . '.txt')) {
        unlink(ROOT_PATH . '/data/txt/' . $id . '.txt');
        // 写入新索引
        wdata(ROOT_PATH . '/data/indexes.php', file_indexes(ROOT_PATH . '/data/txt/'));
    }
}

if (isset($_REQUEST['act'])) {
    if ($_REQUEST['act'] == 'del') {
        // 删除记录
        if (@strlen($_POST['id']) == 8) {
            dellink($_POST['id']);
            echo 1;
            exit;
        }
    } else if ($_REQUEST['act'] == 'indexes') {
        // 更新索引
        wdata(ROOT_PATH . '/data/indexes.php', file_indexes(ROOT_PATH . '/data/txt/'));
    }
    // $path = dirname(dirname(__FILE__)) . '/data/txt'; // 上级目录
    // $path = ROOT_PATH . '/data/txt/';
    // die($path);
    // echo "<pre>";print_r(file_indexes($path));die;
    // wdata(ROOT_PATH . '/data/indexes.php', file_indexes(ROOT_PATH . '/data/txt/'));
    // unset($data);
}

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="renderer" content="webkit" />
    <meta name="force-rendering" content="webkit" />
    <meta name="robots" content="none, nofollow, noarchive, nocache">
    <meta name="referrer" content="never" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="generator" content="PHP-APP-RENTRY" />
    <meta name="keywords" content="<?php echo $config['site_keywords']; ?>" />
    <meta name="description" content="<?php echo $config['site_description']; ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" mce_href="favicon.ico">
    <title><?php echo $config['site_title']; ?> - 管理后台</title>
    <link type="text/css" href="../assets/css/admin.css" rel="stylesheet" />
</head>

<body>
    <div class="bg">
        <!-- <img src="<?php echo $site_url; ?>/assets/img/lbg.png" style="display:none" /> -->
    </div>
    <div class="header">
        <h1><?php echo $config['site_title']; ?></h1>
    </div>
    <div class="nav">
        <div style="float: left;">
            <a class="btn" href="<?php echo $site_url; ?>" title="站点首页" target="_blank">站点首页</a>
            <a class="btn" href="<?php echo $site_url; ?>/admin/" title="后台首页">链接管理</a>
            <a class="btn" href="<?php echo $site_url; ?>/admin/?act=indexes" title="更新索引">更新索引</a>
            <a class="btn" href="<?php echo $site_url; ?>/admin/settings.php" title="系统设置">系统设置</a>
            <span class="btn" onclick="unlogin()">退出登录</span>
        </div>
        <div style="float: right;">
            <input type="text" value="" id="sdel" class="form-input" /><input type="button" value="删除指定" class="form-input-btn" onclick="dellinks()" />
        </div>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th width="100">序号</th>
                    <th>编号</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 后台链接管理
                $indexes = rdata(ROOT_PATH . "/data/indexes.php");
                $arr = array_reverse($indexes);
                unset($indexes);
                $articlelenght = count($arr);
                $listlenght = ceil($articlelenght / 18);
                $p = isset($_REQUEST['p']) ? (int)$_REQUEST['p'] : 1;
                if ($p < 0 or $p > $listlenght) {
                    $p = 1;
                }
                $page = $p * 18;
                $page = $page > $articlelenght ? $articlelenght : $page;
                $pages = $page - 18 < 0 ? 0 : $page - 18;
                $pgs = $p - 1;
                $pgs = $pgs <= 0 ? 1 : $pgs;
                $pgx = $p + 1;
                $pgx = $pgx > $listlenght ? $listlenght : $pgx;
                // echo $pgs."|".$pgx."|".$listlenght."|".$pages."|".$page;die;
                $str = "";
                for ($i = $pages; $i < $page; $i++) {
                    $str .= '<tr>' .
                        '<td data-label="序号">' . $i . '</td>' .
                        '<td data-label="编号"><a href="' . $site_url . '/s.php?u=' . $arr[$i] . '" target="_blank">' . $arr[$i] . '</a></td>' .
                        '<td data-label="创建时间">' . filetime(ROOT_PATH . "/data/txt/" . $arr[$i] . ".txt") . '</td>' .
                        '<td data-label="操作">
                        <a class="del" href="' . $site_url . '/s.php?u=' . $arr[$i] . '" target="_blank">查看</a>
                        <a class="del" href="' . $site_url . '/ss.php?u=' . $arr[$i] . '" target="_blank">演示</a>
                        <a class="del" href="' . $site_url . '/txt.php?u=' . $arr[$i] . '" target="_blank">文本</a>
                        <a class="del" href="' . $site_url . '/run.php?u=' . $arr[$i] . '" target="_blank">运行</a>
                        <a class="del" href="javascript:(0);" onclick="dellink(\'' . $arr[$i] . '\')">删除</a>
                        </td>' .
                        '</tr>';
                }
                echo $str;
                unset($arr, $str);

                ?>
                <tr>
                    <td colspan="4" style="width:100%;text-align:center;">
                        <span class="btn avr">第<?php echo $p; ?>页/共<?php echo $listlenght; ?>页<?php echo $articlelenght; ?>条</span>
                        <a href="/admin/?p=1" title="首页" class="btn">首页</a>
                        <a href="/admin/?p=<?php echo $pgs; ?>" title="上一页" class="btn">上一页</a>
                        <span title="当前页" class="btn avr"><?php echo $p; ?></span>
                        <a href="/admin/?p=<?php echo $pgx; ?>" title="下一页" class="btn">下一页</a>
                        <a href="/admin/?p=<?php echo $listlenght; ?>" title="尾页" class="btn">尾页</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>© <?php echo date('Y'); ?> Powered by <a href="https://crogram.org" target="_blank">CROGRAM</a> </p>
    </div>

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
                if (httpRequest.status == 200) {
                    console.log(httpRequest.responseText);
                }
            };
        }

        function dellink(id) {
            d_post("/admin/?act=del", "id=" + id);
        }

        function dellinks() {
            var id = document.getElementById("sdel").value;
            if (id) {
                d_post("/admin/?act=del", "id=" + id);
            }
        }

        function unlogin() {
            document.cookie = "username=";
            document.cookie = "token=";
            location.href = "<?php echo $site_url; ?>/admin";
        }
    </script>
</body>

</html><!--<?php echo time13() - $runtime; ?>ms-->