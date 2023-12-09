<?php
if (!defined('IN_CRONLITE')) {
    die('禁止访问！');
}

// 执行配置逻辑
if ($config['site_closed'] == "true") {
    die("暂停服务，如 24 小时内未恢复服务，具体恢复时间另行通知。");
}
