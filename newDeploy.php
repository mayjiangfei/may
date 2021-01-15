<?php
echo "开始部署<br>";
chdir("/var/www/blog/usr/themes/handsome");
exec("git pull 2>&1", $out);
foreach($out as $v)
{
    echo iconv( 'GB2312','UTF-8', $v)."<br>";
}