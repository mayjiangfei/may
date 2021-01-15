<?php
    //密钥
    $secret = "990512";//Github项目中对应的Secret
    //获取GitHub发送的内容
    $json = file_get_contents('php://input');
    $content = json_decode($json, true);

    //github发送过来的签名
    $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
    if (!$signature) {
        return http_response_code(404);
    }

    list($algo, $hash) = explode('=', $signature, 2);
    //计算签名
    $payloadHash = hash_hmac($algo, $json, $secret);
    if ($hash !== $payloadHash){
        return http_response_code(404);
    }

    echo "开始部署<br>";
    chdir("/opt/may");
    exec("git pull 2>&1", $out);
    foreach($out as $v)
    {
        echo iconv( 'GB2312','UTF-8', $v)."<br>";
    }