statistics-system
===
基于monda-php开发,自用系统

## 开发须知
1. 禁用die函数
2. 前端用element，vue, 数据统计用echarts
3. 登陆校验可用安全系列验证（RSA登录验证，TOKEN令牌，报文RSA+AES传输，防篡改验证，防重复提交。
由于是本机自用，只需要简单判断密码即可。

-----
1. 搭建nginx，配置文件在nginx/statistics.my.conf
2. 在hosts文件中，新增 statistics.my 域名
``` sudo vim /etc/hosts ``` 
3. 拉依赖包。根目录下，打开statistics-admin文件，composer install
``` cd statistics-admin ``` 
``` composer install ``` 
4. 配置本地数据库，sql语句在statistics-docs/sql下。
--- 注意statistics-admin/config/database.php文件的数据库账户密码跟本机数据库是否匹配 ---
5. 配置redis，确保本地已安装redis。
---  配置文件在statistics-admin/config/cache.php --- 


