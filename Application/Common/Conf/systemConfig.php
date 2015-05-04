<?php
$public_system_db_host = '127.0.0.1';
$public_system_db_name = 'cj';
$public_system_db_user = 'root';
$public_system_db_pwd = '';

return array (
	'SITE_INFO' => 
			array ( 
					'name' => '易企秀',
					'keyword' => '微场景制作,微场景应用,微信场景应用,微信场景制作',
					'description' => '易企秀,微信场景应用制作平台.微信时代企业品牌传播新路径,炫动视觉,极致体验,刷爆朋友圈,极速品牌传播!体验微场景的魅力!',
					'url' => 'yqx.cn',
					'ossurl' => 'http://ttttt.oss-cn-hangzhou.aliyuncs.com/ttttt.aliapp.com/1/webroot',
			), 
	'TOKEN' => 
			array (
					'false_static' => 2,
				),
					'WEB_ROOT' => 'yqx.cn',
					'DB_HOST' => $public_system_db_host,
					'DB_NAME' => $public_system_db_name,
					'DB_USER' => $public_system_db_user,
					'DB_PWD' => $public_system_db_pwd,
					'DB_PORT' => '3306',
					'DB_PREFIX' => 'cj_',
					'webPath' => '/',
			);
?>