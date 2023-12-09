<?php
include_once '../includes/common.php';
if (isset($_POST["username"]) && isset($_POST["password"])) {
  if ($_POST['username'] == $config['admin_username'] and md5($_POST['password']) == $config['admin_password']) {
    setcookie("username", $_POST['username'], time() + 86400);
    setcookie("token", md5($_POST['password']), time() + 86400);
    header("Location: /admin/index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>登录</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      border: 0;
      font-size: 100%;
      font: inherit;
      vertical-align: baseline;
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
      display: block;
    }

    body {
      line-height: 1;
    }

    ol,
    ul {
      list-style: none;
    }

    blockquote,
    q {
      quotes: none;
    }

    blockquote:before,
    blockquote:after,
    q:before,
    q:after {
      content: '';
      content: none;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    * {
      box-sizing: border-box;
      font-family: "微软雅黑";
    }

    .login {
      width: 100vw;
      height: 100vh;
      background-image: -o-linear-gradient(bottom, #4481eb 0%, #04befe 100%);
      background-image: -webkit-gradient(linear, left bottom, left top, from(#4481eb), to(#04befe));
      background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%);

    }

    .login .center {
      width: 100vw;
      height: 100vh;
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -webkit-align-items: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: center;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
    }

    .login .main {
      width: 350px;
      padding: 20px;
      min-height: 250px;
      background: rgba(255, 255, 255, 0.5);
      -webkit-box-shadow: 2px 2px 5px #017293;
      box-shadow: 2px 2px 5px #017293;
      /* border-radius: 10px; */
    }

    .login .main .title {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      height: 50px;
      font-weight: 800;
      color: #333;
      -webkit-box-pack: center;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
      font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      background-repeat: no-repeat;
      background-position: top center;
      background-size: 45px 45px;
      /*border: 1px solid  #333;*/
    }

    .login .main .inputLi {
      margin-bottom: 10px;
      height: 45px;
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      position: relative;
    }

    .login .main .inputLi input {
      background: #018dae;
      height: 45px;
      line-height: 45px;
      width: 100%;
      border: none;
      padding-left: 45px;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: 0;
      outline: none;
      font-weight: bold;
      font-size: 24px;
      -webkit-box-shadow: 0 2px 2px #017293 inset;
      box-shadow: 0 2px 2px #017293 inset;
      background-color: #21a8c6;
      color: #fff;
    }

    .login .main .inputLi input:focus {
      background-color: #018dae;
      font-weight: bold;
      -webkit-transition: background-color linear 300ms;
      -o-transition: background-color linear 300ms;
      transition: background-color linear 300ms;
    }

    .login .main .inputLi input::-webkit-input-placeholder {
      color: #018dae;
      font-weight: 300;
      font-family: "微软雅黑";
      font-size: 16px;
    }

    .login .main .inputLi input::-moz-placeholder {
      color: #018dae;
      font-weight: 300;
      font-family: "微软雅黑";
      font-size: 16px;
    }

    .login .main .inputLi input:-ms-input-placeholder {
      color: #018dae;
      font-weight: 300;
      font-family: "微软雅黑";
      font-size: 16px;
    }

    .login .main .inputLi input::-ms-input-placeholder {
      color: #018dae;
      font-weight: 300;
      font-family: "微软雅黑";
      font-size: 16px;
    }

    .login .main .inputLi input::placeholder {
      color: #ccc;
      font-weight: 300;
      font-family: "微软雅黑";
      font-size: 16px;
    }

    .login .main .inputLi .username {
      background-image: url('data:image/svg+xml;%20charset=utf8,%3Csvg%20t%3D%221573808578480%22%20class%3D%22icon%22%20viewBox%3D%220%200%201024%201024%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20p-id%3D%223006%22%20width%3D%2264%22%20height%3D%2264%22%3E%3Cpath%20d%3D%22M266.24%20267.52a248.32%20244.48%200%201%200%20496.64%200%20248.32%20244.48%200%201%200-496.64%200Z%22%20fill%3D%22%23ffffff%22%20p-id%3D%223007%22%3E%3C%2Fpath%3E%3Cpath%20d%3D%22M628.48%20593.28H421.76a320%20320%200%200%200-320%20315.52v20.48c0%2071.04%20143.36%2071.04%20320%2071.04h206.72c177.28%200%20320%200%20320-71.04v-20.48a320%20320%200%200%200-320-315.52z%22%20fill%3D%22%23ffffff%22%20p-id%3D%223008%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E');
      background-repeat: no-repeat;
      background-position: left 10px center;
      background-size: 25px 25px;
    }

    .login .main .inputLi .pwd {
      background-image: url('data:image/svg+xml;%20charset=utf8,%3Csvg%20t%3D%221573808756461%22%20class%3D%22icon%22%20viewBox%3D%220%200%201024%201024%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20p-id%3D%228082%22%20width%3D%2264%22%20height%3D%2264%22%3E%3Cpath%20d%3D%22M768.64%20257.28v213.76h-98.56V261.76c0-87.68-70.976-158.72-158.08-158.72-87.04%200-158.08%2071.04-158.08%20158.72v209.28H255.36V257.28C255.36%20115.2%20370.56%200%20512%200s256.64%20115.2%20256.64%20257.28z%22%20fill%3D%22%23ffffff%22%20p-id%3D%228083%22%3E%3C%2Fpath%3E%3Cpath%20d%3D%22M847.36%20428.16H176.64a63.36%2063.36%200%200%200-56.96%2063.36v464c0%2035.264%2028.16%2064%2063.36%2064h657.92c35.264%200%2063.36-28.736%2063.36-64V491.52a63.36%2063.36%200%200%200-56.96-63.36z%20m-299.52%20307.2v101.76c0%204.48-3.84%208.32-8.256%208.32H484.48c-4.48%200-8.32-3.84-8.32-8.32v-101.76c-25.6-12.8-42.88-39.04-42.88-70.464a78.656%2078.656%200%201%201%20157.44%200c0%2031.424-17.28%2057.664-42.88%2070.464z%22%20fill%3D%22%23ffffff%22%20p-id%3D%228084%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E');
      background-repeat: no-repeat;
      background-position: left 10px center;
      background-size: 25px 25px;
    }

    .login .main .inputLi .code {
      background-image: url('data:image/svg+xml;%20charset=utf8,%3Csvg%20t%3D%221573809652334%22%20class%3D%22icon%22%20viewBox%3D%220%200%201024%201024%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20p-id%3D%2226754%22%20width%3D%2264%22%20height%3D%2264%22%3E%3Cpath%20d%3D%22M96.019692%20199.286154c0-8.861538%207.128615-14.454154%2021.464616-16.856616%2017.998769-2.875077%2036.076308-5.238154%2054.19323-7.128615%2024.064-2.756923%2047.931077-6.852923%2071.522462-12.248615a204.366769%20204.366769%200%200%200%2073.609846-33.201231c15.990154-10.633846%2031.192615-22.409846%2045.489231-35.249231%2013.430154-12.130462%2026.899692-24.221538%2040.369231-36.273231%2012.327385-11.067077%2025.127385-21.661538%2038.32123-31.66523a162.343385%20162.343385%200%200%201%2040.369231-22.488616v380.140308h-381.243077a3219.416615%203219.416615%200%200%201-3.072-87.394462c-0.708923-32.571077-1.063385-65.102769-1.024-97.634461m630.587077-54.193231a153.403077%20153.403077%200%200%200%2063.369846%2026.584615c23.197538%204.096%2044.977231%206.813538%2065.417847%208.152616%2020.440615%201.378462%2037.651692%202.56%2051.63323%203.584%2013.942154%201.024%2020.952615%204.923077%2020.952616%2011.736615%200%2070.852923-1.024%20133.868308-3.072%20189.085539h-379.195077V0c17.014154%204.096%2033.083077%2011.736615%2048.049231%2023.000615%2015.36%2011.539692%2029.853538%2024.182154%2043.44123%2037.809231%2013.981538%2013.981538%2028.120615%2028.475077%2042.417231%2043.441231s29.971692%2028.632615%2046.985846%2040.841846%22%20fill%3D%22%23ffffff%22%20p-id%3D%2226755%22%3E%3C%2Fpath%3E%3Cpath%20d%3D%22M439.965538%201001.511385a2768.856615%202768.856615%200%200%201-101.179076-80.738462%20909.784615%20909.784615%200%200%201-80.226462-75.618461%20559.537231%20559.537231%200%200%201-61.321846-78.178462%20511.803077%20511.803077%200%200%201-44.977231-87.394462%20613.494154%20613.494154%200%200%201-30.641231-102.715076%201061.218462%201061.218462%200%200%201-17.880615-126.188308h377.186461v568.201846a204.484923%20204.484923%200%200%201-21.464615-7.128615%20106.850462%20106.850462%200%200%201-19.495385-10.24M545.240615%20450.678154h375.099077a1052.435692%201052.435692%200%200%201-15.832615%20125.203692%20644.844308%20644.844308%200%200%201-27.608615%20100.155077c-10.870154%2029.538462-24.891077%2057.816615-41.905231%2084.322462-17.723077%2027.214769-37.533538%2053.011692-59.273846%2077.154461a1154.402462%201154.402462%200%200%201-79.202462%2079.714462c-33.476923%2030.759385-67.229538%2061.243077-101.179077%2091.490461a134.537846%20134.537846%200%200%201-50.097231%2015.320616v-573.361231%22%20fill%3D%22%23ffffff%22%20p-id%3D%2226756%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E');
      background-repeat: no-repeat;
      background-position: left 10px center;
      background-size: 25px 25px;
      padding-right: 80px;
      -webkit-box-flex: 1;
      -webkit-flex: 1;
      -ms-flex: 1;
      flex: 1;
    }

    .login .main .inputLi .codeImg {
      width: 80px;
      height: 41px;
      position: absolute;
      top: 2px;
      right: 2px;
      z-index: 99;
      cursor: pointer;
    }

    .login .main .inputLi .codeImg:active {
      opacity: 0.8;
    }

    .login .main .button-group {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
    }

    .login .main .button-group button,
    .login .main .button-group input {
      -webkit-box-flex: 1;
      -webkit-flex: 1;
      -ms-flex: 1;
      flex: 1;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border: none;
      height: 45px;
      border-radius: 0;
      outline: none;
      cursor: pointer;
      font-weight: bold;
      font-size: 18px;
      color: #fff;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -webkit-align-items: center;
      -ms-flex-align: center;
      align-items: center;
      background: #007193;
      letter-spacing: 10px;
      border-top: 2px solid #0097c4;
      border-bottom: 3px solid #01566f;
    }

    .login .main .button-group button:active {
      background: #006685;
    }
  </style>
</head>

<body>
  <div class="login">
    <div class="center">
      <div class="main">
        <div class="title">登录</div>
        <form action="" method="post">
          <div class="inputLi">
            <input type="text" class="username" name="username" autofocus="autofocus" title="账户" placeholder="请输入账户" required>
          </div>
          <div class="inputLi">
            <input type="password" class="pwd" name="password" title="密码" placeholder="请输入密码" required>
          </div>
          <!--<div class="inputLi">-->
          <!--        <input type="text" class="code" title="验证码" placeholder="请输入验证码" required>-->
          <!--        <img src="/imgs/vcode.png"  class="codeImg" title="点击可换新验证码">-->
          <!--</div>-->

          <div class="button-group">
            <!--<button type="submit">登录</button>-->
            <input type="submit" value="登录" />
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">

  </script>
</body>

</html>