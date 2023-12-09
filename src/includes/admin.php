<?php
if (!defined('IN_CRONLITE')) {
    die('禁止访问！');
}

if (isset($_COOKIE["username"]) && isset($_COOKIE["token"])) {
    if ($_COOKIE["username"] == $config['admin_username'] && $_COOKIE["token"] == $config['admin_password']) {
    } else {
        header("Location: /admin/login.php");
    }
} else {
    header("Location: /admin/login.php");
}
