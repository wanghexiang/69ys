<?php
return array(
//'配置项'=>'配置值'
//数据库配置信息
'DB_TYPE' => 'mysql', // 数据库类型
'DB_HOST' => 'localhost', // 服务器地址
'DB_NAME' => '69ys', // 数据库名
'DB_USER' => 'root', // 用户名
'DB_PWD' => 'root', // 密码
'DB_PORT' => 3306, // 端口
'DB_PREFIX' => '', // 数据库表前缀
'DB_CHARSET' => 'utf8', // 字符集
'SHOW_PAGE_TRACE' =>true,
'OUTPUT_CHARSET' => 'utf8', //输出编码设置

//'TOKEN_ON' => true, // 是否开启令牌验证 默认关闭
//'TOKEN_NAME' => '__hash__', // 令牌验证的表单隐藏字段名称，默认为__hash__
//'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
//'TOKEN_RESET' => true, //令牌验证出错后是否重置令牌 默认为true
'URL_MODEL' => 0, 'URL_HTML_SUFFIX' => 'shtml', 'DEFAULT_MODULE' => 'Admin', 

'LANG_SWITCH_ON' => true,   // 开启语言包功能
'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
'TMPL_ACTION_SUCCESS'=>"public:success",
'TMPL_ACTION_ERROR'=>"public:error",

);