<?php
/*return array(
    //'配置项'=>'配置值'
    'DEFAULT_THEME'       => 'default',
    'SHOW_PAGE_TRACE'     =>  true,
    'TMPL_PARSE_STRING'   =>  array(
        '__PUBLIC__'      =>  '../jycheck/Public',
    ), 

            'db_type'         => 'mysql',
            'db_user'         => 'shinesha',
            'db_pwd'          => 'pQ0i34eRf2',
            'db_host'         => 'localhost',
            'db_port'         => '3306',
            'db_name'         => 'shinesha_jycheck',
            'db_prefix'       => '',
            'DB_CHARSET'      => 'utf8',

    //加密盐salt
    'Salt'                => 'shine',
);*/
return array(
	//'配置项'=>'配置值'
	'DEFAULT_THEME'       => 'default',
	'SHOW_PAGE_TRACE'     =>  true,
	'TMPL_PARSE_STRING'   =>  array(
		'__PUBLIC__'      =>  '/app/graduation-project/jycheck/Public',
	), 

            'db_type'         => 'mysql',
            'db_user'         => 'root',
            'db_pwd'          => 'wulingao',
            'db_host'         => 'localhost',
            'db_port'         => '3306',
            'db_name'         => 'jycheck',
            'db_prefix'       => '',
            'DB_CHARSET'      => 'utf8',

    //加密盐salt
    'Salt'                => 'shine',

    //自动提交的超时时间,单位秒
    'AutoCommitTime'      => '1800'
);
?>