<?php
// 本文件输出页面，和运行按钮，点击按钮时显示具体内容
include_once './includes/common.php';
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
   <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="generator" content="TxtShortURL" />
   <meta name="keywords" content="CROGRAM,TxtShortURL,PHP-SHORTURL,PHP-URL" />
   <meta name="description" content="" />
   <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" mce_href="favicon.ico">
   <style>
      #btrun {
         width: 10rem;
         height: 3rem;
         line-height: 3rem;
         position: fixed;
         top: 50%;
         left: 40%;
         border: 0;
         text-align: center;
         background-image: linear-gradient(#9198e5, #6D26F0);
         color: #f8f8f8;
         border-radius: 0.4rem;
         cursor: pointer;
      }
   </style>
</head>

<body>
   <script>
      r = document.getElementById("btrun");
      var txt = "";

      function getQueryVariable(variable) {
         var query = window.location.search.substring(1);
         var vars = query.split("&");
         for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
               return pair[1];
            }
         }
         return (false);
      }
      var httpRequest = new XMLHttpRequest();
      httpRequest.open('GET', '/data/txt/' + getQueryVariable("u") + '.txt', true);
      httpRequest.send();
      httpRequest.onreadystatechange = function() {
         if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            txt = httpRequest.responseText;
         }
      };

      function dj() {
         var r = window.open("", "", "");
         r.opener = null;
         r.document.write(txt);
         r.document.close();
         if (navigator.userAgent.indexOf('MSIE') > 0) { // close IE
            if (navigator.userAgent.indexOf('MSIE 6.0') > 0) {
               window.opener = null;
               window.close();
            } else {
               window.open('', '_top');
               window.top.close();
            }
         } else {
            window.opener = null;
            window.open('', '_self');
            window.close();
         }
      }
   </script>
   <div id="btrun" href="javascript:void(0);" hidefocus="true" onclick="dj()">运行</div>
</body>

</html>