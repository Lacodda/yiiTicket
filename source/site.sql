-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(180) CHARACTER SET latin1 NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1486905692),
('m170208_130239_create_users_table',	1486905695),
('m170208_130253_create_tickets_table',	1486905695),
('m170208_130255_create_tickets_comments_table',	1486905695);

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tickets_user_id` (`user_id`),
  CONSTRAINT `tickets_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tickets` (`id`, `date_create`, `date_modified`, `user_id`, `department`, `topic`, `status`) VALUES
(1,	'2017-02-12 13:27:42',	'2017-02-12 13:29:52',	2,	'all',	'Тест',	0);

DROP TABLE IF EXISTS `tickets_comments`;
CREATE TABLE `tickets_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_head` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_comments_ticket_id` (`ticket_id`),
  KEY `tickets_comments_user_id` (`user_id`),
  CONSTRAINT `tickets_comments_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_comments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tickets_comments` (`id`, `date_create`, `ticket_id`, `user_id`, `topic_head`, `text`) VALUES
(1,	'2017-02-12 13:27:42',	1,	2,	1,	'Тест Тест Тест Тест'),
(2,	'2017-02-12 13:29:07',	1,	1,	0,	'Ответ'),
(3,	'2017-02-12 13:29:52',	1,	2,	0,	'Ок');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `date_create`, `date_modified`, `login`, `password`, `role`, `email`) VALUES
(1,	'2017-02-12 13:24:29',	'2017-02-12 13:24:29',	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'administrator',	'admin@admin.ru'),
(2,	'2017-02-12 13:27:13',	'2017-02-12 13:27:13',	'user',	'ee11cbb19052e40b07aac0ca060c23ee',	'user',	'user@user.ru');

-- 2017-02-12 13:31:35
