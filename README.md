# phpwind 5.3经典版

安装步骤
========
PHP 5.3.X环境下测试没问题，7.x无法正常运行，其它版本未测。

(1) Linux 或 Freebsd 服务器下安装方法
    第一步: 使用ftp工具中的二进制模式,将该软件包里的 upload 目录及其文件上传到您的空间
             假设上传后目录仍旧为 upload
    第二步: 先确认以下目录或文件属性为 (777) 可写模式
     data
     data/sql_config.php
     data/bbscache
     data/groupdb
     data/style
     attachment
     attachment/upload
     attachment/photo
     attachment/cn_img
     htm_data
     template
     template/wind
     template/admin
    第三步: 运行 http://yourwebsite/upload/install.php 安装程序,填入服务器配置信息与创始人
             相关资料, 完成安装!

(2) Windows 服务器下安装方法
     第一步: 将解压后的文件上传至你的空间，保持目录结构不变，假设目录为upload
     第二步: 运行 http://yourwebsite/upload/install.php 安装程序,填入服务器配置信息与创始人
             相关资料, 完成安装!

---------------Todo List-----------------
1）我也是没搞懂，怎么代码里是写死的http协议？我说怎么配置https，主页总是有2个js走的请求http协议报错（http可以引用https，https无法引用http）。mark一下，后面看动态适配一下——现在先无脑改成https了，能正常运行。
    ^C[root@iZj6c485z7g0zfsjasatw7Z ~]# grep -rn "\$db_bbsurl="
    columns.php:16:$db_bbsurl="http://$_SERVER[HTTP_HOST]".substr($tmp,0,strrpos($tmp,'/'));
    data/bbscache/config.php:8:$db_bbsurl='https://www.YOUR_DOMAIN.com';
    global.php:58:$db_bbsurl="http://$_SERVER[HTTP_HOST]".substr($tmp,0,strrpos($tmp,'/'));
    simple/index.php:21:$db_bbsurl=substr($db_bbsurl,0,-7);
