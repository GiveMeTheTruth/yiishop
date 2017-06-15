
--管理员表
create table `admin` (
	`id` int(11) unsigned not null auto_increment primary key,
	`username` varchar(32) not null default '',
	`password` varchar(32) not null default '',
	`email` varchar(32) not null default '',
	PRIMARY KEY(`id`),
	UNIQUE admin_username_password(`username`, `password`),
	UNIQUE admin_username_email(`username`, `email`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- 用户表
drop table if exists `users`;
create table if not exists `users` (
	`userid` int(11) unsigned not null auto_increment,
	`username` varchar(32) not null default '',
	`password` varchar(32) not null default '',
	`email` varchar(32) not null default '',
	`createtime` int unsigned not null default '0',
	UNIQUE user_username_password(`username`, `password`),
	UNIQUE user_email_password(`email`, `password`),
	PRIMARY KEY(`userid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';
-- 用户详细信息表
drop table if exists `user_profile`;
create table if not exists `user_profile` (
	`id` int(11) unsigned not null auto_increment,
	`truename` varchar(32) not null default '',
	`age` int(11) not null default '0',
	`sex` tinyint(2) not null default '0',
	`birthday` int not null default '0',
	`nickname` varchar(32) not null default '',
	`userid` int(11) not null default '0',
	`createtime` int unsigned not null default '0',
	PRIMARY KEY(`id`),
	UNIQUE user_profile_userid(`userid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

--分类表
drop table if exists `category`;
create table if not exists `category` (
	`cateid` bigint unsigned not null auto_increment,
	`title` varchar(32) not null default '',
	`parentid` bigint unsigned not null default '0',
	`createtime` int unsigned not null default '0',
	primary key(`cateid`),
	key category_parentid(`parentid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;















