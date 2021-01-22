statistics-system
===
基于monda-php开发,自用系统

## 开发须知
1. 禁用die函数
2. 前端用element，vue, 数据统计用echarts
3. 登陆校验可用安全系列验证（RSA登录验证，TOKEN令牌，报文RSA+AES传输，防篡改验证，防重复提交。
由于是本机自用，只需要简单判断密码即可。