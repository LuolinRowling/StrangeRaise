<?php
return array(
    // '配置项'=>'配置值'
    'DB_TYPE'       =>  'mysql',    // 数据库类型
    'DB_HOST'       =>  '127.0.0.1',    // 服务器地址
    'DB_NAME'       =>  'mochou',   //数据库名
    'DB_USER'       =>  'root', //用户名
    'DB_PWD'        =>  '', // 输入安装MySQL时设置的密码
    'DB_PORT'       =>  '3306', //端口
    'DB_PREFIX'     =>  '', // 数据库前缀
    // 用户帐号激活状态
    'USER_INACTIVE'     => '1000',  // 未激活
    'USER_ACTIVATED'    => '1001',  // 已激活
    // CASE状态
    'CASE_PREPARE'  => '2000',   // 筹备中
    'CASE_GOING'    => '2001',     // 进行中
    'CASE_OVER'     => '2002',      // 已完成
    // 关注状态
    'UNFOCUSED'     =>  '3000', // 未关注
    'FOCUSED'       =>  '3001', // 已关注
    // 用户加入标识
    'JOIN_UNAUDIT'     =>  '4000', // 未审核
    'JOIN_PASS'       =>  '4001', // 已批准
    'JOIN_REFUSE'       =>  '4002', // 已拒绝
    // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.qq.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'1198974650@qq.com',//你的邮箱名
    'MAIL_FROM' =>'1198974650@qq.com',//发件人地址
    'MAIL_FROMNAME'=>'Mochou',//发件人姓名
    'MAIL_PASSWORD' =>'daxue12301117',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
    //管理员账号
    'admin'=>'admin@mochou.com',



    
);