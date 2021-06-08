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
