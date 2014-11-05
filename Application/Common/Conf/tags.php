<?php
return array(
     // 添加下面一行定义即可
     'app_begin' => array('Behavior\CheckLangBehavior'),
    // 如果是3.2.1版本 需要改成
    // 'app_begin' => array('Behavior\CheckLangBehavior'),
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
);
?>