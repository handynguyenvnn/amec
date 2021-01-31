/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : adplus_amec

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-22 19:35:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `login_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `lock` tinyint(1) NOT NULL,
  `login_miss_times` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_login_id_unique` (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES ('1', 'Account Manager 01', 'accountM01', '$2y$10$15GFURxTprWpzpTDjXLRe.CEnwrLENGBSoR.cbjO77hqsKSA8WID.', '{\"account.admin\":true}', null, '0', '0', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `accounts` VALUES ('2', 'Master Manager 01', 'masterM01', '$2y$10$B79MYeEnIXPwUMlfFt6PU.cvykr.AhfqBRHvwBekDH5uvIr/1yWwC', '{\"master.admin\":true}', null, '0', '0', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `accounts` VALUES ('3', 'Access Analysis 01', 'accessM01', '$2y$10$uL7fopO0A7..b5jumcr1bOOzXaDwm1BkbFE1yL5/a4XmQmyuAu5z.', '{\"access_analysis.admin\":true}', null, '0', '0', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `accounts` VALUES ('4', 'Content Manager 01', 'contentM01', '$2y$10$yatp4z4PCT67wLNWOUCGSOj.B/Japp4GN2oKaOiGFkM0/Ruz6O1nC', '{\"content.admin\":true}', null, '0', '0', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `accounts` VALUES ('5', 'Collection Manager 01', 'collectionM01', '$2y$10$Rfw2JvSGlTcOahnj9DPuUeiFSCVaQv5gJCN2p0zI3sVQLyn4O4RTe', '{\"collection.admin\":true}', null, '0', '0', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `accounts` VALUES ('6', 'User Manager 01', 'userM01', '$2y$10$5U4lwUsGkll/awgCVJ7vjO9zYKeos5QUs9qxObXeBKP1Q1yIhJN8m', '{\"user.admin\":true}', null, '0', '0', '2017-07-22 12:31:12', '2017-07-22 12:31:13');
INSERT INTO `accounts` VALUES ('7', 'Notification 01', 'notificationM01', '$2y$10$aaJIlXy3lvvVubVctFwOP.3QONGyfLf9h/N33d3scxGyPQuYUTn1G', '{\"notification.admin\":true}', null, '0', '0', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `accounts` VALUES ('8', 'Terms of service 01', 'termsM01', '$2y$10$TnRr149KOCosG4CNjTm2BuQxEZ.B6siD.XCrZQEGqZlT4SybCYTF6', '{\"terms_of_service.admin\":true}', null, '0', '0', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `accounts` VALUES ('9', 'Common Account 01', 'commonM01', '$2y$10$De/uFPOnggDexVXQxElub.ZGwHGgps5JXBrZIpgPSpntcj1zJj7XG', '{\"account.admin\":true,\"master.admin\":true,\"access_analysis.admin\":true,\"content.admin\":true,\"collection.admin\":true,\"user.admin\":true,\"notification.admin\":true,\"terms_of_service.admin\":true}', null, '0', '0', '2017-07-22 12:31:13', '2017-07-22 12:31:13');

-- ----------------------------
-- Table structure for activations
-- ----------------------------
DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of activations
-- ----------------------------
INSERT INTO `activations` VALUES ('1', '1', '2bA1ELmlnPZkpF3PDYfzEHk4j1eq04Uu', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `activations` VALUES ('2', '2', 'JpBKBIqnJepNF0IOymmo1K1LqkMKL7Nd', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `activations` VALUES ('3', '3', 'i5Ziwt6JuaCpFjCiJqsl2XiMh667nowu', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `activations` VALUES ('4', '4', 'YO0M8gpHL70WQ5JR8Cm6HvQGhVPg4oRt', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `activations` VALUES ('5', '5', 'rYAVEMcpiVuSgP1ZuryVwC8wUEXgSlka', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `activations` VALUES ('6', '6', 'sS0KduvVvkpOf9Aj4UJhtVd0uP6xZwTS', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `activations` VALUES ('7', '7', 'E4zmKntWbeXsfjW5IrdkxUo7lU73b7Fs', '1', '2017-07-22 12:31:13', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `activations` VALUES ('8', '8', '82LdJiYGkL48lBG6PCmI5ow0swps9vZa', '1', '2017-07-22 12:31:13', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `activations` VALUES ('9', '9', 'djTVhG5uFVdpjDEQML9cjRLZrFG7EK6w', '1', '2017-07-22 12:31:13', '2017-07-22 12:31:13', '2017-07-22 12:31:13');

-- ----------------------------
-- Table structure for administrator_transmission_history
-- ----------------------------
DROP TABLE IF EXISTS `administrator_transmission_history`;
CREATE TABLE `administrator_transmission_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_tool_id` int(10) unsigned NOT NULL,
  `received_date` datetime NOT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of administrator_transmission_history
-- ----------------------------
INSERT INTO `administrator_transmission_history` VALUES ('1', '16', '1976-04-20 00:00:00', 'Ullam saepe sit fugit enim nihil possimus quia. Non consectetur magni officiis corrupti ut. Quae qui aliquid molestiae at.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('2', '8', '1999-04-11 00:00:00', 'Cupiditate molestiae dicta quis vitae quaerat architecto. Id qui labore et voluptates ea.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('3', '5', '2016-03-20 00:00:00', 'Eos adipisci nostrum voluptas. Et eius aspernatur dolorum possimus sequi officia. Mollitia perspiciatis officia ut accusantium cumque. Laboriosam dolorem consequatur minima aut et.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('4', '27', '2015-07-03 00:00:00', 'Expedita aliquam dolor hic quos ullam tempora. Vitae beatae et aperiam labore. Aperiam sint doloribus autem deleniti dolorem.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('5', '5', '1995-08-20 00:00:00', 'Omnis blanditiis explicabo incidunt explicabo aperiam. Vero unde facilis et vel. Soluta reprehenderit ea consequuntur. Rem possimus sapiente repellendus dolor non.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('6', '6', '1992-02-18 00:00:00', 'Commodi optio saepe id commodi dicta sed modi optio. Laboriosam est nisi odio voluptatibus qui dolorem. Dolores itaque amet facere sed.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('7', '23', '1975-05-18 00:00:00', 'Deserunt minima repellendus cum facilis nihil eligendi consequuntur. Et sequi veniam quis maiores impedit veritatis porro accusantium. Quae dolores illo perferendis ut ea.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('8', '27', '1990-10-30 00:00:00', 'Molestias est a quasi sunt eius consequuntur. Odio est sed rerum exercitationem et. Et et quo dolorem eum omnis. Fugit sint corporis aut reiciendis nostrum quam quidem rerum.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('9', '19', '2007-06-14 00:00:00', 'Amet sint accusamus sed occaecati placeat eaque. Vero in ad cumque sunt ut. Atque quis quam expedita ad molestiae consectetur.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('10', '3', '1987-09-19 00:00:00', 'Quas fuga perferendis magnam facilis. Consequatur iure quo natus officiis eum explicabo. Nesciunt non dignissimos sit. Veritatis esse enim laudantium est fugit.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('11', '27', '1979-03-20 00:00:00', 'Doloribus ipsa minima voluptatem rerum. Sed eum voluptatem dolorem rem minus suscipit autem.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('12', '48', '1983-09-22 00:00:00', 'Fugiat quibusdam eligendi sequi excepturi occaecati. Qui tenetur voluptatem voluptatem molestiae quidem. Expedita in aspernatur pariatur.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('13', '38', '2017-03-13 00:00:00', 'Distinctio iure quaerat aut. Officiis aut sed dolorem culpa. Vero corporis quos ea et iusto aut. Quibusdam odio amet quam pariatur vel sed voluptatem sapiente.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('14', '25', '1988-06-17 00:00:00', 'Quae a alias pariatur asperiores. Explicabo enim eveniet quia autem sunt eligendi. Qui perspiciatis voluptas illum est. Cupiditate et corrupti et et necessitatibus aspernatur non.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('15', '8', '1981-06-05 00:00:00', 'Nobis est eligendi blanditiis possimus explicabo consequuntur enim. Sed aperiam tempora vero aspernatur reprehenderit nobis quia. Consectetur rem asperiores omnis et asperiores quis.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('16', '44', '2001-04-13 00:00:00', 'Optio perferendis magnam est blanditiis repellendus deserunt. Dolor minus consequuntur fuga et tempora.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('17', '18', '1995-12-23 00:00:00', 'Quas sequi ea facilis eos dolores ad. Ea excepturi sed quae aut. Enim saepe non consequatur sed et a cum.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('18', '48', '2001-09-21 00:00:00', 'Fuga dicta animi soluta et quia totam. Nihil et explicabo architecto nisi voluptatem beatae.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('19', '4', '1974-08-03 00:00:00', 'Quasi repellat debitis perferendis ullam. Et vero molestias id iusto et eius. Eaque ea optio deleniti dolorum.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `administrator_transmission_history` VALUES ('20', '7', '1994-09-17 00:00:00', 'Labore ut ut qui cumque. Et consectetur qui quam. Porro magni aperiam voluptas libero officia placeat architecto.\nOmnis itaque ut nulla. Accusantium natus omnis at dolores aut asperiores.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');

-- ----------------------------
-- Table structure for ads
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_ad` tinyint(1) NOT NULL,
  `gacha_ad` tinyint(1) NOT NULL,
  `content_ad` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ads
-- ----------------------------
INSERT INTO `ads` VALUES ('1', '1', '0', '0', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('2', '1', '1', '1', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('3', '0', '1', '1', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('4', '0', '0', '0', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('5', '0', '0', '0', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('6', '1', '0', '1', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('7', '1', '1', '1', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('8', '0', '0', '1', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('9', '1', '0', '0', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ads` VALUES ('10', '0', '0', '0', '2017-07-22 12:31:30', '2017-07-22 12:31:30');

-- ----------------------------
-- Table structure for ad_videos
-- ----------------------------
DROP TABLE IF EXISTS `ad_videos`;
CREATE TABLE `ad_videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` int(10) unsigned NOT NULL,
  `image_animation_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ad_videos
-- ----------------------------
INSERT INTO `ad_videos` VALUES ('1', '1', 'http://lorempixel.com/640/480/?60057', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('2', '10', 'http://lorempixel.com/640/480/?33878', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('3', '7', 'http://lorempixel.com/640/480/?62195', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('4', '5', 'http://lorempixel.com/640/480/?98889', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('5', '4', 'http://lorempixel.com/640/480/?11644', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('6', '5', 'http://lorempixel.com/640/480/?98926', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('7', '1', 'http://lorempixel.com/640/480/?26520', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('8', '10', 'http://lorempixel.com/640/480/?29338', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('9', '7', 'http://lorempixel.com/640/480/?96016', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('10', '8', 'http://lorempixel.com/640/480/?68015', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('11', '3', 'http://lorempixel.com/640/480/?70014', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('12', '4', 'http://lorempixel.com/640/480/?39019', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('13', '8', 'http://lorempixel.com/640/480/?32292', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('14', '2', 'http://lorempixel.com/640/480/?38644', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('15', '7', 'http://lorempixel.com/640/480/?65540', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('16', '4', 'http://lorempixel.com/640/480/?58129', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('17', '8', 'http://lorempixel.com/640/480/?23623', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('18', '10', 'http://lorempixel.com/640/480/?51694', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('19', '1', 'http://lorempixel.com/640/480/?14420', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `ad_videos` VALUES ('20', '10', 'http://lorempixel.com/640/480/?53310', '2017-07-22 12:31:30', '2017-07-22 12:31:30');

-- ----------------------------
-- Table structure for announcements
-- ----------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` tinyint(4) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `area_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of announcements
-- ----------------------------
INSERT INTO `announcements` VALUES ('1', '件名 1', '1', 'Autem est exercitationem ea doloremque accusantium et. Unde hic voluptatem qui molestiae.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('2', '件名 2', '2', 'Qui ut eveniet nobis vel amet aliquid. Molestiae nesciunt vel qui aut.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('3', '件名 3', '3', 'Aut fugiat explicabo sit et. Nobis dolorum dolores error earum nostrum. Eos et magni et illo nobis.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('4', '件名 4', '3', 'Beatae aut laudantium quo totam quis. Placeat velit sunt quis est.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('5', '件名 5', '1', 'Nulla vero quisquam perferendis amet. Debitis ut ea voluptatem expedita.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('6', '件名 6', '3', 'Sint et vero quod eum inventore est. Ipsa quaerat aut non temporibus modi vel velit.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('7', '件名 7', '2', 'Quia iste modi vel et. Sint eum ut aut nesciunt. Fugiat ab veniam dolorum temporibus est illum.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('8', '件名 8', '2', 'Dolorem nisi debitis quisquam tempora. Sit magnam in earum veniam ipsum.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('9', '件名 9', '1', 'Enim cum in deleniti error. Et voluptatum ea ad. Et veniam rerum et aut error veritatis.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('10', '件名 10', '1', 'Non esse modi quo facilis. Aliquid aliquid consequatur totam explicabo eius.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('11', '件名 11', '2', 'Soluta quas aut accusantium vero enim et. Libero soluta ducimus quis facilis doloribus.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('12', '件名 12', '3', 'Rerum in at qui. Iste blanditiis consequuntur hic nostrum veniam ea.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('13', '件名 13', '1', 'Laborum neque dolorem aspernatur incidunt est earum. Vero in praesentium autem accusamus iusto.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('14', '件名 14', '3', 'Doloremque itaque in ipsa. Iste sapiente nihil maxime voluptas modi aut.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('15', '件名 15', '2', 'A fugit sed provident qui. Quibusdam quis mollitia tempora qui ut rerum sit voluptatem.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('16', '件名 16', '1', 'Voluptatem amet et ipsa vel commodi facere asperiores ut. Tempora vitae est sed ipsum et tempore.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('17', '件名 17', '3', 'Eveniet at ut dicta modi. Qui nesciunt beatae ad natus quod. Fugiat vitae aut voluptatem sit culpa.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('18', '件名 18', '3', 'Quia non commodi eos consequuntur eum. Recusandae dignissimos atque pariatur.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('19', '件名 19', '3', 'Nostrum a iure quibusdam qui quasi atque. Eos beatae quo ad quos.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('20', '件名 20', '2', 'Eius et in dolorem quasi deserunt. Magnam quia at est aut nisi excepturi.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('21', '件名 21', '3', 'Et rem sequi ut velit non ad. Soluta laboriosam iste rerum id. Possimus amet vero recusandae.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('22', '件名 22', '2', 'Eos harum eveniet voluptas asperiores sed labore fugit. Omnis sed enim vel possimus deserunt rerum.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('23', '件名 23', '3', 'Laborum minus esse quaerat quas. Veniam quisquam aspernatur in asperiores.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('24', '件名 24', '1', 'Maxime in rerum nihil neque. Maxime veniam cumque qui nemo provident et.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('25', '件名 25', '3', 'Atque consectetur accusamus aut sit. Molestiae qui quia quia reiciendis beatae iste.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('26', '件名 26', '3', 'Et eius id ut eveniet est. Sed aliquid rem et accusantium optio.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('27', '件名 27', '1', 'Quo suscipit ratione nesciunt sed. Non qui est sequi. Voluptates culpa ab quo sed nesciunt dolores.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('28', '件名 28', '1', 'Qui excepturi iusto maiores a sunt corporis numquam. Autem consectetur voluptatem mollitia vitae.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('29', '件名 29', '3', 'Et quia facere corporis dolor in ad. Sunt ea eaque minus consectetur molestias.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('30', '件名 30', '1', 'Iure et molestias recusandae nemo dolor autem. Error quas accusantium sit doloribus.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('31', '件名 31', '2', 'Adipisci vero qui recusandae ducimus qui. Quod ad dolorum itaque.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('32', '件名 32', '1', 'Velit et assumenda nostrum id omnis. Autem error adipisci minima assumenda.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('33', '件名 33', '3', 'Vel vel praesentium voluptatem dicta. Sed non ratione nihil et. Est autem officia ipsam.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('34', '件名 34', '3', 'Quae unde consequatur vitae voluptate repudiandae. Deleniti minus et similique minima et maxime.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('35', '件名 35', '2', 'Sint sint quod et. Voluptas similique commodi laborum minima accusamus iure maiores.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('36', '件名 36', '3', 'Dolore eum qui aut error. Aut corrupti enim exercitationem necessitatibus omnis nulla sit.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('37', '件名 37', '2', 'Sunt reiciendis nemo voluptas ipsum eos nihil inventore. Omnis laudantium vitae dolores ea.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('38', '件名 38', '2', 'Ab aliquam pariatur exercitationem quia. Consequuntur neque nihil explicabo possimus.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('39', '件名 39', '3', 'Quis doloremque dolorum nulla quibusdam neque. Voluptatibus consequatur odit dolorem eos modi id.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('40', '件名 40', '3', 'Sint unde error commodi qui ratione. Quia harum nihil est. Et et aut expedita deleniti.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('41', '件名 41', '3', 'Accusantium optio magnam odit et delectus corrupti. Et natus perferendis praesentium ratione quos.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('42', '件名 42', '2', 'Earum ipsa quos fugiat voluptas. Corporis sint suscipit ut. Eaque et qui et quod ducimus.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('43', '件名 43', '1', 'Vitae accusamus ratione nobis nesciunt. Ut voluptatibus quis omnis non qui est.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('44', '件名 44', '1', 'Id perspiciatis saepe sit deserunt ea consequatur quo. Nam magni impedit corrupti quod quae ad.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('45', '件名 45', '1', 'Aut nisi et veniam est. Voluptatem et in rerum eum itaque soluta.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('46', '件名 46', '1', 'Illum eaque ab nemo aut nihil omnis voluptas. Aut rerum odit omnis dolore minima aliquid modi.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('47', '件名 47', '1', 'Nesciunt sunt eum non distinctio recusandae. Ut vero nihil quis.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('48', '件名 48', '3', 'Ut suscipit magni molestiae quod quis eaque quae. Sed sed iusto aspernatur error.', '1', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('49', '件名 49', '2', 'Sapiente dignissimos est quasi maxime qui dicta. Est autem similique alias molestiae.', '2', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `announcements` VALUES ('50', '件名 50', '1', 'Sit earum sed rem repellat. Necessitatibus aut ipsa voluptas nihil. Nemo ut et ut rerum sit.', '3', '2017-07-22 12:31:35', '2017-07-22 12:31:35');

-- ----------------------------
-- Table structure for areas
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of areas
-- ----------------------------
INSERT INTO `areas` VALUES ('1', '日本', '2017-07-22 12:31:12', null);
INSERT INTO `areas` VALUES ('2', '英国', '2017-07-22 12:31:12', null);
INSERT INTO `areas` VALUES ('3', 'ベトナム', '2017-07-22 12:31:12', null);

-- ----------------------------
-- Table structure for authorities
-- ----------------------------
DROP TABLE IF EXISTS `authorities`;
CREATE TABLE `authorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_point` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of authorities
-- ----------------------------

-- ----------------------------
-- Table structure for big_tests
-- ----------------------------
DROP TABLE IF EXISTS `big_tests`;
CREATE TABLE `big_tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) unsigned NOT NULL,
  `pass_score_rate` tinyint(3) unsigned NOT NULL,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `collection_id` int(10) unsigned NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of big_tests
-- ----------------------------
INSERT INTO `big_tests` VALUES ('1', '10', '56', 'JXQALA91R53O629K', '64', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('2', '17', '63', 'ODMUOH45Y15A469N', '56', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('3', '17', '38', 'JNCQTQ63F18W078L', '32', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('4', '13', '60', 'RDGLNR34I43T502S', '93', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('5', '17', '57', 'KBHZTN16S55M099M', '30', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('6', '8', '16', 'QHAZID49F79U539Z', '27', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('7', '20', '97', 'FNYAVP66X54B595T', '98', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('8', '14', '43', 'ZQOYOM62D36U036U', '12', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('9', '8', '6', 'JVLSXJ83A11W338P', '94', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `big_tests` VALUES ('10', '13', '20', 'UEAPTC84P08B355M', '66', 'Temp(file_id big test)', '2017-07-22 12:31:27', '2017-07-22 12:31:27');

-- ----------------------------
-- Table structure for bookmarks
-- ----------------------------
DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `control_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bookmarks
-- ----------------------------
INSERT INTO `bookmarks` VALUES ('1', '30', '1', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('2', '30', '2', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('3', '15', '3', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('4', '6', '4', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('5', '47', '5', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('6', '71', '6', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('7', '100', '7', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('8', '45', '8', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('9', '17', '9', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('10', '57', '10', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('11', '9', '11', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('12', '78', '12', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('13', '17', '13', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('14', '20', '14', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('15', '21', '15', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('16', '17', '16', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('17', '61', '17', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('18', '49', '18', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('19', '1', '19', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('20', '51', '20', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('21', '70', '21', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('22', '89', '22', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('23', '69', '23', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('24', '16', '24', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('25', '44', '25', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('26', '28', '26', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('27', '56', '27', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('28', '29', '28', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('29', '14', '29', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('30', '99', '30', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('31', '73', '31', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('32', '15', '32', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('33', '8', '33', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('34', '13', '34', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('35', '14', '35', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('36', '80', '36', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('37', '55', '37', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('38', '57', '38', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('39', '20', '39', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('40', '18', '40', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('41', '74', '41', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('42', '52', '42', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('43', '76', '43', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('44', '20', '44', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('45', '67', '45', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('46', '35', '46', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('47', '65', '47', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('48', '28', '48', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('49', '99', '49', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('50', '82', '50', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('51', '89', '51', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('52', '37', '52', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('53', '11', '53', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('54', '8', '54', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('55', '75', '55', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('56', '10', '56', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('57', '5', '57', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('58', '15', '58', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('59', '34', '59', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('60', '18', '60', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('61', '88', '61', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('62', '58', '62', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('63', '89', '63', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('64', '81', '64', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('65', '67', '65', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('66', '42', '66', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('67', '15', '67', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('68', '99', '68', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('69', '75', '69', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('70', '91', '70', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('71', '20', '71', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('72', '17', '72', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('73', '34', '73', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('74', '82', '74', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('75', '90', '75', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('76', '68', '76', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('77', '38', '77', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('78', '88', '78', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('79', '9', '79', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('80', '59', '80', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('81', '38', '81', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('82', '22', '82', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('83', '42', '83', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('84', '4', '84', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('85', '96', '85', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('86', '56', '86', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('87', '22', '87', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('88', '42', '88', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('89', '86', '89', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('90', '69', '90', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('91', '22', '91', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('92', '16', '92', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('93', '76', '93', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('94', '54', '94', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('95', '4', '95', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('96', '100', '96', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('97', '36', '97', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('98', '24', '98', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('99', '87', '99', '2017-07-22 12:31:36', '2017-07-22 12:31:36');
INSERT INTO `bookmarks` VALUES ('100', '25', '100', '2017-07-22 12:31:36', '2017-07-22 12:31:36');

-- ----------------------------
-- Table structure for card_appearance_rates
-- ----------------------------
DROP TABLE IF EXISTS `card_appearance_rates`;
CREATE TABLE `card_appearance_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `collection_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `occurrence_rate` tinyint(3) unsigned NOT NULL,
  `has_gacha` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of card_appearance_rates
-- ----------------------------
INSERT INTO `card_appearance_rates` VALUES ('1', '17', '17', '28', '5', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('2', '70', '68', '12', '90', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('3', '1', '57', '69', '84', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('4', '19', '75', '7', '46', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('5', '86', '50', '37', '25', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('6', '11', '15', '21', '67', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('7', '100', '90', '86', '35', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('8', '32', '48', '86', '28', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('9', '4', '76', '19', '88', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('10', '20', '15', '92', '76', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('11', '75', '68', '73', '94', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('12', '73', '45', '95', '28', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('13', '34', '70', '64', '77', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('14', '50', '66', '17', '3', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('15', '86', '68', '61', '99', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('16', '93', '93', '78', '80', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('17', '2', '26', '59', '85', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('18', '38', '79', '4', '48', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('19', '86', '88', '6', '89', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('20', '8', '57', '6', '20', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('21', '86', '42', '94', '30', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('22', '2', '51', '48', '51', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('23', '4', '93', '99', '68', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('24', '52', '18', '90', '69', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('25', '59', '96', '69', '55', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('26', '46', '67', '22', '30', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('27', '11', '41', '30', '80', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('28', '49', '85', '22', '32', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('29', '10', '75', '94', '54', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('30', '27', '32', '22', '70', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('31', '13', '59', '94', '91', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('32', '8', '30', '20', '51', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('33', '46', '76', '100', '100', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('34', '9', '8', '22', '59', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('35', '54', '69', '10', '41', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('36', '11', '4', '77', '57', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('37', '6', '33', '38', '83', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('38', '2', '49', '75', '0', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('39', '50', '84', '38', '68', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('40', '45', '37', '28', '85', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('41', '50', '75', '57', '17', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('42', '89', '8', '53', '72', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('43', '26', '35', '57', '75', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('44', '35', '47', '19', '53', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('45', '43', '87', '33', '28', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('46', '77', '70', '12', '57', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('47', '90', '66', '15', '40', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('48', '68', '16', '24', '19', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('49', '70', '31', '17', '9', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('50', '81', '58', '3', '61', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('51', '95', '17', '22', '12', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('52', '20', '24', '65', '25', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('53', '56', '38', '74', '38', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('54', '39', '33', '59', '45', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('55', '30', '99', '32', '45', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('56', '21', '5', '71', '57', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('57', '7', '52', '37', '91', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('58', '90', '70', '62', '55', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('59', '36', '89', '71', '25', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('60', '61', '54', '18', '69', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('61', '100', '60', '94', '43', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('62', '61', '99', '64', '71', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('63', '43', '75', '94', '29', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('64', '32', '47', '51', '25', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('65', '15', '1', '43', '14', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('66', '100', '16', '42', '67', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('67', '63', '68', '70', '24', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('68', '88', '62', '67', '78', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('69', '27', '52', '39', '82', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('70', '9', '43', '97', '23', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('71', '18', '22', '100', '29', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('72', '86', '47', '29', '10', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('73', '91', '15', '42', '41', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('74', '43', '69', '48', '44', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('75', '95', '30', '6', '9', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('76', '7', '52', '24', '34', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('77', '13', '59', '66', '94', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('78', '21', '69', '47', '55', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('79', '33', '89', '22', '59', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('80', '15', '73', '28', '50', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('81', '98', '8', '44', '34', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('82', '50', '34', '61', '41', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('83', '58', '54', '89', '90', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('84', '11', '43', '1', '44', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('85', '21', '45', '16', '42', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('86', '24', '73', '31', '42', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('87', '68', '27', '67', '2', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('88', '15', '83', '5', '76', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('89', '38', '55', '79', '62', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('90', '76', '36', '37', '79', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('91', '54', '10', '83', '93', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('92', '2', '13', '11', '82', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('93', '27', '68', '44', '13', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('94', '74', '32', '28', '70', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('95', '39', '28', '90', '64', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('96', '93', '87', '95', '30', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('97', '44', '11', '8', '86', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('98', '52', '59', '14', '19', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('99', '17', '96', '35', '87', '1', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `card_appearance_rates` VALUES ('100', '99', '8', '26', '77', '0', '2017-07-22 12:31:32', '2017-07-22 12:31:32');

-- ----------------------------
-- Table structure for certificates
-- ----------------------------
DROP TABLE IF EXISTS `certificates`;
CREATE TABLE `certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of certificates
-- ----------------------------
INSERT INTO `certificates` VALUES ('1', 'http://lorempixel.com/640/480/?79114', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('2', 'http://lorempixel.com/640/480/?72726', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('3', 'http://lorempixel.com/640/480/?47655', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('4', 'http://lorempixel.com/640/480/?41576', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('5', 'http://lorempixel.com/640/480/?62991', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('6', 'http://lorempixel.com/640/480/?83128', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('7', 'http://lorempixel.com/640/480/?19343', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('8', 'http://lorempixel.com/640/480/?48692', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('9', 'http://lorempixel.com/640/480/?71182', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('10', 'http://lorempixel.com/640/480/?83814', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('11', 'http://lorempixel.com/640/480/?71852', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('12', 'http://lorempixel.com/640/480/?62527', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('13', 'http://lorempixel.com/640/480/?17778', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('14', 'http://lorempixel.com/640/480/?32800', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('15', 'http://lorempixel.com/640/480/?12213', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('16', 'http://lorempixel.com/640/480/?97744', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('17', 'http://lorempixel.com/640/480/?79392', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('18', 'http://lorempixel.com/640/480/?67136', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('19', 'http://lorempixel.com/640/480/?74228', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('20', 'http://lorempixel.com/640/480/?46733', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('21', 'http://lorempixel.com/640/480/?74809', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('22', 'http://lorempixel.com/640/480/?71947', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('23', 'http://lorempixel.com/640/480/?31698', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('24', 'http://lorempixel.com/640/480/?92768', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('25', 'http://lorempixel.com/640/480/?54676', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('26', 'http://lorempixel.com/640/480/?92193', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('27', 'http://lorempixel.com/640/480/?94678', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('28', 'http://lorempixel.com/640/480/?35487', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('29', 'http://lorempixel.com/640/480/?93230', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('30', 'http://lorempixel.com/640/480/?56218', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('31', 'http://lorempixel.com/640/480/?11664', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('32', 'http://lorempixel.com/640/480/?68215', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('33', 'http://lorempixel.com/640/480/?16256', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('34', 'http://lorempixel.com/640/480/?41625', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('35', 'http://lorempixel.com/640/480/?57662', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('36', 'http://lorempixel.com/640/480/?16741', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('37', 'http://lorempixel.com/640/480/?36831', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('38', 'http://lorempixel.com/640/480/?68008', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('39', 'http://lorempixel.com/640/480/?52626', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('40', 'http://lorempixel.com/640/480/?46130', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('41', 'http://lorempixel.com/640/480/?57253', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('42', 'http://lorempixel.com/640/480/?66069', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('43', 'http://lorempixel.com/640/480/?47145', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('44', 'http://lorempixel.com/640/480/?58363', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('45', 'http://lorempixel.com/640/480/?17064', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('46', 'http://lorempixel.com/640/480/?48412', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('47', 'http://lorempixel.com/640/480/?27536', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('48', 'http://lorempixel.com/640/480/?23821', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('49', 'http://lorempixel.com/640/480/?96069', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('50', 'http://lorempixel.com/640/480/?64183', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('51', 'http://lorempixel.com/640/480/?92558', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('52', 'http://lorempixel.com/640/480/?43234', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('53', 'http://lorempixel.com/640/480/?76023', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('54', 'http://lorempixel.com/640/480/?56575', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('55', 'http://lorempixel.com/640/480/?60425', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('56', 'http://lorempixel.com/640/480/?54229', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('57', 'http://lorempixel.com/640/480/?52205', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('58', 'http://lorempixel.com/640/480/?94705', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('59', 'http://lorempixel.com/640/480/?11225', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('60', 'http://lorempixel.com/640/480/?12040', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('61', 'http://lorempixel.com/640/480/?78923', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('62', 'http://lorempixel.com/640/480/?94195', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('63', 'http://lorempixel.com/640/480/?59017', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('64', 'http://lorempixel.com/640/480/?80054', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('65', 'http://lorempixel.com/640/480/?61077', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('66', 'http://lorempixel.com/640/480/?24225', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('67', 'http://lorempixel.com/640/480/?57389', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('68', 'http://lorempixel.com/640/480/?97298', '1', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('69', 'http://lorempixel.com/640/480/?48611', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('70', 'http://lorempixel.com/640/480/?24986', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('71', 'http://lorempixel.com/640/480/?53514', '3', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `certificates` VALUES ('72', 'http://lorempixel.com/640/480/?24803', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('73', 'http://lorempixel.com/640/480/?80761', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('74', 'http://lorempixel.com/640/480/?32185', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('75', 'http://lorempixel.com/640/480/?76438', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('76', 'http://lorempixel.com/640/480/?47653', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('77', 'http://lorempixel.com/640/480/?76086', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('78', 'http://lorempixel.com/640/480/?10702', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('79', 'http://lorempixel.com/640/480/?55767', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('80', 'http://lorempixel.com/640/480/?84998', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('81', 'http://lorempixel.com/640/480/?49957', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('82', 'http://lorempixel.com/640/480/?21388', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('83', 'http://lorempixel.com/640/480/?71379', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('84', 'http://lorempixel.com/640/480/?67123', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('85', 'http://lorempixel.com/640/480/?76255', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('86', 'http://lorempixel.com/640/480/?12060', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('87', 'http://lorempixel.com/640/480/?75912', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('88', 'http://lorempixel.com/640/480/?76578', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('89', 'http://lorempixel.com/640/480/?25528', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('90', 'http://lorempixel.com/640/480/?24845', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('91', 'http://lorempixel.com/640/480/?58792', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('92', 'http://lorempixel.com/640/480/?36462', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('93', 'http://lorempixel.com/640/480/?29368', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('94', 'http://lorempixel.com/640/480/?85042', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('95', 'http://lorempixel.com/640/480/?18671', '1', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('96', 'http://lorempixel.com/640/480/?76301', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('97', 'http://lorempixel.com/640/480/?42232', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('98', 'http://lorempixel.com/640/480/?30594', '2', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('99', 'http://lorempixel.com/640/480/?35537', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `certificates` VALUES ('100', 'http://lorempixel.com/640/480/?77089', '3', '2017-07-22 12:31:34', '2017-07-22 12:31:34');

-- ----------------------------
-- Table structure for chapters
-- ----------------------------
DROP TABLE IF EXISTS `chapters`;
CREATE TABLE `chapters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned NOT NULL,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `collection_id` int(10) unsigned NOT NULL,
  `chapter_no` smallint(6) NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of chapters
-- ----------------------------
INSERT INTO `chapters` VALUES ('1', '30', 'ILZOVF54B11Y086T', '41', '1', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('2', '77', 'WLZWIU42Z70S431L', '65', '2', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('3', '66', 'ORGRZJ62P41O750U', '42', '3', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('4', '92', 'KXFXHA50J65J405Y', '33', '4', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('5', '48', 'DUXEVI63L61X633J', '70', '5', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('6', '90', 'EGWTPZ46O72Q676G', '15', '6', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('7', '39', 'RVRGKF64S13I180T', '87', '7', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('8', '10', 'BGAXEK79C89F735D', '12', '8', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('9', '86', 'XHGOHM13E10N998L', '42', '9', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('10', '45', 'SFBNSC12X39Z781O', '85', '10', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('11', '99', 'FUUMEU79Q25Y640W', '44', '11', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('12', '77', 'BZXZRN74Q80G752F', '96', '12', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('13', '68', 'MWBJBJ23T22L928E', '73', '13', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('14', '69', 'RLPRJU66Q10P741U', '2', '14', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('15', '99', 'TTOFWH25F65S284M', '9', '15', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('16', '86', 'WTVOCQ86H43I707Q', '80', '16', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('17', '58', 'KBFGIL25F10H296U', '65', '17', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('18', '15', 'OPCAMO48X33L682W', '3', '18', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('19', '66', 'TMWAAQ60M50F463Z', '99', '19', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('20', '57', 'WCMFZS66H54L537V', '57', '20', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('21', '52', 'AVJSZG79U59U994S', '46', '21', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('22', '81', 'CKBSFV48K80Z661N', '17', '22', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('23', '61', 'XTZDZI81F05H176V', '48', '23', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('24', '27', 'MGMOAM39M88M298E', '90', '24', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('25', '16', 'QIVNOR03Y68B999D', '65', '25', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('26', '55', 'HOUVIL17M00J257D', '45', '26', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('27', '8', 'TZKXUK51L17G458T', '97', '27', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('28', '39', 'MBJUID47E19D755C', '60', '28', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('29', '64', 'ZRPBHX11Z49O417O', '99', '29', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('30', '78', 'UUCETV78L51S281T', '96', '30', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('31', '86', 'RWKPJJ87R93P173V', '59', '31', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('32', '100', 'YUDINF04H62M376H', '33', '32', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('33', '51', 'VATJED82L78C637D', '37', '33', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('34', '41', 'CBQDCS74P22M538S', '33', '34', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('35', '56', 'OKMHGN09I10R043D', '48', '35', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('36', '3', 'ODYRTB84Q96M970D', '78', '36', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('37', '88', 'ONIOHL26B04P399V', '58', '37', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('38', '48', 'GRPHEE31P54N674G', '66', '38', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('39', '13', 'OKYBCH80Y06U111W', '5', '39', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('40', '51', 'TWYKYV59C83V240T', '82', '40', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('41', '11', 'HWYQVB96R15B051K', '91', '41', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('42', '98', 'NGKNKR71Y38B893G', '51', '42', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('43', '62', 'KWCEUU15O21W731W', '61', '43', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('44', '10', 'PYZYUS86V93L879T', '22', '44', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('45', '90', 'WMFDMN21D27M930F', '55', '45', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('46', '82', 'YKFBJK50J27W523L', '5', '46', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('47', '92', 'NUSQKY30W27X550F', '97', '47', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('48', '35', 'XMJWXS06Q44X467E', '21', '48', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('49', '37', 'DNJFHR49U80B838N', '22', '49', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `chapters` VALUES ('50', '48', 'SSHBLK20V51M890H', '18', '50', 'Temp(folder_id chapter)', 'Temp(file_id chapter setting)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');

-- ----------------------------
-- Table structure for chapter_names
-- ----------------------------
DROP TABLE IF EXISTS `chapter_names`;
CREATE TABLE `chapter_names` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chapter_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of chapter_names
-- ----------------------------
INSERT INTO `chapter_names` VALUES ('1', '39', '3', 'チャプター 1', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('2', '38', '1', 'チャプター 2', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('3', '39', '2', 'チャプター 3', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('4', '34', '1', 'チャプター 4', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('5', '49', '1', 'チャプター 5', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('6', '24', '1', 'チャプター 6', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('7', '28', '1', 'チャプター 7', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('8', '25', '2', 'チャプター 8', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('9', '6', '1', 'チャプター 9', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('10', '50', '1', 'チャプター 10', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('11', '47', '1', 'チャプター 11', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('12', '6', '2', 'チャプター 12', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('13', '50', '3', 'チャプター 13', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('14', '37', '1', 'チャプター 14', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('15', '30', '3', 'チャプター 15', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('16', '39', '2', 'チャプター 16', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('17', '20', '3', 'チャプター 17', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('18', '22', '1', 'チャプター 18', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('19', '24', '1', 'チャプター 19', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('20', '15', '1', 'チャプター 20', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('21', '19', '2', 'チャプター 21', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('22', '38', '3', 'チャプター 22', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('23', '32', '2', 'チャプター 23', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('24', '31', '3', 'チャプター 24', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('25', '34', '2', 'チャプター 25', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('26', '22', '1', 'チャプター 26', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('27', '15', '3', 'チャプター 27', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('28', '10', '3', 'チャプター 28', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('29', '12', '1', 'チャプター 29', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `chapter_names` VALUES ('30', '12', '2', 'チャプター 30', 'Temp(filed_id chapter name)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');

-- ----------------------------
-- Table structure for chat_tools
-- ----------------------------
DROP TABLE IF EXISTS `chat_tools`;
CREATE TABLE `chat_tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of chat_tools
-- ----------------------------
INSERT INTO `chat_tools` VALUES ('1', '7', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('2', '82', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('3', '5', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('4', '29', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('5', '12', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('6', '30', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('7', '3', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('8', '54', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('9', '44', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('10', '33', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('11', '46', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('12', '52', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('13', '12', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('14', '57', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('15', '96', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('16', '35', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('17', '93', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('18', '38', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('19', '14', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('20', '32', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('21', '91', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('22', '90', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('23', '60', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('24', '8', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('25', '99', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('26', '84', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('27', '94', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('28', '7', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('29', '100', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('30', '47', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('31', '78', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('32', '20', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('33', '99', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('34', '95', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('35', '83', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('36', '46', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('37', '77', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('38', '13', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('39', '5', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('40', '68', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('41', '34', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('42', '21', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('43', '98', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('44', '63', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('45', '26', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('46', '34', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('47', '58', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('48', '61', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('49', '37', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `chat_tools` VALUES ('50', '80', '2017-07-22 12:31:22', '2017-07-22 12:31:22');

-- ----------------------------
-- Table structure for collections
-- ----------------------------
DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `level_id` tinyint(3) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `collection_no` int(11) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `youtube_link` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `grade_id` int(10) unsigned NOT NULL,
  `trophy_rank_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of collections
-- ----------------------------
INSERT INTO `collections` VALUES ('1', 'Collection 1', '2', '2', '45', 'Sed quisquam autem rerum sapiente beatae. Nisi labore exercitationem qui aperiam. Suscipit architecto ipsa perspiciatis minus quia nisi. Itaque nesciunt voluptatem quam est delectus magnam quia.', 'http://lorempixel.com/640/480/?64350', '90', '1', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '4', '13', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('2', 'Collection 2', '1', '3', '21', 'Voluptatem mollitia perspiciatis quidem est. Assumenda non iste quo quibusdam. Id qui et ut nihil at amet aut. Cum laudantium exercitationem animi et eos nostrum eos.', 'http://lorempixel.com/640/480/?21168', '36', '2', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '10', '26', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('3', 'Collection 3', '9', '3', '94', 'Qui quas tempore ut quas eaque a aliquam. Perspiciatis culpa velit ipsa quia odio illum et. Molestiae sunt totam error laudantium.', 'http://lorempixel.com/640/480/?56700', '148', '3', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '13', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('4', 'Collection 4', '3', '3', '82', 'Qui consectetur voluptates voluptatem adipisci itaque. Qui ipsam voluptates asperiores consequatur ullam. Nulla sed nisi aperiam et excepturi nostrum alias.', 'http://lorempixel.com/640/480/?14611', '17', '4', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '14', '24', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('5', 'Collection 5', '7', '1', '4', 'Facere voluptas laudantium saepe voluptatum. Aut non optio assumenda nemo temporibus. Est totam natus aut neque neque molestias est.', 'http://lorempixel.com/640/480/?99928', '102', '5', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '7', '3', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('6', 'Collection 6', '2', '1', '17', 'Iste repudiandae dolore dolore aut. Perferendis commodi voluptatem earum eum. Atque iure voluptatem asperiores ut. Non dicta adipisci facere aut et voluptatem.', 'http://lorempixel.com/640/480/?80707', '123', '6', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '17', '1', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('7', 'Collection 7', '1', '3', '11', 'Et ad similique asperiores consequuntur exercitationem aut itaque aut. Et eum a dolores tempore aut voluptatem. Quibusdam rem quia ullam.', 'http://lorempixel.com/640/480/?59457', '22', '7', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '4', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('8', 'Collection 8', '5', '1', '54', 'Eveniet enim et rerum ex veritatis assumenda. Incidunt assumenda esse labore quidem. Dignissimos animi consequatur et maxime.', 'http://lorempixel.com/640/480/?95439', '146', '8', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '20', '8', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('9', 'Collection 9', '6', '1', '91', 'Illo id corporis et ab. Sit ratione dolorem et est ea eum aspernatur facilis. Deserunt quidem quis qui voluptatem consequatur blanditiis totam.', 'http://lorempixel.com/640/480/?52707', '175', '9', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '16', '20', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('10', 'Collection 10', '10', '3', '35', 'Ipsam libero sunt qui quia veritatis qui quia. Exercitationem iusto fuga quia qui. Occaecati distinctio fugiat voluptas numquam totam.', 'http://lorempixel.com/640/480/?65514', '151', '10', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '19', '45', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('11', 'Collection 11', '10', '2', '42', 'Et ut excepturi rerum quia exercitationem tempore. Ratione numquam autem alias reprehenderit quas. Et minima tenetur placeat sed quia quia.', 'http://lorempixel.com/640/480/?10877', '44', '11', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '14', '33', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('12', 'Collection 12', '7', '3', '63', 'Et porro quae debitis quae blanditiis in. Sed cupiditate omnis est ut odit architecto nemo. Praesentium sed qui natus quo. Quasi iusto et qui cum maxime.', 'http://lorempixel.com/640/480/?67299', '145', '12', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '11', '28', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('13', 'Collection 13', '5', '2', '41', 'Sed ratione cupiditate consequatur animi eum ratione eaque. Ipsum est doloremque deserunt sequi et. Maxime in velit quidem nihil explicabo.', 'http://lorempixel.com/640/480/?54386', '151', '13', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '9', '12', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('14', 'Collection 14', '2', '2', '46', 'Nam dolores fuga eligendi enim quidem quasi. Minima minus dolore unde quo quis explicabo doloribus. Maxime omnis et velit est mollitia vero vero reprehenderit.', 'http://lorempixel.com/640/480/?75880', '15', '14', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '19', '18', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('15', 'Collection 15', '8', '2', '21', 'Enim consequuntur cumque soluta ut voluptas occaecati sit et. Quos aut earum deserunt repudiandae neque quasi eum. Illum harum nihil magni aliquam dignissimos aperiam impedit cupiditate.', 'http://lorempixel.com/640/480/?25243', '157', '15', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '19', '46', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('16', 'Collection 16', '2', '3', '90', 'Possimus qui corporis quas soluta. Perferendis maxime omnis odit omnis quas laudantium ratione. Nobis asperiores veniam in est dolorem. Molestiae perspiciatis quo occaecati.', 'http://lorempixel.com/640/480/?24567', '145', '16', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '6', '40', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('17', 'Collection 17', '8', '1', '96', 'Dolorem est quasi nulla est tenetur id. Cumque perferendis et tenetur. Ut neque reprehenderit modi perspiciatis magnam eaque. Et saepe laudantium fuga eveniet neque dicta eligendi.', 'http://lorempixel.com/640/480/?10128', '127', '17', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '6', '34', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('18', 'Collection 18', '9', '1', '51', 'Sed provident voluptatem voluptas eius rerum molestiae. Voluptate nisi aperiam ea ipsum cupiditate voluptatibus. Animi excepturi illum numquam aut aliquid incidunt asperiores.', 'http://lorempixel.com/640/480/?84615', '128', '18', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '20', '48', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('19', 'Collection 19', '7', '3', '4', 'Aspernatur omnis qui velit et perferendis vitae iusto. Explicabo laudantium consequatur at. Sequi corrupti debitis sint id ex mollitia dolores. Magnam sunt ea et esse et ducimus nulla mollitia.', 'http://lorempixel.com/640/480/?46607', '88', '19', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '7', '8', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('20', 'Collection 20', '5', '3', '44', 'Nulla porro omnis quia aperiam tenetur quas velit. Ipsam labore quia eveniet eum nostrum quae.', 'http://lorempixel.com/640/480/?18241', '65', '20', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '7', '9', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('21', 'Collection 21', '9', '2', '80', 'Voluptatem similique omnis aut. Earum est ut natus eum. Deserunt ea nostrum doloremque enim. Atque debitis laborum excepturi suscipit ea distinctio omnis.', 'http://lorempixel.com/640/480/?37752', '95', '21', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '17', '31', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('22', 'Collection 22', '5', '2', '15', 'Autem fuga soluta quo omnis quae cum nam. Et pariatur laboriosam magnam fugit cumque laborum. Velit velit in earum quis. Cupiditate ab dolorem quis corporis adipisci excepturi quo.', 'http://lorempixel.com/640/480/?39343', '82', '22', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '7', '9', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('23', 'Collection 23', '10', '1', '100', 'Eveniet eum sint eum quia facere suscipit maiores. Sed blanditiis sunt nihil iste et possimus. Recusandae nesciunt ut molestias et. Molestiae laborum ipsum sed voluptatem omnis.', 'http://lorempixel.com/640/480/?29221', '154', '23', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '13', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('24', 'Collection 24', '9', '1', '82', 'Reiciendis nostrum esse repellat nemo. Enim dolorem ut consequatur sint ut deleniti. Fugit quam autem et eligendi. Incidunt ab fugiat ipsum et incidunt.', 'http://lorempixel.com/640/480/?32816', '1', '24', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '19', '30', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('25', 'Collection 25', '10', '3', '67', 'Eos minus suscipit doloribus et sit aut dolorum rerum. Minus iusto facere magnam animi et blanditiis. Minus aliquid quo qui non pariatur.', 'http://lorempixel.com/640/480/?64202', '76', '25', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '7', '21', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('26', 'Collection 26', '3', '3', '41', 'Id culpa ad et labore ut est aliquam. Magni debitis rem incidunt. Et fugiat voluptas corporis incidunt aliquam. Voluptas dolorem earum aut similique cum earum.', 'http://lorempixel.com/640/480/?29459', '111', '26', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '4', '15', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('27', 'Collection 27', '10', '3', '14', 'Eos in iusto tempora sunt. Nostrum dolorem eveniet in id itaque.\nDolor molestias excepturi non et veniam. Consectetur voluptatem vel deserunt voluptatibus sunt. In corporis facilis aut at omnis.', 'http://lorempixel.com/640/480/?83478', '199', '27', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '19', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('28', 'Collection 28', '1', '3', '34', 'Fugit laborum quisquam vel minus. Ducimus perferendis ut qui distinctio nam et nesciunt. Excepturi optio consectetur quas quo autem quia sint.', 'http://lorempixel.com/640/480/?71839', '74', '28', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', '7', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('29', 'Collection 29', '2', '1', '3', 'Laborum nam ducimus et sed voluptatem alias. Corporis rerum maxime recusandae omnis. Enim sit ut beatae eos totam. Eos occaecati nobis libero et.', 'http://lorempixel.com/640/480/?31719', '86', '29', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '19', '31', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('30', 'Collection 30', '3', '3', '12', 'Omnis amet ut quos ea ab itaque. Ut quia ab consequatur consequatur. Sed aut a fugit dolore excepturi accusantium. Quis nobis in dicta est nisi modi numquam.', 'http://lorempixel.com/640/480/?53149', '1', '30', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '9', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('31', 'Collection 31', '3', '1', '24', 'Id vero ducimus et iusto. Perferendis unde est molestiae ullam amet. Et atque aspernatur autem animi et enim.', 'http://lorempixel.com/640/480/?78305', '111', '31', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '16', '5', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('32', 'Collection 32', '7', '1', '74', 'Pariatur explicabo quaerat voluptatem corporis. Vel quo nam ea voluptatem. Officiis qui est ut quisquam minus laudantium veritatis dolor. Earum id similique dolores ab fuga.', 'http://lorempixel.com/640/480/?57896', '104', '32', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '6', '44', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('33', 'Collection 33', '6', '1', '1', 'Amet est amet explicabo dolorem explicabo velit velit qui. Perferendis dolorum est numquam deleniti incidunt illo. Illum et in illo est rem.', 'http://lorempixel.com/640/480/?41523', '71', '33', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '10', '30', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('34', 'Collection 34', '6', '1', '12', 'Illum nihil mollitia saepe. Dolore sint exercitationem modi ex asperiores ipsam et. Aut aut numquam sed rem.', 'http://lorempixel.com/640/480/?74767', '167', '34', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '19', '36', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('35', 'Collection 35', '7', '2', '62', 'Placeat adipisci non voluptatibus exercitationem doloremque tempora. Consequatur enim odit libero non et optio. Sit quia illo qui in voluptatem id id.', 'http://lorempixel.com/640/480/?44583', '177', '35', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '5', '17', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('36', 'Collection 36', '10', '1', '93', 'Porro asperiores quidem dignissimos blanditiis facilis reiciendis eos. Minima officia in pariatur voluptatem ipsa amet illum. Officia quo illo autem id sed occaecati beatae.', 'http://lorempixel.com/640/480/?62137', '20', '36', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '16', '4', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('37', 'Collection 37', '2', '2', '44', 'Aspernatur molestias eos ea ex nisi quibusdam. Sit enim officiis repudiandae veritatis. Repellat perferendis dolores cupiditate voluptatibus delectus. Distinctio voluptatem dolores ab.', 'http://lorempixel.com/640/480/?98226', '189', '37', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '11', '44', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('38', 'Collection 38', '3', '1', '82', 'Fugiat eos praesentium quis est quae. Voluptatem ipsum in corporis harum laboriosam et voluptatem. Voluptatem asperiores sit adipisci repudiandae culpa cum.', 'http://lorempixel.com/640/480/?51708', '54', '38', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '19', '13', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('39', 'Collection 39', '10', '3', '22', 'Aperiam dolorum iure voluptas placeat sint similique. Reiciendis voluptates voluptatem sunt possimus libero. Dolor sed et consequatur et voluptatem molestiae. Dicta vel sint modi.', 'http://lorempixel.com/640/480/?78195', '62', '39', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '13', '49', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('40', 'Collection 40', '9', '3', '86', 'Amet illo mollitia rerum labore id. Reprehenderit error fuga eos sed. Facere dolor dolores deserunt voluptatem eos voluptates doloribus. Quia qui pariatur odit eaque.', 'http://lorempixel.com/640/480/?21040', '90', '40', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '4', '2', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('41', 'Collection 41', '6', '2', '73', 'Animi amet nihil facilis voluptas odit quod et. Quia ullam et iste porro quo iste vitae. Et beatae eos ea commodi cum.', 'http://lorempixel.com/640/480/?43311', '200', '41', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '7', '18', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('42', 'Collection 42', '3', '3', '92', 'Quaerat tenetur repudiandae molestiae neque occaecati dolor sint. Distinctio deserunt aut eius assumenda tenetur aut. Similique dolores doloribus facilis ut autem.', 'http://lorempixel.com/640/480/?80993', '93', '42', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', '24', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('43', 'Collection 43', '6', '3', '64', 'Dicta ipsum in rerum aut nihil odio minus quis. Eos dolorem dolores et eum. Quia et cumque aperiam inventore nostrum cum.', 'http://lorempixel.com/640/480/?37643', '131', '43', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '7', '13', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('44', 'Collection 44', '3', '2', '29', 'Praesentium suscipit eum tempore sunt veniam. Accusamus dolorum corporis ut doloribus eum voluptas omnis et. Illo qui facilis voluptatem voluptate temporibus magnam quo.', 'http://lorempixel.com/640/480/?80423', '13', '44', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '5', '24', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('45', 'Collection 45', '5', '1', '94', 'Consequatur non qui excepturi accusantium. Saepe fuga corrupti exercitationem est. Occaecati quod consequatur qui doloribus.', 'http://lorempixel.com/640/480/?48972', '163', '45', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '18', '26', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('46', 'Collection 46', '6', '1', '81', 'Possimus voluptatum recusandae tempora facere atque alias. Repudiandae ut et ducimus quod. Est magnam non et sunt. Odio ducimus minima non atque ipsum at quo enim.', 'http://lorempixel.com/640/480/?17148', '100', '46', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '10', '37', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('47', 'Collection 47', '2', '3', '67', 'Itaque quidem harum voluptate quasi. Id repellendus culpa laborum debitis sint explicabo qui eveniet. Voluptas aspernatur accusamus quia.', 'http://lorempixel.com/640/480/?17548', '5', '47', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '11', '37', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('48', 'Collection 48', '4', '1', '1', 'Soluta beatae architecto adipisci perspiciatis quia sint quis. Ad qui nobis aut exercitationem quibusdam repellendus dolores. Et voluptatem impedit sint dolorum aut nam.', 'http://lorempixel.com/640/480/?54989', '104', '48', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '17', '25', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('49', 'Collection 49', '9', '1', '6', 'Aliquid neque omnis eaque. Tenetur quod et blanditiis id et libero.\nOptio libero nisi aut quidem. Tenetur nihil voluptatem illo cupiditate accusantium. Quis reprehenderit a natus.', 'http://lorempixel.com/640/480/?95707', '55', '49', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '19', '10', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('50', 'Collection 50', '4', '2', '63', 'Sit in eos ducimus voluptatem quis. Enim tenetur quibusdam odit est repudiandae quam. Ea sint eius voluptatem ducimus.', 'http://lorempixel.com/640/480/?52092', '69', '50', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '5', '26', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('51', 'Collection 51', '1', '1', '21', 'Sit recusandae aliquid officia quod iste sit impedit qui. Aut sit quis tempora delectus. Maxime ratione at architecto id consequatur.', 'http://lorempixel.com/640/480/?16582', '4', '51', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('52', 'Collection 52', '5', '1', '37', 'Repellendus quia sit beatae. Dolor magni non dolore maxime voluptatum officia fuga. Velit enim et hic nobis et dolore aut. Et perferendis aut et dolores et tempora.', 'http://lorempixel.com/640/480/?52940', '94', '52', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '3', '1', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('53', 'Collection 53', '6', '2', '42', 'Dolores ipsam vitae qui officia maxime. Debitis dicta rem rem voluptas. Nulla perferendis officia ut unde voluptas ut. Et veniam recusandae voluptas rerum quasi.', 'http://lorempixel.com/640/480/?26806', '98', '53', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '9', '46', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('54', 'Collection 54', '4', '2', '100', 'Autem in deleniti qui et illum sint dignissimos quis. Ad velit distinctio eligendi.', 'http://lorempixel.com/640/480/?95581', '3', '54', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '4', '48', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('55', 'Collection 55', '3', '1', '71', 'Sapiente ut nostrum id et. Ut nostrum ut excepturi similique numquam vitae. Aut praesentium iusto nesciunt minus deserunt omnis et ipsa. Culpa aut ad sit molestiae nesciunt inventore.', 'http://lorempixel.com/640/480/?99076', '27', '55', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2', '6', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('56', 'Collection 56', '4', '3', '76', 'Voluptas alias perferendis optio sequi eum. Sed sit doloremque quis et qui vero. Dolorum adipisci odio et.', 'http://lorempixel.com/640/480/?17823', '158', '56', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '20', '4', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('57', 'Collection 57', '6', '3', '4', 'Voluptatibus odit vero qui itaque. Fugit a quidem quos ullam quasi quae. Voluptatem sit doloribus id quia accusamus ducimus pariatur.', 'http://lorempixel.com/640/480/?90665', '18', '57', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '6', '25', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('58', 'Collection 58', '4', '3', '32', 'Sit ullam ut rerum sunt voluptatum voluptatem non odit. Nobis quidem recusandae sunt similique facilis. Quas rerum quam quo placeat odio officiis expedita.', 'http://lorempixel.com/640/480/?30358', '114', '58', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '4', '42', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('59', 'Collection 59', '1', '3', '83', 'Dolorem tempore nihil quod officiis. Ducimus deleniti maiores accusamus exercitationem praesentium non eos. At et sapiente sequi quasi eum eligendi. Omnis esse qui consequatur fuga expedita vero.', 'http://lorempixel.com/640/480/?23121', '121', '59', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '15', '16', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('60', 'Collection 60', '3', '3', '76', 'Expedita occaecati ad tempore. Officiis consequatur laborum ipsam saepe at voluptate. Maxime aut nihil nulla dolores enim provident. Et veritatis ab at.', 'http://lorempixel.com/640/480/?61371', '47', '60', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '11', '46', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('61', 'Collection 61', '6', '1', '1', 'Sit rerum quia facere molestiae cumque labore distinctio. Iusto magnam repellat soluta beatae. Earum vel aut quasi delectus sed cupiditate tempore. Doloribus sequi velit et hic vero laborum sunt.', 'http://lorempixel.com/640/480/?65766', '115', '61', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '17', '43', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('62', 'Collection 62', '3', '1', '50', 'Fugiat consequuntur temporibus molestiae sequi aut. Consequatur quaerat aut in sit nemo repellendus nemo numquam. Voluptatibus quo et quod rerum cumque corrupti vero non.', 'http://lorempixel.com/640/480/?71742', '186', '62', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '17', '11', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('63', 'Collection 63', '3', '2', '59', 'In dolorum sunt autem dicta amet odio. Quae sed quis reiciendis fugiat iure est omnis est. Ut ab ipsam pariatur laboriosam vel dicta. Dolorum autem est expedita nihil ea consectetur aliquam.', 'http://lorempixel.com/640/480/?76717', '177', '63', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '4', '42', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('64', 'Collection 64', '9', '2', '58', 'Sit neque a dicta aperiam voluptatem et omnis. Qui sit esse quia minus totam. Qui tempora labore in repellendus.', 'http://lorempixel.com/640/480/?33332', '152', '64', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '15', '49', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('65', 'Collection 65', '5', '1', '27', 'Est architecto sed dolor eos iusto veniam. In qui ea corporis exercitationem recusandae. Aut libero enim ut.\nTotam iste eveniet excepturi sed. Inventore totam et beatae quas culpa facilis in.', 'http://lorempixel.com/640/480/?12937', '149', '65', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '9', '49', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('66', 'Collection 66', '7', '2', '69', 'Voluptas ut aut non inventore eveniet quo. Architecto id a est. Amet quia suscipit alias. Ad optio et qui et tempora consequatur.', 'http://lorempixel.com/640/480/?50790', '107', '66', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '19', '16', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('67', 'Collection 67', '2', '1', '41', 'Est ut omnis aut dolorem distinctio omnis. Tenetur voluptas exercitationem blanditiis id illo et totam. Hic voluptatem libero dolores adipisci iure ut itaque.', 'http://lorempixel.com/640/480/?56955', '130', '67', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '3', '31', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('68', 'Collection 68', '10', '2', '76', 'Nulla delectus voluptatibus aut omnis sunt maiores. Rerum itaque quaerat nihil. Laboriosam ut iste explicabo exercitationem tempora molestiae. Aut aut ipsum quis ut aut.', 'http://lorempixel.com/640/480/?52401', '171', '68', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '10', '4', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('69', 'Collection 69', '1', '1', '97', 'Dignissimos magni ipsa provident nobis. Animi et eveniet atque impedit modi dolor autem laborum. At illo minus esse itaque dignissimos.', 'http://lorempixel.com/640/480/?60862', '79', '69', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '11', '3', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('70', 'Collection 70', '9', '3', '65', 'Est et omnis eaque commodi. Natus eaque quas doloremque et vitae aperiam exercitationem. Unde velit est omnis fuga qui. Porro quis nisi qui aut.', 'http://lorempixel.com/640/480/?90220', '169', '70', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '4', '47', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('71', 'Collection 71', '10', '2', '90', 'Fugiat quas repellat vitae ipsam. Explicabo maxime provident placeat amet molestias.\nCorporis atque sed accusantium totam. Qui sunt sit quia nostrum facilis. Error suscipit laudantium odit qui.', 'http://lorempixel.com/640/480/?10281', '187', '71', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '14', '23', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('72', 'Collection 72', '9', '3', '25', 'Non harum ut eum omnis illum quaerat. Illo maiores et reiciendis omnis. In maxime repudiandae dolorem nam tempora. Et distinctio libero odio error ut dolorem.', 'http://lorempixel.com/640/480/?84613', '130', '72', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '15', '25', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('73', 'Collection 73', '8', '2', '33', 'Occaecati magni ea commodi quo excepturi perferendis. Praesentium aut cupiditate in id.', 'http://lorempixel.com/640/480/?84182', '190', '73', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '17', '4', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('74', 'Collection 74', '6', '3', '62', 'Error minus est expedita ab. Aperiam neque hic ipsum dolores.', 'http://lorempixel.com/640/480/?95464', '99', '74', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '9', '25', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('75', 'Collection 75', '1', '2', '61', 'Sit quis qui est minus eum ab. Nobis ea corrupti eius nesciunt assumenda.', 'http://lorempixel.com/640/480/?82481', '117', '75', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '14', '26', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('76', 'Collection 76', '9', '3', '58', 'Dicta fuga libero facilis qui libero quo iure. Aspernatur et ea et odio. Non in in molestias.', 'http://lorempixel.com/640/480/?31615', '9', '76', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '16', '48', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('77', 'Collection 77', '2', '2', '37', 'Enim autem fuga est nihil recusandae sed consectetur. Dolorem possimus voluptas qui velit culpa non quidem. Distinctio numquam aut pariatur adipisci.', 'http://lorempixel.com/640/480/?73603', '114', '77', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '8', '26', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('78', 'Collection 78', '2', '1', '56', 'Voluptatem numquam ut nulla animi quos. Eum ex ipsum dolor impedit voluptas. Omnis aperiam culpa voluptatibus et ut rerum sapiente.', 'http://lorempixel.com/640/480/?76743', '23', '78', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '8', '13', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('79', 'Collection 79', '10', '3', '5', 'Ea a sunt voluptatum provident. Odio omnis qui in et possimus similique magni. Ullam culpa eos nesciunt quis iste dolorem quas.', 'http://lorempixel.com/640/480/?63049', '60', '79', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '7', '13', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('80', 'Collection 80', '10', '1', '5', 'Aut veniam est ut possimus ipsa. Dolores voluptatum iusto voluptates soluta laborum officia iure. Sint eum dolores commodi.', 'http://lorempixel.com/640/480/?42854', '5', '80', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '12', '12', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('81', 'Collection 81', '6', '2', '69', 'Consequatur quidem deleniti distinctio laudantium voluptatum. Id sequi quo nihil quia corporis accusantium ex aspernatur. Ipsa illo tenetur porro sequi sed consequuntur ipsam excepturi.', 'http://lorempixel.com/640/480/?13149', '111', '81', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', '10', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('82', 'Collection 82', '10', '1', '80', 'Maxime aut necessitatibus illum. Rerum praesentium molestiae minus esse assumenda sint. Quasi deleniti sit impedit voluptates id dolores. Quam beatae nemo pariatur maiores rerum.', 'http://lorempixel.com/640/480/?33376', '38', '82', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '19', '6', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('83', 'Collection 83', '2', '1', '72', 'Minima maiores et a omnis sit numquam voluptates. Esse aut voluptas ea iusto possimus maiores. Ducimus ullam in enim error. Odio dicta iusto reprehenderit.', 'http://lorempixel.com/640/480/?71171', '7', '83', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2', '45', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('84', 'Collection 84', '7', '2', '11', 'Quasi quia excepturi ea totam et officiis. Error sit omnis quos dolorem dolor. Eaque non tenetur ea dolorum alias ad. Dolor iste quo fugiat quod quisquam at cupiditate.', 'http://lorempixel.com/640/480/?79483', '144', '84', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '4', '28', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('85', 'Collection 85', '1', '2', '85', 'Ea accusamus est beatae enim quia voluptates. Ut consequatur dolorum quisquam sit nulla. Repellendus quo eos rem facere fuga.', 'http://lorempixel.com/640/480/?74717', '26', '85', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '5', '18', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('86', 'Collection 86', '7', '1', '17', 'Beatae sint est aut accusantium id nisi. Libero qui at consequatur.', 'http://lorempixel.com/640/480/?54409', '107', '86', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '8', '33', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('87', 'Collection 87', '6', '3', '26', 'Et qui amet necessitatibus incidunt. A dolor officiis sint dolorem. Sed consectetur pariatur recusandae minus enim. Eum sequi iure aspernatur et numquam aspernatur similique.', 'http://lorempixel.com/640/480/?70069', '187', '87', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '18', '39', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('88', 'Collection 88', '9', '1', '37', 'Nobis aliquam fuga quasi laudantium et. Qui eligendi sunt corrupti quo quibusdam ab. Deserunt qui odit occaecati at velit molestias occaecati. Voluptatem et qui amet nisi.', 'http://lorempixel.com/640/480/?30614', '107', '88', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '3', '23', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('89', 'Collection 89', '3', '1', '15', 'Aut alias quod exercitationem occaecati ducimus. Et praesentium placeat et autem. Sed corporis temporibus corrupti nobis libero aperiam. Eum nostrum iusto perferendis deleniti ut fugiat suscipit.', 'http://lorempixel.com/640/480/?37343', '64', '89', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '7', '25', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('90', 'Collection 90', '8', '2', '53', 'Distinctio tempora quos nostrum eum et. Dolores ut est culpa sapiente sit. Veritatis cumque consequuntur laboriosam et velit assumenda fugit quas. Dolorem vel eaque voluptas labore optio reiciendis.', 'http://lorempixel.com/640/480/?66070', '52', '90', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '7', '41', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('91', 'Collection 91', '3', '1', '2', 'Rerum sequi distinctio nihil qui laudantium aspernatur. Aut quo consectetur qui repudiandae aut doloribus ea. Odit tempore quos tempore debitis est et atque.', 'http://lorempixel.com/640/480/?73041', '1', '91', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '16', '49', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('92', 'Collection 92', '4', '3', '10', 'Occaecati quia nihil adipisci aspernatur et. Unde quo velit maiores libero ut ut voluptas. Praesentium ipsam ducimus odio omnis dolor libero. Beatae quos deserunt enim accusamus perferendis.', 'http://lorempixel.com/640/480/?90348', '12', '92', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '3', '36', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('93', 'Collection 93', '8', '3', '12', 'Facilis qui velit fugiat odio quia consequuntur. Qui expedita quia in harum dolorum eos ipsum deleniti. Quis quasi harum qui aut ab.', 'http://lorempixel.com/640/480/?51895', '157', '93', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '11', '42', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('94', 'Collection 94', '8', '3', '42', 'Odio eius blanditiis id error sit omnis. Asperiores autem cum dolor.\nVoluptates iusto officia sed. Neque est quia recusandae aliquid. Ut ex magni aliquam sed.', 'http://lorempixel.com/640/480/?55247', '106', '94', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '8', '8', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('95', 'Collection 95', '2', '1', '82', 'Et fuga cumque distinctio eum velit voluptatem dolorem qui. Natus vel sed nam debitis possimus et itaque.', 'http://lorempixel.com/640/480/?33989', '183', '95', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', '49', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('96', 'Collection 96', '5', '2', '6', 'Est possimus tenetur fugit id. Assumenda et quia magnam repudiandae quia blanditiis. Vero aut debitis et minus asperiores. Rerum eligendi vitae qui et.', 'http://lorempixel.com/640/480/?41680', '149', '96', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '15', '9', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('97', 'Collection 97', '9', '2', '3', 'Dicta commodi et numquam voluptatum id. Ratione aut similique est aliquid dolorum enim. Dolorem velit omnis ut aut qui quo.', 'http://lorempixel.com/640/480/?52122', '100', '97', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '19', '46', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('98', 'Collection 98', '1', '2', '90', 'Magni velit corrupti dolores eius aliquam ea. Quis ab nulla aut eos voluptatibus saepe vitae corporis. Porro autem est dolor corporis eveniet quisquam illum.', 'http://lorempixel.com/640/480/?52445', '156', '98', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '7', '44', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('99', 'Collection 99', '2', '1', '53', 'Error nam et hic aliquid. Repellat alias possimus optio sint vel ratione qui. Blanditiis nostrum qui pariatur. Corrupti earum qui id perferendis.', 'http://lorempixel.com/640/480/?66902', '42', '99', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '9', '46', '2017-07-22 12:31:27', '2017-07-22 12:31:27');
INSERT INTO `collections` VALUES ('100', 'Collection 100', '6', '3', '43', 'A voluptatem eius cum autem cupiditate. Quisquam fugit dolorem ut nemo. Iste sed est non harum qui. Quam et et corrupti repudiandae perspiciatis.', 'http://lorempixel.com/640/480/?57597', '83', '100', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '6', '20', '2017-07-22 12:31:27', '2017-07-22 12:31:27');

-- ----------------------------
-- Table structure for comas
-- ----------------------------
DROP TABLE IF EXISTS `comas`;
CREATE TABLE `comas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chapter_id` int(10) unsigned NOT NULL,
  `frame_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `frame_no` smallint(6) NOT NULL,
  `coma_category_id` int(10) unsigned NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of comas
-- ----------------------------
INSERT INTO `comas` VALUES ('1', '8', 'コマ 1', '1', '36', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'AABVYT09B38O030Q', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('2', '50', 'コマ 2', '2', '36', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DIPJVW23G82M112A', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('3', '22', 'コマ 3', '3', '18', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'CTDHNT20G69E212Z', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('4', '35', 'コマ 4', '4', '42', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'FDYSZK47H52C136I', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('5', '21', 'コマ 5', '5', '11', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'WYKPIL97V17M290T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('6', '32', 'コマ 6', '6', '49', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'CKUQLJ58V95C277T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('7', '40', 'コマ 7', '7', '16', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'TWDOAK96Z57P428C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('8', '9', 'コマ 8', '8', '17', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'FYFLAT32G85S145O', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('9', '15', 'コマ 9', '9', '38', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'IQAZEQ87M64J263M', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('10', '48', 'コマ 10', '10', '44', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XGRKTX49R75Y370A', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('11', '5', 'コマ 11', '11', '31', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DEDEOC68E85U369V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('12', '46', 'コマ 12', '12', '30', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'TAESRY90O29Z313M', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('13', '42', 'コマ 13', '13', '29', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'GZTPIK51R57S547T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('14', '10', 'コマ 14', '14', '30', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'YZRGSS59U48Z052F', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('15', '16', 'コマ 15', '15', '10', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'GACKMR42M47U808T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('16', '49', 'コマ 16', '16', '6', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ABQTAL97V03B262C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('17', '45', 'コマ 17', '17', '23', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'UZJLEF15S82V668Q', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('18', '18', 'コマ 18', '18', '41', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'LBPLKZ65Z79P086V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('19', '27', 'コマ 19', '19', '8', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ORIITC92E04R334G', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('20', '37', 'コマ 20', '20', '37', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DSZEKV51G98Z737H', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('21', '26', 'コマ 21', '21', '32', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'RYZWSU52U18H812T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('22', '46', 'コマ 22', '22', '31', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'OTJNRN34K42Y185X', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('23', '22', 'コマ 23', '23', '17', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'KAQLJC80P26E051P', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('24', '11', 'コマ 24', '24', '15', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BEZWXZ16G04E565K', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('25', '21', 'コマ 25', '25', '6', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ZNDJPM37D50N269V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('26', '8', 'コマ 26', '26', '28', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DHTJMH23Q46I702A', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('27', '42', 'コマ 27', '27', '24', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'GIECTU04F90P348Y', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('28', '17', 'コマ 28', '28', '43', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'QYXJUH93G50B642C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('29', '14', 'コマ 29', '29', '30', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'WIMTDB16A94R177P', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('30', '31', 'コマ 30', '30', '50', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DKXPSW06D85S949C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('31', '47', 'コマ 31', '31', '34', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'VFNAXP20G01E818C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('32', '44', 'コマ 32', '32', '15', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BWBIOW30V71V055S', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('33', '49', 'コマ 33', '33', '41', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'RLPIMU96A04A247S', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('34', '35', 'コマ 34', '34', '36', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'EEPAEU62I82R325O', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('35', '16', 'コマ 35', '35', '49', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XOCPZG08H06G918I', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('36', '1', 'コマ 36', '36', '15', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'MDMVDU85Q75Z627V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('37', '46', 'コマ 37', '37', '37', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'PCBGTL68H57E365I', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('38', '45', 'コマ 38', '38', '38', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XYXKLY53F06G941E', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('39', '25', 'コマ 39', '39', '28', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'PWDWNY84V77B268W', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('40', '3', 'コマ 40', '40', '50', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'SYYLYK98K75W625T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('41', '21', 'コマ 41', '41', '8', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'EDBKGU41B86T413W', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('42', '47', 'コマ 42', '42', '21', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BDTFSR62U88B899P', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('43', '38', 'コマ 43', '43', '17', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'UNNSUW38P12E853Y', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('44', '9', 'コマ 44', '44', '31', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XOYBMH45B44C309Y', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('45', '13', 'コマ 45', '45', '7', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DDOJVB62J60H496V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('46', '27', 'コマ 46', '46', '4', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'GEXUZW48T80O281S', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('47', '36', 'コマ 47', '47', '43', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'NTWMCY63S63T124T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('48', '38', 'コマ 48', '48', '18', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'GPKUSC95M76O940F', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('49', '18', 'コマ 49', '49', '8', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'QACFDF85Y47P052K', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('50', '40', 'コマ 50', '50', '43', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'UEOURO33K16L452K', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('51', '40', 'コマ 51', '51', '5', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'HBMNRS11W53B308T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('52', '28', 'コマ 52', '52', '29', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'NKQVGT95H26G307B', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('53', '29', 'コマ 53', '53', '17', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'MXEBKO00Q47F950Z', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('54', '33', 'コマ 54', '54', '28', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BSZMCO95M77W002G', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('55', '48', 'コマ 55', '55', '17', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XWATTJ80J06X605N', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('56', '1', 'コマ 56', '56', '50', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ETSFSN69G86X322P', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('57', '9', 'コマ 57', '57', '50', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BBCRBG36T83A969V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('58', '10', 'コマ 58', '58', '20', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'KFNZOA90F68I073Z', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('59', '49', 'コマ 59', '59', '29', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BATJCM52P92F102C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('60', '38', 'コマ 60', '60', '19', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'DWXWXE21W05I560R', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('61', '40', 'コマ 61', '61', '7', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'HPGHGQ20U53U437N', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('62', '31', 'コマ 62', '62', '35', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'YOXJUA58N19U371R', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('63', '44', 'コマ 63', '63', '44', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XVZUJO75I88E901M', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('64', '50', 'コマ 64', '64', '26', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'INFGLH19J08G414F', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('65', '48', 'コマ 65', '65', '11', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'WHMMKL59T92K288T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('66', '14', 'コマ 66', '66', '11', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'PKUFYX03E29T492C', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('67', '41', 'コマ 67', '67', '7', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'TPIBAR09V68E064P', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('68', '48', 'コマ 68', '68', '6', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'MMTSHA56T04J143Q', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('69', '29', 'コマ 69', '69', '23', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BGAJZU09A24Q832V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('70', '44', 'コマ 70', '70', '3', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'VGUZAQ71X83F042F', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('71', '44', 'コマ 71', '71', '21', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'HTMDBM64X55I979J', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('72', '18', 'コマ 72', '72', '33', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'FWBWZV22H13A897Q', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('73', '26', 'コマ 73', '73', '2', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'WDKQIO14W57U019H', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('74', '41', 'コマ 74', '74', '29', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ZVNZVE04Z70K863Y', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('75', '43', 'コマ 75', '75', '4', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'RQCHQL12Z63U121W', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('76', '45', 'コマ 76', '76', '38', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'SOLWYW69H30M735W', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('77', '8', 'コマ 77', '77', '41', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'LURNCQ33M45L616B', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('78', '25', 'コマ 78', '78', '2', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'XZPSTA74B17I227V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('79', '50', 'コマ 79', '79', '30', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'IGLTTM68G68D964F', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('80', '3', 'コマ 80', '80', '24', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BYCZXN61Y44H506N', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('81', '33', 'コマ 81', '81', '30', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'NEZUGG39D51C152Y', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('82', '28', 'コマ 82', '82', '48', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ZRZALV35Y77A937B', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('83', '43', 'コマ 83', '83', '12', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'JNGKHA45I13N649Q', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('84', '47', 'コマ 84', '84', '34', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'AHEHBB48T66A449D', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('85', '22', 'コマ 85', '85', '1', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'MUGGGI28O78Z099X', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('86', '13', 'コマ 86', '86', '6', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'HKAWGJ76A30Z050V', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('87', '19', 'コマ 87', '87', '4', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'LRVFYK39B59P613O', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('88', '25', 'コマ 88', '88', '35', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'KWHREX84T19N948J', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('89', '5', 'コマ 89', '89', '9', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'BGUZOL33V16J988Z', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('90', '37', 'コマ 90', '90', '5', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'VRIOUH60X12O866R', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('91', '2', 'コマ 91', '91', '34', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'FVATZC08B82R530S', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('92', '28', 'コマ 92', '92', '44', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'TYCNYL05D22X513E', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('93', '6', 'コマ 93', '93', '42', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'SIQYOI09K48P421T', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('94', '8', 'コマ 94', '94', '31', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'UTFMOP08Z82F579L', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('95', '13', 'コマ 95', '95', '48', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'SWKHGP80F54I231X', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('96', '26', 'コマ 96', '96', '42', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'AYTBEI18X04K289S', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('97', '2', 'コマ 97', '97', '31', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'GIQWJX00S36E075H', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('98', '46', 'コマ 98', '98', '44', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'YWCROO91R78N239L', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('99', '34', 'コマ 99', '99', '3', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'JKEJJC98V87Y518M', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `comas` VALUES ('100', '50', 'コマ 100', '100', '39', 'Temp(file_id coma common setting)', 'Temp(folder_id coma)', 'ODHSOG64W06B195B', '2017-07-22 12:31:43', '2017-07-22 12:31:43');

-- ----------------------------
-- Table structure for coma_categories
-- ----------------------------
DROP TABLE IF EXISTS `coma_categories`;
CREATE TABLE `coma_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `frame_category_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of coma_categories
-- ----------------------------
INSERT INTO `coma_categories` VALUES ('1', 'コマカテゴリ 1', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('2', 'コマカテゴリ 2', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('3', 'コマカテゴリ 3', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('4', 'コマカテゴリ 4', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('5', 'コマカテゴリ 5', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('6', 'コマカテゴリ 6', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('7', 'コマカテゴリ 7', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('8', 'コマカテゴリ 8', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('9', 'コマカテゴリ 9', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('10', 'コマカテゴリ 10', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('11', 'コマカテゴリ 11', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('12', 'コマカテゴリ 12', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('13', 'コマカテゴリ 13', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('14', 'コマカテゴリ 14', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('15', 'コマカテゴリ 15', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('16', 'コマカテゴリ 16', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('17', 'コマカテゴリ 17', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('18', 'コマカテゴリ 18', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('19', 'コマカテゴリ 19', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('20', 'コマカテゴリ 20', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('21', 'コマカテゴリ 21', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('22', 'コマカテゴリ 22', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('23', 'コマカテゴリ 23', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('24', 'コマカテゴリ 24', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('25', 'コマカテゴリ 25', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('26', 'コマカテゴリ 26', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('27', 'コマカテゴリ 27', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('28', 'コマカテゴリ 28', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `coma_categories` VALUES ('29', 'コマカテゴリ 29', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('30', 'コマカテゴリ 30', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('31', 'コマカテゴリ 31', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('32', 'コマカテゴリ 32', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('33', 'コマカテゴリ 33', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('34', 'コマカテゴリ 34', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('35', 'コマカテゴリ 35', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('36', 'コマカテゴリ 36', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('37', 'コマカテゴリ 37', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('38', 'コマカテゴリ 38', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('39', 'コマカテゴリ 39', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('40', 'コマカテゴリ 40', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('41', 'コマカテゴリ 41', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('42', 'コマカテゴリ 42', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('43', 'コマカテゴリ 43', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('44', 'コマカテゴリ 44', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('45', 'コマカテゴリ 45', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('46', 'コマカテゴリ 46', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('47', 'コマカテゴリ 47', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('48', 'コマカテゴリ 48', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('49', 'コマカテゴリ 49', '2017-07-22 12:31:43', '2017-07-22 12:31:43');
INSERT INTO `coma_categories` VALUES ('50', 'コマカテゴリ 50', '2017-07-22 12:31:43', '2017-07-22 12:31:43');

-- ----------------------------
-- Table structure for coma_languages
-- ----------------------------
DROP TABLE IF EXISTS `coma_languages`;
CREATE TABLE `coma_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coma_id` int(10) unsigned NOT NULL,
  `music_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `video_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `priority_check` tinyint(1) NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of coma_languages
-- ----------------------------
INSERT INTO `coma_languages` VALUES ('1', '35', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Eos optio doloribus dolor nam a rerum.', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?83937', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('2', '96', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Nesciunt aspernatur laborum dolor odio.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?58715', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('3', '92', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Numquam blanditiis rerum voluptatibus.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?93608', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('4', '78', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Iusto ea quos ad ad velit velit nesciunt.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?46407', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('5', '76', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Eos ea laborum aperiam adipisci ut praesentium.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?27705', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('6', '1', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Placeat quo voluptatem porro.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?91697', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('7', '53', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Qui sit accusamus rerum distinctio ut sunt.', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?47637', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('8', '57', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Exercitationem id et ut quis dolore ea.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?21754', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('9', '45', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Vero magnam corrupti deserunt est natus aut.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?17613', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('10', '73', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Error architecto ut perferendis ut magni.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?36501', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('11', '96', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Quis nihil minus consequatur possimus voluptas.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?45238', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('12', '39', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Explicabo repudiandae error veritatis non rerum.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?88599', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('13', '54', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Quia omnis voluptates voluptate.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?66894', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('14', '54', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Architecto aut numquam qui id neque et qui.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?87700', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('15', '66', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Molestias sequi ut ullam aut aut optio.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?87229', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('16', '55', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Et et animi perferendis omnis eligendi ea.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?59277', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('17', '57', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Rerum nam eos qui et quia.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?45916', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('18', '37', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Est cum numquam ducimus quia deserunt eum id.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?63653', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('19', '96', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Eius similique sit animi est quisquam.', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?33536', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('20', '28', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Consequatur ut numquam et debitis sed dolorem.', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?46121', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('21', '9', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Dolore accusamus rerum ipsum voluptas.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?76103', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('22', '89', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Voluptates sit ducimus occaecati quas.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?87603', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('23', '29', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Quisquam iure architecto soluta animi quibusdam.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?14423', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('24', '33', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Minus qui eos quo porro facere nihil.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?60344', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('25', '84', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Dolorem et eos molestiae a autem.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?85414', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('26', '69', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ea qui aut excepturi ut.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?56065', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('27', '82', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Et vero blanditiis exercitationem deserunt.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?17750', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('28', '4', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Nulla officia et perferendis architecto.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?17229', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('29', '86', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Totam iure est quis aut.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?28626', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('30', '2', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Molestiae enim quas sit suscipit autem.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?87739', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('31', '67', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Dolorem ad expedita libero modi minus et veniam.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?59026', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('32', '88', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Iusto sequi sequi voluptatem dolorem reiciendis.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?51897', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('33', '71', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'In a omnis eaque earum eos aut.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?46860', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('34', '55', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Eius fuga eum soluta perferendis.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?34028', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('35', '5', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Assumenda aut earum quo est ea.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?62833', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('36', '78', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Quae qui sint officiis ullam voluptas eius.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?66775', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('37', '36', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ut id accusamus rerum esse aliquid et.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?74134', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('38', '17', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sunt vero quidem cupiditate ducimus animi dicta.', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?43786', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('39', '65', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Consequatur reiciendis ea sint qui quo.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?50749', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('40', '59', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Atque fuga quo ex ut tempore.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?18915', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('41', '5', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Perspiciatis molestiae dolore aut explicabo quod.', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?45903', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('42', '80', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Et sed qui mollitia vero facere quaerat impedit.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?88141', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('43', '17', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Magni eum blanditiis molestias est.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?80683', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('44', '30', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Tenetur dolores in distinctio debitis est.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?90786', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('45', '12', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ab cupiditate voluptates ratione et.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?62758', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('46', '93', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Est voluptas tempore voluptatem.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?57929', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('47', '48', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Nemo numquam magni sed et mollitia asperiores.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?99469', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('48', '94', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Debitis rerum numquam officia animi doloribus.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?65058', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('49', '68', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Voluptatem iusto ullam nihil est.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?28166', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('50', '16', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Et libero illum eius deserunt.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?92580', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('51', '50', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ut aut sint autem quisquam.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?41845', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('52', '76', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Dolores similique in delectus non omnis id.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?33195', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('53', '35', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Asperiores voluptates explicabo ut id.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?91598', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('54', '57', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Corporis consequuntur aut a praesentium pariatur.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?60054', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('55', '57', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ratione ratione deserunt error sed.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?62111', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('56', '28', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Eaque tempora aut vel sit fuga.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?88172', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('57', '6', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Aut aliquam cupiditate voluptatem quia.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?18359', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('58', '80', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sit inventore inventore exercitationem.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?83619', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('59', '21', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sunt quibusdam ducimus odit itaque libero nobis.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?18809', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `coma_languages` VALUES ('60', '12', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Et reiciendis ipsa non est.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?13474', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('61', '25', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ad maxime laborum animi pariatur rem pariatur.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?23202', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('62', '40', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Voluptatem sed laudantium quaerat cupiditate.', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?66613', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('63', '95', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Vel doloremque nam iure quas.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?32383', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('64', '59', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Doloribus qui rem voluptas nesciunt hic.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?90584', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('65', '39', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Est nisi ex molestiae numquam molestiae.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?41791', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('66', '13', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Porro dolor sequi sit et at aut.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?96015', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('67', '75', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Nam et corrupti dolore odio ipsam.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?70935', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('68', '83', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Qui dolore delectus eveniet vel commodi dolore.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?29912', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('69', '76', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Debitis illo illo soluta qui.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?18969', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('70', '24', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Repellat impedit placeat numquam soluta.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?90402', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('71', '47', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Omnis aut rerum occaecati omnis et et esse.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?78697', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('72', '15', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Assumenda qui quam deserunt.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?37441', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('73', '2', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'In laudantium magni ut ducimus iusto.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?47851', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('74', '53', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Voluptas maxime ipsa dolor ea.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?30337', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('75', '4', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Itaque fugiat eveniet officiis iusto a.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?99828', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('76', '74', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Debitis earum officia eius ducimus.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?63955', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('77', '27', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Aut mollitia iste omnis officia saepe.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?83135', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('78', '44', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Aut eveniet aut voluptatem et in rerum qui est.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?33521', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('79', '28', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ipsam et eius sunt qui voluptatem consequuntur.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?11489', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('80', '61', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sit nulla fugit porro sit totam minima.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?69603', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('81', '61', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Doloremque natus nobis quas et iusto officia.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?14916', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('82', '58', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Enim quos voluptas minima dolore.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?93683', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('83', '63', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Quia id earum quia.', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?53460', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('84', '90', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sunt ea quis et mollitia illum.', '2', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?12408', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('85', '33', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sed est dolores a doloremque est est.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?22888', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('86', '44', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Commodi aut nihil aspernatur eum.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?76694', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('87', '68', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Magni sit at dolores fugit aut.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?95644', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('88', '93', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Pariatur dolorem earum illo sint nisi rem.', '2', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?50847', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('89', '61', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Quasi illum odit qui quis.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?72751', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('90', '96', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Non a aut iure pariatur.', '3', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?29287', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('91', '19', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Minima culpa et et animi labore expedita.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?79416', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('92', '49', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Nam aut porro sapiente ducimus dolores labore.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?82949', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('93', '31', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Doloribus ad provident maxime error.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?10582', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('94', '83', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Laborum sint nulla non distinctio rem est unde.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?85766', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('95', '60', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Id inventore nobis qui nisi dolores consequatur.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?93008', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('96', '50', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Delectus reiciendis non ut.', '3', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '0', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?83361', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('97', '21', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Aut ea nostrum sunt non.', '1', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?27591', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('98', '44', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sit illo soluta maxime quia.', '3', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?58834', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('99', '67', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Sapiente harum aliquid velit ratione numquam.', '2', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?15979', '2017-07-22 12:31:51', '2017-07-22 12:31:51');
INSERT INTO `coma_languages` VALUES ('100', '80', 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3', 'Ea esse molestiae sint quam esse voluptatum.', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '1', 'Temp(file_id coma languages setting)', 'http://lorempixel.com/300/400/?34215', '2017-07-22 12:31:51', '2017-07-22 12:31:51');

-- ----------------------------
-- Table structure for grades
-- ----------------------------
DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `grade_no` smallint(5) unsigned NOT NULL,
  `content_type` tinyint(1) NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grades
-- ----------------------------
INSERT INTO `grades` VALUES ('1', '20', '1', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('2', '4', '2', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('3', '16', '3', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('4', '1', '4', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('5', '1', '5', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('6', '6', '6', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('7', '7', '7', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('8', '17', '8', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('9', '2', '9', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('10', '9', '10', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('11', '19', '11', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('12', '16', '12', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('13', '17', '13', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('14', '1', '14', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('15', '17', '15', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('16', '13', '16', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('17', '12', '17', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('18', '11', '18', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('19', '1', '19', '1', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `grades` VALUES ('20', '20', '20', '0', 'Temp(folder_id grade)', 'Temp(file_id grade setting)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');

-- ----------------------------
-- Table structure for grade_names
-- ----------------------------
DROP TABLE IF EXISTS `grade_names`;
CREATE TABLE `grade_names` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grade_names
-- ----------------------------
INSERT INTO `grade_names` VALUES ('1', '1', '2', 'Grade 1', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('2', '2', '1', 'Grade 2', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('3', '3', '1', 'Grade 3', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('4', '8', '2', 'Grade 4', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('5', '17', '2', 'Grade 5', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('6', '7', '1', 'Grade 6', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('7', '20', '3', 'Grade 7', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('8', '8', '1', 'Grade 8', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('9', '16', '2', 'Grade 9', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('10', '2', '1', 'Grade 10', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('11', '9', '2', 'Grade 11', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('12', '16', '3', 'Grade 12', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('13', '10', '2', 'Grade 13', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('14', '11', '1', 'Grade 14', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('15', '12', '2', 'Grade 15', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('16', '14', '3', 'Grade 16', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('17', '1', '1', 'Grade 17', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('18', '17', '3', 'Grade 18', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('19', '2', '2', 'Grade 19', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('20', '10', '2', 'Grade 20', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('21', '14', '1', 'Grade 21', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('22', '11', '2', 'Grade 22', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('23', '16', '2', 'Grade 23', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('24', '7', '1', 'Grade 24', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('25', '10', '2', 'Grade 25', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('26', '19', '3', 'Grade 26', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('27', '8', '2', 'Grade 27', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('28', '14', '3', 'Grade 28', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('29', '4', '1', 'Grade 29', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('30', '13', '2', 'Grade 30', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('31', '6', '3', 'Grade 31', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('32', '3', '2', 'Grade 32', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('33', '5', '2', 'Grade 33', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('34', '14', '2', 'Grade 34', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('35', '16', '3', 'Grade 35', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('36', '18', '2', 'Grade 36', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('37', '18', '3', 'Grade 37', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('38', '12', '1', 'Grade 38', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('39', '13', '1', 'Grade 39', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('40', '14', '2', 'Grade 40', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('41', '3', '1', 'Grade 41', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('42', '6', '3', 'Grade 42', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('43', '20', '2', 'Grade 43', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('44', '13', '3', 'Grade 44', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('45', '6', '3', 'Grade 45', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('46', '4', '1', 'Grade 46', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('47', '5', '3', 'Grade 47', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('48', '11', '1', 'Grade 48', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('49', '10', '2', 'Grade 49', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('50', '10', '3', 'Grade 50', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('51', '15', '1', 'Grade 51', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('52', '7', '3', 'Grade 52', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('53', '18', '1', 'Grade 53', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('54', '1', '3', 'Grade 54', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('55', '12', '3', 'Grade 55', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('56', '18', '2', 'Grade 56', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('57', '3', '1', 'Grade 57', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('58', '2', '1', 'Grade 58', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('59', '11', '3', 'Grade 59', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('60', '3', '3', 'Grade 60', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('61', '18', '1', 'Grade 61', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('62', '14', '3', 'Grade 62', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('63', '18', '3', 'Grade 63', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('64', '19', '1', 'Grade 64', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('65', '13', '2', 'Grade 65', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('66', '18', '1', 'Grade 66', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('67', '10', '2', 'Grade 67', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('68', '5', '1', 'Grade 68', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('69', '3', '3', 'Grade 69', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('70', '5', '3', 'Grade 70', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('71', '9', '3', 'Grade 71', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('72', '8', '2', 'Grade 72', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('73', '2', '2', 'Grade 73', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('74', '17', '2', 'Grade 74', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('75', '10', '2', 'Grade 75', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('76', '4', '1', 'Grade 76', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('77', '18', '1', 'Grade 77', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('78', '19', '2', 'Grade 78', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('79', '14', '1', 'Grade 79', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('80', '10', '1', 'Grade 80', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('81', '5', '3', 'Grade 81', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('82', '10', '1', 'Grade 82', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('83', '6', '1', 'Grade 83', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('84', '3', '3', 'Grade 84', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('85', '19', '2', 'Grade 85', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('86', '6', '3', 'Grade 86', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('87', '14', '1', 'Grade 87', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('88', '2', '3', 'Grade 88', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('89', '9', '3', 'Grade 89', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('90', '15', '1', 'Grade 90', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('91', '12', '1', 'Grade 91', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('92', '4', '3', 'Grade 92', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('93', '1', '3', 'Grade 93', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('94', '9', '2', 'Grade 94', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('95', '1', '2', 'Grade 95', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('96', '9', '3', 'Grade 96', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('97', '3', '2', 'Grade 97', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('98', '4', '1', 'Grade 98', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('99', '13', '1', 'Grade 99', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `grade_names` VALUES ('100', '8', '3', 'Grade 100', 'Temp(file_id grade name)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');

-- ----------------------------
-- Table structure for guides
-- ----------------------------
DROP TABLE IF EXISTS `guides`;
CREATE TABLE `guides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` tinyint(3) unsigned NOT NULL,
  `html_code` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of guides
-- ----------------------------
INSERT INTO `guides` VALUES ('1', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('2', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('3', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('4', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('5', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('6', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('7', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('8', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('9', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('10', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('11', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('12', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('13', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('14', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('15', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('16', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('17', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('18', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('19', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('20', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('21', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('22', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('23', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('24', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('25', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('26', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('27', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('28', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('29', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('30', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('31', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('32', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('33', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('34', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('35', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('36', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('37', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('38', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('39', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('40', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('41', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('42', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('43', '3', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('44', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('45', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('46', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('47', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('48', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('49', '1', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `guides` VALUES ('50', '2', '<h3 style=\'color: red\'>Html code here</h3>', '2017-07-22 12:31:42', '2017-07-22 12:31:42');

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lang_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', '日本語', 'ja', '2017-07-22 12:31:12', null);
INSERT INTO `languages` VALUES ('2', '英語', 'en', '2017-07-22 12:31:12', null);
INSERT INTO `languages` VALUES ('3', 'ベトナム語', 'vi', '2017-07-22 12:31:12', null);

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(26) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES ('1', 'Level 1', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('2', 'Level 2', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('3', 'Level 3', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('4', 'Level 4', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('5', 'Level 5', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('6', 'Level 6', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('7', 'Level 7', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('8', 'Level 8', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('9', 'Level 9', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('10', 'Level 10', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('11', 'Level 11', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('12', 'Level 12', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('13', 'Level 13', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('14', 'Level 14', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('15', 'Level 15', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('16', 'Level 16', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('17', 'Level 17', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `levels` VALUES ('18', 'Level 18', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('19', 'Level 19', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('20', 'Level 20', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('21', 'Level 21', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('22', 'Level 22', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('23', 'Level 23', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('24', 'Level 24', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('25', 'Level 25', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('26', 'Level 26', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('27', 'Level 27', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('28', 'Level 28', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('29', 'Level 29', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('30', 'Level 30', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('31', 'Level 31', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('32', 'Level 32', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('33', 'Level 33', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('34', 'Level 34', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('35', 'Level 35', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('36', 'Level 36', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('37', 'Level 37', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('38', 'Level 38', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('39', 'Level 39', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('40', 'Level 40', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('41', 'Level 41', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('42', 'Level 42', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('43', 'Level 43', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('44', 'Level 44', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('45', 'Level 45', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('46', 'Level 46', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('47', 'Level 47', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('48', 'Level 48', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('49', 'Level 49', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('50', 'Level 50', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('51', 'Level 51', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('52', 'Level 52', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('53', 'Level 53', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('54', 'Level 54', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('55', 'Level 55', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('56', 'Level 56', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('57', 'Level 57', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('58', 'Level 58', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('59', 'Level 59', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('60', 'Level 60', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('61', 'Level 61', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('62', 'Level 62', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('63', 'Level 63', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('64', 'Level 64', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('65', 'Level 65', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('66', 'Level 66', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('67', 'Level 67', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('68', 'Level 68', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('69', 'Level 69', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('70', 'Level 70', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('71', 'Level 71', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('72', 'Level 72', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('73', 'Level 73', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('74', 'Level 74', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('75', 'Level 75', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('76', 'Level 76', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('77', 'Level 77', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('78', 'Level 78', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('79', 'Level 79', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('80', 'Level 80', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('81', 'Level 81', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('82', 'Level 82', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('83', 'Level 83', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('84', 'Level 84', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('85', 'Level 85', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('86', 'Level 86', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('87', 'Level 87', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('88', 'Level 88', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('89', 'Level 89', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('90', 'Level 90', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('91', 'Level 91', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('92', 'Level 92', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('93', 'Level 93', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('94', 'Level 94', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('95', 'Level 95', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('96', 'Level 96', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('97', 'Level 97', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('98', 'Level 98', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('99', 'Level 99', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `levels` VALUES ('100', 'Level 100', '2017-07-22 12:31:25', '2017-07-22 12:31:25');

-- ----------------------------
-- Table structure for logs_active_time
-- ----------------------------
DROP TABLE IF EXISTS `logs_active_time`;
CREATE TABLE `logs_active_time` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs_active_time
-- ----------------------------
INSERT INTO `logs_active_time` VALUES ('1', '12', '2007-11-22 00:00:00', '1984-03-16 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('2', '55', '2004-10-12 00:00:00', '1986-07-04 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('3', '42', '2002-03-16 00:00:00', '1995-02-28 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('4', '87', '1999-07-16 00:00:00', '1974-02-06 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('5', '12', '1982-07-03 00:00:00', '1980-06-03 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('6', '99', '2010-08-13 00:00:00', '1993-11-08 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('7', '65', '2016-09-19 00:00:00', '1988-06-18 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('8', '76', '1977-05-21 00:00:00', '2016-02-08 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('9', '24', '1980-06-25 00:00:00', '1990-12-21 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('10', '21', '1992-10-09 00:00:00', '1986-01-19 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('11', '50', '2013-11-01 00:00:00', '1982-12-09 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('12', '74', '2013-09-21 00:00:00', '1972-08-30 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('13', '87', '2017-01-28 00:00:00', '1976-03-30 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('14', '86', '1984-12-10 00:00:00', '1974-03-12 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('15', '79', '1982-02-04 00:00:00', '1972-12-20 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('16', '60', '2005-12-07 00:00:00', '1993-12-02 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('17', '88', '2012-03-25 00:00:00', '1991-10-02 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('18', '43', '1970-12-25 00:00:00', '1981-04-14 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('19', '84', '1993-03-22 00:00:00', '1976-12-11 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('20', '16', '2002-06-08 00:00:00', '2015-05-17 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('21', '40', '1988-04-14 00:00:00', '1970-03-12 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('22', '58', '1973-06-20 00:00:00', '1987-07-18 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('23', '42', '1998-12-31 00:00:00', '1970-04-30 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('24', '71', '1978-04-08 00:00:00', '2008-08-09 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('25', '97', '1976-02-28 00:00:00', '1988-01-29 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('26', '48', '1984-12-05 00:00:00', '1990-01-22 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('27', '86', '2006-01-10 00:00:00', '1981-10-29 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('28', '74', '2002-05-21 00:00:00', '1977-09-27 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('29', '6', '1975-07-22 00:00:00', '1971-02-25 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('30', '42', '2005-12-31 00:00:00', '2009-06-23 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('31', '12', '1991-01-02 00:00:00', '1996-09-12 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('32', '28', '1984-02-23 00:00:00', '1997-09-28 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('33', '94', '2003-11-22 00:00:00', '1978-10-31 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('34', '24', '1987-08-19 00:00:00', '2007-08-27 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('35', '25', '2007-12-15 00:00:00', '2012-11-02 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('36', '41', '1978-08-16 00:00:00', '1982-02-03 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('37', '95', '2016-10-03 00:00:00', '1989-04-11 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('38', '90', '2004-02-04 00:00:00', '2004-05-31 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('39', '92', '1988-12-27 00:00:00', '2015-10-24 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('40', '95', '1987-01-19 00:00:00', '2015-03-26 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('41', '29', '1976-12-25 00:00:00', '1999-10-19 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('42', '62', '2002-01-16 00:00:00', '1975-12-12 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('43', '73', '2014-01-31 00:00:00', '1987-09-16 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('44', '55', '1975-08-28 00:00:00', '1993-02-04 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('45', '68', '1993-02-15 00:00:00', '2010-03-14 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('46', '1', '1972-02-25 00:00:00', '2008-03-23 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('47', '28', '2014-05-03 00:00:00', '1998-10-29 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('48', '55', '1997-03-13 00:00:00', '2001-02-22 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('49', '83', '2016-01-02 00:00:00', '2012-01-25 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('50', '9', '2015-08-22 00:00:00', '1970-10-25 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('51', '81', '1994-10-05 00:00:00', '1978-10-03 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('52', '4', '1995-01-05 00:00:00', '2006-06-19 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('53', '78', '1973-07-31 00:00:00', '1977-03-26 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('54', '30', '1980-05-07 00:00:00', '1981-10-23 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('55', '80', '1988-12-22 00:00:00', '1976-12-01 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('56', '53', '2009-08-17 00:00:00', '1979-09-26 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('57', '6', '1999-01-23 00:00:00', '1996-10-22 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('58', '57', '1999-11-04 00:00:00', '1988-09-10 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('59', '49', '1981-01-28 00:00:00', '1973-01-09 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('60', '71', '1982-04-13 00:00:00', '1970-12-26 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('61', '90', '1979-05-01 00:00:00', '2012-09-15 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('62', '33', '1981-08-13 00:00:00', '1983-01-31 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('63', '10', '1987-08-30 00:00:00', '1994-10-27 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('64', '55', '1985-06-19 00:00:00', '1984-11-04 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('65', '92', '1994-04-03 00:00:00', '2000-11-11 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('66', '24', '1989-04-24 00:00:00', '2014-05-04 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('67', '86', '2016-07-09 00:00:00', '1977-03-24 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('68', '26', '2012-04-29 00:00:00', '2005-12-26 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('69', '29', '2000-11-26 00:00:00', '2013-08-27 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('70', '86', '1988-03-30 00:00:00', '1990-02-04 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('71', '2', '1975-04-19 00:00:00', '1979-06-21 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('72', '29', '2010-08-13 00:00:00', '2001-08-23 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('73', '67', '1973-12-07 00:00:00', '1987-11-07 00:00:00', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_active_time` VALUES ('74', '89', '1988-10-30 00:00:00', '1997-08-10 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('75', '17', '1981-11-29 00:00:00', '2015-08-22 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('76', '25', '2004-08-30 00:00:00', '1970-06-16 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('77', '61', '1998-01-12 00:00:00', '2008-01-12 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('78', '40', '1979-08-11 00:00:00', '2011-05-17 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('79', '17', '2003-06-25 00:00:00', '2003-09-24 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('80', '23', '1970-04-25 00:00:00', '1999-10-24 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('81', '1', '1970-07-15 00:00:00', '2014-09-12 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('82', '35', '1976-06-12 00:00:00', '1992-01-06 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('83', '36', '2001-04-25 00:00:00', '2013-03-11 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('84', '6', '2000-03-02 00:00:00', '2009-03-05 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('85', '69', '1999-08-24 00:00:00', '2010-11-14 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('86', '89', '2004-08-13 00:00:00', '1993-10-17 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('87', '53', '1975-12-17 00:00:00', '2008-11-27 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('88', '53', '1980-02-29 00:00:00', '1994-07-30 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('89', '54', '1982-02-24 00:00:00', '2015-02-18 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('90', '51', '1994-04-26 00:00:00', '2006-04-17 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('91', '97', '1993-09-28 00:00:00', '2016-02-11 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('92', '97', '1975-01-21 00:00:00', '2008-06-08 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('93', '4', '1973-02-28 00:00:00', '2002-11-20 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('94', '74', '2006-06-22 00:00:00', '1986-09-01 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('95', '89', '1995-08-08 00:00:00', '2013-12-01 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('96', '21', '1971-11-20 00:00:00', '2007-03-02 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('97', '41', '1971-05-14 00:00:00', '2015-08-28 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('98', '91', '2003-08-05 00:00:00', '1991-06-16 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('99', '54', '2014-12-06 00:00:00', '2015-02-08 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');
INSERT INTO `logs_active_time` VALUES ('100', '60', '1978-12-28 00:00:00', '2013-11-01 00:00:00', '2017-07-22 12:31:39', '2017-07-22 12:31:39');

-- ----------------------------
-- Table structure for logs_big_test
-- ----------------------------
DROP TABLE IF EXISTS `logs_big_test`;
CREATE TABLE `logs_big_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `point` tinyint(3) unsigned NOT NULL,
  `result` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs_big_test
-- ----------------------------
INSERT INTO `logs_big_test` VALUES ('1', 'OGNLBZ53F58N398C', '95', '2', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('2', 'EBCQVA08A02T877T', '15', '77', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('3', 'FFIXYX05W70W319Y', '32', '59', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('4', 'UGVNNI89N43U637T', '73', '27', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('5', 'JMWIKC65I08T506S', '99', '46', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('6', 'LBYIYX95D71U804I', '61', '9', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('7', 'XOKCKS68D76W192Q', '100', '40', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('8', 'DXOJTI48R86L840S', '9', '50', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('9', 'OMULCF31V72X458G', '80', '18', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('10', 'QSPOHI07O94R629J', '50', '32', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('11', 'KIUTDA39C75U536G', '98', '6', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('12', 'PEYXYZ34T28J383S', '72', '54', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('13', 'YSYTFS62T73X997X', '33', '61', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('14', 'PKDCRE77G39G194B', '88', '43', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('15', 'MZNGVM00P32O613Y', '93', '10', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('16', 'TIPVCG78G70S762C', '78', '10', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('17', 'FNZFKG21L90E992M', '39', '97', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('18', 'SHLWIM63W10Z550K', '3', '51', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('19', 'QXNBWM85T76G757S', '52', '92', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('20', 'TZMCXY14E66W191L', '57', '93', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('21', 'ZVJFWT69E07D600Q', '94', '69', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('22', 'XZHNNU58Q41Z548K', '72', '11', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('23', 'LIMWJZ96U57A946R', '13', '23', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('24', 'GNHTPE93C01Y535O', '10', '38', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('25', 'QKYBSD59Y74F021A', '7', '77', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('26', 'BFPYKS49Q01G826D', '89', '58', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('27', 'DMACZW31S30R411X', '26', '88', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('28', 'VEOSXN80Q10P837L', '8', '77', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('29', 'UXAGEW26I80Z252O', '93', '49', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('30', 'ZXBZJX15Z24Q953V', '45', '13', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('31', 'DDEIQM52X70A996E', '82', '33', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('32', 'HNVTTS08P52K260P', '9', '35', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('33', 'AZMJZM47F72Q533H', '44', '100', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('34', 'AFWLKC84C44M300H', '67', '99', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('35', 'MJQXDZ04L32G562I', '59', '87', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('36', 'TZSLDB67Z68A590I', '18', '35', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('37', 'IPXHPZ04T78V874X', '71', '39', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('38', 'PDOSWA19K93A651D', '4', '61', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('39', 'UZDSPK03F09W759H', '37', '53', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('40', 'JKTCWI25Z94N404G', '25', '63', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('41', 'ZPBOKL41I95D726X', '57', '91', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('42', 'IVFNPV20N87Q298Q', '52', '76', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('43', 'ELEQRO59B94H014J', '42', '83', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('44', 'ETSCEP10X37K068I', '39', '62', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('45', 'VBZXNI17K42C443U', '19', '54', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('46', 'RCHNCF81G24Y753I', '36', '37', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('47', 'MCTZPA20M24U323H', '40', '84', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('48', 'HYOREV66A82I923A', '77', '33', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('49', 'LFYJXF22C55J033D', '50', '29', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('50', 'FNMXUF80Y40K643T', '75', '93', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('51', 'MDLQTH99N70L710O', '21', '2', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('52', 'JXZKBA21B07Q836T', '52', '36', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('53', 'UJNQCR86E69M633Z', '86', '58', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('54', 'OZWYBY36W93X728K', '34', '94', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('55', 'PEAFJX72T53E234Y', '12', '10', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('56', 'IUJEQS72Z21G155Z', '53', '54', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('57', 'OOBLST78N61C249V', '48', '75', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('58', 'QVKPZM64K69Z535F', '65', '23', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('59', 'EDMSHI00D43W558C', '5', '11', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('60', 'UJGXCG01E45X665E', '60', '36', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('61', 'VCYZKO38V59B791J', '11', '71', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('62', 'NPEUPV55W22W780G', '67', '62', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('63', 'CNVOLF51Z73U842K', '96', '64', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('64', 'QPDOYB92S84Q609X', '49', '77', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('65', 'NYQVKK25X89U059Z', '4', '22', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('66', 'BCXKJO74E78J009O', '76', '74', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('67', 'LHSIYX42P71N942X', '17', '59', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('68', 'SHJECH73T89M153E', '100', '5', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('69', 'JDWVKB29I70L002G', '66', '90', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('70', 'IAZEMB61C28I216D', '97', '11', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('71', 'XOCYCO97H68U301N', '57', '32', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('72', 'WOMESX37T91M513K', '68', '72', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('73', 'MIPVYP88F00X194Z', '39', '90', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('74', 'IXPJMY96U53H182I', '66', '97', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('75', 'VHWBAH57T09P424L', '63', '16', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('76', 'KOLISB33Q61A440U', '10', '88', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('77', 'OCLHIB69U53G495G', '67', '59', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('78', 'XHHGFL20D81B104R', '63', '84', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('79', 'BGXGXW26X86P345Y', '50', '95', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('80', 'XOSXID95W43J132A', '3', '77', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('81', 'BBPPNJ67O24U068Q', '59', '21', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('82', 'FELOLV31T62T039A', '37', '86', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('83', 'BDSNLD29L47C647H', '71', '25', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('84', 'YTVTCC09H13V917L', '4', '18', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('85', 'PWRDKP07K41N039M', '14', '38', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('86', 'DIPIWG63N17W552S', '23', '13', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('87', 'DYCZNU77R12I718F', '15', '32', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('88', 'CTIYBR62E09B488F', '3', '0', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('89', 'AXDULG54Q64C006W', '76', '54', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('90', 'YZBMQY71D14N891O', '6', '64', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('91', 'OSGRFZ41R99L540T', '48', '97', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('92', 'NILHMH98T29P027V', '7', '6', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('93', 'GZJPRA15E31C319X', '80', '69', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('94', 'TEJGZD40W45V308Q', '70', '1', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('95', 'HNPJCC51O36H017O', '29', '64', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('96', 'WEDBIV62D91W506K', '32', '46', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('97', 'EFZSTD91Q58D729S', '90', '51', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('98', 'AGLJQF83V65M933V', '20', '83', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('99', 'VSIDVC82Q08X964J', '1', '64', '0', '2017-07-22 12:31:47', '2017-07-22 12:31:47');
INSERT INTO `logs_big_test` VALUES ('100', 'KPSSBU99F62M760D', '99', '92', '1', '2017-07-22 12:31:47', '2017-07-22 12:31:47');

-- ----------------------------
-- Table structure for logs_coma
-- ----------------------------
DROP TABLE IF EXISTS `logs_coma`;
CREATE TABLE `logs_coma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `end_date` datetime NOT NULL,
  `completion_flg` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs_coma
-- ----------------------------
INSERT INTO `logs_coma` VALUES ('1', 'SLVURA33M32I030M', '65', '1992-02-13 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('2', 'EJPPMV83T48T643T', '83', '2003-09-03 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('3', 'HWDGXM05S56L474R', '95', '2017-03-12 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('4', 'DTVCSF88U29N606Q', '60', '1994-07-04 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('5', 'NOBQEU78G73Y405E', '32', '1978-07-19 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('6', 'HXPOVP08H61P047G', '3', '1977-04-24 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('7', 'LLIXZD14Y86P388A', '78', '2001-12-02 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('8', 'YSRKOG40P00G637Z', '77', '2011-01-08 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('9', 'LAODOS79T34P606L', '75', '2008-05-21 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('10', 'TEMCLM39B25C155N', '4', '2004-12-23 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('11', 'GIYRAQ85D53E881A', '20', '2006-04-12 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('12', 'NTQQSP81T28E453Y', '100', '2016-08-29 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('13', 'MIXJQF08R65D463M', '3', '2014-12-31 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('14', 'NHPNGY29D42L329D', '72', '1991-01-10 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('15', 'ZSWFKZ93L63F209U', '96', '1987-01-25 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('16', 'RSFMPX51J85T303R', '65', '1980-01-15 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('17', 'YNNOYR96J29N275Q', '69', '2006-12-31 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('18', 'ZDBHCX21A25V274J', '11', '2009-04-14 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('19', 'CIPYBT56Q68O886D', '68', '1997-12-18 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('20', 'PMLBSL88C43P620W', '15', '2000-01-03 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('21', 'GQBICM71E86H339F', '66', '2004-02-22 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('22', 'OMTXLR13U71P385V', '94', '2013-11-24 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('23', 'DTTPVZ46V47U378E', '87', '1986-07-10 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('24', 'YWOCMO39O89M171B', '52', '1998-02-03 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('25', 'QVJRDM01V55I419I', '10', '1988-03-22 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('26', 'EABSNW40C42S366B', '92', '1980-09-04 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('27', 'QIFSCR63Y11J908X', '86', '2017-04-30 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('28', 'UWRDWT25X82E991K', '12', '2012-06-14 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('29', 'PIFPHJ01M17D850A', '34', '1989-09-25 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('30', 'DFAAED36P05H265M', '20', '2005-08-22 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('31', 'WDEUWT68R12B382W', '4', '1991-05-12 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('32', 'EWEIRO49V48T097V', '31', '2005-08-18 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('33', 'MGFOFE37X32L471Y', '57', '1984-06-21 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('34', 'NZZWDD04Y02U077N', '90', '1976-08-10 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('35', 'VUTBBJ93G35W137U', '42', '1976-11-03 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('36', 'DVBBAH96X88F279F', '71', '2015-03-30 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('37', 'MVYYXV48V13W887C', '77', '1973-03-30 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('38', 'YZALAF38V25M280V', '83', '2004-07-14 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('39', 'EMBQRA73D95S459S', '38', '2002-12-26 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('40', 'VBKWZE73D02Y836N', '66', '1997-08-12 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('41', 'YUGCWK34N82O874K', '65', '2012-02-02 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('42', 'KXVOXD22C80T224V', '79', '1999-10-27 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('43', 'IGOQWC06R24I523N', '41', '1975-08-26 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('44', 'KHAJWR06N28D345L', '89', '1986-06-24 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('45', 'NTCHQG17K47T841R', '68', '1978-08-04 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('46', 'ZZOTHB06D15B977D', '49', '2006-11-22 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('47', 'SBVYXY12F01Y886R', '93', '2001-01-15 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('48', 'TWJBHR47Z59Z466L', '44', '2008-09-05 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('49', 'LXQRZX86Y15P354X', '75', '2008-06-11 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('50', 'RWTGLW86P44Y919J', '52', '1993-04-08 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('51', 'VCDSHY14V55W388Z', '97', '2008-06-04 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('52', 'EEMOHE29O91Z933J', '86', '1989-07-27 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('53', 'QIKLIZ18E49E163S', '7', '1991-08-15 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('54', 'NKUYXQ72T16R853A', '10', '2014-04-14 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('55', 'BHKBWG10M02N000F', '87', '1989-02-16 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('56', 'QWHCLA32K19H975J', '67', '1988-04-10 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('57', 'ZBKEUL56Y26I547E', '21', '1975-05-02 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('58', 'KOERIN98M97S678A', '3', '2005-01-10 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('59', 'FGWOEI33B75Z449G', '60', '1998-07-11 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('60', 'RYPGMJ93T65Y469D', '95', '1996-08-04 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('61', 'UHHAIZ25R07W424S', '55', '1974-11-10 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('62', 'NWPRXD53Q00Q182T', '64', '1999-03-25 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('63', 'LRQSYH93F01K002U', '17', '1983-03-17 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('64', 'MYCLMH26L48L074S', '85', '1984-07-24 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('65', 'IPOOVZ48L37Z550T', '9', '1978-01-27 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('66', 'PKJKZS14T93Y777X', '25', '1981-07-31 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('67', 'MCWQVC86R67J060Y', '47', '2003-07-05 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('68', 'EARKWW59O96Y889R', '58', '2003-10-18 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('69', 'HXXRQK21J69R322K', '68', '1974-01-13 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('70', 'ZGLERZ85N31Y261A', '25', '2015-07-04 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('71', 'YKBTVH38K49D289L', '29', '1995-09-13 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('72', 'CHUVOX54S88J970M', '88', '1995-07-03 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('73', 'NIARWL88T32W745B', '58', '2013-09-09 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('74', 'ICBYBX38R66X541K', '97', '1983-03-31 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('75', 'MSNXXD43X90V959H', '26', '2016-06-27 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('76', 'YZERQR77L90K458P', '18', '2001-12-31 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('77', 'XRJDHG17K63Y145K', '13', '1996-03-16 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('78', 'PYKOJM96B56M959F', '41', '1980-12-22 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('79', 'RDRVAX97R85V669I', '50', '1972-03-13 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('80', 'ERFQVY55P06J578H', '61', '1975-08-23 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('81', 'YTGVLM27H86X710B', '66', '1993-01-31 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('82', 'ACLBJN36A01G591J', '88', '1987-01-16 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('83', 'PBGLSL66Z68I760V', '92', '2012-12-22 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('84', 'IQNGOX77R47F432C', '89', '1978-12-31 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('85', 'YTBTSX24I74V914Y', '6', '2016-06-12 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('86', 'DFBWMK99T13P562F', '27', '2000-05-01 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('87', 'YYXPQG08Q67U003Z', '68', '1995-10-21 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('88', 'RRNJOH37B35P945K', '75', '1978-08-24 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('89', 'MHARCG05R71Y045C', '88', '1984-04-08 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('90', 'TEDLVA68M18I792T', '45', '1988-05-23 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('91', 'FPSTXH60R50J669O', '36', '1980-02-13 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('92', 'TEYBLY88O82B089W', '99', '1974-09-06 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('93', 'PZJXDO75D90E563K', '88', '1979-12-02 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('94', 'RQIQKU58S28C616M', '95', '2015-10-27 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('95', 'EAEWBB84N62P151V', '11', '1977-01-01 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('96', 'TPHIDT88V81Y108C', '90', '1993-10-22 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('97', 'MJGFQQ20U88V856Y', '35', '1977-02-11 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('98', 'YNLLJK54A16X388U', '19', '1978-01-12 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('99', 'OLLIWC76J20G916C', '99', '1977-06-26 00:00:00', '0', '2017-07-22 12:31:41', '2017-07-22 12:31:41');
INSERT INTO `logs_coma` VALUES ('100', 'CWRSCN30Q77C687K', '43', '1997-10-01 00:00:00', '1', '2017-07-22 12:31:41', '2017-07-22 12:31:41');

-- ----------------------------
-- Table structure for logs_login
-- ----------------------------
DROP TABLE IF EXISTS `logs_login`;
CREATE TABLE `logs_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `model` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs_login
-- ----------------------------
INSERT INTO `logs_login` VALUES ('1', '97', '1970-10-12 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('2', '35', '1998-04-04 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('3', '14', '1987-02-24 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('4', '36', '2006-07-19 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('5', '47', '1975-05-03 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('6', '11', '1989-07-13 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('7', '1', '2011-12-21 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('8', '57', '1970-04-17 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('9', '52', '1983-12-20 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('10', '54', '1979-09-19 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('11', '68', '1971-02-09 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('12', '41', '2007-02-20 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('13', '66', '2015-06-20 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('14', '29', '1987-03-28 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('15', '15', '1975-11-13 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('16', '55', '2001-10-16 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('17', '70', '1972-05-12 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('18', '99', '1982-05-08 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('19', '56', '2001-06-04 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('20', '37', '1976-01-25 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('21', '41', '2015-02-25 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('22', '72', '1991-03-19 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('23', '38', '1993-05-04 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('24', '7', '1984-10-13 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('25', '99', '1983-01-02 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('26', '80', '2009-03-26 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('27', '25', '1975-12-30 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('28', '70', '2003-10-17 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('29', '24', '1990-05-29 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('30', '22', '2004-07-14 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('31', '76', '2012-10-19 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('32', '93', '1984-09-09 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('33', '92', '2002-12-26 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('34', '65', '1975-01-27 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('35', '12', '1988-02-12 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('36', '10', '1991-11-01 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('37', '39', '1979-08-28 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('38', '27', '2004-03-10 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('39', '51', '1984-10-11 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('40', '75', '1970-11-30 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('41', '94', '1976-02-16 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('42', '34', '1970-10-05 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('43', '23', '2014-07-21 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('44', '96', '2009-10-25 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('45', '21', '1996-06-18 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('46', '15', '1998-07-08 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('47', '30', '2008-01-01 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('48', '33', '1997-10-29 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('49', '80', '1988-03-01 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('50', '63', '1986-12-04 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('51', '51', '1994-10-06 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('52', '67', '2008-04-04 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('53', '38', '2002-12-19 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('54', '3', '1978-12-17 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('55', '66', '2008-09-04 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('56', '69', '1976-12-13 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('57', '15', '1984-06-18 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('58', '93', '2004-02-06 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('59', '83', '2004-09-25 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('60', '36', '1982-08-08 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('61', '79', '1984-12-24 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('62', '10', '1996-12-04 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('63', '93', '2000-06-08 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('64', '98', '2002-03-12 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('65', '31', '1975-09-13 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('66', '93', '2009-03-11 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('67', '5', '2016-02-06 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('68', '32', '1990-07-18 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('69', '76', '1974-01-13 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('70', '68', '1995-07-17 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('71', '25', '2004-06-01 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('72', '57', '1977-09-14 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('73', '96', '1973-02-12 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('74', '14', '1973-09-06 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('75', '48', '1995-10-11 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('76', '95', '2009-10-20 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('77', '50', '2005-08-09 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('78', '33', '2013-05-03 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('79', '71', '2016-11-21 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('80', '87', '1970-11-03 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('81', '89', '1971-02-09 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('82', '21', '2011-05-05 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('83', '48', '1991-11-04 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('84', '96', '2001-05-25 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('85', '44', '2013-04-19 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('86', '58', '1973-07-22 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('87', '86', '1980-05-26 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('88', '81', '1992-08-09 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('89', '77', '1977-08-09 00:00:00', '1', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('90', '5', '1972-06-01 00:00:00', '0', '2017-07-22 12:31:37', '2017-07-22 12:31:37');
INSERT INTO `logs_login` VALUES ('91', '32', '1977-06-22 00:00:00', '1', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('92', '63', '1998-12-04 00:00:00', '1', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('93', '79', '1972-04-16 00:00:00', '1', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('94', '72', '2008-10-16 00:00:00', '0', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('95', '44', '2015-06-20 00:00:00', '1', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('96', '33', '1978-03-19 00:00:00', '1', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('97', '69', '1995-11-22 00:00:00', '0', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('98', '8', '1987-09-24 00:00:00', '0', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('99', '48', '1974-02-21 00:00:00', '1', '2017-07-22 12:31:38', '2017-07-22 12:31:38');
INSERT INTO `logs_login` VALUES ('100', '22', '1985-07-22 00:00:00', '0', '2017-07-22 12:31:38', '2017-07-22 12:31:38');

-- ----------------------------
-- Table structure for logs_small_test
-- ----------------------------
DROP TABLE IF EXISTS `logs_small_test`;
CREATE TABLE `logs_small_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `point` tinyint(3) unsigned NOT NULL,
  `result` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs_small_test
-- ----------------------------
INSERT INTO `logs_small_test` VALUES ('1', 'CTXPSU40H58B786C', '45', '54', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('2', 'UQOPYO29I82S323B', '87', '34', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('3', 'VRZRJC56A08J594Y', '29', '98', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('4', 'NDBESG18O77K614W', '100', '6', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('5', 'AUMKLJ70G36N572K', '63', '44', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('6', 'TASDYD62U63F117O', '81', '31', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('7', 'VKSXRL65B74E920C', '12', '83', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('8', 'JTQWRI00E34G861L', '17', '40', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('9', 'VTCUQH18X95H919Q', '24', '100', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('10', 'HOWUSG71P19O733W', '74', '57', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('11', 'YPKSBL40A43X633I', '50', '86', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('12', 'JNNAIP92Q53R687B', '48', '26', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('13', 'AFLGEE59S12M445F', '15', '41', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('14', 'SYXUWZ93I93K461J', '5', '97', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('15', 'NLCALA26J17Y403C', '10', '17', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('16', 'GBRLQR13J30A223K', '62', '90', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('17', 'PNAVYC40A19J259W', '22', '10', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('18', 'HXMAQE60C79J736R', '53', '27', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('19', 'UEQEPU98A93X744H', '30', '4', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('20', 'MCENAG61X22D700A', '31', '96', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('21', 'JRDXWR04M38X016R', '34', '70', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('22', 'FFYKCR36R66W476T', '97', '80', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('23', 'CBPQAQ79E54K045K', '93', '33', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('24', 'IQJLJU56P79U277T', '27', '88', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('25', 'DYJWOF08S45J463M', '40', '49', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('26', 'UXKAHM49K51S695B', '86', '63', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('27', 'ENLEZQ42V75G393O', '43', '90', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('28', 'TTLYBW85P83K663G', '2', '74', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('29', 'KCEHLF23T45C742V', '94', '54', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('30', 'INHEJX75N60O054S', '8', '68', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('31', 'AVXEOV42Z83V058T', '59', '50', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('32', 'ARDKPR53V34S777R', '6', '31', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('33', 'AIWOXO44A74A420D', '94', '18', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('34', 'XVXZLE48Q85S630X', '36', '56', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('35', 'PSNIEF88N08B150Z', '57', '71', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('36', 'FIYPNX44R56A245L', '73', '27', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('37', 'XDCAQD25M01W880M', '63', '55', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('38', 'BYAFEL73N64V426S', '16', '11', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('39', 'YLBIDY45F92N927X', '28', '42', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('40', 'NANMKY88W67R406U', '63', '97', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('41', 'DNNYGP86O15P432R', '94', '31', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('42', 'IJSUVY07W91Z650N', '30', '12', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('43', 'XHJHRV12A31I449E', '97', '2', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('44', 'RKVGHI00J82Q644S', '64', '65', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('45', 'RIKQGC71W45U719N', '63', '62', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('46', 'ITQIKA65R78J749X', '41', '6', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('47', 'FCQBSR87O56F014H', '41', '74', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('48', 'OYOMFI00D23O831I', '48', '43', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('49', 'IWPOWT28F69D555B', '91', '30', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('50', 'OFUBOB97C29H573O', '7', '87', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('51', 'CNCMCD92X63O608Z', '76', '7', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('52', 'HUZGBT16J21F895W', '27', '46', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('53', 'NGRNJT57J50Y960R', '2', '31', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('54', 'IJIFUD36T13O523M', '63', '98', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('55', 'DAKNSU08V25I065R', '78', '59', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('56', 'YNRSGA27R37R087G', '92', '41', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('57', 'JUHCMA31D30J937E', '65', '35', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('58', 'MYSRCO61O95B572V', '2', '10', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('59', 'NWXFDJ49A67H106J', '88', '49', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('60', 'BXVIKK03V86N398U', '73', '30', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('61', 'NRVDGM58Z63T896B', '28', '97', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('62', 'LGZNEK69H68L470R', '17', '38', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('63', 'PZCEPO56F95I552O', '58', '36', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('64', 'GCBNDE84B29D350B', '21', '79', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('65', 'AIGZCF91Q20F562B', '92', '45', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('66', 'WNXYHL08M58I142K', '12', '71', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('67', 'YEHHOU57Q85P287Y', '70', '5', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('68', 'RXZXSI92D98L727C', '53', '59', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('69', 'NBNXPK43Q78J925D', '73', '74', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('70', 'UAWBJJ72I96W526B', '59', '24', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('71', 'UGSEVP12J46Y645A', '17', '63', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('72', 'MZSZBR11W85U658X', '82', '32', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('73', 'JAIOVD72W53O564J', '48', '96', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('74', 'VWRPDR87H48C048E', '96', '99', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('75', 'RBBFFA88A62N661F', '94', '3', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('76', 'QBOTLU07S43G268U', '56', '22', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('77', 'NWVYEX81F06S886E', '38', '61', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('78', 'INVREW60U42Y205G', '49', '51', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('79', 'ADDBMT06R44A591N', '79', '15', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('80', 'SXHTJV28L72B085T', '3', '88', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('81', 'EOSRVI96B36Q943R', '92', '45', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('82', 'XPWMVQ24C91E142L', '69', '17', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('83', 'RNTVSW91S74O996J', '16', '5', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('84', 'CPWAJS00Q40X015G', '86', '99', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('85', 'UZLARI43S14T305S', '46', '41', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('86', 'SZKBZO56B58J565U', '79', '29', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('87', 'MDHIZD50Q28K163W', '21', '28', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('88', 'LECFMV77D32H496K', '42', '47', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('89', 'HGANKM15M86O434N', '61', '85', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('90', 'ZJUNCB06D11T569T', '20', '99', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('91', 'FLLIAF34E05U005V', '14', '57', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('92', 'MMLAMD80E37K571I', '43', '51', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('93', 'BFOYIK03S11I867K', '99', '77', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('94', 'MOXGDV18N46M440W', '38', '44', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('95', 'BNJISR17J80U640J', '87', '41', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('96', 'JMQYNL16J57N486U', '26', '33', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('97', 'RYJXVF28P88X931X', '27', '2', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('98', 'YZIWSB65Q56F813B', '41', '29', '0', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('99', 'RPMRMM87K32Y379G', '92', '23', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');
INSERT INTO `logs_small_test` VALUES ('100', 'GMFURE54P14Y827B', '20', '32', '1', '2017-07-22 12:31:40', '2017-07-22 12:31:40');

-- ----------------------------
-- Table structure for logs_tips
-- ----------------------------
DROP TABLE IF EXISTS `logs_tips`;
CREATE TABLE `logs_tips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tips_id` int(10) unsigned NOT NULL,
  `lesson_log_id` int(10) unsigned NOT NULL,
  `small_test_log_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs_tips
-- ----------------------------
INSERT INTO `logs_tips` VALUES ('1', '50', '11', '84', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('2', '44', '28', '69', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('3', '43', '1', '36', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('4', '4', '7', '81', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('5', '21', '32', '78', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('6', '27', '6', '2', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('7', '17', '67', '50', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('8', '47', '69', '93', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('9', '17', '86', '94', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('10', '50', '20', '76', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('11', '29', '42', '79', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('12', '38', '96', '72', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('13', '11', '26', '55', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('14', '46', '3', '42', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('15', '28', '43', '40', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('16', '21', '99', '88', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('17', '2', '75', '100', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('18', '35', '46', '12', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('19', '21', '52', '43', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('20', '7', '32', '68', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('21', '4', '87', '43', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('22', '41', '18', '95', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('23', '41', '43', '43', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('24', '15', '24', '14', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('25', '42', '82', '11', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('26', '48', '52', '7', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('27', '31', '26', '64', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('28', '50', '40', '82', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('29', '22', '2', '88', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('30', '34', '24', '8', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('31', '15', '64', '49', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('32', '13', '5', '89', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('33', '2', '29', '82', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('34', '24', '77', '5', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('35', '23', '46', '48', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('36', '36', '57', '47', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('37', '31', '49', '26', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('38', '31', '21', '17', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('39', '29', '35', '27', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('40', '43', '97', '6', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('41', '21', '44', '64', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('42', '46', '43', '73', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('43', '11', '19', '29', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('44', '12', '53', '11', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('45', '28', '73', '65', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('46', '45', '1', '87', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('47', '28', '3', '34', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('48', '15', '40', '48', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('49', '41', '75', '13', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('50', '39', '17', '19', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('51', '37', '66', '44', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('52', '2', '46', '20', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('53', '38', '72', '27', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('54', '18', '69', '12', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('55', '1', '26', '49', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('56', '5', '8', '44', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('57', '1', '2', '79', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('58', '37', '90', '2', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('59', '21', '2', '8', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('60', '28', '54', '54', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('61', '36', '53', '67', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('62', '12', '76', '8', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('63', '26', '25', '66', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('64', '28', '82', '93', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('65', '48', '91', '16', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('66', '16', '20', '81', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('67', '48', '70', '66', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('68', '27', '100', '93', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('69', '16', '8', '85', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('70', '19', '52', '68', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('71', '35', '59', '81', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('72', '1', '81', '22', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('73', '16', '32', '7', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('74', '13', '10', '90', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('75', '47', '28', '5', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('76', '47', '92', '31', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('77', '34', '46', '48', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('78', '25', '99', '95', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('79', '39', '65', '79', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('80', '6', '58', '96', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('81', '27', '30', '43', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('82', '6', '42', '51', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('83', '39', '63', '100', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('84', '36', '69', '89', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('85', '46', '19', '16', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('86', '19', '17', '24', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('87', '12', '84', '23', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('88', '15', '71', '12', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('89', '46', '42', '33', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('90', '20', '44', '96', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('91', '8', '53', '53', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('92', '45', '1', '42', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('93', '21', '15', '16', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('94', '44', '40', '4', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('95', '30', '91', '68', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('96', '28', '2', '53', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('97', '48', '18', '50', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('98', '26', '49', '61', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('99', '8', '67', '81', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `logs_tips` VALUES ('100', '20', '8', '14', '2017-07-22 12:31:42', '2017-07-22 12:31:42');

-- ----------------------------
-- Table structure for makers
-- ----------------------------
DROP TABLE IF EXISTS `makers`;
CREATE TABLE `makers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of makers
-- ----------------------------
INSERT INTO `makers` VALUES ('1', 'Maker 1', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('2', 'Maker 2', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('3', 'Maker 3', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('4', 'Maker 4', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('5', 'Maker 5', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('6', 'Maker 6', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('7', 'Maker 7', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('8', 'Maker 8', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('9', 'Maker 9', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `makers` VALUES ('10', 'Maker 10', '2017-07-22 12:31:24', '2017-07-22 12:31:24');

-- ----------------------------
-- Table structure for messages_big_test
-- ----------------------------
DROP TABLE IF EXISTS `messages_big_test`;
CREATE TABLE `messages_big_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `big_test_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `passing_message` text COLLATE utf8_unicode_ci NOT NULL,
  `failed_message` text COLLATE utf8_unicode_ci NOT NULL,
  `correct_message` text COLLATE utf8_unicode_ci NOT NULL,
  `incorrect_message` text COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of messages_big_test
-- ----------------------------
INSERT INTO `messages_big_test` VALUES ('1', '7', '1', 'Et distinctio.', 'Minus quia deleniti.', 'Dicta nesciunt sunt.', 'Tenetur numquam.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('2', '5', '1', 'Eos fugiat ducimus.', 'Esse deleniti aut.', 'Voluptate qui rerum.', 'Qui quis occaecati.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('3', '4', '1', 'Temporibus ut qui.', 'Maxime quibusdam.', 'Rerum ratione.', 'Consequatur veniam.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('4', '4', '2', 'Vitae voluptas.', 'Rerum vel omnis.', 'Porro id eum quo.', 'Repellat sunt.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('5', '7', '2', 'Dolores quis nulla.', 'Repellat sint.', 'Ex doloribus.', 'Ad quasi dolorem.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('6', '2', '3', 'Animi nihil dicta.', 'Sint nemo aut sit.', 'Laborum beatae eos.', 'Quisquam eaque in.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('7', '6', '2', 'Voluptates delectus.', 'Accusamus similique.', 'Corrupti excepturi.', 'Non reprehenderit.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('8', '5', '3', 'Labore unde est.', 'Ipsum qui ut.', 'Libero aut et et.', 'Rerum libero.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('9', '7', '2', 'Sed et et magni.', 'Minima ut est ad.', 'Doloremque ut quasi.', 'Ut illum repellat.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('10', '2', '1', 'Maxime ut mollitia.', 'Impedit cupiditate.', 'Vel at vero.', 'Dolor veniam.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('11', '6', '1', 'Optio incidunt qui.', 'Enim distinctio.', 'Omnis ut ea maxime.', 'Distinctio alias.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('12', '4', '1', 'Necessitatibus.', 'Ut perspiciatis.', 'Similique qui et.', 'Et autem est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('13', '3', '3', 'Veritatis voluptas.', 'In aspernatur nemo.', 'Iure ea quisquam.', 'Modi dignissimos.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('14', '8', '2', 'Aspernatur.', 'Qui rem omnis.', 'Ex et et harum iure.', 'Ut repellat.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('15', '4', '3', 'Est aut aut et qui.', 'Quia omnis possimus.', 'Earum velit quidem.', 'Officia iure in.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('16', '8', '1', 'Culpa voluptatem.', 'Repellat sit quis.', 'Omnis qui eos quae.', 'Qui asperiores sit.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('17', '7', '1', 'Ut iusto officiis.', 'Repellat architecto.', 'Doloremque nisi.', 'Tenetur quidem iure.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('18', '4', '3', 'Voluptates dolore.', 'Vero quasi animi at.', 'Consequuntur quod.', 'Eius alias nulla.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('19', '7', '3', 'Saepe perferendis.', 'Est fugit voluptas.', 'Aut quis autem aut.', 'Dicta vel est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('20', '8', '3', 'Reprehenderit.', 'Itaque magnam ut.', 'Harum veniam quidem.', 'Est harum rerum.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('21', '5', '1', 'Soluta pariatur.', 'Voluptatem saepe.', 'Facere nulla nam.', 'Expedita.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('22', '6', '1', 'Ut maiores harum.', 'Voluptatibus.', 'Dolores eum magni.', 'Asperiores facilis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('23', '6', '2', 'Assumenda non.', 'Voluptatem quas.', 'Recusandae atque.', 'Placeat qui.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('24', '1', '3', 'Consequatur quo.', 'Qui amet quibusdam.', 'Eaque ut hic ullam.', 'Esse iusto.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('25', '6', '3', 'Est et repellat.', 'Tenetur ab fugit.', 'Voluptates dolor.', 'Eum voluptate.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('26', '9', '2', 'Architecto earum.', 'Incidunt dolores.', 'Dolores alias in.', 'Vel ut qui tenetur.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('27', '3', '3', 'Sint suscipit.', 'Quia enim omnis.', 'Voluptas qui.', 'Nulla odio est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('28', '3', '2', 'Tenetur iusto rerum.', 'Doloribus quia et.', 'Recusandae nisi ex.', 'Aut reiciendis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('29', '10', '2', 'Enim quo ut autem.', 'Non aut dolor.', 'Repudiandae.', 'Quos maiores dicta.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('30', '9', '3', 'Sit ducimus debitis.', 'Quas fugiat libero.', 'Id dicta quia et.', 'Nisi eum in minus.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('31', '3', '2', 'Soluta id ipsa qui.', 'Fugit expedita.', 'Et optio qui.', 'Est cupiditate eum.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('32', '10', '1', 'Harum mollitia.', 'Consequatur.', 'Aperiam natus.', 'Blanditiis illum.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('33', '3', '3', 'Minima accusamus.', 'Est voluptatem.', 'Aspernatur possimus.', 'Et reiciendis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('34', '9', '1', 'Sit consequatur.', 'Facilis deserunt.', 'Consequuntur.', 'Ratione molestiae.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('35', '9', '1', 'Qui mollitia.', 'Sint non.', 'Fuga aut excepturi.', 'Numquam officiis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('36', '2', '3', 'Eos eveniet sit.', 'Assumenda quaerat.', 'Voluptate.', 'Dolor quasi.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('37', '5', '1', 'Voluptas.', 'Deleniti et.', 'Ut ex mollitia.', 'Quasi fugiat.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('38', '4', '2', 'Minus ut officia.', 'Rerum vero quam.', 'Amet sequi ex.', 'Autem ullam dolor.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('39', '6', '2', 'Sequi et aperiam id.', 'Eligendi quia.', 'Officiis aut.', 'Id quas repellat ut.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('40', '8', '3', 'A quam quia et quae.', 'Et libero.', 'Est modi dolores.', 'Doloribus natus rem.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('41', '10', '3', 'Et temporibus id.', 'Molestiae eum.', 'Corporis ut earum.', 'Odio facilis magnam.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('42', '4', '1', 'Deserunt magni.', 'Vel incidunt et.', 'Rem voluptatem est.', 'Ut eligendi.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('43', '6', '3', 'Odio quis excepturi.', 'Vitae ab ipsa eos.', 'Rem aspernatur.', 'Nobis natus autem.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('44', '5', '1', 'Sunt cumque dicta.', 'Enim atque aut.', 'In voluptate.', 'Ipsam assumenda.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('45', '2', '2', 'Qui nulla est eius.', 'Et sint suscipit.', 'Ipsum earum.', 'Dolorem reiciendis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('46', '6', '2', 'Voluptatem ipsum.', 'Excepturi est ipsam.', 'Quia inventore iste.', 'Qui deserunt error.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('47', '1', '1', 'Accusantium vitae.', 'Quam nihil quas.', 'Quaerat ea.', 'Consequatur sit.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('48', '5', '3', 'Et et vel molestias.', 'Molestiae et eaque.', 'At aperiam neque.', 'Reiciendis facere.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('49', '1', '3', 'Dolorum et fugit.', 'Recusandae deleniti.', 'Recusandae dolorem.', 'Ipsa ut quo omnis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('50', '6', '1', 'Omnis recusandae et.', 'Exercitationem et.', 'Aspernatur sit et.', 'Nulla voluptas.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('51', '9', '1', 'Et molestiae.', 'Vero quidem ipsum.', 'Recusandae pariatur.', 'Est quis facilis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('52', '2', '2', 'Et ducimus.', 'Eum inventore et.', 'Nam voluptatum.', 'Excepturi maxime et.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('53', '6', '2', 'Esse eum dolore.', 'Vel est sint.', 'Sed blanditiis.', 'Debitis sed eum.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('54', '4', '2', 'Officia a sit.', 'Qui officia.', 'Nemo perferendis.', 'Reiciendis nobis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('55', '10', '2', 'Dolor consequatur.', 'Dolor odio qui at.', 'Saepe et beatae.', 'Rerum eligendi.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('56', '5', '3', 'Unde enim.', 'Illum itaque unde.', 'Soluta at excepturi.', 'Aut suscipit.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('57', '7', '1', 'Ratione tempore.', 'Rerum alias eos.', 'Odit et.', 'Doloribus sequi.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('58', '8', '1', 'Officia maxime qui.', 'Aut nisi fugit.', 'Hic qui temporibus.', 'At omnis qui qui.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('59', '8', '1', 'Autem molestiae.', 'Eos temporibus.', 'Pariatur dolores.', 'Libero rem ea est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('60', '2', '2', 'Debitis animi qui.', 'Et soluta fugiat.', 'Fuga temporibus.', 'Repellendus.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('61', '2', '3', 'Culpa quod maiores.', 'Vero repudiandae.', 'Enim qui quia iure.', 'Libero ut est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('62', '5', '2', 'Quia modi earum.', 'Amet eum autem.', 'Dicta laboriosam.', 'Quam eum qui.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('63', '8', '2', 'Ut dolorem non.', 'Velit iusto minima.', 'Aut consequatur.', 'Ducimus rem soluta.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('64', '6', '3', 'Ipsa quis tempora.', 'Aspernatur rerum.', 'Sed quia aut vitae.', 'Dicta iste.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('65', '10', '3', 'Consectetur.', 'Sed repellat ut est.', 'Natus et aut.', 'Quis nesciunt.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('66', '7', '2', 'Eum id qui velit.', 'Unde est nulla.', 'A doloribus ut est.', 'Id molestiae omnis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('67', '4', '2', 'Aut dolorem autem.', 'Unde velit.', 'Nihil ab commodi ut.', 'Est suscipit.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('68', '4', '2', 'Omnis dolor omnis.', 'Ut labore odit.', 'Numquam occaecati.', 'Omnis laborum est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('69', '4', '2', 'Tenetur in.', 'Ab optio et cum.', 'Rerum et cupiditate.', 'Inventore tenetur.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('70', '5', '2', 'Impedit iste in.', 'In beatae et animi.', 'Consectetur optio.', 'Et fugiat.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('71', '7', '3', 'Id nam architecto.', 'Asperiores vel.', 'Rerum perferendis.', 'Doloremque vel.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('72', '5', '2', 'Pariatur non neque.', 'Atque facere.', 'Ratione ea.', 'Rerum impedit sed.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('73', '3', '1', 'Error eveniet autem.', 'Eum repellat ipsa.', 'Nihil aliquam omnis.', 'Et natus nam ullam.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('74', '6', '1', 'Sit at omnis esse.', 'Eos sunt ut quos.', 'Ea blanditiis.', 'Nihil incidunt.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('75', '8', '3', 'Mollitia eligendi.', 'Dolores velit est.', 'Voluptatibus.', 'Ullam cum id.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('76', '6', '1', 'Eum consequatur.', 'Doloremque quia.', 'Aut ea quia quod.', 'Tempora velit.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('77', '6', '1', 'A rerum placeat.', 'Totam officiis.', 'Et deserunt sunt.', 'Molestias atque.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('78', '1', '1', 'Ea laudantium magni.', 'Blanditiis minima.', 'Magni ut sit.', 'Corporis ex sed.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('79', '9', '3', 'Corporis id.', 'Rerum omnis rerum.', 'Ut aut neque ad.', 'Consectetur.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('80', '6', '3', 'Vitae accusamus.', 'Rerum nisi.', 'Minus eligendi.', 'Et nihil et.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('81', '5', '2', 'Reprehenderit et.', 'Eum eligendi.', 'Dignissimos itaque.', 'Veritatis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('82', '8', '3', 'Voluptate velit.', 'Autem voluptatem.', 'Dolorem et totam.', 'Ut non harum vero.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('83', '5', '2', 'Consequatur harum.', 'Autem veritatis ea.', 'Vitae distinctio.', 'Voluptatibus.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('84', '5', '2', 'Excepturi tenetur.', 'Amet assumenda quod.', 'A perspiciatis.', 'Reiciendis non.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('85', '8', '3', 'Laboriosam optio.', 'Et nam accusantium.', 'Consequuntur harum.', 'Omnis vel et.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('86', '8', '2', 'Culpa tenetur aut.', 'Qui ea dolores.', 'Eum eligendi aut.', 'Odio sunt quia.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('87', '8', '1', 'Cupiditate nisi.', 'Laborum et.', 'Est et non.', 'Aut dolorum est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('88', '9', '3', 'Vel sequi eaque.', 'Dolor est molestiae.', 'Voluptatem ea sint.', 'Quis nostrum dicta.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('89', '5', '3', 'Illo eligendi.', 'Aut optio ut velit.', 'Blanditiis non.', 'In quos possimus.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('90', '3', '3', 'Esse eius.', 'Possimus rerum.', 'Sed quae libero.', 'Omnis porro est sed.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('91', '10', '2', 'Ea quisquam magni.', 'Facere sunt eum.', 'Quis velit.', 'Quibusdam sit non.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('92', '1', '1', 'Repellat maxime.', 'Et ut perspiciatis.', 'Quis aliquid culpa.', 'Autem voluptas.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('93', '4', '3', 'Qui consequatur.', 'Dolorum corporis.', 'Aperiam error enim.', 'Ratione corrupti.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('94', '2', '2', 'Maiores expedita.', 'Deserunt.', 'Ut aspernatur.', 'Sunt nesciunt quos.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('95', '6', '1', 'Ipsum qui ut aut.', 'Amet quo repellat.', 'Quae veritatis.', 'Non excepturi odio.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('96', '4', '2', 'Accusamus omnis.', 'At eveniet dolorem.', 'Nesciunt et.', 'Qui quam quod non.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('97', '9', '2', 'Et fugit odio.', 'Placeat voluptas.', 'Et cumque eius.', 'Nostrum similique.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('98', '7', '2', 'Omnis nobis aut aut.', 'Hic aut incidunt.', 'Quia omnis porro.', 'Voluptas facilis.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('99', '1', '1', 'Modi doloribus sit.', 'Sed et ipsa dolorum.', 'Cupiditate voluptas.', 'Ut at est.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `messages_big_test` VALUES ('100', '3', '1', 'Eaque ullam.', 'Laborum ut.', 'Beatae quo neque.', 'Est qui deleniti.', 'Temp(file_id message)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');

-- ----------------------------
-- Table structure for messages_small_test
-- ----------------------------
DROP TABLE IF EXISTS `messages_small_test`;
CREATE TABLE `messages_small_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `small_test_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `passing_message` text COLLATE utf8_unicode_ci NOT NULL,
  `failed_message` text COLLATE utf8_unicode_ci NOT NULL,
  `correct_message` text COLLATE utf8_unicode_ci NOT NULL,
  `incorrect_message` text COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of messages_small_test
-- ----------------------------
INSERT INTO `messages_small_test` VALUES ('1', '65', '1', 'Vitae sit velit aut.', 'Quia ipsam voluptate itaque aut non ut.', 'Maxime aspernatur aut rem neque magni.', 'Ea hic quod cum aut.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('2', '55', '3', 'Fugiat quia aliquid fuga eum qui voluptatem.', 'Reprehenderit in excepturi itaque ut dolor.', 'Quia alias excepturi veniam.', 'Omnis quisquam esse quos assumenda.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('3', '8', '2', 'Quo sit enim sed est perspiciatis.', 'Et nihil ut et ducimus voluptates culpa alias.', 'Mollitia et amet reprehenderit.', 'Labore eveniet ab neque voluptatum ea.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('4', '75', '2', 'At repellat quisquam aut culpa non cupiditate.', 'Repellat nemo tenetur aut qui.', 'Voluptas voluptatem est nemo id ut facilis.', 'Commodi sit architecto est error assumenda.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('5', '49', '1', 'Deleniti nobis laborum enim corrupti.', 'Minus inventore qui consectetur quia ab.', 'Quidem ab mollitia eveniet aliquid fugit.', 'Magni enim molestiae eum est quia.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('6', '84', '3', 'Qui earum beatae dolores.', 'Qui dolores et a commodi a quaerat.', 'Minima quis dolores ut quia.', 'Magni quia et cumque consequuntur aut.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('7', '71', '3', 'Eum itaque ex iure tempore corporis.', 'Assumenda non dolore iusto sit laborum.', 'Quo minima quis vitae autem blanditiis.', 'Provident aut est tempore consequatur.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('8', '63', '1', 'Sunt suscipit reiciendis et ad nulla.', 'Est voluptatum et quas sapiente.', 'Hic ipsum repellendus praesentium.', 'Et praesentium accusantium quisquam sint rerum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('9', '61', '3', 'Sint et rerum sunt omnis autem aut explicabo.', 'Inventore inventore sed non.', 'Dignissimos earum hic quibusdam est.', 'Veniam libero sunt fugiat voluptatum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('10', '40', '1', 'Sunt ab distinctio non alias.', 'Voluptas quod maiores distinctio atque qui.', 'Minima qui unde aut incidunt expedita illo.', 'Consequatur et natus ut.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('11', '37', '1', 'Dolorem dolor in facere cupiditate.', 'Ut perferendis placeat quis molestias.', 'Mollitia molestiae reprehenderit vero.', 'Ex est vero sed ad quis minima quia culpa.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('12', '23', '2', 'Deserunt illo enim vel magnam.', 'Aut eius aut et velit dolorum accusamus.', 'Nulla quidem veniam ut porro magnam voluptatem.', 'Fugit blanditiis placeat id neque.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('13', '69', '2', 'Et maxime nihil labore facere.', 'Non quia aperiam consequuntur accusantium quia.', 'Qui quo ut unde autem.', 'Quia ut minus corrupti quas.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('14', '4', '3', 'Et aperiam culpa et fugit dicta et.', 'Atque accusamus dolore excepturi minima unde.', 'Aperiam quasi ea temporibus qui omnis et.', 'Voluptatum voluptatum rerum ex.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('15', '31', '1', 'Nesciunt iste nulla nemo qui facilis nostrum.', 'Voluptatem voluptas molestiae voluptas quia.', 'Expedita consequatur et qui autem ullam tempora.', 'In sed placeat natus velit excepturi ipsum et.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('16', '58', '2', 'Quam distinctio alias ut.', 'Cum ipsum ipsa voluptate ut quia ad.', 'Temporibus ut rerum sed adipisci.', 'Sequi consequatur est quia consectetur.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('17', '5', '3', 'Sapiente debitis aperiam corporis.', 'Quo commodi omnis ipsa.', 'Voluptas aliquam sint beatae voluptatibus.', 'Ipsa dolore ipsum a consequatur iste ea eum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('18', '93', '2', 'Illo occaecati ex quod qui perspiciatis.', 'Unde eos blanditiis numquam dicta libero vel.', 'Sapiente placeat dolores non quo consequatur.', 'Deserunt assumenda est suscipit ullam architecto.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('19', '59', '2', 'Ea officiis autem ut dolorum.', 'Eligendi fuga veritatis iusto ea vel rerum.', 'Ab corrupti perferendis autem iste.', 'Aliquam est explicabo magnam.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('20', '28', '2', 'Sit maxime perspiciatis facere occaecati sint.', 'Eum aut omnis quam iure quam.', 'Ipsa ullam voluptas dolorem.', 'Ea saepe cum rerum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('21', '56', '2', 'Est quam commodi quod quia. Aut est esse eos sed.', 'Quas id est velit dolorem maiores sunt.', 'Ut sit odit aut debitis mollitia.', 'Esse non laudantium enim qui.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('22', '33', '1', 'Nobis similique deleniti sit tempora impedit.', 'Assumenda molestiae est neque quos sint.', 'Numquam sed impedit dolores excepturi.', 'Eius in nisi omnis et sed.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('23', '45', '3', 'Omnis quis vitae qui voluptates est voluptas qui.', 'Sit molestiae velit officiis dolores et expedita.', 'Pariatur voluptates non fugit et.', 'Dolor eligendi voluptas accusantium ea.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('24', '28', '2', 'Saepe quia sint labore rerum dolore eos.', 'Accusantium expedita ea aut.', 'Et non ipsa animi ex in magni.', 'Sunt qui itaque aut quidem labore.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('25', '99', '2', 'Dolore magnam sed blanditiis sed.', 'Non voluptatibus sint quibusdam amet quam.', 'Fugit est et dolorem et quasi tempore.', 'Odio beatae exercitationem et dicta dolores.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('26', '90', '2', 'Deserunt delectus quo debitis error ut dolorem.', 'Cumque nulla cumque voluptas ipsa fugit ipsum.', 'Nobis dolor in similique deleniti quo hic.', 'Eos nihil delectus quae natus sint.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('27', '75', '2', 'Consequatur quo suscipit beatae enim.', 'Dolores ut dolorem earum at illum.', 'In totam vel alias esse.', 'Rem sequi quibusdam fugit quasi.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('28', '87', '2', 'Optio aut et aliquam ab.', 'Aut labore explicabo enim rerum et numquam.', 'Expedita voluptatibus eum unde ipsam quidem.', 'Id vel minima earum labore tempora vero corporis.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('29', '85', '2', 'Aut est tenetur molestiae itaque libero.', 'Minus vel molestias tenetur dicta.', 'Dolorem vitae nemo id sit.', 'Animi accusamus eligendi odit beatae accusamus.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('30', '83', '1', 'Nihil aut et a perferendis.', 'Laudantium quo quo nihil consequatur qui aut.', 'Blanditiis vel autem veritatis nesciunt tempore.', 'Aut voluptatem est odio deleniti sint.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('31', '100', '2', 'Non esse labore nobis qui et placeat laudantium.', 'Quidem fugit optio incidunt aliquam.', 'Mollitia quia dolor laborum molestiae veniam.', 'Est est cupiditate nobis provident.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('32', '41', '3', 'Et ea dolorem quia dolorem sint possimus.', 'Deserunt rerum possimus aut sit.', 'Laudantium et dolor eligendi porro alias.', 'Eos incidunt neque repellat sequi.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('33', '73', '1', 'Illo ex dolorem assumenda facilis quia est.', 'Quae quis porro sint. Possimus id dicta eius.', 'Placeat omnis quia provident quis aut et.', 'Sunt nihil ducimus magni reprehenderit.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('34', '14', '1', 'Distinctio ipsum cumque natus et mollitia illo.', 'Nam ut porro expedita vel unde.', 'Voluptatibus est quaerat temporibus.', 'Autem nam eveniet hic.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('35', '87', '3', 'Voluptatibus esse blanditiis et fugit.', 'Aut quas ut rerum et ea magni.', 'Nobis voluptates cum sed sunt ea eaque esse.', 'Id omnis sint accusamus rerum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('36', '32', '1', 'Sed non dolorum rerum quia animi excepturi.', 'Asperiores consequatur nisi dolorem et quia.', 'Dolore a delectus voluptas eos veniam.', 'Aut fugiat sed et necessitatibus similique.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('37', '63', '3', 'Quis saepe dolor unde deleniti.', 'Ut similique veniam tenetur impedit.', 'Id non repellat non qui veritatis hic eum.', 'Omnis culpa cumque cupiditate adipisci vero.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('38', '7', '1', 'Minima saepe ut ut consequatur.', 'Voluptatem odit aut nam odio.', 'Sint esse inventore totam dicta doloremque ea.', 'Iure tempora id eveniet sunt accusamus.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('39', '11', '1', 'Quaerat nulla cum quo voluptas sint.', 'Harum officiis iusto qui illum quis aliquam.', 'Beatae dolores tempore qui et officiis quasi.', 'Velit sed quaerat officia libero alias quaerat.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('40', '56', '2', 'Natus odit et officia in ad voluptatem.', 'Reprehenderit eaque deserunt ea voluptate.', 'Maiores eum sit ea vel. At eos natus et aut.', 'Asperiores ut vel tempora et.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('41', '14', '1', 'Eius voluptas magnam dicta.', 'Sunt voluptas occaecati libero hic.', 'Hic qui alias autem ipsa.', 'Quibusdam ea aperiam qui ducimus velit.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('42', '17', '2', 'Earum incidunt asperiores rerum nemo aliquid.', 'Architecto ut explicabo quae totam facilis.', 'Est sit animi facilis sequi laborum enim.', 'Et quia exercitationem ea rerum voluptas quaerat.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('43', '5', '2', 'Et iste qui voluptatem sapiente voluptatem.', 'Nisi rerum qui velit molestiae ea aperiam rerum.', 'Corrupti similique non aut quam.', 'Explicabo quas ipsa quos unde magni.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('44', '2', '1', 'Aut repellendus et quaerat consequuntur.', 'Odit nihil sint eaque adipisci.', 'Temporibus praesentium vitae enim assumenda.', 'Quia dolores molestiae quisquam animi.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('45', '20', '2', 'Quaerat perferendis velit aliquam temporibus et.', 'Ut nobis nihil reiciendis quia.', 'Id optio nam cum sit velit quasi eius.', 'Ex sapiente ipsam accusamus labore.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('46', '26', '3', 'Aut et ut ut voluptas animi.', 'Optio tenetur voluptate adipisci quas ea.', 'Quam veritatis et totam.', 'Animi consequatur dolor quisquam.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('47', '86', '2', 'Voluptate perferendis optio eos animi excepturi.', 'Aliquid velit et eligendi quia et molestiae.', 'Vitae est modi similique sint aut qui qui.', 'Occaecati quis et sunt rerum officiis deleniti.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('48', '30', '3', 'Est quisquam sapiente non deleniti.', 'Laborum vel repellendus quis dicta.', 'Eos atque qui quia eaque non ex id.', 'Esse ut quam et deleniti sint non.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('49', '60', '1', 'Rerum et consequuntur officia delectus.', 'Quia molestiae est et.', 'Facilis nemo id asperiores minus natus.', 'Non dolorem voluptatem et.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('50', '7', '2', 'Nihil porro expedita ad minima.', 'Omnis et nobis sunt nihil.', 'Minus molestiae aliquid doloribus nulla.', 'Officia eos magnam quaerat qui numquam et iusto.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('51', '8', '1', 'Accusamus enim aut mollitia.', 'Atque laudantium ut velit suscipit excepturi.', 'Adipisci corrupti alias ea.', 'Vero nihil et corrupti sit nostrum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('52', '14', '2', 'Ipsam eos provident ullam alias.', 'Aut harum assumenda voluptatem voluptate ad.', 'Sequi quis voluptates est.', 'Nisi cumque eos cupiditate suscipit qui.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('53', '7', '2', 'Aut nulla excepturi quibusdam exercitationem.', 'Itaque sed quo natus possimus.', 'Et non vel consequatur aspernatur vero.', 'Voluptatem nobis aspernatur quae at dolores.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('54', '98', '2', 'Cumque eveniet sunt ut ea ipsum delectus.', 'A perspiciatis molestiae quibusdam suscipit id.', 'Et id facere vitae ullam cum qui.', 'Dolores suscipit fuga rem cum unde ratione omnis.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('55', '39', '3', 'Nihil in facilis voluptatum est voluptas.', 'Omnis aut sit natus.', 'Odit fuga doloribus et accusamus qui in voluptas.', 'Facilis pariatur in earum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('56', '83', '2', 'Quasi a saepe quisquam voluptas sit.', 'Sint hic sit ipsa.', 'Doloremque nihil nobis ut.', 'In quia commodi suscipit officia qui sint.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('57', '83', '2', 'Porro vero qui voluptatum.', 'Error id corrupti dolore id dolores.', 'Deserunt quasi rem sit architecto accusamus.', 'Necessitatibus rerum iste nesciunt quaerat.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('58', '31', '2', 'A ea cum aliquid ducimus.', 'Error ut ullam ipsam ad iure quia.', 'Sunt aliquam dolorem veniam vero.', 'Tempore placeat et voluptatem culpa ad.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('59', '93', '1', 'Eos dolores aut laudantium est.', 'Iure sed tenetur reiciendis id voluptas.', 'Quo ut dolorem possimus aut asperiores.', 'Vel non exercitationem et dignissimos aut.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('60', '44', '1', 'Voluptas commodi sequi ut sed.', 'Eos iste maiores quod repellendus dicta.', 'Totam voluptate voluptas saepe.', 'Facere est omnis quia voluptatibus eum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('61', '59', '1', 'Nulla excepturi dolorem et dolores.', 'Deserunt tempore corrupti dolore ut.', 'Numquam quo aperiam minima distinctio odit in.', 'Impedit corporis eligendi vel.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('62', '83', '2', 'Excepturi possimus similique laudantium.', 'Quo et et illo iure quae.', 'Ut doloremque earum dolorum temporibus sed rerum.', 'Maxime dolores quas dolore ducimus nam cumque.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('63', '50', '3', 'Placeat repellendus delectus velit veritatis.', 'Nam eum officiis sequi dolorem ut quos.', 'Fugit modi minus sit et.', 'Soluta qui id perferendis autem.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('64', '8', '2', 'Vero reiciendis neque ea magni ad assumenda.', 'Doloribus iure eveniet quas.', 'Fugiat fuga asperiores debitis perspiciatis et.', 'Quo quo eos aut similique.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('65', '34', '1', 'Quia neque cum ut. Ea ipsa voluptatem quis.', 'At et officia voluptatibus cum debitis sit.', 'Fugiat quisquam id nesciunt quia excepturi.', 'Sed quia sequi veritatis.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('66', '100', '3', 'Qui odit itaque in deleniti ipsum et.', 'Fugit fugiat provident error non dolore vel.', 'Fuga esse asperiores est debitis.', 'Labore odit dignissimos et in earum.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('67', '38', '3', 'Mollitia et autem et optio ipsa et vitae.', 'Fugiat quibusdam laudantium totam illo.', 'Est ut nostrum id nostrum debitis.', 'Omnis aperiam non sed perferendis.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('68', '96', '3', 'Unde molestiae quia facilis provident odio.', 'Minima adipisci et id quo.', 'Quo quia sit culpa aliquid ut error quidem.', 'Quas aut amet quia.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('69', '62', '1', 'Aperiam qui aliquam saepe fugiat.', 'Dolores at commodi est minus.', 'Necessitatibus est dolorem quo sed similique.', 'Aut ipsa tenetur reprehenderit autem nulla.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('70', '45', '2', 'Esse nobis libero ut esse et laudantium pariatur.', 'Tempora quo officia dolores id.', 'Autem illum occaecati tempore deleniti.', 'Et enim nesciunt quia voluptatem.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('71', '10', '1', 'Autem sapiente eum sunt dolore.', 'Ut possimus qui sunt reprehenderit quae ab eius.', 'A qui harum vero alias est.', 'Delectus ipsam aut ut porro.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('72', '41', '3', 'Nesciunt ducimus rerum quaerat dicta.', 'Velit ad et illum maiores cum sit.', 'Odio aut atque voluptatem placeat alias vel.', 'Quia suscipit vel et.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('73', '73', '1', 'Sit rerum placeat velit.', 'Nihil iure eaque vel dolorem facere iure dicta.', 'Expedita qui similique in aut.', 'Optio minus nam veniam est id sapiente incidunt.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('74', '39', '3', 'Temporibus ipsum corporis explicabo autem.', 'Et itaque a ea aut optio qui quis.', 'Ad iure maiores ex ut nemo suscipit.', 'Accusamus qui voluptatem eligendi aperiam.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('75', '8', '1', 'Qui dolore enim beatae.', 'Asperiores adipisci nulla ad.', 'Voluptatum laboriosam tempore aliquam dolorem.', 'Ex occaecati qui quis porro et amet.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('76', '85', '3', 'Repellat sed quo ut aliquam.', 'Qui quia ut dolores quidem accusantium.', 'Sapiente omnis a commodi quidem.', 'Ipsam asperiores amet in sint quasi ut cumque.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('77', '23', '2', 'Qui sint architecto dolores esse velit qui sint.', 'Excepturi itaque quia voluptate eum.', 'Dolorem rem quibusdam omnis ullam.', 'Voluptatum ipsum qui et aut quam aliquam minus.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('78', '99', '2', 'Sequi earum iure totam ut.', 'Et iste recusandae saepe aut.', 'Ullam commodi enim alias nulla nostrum sit rerum.', 'Odio vel omnis ducimus est.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('79', '29', '1', 'Et at officia aut laborum non quae.', 'Iusto qui voluptatum et repudiandae asperiores.', 'Praesentium dolores ex eum illum sequi aperiam.', 'Fugit provident rem voluptas laudantium aut.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('80', '81', '2', 'Voluptatum ratione temporibus a iure.', 'Et amet porro nisi qui est omnis.', 'Unde a et est alias esse amet.', 'Magnam ut mollitia rerum veritatis.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('81', '83', '2', 'Eos ipsam magnam eum dolores.', 'Nam aut nisi ea excepturi quia.', 'Ut sit incidunt alias.', 'Quia aliquam qui odio ea.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('82', '94', '3', 'Mollitia et quia ut occaecati illo.', 'Reiciendis quo nemo est.', 'Vero vero est sequi incidunt iste est atque.', 'Incidunt nihil nesciunt animi ab aliquid error.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('83', '56', '2', 'Recusandae quam eveniet sunt temporibus.', 'Dignissimos nobis amet tempora.', 'Dolore qui qui molestiae.', 'Id quaerat fugiat incidunt nesciunt.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('84', '59', '3', 'Culpa commodi repellendus quos consequatur enim.', 'Sunt sequi fugit rerum aut facilis.', 'Doloribus mollitia et rerum eligendi.', 'Eaque aut dolor quia eveniet enim inventore aut.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('85', '82', '1', 'Nam consequatur unde eaque voluptas dolor.', 'Ipsam atque sed nihil consequatur.', 'Et aperiam nisi labore non nulla et.', 'Omnis magnam et corrupti vero enim commodi optio.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('86', '13', '3', 'Ea exercitationem et aliquam modi.', 'Adipisci ea praesentium eum deleniti.', 'Eaque quisquam et ut animi est.', 'Laboriosam repellendus perspiciatis odit tempore.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('87', '10', '2', 'Doloremque iure pariatur et placeat.', 'Ut nisi unde ipsum enim sapiente blanditiis ut.', 'Iusto eius aut tempora perferendis eveniet sint.', 'Nisi ducimus praesentium tenetur.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('88', '69', '3', 'Quia enim quod reiciendis sunt.', 'Qui modi excepturi dolorem accusantium.', 'Ipsum et eaque consectetur molestiae.', 'Consequatur ea perspiciatis velit id commodi.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('89', '78', '1', 'Natus numquam qui ut.', 'Quo nobis facere suscipit et quam id minus.', 'Et dolor corrupti accusamus maiores.', 'Blanditiis atque nesciunt error similique.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('90', '82', '2', 'Et dicta a deleniti.', 'Sunt magnam nisi aut cumque officiis eum.', 'Laboriosam itaque placeat assumenda cumque rerum.', 'Nihil non voluptate illum incidunt.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('91', '99', '1', 'In qui assumenda enim architecto iure eum.', 'Omnis nihil laborum molestiae porro et dolores.', 'Id eveniet rerum qui cum architecto et.', 'Vel aut nihil et sunt. Error et repudiandae enim.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('92', '76', '3', 'Repudiandae dolorum velit animi delectus.', 'Ratione exercitationem ut blanditiis sunt.', 'Officia omnis et velit inventore.', 'Ad iste ullam inventore ut earum minus sed.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('93', '86', '1', 'Incidunt aut aut ut laboriosam reiciendis nulla.', 'Enim incidunt qui architecto officiis labore.', 'In aliquid in iusto sed nisi molestiae et.', 'Numquam illo placeat nulla quia.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('94', '42', '2', 'Qui cum ut tempora autem inventore.', 'Dignissimos est dignissimos facere maiores.', 'Veniam dolore qui repellendus.', 'Eum vel optio quia esse incidunt.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('95', '58', '1', 'Voluptatem eaque praesentium officiis sequi.', 'Blanditiis blanditiis corporis omnis omnis quia.', 'Ut ea libero temporibus voluptatibus.', 'In quo accusantium aut iste.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('96', '8', '1', 'Sapiente architecto accusantium voluptatem.', 'Nulla odio vel rem itaque.', 'Aperiam quia quaerat sit est ut.', 'Velit fugit quos repudiandae asperiores in.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('97', '43', '3', 'Inventore beatae voluptas quibusdam quos.', 'Sint et quia molestiae velit culpa et aut.', 'Nisi laudantium aut esse rem.', 'Aut quia fuga distinctio velit.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('98', '84', '3', 'Dolor voluptatem et aut laborum eos tempora.', 'Illum officia eum ad id.', 'Enim est occaecati sunt enim ullam natus.', 'Corporis repellendus soluta et dolore vitae eos.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('99', '43', '3', 'Fugiat eligendi nam qui alias quia modi.', 'Facere ut autem natus maxime praesentium.', 'Sed harum asperiores quidem non velit ex sed.', 'Et dolorem expedita quia adipisci.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');
INSERT INTO `messages_small_test` VALUES ('100', '63', '2', 'Est quisquam est perferendis asperiores.', 'Alias dolorem sunt recusandae dolorem.', 'Iste velit aut vel cum porro aliquid.', 'Eius quis maiores accusantium natus esse.', 'Temp(file_id message)', '2017-07-22 12:31:44', '2017-07-22 12:31:44');

-- ----------------------------
-- Table structure for messages_tips
-- ----------------------------
DROP TABLE IF EXISTS `messages_tips`;
CREATE TABLE `messages_tips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tips_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `passing_message` text COLLATE utf8_unicode_ci NOT NULL,
  `failed_message` text COLLATE utf8_unicode_ci NOT NULL,
  `correct_message` text COLLATE utf8_unicode_ci NOT NULL,
  `incorrect_message` text COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of messages_tips
-- ----------------------------
INSERT INTO `messages_tips` VALUES ('1', '40', '2', 'Reprehenderit maiores consequatur eos cupiditate ipsum sit.', 'Eligendi vero ut quia sed consequatur assumenda enim.', 'Odio possimus totam provident in veritatis quidem.', 'Non ratione debitis sed et hic et minima.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('2', '27', '1', 'Hic dolorum non autem molestiae.', 'Et pariatur animi magnam.', 'Quos accusamus ipsa sed consequatur.', 'Rerum sapiente eos suscipit qui.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('3', '15', '1', 'Dolorem id maxime est.', 'Nihil neque laudantium at atque.', 'Culpa quod aut quam.', 'Saepe quis consequatur maiores illo iusto dolorem asperiores.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('4', '40', '2', 'Sit et sed unde assumenda laborum.', 'Suscipit praesentium nulla sit autem.', 'Accusantium amet ex nesciunt consequuntur deserunt aspernatur.', 'Eligendi commodi perspiciatis possimus aut libero nemo quaerat.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('5', '16', '2', 'Sit adipisci a accusantium excepturi ab alias veniam.', 'In sequi consequatur cupiditate perferendis animi nam quidem.', 'Alias nostrum delectus dolor saepe et deleniti.', 'Asperiores enim veritatis aut eius.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('6', '27', '2', 'Non deleniti dolore quidem velit reiciendis.', 'Dolores eum dolores qui qui explicabo sed sunt nihil.', 'Eos quidem enim omnis veritatis voluptates repellendus.', 'Esse ut necessitatibus aut pariatur et sapiente.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('7', '40', '2', 'Cupiditate nesciunt quos mollitia fuga sapiente ratione.', 'Est qui nulla sunt qui.', 'Ipsum dolorum aut accusantium vero pariatur possimus est sint.', 'In veritatis molestiae ullam quo reprehenderit mollitia.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('8', '22', '3', 'Molestias quia debitis atque eum.', 'Aut incidunt quae est quo minus.', 'Et qui ratione eos neque.', 'Iste harum quia placeat maiores a et in.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('9', '34', '3', 'Officia et ut quas.', 'Saepe occaecati aut sit et aut.', 'Error eum sed aut ab enim et.', 'Repudiandae at ab aut dolorem corrupti perspiciatis.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('10', '4', '3', 'Iure repellendus autem sit corrupti reprehenderit dolorem eius.', 'Ut quae et autem molestiae aut ratione facere.', 'Sint nulla eius laudantium id suscipit voluptates et.', 'Quis nostrum temporibus aspernatur ut.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('11', '5', '2', 'Vel amet non neque est placeat corrupti ut.', 'Facilis vitae est et asperiores modi ut cum enim.', 'Ratione libero neque aspernatur veniam et consequuntur.', 'Et rem aliquid et aut vero.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('12', '32', '2', 'Aut aut atque quibusdam corrupti fuga.', 'In possimus ipsum veritatis doloribus culpa.', 'Reprehenderit velit et aut veniam non.', 'Impedit odio qui vel.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('13', '37', '2', 'Enim dolore dolores veniam optio at.', 'Tenetur et quia laudantium.', 'Quos maiores error voluptatem enim quisquam aut.', 'Excepturi non porro aliquid enim recusandae qui.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('14', '25', '3', 'Recusandae exercitationem soluta explicabo deserunt non consequuntur laboriosam.', 'Ea aperiam rerum est dignissimos dolorem hic.', 'Qui alias dignissimos voluptatem.', 'Illum animi adipisci libero aliquam occaecati minima.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('15', '11', '1', 'Rerum in culpa veritatis minima.', 'Tempore omnis labore excepturi accusamus occaecati modi recusandae possimus.', 'Ut dolor vel vero qui.', 'Sint sed nulla quia impedit enim iure.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('16', '39', '3', 'Nostrum voluptatum possimus non quos cupiditate nam magnam qui.', 'Voluptatem sed in ut expedita dolorem id.', 'Sapiente eos minima recusandae voluptatem.', 'Fugiat reiciendis non labore in et.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('17', '1', '2', 'Deserunt distinctio quis sint consequatur quod repudiandae.', 'Totam harum at quod ullam quaerat quod eum.', 'Aperiam maxime quas omnis dolore officiis et est exercitationem.', 'Laudantium deleniti laboriosam veritatis voluptate pariatur sequi amet.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('18', '38', '2', 'Qui quia repudiandae voluptatum.', 'Quis dolorum porro minima est necessitatibus facilis.', 'Quibusdam et quo atque consequuntur porro dignissimos omnis nostrum.', 'Ad suscipit amet et laboriosam dolorem.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('19', '5', '3', 'Molestiae voluptas eius itaque quisquam doloremque.', 'Quod voluptatem voluptatem sequi quidem.', 'Rerum qui voluptatibus ad nisi id.', 'Ea veniam omnis non voluptatem.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');
INSERT INTO `messages_tips` VALUES ('20', '26', '3', 'Ut error similique saepe qui.', 'Nihil fugit officia fuga qui.', 'Est rerum voluptates aspernatur officia quisquam.', 'Molestiae molestias dolorum cum placeat nemo.', 'Temp(file_id message)', '2017-07-22 12:31:32', '2017-07-22 12:31:32');

-- ----------------------------
-- Table structure for messages_trophy_setting
-- ----------------------------
DROP TABLE IF EXISTS `messages_trophy_setting`;
CREATE TABLE `messages_trophy_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trophy_setting_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of messages_trophy_setting
-- ----------------------------
INSERT INTO `messages_trophy_setting` VALUES ('1', '21', '1', 'Vel voluptate aliquid sunt.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('2', '8', '1', 'Dolorum ipsum odit animi.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('3', '73', '3', 'Temporibus aut dolorem aut rerum molestiae aut.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('4', '96', '2', 'Et magnam qui est hic ut et.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('5', '79', '1', 'Debitis vitae molestias magni consequatur unde.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('6', '93', '3', 'Saepe perferendis laborum in nisi.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('7', '53', '1', 'Qui maxime cupiditate in dolor velit.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('8', '74', '1', 'Qui unde totam vero architecto vitae.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('9', '41', '2', 'Voluptatem qui libero deleniti tempore.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('10', '60', '2', 'Aut eum est minima magni aut sed.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('11', '83', '1', 'Repudiandae est et velit.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('12', '63', '2', 'Est sint expedita est aliquid nihil dolor.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('13', '84', '2', 'Doloribus nulla eos ad dolorem cumque ut.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('14', '48', '1', 'A voluptatem ea ea aut ratione aut quis.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('15', '82', '2', 'Libero mollitia magnam est qui officiis ea ut.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('16', '33', '2', 'Ab consequatur est hic enim.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('17', '1', '2', 'Aut eos dolorem hic eum quia.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('18', '57', '2', 'Et eveniet tenetur architecto.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('19', '6', '2', 'Id dolores vel ex illum.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('20', '22', '2', 'Fuga saepe quasi officiis omnis voluptas esse.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('21', '10', '3', 'Et commodi mollitia sapiente cupiditate non.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('22', '72', '2', 'Neque non cumque dolores ad.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('23', '51', '2', 'Accusantium quo consequuntur repellendus earum.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('24', '39', '3', 'Neque eius quos quae ut est voluptatem.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('25', '37', '3', 'Commodi in quis placeat.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('26', '62', '2', 'Velit error est et.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('27', '1', '2', 'Ut ea laudantium omnis enim quasi aliquam.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('28', '29', '3', 'Est officia modi voluptatibus cumque.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('29', '45', '2', 'Voluptatem non quis consectetur.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('30', '1', '3', 'Quos quo accusamus minima saepe.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('31', '12', '3', 'Quo ullam ut dolorem magnam est.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('32', '85', '1', 'Eum sunt nisi dolor nihil voluptas.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('33', '38', '2', 'At magnam dicta beatae et magnam.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('34', '38', '2', 'Natus illo est aut qui aut tenetur voluptatem.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('35', '70', '1', 'Itaque amet quidem quas est eum.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('36', '87', '2', 'Voluptatem sed voluptas corporis officia quis.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('37', '74', '1', 'Natus error aspernatur tenetur.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('38', '24', '1', 'Autem magni id animi at.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('39', '48', '2', 'Vitae asperiores id labore.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('40', '65', '2', 'Illo quia voluptas voluptates incidunt quos.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('41', '5', '1', 'Autem dolore excepturi numquam eveniet.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('42', '96', '3', 'Maiores asperiores laudantium nisi culpa eos.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('43', '82', '2', 'Aut sit ipsum tenetur voluptate.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('44', '100', '2', 'Tenetur voluptates velit enim eaque quaerat.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('45', '10', '2', 'Quis tenetur et consequatur qui.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('46', '52', '2', 'Omnis dolor fuga rerum repellendus rerum.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('47', '82', '1', 'Blanditiis et veniam quibusdam occaecati impedit.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('48', '64', '2', 'Quidem aut qui sit quia eligendi et.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('49', '10', '3', 'Ut sunt non sunt ratione et voluptatum dicta.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `messages_trophy_setting` VALUES ('50', '75', '3', 'Nisi consequatur repellendus ullam.', 'Temp(file_id message)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_07_02_230147_migration_cartalyst_sentinel', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('3', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_06_22_042044_create_card_appearance_rates_table', '1');
INSERT INTO `migrations` VALUES ('5', '2017_06_22_042854_create_collections_table', '1');
INSERT INTO `migrations` VALUES ('6', '2017_06_22_060602_create_projects_table', '1');
INSERT INTO `migrations` VALUES ('7', '2017_06_22_070301_create_grades_table', '1');
INSERT INTO `migrations` VALUES ('8', '2017_06_22_071849_create_tips_table', '1');
INSERT INTO `migrations` VALUES ('9', '2017_06_22_073618_create_big_tests_table', '1');
INSERT INTO `migrations` VALUES ('10', '2017_06_22_074452_create_grade_names_table', '1');
INSERT INTO `migrations` VALUES ('11', '2017_06_22_075129_create_versions_table', '1');
INSERT INTO `migrations` VALUES ('12', '2017_06_22_081551_create_chapters_table', '1');
INSERT INTO `migrations` VALUES ('13', '2017_06_22_082159_create_messages_big_test_table', '1');
INSERT INTO `migrations` VALUES ('14', '2017_06_22_082805_create_small_tests_table', '1');
INSERT INTO `migrations` VALUES ('15', '2017_06_22_084529_create_small_test_questions_table', '1');
INSERT INTO `migrations` VALUES ('16', '2017_06_22_090605_create_messages_small_test_table', '1');
INSERT INTO `migrations` VALUES ('17', '2017_06_25_102027_create_messages_tips_table', '1');
INSERT INTO `migrations` VALUES ('18', '2017_06_25_112141_create_small_test_question_choices_table', '1');
INSERT INTO `migrations` VALUES ('19', '2017_06_25_114458_create_small_test_question_problems_table', '1');
INSERT INTO `migrations` VALUES ('20', '2017_06_25_120014_create_chapter_names_table', '1');
INSERT INTO `migrations` VALUES ('21', '2017_06_25_120718_create_comas_table', '1');
INSERT INTO `migrations` VALUES ('22', '2017_06_25_121536_create_coma_categories_table', '1');
INSERT INTO `migrations` VALUES ('23', '2017_06_25_122509_create_coma_languages_table', '1');
INSERT INTO `migrations` VALUES ('24', '2017_06_25_130955_create_logs_small_test_table', '1');
INSERT INTO `migrations` VALUES ('25', '2017_06_28_090657_create_languages_table', '1');
INSERT INTO `migrations` VALUES ('26', '2017_06_28_090946_create_logs_big_test__table', '1');
INSERT INTO `migrations` VALUES ('27', '2017_06_28_091126_create_logs_tips_table', '1');
INSERT INTO `migrations` VALUES ('28', '2017_06_28_091543_create_logs_login_table', '1');
INSERT INTO `migrations` VALUES ('29', '2017_06_28_092958_create_possession_collections_table', '1');
INSERT INTO `migrations` VALUES ('30', '2017_06_28_093121_create_my_background_pages_table', '1');
INSERT INTO `migrations` VALUES ('31', '2017_06_28_093243_create_possession_certificates_table', '1');
INSERT INTO `migrations` VALUES ('32', '2017_06_28_093359_create_bookmarks__table', '1');
INSERT INTO `migrations` VALUES ('33', '2017_06_28_093531_create_chat_tools_table', '1');
INSERT INTO `migrations` VALUES ('34', '2017_06_28_093657_create_user_transmission_history_table', '1');
INSERT INTO `migrations` VALUES ('35', '2017_06_28_093814_create_certificates_table', '1');
INSERT INTO `migrations` VALUES ('36', '2017_06_28_093947_create_administrator_transmission_history_table', '1');
INSERT INTO `migrations` VALUES ('37', '2017_06_28_094125_create_professions_table', '1');
INSERT INTO `migrations` VALUES ('38', '2017_06_28_094225_create_areas_table', '1');
INSERT INTO `migrations` VALUES ('39', '2017_06_28_094357_create_announcements_table', '1');
INSERT INTO `migrations` VALUES ('40', '2017_06_28_094506_create_ads_table', '1');
INSERT INTO `migrations` VALUES ('41', '2017_06_28_094616_create_ads_video_table', '1');
INSERT INTO `migrations` VALUES ('42', '2017_06_28_094907_create_possession_authorities_table', '1');
INSERT INTO `migrations` VALUES ('43', '2017_06_28_095024_create_authorities_table', '1');
INSERT INTO `migrations` VALUES ('44', '2017_06_28_095144_create_guides_table', '1');
INSERT INTO `migrations` VALUES ('45', '2017_06_28_095301_create_terms_table', '1');
INSERT INTO `migrations` VALUES ('46', '2017_06_28_095358_create_notification_settings_table', '1');
INSERT INTO `migrations` VALUES ('47', '2017_06_28_095438_create_types_table', '1');
INSERT INTO `migrations` VALUES ('48', '2017_06_28_095532_create_tags_table', '1');
INSERT INTO `migrations` VALUES ('49', '2017_06_28_095615_create_makers_table', '1');
INSERT INTO `migrations` VALUES ('50', '2017_06_28_095728_create_levels_table', '1');
INSERT INTO `migrations` VALUES ('51', '2017_06_28_100754_create_logs_active_time_table', '1');
INSERT INTO `migrations` VALUES ('52', '2017_06_30_100351_create_logs_coma', '1');
INSERT INTO `migrations` VALUES ('53', '2017_07_04_104813_create_trophy_settings', '1');
INSERT INTO `migrations` VALUES ('54', '2017_07_04_105402_create_messages_trophy_setting', '1');
INSERT INTO `migrations` VALUES ('55', '2017_07_05_070421_create_trophy_ranks_table', '1');

-- ----------------------------
-- Table structure for my_background_pages
-- ----------------------------
DROP TABLE IF EXISTS `my_background_pages`;
CREATE TABLE `my_background_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `grade_id` int(10) unsigned NOT NULL,
  `image_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of my_background_pages
-- ----------------------------
INSERT INTO `my_background_pages` VALUES ('1', '52', '6', 'http://lorempixel.com/640/480/?69578', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('2', '56', '11', 'http://lorempixel.com/640/480/?45939', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('3', '65', '15', 'http://lorempixel.com/640/480/?54092', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('4', '39', '17', 'http://lorempixel.com/640/480/?59254', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('5', '22', '20', 'http://lorempixel.com/640/480/?42799', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('6', '47', '12', 'http://lorempixel.com/640/480/?54897', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('7', '42', '3', 'http://lorempixel.com/640/480/?36635', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('8', '51', '6', 'http://lorempixel.com/640/480/?77697', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('9', '70', '11', 'http://lorempixel.com/640/480/?76490', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('10', '51', '9', 'http://lorempixel.com/640/480/?55721', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('11', '37', '6', 'http://lorempixel.com/640/480/?11880', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('12', '28', '2', 'http://lorempixel.com/640/480/?23247', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('13', '44', '9', 'http://lorempixel.com/640/480/?74797', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('14', '11', '2', 'http://lorempixel.com/640/480/?31518', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('15', '71', '13', 'http://lorempixel.com/640/480/?34007', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('16', '41', '3', 'http://lorempixel.com/640/480/?76339', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('17', '13', '9', 'http://lorempixel.com/640/480/?44854', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('18', '26', '13', 'http://lorempixel.com/640/480/?79776', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('19', '22', '13', 'http://lorempixel.com/640/480/?22114', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('20', '71', '12', 'http://lorempixel.com/640/480/?23579', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('21', '35', '10', 'http://lorempixel.com/640/480/?14177', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('22', '48', '4', 'http://lorempixel.com/640/480/?76242', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('23', '17', '3', 'http://lorempixel.com/640/480/?70492', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('24', '15', '5', 'http://lorempixel.com/640/480/?92488', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('25', '17', '19', 'http://lorempixel.com/640/480/?24512', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('26', '62', '11', 'http://lorempixel.com/640/480/?81149', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('27', '35', '10', 'http://lorempixel.com/640/480/?45987', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('28', '27', '1', 'http://lorempixel.com/640/480/?62691', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('29', '30', '5', 'http://lorempixel.com/640/480/?68147', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('30', '66', '19', 'http://lorempixel.com/640/480/?94875', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('31', '17', '12', 'http://lorempixel.com/640/480/?78488', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('32', '65', '9', 'http://lorempixel.com/640/480/?73816', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('33', '100', '11', 'http://lorempixel.com/640/480/?38558', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('34', '68', '8', 'http://lorempixel.com/640/480/?67154', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('35', '18', '7', 'http://lorempixel.com/640/480/?72372', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('36', '8', '10', 'http://lorempixel.com/640/480/?26828', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('37', '68', '8', 'http://lorempixel.com/640/480/?57070', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('38', '97', '8', 'http://lorempixel.com/640/480/?42357', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('39', '5', '8', 'http://lorempixel.com/640/480/?64175', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('40', '15', '9', 'http://lorempixel.com/640/480/?97673', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('41', '25', '14', 'http://lorempixel.com/640/480/?32633', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('42', '85', '5', 'http://lorempixel.com/640/480/?60068', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('43', '3', '8', 'http://lorempixel.com/640/480/?31371', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('44', '78', '4', 'http://lorempixel.com/640/480/?22585', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('45', '97', '11', 'http://lorempixel.com/640/480/?49935', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('46', '96', '10', 'http://lorempixel.com/640/480/?71463', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('47', '31', '3', 'http://lorempixel.com/640/480/?10057', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('48', '1', '16', 'http://lorempixel.com/640/480/?72389', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('49', '94', '11', 'http://lorempixel.com/640/480/?54530', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('50', '62', '17', 'http://lorempixel.com/640/480/?31199', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('51', '93', '19', 'http://lorempixel.com/640/480/?42315', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('52', '50', '12', 'http://lorempixel.com/640/480/?94191', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('53', '24', '2', 'http://lorempixel.com/640/480/?86270', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('54', '77', '9', 'http://lorempixel.com/640/480/?49837', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('55', '61', '3', 'http://lorempixel.com/640/480/?26760', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('56', '70', '11', 'http://lorempixel.com/640/480/?67331', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('57', '33', '12', 'http://lorempixel.com/640/480/?57965', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('58', '26', '5', 'http://lorempixel.com/640/480/?45241', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('59', '74', '19', 'http://lorempixel.com/640/480/?17672', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('60', '24', '12', 'http://lorempixel.com/640/480/?77550', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('61', '11', '17', 'http://lorempixel.com/640/480/?52384', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('62', '27', '9', 'http://lorempixel.com/640/480/?13252', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('63', '41', '18', 'http://lorempixel.com/640/480/?23270', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('64', '13', '7', 'http://lorempixel.com/640/480/?54754', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('65', '64', '9', 'http://lorempixel.com/640/480/?66064', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('66', '98', '8', 'http://lorempixel.com/640/480/?71935', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('67', '58', '10', 'http://lorempixel.com/640/480/?14680', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('68', '63', '7', 'http://lorempixel.com/640/480/?90234', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('69', '15', '3', 'http://lorempixel.com/640/480/?69256', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('70', '59', '13', 'http://lorempixel.com/640/480/?60475', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('71', '2', '11', 'http://lorempixel.com/640/480/?81449', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('72', '64', '3', 'http://lorempixel.com/640/480/?44157', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('73', '36', '16', 'http://lorempixel.com/640/480/?78267', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('74', '22', '17', 'http://lorempixel.com/640/480/?79008', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('75', '12', '9', 'http://lorempixel.com/640/480/?49751', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('76', '75', '17', 'http://lorempixel.com/640/480/?45562', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('77', '21', '2', 'http://lorempixel.com/640/480/?47187', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('78', '59', '11', 'http://lorempixel.com/640/480/?58467', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('79', '89', '19', 'http://lorempixel.com/640/480/?87165', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('80', '98', '11', 'http://lorempixel.com/640/480/?49815', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('81', '59', '9', 'http://lorempixel.com/640/480/?71991', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('82', '6', '6', 'http://lorempixel.com/640/480/?94257', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('83', '95', '11', 'http://lorempixel.com/640/480/?72258', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('84', '93', '2', 'http://lorempixel.com/640/480/?82754', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('85', '52', '11', 'http://lorempixel.com/640/480/?60654', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('86', '73', '3', 'http://lorempixel.com/640/480/?71352', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('87', '23', '14', 'http://lorempixel.com/640/480/?32155', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('88', '85', '18', 'http://lorempixel.com/640/480/?57288', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('89', '27', '10', 'http://lorempixel.com/640/480/?69660', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('90', '10', '1', 'http://lorempixel.com/640/480/?90089', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('91', '12', '15', 'http://lorempixel.com/640/480/?95787', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('92', '66', '19', 'http://lorempixel.com/640/480/?53377', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('93', '26', '18', 'http://lorempixel.com/640/480/?39069', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('94', '34', '4', 'http://lorempixel.com/640/480/?28827', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('95', '82', '4', 'http://lorempixel.com/640/480/?48268', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('96', '28', '9', 'http://lorempixel.com/640/480/?89308', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('97', '49', '1', 'http://lorempixel.com/640/480/?86342', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('98', '54', '13', 'http://lorempixel.com/640/480/?63628', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('99', '51', '6', 'http://lorempixel.com/640/480/?17679', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `my_background_pages` VALUES ('100', '46', '14', 'http://lorempixel.com/640/480/?52901', '2017-07-22 12:31:24', '2017-07-22 12:31:24');

-- ----------------------------
-- Table structure for notification_settings
-- ----------------------------
DROP TABLE IF EXISTS `notification_settings`;
CREATE TABLE `notification_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` tinyint(3) unsigned NOT NULL,
  `notification_1_term` smallint(5) unsigned NOT NULL,
  `notification_1_setting` tinyint(1) NOT NULL,
  `notification_1_description` text COLLATE utf8_unicode_ci NOT NULL,
  `notification_2_term` smallint(5) unsigned NOT NULL,
  `notification_2_description` text COLLATE utf8_unicode_ci NOT NULL,
  `notification_2_setting` tinyint(1) NOT NULL,
  `notification_3_term` smallint(5) unsigned NOT NULL,
  `notification_3_description` text COLLATE utf8_unicode_ci NOT NULL,
  `notification_3_setting` tinyint(1) NOT NULL,
  `notification_4_term` smallint(5) unsigned NOT NULL,
  `notification_4_description` text COLLATE utf8_unicode_ci NOT NULL,
  `notification_4_setting` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notification_settings
-- ----------------------------
INSERT INTO `notification_settings` VALUES ('1', '3', '42', '0', 'Eos quo ipsam neque.', '71', 'A sed aut dolor dolorum odit.', '0', '9', 'Rem et minus hic non.', '1', '49', 'Nulla ut et voluptatem.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('2', '1', '71', '1', 'Eum nam omnis qui nobis.', '83', 'Rem rerum atque ut ut.', '0', '38', 'Architecto nobis quia ea.', '1', '16', 'Dolore sint debitis ut.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('3', '2', '2', '0', 'Ut iste et nisi.', '83', 'Fuga vel tempore corrupti.', '0', '53', 'Enim et ex similique laborum.', '0', '83', 'Sunt et aut corrupti et.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('4', '2', '34', '1', 'Assumenda eaque eaque id hic.', '2', 'Occaecati quia rem enim ut.', '1', '56', 'Itaque ut ratione aut aut.', '1', '30', 'Sed assumenda dolor sunt ab.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('5', '2', '75', '0', 'Ullam ea assumenda aperiam.', '46', 'Iusto quo nihil nostrum.', '0', '15', 'Perferendis ut et eligendi.', '1', '69', 'Unde dolorem quis nisi est.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('6', '1', '68', '1', 'Enim ut ducimus rerum beatae.', '74', 'Esse error ducimus dolorem.', '1', '99', 'Et soluta in molestias.', '0', '59', 'Maxime quam sit maxime minus.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('7', '1', '7', '0', 'Qui iure occaecati omnis ut.', '7', 'Voluptas delectus nemo a.', '0', '96', 'Et et at esse nulla voluptas.', '1', '13', 'Repellendus non suscipit non.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('8', '3', '1', '1', 'Vel id adipisci unde ea.', '3', 'Et aut aut est non et.', '0', '68', 'Nihil sit et at ex facere.', '0', '93', 'Est aut qui saepe.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('9', '1', '58', '0', 'Quis iusto quis ea.', '51', 'Quaerat a soluta aut.', '0', '2', 'Quo officia aut veritatis.', '1', '23', 'Non qui et qui.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('10', '2', '28', '0', 'Et in consequatur eum eos et.', '60', 'Cumque nam quaerat iste non.', '0', '62', 'Qui esse eos et.', '1', '73', 'Atque ipsum cum a deserunt.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('11', '1', '68', '1', 'Ipsa sequi consequatur in.', '46', 'Et ut nam esse.', '1', '70', 'Reprehenderit ipsum et et.', '1', '93', 'Est est officiis qui magni.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('12', '2', '52', '0', 'Est quaerat sit quia tempore.', '56', 'Labore placeat iste iste.', '0', '35', 'Dolores optio veniam quam id.', '0', '56', 'Aut qui autem qui error.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('13', '1', '3', '1', 'Quod error non deleniti.', '5', 'Quas ab ullam sit.', '1', '75', 'Minima aut sunt est quisquam.', '0', '39', 'Eum et et odit quod ullam.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('14', '3', '86', '1', 'Id voluptatem in veritatis.', '51', 'Atque aut qui ut error.', '1', '65', 'Fugiat velit ea natus.', '0', '49', 'Sit dolor corporis ullam.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('15', '2', '18', '1', 'Iusto et totam quae minima.', '72', 'Eveniet omnis aut ipsa saepe.', '1', '53', 'Et quam optio dicta ea aut.', '1', '51', 'Eaque velit laborum ex.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('16', '2', '36', '0', 'Molestias rerum amet enim.', '35', 'Harum laudantium impedit cum.', '1', '21', 'Sunt autem dolores ut omnis.', '0', '1', 'Ea magni fuga at numquam.', '0', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('17', '1', '76', '1', 'Aut assumenda ab enim.', '63', 'Dolorem unde rerum nostrum.', '0', '75', 'Commodi dolores commodi illo.', '1', '98', 'Corrupti sed aliquam et.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('18', '3', '88', '0', 'Et aut tempora quae illo aut.', '88', 'Ad sapiente soluta vel.', '1', '64', 'Velit ratione dolor unde et.', '1', '0', 'Cum temporibus magni et.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('19', '2', '0', '0', 'Quasi non a at voluptatem.', '22', 'Ab modi a consequuntur sint.', '1', '69', 'Qui harum et ea qui ratione.', '0', '9', 'Nobis suscipit ut ab quos.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `notification_settings` VALUES ('20', '1', '32', '1', 'A tenetur culpa sed nesciunt.', '30', 'Esse quia nostrum pariatur.', '1', '21', 'Nostrum vel qui perspiciatis.', '1', '93', 'Et ipsam velit est et.', '1', '2017-07-22 12:31:46', '2017-07-22 12:31:46');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for persistences
-- ----------------------------
DROP TABLE IF EXISTS `persistences`;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of persistences
-- ----------------------------

-- ----------------------------
-- Table structure for possession_authorities
-- ----------------------------
DROP TABLE IF EXISTS `possession_authorities`;
CREATE TABLE `possession_authorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `authority_id` int(10) unsigned NOT NULL,
  `authority_available` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of possession_authorities
-- ----------------------------

-- ----------------------------
-- Table structure for possession_certificates
-- ----------------------------
DROP TABLE IF EXISTS `possession_certificates`;
CREATE TABLE `possession_certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `certificate_id` int(10) unsigned NOT NULL,
  `issue_date` datetime NOT NULL,
  `photo_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of possession_certificates
-- ----------------------------
INSERT INTO `possession_certificates` VALUES ('1', '86', '48', '2001-01-06 00:00:00', 'http://lorempixel.com/225/300/?56550', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('2', '26', '30', '2002-02-15 00:00:00', 'http://lorempixel.com/225/300/?58034', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('3', '31', '9', '1970-12-02 00:00:00', 'http://lorempixel.com/225/300/?59723', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('4', '8', '16', '1987-01-30 00:00:00', 'http://lorempixel.com/225/300/?12186', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('5', '77', '41', '2015-11-15 00:00:00', 'http://lorempixel.com/225/300/?90503', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('6', '37', '55', '2010-11-28 00:00:00', 'http://lorempixel.com/225/300/?58119', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('7', '54', '66', '2017-04-30 00:00:00', 'http://lorempixel.com/225/300/?90886', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('8', '90', '21', '1990-04-23 00:00:00', 'http://lorempixel.com/225/300/?62901', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('9', '22', '64', '2015-03-16 00:00:00', 'http://lorempixel.com/225/300/?51724', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('10', '35', '63', '1992-09-17 00:00:00', 'http://lorempixel.com/225/300/?46435', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('11', '69', '67', '1994-10-14 00:00:00', 'http://lorempixel.com/225/300/?33088', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('12', '67', '18', '1973-09-11 00:00:00', 'http://lorempixel.com/225/300/?90235', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('13', '59', '56', '1977-03-28 00:00:00', 'http://lorempixel.com/225/300/?47884', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('14', '34', '36', '1982-09-06 00:00:00', 'http://lorempixel.com/225/300/?83749', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('15', '27', '13', '1993-06-11 00:00:00', 'http://lorempixel.com/225/300/?85543', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('16', '25', '72', '1993-10-06 00:00:00', 'http://lorempixel.com/225/300/?53282', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('17', '24', '78', '1991-05-16 00:00:00', 'http://lorempixel.com/225/300/?21591', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('18', '98', '18', '1971-05-25 00:00:00', 'http://lorempixel.com/225/300/?24044', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('19', '1', '72', '1997-08-19 00:00:00', 'http://lorempixel.com/225/300/?47981', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('20', '11', '34', '1977-11-25 00:00:00', 'http://lorempixel.com/225/300/?56725', '2017-07-22 12:31:34', '2017-07-22 12:31:34');
INSERT INTO `possession_certificates` VALUES ('21', '3', '20', '2003-05-08 00:00:00', 'http://lorempixel.com/225/300/?64821', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('22', '79', '44', '1984-10-22 00:00:00', 'http://lorempixel.com/225/300/?63171', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('23', '32', '11', '1976-06-24 00:00:00', 'http://lorempixel.com/225/300/?64408', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('24', '82', '73', '1990-02-23 00:00:00', 'http://lorempixel.com/225/300/?84013', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('25', '17', '84', '1981-12-17 00:00:00', 'http://lorempixel.com/225/300/?97592', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('26', '99', '53', '1997-06-19 00:00:00', 'http://lorempixel.com/225/300/?13329', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('27', '88', '24', '2014-05-09 00:00:00', 'http://lorempixel.com/225/300/?32020', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('28', '98', '63', '1983-02-25 00:00:00', 'http://lorempixel.com/225/300/?54687', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('29', '29', '37', '1993-08-28 00:00:00', 'http://lorempixel.com/225/300/?23648', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('30', '5', '82', '1987-10-28 00:00:00', 'http://lorempixel.com/225/300/?77331', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('31', '26', '23', '2013-12-20 00:00:00', 'http://lorempixel.com/225/300/?42201', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('32', '78', '35', '2016-07-14 00:00:00', 'http://lorempixel.com/225/300/?82030', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('33', '36', '66', '1971-11-06 00:00:00', 'http://lorempixel.com/225/300/?11917', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('34', '85', '61', '1986-04-23 00:00:00', 'http://lorempixel.com/225/300/?11624', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('35', '35', '58', '1997-05-24 00:00:00', 'http://lorempixel.com/225/300/?32251', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('36', '21', '8', '1996-09-25 00:00:00', 'http://lorempixel.com/225/300/?42655', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('37', '93', '72', '1974-05-07 00:00:00', 'http://lorempixel.com/225/300/?50661', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('38', '67', '47', '2000-09-07 00:00:00', 'http://lorempixel.com/225/300/?36646', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('39', '77', '40', '1988-02-18 00:00:00', 'http://lorempixel.com/225/300/?76838', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('40', '55', '100', '2002-12-07 00:00:00', 'http://lorempixel.com/225/300/?36801', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('41', '7', '24', '2013-07-05 00:00:00', 'http://lorempixel.com/225/300/?25629', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('42', '40', '78', '2003-10-28 00:00:00', 'http://lorempixel.com/225/300/?50442', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('43', '9', '43', '1980-03-14 00:00:00', 'http://lorempixel.com/225/300/?95906', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('44', '14', '59', '2007-12-17 00:00:00', 'http://lorempixel.com/225/300/?22915', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('45', '20', '14', '1972-09-03 00:00:00', 'http://lorempixel.com/225/300/?60430', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('46', '24', '63', '2012-05-29 00:00:00', 'http://lorempixel.com/225/300/?70127', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('47', '64', '18', '1991-11-03 00:00:00', 'http://lorempixel.com/225/300/?77837', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('48', '51', '80', '1980-11-17 00:00:00', 'http://lorempixel.com/225/300/?17030', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('49', '7', '10', '1973-01-07 00:00:00', 'http://lorempixel.com/225/300/?90911', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('50', '36', '31', '2012-11-04 00:00:00', 'http://lorempixel.com/225/300/?95365', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('51', '71', '88', '1970-09-15 00:00:00', 'http://lorempixel.com/225/300/?21324', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('52', '28', '48', '1992-03-31 00:00:00', 'http://lorempixel.com/225/300/?22854', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('53', '67', '72', '1973-10-18 00:00:00', 'http://lorempixel.com/225/300/?76491', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('54', '86', '57', '1999-04-14 00:00:00', 'http://lorempixel.com/225/300/?84978', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('55', '98', '76', '2009-08-07 00:00:00', 'http://lorempixel.com/225/300/?30261', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('56', '55', '90', '1974-03-31 00:00:00', 'http://lorempixel.com/225/300/?88845', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('57', '39', '69', '2007-10-03 00:00:00', 'http://lorempixel.com/225/300/?84606', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('58', '18', '82', '2002-07-11 00:00:00', 'http://lorempixel.com/225/300/?77961', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('59', '66', '26', '1993-01-08 00:00:00', 'http://lorempixel.com/225/300/?17404', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('60', '48', '97', '1989-07-21 00:00:00', 'http://lorempixel.com/225/300/?60778', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('61', '87', '25', '2012-12-26 00:00:00', 'http://lorempixel.com/225/300/?29858', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('62', '3', '78', '2006-01-05 00:00:00', 'http://lorempixel.com/225/300/?11664', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('63', '43', '43', '1986-02-17 00:00:00', 'http://lorempixel.com/225/300/?31787', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('64', '6', '76', '1999-12-04 00:00:00', 'http://lorempixel.com/225/300/?23824', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('65', '72', '4', '2001-01-22 00:00:00', 'http://lorempixel.com/225/300/?96640', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('66', '10', '37', '2005-05-30 00:00:00', 'http://lorempixel.com/225/300/?42830', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('67', '74', '5', '1981-11-23 00:00:00', 'http://lorempixel.com/225/300/?69775', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('68', '87', '56', '2006-12-05 00:00:00', 'http://lorempixel.com/225/300/?91246', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('69', '1', '37', '2015-04-15 00:00:00', 'http://lorempixel.com/225/300/?21710', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('70', '60', '3', '1974-09-01 00:00:00', 'http://lorempixel.com/225/300/?15702', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('71', '22', '82', '2000-11-10 00:00:00', 'http://lorempixel.com/225/300/?73009', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('72', '40', '12', '2014-02-21 00:00:00', 'http://lorempixel.com/225/300/?62171', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('73', '6', '23', '1973-07-27 00:00:00', 'http://lorempixel.com/225/300/?59066', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('74', '75', '75', '1984-01-17 00:00:00', 'http://lorempixel.com/225/300/?19590', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('75', '26', '70', '1983-11-07 00:00:00', 'http://lorempixel.com/225/300/?21594', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('76', '91', '65', '1994-12-10 00:00:00', 'http://lorempixel.com/225/300/?38462', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('77', '67', '68', '2005-10-30 00:00:00', 'http://lorempixel.com/225/300/?30326', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('78', '66', '3', '1977-08-05 00:00:00', 'http://lorempixel.com/225/300/?38451', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('79', '8', '39', '1982-02-07 00:00:00', 'http://lorempixel.com/225/300/?36016', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('80', '28', '32', '2003-07-07 00:00:00', 'http://lorempixel.com/225/300/?21802', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('81', '68', '57', '1993-03-27 00:00:00', 'http://lorempixel.com/225/300/?33289', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('82', '9', '57', '2012-12-09 00:00:00', 'http://lorempixel.com/225/300/?24994', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('83', '18', '31', '1975-01-10 00:00:00', 'http://lorempixel.com/225/300/?60267', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('84', '53', '71', '1982-12-01 00:00:00', 'http://lorempixel.com/225/300/?52280', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('85', '42', '90', '2016-04-13 00:00:00', 'http://lorempixel.com/225/300/?40530', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('86', '71', '9', '2004-03-23 00:00:00', 'http://lorempixel.com/225/300/?58628', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('87', '86', '23', '2006-02-16 00:00:00', 'http://lorempixel.com/225/300/?99685', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('88', '99', '87', '1979-08-15 00:00:00', 'http://lorempixel.com/225/300/?63485', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('89', '36', '69', '2010-04-18 00:00:00', 'http://lorempixel.com/225/300/?73434', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('90', '70', '54', '1973-07-30 00:00:00', 'http://lorempixel.com/225/300/?46638', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('91', '7', '40', '2008-04-18 00:00:00', 'http://lorempixel.com/225/300/?55831', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('92', '85', '59', '2011-10-21 00:00:00', 'http://lorempixel.com/225/300/?90418', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('93', '18', '77', '1998-02-26 00:00:00', 'http://lorempixel.com/225/300/?55980', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('94', '94', '21', '1979-04-06 00:00:00', 'http://lorempixel.com/225/300/?79015', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('95', '65', '51', '1970-06-30 00:00:00', 'http://lorempixel.com/225/300/?26022', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('96', '57', '62', '2008-09-21 00:00:00', 'http://lorempixel.com/225/300/?74496', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('97', '60', '95', '2002-02-28 00:00:00', 'http://lorempixel.com/225/300/?59983', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('98', '15', '12', '2007-09-03 00:00:00', 'http://lorempixel.com/225/300/?98376', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('99', '72', '82', '2010-09-08 00:00:00', 'http://lorempixel.com/225/300/?80745', '2017-07-22 12:31:35', '2017-07-22 12:31:35');
INSERT INTO `possession_certificates` VALUES ('100', '70', '8', '1996-01-30 00:00:00', 'http://lorempixel.com/225/300/?65706', '2017-07-22 12:31:35', '2017-07-22 12:31:35');

-- ----------------------------
-- Table structure for possession_collections
-- ----------------------------
DROP TABLE IF EXISTS `possession_collections`;
CREATE TABLE `possession_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `collection_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of possession_collections
-- ----------------------------
INSERT INTO `possession_collections` VALUES ('1', '54', '23', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('2', '98', '32', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('3', '45', '93', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('4', '31', '94', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('5', '20', '81', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('6', '46', '26', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('7', '82', '61', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('8', '67', '50', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('9', '2', '97', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('10', '84', '56', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('11', '89', '24', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('12', '83', '73', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('13', '7', '57', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('14', '18', '73', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('15', '36', '23', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('16', '15', '34', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('17', '1', '23', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('18', '83', '98', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('19', '33', '99', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('20', '84', '50', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('21', '35', '96', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('22', '21', '75', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('23', '72', '91', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('24', '36', '65', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('25', '25', '7', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('26', '85', '52', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('27', '75', '42', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('28', '94', '50', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('29', '53', '60', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('30', '40', '97', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('31', '20', '99', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('32', '70', '78', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('33', '1', '26', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('34', '17', '46', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('35', '10', '67', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('36', '42', '29', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('37', '40', '88', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('38', '17', '17', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('39', '91', '2', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('40', '13', '39', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('41', '76', '63', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('42', '16', '37', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('43', '66', '77', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('44', '75', '23', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('45', '33', '45', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('46', '9', '10', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('47', '67', '92', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('48', '21', '45', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('49', '31', '54', '2017-07-22 12:31:33', '2017-07-22 12:31:33');
INSERT INTO `possession_collections` VALUES ('50', '48', '50', '2017-07-22 12:31:33', '2017-07-22 12:31:33');

-- ----------------------------
-- Table structure for professions
-- ----------------------------
DROP TABLE IF EXISTS `professions`;
CREATE TABLE `professions` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `profession` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of professions
-- ----------------------------
INSERT INTO `professions` VALUES ('1', '公務員', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('2', '経営者・役員', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('3', '会社員', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('4', '自営業', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('5', '自由業', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('6', '専業主婦', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('7', 'パート・アルバイト', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('8', '学生', '2017-07-22 12:31:12', null);
INSERT INTO `professions` VALUES ('9', 'その他', '2017-07-22 12:31:12', null);

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `has_advertisement` tinyint(1) NOT NULL,
  `image_animation_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES ('1', '0', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('2', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('3', '0', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('4', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('5', '0', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('6', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('7', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('8', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('9', '1', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('10', '0', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('11', '0', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('12', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('13', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('14', '0', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('15', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('16', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('17', '0', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('18', '0', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('19', '1', 'https://www.youtube.com/watch?v=2idPJMuqhxs', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `projects` VALUES ('20', '0', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'Temp(folder_id languages)', '2017-07-22 12:31:23', '2017-07-22 12:31:23');

-- ----------------------------
-- Table structure for reminders
-- ----------------------------
DROP TABLE IF EXISTS `reminders`;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reminders
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'account_management', 'アカウント管理', '[\"account.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('2', 'master_management', 'マスター管理', '[\"master.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('3', 'access_management', 'ユーザ管理', '[\"access_analysis.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('4', 'content_management', 'コンテンツ管理', '[\"content.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('5', 'collection_management', 'コレクション管理', '[\"collection.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('6', 'user_management', 'ユーザ管理', '[\"user.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('7', 'notification', 'お知らせ', '[\"notification.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `roles` VALUES ('8', 'terms_of_service', '利用規約', '[\"terms_of_service.admin\"]', '2017-07-22 12:31:12', '2017-07-22 12:31:12');

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_users
-- ----------------------------
INSERT INTO `role_users` VALUES ('1', '1', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `role_users` VALUES ('2', '2', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `role_users` VALUES ('3', '3', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `role_users` VALUES ('4', '4', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `role_users` VALUES ('5', '5', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `role_users` VALUES ('6', '6', '2017-07-22 12:31:12', '2017-07-22 12:31:12');
INSERT INTO `role_users` VALUES ('7', '7', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('8', '8', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '1', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '2', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '3', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '4', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '5', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '6', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '7', '2017-07-22 12:31:13', '2017-07-22 12:31:13');
INSERT INTO `role_users` VALUES ('9', '8', '2017-07-22 12:31:13', '2017-07-22 12:31:13');

-- ----------------------------
-- Table structure for small_tests
-- ----------------------------
DROP TABLE IF EXISTS `small_tests`;
CREATE TABLE `small_tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chapter_id` int(10) unsigned NOT NULL,
  `num_issues` tinyint(3) unsigned NOT NULL,
  `pass_score_rate` tinyint(3) unsigned NOT NULL,
  `question_format` tinyint(1) NOT NULL,
  `option_display_format` tinyint(1) NOT NULL,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of small_tests
-- ----------------------------
INSERT INTO `small_tests` VALUES ('1', '49', '14', '39', '1', '0', '1', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('2', '17', '10', '73', '0', '1', '2', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('3', '39', '13', '67', '0', '1', '3', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('4', '32', '13', '56', '0', '0', '4', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('5', '3', '14', '64', '1', '0', '5', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('6', '28', '6', '93', '1', '0', '6', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('7', '45', '15', '94', '1', '0', '7', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('8', '50', '17', '55', '0', '1', '8', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('9', '25', '19', '55', '0', '1', '9', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('10', '8', '7', '0', '0', '0', '10', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('11', '25', '18', '60', '1', '1', '11', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('12', '14', '14', '25', '1', '1', '12', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('13', '47', '16', '36', '1', '0', '13', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('14', '41', '18', '1', '0', '1', '14', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('15', '11', '10', '61', '1', '1', '15', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('16', '39', '14', '74', '0', '1', '16', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('17', '35', '8', '96', '0', '0', '17', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('18', '16', '15', '24', '1', '1', '18', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('19', '14', '17', '45', '0', '1', '19', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('20', '28', '10', '7', '0', '1', '20', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('21', '25', '15', '97', '1', '1', '21', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('22', '24', '8', '4', '1', '0', '22', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('23', '3', '5', '35', '1', '1', '23', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('24', '24', '17', '47', '0', '1', '24', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('25', '34', '15', '43', '1', '0', '25', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('26', '38', '10', '44', '1', '1', '26', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('27', '38', '10', '39', '1', '0', '27', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('28', '7', '11', '20', '1', '1', '28', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('29', '41', '6', '96', '0', '0', '29', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('30', '4', '17', '64', '0', '1', '30', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('31', '29', '5', '83', '1', '0', '31', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('32', '12', '9', '18', '1', '0', '32', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('33', '19', '5', '59', '0', '0', '33', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `small_tests` VALUES ('34', '47', '5', '12', '1', '0', '34', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('35', '39', '11', '1', '1', '1', '35', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('36', '32', '9', '12', '1', '0', '36', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('37', '37', '10', '15', '1', '0', '37', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('38', '16', '5', '91', '1', '0', '38', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('39', '44', '17', '2', '1', '0', '39', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('40', '40', '11', '63', '0', '0', '40', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('41', '19', '10', '7', '1', '0', '41', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('42', '37', '7', '68', '1', '1', '42', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('43', '41', '16', '3', '1', '1', '43', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('44', '30', '6', '37', '0', '1', '44', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('45', '3', '15', '40', '1', '0', '45', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('46', '17', '12', '74', '1', '1', '46', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('47', '43', '11', '56', '0', '0', '47', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('48', '43', '8', '97', '1', '0', '48', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('49', '48', '6', '46', '1', '1', '49', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('50', '50', '6', '26', '1', '0', '50', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('51', '4', '12', '81', '0', '1', '51', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('52', '1', '19', '43', '0', '0', '52', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('53', '41', '16', '77', '0', '1', '53', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('54', '29', '9', '31', '1', '1', '54', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('55', '6', '15', '82', '1', '0', '55', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('56', '5', '17', '34', '1', '1', '56', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('57', '37', '8', '67', '1', '1', '57', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('58', '34', '14', '80', '1', '0', '58', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('59', '2', '14', '15', '1', '1', '59', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('60', '40', '19', '88', '1', '0', '60', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('61', '48', '17', '43', '1', '1', '61', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('62', '15', '20', '9', '0', '0', '62', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('63', '15', '9', '35', '1', '0', '63', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('64', '24', '15', '59', '1', '0', '64', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('65', '27', '7', '85', '0', '1', '65', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('66', '42', '13', '23', '1', '0', '66', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('67', '15', '5', '20', '0', '1', '67', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('68', '32', '16', '100', '0', '0', '68', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('69', '29', '5', '49', '1', '1', '69', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('70', '22', '6', '94', '1', '0', '70', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('71', '27', '10', '37', '0', '1', '71', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('72', '25', '19', '81', '0', '0', '72', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('73', '12', '6', '15', '0', '0', '73', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('74', '17', '16', '90', '1', '1', '74', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('75', '5', '6', '40', '0', '0', '75', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('76', '8', '15', '24', '0', '1', '76', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('77', '1', '7', '33', '1', '1', '77', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('78', '32', '16', '43', '0', '1', '78', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('79', '41', '10', '6', '0', '1', '79', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('80', '35', '7', '16', '0', '1', '80', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('81', '32', '9', '44', '0', '1', '81', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('82', '40', '20', '74', '0', '0', '82', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('83', '1', '8', '33', '0', '0', '83', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('84', '12', '7', '2', '1', '1', '84', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('85', '43', '16', '5', '0', '0', '85', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('86', '44', '5', '10', '0', '1', '86', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('87', '37', '14', '90', '1', '0', '87', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('88', '3', '17', '88', '1', '0', '88', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('89', '34', '19', '58', '0', '0', '89', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('90', '25', '10', '78', '1', '1', '90', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('91', '45', '6', '34', '1', '1', '91', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('92', '42', '13', '86', '0', '0', '92', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('93', '41', '5', '86', '1', '1', '93', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('94', '44', '6', '59', '1', '1', '94', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('95', '40', '16', '39', '0', '0', '95', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('96', '22', '19', '29', '0', '0', '96', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('97', '31', '11', '39', '1', '0', '97', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('98', '39', '9', '33', '0', '0', '98', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('99', '9', '14', '32', '0', '1', '99', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');
INSERT INTO `small_tests` VALUES ('100', '5', '7', '4', '0', '1', '100', 'Temp(file_id small test setting)', 'Temp(folder_id small test)', '2017-07-22 12:31:30', '2017-07-22 12:31:30');

-- ----------------------------
-- Table structure for small_test_questions
-- ----------------------------
DROP TABLE IF EXISTS `small_test_questions`;
CREATE TABLE `small_test_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `small_test_id` int(10) unsigned NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `question_format` tinyint(1) NOT NULL,
  `score` tinyint(3) unsigned NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of small_test_questions
-- ----------------------------
INSERT INTO `small_test_questions` VALUES ('1', '74', 'Rerum culpa deleniti nihil explicabo distinctio rem.', '0', '86', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('2', '11', 'Et possimus minima necessitatibus.', '1', '36', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('3', '100', 'Consequatur animi dolorem ipsam. Nemo suscipit quasi explicabo.', '0', '96', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('4', '20', 'Ratione quis in ut saepe rerum.', '0', '75', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('5', '52', 'Odio enim nisi error eos veniam dolores autem.', '0', '28', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('6', '50', 'Nesciunt nobis ab omnis sapiente sed saepe porro.', '1', '16', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('7', '41', 'Aliquid voluptates quis expedita velit.', '0', '46', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('8', '80', 'Similique voluptate nostrum in enim quae.', '1', '57', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('9', '59', 'Sequi ab laborum quo corrupti qui.', '1', '71', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('10', '63', 'Saepe nihil praesentium aut ut rerum corrupti.', '1', '0', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('11', '32', 'Facere alias facilis pariatur enim adipisci ut.', '1', '43', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('12', '62', 'Et quas autem dolore earum earum facere.', '1', '32', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('13', '50', 'Expedita et non dignissimos est.', '0', '21', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('14', '82', 'Ab facere illo nesciunt similique inventore non ducimus.', '1', '7', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('15', '95', 'Et molestias sint magni est debitis.', '1', '85', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('16', '28', 'Et incidunt alias et minus.', '1', '72', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('17', '32', 'Temporibus sit nesciunt quas rerum aut.', '1', '76', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('18', '45', 'Harum aliquam voluptatibus alias blanditiis est eius.', '0', '61', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('19', '19', 'Est et sed quia deserunt ipsa.', '0', '70', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('20', '76', 'Expedita quo rerum possimus quasi laborum.', '1', '74', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('21', '74', 'Neque voluptatibus et nostrum quo eum.', '0', '88', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('22', '79', 'Enim sed quod et sapiente.', '0', '38', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('23', '23', 'Id vel fugiat dolorem quidem nesciunt aut.', '1', '38', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('24', '14', 'Eum sint soluta vitae modi. Ut quia voluptatem ea vel.', '1', '44', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('25', '35', 'Explicabo aut nam laudantium ipsum accusamus.', '0', '36', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('26', '52', 'Pariatur soluta dolores nobis consequatur ipsa sequi dolores.', '0', '44', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('27', '89', 'Tempore tempore iure quod voluptatem eius numquam.', '0', '38', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('28', '25', 'Ipsa architecto voluptatibus dolor veniam eos aut.', '1', '29', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('29', '93', 'Expedita ex eos autem quam ab ipsa.', '1', '45', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('30', '58', 'Reiciendis occaecati cumque sunt.', '0', '4', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('31', '38', 'Quos qui quaerat ut ea. Quam iusto quod incidunt totam quia.', '0', '20', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('32', '89', 'Nulla consequatur tempore atque voluptatem sit.', '0', '20', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('33', '92', 'Possimus quasi ut qui rerum aut molestiae maiores nobis.', '1', '72', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('34', '45', 'Repudiandae ea in rem rem porro.', '0', '96', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('35', '90', 'Quidem distinctio quos quisquam magni officia fuga.', '0', '27', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('36', '75', 'Fugit non laborum facilis est laboriosam. Porro enim beatae at.', '0', '41', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('37', '70', 'Sunt ut dicta commodi velit quidem et.', '0', '60', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('38', '6', 'Molestiae et ad dolor placeat nulla quod. Quod quae ex ab.', '0', '13', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('39', '22', 'Non molestiae quaerat vero dolorem.', '0', '73', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('40', '79', 'Ullam rerum animi eius. Quia repellat blanditiis id quo.', '1', '60', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('41', '91', 'Et officiis dicta exercitationem eius eos et amet.', '0', '42', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('42', '99', 'Et maxime quia aut velit impedit quod debitis.', '0', '0', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('43', '22', 'Optio suscipit asperiores unde quisquam.', '1', '32', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('44', '68', 'Ea eum commodi aperiam quia et iusto.', '0', '99', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('45', '67', 'Non enim dolor consequatur officia.', '1', '40', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('46', '27', 'Dolorem voluptate unde ducimus.', '1', '40', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('47', '58', 'Sint doloribus ullam saepe porro facere assumenda.', '0', '88', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('48', '59', 'Architecto in illo adipisci iste sint non.', '0', '36', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('49', '89', 'Nobis id qui facilis sit exercitationem quia.', '0', '75', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('50', '27', 'Fuga libero odit et nostrum architecto eum voluptatum.', '0', '71', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('51', '97', 'Cumque rerum quae cum eum ipsum. Et magni at eum nobis ipsam.', '0', '60', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('52', '79', 'Sint voluptatum nostrum ipsa aut.', '1', '58', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('53', '69', 'Dignissimos fugit illum tempore repellat debitis non adipisci.', '0', '95', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('54', '31', 'Magnam quis suscipit ea aut.', '0', '1', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('55', '47', 'Porro rerum qui eius maxime officia. Alias ut omnis et aliquid.', '0', '58', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('56', '71', 'Molestias ex consequatur maiores aut vel suscipit atque.', '1', '54', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('57', '81', 'Omnis incidunt tempore labore voluptas nemo cumque.', '0', '72', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('58', '87', 'Eum perspiciatis voluptatibus vero qui omnis.', '0', '29', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('59', '76', 'Quaerat enim sint sit repellendus.', '1', '32', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('60', '60', 'Facilis rerum sunt sint qui quasi nam.', '0', '87', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('61', '30', 'Ad et quo et delectus incidunt doloribus iure.', '0', '74', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('62', '1', 'Quos rerum perspiciatis quae cumque aut.', '0', '43', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('63', '88', 'Vel iste aut et est voluptatum voluptatum nostrum.', '0', '94', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('64', '86', 'Deserunt molestiae harum deserunt dolore accusamus.', '0', '59', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('65', '1', 'Ex sed aut blanditiis dignissimos rerum.', '1', '70', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('66', '26', 'Ipsam quae cumque velit aut ut ab.', '1', '71', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('67', '3', 'Ducimus voluptate excepturi labore. Et quia et ad nesciunt.', '1', '84', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('68', '9', 'Non aut commodi id et vel dignissimos.', '0', '85', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('69', '21', 'Dolor quidem quam quo non.', '1', '54', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('70', '47', 'Commodi velit dolorum a aut aut beatae veniam tempore.', '0', '11', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('71', '85', 'Labore ipsam aut tenetur doloribus delectus nihil.', '0', '51', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('72', '69', 'Dolores beatae suscipit nihil quae distinctio harum velit.', '0', '98', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('73', '3', 'Deleniti fuga consequatur est ex quia.', '0', '38', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('74', '46', 'Sequi consequatur vero itaque et autem sit omnis aut.', '0', '59', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('75', '63', 'Quam aut rem delectus atque amet.', '0', '92', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('76', '40', 'Est velit voluptatem et. Vero sit et cupiditate aut et.', '0', '14', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('77', '72', 'Similique illo et ipsum. Consequuntur fuga laborum atque.', '0', '94', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('78', '100', 'Deleniti placeat id illum inventore omnis doloremque.', '1', '90', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('79', '76', 'Aperiam est aliquam velit illum maxime.', '0', '32', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('80', '33', 'Qui est saepe quis ut magnam.', '0', '32', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('81', '34', 'In eius beatae quis omnis omnis rerum.', '1', '96', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('82', '93', 'Doloribus repellendus et aut sed.', '0', '23', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('83', '80', 'Et odit est illo beatae id culpa.', '0', '19', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('84', '97', 'Optio qui distinctio aut delectus et.', '0', '82', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('85', '18', 'Hic rem quia ea itaque doloremque rerum dolor.', '0', '60', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('86', '51', 'Maxime mollitia non eligendi voluptatem qui doloremque rerum.', '0', '89', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('87', '75', 'Magnam necessitatibus non ex facilis rerum corporis quod.', '0', '3', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('88', '95', 'Sint sed voluptas dignissimos.', '1', '9', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('89', '59', 'Quia vitae ut hic maxime. Et odit enim reprehenderit.', '0', '55', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('90', '83', 'Iure blanditiis tempore nobis sunt et.', '0', '42', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('91', '21', 'Quod quo in esse omnis.', '1', '92', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('92', '78', 'Aut eligendi repellendus quia minima dolor sint.', '1', '41', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('93', '47', 'Maxime sunt nostrum impedit ullam deserunt maxime.', '0', '36', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('94', '77', 'Itaque qui repudiandae temporibus impedit neque.', '0', '49', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('95', '89', 'Nam id est facere eius itaque.', '0', '40', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('96', '64', 'Nihil dolore id occaecati minima.', '0', '5', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('97', '86', 'Eligendi quas qui ipsam dolorem expedita.', '1', '22', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('98', '92', 'Qui optio qui maxime quas.', '0', '47', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('99', '62', 'In rerum molestiae pariatur omnis.', '0', '86', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');
INSERT INTO `small_test_questions` VALUES ('100', '27', 'Ut temporibus dolore distinctio quo saepe repellendus enim.', '1', '41', 'Temp(file_id small test question setting)', 'Temp(folder_id small test question)', '2017-07-22 12:31:45', '2017-07-22 12:31:45');

-- ----------------------------
-- Table structure for small_test_question_choices
-- ----------------------------
DROP TABLE IF EXISTS `small_test_question_choices`;
CREATE TABLE `small_test_question_choices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `small_test_question_id` int(10) unsigned NOT NULL,
  `option_description` text COLLATE utf8_unicode_ci NOT NULL,
  `choice_no` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `option_value` tinyint(1) NOT NULL,
  `image_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `file_id_explanation` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id_setting` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of small_test_question_choices
-- ----------------------------
INSERT INTO `small_test_question_choices` VALUES ('1', '53', 'Eum dignissimos quod iusto.', '1', '1', '1', 'http://lorempixel.com/225/300/?13930', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('2', '56', 'Quaerat ut veritatis cum a omnis.', '2', '3', '0', 'http://lorempixel.com/225/300/?17355', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('3', '33', 'Aut quam molestiae fuga.', '3', '1', '0', 'http://lorempixel.com/225/300/?92766', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('4', '94', 'A voluptates nobis sit occaecati aut.', '4', '3', '0', 'http://lorempixel.com/225/300/?90521', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('5', '97', 'Sint non dolores quo cumque.', '5', '2', '1', 'http://lorempixel.com/225/300/?18281', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('6', '75', 'Mollitia laboriosam ut possimus vel.', '6', '1', '0', 'http://lorempixel.com/225/300/?90868', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('7', '91', 'Excepturi optio mollitia qui occaecati.', '7', '3', '0', 'http://lorempixel.com/225/300/?36590', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('8', '75', 'Illum explicabo id eum ea nam facilis ut.', '8', '1', '0', 'http://lorempixel.com/225/300/?96792', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('9', '44', 'Ut nostrum est ut adipisci deleniti quisquam.', '9', '1', '0', 'http://lorempixel.com/225/300/?49521', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('10', '5', 'Dignissimos quod iste et ipsa rerum dolore minus.', '10', '1', '1', 'http://lorempixel.com/225/300/?17706', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('11', '34', 'Tenetur dolor dolores voluptas nam soluta.', '11', '2', '1', 'http://lorempixel.com/225/300/?93578', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('12', '72', 'Est amet eos est nihil quia eum.', '12', '3', '0', 'http://lorempixel.com/225/300/?75831', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('13', '4', 'Rem tempora quod harum quasi labore repellendus.', '13', '3', '0', 'http://lorempixel.com/225/300/?62424', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('14', '47', 'Aliquid accusamus quod repudiandae.', '14', '1', '0', 'http://lorempixel.com/225/300/?97149', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('15', '75', 'Eaque quia similique maiores soluta.', '15', '3', '0', 'http://lorempixel.com/225/300/?52249', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('16', '40', 'Placeat quia rem cupiditate est vero veniam id.', '16', '2', '1', 'http://lorempixel.com/225/300/?40272', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('17', '98', 'Ut similique fugiat ex est sint enim quia.', '17', '3', '1', 'http://lorempixel.com/225/300/?29960', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('18', '93', 'Qui beatae neque sapiente dicta voluptate.', '18', '2', '0', 'http://lorempixel.com/225/300/?64573', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('19', '97', 'Neque aut ipsam delectus eos sit optio.', '19', '1', '0', 'http://lorempixel.com/225/300/?91918', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('20', '30', 'Eveniet dignissimos atque sequi et.', '20', '2', '0', 'http://lorempixel.com/225/300/?84760', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('21', '75', 'Repudiandae quas tenetur eligendi minima quia.', '21', '3', '1', 'http://lorempixel.com/225/300/?95529', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('22', '39', 'Ut quidem explicabo explicabo quia.', '22', '2', '1', 'http://lorempixel.com/225/300/?61223', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('23', '27', 'Velit est dolorem cumque minus.', '23', '2', '0', 'http://lorempixel.com/225/300/?25866', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('24', '80', 'Aut voluptatem sint sit esse.', '24', '1', '0', 'http://lorempixel.com/225/300/?59267', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('25', '83', 'Et id voluptatem quis nam doloribus facere.', '25', '1', '1', 'http://lorempixel.com/225/300/?17363', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('26', '27', 'Et voluptatem ut ad sequi.', '26', '2', '1', 'http://lorempixel.com/225/300/?84928', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('27', '2', 'Quis mollitia eos sed quibusdam voluptate.', '27', '1', '0', 'http://lorempixel.com/225/300/?80996', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('28', '50', 'Illum beatae ea rerum esse quia.', '28', '3', '1', 'http://lorempixel.com/225/300/?98099', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('29', '11', 'Optio at totam modi aut ipsum eum.', '29', '3', '0', 'http://lorempixel.com/225/300/?47180', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('30', '6', 'Ea quod rerum possimus.', '30', '2', '0', 'http://lorempixel.com/225/300/?73850', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('31', '90', 'Iusto molestias molestias placeat porro.', '31', '2', '1', 'http://lorempixel.com/225/300/?48393', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('32', '95', 'Tempora placeat dolorem quidem sit.', '32', '1', '1', 'http://lorempixel.com/225/300/?33895', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('33', '28', 'Aut esse eos laborum sunt ab.', '33', '1', '0', 'http://lorempixel.com/225/300/?41461', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('34', '10', 'Rem quo ipsam et itaque consequuntur iure magnam.', '34', '1', '0', 'http://lorempixel.com/225/300/?40887', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('35', '72', 'Corrupti eum asperiores quaerat facere.', '35', '3', '1', 'http://lorempixel.com/225/300/?74003', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('36', '90', 'Ab nihil enim rerum rerum.', '36', '2', '0', 'http://lorempixel.com/225/300/?27106', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('37', '45', 'Sunt atque nam et ut illum. Sint ab et fugiat.', '37', '1', '1', 'http://lorempixel.com/225/300/?40764', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('38', '27', 'Sint ducimus dolores quia quidem.', '38', '3', '1', 'http://lorempixel.com/225/300/?56599', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('39', '93', 'Perspiciatis ducimus nulla et ut veniam.', '39', '3', '1', 'http://lorempixel.com/225/300/?84910', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('40', '67', 'Sit consequatur et maiores id aliquid qui.', '40', '2', '0', 'http://lorempixel.com/225/300/?63023', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('41', '27', 'Qui cum occaecati magnam labore eligendi.', '41', '1', '1', 'http://lorempixel.com/225/300/?69467', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('42', '48', 'Consectetur distinctio et eius.', '42', '1', '0', 'http://lorempixel.com/225/300/?34407', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('43', '99', 'Quam iusto aspernatur ipsam magni nihil.', '43', '3', '1', 'http://lorempixel.com/225/300/?44184', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('44', '2', 'Rem qui minima et nemo velit deleniti.', '44', '2', '1', 'http://lorempixel.com/225/300/?84936', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('45', '51', 'Illum eum ut vel laborum deserunt omnis.', '45', '2', '0', 'http://lorempixel.com/225/300/?64424', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('46', '75', 'Non enim expedita facilis nulla et quidem.', '46', '2', '1', 'http://lorempixel.com/225/300/?65216', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('47', '1', 'Et ipsam accusamus dolorum.', '47', '2', '0', 'http://lorempixel.com/225/300/?64675', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('48', '31', 'Rerum autem iure quis.', '48', '1', '0', 'http://lorempixel.com/225/300/?96903', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('49', '83', 'Hic sint incidunt non ut quas nihil doloribus.', '49', '1', '1', 'http://lorempixel.com/225/300/?55367', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('50', '94', 'Architecto magnam est dicta.', '50', '2', '1', 'http://lorempixel.com/225/300/?44161', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('51', '69', 'Dolorem repellendus illo animi qui error.', '51', '2', '1', 'http://lorempixel.com/225/300/?27580', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('52', '28', 'Reprehenderit dicta voluptas at sed ab in nihil.', '52', '1', '1', 'http://lorempixel.com/225/300/?38990', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('53', '28', 'Dolore labore fuga mollitia molestiae ad qui.', '53', '3', '0', 'http://lorempixel.com/225/300/?62732', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('54', '11', 'Molestiae est alias et minus molestiae dolorem.', '54', '2', '0', 'http://lorempixel.com/225/300/?58245', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('55', '62', 'Blanditiis nesciunt rerum sit non voluptatem.', '55', '3', '0', 'http://lorempixel.com/225/300/?92648', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('56', '84', 'Nihil illo earum natus sed reiciendis.', '56', '2', '1', 'http://lorempixel.com/225/300/?84066', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('57', '84', 'Quaerat sint adipisci ipsum eius repellendus.', '57', '1', '0', 'http://lorempixel.com/225/300/?70248', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('58', '64', 'Delectus et sunt perspiciatis quia.', '58', '1', '1', 'http://lorempixel.com/225/300/?66123', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('59', '30', 'Ullam qui alias qui beatae nobis.', '59', '1', '0', 'http://lorempixel.com/225/300/?91921', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('60', '7', 'A sed suscipit eos at sint rerum.', '60', '3', '0', 'http://lorempixel.com/225/300/?93449', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('61', '32', 'Ut et libero accusamus accusantium.', '61', '1', '0', 'http://lorempixel.com/225/300/?76399', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('62', '53', 'Consectetur nihil assumenda qui illo laborum.', '62', '1', '0', 'http://lorempixel.com/225/300/?61260', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('63', '50', 'Non facilis aut nulla veritatis laboriosam.', '63', '1', '0', 'http://lorempixel.com/225/300/?58271', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('64', '21', 'Rerum ipsa dolor saepe non.', '64', '2', '1', 'http://lorempixel.com/225/300/?55955', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('65', '54', 'Eos et voluptatem dolorem eius iste unde non.', '65', '3', '1', 'http://lorempixel.com/225/300/?19316', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('66', '70', 'Nesciunt quis dolores nulla.', '66', '3', '0', 'http://lorempixel.com/225/300/?17751', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('67', '10', 'Sint similique consequuntur porro assumenda.', '67', '1', '1', 'http://lorempixel.com/225/300/?12462', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('68', '2', 'Autem voluptas ut quia iure rem impedit.', '68', '1', '0', 'http://lorempixel.com/225/300/?74765', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('69', '66', 'Alias totam et voluptatem autem.', '69', '3', '0', 'http://lorempixel.com/225/300/?28033', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('70', '57', 'Ex doloribus ut labore qui consequatur harum.', '70', '3', '1', 'http://lorempixel.com/225/300/?50236', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('71', '82', 'Vero non unde possimus odit est aut minima.', '71', '3', '0', 'http://lorempixel.com/225/300/?71406', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('72', '54', 'Ratione alias dolor ut non nulla soluta possimus.', '72', '2', '0', 'http://lorempixel.com/225/300/?10269', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('73', '99', 'Dolore ut saepe perferendis itaque illum.', '73', '3', '0', 'http://lorempixel.com/225/300/?85947', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('74', '39', 'Nostrum sunt quam pariatur voluptas.', '74', '3', '1', 'http://lorempixel.com/225/300/?74283', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('75', '27', 'Quod et ab maiores error labore.', '75', '2', '0', 'http://lorempixel.com/225/300/?73977', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('76', '6', 'Ad sed aut et id nam.', '76', '3', '0', 'http://lorempixel.com/225/300/?20874', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('77', '38', 'Itaque et minus deserunt ipsam aut illo.', '77', '3', '0', 'http://lorempixel.com/225/300/?10912', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('78', '49', 'Iure magnam enim iste dolorem aut eveniet.', '78', '1', '0', 'http://lorempixel.com/225/300/?87260', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('79', '4', 'Quam omnis animi rem eius officiis vero.', '79', '2', '0', 'http://lorempixel.com/225/300/?74724', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('80', '30', 'Est blanditiis unde ab qui delectus sunt porro.', '80', '3', '0', 'http://lorempixel.com/225/300/?37333', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('81', '99', 'Beatae debitis libero et.', '81', '3', '0', 'http://lorempixel.com/225/300/?19729', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('82', '81', 'Quaerat et impedit odit.', '82', '3', '1', 'http://lorempixel.com/225/300/?69853', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('83', '96', 'Ut praesentium provident rerum et ut occaecati.', '83', '1', '1', 'http://lorempixel.com/225/300/?41054', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('84', '82', 'Fugiat eum sed iusto.', '84', '2', '1', 'http://lorempixel.com/225/300/?31939', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('85', '15', 'Labore explicabo perspiciatis sint beatae.', '85', '3', '1', 'http://lorempixel.com/225/300/?58189', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('86', '69', 'Voluptatem quia alias provident.', '86', '1', '0', 'http://lorempixel.com/225/300/?29626', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('87', '15', 'Qui qui qui id nihil occaecati reprehenderit.', '87', '2', '1', 'http://lorempixel.com/225/300/?80754', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('88', '8', 'Nemo aliquid recusandae aut.', '88', '2', '0', 'http://lorempixel.com/225/300/?22270', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('89', '3', 'Animi omnis culpa qui impedit vero eveniet et.', '89', '1', '0', 'http://lorempixel.com/225/300/?91391', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('90', '99', 'Corporis a qui aut asperiores.', '90', '1', '0', 'http://lorempixel.com/225/300/?75936', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('91', '7', 'Quidem occaecati at et illum laboriosam ullam.', '91', '2', '0', 'http://lorempixel.com/225/300/?91468', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('92', '11', 'Dolorum aut est dignissimos nesciunt ut aliquid.', '92', '3', '0', 'http://lorempixel.com/225/300/?68939', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('93', '74', 'Voluptatem aut cupiditate iste tenetur.', '93', '3', '0', 'http://lorempixel.com/225/300/?50277', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('94', '30', 'Omnis nisi dolores voluptate.', '94', '2', '1', 'http://lorempixel.com/225/300/?70702', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('95', '77', 'Ut earum exercitationem voluptatem eos.', '95', '1', '1', 'http://lorempixel.com/225/300/?36632', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('96', '75', 'Quo explicabo et ut et velit dolores.', '96', '2', '1', 'http://lorempixel.com/225/300/?70871', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('97', '79', 'Culpa ea sequi facere illum et similique ex.', '97', '1', '1', 'http://lorempixel.com/225/300/?29799', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('98', '9', 'Ipsum saepe qui reiciendis rem.', '98', '2', '0', 'http://lorempixel.com/225/300/?15011', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('99', '47', 'Sint nihil doloremque modi error sit vel.', '99', '1', '1', 'http://lorempixel.com/225/300/?29097', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');
INSERT INTO `small_test_question_choices` VALUES ('100', '76', 'Fugit non error velit blanditiis modi.', '100', '3', '0', 'http://lorempixel.com/225/300/?42040', 'Temp(file_id explanation)', 'Temp(file_id options setting)', 'Temp(folder_id options)', '2017-07-22 12:31:46', '2017-07-22 12:31:46');

-- ----------------------------
-- Table structure for small_test_question_problems
-- ----------------------------
DROP TABLE IF EXISTS `small_test_question_problems`;
CREATE TABLE `small_test_question_problems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `small_test_question_id` int(10) unsigned NOT NULL,
  `problem_statement` text COLLATE utf8_unicode_ci NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `image_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `priority_check` tinyint(1) NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `video_path` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of small_test_question_problems
-- ----------------------------
INSERT INTO `small_test_question_problems` VALUES ('1', '29', 'Illo optio ut reiciendis adipisci et omnis occaecati. Aut ea quas ipsa asperiores vitae.', '3', 'http://lorempixel.com/300/400/?78954', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('2', '78', 'Eum sit sit totam rerum minima. Nemo quo veritatis ea itaque.', '3', 'http://lorempixel.com/300/400/?88332', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('3', '55', 'Perspiciatis voluptas quam eos aut sit. Cum voluptas impedit voluptatem.', '3', 'http://lorempixel.com/300/400/?23783', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('4', '95', 'Deserunt aut ab necessitatibus similique. Quod iusto et vitae odit ex quod libero.', '1', 'http://lorempixel.com/300/400/?32249', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('5', '65', 'Rerum omnis ab sunt. Consequatur dolore aut a. Maiores perferendis inventore sit.', '3', 'http://lorempixel.com/300/400/?15398', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('6', '29', 'Adipisci et nesciunt ea et dolorem. Dignissimos qui et dolores nemo.', '1', 'http://lorempixel.com/300/400/?66394', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('7', '86', 'Eius aut sit ducimus reprehenderit eum rerum saepe. Enim et nulla itaque ad odio accusantium.', '2', 'http://lorempixel.com/300/400/?80005', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('8', '44', 'Et aut iure nobis odit voluptas voluptas expedita nesciunt. Aut explicabo vel blanditiis.', '1', 'http://lorempixel.com/300/400/?96795', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('9', '39', 'Est tempora alias fuga totam iusto placeat ad. Et minima qui accusantium quisquam.', '1', 'http://lorempixel.com/300/400/?46939', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('10', '39', 'Ea quae est sunt quidem voluptate minus. Temporibus iste neque autem.', '2', 'http://lorempixel.com/300/400/?65393', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('11', '54', 'Illo accusamus deleniti hic. Ut qui quidem a amet deserunt deleniti neque.', '3', 'http://lorempixel.com/300/400/?54062', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('12', '97', 'Placeat beatae est ipsa eaque. Velit voluptas reprehenderit tempora at iure debitis.', '2', 'http://lorempixel.com/300/400/?76146', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('13', '67', 'Accusantium magni aut vel dolore qui. Qui corporis occaecati quo ipsum dicta porro odio.', '2', 'http://lorempixel.com/300/400/?71306', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('14', '58', 'Expedita impedit nihil sed. At delectus officiis est iusto ducimus.', '2', 'http://lorempixel.com/300/400/?24906', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('15', '92', 'Facilis ea beatae laudantium tenetur dolorem et. Sed animi et corrupti et.', '2', 'http://lorempixel.com/300/400/?87450', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('16', '82', 'Quam aut fugiat voluptatem voluptatem asperiores dignissimos. Sit animi est ut quae.', '3', 'http://lorempixel.com/300/400/?96352', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('17', '24', 'Neque nesciunt sapiente et quo eligendi ducimus. Rem aspernatur unde quia impedit sed vel.', '1', 'http://lorempixel.com/300/400/?75637', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('18', '64', 'Fugiat nulla et id nam nam. Qui nesciunt minima et sint exercitationem. Nobis harum totam quia sit.', '1', 'http://lorempixel.com/300/400/?89050', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('19', '70', 'Tenetur sapiente consequatur ut quisquam rerum. Dicta et quae ab. Minima aut qui maiores sint.', '3', 'http://lorempixel.com/300/400/?29710', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('20', '55', 'Molestiae atque explicabo sed enim in aut quos debitis. Unde libero voluptas aut saepe aut facilis.', '1', 'http://lorempixel.com/300/400/?93006', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('21', '10', 'Odio aperiam debitis est labore voluptatem doloribus. Unde praesentium eos ut nisi.', '2', 'http://lorempixel.com/300/400/?45839', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('22', '97', 'Nihil dolores quos ad. Atque quam ex nostrum sed.', '1', 'http://lorempixel.com/300/400/?63351', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('23', '17', 'Et illo distinctio corrupti. Et et eum sapiente porro quas. Omnis magni illo perferendis nisi.', '1', 'http://lorempixel.com/300/400/?64512', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('24', '66', 'Eos sit ut aliquid amet molestiae enim. Nemo laborum iusto modi ducimus doloribus sint eum.', '3', 'http://lorempixel.com/300/400/?25305', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('25', '94', 'Sequi pariatur ut facilis est. Laboriosam et rerum quis minima alias reprehenderit.', '1', 'http://lorempixel.com/300/400/?35522', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('26', '54', 'Ut ut ut dolor sit. Debitis eaque voluptatem rerum. Recusandae amet doloribus incidunt non.', '1', 'http://lorempixel.com/300/400/?68444', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('27', '37', 'Reiciendis est eligendi facilis porro deleniti. Quo molestiae expedita voluptatum dolorem labore.', '2', 'http://lorempixel.com/300/400/?70603', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('28', '55', 'Est est soluta vero officiis omnis. Incidunt fuga voluptate voluptas ut officia sint.', '3', 'http://lorempixel.com/300/400/?42258', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('29', '4', 'Sequi commodi accusamus minus velit illo harum. Itaque ut esse omnis accusantium eos.', '3', 'http://lorempixel.com/300/400/?22446', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('30', '91', 'Accusantium consequatur a odit sit. Adipisci id quia illo consectetur perspiciatis dolores.', '2', 'http://lorempixel.com/300/400/?87995', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('31', '85', 'Iusto odio quia voluptatem labore animi nesciunt. Est facere enim eum aliquid nihil recusandae.', '3', 'http://lorempixel.com/300/400/?21452', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('32', '35', 'Enim iure blanditiis ea. Et ratione earum consequatur error. Eius reprehenderit ad eos et.', '2', 'http://lorempixel.com/300/400/?83213', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('33', '71', 'Facere repudiandae ipsam non et dolor. Mollitia officia distinctio commodi ut ut quam quae.', '1', 'http://lorempixel.com/300/400/?28636', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('34', '13', 'Omnis saepe quo in recusandae esse. Praesentium fuga aut unde et. Quod autem accusamus est quo.', '1', 'http://lorempixel.com/300/400/?89005', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('35', '57', 'Consequatur velit omnis quis voluptatibus. At saepe quod dolor error.', '1', 'http://lorempixel.com/300/400/?23411', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('36', '43', 'Alias recusandae qui deleniti aperiam quaerat. Eos minima quis recusandae numquam.', '3', 'http://lorempixel.com/300/400/?73388', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('37', '71', 'Voluptas fuga dolor illo voluptas qui assumenda. Neque eius fuga dolorem.', '2', 'http://lorempixel.com/300/400/?31432', '0', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('38', '64', 'Odio aut odio eum id. Voluptate sunt maiores omnis dolorum.', '1', 'http://lorempixel.com/300/400/?93105', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('39', '20', 'Est est qui distinctio sed minus repellat. At rem enim voluptate quas.', '3', 'http://lorempixel.com/300/400/?97551', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('40', '81', 'Unde est non aspernatur consequatur aut debitis aut. Est et ut soluta.', '1', 'http://lorempixel.com/300/400/?46442', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('41', '80', 'Totam ipsam sit earum. Quasi fugit ad ratione qui voluptatum est optio autem.', '3', 'http://lorempixel.com/300/400/?79797', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('42', '82', 'Omnis libero vero aliquid fugiat odio qui. Et qui vitae quos sint. Iure sint officiis rerum esse.', '1', 'http://lorempixel.com/300/400/?57118', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('43', '99', 'Quia in error sapiente saepe qui voluptas. Ab saepe eos sunt saepe id.', '1', 'http://lorempixel.com/300/400/?15147', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('44', '97', 'Atque ullam doloremque et mollitia. Modi iusto at quibusdam nemo voluptatibus rem perspiciatis.', '3', 'http://lorempixel.com/300/400/?89680', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('45', '84', 'Doloremque quas qui non quia eum aut. Earum fuga odit veniam et.', '3', 'http://lorempixel.com/300/400/?19307', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('46', '74', 'Quidem in optio quis quo. Aspernatur possimus nam assumenda natus corporis molestiae.', '3', 'http://lorempixel.com/300/400/?59806', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('47', '89', 'Ex qui voluptatem earum vel est et. Est provident reprehenderit harum esse unde.', '1', 'http://lorempixel.com/300/400/?75433', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('48', '41', 'Rem ea non quis adipisci. Autem est nisi vel. Rerum quibusdam necessitatibus sed distinctio.', '3', 'http://lorempixel.com/300/400/?84306', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=Q6dsRpVyyWs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('49', '46', 'Qui totam vel et est reiciendis ut consequuntur. Error harum autem ex recusandae qui commodi.', '2', 'http://lorempixel.com/300/400/?51821', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');
INSERT INTO `small_test_question_problems` VALUES ('50', '75', 'Magnam qui ut minima est. Ullam nemo similique voluptas optio. Esse sed et quo dicta fugiat qui.', '1', 'http://lorempixel.com/300/400/?28571', '1', 'Temp(file_id problem setting)', 'https://www.youtube.com/watch?v=2idPJMuqhxs', '2017-07-22 12:31:50', '2017-07-22 12:31:50');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', 'Tag 1', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('2', 'Tag 2', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('3', 'Tag 3', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('4', 'Tag 4', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('5', 'Tag 5', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('6', 'Tag 6', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('7', 'Tag 7', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('8', 'Tag 8', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('9', 'Tag 9', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('10', 'Tag 10', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('11', 'Tag 11', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('12', 'Tag 12', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('13', 'Tag 13', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('14', 'Tag 14', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('15', 'Tag 15', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('16', 'Tag 16', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('17', 'Tag 17', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('18', 'Tag 18', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('19', 'Tag 19', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('20', 'Tag 20', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('21', 'Tag 21', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('22', 'Tag 22', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('23', 'Tag 23', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('24', 'Tag 24', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('25', 'Tag 25', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('26', 'Tag 26', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('27', 'Tag 27', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('28', 'Tag 28', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('29', 'Tag 29', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('30', 'Tag 30', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('31', 'Tag 31', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('32', 'Tag 32', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('33', 'Tag 33', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('34', 'Tag 34', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('35', 'Tag 35', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('36', 'Tag 36', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('37', 'Tag 37', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('38', 'Tag 38', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('39', 'Tag 39', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('40', 'Tag 40', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('41', 'Tag 41', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('42', 'Tag 42', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('43', 'Tag 43', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('44', 'Tag 44', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('45', 'Tag 45', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('46', 'Tag 46', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('47', 'Tag 47', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('48', 'Tag 48', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('49', 'Tag 49', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('50', 'Tag 50', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('51', 'Tag 51', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('52', 'Tag 52', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('53', 'Tag 53', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('54', 'Tag 54', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('55', 'Tag 55', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('56', 'Tag 56', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('57', 'Tag 57', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('58', 'Tag 58', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('59', 'Tag 59', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('60', 'Tag 60', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('61', 'Tag 61', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('62', 'Tag 62', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('63', 'Tag 63', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('64', 'Tag 64', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('65', 'Tag 65', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('66', 'Tag 66', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('67', 'Tag 67', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('68', 'Tag 68', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('69', 'Tag 69', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('70', 'Tag 70', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('71', 'Tag 71', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('72', 'Tag 72', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('73', 'Tag 73', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('74', 'Tag 74', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('75', 'Tag 75', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('76', 'Tag 76', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('77', 'Tag 77', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('78', 'Tag 78', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('79', 'Tag 79', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('80', 'Tag 80', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('81', 'Tag 81', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('82', 'Tag 82', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('83', 'Tag 83', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('84', 'Tag 84', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('85', 'Tag 85', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('86', 'Tag 86', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('87', 'Tag 87', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('88', 'Tag 88', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('89', 'Tag 89', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('90', 'Tag 90', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('91', 'Tag 91', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('92', 'Tag 92', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('93', 'Tag 93', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('94', 'Tag 94', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('95', 'Tag 95', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('96', 'Tag 96', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('97', 'Tag 97', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('98', 'Tag 98', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('99', 'Tag 99', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('100', 'Tag 100', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('101', 'Tag 101', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('102', 'Tag 102', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('103', 'Tag 103', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('104', 'Tag 104', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('105', 'Tag 105', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('106', 'Tag 106', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('107', 'Tag 107', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('108', 'Tag 108', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('109', 'Tag 109', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('110', 'Tag 110', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('111', 'Tag 111', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('112', 'Tag 112', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('113', 'Tag 113', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('114', 'Tag 114', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('115', 'Tag 115', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('116', 'Tag 116', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('117', 'Tag 117', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('118', 'Tag 118', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('119', 'Tag 119', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('120', 'Tag 120', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('121', 'Tag 121', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('122', 'Tag 122', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('123', 'Tag 123', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('124', 'Tag 124', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('125', 'Tag 125', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('126', 'Tag 126', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('127', 'Tag 127', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('128', 'Tag 128', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('129', 'Tag 129', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('130', 'Tag 130', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('131', 'Tag 131', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('132', 'Tag 132', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('133', 'Tag 133', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('134', 'Tag 134', '2017-07-22 12:31:25', '2017-07-22 12:31:25');
INSERT INTO `tags` VALUES ('135', 'Tag 135', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('136', 'Tag 136', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('137', 'Tag 137', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('138', 'Tag 138', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('139', 'Tag 139', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('140', 'Tag 140', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('141', 'Tag 141', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('142', 'Tag 142', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('143', 'Tag 143', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('144', 'Tag 144', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('145', 'Tag 145', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('146', 'Tag 146', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('147', 'Tag 147', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('148', 'Tag 148', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('149', 'Tag 149', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('150', 'Tag 150', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('151', 'Tag 151', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('152', 'Tag 152', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('153', 'Tag 153', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('154', 'Tag 154', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('155', 'Tag 155', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('156', 'Tag 156', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('157', 'Tag 157', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('158', 'Tag 158', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('159', 'Tag 159', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('160', 'Tag 160', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('161', 'Tag 161', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('162', 'Tag 162', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('163', 'Tag 163', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('164', 'Tag 164', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('165', 'Tag 165', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('166', 'Tag 166', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('167', 'Tag 167', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('168', 'Tag 168', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('169', 'Tag 169', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('170', 'Tag 170', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('171', 'Tag 171', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('172', 'Tag 172', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('173', 'Tag 173', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('174', 'Tag 174', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('175', 'Tag 175', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('176', 'Tag 176', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('177', 'Tag 177', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('178', 'Tag 178', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('179', 'Tag 179', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('180', 'Tag 180', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('181', 'Tag 181', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('182', 'Tag 182', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('183', 'Tag 183', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('184', 'Tag 184', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('185', 'Tag 185', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('186', 'Tag 186', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('187', 'Tag 187', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('188', 'Tag 188', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('189', 'Tag 189', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('190', 'Tag 190', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('191', 'Tag 191', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('192', 'Tag 192', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('193', 'Tag 193', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('194', 'Tag 194', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('195', 'Tag 195', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('196', 'Tag 196', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('197', 'Tag 197', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('198', 'Tag 198', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('199', 'Tag 199', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `tags` VALUES ('200', 'Tag 200', '2017-07-22 12:31:26', '2017-07-22 12:31:26');

-- ----------------------------
-- Table structure for terms
-- ----------------------------
DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` tinyint(3) unsigned NOT NULL,
  `terms_of_use` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of terms
-- ----------------------------
INSERT INTO `terms` VALUES ('1', '1', 'Dolores officia corporis nihil ut sint temporibus quia cupiditate. Sint omnis non earum ad soluta ut odit. Non iusto assumenda ut nulla.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('2', '2', 'Fugiat numquam debitis quasi. Officia dolores corporis explicabo illum vel.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('3', '3', 'Aliquam neque vero qui sed dolorum asperiores possimus. Nam et fugiat nam exercitationem inventore. Aut atque soluta voluptates at voluptatem. Ipsam nemo quidem harum ipsam amet et aut et.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('4', '2', 'Ut qui dolore ipsam ipsum facilis. Nemo aspernatur accusantium voluptatem consequatur facere. Nulla dolor quia ut officiis.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('5', '3', 'Aut quia mollitia dolores sit autem. Nesciunt veniam quaerat quo iure vero eos. Reiciendis qui sequi deleniti nisi. Tempore et aut incidunt qui perferendis consequatur ipsam quis.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('6', '1', 'Eos omnis optio non odio est quis animi. Dolorem magnam sunt assumenda quia ab dolor totam. Et earum porro autem eos laudantium ea non ea.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('7', '3', 'Quos iste molestiae tempora in sint. Voluptatem voluptatem et id aut quod deleniti. Ut veniam temporibus iste qui aut laboriosam dolores rerum. Odit recusandae aliquam enim voluptatem corporis quia.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('8', '1', 'Voluptas cum quia facere necessitatibus. Adipisci quo voluptates quod est assumenda harum consequuntur. Est quaerat qui dolorum ab exercitationem occaecati.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('9', '3', 'Laudantium cum quo praesentium. Reprehenderit eos in eveniet nobis suscipit. Mollitia maxime nihil rerum molestias.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');
INSERT INTO `terms` VALUES ('10', '1', 'Nulla quaerat aspernatur deleniti est et. Reiciendis quibusdam provident expedita fuga velit. Aut minima aut et quod perferendis. Est qui repellendus est deleniti.', '2017-07-22 12:31:42', '2017-07-22 12:31:42');

-- ----------------------------
-- Table structure for throttle
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------

-- ----------------------------
-- Table structure for tips
-- ----------------------------
DROP TABLE IF EXISTS `tips`;
CREATE TABLE `tips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `has_small_test` tinyint(1) NOT NULL,
  `control_no` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tips
-- ----------------------------
INSERT INTO `tips` VALUES ('1', '20', '0', 'ASLJMP84M21X943C', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('2', '5', '0', 'TAFIQD13K63O710D', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('3', '16', '1', 'PWWSEO46E35W947G', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('4', '3', '1', 'YHDHDF34N61P188N', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('5', '14', '1', 'BJOSXD99S66T869S', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('6', '3', '1', 'KXBPDS94N04O464U', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('7', '11', '1', 'AUCPEE60G86T111H', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('8', '9', '1', 'QVEEIT01J85K690I', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('9', '14', '0', 'DZUJZP11R37V499K', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('10', '2', '0', 'WEFLHZ55E73I127L', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('11', '16', '0', 'XXNPOW84B45J348B', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('12', '14', '1', 'GSTXHS96C66E917G', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('13', '16', '0', 'IDNYUI42G83A238R', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('14', '19', '0', 'QPPJUV19K32E371A', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('15', '12', '0', 'UIZJGP56E38I438Z', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('16', '10', '0', 'PNAJKY64M33U980Y', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('17', '17', '1', 'RPURGQ89P24P053I', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('18', '8', '0', 'DHGEPN94K32K814C', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('19', '3', '1', 'YOPGNC49N97X228E', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('20', '20', '1', 'JFDEJO65E22I198C', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('21', '19', '0', 'WOLZYD12R64Q598V', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('22', '20', '0', 'FTNBRE69O10Z431U', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('23', '10', '0', 'VLNSWG91B67R019R', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('24', '16', '0', 'ZWIVBB63O26I696E', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('25', '12', '0', 'HZMVEA87U51B972L', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('26', '16', '0', 'HQNGRA15A96E230R', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('27', '14', '1', 'UXLJVP16Y06Q180R', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('28', '7', '1', 'IZGYJO39V23Q662Y', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('29', '13', '0', 'JHOPON19T31E589Z', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('30', '18', '1', 'JCMRLJ72K49R350Q', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('31', '15', '1', 'WOMOEH26M14P915K', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('32', '20', '0', 'WZFTHB86O73Z638E', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('33', '2', '1', 'HEZPKZ93Q71Z027L', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('34', '6', '1', 'SMSOUB10B48K931P', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('35', '11', '1', 'DVMUNX73B32A517U', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('36', '10', '0', 'YXVOFZ97B39B739E', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('37', '13', '0', 'LMBFGI99S59E409F', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('38', '12', '1', 'TNORSP74T98V154P', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('39', '6', '0', 'NOCBJT13L62J489U', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('40', '18', '1', 'QWTOJE89D65D448M', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('41', '14', '0', 'AZWXWI51K72N951I', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('42', '3', '0', 'OGARJK36T66M950B', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('43', '16', '0', 'XHTFGB78H93D754J', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('44', '11', '0', 'XYDPYS18I08R406W', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('45', '15', '1', 'WMFNWB67R17W843V', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('46', '10', '0', 'AWWTHC78M16N354B', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('47', '20', '1', 'QRYKLJ45R20J809C', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('48', '6', '1', 'EKPJAX36M96H696U', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('49', '11', '0', 'JBKBOQ03F40K358P', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');
INSERT INTO `tips` VALUES ('50', '1', '1', 'BDWGVW57I46R625B', 'Temp(file_id Tips setting)', 'Temp(folder_id Tips)', '2017-07-22 12:31:24', '2017-07-22 12:31:24');

-- ----------------------------
-- Table structure for trophy_ranks
-- ----------------------------
DROP TABLE IF EXISTS `trophy_ranks`;
CREATE TABLE `trophy_ranks` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `trophy_rank` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of trophy_ranks
-- ----------------------------
INSERT INTO `trophy_ranks` VALUES ('1', 'Rank 1', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('2', 'Rank 2', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('3', 'Rank 3', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('4', 'Rank 4', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('5', 'Rank 5', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('6', 'Rank 6', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('7', 'Rank 7', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('8', 'Rank 8', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('9', 'Rank 9', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('10', 'Rank 10', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('11', 'Rank 11', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('12', 'Rank 12', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('13', 'Rank 13', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('14', 'Rank 14', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('15', 'Rank 15', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('16', 'Rank 16', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('17', 'Rank 17', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('18', 'Rank 18', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('19', 'Rank 19', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('20', 'Rank 20', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('21', 'Rank 21', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('22', 'Rank 22', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('23', 'Rank 23', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('24', 'Rank 24', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('25', 'Rank 25', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('26', 'Rank 26', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('27', 'Rank 27', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('28', 'Rank 28', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('29', 'Rank 29', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('30', 'Rank 30', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('31', 'Rank 31', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('32', 'Rank 32', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('33', 'Rank 33', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('34', 'Rank 34', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('35', 'Rank 35', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('36', 'Rank 36', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('37', 'Rank 37', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('38', 'Rank 38', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('39', 'Rank 39', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('40', 'Rank 40', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('41', 'Rank 41', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('42', 'Rank 42', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('43', 'Rank 43', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('44', 'Rank 44', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('45', 'Rank 45', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('46', 'Rank 46', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('47', 'Rank 47', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('48', 'Rank 48', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('49', 'Rank 49', '2017-07-22 12:31:26', '2017-07-22 12:31:26');
INSERT INTO `trophy_ranks` VALUES ('50', 'Rank 50', '2017-07-22 12:31:26', '2017-07-22 12:31:26');

-- ----------------------------
-- Table structure for trophy_settings
-- ----------------------------
DROP TABLE IF EXISTS `trophy_settings`;
CREATE TABLE `trophy_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `big_test_id` int(10) unsigned NOT NULL,
  `collection_id` tinyint(3) unsigned NOT NULL,
  `correct_answer_rate` tinyint(3) unsigned NOT NULL,
  `folder_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of trophy_settings
-- ----------------------------
INSERT INTO `trophy_settings` VALUES ('1', '4', '56', '68', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('2', '7', '47', '2', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('3', '4', '84', '86', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('4', '2', '19', '38', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('5', '1', '93', '20', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('6', '9', '55', '63', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('7', '1', '29', '35', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('8', '9', '64', '23', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('9', '2', '45', '85', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('10', '10', '47', '65', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('11', '7', '19', '81', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('12', '4', '58', '10', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('13', '10', '13', '66', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('14', '9', '30', '50', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('15', '5', '78', '65', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('16', '8', '93', '5', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('17', '1', '81', '77', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('18', '10', '67', '90', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:48', '2017-07-22 12:31:48');
INSERT INTO `trophy_settings` VALUES ('19', '7', '60', '61', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('20', '6', '98', '34', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('21', '1', '43', '23', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('22', '6', '6', '79', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('23', '8', '94', '3', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('24', '3', '37', '64', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('25', '7', '26', '79', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('26', '3', '52', '19', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('27', '9', '43', '5', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('28', '6', '11', '69', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('29', '5', '57', '53', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('30', '2', '25', '15', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('31', '7', '7', '81', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('32', '5', '71', '57', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('33', '8', '54', '23', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('34', '9', '56', '61', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('35', '3', '49', '15', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('36', '5', '59', '69', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('37', '4', '53', '7', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('38', '3', '72', '94', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('39', '2', '49', '65', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('40', '6', '94', '82', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('41', '4', '91', '43', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('42', '1', '61', '64', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('43', '10', '65', '38', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('44', '5', '53', '89', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('45', '10', '98', '5', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('46', '4', '36', '22', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('47', '9', '81', '25', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('48', '1', '10', '83', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('49', '1', '22', '97', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('50', '5', '51', '19', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('51', '2', '46', '83', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('52', '9', '34', '83', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('53', '7', '73', '26', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('54', '3', '78', '92', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('55', '6', '76', '100', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('56', '9', '5', '9', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('57', '1', '93', '43', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('58', '6', '28', '92', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('59', '4', '97', '14', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('60', '1', '1', '81', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('61', '7', '73', '4', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('62', '3', '70', '58', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('63', '9', '36', '22', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('64', '4', '51', '48', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('65', '5', '38', '81', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('66', '7', '61', '51', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('67', '3', '27', '42', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('68', '5', '100', '4', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('69', '10', '93', '45', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('70', '3', '66', '83', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('71', '6', '69', '33', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('72', '3', '94', '90', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('73', '2', '78', '41', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('74', '10', '64', '42', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('75', '8', '65', '54', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('76', '7', '95', '79', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('77', '5', '26', '73', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('78', '7', '53', '53', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('79', '7', '90', '18', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('80', '6', '53', '33', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('81', '5', '2', '96', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('82', '6', '35', '1', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('83', '2', '97', '60', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('84', '2', '7', '97', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('85', '5', '38', '61', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('86', '5', '13', '4', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('87', '3', '69', '94', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('88', '10', '56', '42', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('89', '2', '53', '56', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('90', '6', '81', '83', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('91', '6', '40', '45', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('92', '5', '39', '90', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('93', '9', '81', '63', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('94', '9', '14', '52', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('95', '6', '15', '78', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('96', '5', '63', '64', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('97', '6', '30', '76', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('98', '5', '12', '0', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('99', '8', '21', '78', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');
INSERT INTO `trophy_settings` VALUES ('100', '8', '23', '62', 'Temp(folder_id trophy setting)', 'Temp(file_id trophy setting)', '2017-07-22 12:31:49', '2017-07-22 12:31:49');

-- ----------------------------
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of types
-- ----------------------------
INSERT INTO `types` VALUES ('1', 'カード', '2017-07-22 12:31:12', null);
INSERT INTO `types` VALUES ('2', 'パーツ', '2017-07-22 12:31:12', null);
INSERT INTO `types` VALUES ('3', 'トロフィー', '2017-07-22 12:31:12', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `area_id` tinyint(3) unsigned NOT NULL,
  `profession_id` tinyint(3) unsigned NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `notification_setting_1` tinyint(1) NOT NULL DEFAULT '1',
  `notification_setting_2` tinyint(1) NOT NULL DEFAULT '1',
  `notification_setting_3` tinyint(1) NOT NULL DEFAULT '1',
  `contents` text COLLATE utf8_unicode_ci,
  `sns_public_setting` tinyint(1) NOT NULL DEFAULT '1',
  `device_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'bschulist@wolff.com', '$2y$10$zq/AOT21tVJrmKYsmInvW.CoYDc7ID6qloQsaxIF8dDCLr0igUJkC', '3', 'Janelle Hane', '1', '1992-04-27', '2', '2', 'North Carolina Lake Apt. 813', '(888) 450-8212', '2012-05-26 01:29:55', '2017-07-20 16:16:03', '1', '1', '1', 'Minus voluptates quo dolore accusantium et est eum. Pariatur aliquid dolor qui et voluptatum.', '1', 'c8417239-308a-305d-831c-9715268c7ccb', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('2', 'henri.botsford@yahoo.com', '$2y$10$5RW2V1yqgI.hi5PAmd7/JeeEjt73jabva8mYgqm0mxpD7hkcwIXYa', '2', 'Ms. Emelia Stark Sr.', '1', '1980-10-20', '2', '4', 'Connecticut East Apt. 341', '877.403.8145', '2012-08-07 02:58:14', '2017-06-29 10:09:38', '1', '1', '1', 'Eos ratione impedit quis doloribus illo reprehenderit. Nulla nam velit animi et ullam et. Non quis occaecati repellat itaque. Voluptatem asperiores aliquam vero rerum magni.', '1', '7ddb2007-6d87-32ec-8217-e88c7baa94f4', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('3', 'xortiz@gmail.com', '$2y$10$rdAbyGUoexLXz6qxHBP0QORforYN2mTjx7CinXtgim9At56Pcc71u', '3', 'Terrell Friesen', '1', '2013-11-08', '3', '6', 'North Carolina South Apt. 494', '1-866-886-3898', '2017-05-25 16:00:18', '2017-07-20 18:37:53', '1', '1', '1', 'Odio pariatur numquam delectus. Autem sed iusto possimus maxime facilis enim. Id quo distinctio praesentium autem repudiandae. Sit rerum temporibus sit voluptas et sunt.', '1', '820925f7-98b6-3be3-849b-b8cb6bc5a15b', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('4', 'kschaden@hackett.info', '$2y$10$tYIiy5AEMgWl.FHxwUTUnOKha3JKm.6PlaXMlEXqIpTWqcFqC7pUi', '3', 'Dr. Verdie Gleichner', '0', '1979-02-27', '1', '7', 'Texas West Suite 041', '1-877-978-9912', '2007-11-22 01:18:55', '2017-06-26 02:35:15', '1', '1', '1', 'Nihil dolorem molestiae non laborum. Porro inventore non ut omnis in animi aut. Nemo aspernatur sed quia illum officia.', '1', '15c574fc-5af0-38b4-b990-fff925ef0093', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('5', 'bmuller@hotmail.com', '$2y$10$Q9WF3HXfPLmNIYZkJS8.B.gadk0dFtcM3P3Feq2R.M6OUDqd.Zzke', '3', 'Kaitlin Dooley', '0', '2012-05-03', '1', '2', 'Vermont Lake Suite 494', '1-800-787-3414', '2014-07-19 16:22:53', '2017-06-29 21:56:37', '1', '1', '1', 'Nihil optio eum ut explicabo repellendus qui quasi. Magnam quis et aut perferendis voluptatum. Fuga asperiores dolore odio cupiditate repudiandae.', '1', 'df628887-b080-3e30-af79-a9a75790d1e2', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('6', 'botsford.josefina@hotmail.com', '$2y$10$qIIvx5p9XhE7IU6DvNrwsuG0TssfKVQQS/95uQ7AZkdUUhnrIHwJW', '2', 'Lonzo Beatty', '0', '1994-03-03', '2', '7', 'Michigan West Apt. 216', '866.978.7668', '2013-11-28 09:08:38', '2017-07-18 08:09:47', '1', '1', '1', 'Nam voluptas omnis quia nostrum quo doloremque. Culpa dolor rerum eligendi aliquid libero. Amet provident dolor ratione.', '1', 'db7040b4-6225-3977-b5a0-81b95e0c791c', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('7', 'abbott.ruby@gmail.com', '$2y$10$grdZgMYNFclCAZshnz0Cuujcn5wJqnBlxcUCc.6FqMd8QrxdxGdLe', '2', 'Dr. Ellsworth Skiles Jr.', '1', '1985-03-24', '3', '6', 'Florida West Suite 423', '(877) 308-2631', '2011-03-04 00:57:24', '2017-07-10 05:02:21', '1', '1', '1', 'Deleniti quae autem beatae est enim quis recusandae. Qui sunt ea fuga maxime et sint iure. Optio ea quasi qui est accusamus numquam. Enim quo nihil nihil enim.', '1', '1ffc242e-0b0c-3147-b33b-9e012f6d5bb6', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('8', 'eoconnell@hotmail.com', '$2y$10$bxyKWyfWG0Jp.8YxsOiSPeJJUsTluL3.aVEIspAyszEcjPGldDpJS', '2', 'Ms. Minnie Larson', '0', '1988-12-27', '2', '3', 'New Hampshire Lake Apt. 424', '(844) 409-9379', '2015-02-03 17:35:34', '2017-07-17 07:00:40', '1', '1', '1', 'Voluptatem minus unde ipsum iure eos possimus. Est est deleniti expedita voluptatem. Suscipit consequatur est laborum autem natus. Porro eveniet aliquam beatae magnam sequi cumque qui.', '1', 'c0f78281-15f8-3559-a1a5-84a7210eebe2', '2017-07-22 12:31:13', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('9', 'magnolia.kuhn@hotmail.com', '$2y$10$N3JRIQJHZvZHxwuxceQF4ewl1fwk/hA9.cNWQD5He5eCJYSxR1pja', '3', 'Dr. Junior Robel', '0', '1989-10-13', '3', '7', 'Idaho East Suite 378', '800-909-5966', '2010-08-01 18:41:16', '2017-06-30 01:20:32', '1', '1', '1', 'Ut aut neque error ut. Qui est magnam qui nesciunt. Consequatur eos eius quia ipsa at et optio. Sed quam omnis aut voluptatem omnis aspernatur.', '1', '99442855-edba-3b33-8a27-4826d740f6ec', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('10', 'coy.kohler@friesen.com', '$2y$10$3KnDeebz20pqwfZzq2pQOe4bHssqEPj.cK5AHfDGtVkteX88yJJ96', '1', 'Esperanza O\'Conner I', '1', '2015-07-03', '2', '7', 'Louisiana New Suite 069', '888.759.5949', '2013-09-11 04:05:43', '2017-07-07 22:21:00', '1', '1', '1', 'Ratione esse facilis sunt ratione molestiae maiores voluptates laborum. Molestias quo dolorum voluptate est aut. Praesentium labore atque facilis tempore omnis nihil.', '1', '6aaa0da4-8ce7-309a-b6ce-69326ac6eb67', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('11', 'walker.dakota@yahoo.com', '$2y$10$o0/OcXQ.u/brE0RP1Xcexuazyzcdfg/vRwRi5e.xCI2dQtfdCt1JG', '1', 'Prof. Chaz Nader', '1', '2001-03-23', '3', '2', 'Colorado West Suite 976', '844.880.8621', '2008-05-21 05:25:25', '2017-07-10 17:11:46', '1', '1', '1', 'Occaecati laudantium et incidunt iste quas quo nostrum aut. Omnis deserunt suscipit sapiente quis. Assumenda mollitia non eveniet. Veritatis ut ut animi dolor officia perferendis dolor neque.', '1', '0a677fdf-e8fc-31ef-859c-b2d8bbb035ac', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('12', 'arobel@yahoo.com', '$2y$10$1Y12U3PU/Pm/hJB0m2k.SeCgU2A/Suz2.zhndudp5P6IjTeUX5CiW', '1', 'Marina Graham I', '1', '2005-12-01', '1', '2', 'Michigan Lake Suite 865', '800.629.9211', '2009-07-27 15:42:51', '2017-06-28 02:59:20', '1', '1', '1', 'Cupiditate id et est ullam dignissimos aut labore cupiditate. Quo dicta illum eum pariatur odit. Qui doloremque ratione libero deserunt ut cupiditate.', '1', 'fce8426c-63d4-34c7-9702-8af7ab2de52c', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('13', 'luciano.renner@wiza.info', '$2y$10$/zwttrNVIj2Dznes/QeDcu3e2eT.0qERzbYDGABrSQZMS0kzf2NVO', '2', 'Wava Tromp', '1', '1994-01-20', '2', '2', 'Alaska West Apt. 862', '866-519-4543', '2016-01-01 07:49:31', '2017-07-08 17:59:46', '1', '1', '1', 'Sed fuga harum eius nihil vero. Enim voluptatem ratione consequatur neque rem architecto. Doloremque ea qui quis dolores maxime aut.', '1', '7a27a159-0656-309a-8f3b-a8c475c9fd73', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('14', 'pouros.marian@treutel.com', '$2y$10$yKxuHD.FUoVUo28HxERtvu4bhQng6OFZ2/sJ7k.7.haO1zBB8Gzo2', '3', 'Cristian Raynor', '1', '2009-01-19', '3', '2', 'Nebraska Lake Apt. 017', '1-800-989-4377', '2013-04-13 21:56:00', '2017-07-13 15:49:25', '1', '1', '1', 'Aut dolores dicta a et aut alias aut. Quisquam corrupti suscipit id eos laudantium autem. Velit alias aliquam dolor animi et non et.', '1', 'e844a9f3-60e2-3f34-9511-3f54da136acb', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('15', 'taurean.stanton@hotmail.com', '$2y$10$MP.5aOlB5LkWEqj1g09A3.Ck5ZtrEzI9cMs9o3MGvhbAAP8s2brZi', '1', 'Mrs. Marge Hoppe', '0', '2007-08-22', '2', '7', 'Oregon West Apt. 045', '866-922-1898', '2011-03-11 11:31:06', '2017-07-15 15:28:15', '1', '1', '1', 'Saepe veritatis dolores quasi sint cum excepturi. Sed itaque voluptatem fuga magnam deserunt. Quia officia quo fugit.', '1', 'e393320e-512c-348c-9e3d-4d0b4735c029', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('16', 'anahi44@bashirian.com', '$2y$10$s.0L4I0h844Ko9ktVATe1.4UIDgy8DYbCWbGMFTJwABk2LhBKGSNW', '3', 'Claudie Hodkiewicz', '0', '1984-07-19', '1', '7', 'Texas New Suite 874', '1-855-623-9241', '2010-11-12 04:15:45', '2017-07-01 21:09:59', '1', '1', '1', 'Omnis adipisci quos accusantium impedit. Voluptatem architecto eum et molestiae.\nCulpa ratione id odio exercitationem. Saepe et aut quis. Corporis est voluptas et deleniti.', '1', 'fe78ac8e-aaef-3f37-a115-598a90ba004d', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('17', 'gkozey@hotmail.com', '$2y$10$f0Fr5RmsHBl/K.tB3Na3s.7SUEjXjHthk7e4e8qxeZro2Tahg48kG', '2', 'Garrett Murray', '1', '1979-07-09', '1', '9', 'Louisiana East Apt. 540', '(866) 435-6963', '2012-03-28 03:35:16', '2017-06-27 08:53:10', '1', '1', '1', 'Consequuntur laboriosam architecto quibusdam. Delectus dolor quos incidunt repellat. Quia qui in perferendis veniam aspernatur enim rerum. Est sunt ipsum ullam in maxime rem ut.', '1', '83398a7c-1017-375c-a426-a5edd02f6f44', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('18', 'jerdman@okeefe.com', '$2y$10$1l/hQuD3jlOhbuGdhTW1guKgnpqPQuPp4gSrISF5H.q.XVomE3nkm', '3', 'Constantin Crooks', '0', '1979-05-11', '2', '3', 'Illinois Port Suite 181', '800.564.3016', '2011-01-11 13:26:15', '2017-07-08 17:56:41', '1', '1', '1', 'Id consectetur sed dolores aut. Veritatis iusto exercitationem eos.', '1', '46570a20-1f39-35c0-94ff-0aef5f1704be', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('19', 'paucek.felipe@klein.org', '$2y$10$uMWFOeQaeCKcp56w.FqkVuIzBxS6nxSwsoJbLVRDEtDRg9UihhN5S', '2', 'Nadia Ernser', '1', '1982-05-13', '3', '9', 'Nebraska East Apt. 155', '(877) 855-0283', '2013-12-17 01:23:52', '2017-07-15 11:02:42', '1', '1', '1', 'Sed sed architecto mollitia ex atque voluptatibus dignissimos tempora. Similique magnam totam neque nulla harum natus quis. Eos voluptatem sapiente esse dignissimos nobis quae blanditiis.', '1', 'b2df1535-8c28-3724-845a-7d0fb33a83e5', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('20', 'rpurdy@hintz.com', '$2y$10$n9OVzrtpre.Vw7/4X0p6JuHRaZz2jW8fH8Ajtwfx3Wym7vmhi4u2S', '1', 'Prof. Idella Bahringer Sr.', '0', '1979-05-30', '3', '5', 'Colorado South Suite 113', '800.214.8739', '2008-05-02 21:26:04', '2017-07-09 18:20:13', '1', '1', '1', 'Modi ab ut tempore. Culpa rerum dolorem eos autem et et eaque molestiae. Nesciunt libero error veritatis error aspernatur at in.', '1', '121aecf5-444b-3a65-af80-843f2befe0bb', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('21', 'ckerluke@hotmail.com', '$2y$10$Ir3hiRI3bipMTEC25lHjgOgUOn1idfMXHyM6GvymaC8BV54fo7Gm2', '2', 'Jakayla Pollich', '0', '1995-03-20', '2', '9', 'Vermont Lake Apt. 833', '(844) 880-3824', '2007-10-12 12:57:20', '2017-07-13 01:19:39', '1', '1', '1', 'Et dolores repudiandae et nobis. Rerum impedit consequuntur sit eos. Et qui officiis quia dicta sint non similique ullam. Debitis ratione libero voluptatem quod.', '1', '5fd97583-0ac8-3f7e-a5bb-6086a61172a4', '2017-07-22 12:31:14', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('22', 'ari02@hotmail.com', '$2y$10$5arjFypRF2S7NuE406fuqe5cZoSjN9k8sVSZJ3fEKO2qpZfUbZ6AK', '3', 'Tillman O\'Hara', '1', '2014-11-14', '3', '1', 'Massachusetts East Suite 284', '855.654.5153', '2011-06-27 14:30:08', '2017-07-07 15:53:39', '1', '1', '1', 'Dolorem rerum velit eum in corporis. Quod sunt voluptate sunt officiis. Est corrupti quibusdam iure voluptate optio ducimus ut.', '1', '393316fe-f774-3e96-bb11-9aaba4ef17b9', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('23', 'pfeffer.avery@jast.com', '$2y$10$RS1Z5/nz/IldtMduwUE1me2MqSkg1YMvnm9EgN1udXvVj0VVOgdeu', '3', 'Jordi Pfeffer', '0', '2000-11-17', '3', '1', 'Hawaii North Suite 222', '1-866-377-0167', '2012-01-13 03:54:56', '2017-06-22 21:10:15', '1', '1', '1', 'Fuga assumenda totam nesciunt odio recusandae est explicabo. Nam qui omnis et vitae. Maxime dolorum in iure omnis ut. Eum et voluptatem et quos nemo aut.', '1', 'ae22c855-2c04-3355-8681-bb0034f44f41', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('24', 'gkilback@hotmail.com', '$2y$10$LlXBly5irnTVk1lIveVsSuvwporTpTuaiff7fV3IWZPjOPzRucjIK', '2', 'Frederick Cronin', '0', '1982-10-25', '3', '1', 'Washington South Apt. 450', '1-866-451-8041', '2009-03-03 09:45:07', '2017-06-28 17:27:52', '1', '1', '1', 'Accusantium cum laboriosam molestias harum eum. Quae similique omnis tempore nobis. Numquam et ratione voluptatum. Culpa ullam est praesentium esse cum quod.', '1', '9b355c9d-7878-3276-8e6c-44814f651c7f', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('25', 'orn.nasir@emard.com', '$2y$10$/zpP2DJZ8t1sG8IlX0Vrq.oEZAPhR8A.vrlYqiIBc8Sq5mIXa830O', '2', 'Roy Schmidt', '1', '1998-01-05', '3', '3', 'New York Lake Apt. 767', '844-461-0591', '2016-09-21 16:05:46', '2017-07-08 00:46:55', '1', '1', '1', 'Quia quia incidunt quam dolor natus fugit. Esse commodi eius minus et maxime officia. Voluptatum tempore ipsum et voluptates qui.', '1', 'b2958463-f9fc-388f-8875-c8f26a0e1cc2', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('26', 'kub.webster@johnston.com', '$2y$10$Heua6Dq42wnii911Fwb11ORKGpUgzxwhMVrNxW50/K8A.d9ayhsK6', '1', 'Lue Rolfson', '1', '1987-05-26', '1', '8', 'Florida East Suite 889', '844-707-5401', '2016-08-24 08:41:27', '2017-07-22 06:40:20', '1', '1', '1', 'Velit iste nisi ut aliquid voluptatem delectus. Explicabo labore inventore aperiam repellat. Rerum sapiente autem rerum numquam et labore. Nulla consequuntur aut natus qui aliquid magnam est.', '1', '7b7bebc2-18cf-3181-80cd-c5e446acb310', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('27', 'pdeckow@gmail.com', '$2y$10$ELLSPrDW0FbdwPXI2QcJaenufjcBGxD2LH62pSaMrjtfOCTfDIs.y', '3', 'Leopoldo Will', '1', '2009-08-31', '2', '9', 'Utah West Apt. 602', '(888) 204-7464', '2016-04-30 03:26:10', '2017-06-28 22:32:07', '1', '1', '1', 'Soluta non dolorem quasi accusamus sit aspernatur eligendi. Ullam nisi omnis voluptatem qui aspernatur non ad. Iure ipsa hic ut consequatur sint odio optio. Qui quia omnis aperiam officia.', '1', '8d4c05ac-cfd1-3012-8a2f-fdd67837d564', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('28', 'lyda.hudson@torphy.com', '$2y$10$mGQw4fnHUeb4ULRO43Xf4eyAjJ42gX8AW32evwRDzyFE5DPVU1.NW', '1', 'Isaiah Ebert', '0', '1999-02-11', '3', '6', 'Maine Port Apt. 039', '(800) 815-2788', '2017-05-15 01:39:59', '2017-06-24 04:40:17', '1', '1', '1', 'Et quos provident quo perspiciatis nam recusandae praesentium. Quia eius numquam ut nihil debitis est repellendus. Enim laboriosam accusantium omnis quas. Ullam molestiae sed dolorum alias omnis.', '1', '3ef03194-d080-3874-ae7f-25b1facf0742', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('29', 'ada.goyette@beer.org', '$2y$10$GuhChIPJ9OHt2SYEYNpkFedoh3SDdiHlbv8UC50a0cjMxztQa3t4G', '3', 'Cordie Trantow Jr.', '1', '2001-08-31', '3', '3', 'Mississippi Lake Apt. 179', '(844) 556-6848', '2015-05-21 14:17:40', '2017-07-05 21:16:40', '1', '1', '1', 'Et eos voluptatibus aperiam. Accusamus voluptates pariatur voluptas iste occaecati. Consequatur odio ut consequatur est et quia.', '1', 'cfed90a0-9b74-3f0e-9484-f5ac64aa61ae', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('30', 'kerluke.andrew@ferry.net', '$2y$10$xw3T2wJ4IgRcTwwQ9n9nze38xDKw.9CZJfqLoumwxgdF9L0tGySgC', '2', 'Dr. Emory Marvin', '1', '1981-07-15', '2', '4', 'Connecticut East Suite 818', '1-855-636-6769', '2007-08-20 19:05:52', '2017-07-02 02:49:24', '1', '1', '1', 'Voluptate suscipit dolore vel dolores. Eum sunt blanditiis sint dolores nemo architecto pariatur.', '1', '29e9b2fb-bc29-33b1-a0d9-32ac123b5212', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('31', 'adrian78@hotmail.com', '$2y$10$OEOFq2OkUVdE8Z4zCZ9mK.sTgrOSex05RhYM9gA04cdgfrM2mHAW2', '2', 'Filiberto Gleichner PhD', '1', '1975-06-25', '1', '1', 'California West Apt. 674', '877.845.3296', '2010-01-08 20:38:57', '2017-06-29 18:14:23', '1', '1', '1', 'Quidem voluptatem quia ut enim voluptatum. Est similique sed harum rem recusandae. Tenetur aliquam minus nihil quo. Dolores voluptas et possimus.', '1', '09dd55eb-9481-3797-bfc5-115aa4126586', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('32', 'teagan.oconnell@sawayn.com', '$2y$10$z7jbFJXnHk4/UDo6jf73oeOEDAicAtqNVQ.VBoWmH7qMcd43CepUy', '1', 'Alexis Friesen', '1', '1982-12-09', '2', '1', 'Montana South Apt. 206', '888.749.3840', '2012-12-31 00:04:25', '2017-07-12 22:18:11', '1', '1', '1', 'Doloribus quae fugit corrupti accusamus eius. Placeat sit omnis dicta qui doloremque repudiandae nam pariatur. Eius eaque numquam inventore voluptatem. Ullam sunt aut error voluptatum.', '1', '40aec9ad-d534-3aa7-a529-eccb31d1554a', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('33', 'tad.huel@yahoo.com', '$2y$10$f.ATBr.2FUUuPOIfPTonE.zbnpcwqOilEauJunEDgfJ0zYo/xkaIO', '2', 'Shanelle Kuphal III', '0', '1986-12-18', '3', '5', 'Kansas East Apt. 733', '877.807.5625', '2008-10-04 19:59:55', '2017-07-18 09:19:47', '1', '1', '1', 'Quis ut recusandae necessitatibus sed voluptatem tempore. Dolores dolor omnis qui consequatur ullam dolor ea eius.\nProvident impedit sit libero vero. Explicabo sequi rem aut quia sit molestiae enim.', '1', '9876473d-76fe-390b-bbfe-b31c7f8baa29', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('34', 'holden.purdy@hermiston.com', '$2y$10$UCoQ05Pkwtf7Pm7d4zOKIu7soMhsWKu5Rysg00KACnshqTtn8E/Ym', '1', 'Prof. Nash Hettinger Jr.', '1', '1985-04-21', '1', '7', 'Hawaii South Apt. 593', '(877) 219-6317', '2011-05-05 01:12:28', '2017-06-24 15:58:14', '1', '1', '1', 'Dignissimos doloribus at hic deserunt est. Et amet voluptas non quaerat commodi.', '1', '09c56ab4-b2e3-3617-8769-9f76fd81df77', '2017-07-22 12:31:15', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('35', 'xmacejkovic@zemlak.biz', '$2y$10$VAN6/9TRM6bGowFcsV01i.xG2ZSOHjw912JZf6LQN3CQHDPDaFBvm', '1', 'Ian Yost', '1', '2016-09-21', '3', '1', 'Colorado Port Apt. 932', '1-800-662-1474', '2015-04-09 00:53:55', '2017-07-13 08:41:28', '1', '1', '1', 'Est numquam et voluptas sint nisi sunt. Est voluptatem quas magnam sed eaque. Magni odio facilis voluptatem voluptates in culpa repellendus. Voluptatem tenetur et voluptatum animi.', '1', '4631a69b-2540-357d-a57b-fad31447af12', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('36', 'josianne.funk@yahoo.com', '$2y$10$U7Fidf1mNutHsmnjmIlgeOGh3Dlfh4RcW4h9b2DWpPQ5pWkShOAh6', '3', 'Grace Sanford', '0', '2002-11-14', '2', '6', 'Missouri Lake Apt. 549', '1-877-544-6921', '2011-12-22 04:39:04', '2017-07-16 16:11:04', '1', '1', '1', 'Officiis odio doloribus voluptates et ea voluptatem voluptate. Magni minima vel ullam voluptas tempora quisquam. Et aut culpa inventore placeat sapiente nobis autem facere.', '1', '053beb2f-ceae-364c-9d35-0d0d24b3b2f3', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('37', 'nhayes@gmail.com', '$2y$10$h6F3ta7nDsKwbkNPDg4qOeUTMhB94ZlhRmQ.76nSenkgoHvsWd9DK', '2', 'Dr. Maudie Brekke DDS', '0', '1972-10-26', '1', '8', 'Vermont South Apt. 379', '(855) 583-6534', '2014-10-10 04:56:55', '2017-07-09 09:56:58', '1', '1', '1', 'Minima eius quae fugiat. Ut esse molestias fugit. Atque ab tenetur asperiores harum at maxime.', '1', '2a80acc7-28db-3642-ab06-92cfdf45d085', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('38', 'kilback.bennie@fay.net', '$2y$10$1hniK63s9vGX7hP/wU2dNOLX7tvmNq3fNFKmQzIQsihauhy./op8y', '2', 'Lamar Jast', '0', '1972-07-05', '2', '4', 'Missouri South Suite 206', '855-632-9769', '2011-04-04 08:59:11', '2017-06-28 13:43:29', '1', '1', '1', 'Velit sit corrupti aut dolorem deserunt quos. Molestiae consequuntur aut laborum. Et excepturi aut aliquam ut. Reiciendis voluptatem facere provident culpa repudiandae.', '1', '2c96231f-1358-3c9f-aaa9-d79520808283', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('39', 'fdubuque@gmail.com', '$2y$10$UQNV3sK9UeTR20piUD07nOUyXBjYAB1TaNkNp.S1LQcZgYr4MidGC', '1', 'Ms. Kariane Connelly', '1', '1996-11-26', '1', '7', 'Maine North Suite 384', '(800) 964-7530', '2012-05-29 11:49:40', '2017-07-07 18:22:59', '1', '1', '1', 'Vel enim illum inventore vero dolor dolor quo. Velit nostrum perspiciatis quod et veritatis. Nesciunt tempora aspernatur odit laudantium doloremque.', '1', '7b5af2eb-fc02-33f6-8743-27a89f68d129', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('40', 'mathilde.hickle@prohaska.org', '$2y$10$Z93BjRZoW2poeGh9rJCnr.gttQkK.uNGRffx2BuWOaCPzR6AiouyO', '2', 'Susana Russel', '0', '2016-08-10', '1', '1', 'Oklahoma New Apt. 278', '844-593-6959', '2016-09-12 00:57:45', '2017-07-08 11:47:12', '1', '1', '1', 'Pariatur odio et expedita esse modi voluptas. Explicabo dolor voluptas error sapiente. Et saepe recusandae et nihil magnam non.', '1', '8e2fd016-432f-3ea6-bec6-65b9c79955a8', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('41', 'quigley.enola@yahoo.com', '$2y$10$Hc39VXn.rGH.hR3adebcE.wyEpljFP1knenTDH/adii3Z4OlRcwuS', '3', 'Annetta Dibbert DDS', '1', '1974-07-15', '2', '9', 'West Virginia North Apt. 889', '(800) 491-5790', '2010-01-22 15:40:32', '2017-06-27 13:56:56', '1', '1', '1', 'Alias dolores quas quibusdam ut. Et maxime facere necessitatibus inventore. Doloremque eius id et eveniet. Non nihil est et ut veniam veritatis quidem tempora.', '1', '9cae1e5a-2ff8-36df-a35f-8ec2358772b9', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('42', 'esmitham@yahoo.com', '$2y$10$X/nBzvXrHs3RdxCaYg/RNuAr/.iNLI.DSleIz4SEDRl9/EsAaQD3G', '1', 'Lew Mayer', '0', '1987-01-15', '1', '9', 'North Dakota West Suite 955', '(855) 869-5361', '2012-07-01 23:27:09', '2017-07-14 08:29:35', '1', '1', '1', 'Nulla laudantium ipsa est vitae mollitia laudantium deleniti sunt. Neque occaecati voluptas dolorem sunt dolorem. Suscipit saepe sit qui autem ratione qui cum.', '1', '45f5e38c-b622-3165-b983-555bcfc12aab', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('43', 'srussel@murazik.info', '$2y$10$93iFBNqCE3OC6lAgews/nOW8/Iwe/lOruouijBDYULXmdmwmsnm/2', '2', 'Louvenia Conroy', '0', '1982-06-13', '1', '8', 'Wisconsin Port Suite 640', '855-421-2990', '2007-11-05 05:17:40', '2017-07-14 00:14:51', '1', '1', '1', 'Omnis corporis voluptas sit et ex ea. Nobis asperiores et iusto sed rerum commodi. Dolorem sapiente officia nisi excepturi beatae omnis.', '1', '87871b24-4db4-3db9-913f-efd7a178473a', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('44', 'reta33@yahoo.com', '$2y$10$GDO2F6Lc2xgwOV7Sv3z1u.h5oY7dMeJvrvuNE2msubvAJBGL7qt9S', '2', 'Miss Sarina Schmeler', '1', '1987-07-04', '3', '7', 'Kentucky Port Suite 034', '888-232-0220', '2012-05-04 15:19:11', '2017-07-11 17:02:40', '1', '1', '1', 'Nulla quisquam excepturi est repellendus consequatur et non. Unde deserunt facere ea ut quo explicabo at. Odio laborum aspernatur commodi provident. Iusto perferendis voluptatem error et.', '1', '72f9a663-d5e4-3f88-89f5-6266fba71f94', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('45', 'troy.parisian@yahoo.com', '$2y$10$nchmcIEYj7mwMtyHnEj9ZOtGpvEnGPbFPrXoMjblsjLP/mEXlXO2S', '2', 'Adella Leuschke III', '1', '2002-03-19', '3', '4', 'Mississippi West Suite 796', '888.301.1063', '2008-10-05 00:38:24', '2017-07-15 17:07:42', '1', '1', '1', 'Et libero explicabo nostrum eum. Eum ea modi sit et nesciunt ut. Autem libero adipisci incidunt eum. Debitis quas voluptas a voluptas corrupti. Eos labore perspiciatis aut.', '1', '4d5a37c4-805d-3f67-8804-0d37e4f1c3d3', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('46', 'zyundt@yahoo.com', '$2y$10$bgsEUUwD4RySzI3j4h0TYOcqq34rRZNhRBBk/vHUB66hwueUXw66a', '1', 'Leta Ebert', '1', '1979-02-26', '1', '2', 'North Carolina West Apt. 639', '1-888-642-8681', '2015-11-20 19:38:25', '2017-07-10 15:27:33', '1', '1', '1', 'Numquam expedita qui et blanditiis cum possimus. Voluptas et iure eum ut ullam at sint. Consequatur autem fugit autem non. Id aut non quis ipsam ea sint.', '1', '11893537-507e-3000-ad14-111f10f11936', '2017-07-22 12:31:16', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('47', 'qkonopelski@hotmail.com', '$2y$10$4XztgCVUoJIN/X9TSoyRTueQsmh5wknHFHrnN1yHmvm0Ojoz6FELy', '3', 'Reuben Brekke', '1', '1976-12-06', '3', '5', 'Minnesota Port Suite 820', '877.269.6485', '2015-04-20 06:18:41', '2017-06-30 00:38:25', '1', '1', '1', 'Nemo explicabo unde suscipit et ea dolores. Delectus maiores in consequatur voluptatibus alias porro. Rerum debitis ut et.', '1', 'da848337-2e06-35ef-9467-931b6af7e899', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('48', 'stephany44@bode.com', '$2y$10$KZDSlHqkZrvD021inCIh3.6ro04XC85v1LDI5GSGfNZ1.Ja2Omh1u', '3', 'Olaf Reichert', '1', '1989-12-08', '2', '5', 'California West Apt. 332', '866-375-8786', '2009-01-19 15:35:29', '2017-07-21 17:10:30', '1', '1', '1', 'Sit est quia fugit dicta quae alias esse. Eum fuga aut voluptatem vitae exercitationem minus. Velit voluptatum ullam blanditiis aut sapiente.', '1', '3d64c5bf-ec03-3d00-b70d-4f64116ea82a', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('49', 'kirlin.raegan@hotmail.com', '$2y$10$sV2T/vUiPoUkjUINB/7k7uuPM4ZrS33z/U02EXjNZ2AXqVAKzqKai', '2', 'Easter Tromp', '1', '1977-01-25', '2', '8', 'Vermont Port Suite 130', '(844) 647-6422', '2013-11-03 00:33:29', '2017-06-30 00:51:50', '1', '1', '1', 'Ipsa dolorum minima ut sit est tenetur itaque iusto. Natus itaque est quidem distinctio consequatur eum.', '1', 'f16ec590-e87c-3aba-913f-c6b39c0c0100', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('50', 'cheidenreich@feest.com', '$2y$10$c3sReS0IAB.who3tdYz.suaYf1z1hdDg0fhDY0MaYLE7vhur0bOya', '3', 'Mrs. Vickie Terry', '1', '1994-03-10', '2', '9', 'Alaska East Suite 293', '866-783-7710', '2008-05-08 20:36:20', '2017-06-26 04:14:12', '1', '1', '1', 'Quibusdam eum omnis consequatur quibusdam quibusdam. Quia et laudantium sed voluptas earum qui ipsum. Vel quo deserunt eos et numquam.', '1', 'fb3b036e-6b57-3e95-93e2-6c42e6835372', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('51', 'maurice36@gmail.com', '$2y$10$3MWe85y9mfAnuaqzjkB4WulQi2fgrNRwbwYqK.6TWpcjmY2MTdG5S', '2', 'Laron Langworth', '1', '2014-06-10', '3', '3', 'Nevada North Suite 815', '1-844-523-8972', '2013-11-23 14:39:42', '2017-07-21 15:02:39', '1', '1', '1', 'Eligendi eum doloribus sint sed voluptatem error. Dolor non doloribus delectus non qui culpa id. Quam ut labore ducimus facere rerum deserunt.', '1', '29ac54d4-bd2f-39f4-bbaa-6e56f279f1a2', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('52', 'mozell.mertz@yahoo.com', '$2y$10$DLodfgtTB98HyeE1Cjmup.WDyBOlNTf6Hr8njlgy1WQrBRHPRJSai', '2', 'Mr. Tremayne Torphy DVM', '1', '1993-11-23', '1', '1', 'Nevada North Apt. 729', '800.799.7105', '2008-02-16 20:16:14', '2017-07-16 18:09:22', '1', '1', '1', 'Quo sequi voluptate voluptates quos et. Praesentium aut voluptas voluptatum sint voluptatem aliquid. Fuga nulla et doloremque voluptatem. Qui ab nihil aperiam velit cum exercitationem ut.', '1', '847525c0-5431-3c8d-b4bb-8574257168db', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('53', 'idella.rodriguez@jenkins.com', '$2y$10$vTsw8dmACtCU3/imiAJVg.TgdUuPjMCI8jJ1Vt6RfM2LUNehpTiVS', '2', 'Mrs. Alessandra Ryan DDS', '0', '1990-12-30', '1', '6', 'Michigan South Suite 197', '1-866-438-1846', '2012-04-03 22:56:49', '2017-07-15 23:42:07', '1', '1', '1', 'Illum et vel autem aut sed sit veniam. Voluptatem consectetur voluptatem ipsam culpa sit fugit dolorum. Nesciunt sed dolores eos et. Nobis est illum officia est incidunt excepturi.', '1', 'c62273b0-1260-3cea-aded-632bfffe3f9c', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('54', 'jayden.volkman@hayes.com', '$2y$10$mF9r4wzybwZuGmZrTGxc0umAMgoGc3p6JNctMpPJ72usQXP4Zk.hq', '1', 'Prof. Jermey Weissnat Jr.', '1', '2016-10-22', '1', '3', 'New Mexico Port Apt. 868', '(800) 418-3125', '2012-11-29 19:45:21', '2017-06-25 16:34:03', '1', '1', '1', 'Quia voluptate autem ut et facere eum id soluta. Ut voluptatem non laboriosam sed et. Nisi sunt quo repellendus.', '1', 'e55d0fb1-31b7-3bf1-b429-72db8e3cbf98', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('55', 'lucienne88@greenholt.org', '$2y$10$McaRViyMvz9mm5aoFXnLa.CnOt7oie8.Jn0xRLRe/KAlBkai5xvTy', '3', 'Kyler Jacobson Sr.', '1', '1997-09-02', '1', '7', 'Tennessee West Apt. 418', '(877) 765-4818', '2012-08-21 17:21:49', '2017-07-15 11:40:47', '1', '1', '1', 'Ut odio quis deserunt autem fugit qui. Aut optio adipisci quis facilis aperiam. Ex aut aut ut aut nihil omnis in.', '1', '624e791a-aa58-3805-9c86-49ce1cfc96a4', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('56', 'douglas.richard@huel.info', '$2y$10$z4JFnTw2FMaEKX1X6td2De97LmNZm/oj696RR4jLvteCjXA2xxvoy', '2', 'Armani Flatley', '1', '2003-11-24', '2', '6', 'Maine East Apt. 604', '877.402.5621', '2009-05-01 14:32:57', '2017-07-10 09:47:06', '1', '1', '1', 'Suscipit quae delectus ea blanditiis enim. Repellendus blanditiis quo perspiciatis voluptas atque consequatur. Sunt exercitationem rerum iure ut. Doloribus non mollitia qui et quia hic.', '1', '30f318f9-c98d-375b-a223-b2a774f1f6f1', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('57', 'rkling@gmail.com', '$2y$10$HDBvdYt4LdSLJEWQ0eldAOqX5t99JjJE5ogiQ6f5nCLGTe.GjjyFm', '1', 'Raphael Krajcik', '0', '1997-08-06', '2', '6', 'Alaska Lake Apt. 328', '855.445.2532', '2011-10-11 18:12:48', '2017-07-01 18:28:58', '1', '1', '1', 'Optio ipsa aperiam enim tempore. Sed ipsam expedita pariatur at. Architecto sapiente neque quo doloremque aut ea.', '1', '4cd24da1-ed2c-398f-8903-541efafcd657', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('58', 'shayne61@koch.org', '$2y$10$562W40eVm12KR8Klfy5jRuhjpXuUhjhVFqXMNEOgRpXYaL.MaY9Wi', '3', 'Clay Stiedemann', '1', '1971-04-30', '2', '8', 'Arizona East Suite 251', '866.366.5054', '2011-06-03 20:02:05', '2017-07-01 16:00:44', '1', '1', '1', 'Sapiente a iste porro deserunt dolores accusamus enim. Repellat nemo autem laborum laborum repudiandae sit. Ad et dolorum sint sed.', '1', '45371918-8cfe-3e8d-bde1-9cff1eb6a925', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('59', 'mertz.art@hotmail.com', '$2y$10$i1.iLNYVBiQofCryqjhoIO2HDFPdQhsC9Bqgi1dFj5O1u7Aq8Skua', '3', 'Miss Alessandra Wolf DVM', '1', '1971-12-27', '2', '7', 'Mississippi New Suite 874', '(888) 384-4786', '2008-09-26 04:35:06', '2017-06-23 00:58:28', '1', '1', '1', 'Ex deleniti commodi cumque sint aut cum. Nemo numquam saepe quam eum. Quis aliquid unde aut repellat. Sint ad ut dolor consequuntur atque.', '1', '5e63b52b-0e55-340c-8ae8-b8874aa82751', '2017-07-22 12:31:17', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('60', 'ikautzer@beahan.com', '$2y$10$XwfhreUQ68IiEiYC0srBuOL/MWUxW.ike/FuBfXXMC2BOCLBpQZMG', '3', 'Virgie O\'Conner', '1', '2011-03-11', '1', '8', 'Oklahoma Port Apt. 354', '866.450.7467', '2008-05-07 12:57:07', '2017-07-05 04:50:17', '1', '1', '1', 'Alias quia ab fuga quis laborum praesentium mollitia unde. Assumenda quos iure et sequi quae. Atque ratione dolorem dicta soluta.', '1', '34bdfc3a-1b71-346e-8280-053f2524782e', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('61', 'nayeli76@hotmail.com', '$2y$10$luOIZ5eq.7VVePCP1d4cd.wZdf1WI7qulw3BILSsnNVLdsIhryDRa', '3', 'Jacinto Jacobs', '1', '1999-09-12', '1', '4', 'Michigan South Suite 039', '877-951-4491', '2010-08-02 07:24:12', '2017-07-18 18:19:48', '1', '1', '1', 'Qui consequatur eveniet mollitia natus aperiam alias fugit. Nihil nemo quis quia pariatur soluta aut. Nemo eum impedit id reprehenderit perferendis libero dolores asperiores.', '1', '19e022ac-b668-353e-9011-e2581ccecc82', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('62', 'ryan.carolyn@mann.com', '$2y$10$sh.Nd8TiH1b7kUIiBpr7oegUwtqCBq/xmk1DZ16d.EsozGwiexpv.', '3', 'Prof. Jaylon Dickinson', '1', '2010-11-01', '2', '9', 'Louisiana Port Apt. 537', '855-570-6487', '2012-08-21 10:10:07', '2017-07-12 23:56:03', '1', '1', '1', 'Eos necessitatibus libero et quae fuga ea quia. Quis ut libero velit culpa. Omnis quo est quis facere nisi ut officiis qui. Est quae sed aliquid rerum rerum.', '1', '55ffe7d4-6df4-3631-a8b6-a7d462b5ec58', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('63', 'kuphal.cara@yahoo.com', '$2y$10$vxubq992U.wh.RK4EuHqtOtP94j5WIgoWi8igbDP68XtNssZ3/Gca', '1', 'Mrs. Willie Crooks DVM', '1', '2010-08-01', '3', '3', 'Texas East Apt. 987', '866-356-0572', '2017-06-19 00:31:48', '2017-06-29 04:07:28', '1', '1', '1', 'Quasi voluptatem quis tenetur. Non maiores qui eius. Ratione qui sit dolor similique.', '1', 'afa821ac-aa96-3bce-a179-2ff73839b7b1', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('64', 'adrain.turner@gmail.com', '$2y$10$opUZ.OFRbtBKYTisRrVkruFrE2PEkRtpTm/hwl.vi0bWf5Mov7MZa', '1', 'Vergie Rolfson', '1', '1975-04-13', '1', '5', 'Nevada West Apt. 949', '(844) 620-9441', '2008-07-26 04:23:10', '2017-06-24 05:35:42', '1', '1', '1', 'Quia ab quos magni eaque suscipit. Numquam magnam dolores omnis soluta molestias. Ex totam et a doloribus beatae similique impedit.', '1', '378453e3-9a42-3b1d-9134-cba21f6c7488', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('65', 'margaretta57@yahoo.com', '$2y$10$VqC58t5Ih1.1Q5ZInrrSWOc3cXmAI2TV230aw6jJFdv..kuFRpzvC', '1', 'Gerald Kilback MD', '0', '2017-06-08', '2', '6', 'Kansas New Suite 059', '(800) 573-3224', '2012-01-13 23:17:53', '2017-07-02 20:10:49', '1', '1', '1', 'Officia doloremque reiciendis et doloremque ipsa delectus. Sit facere impedit ullam praesentium. Laborum perspiciatis vero odio molestias enim dignissimos. Recusandae voluptatem et velit natus.', '1', 'e4317824-883e-3a5d-8be6-3b1182ef3f60', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('66', 'hahn.hudson@hotmail.com', '$2y$10$YbCIVyVU8YEbVg6B7rs5Feq6opEmSu8iymS5dQP9lzUyAC39b8lBm', '1', 'Yasmine Lindgren', '0', '2007-06-15', '3', '5', 'Oregon Lake Suite 177', '(877) 561-0131', '2016-06-15 16:00:50', '2017-07-15 18:55:22', '1', '1', '1', 'Non eos similique eius aliquam iusto aut ea. Consectetur quas mollitia dolor quo. Commodi maxime dolorem consequuntur.', '1', 'b932e888-e5a3-3553-9291-2526f4009bc6', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('67', 'rbergnaum@gmail.com', '$2y$10$MuQgu3I7I/2ivSi6wA0mO.hNkIMTkeGwDHkN9wd25RkaETS59xKsa', '1', 'Prof. Rhiannon Gorczany', '0', '1987-09-24', '2', '6', 'Wyoming South Suite 516', '1-844-456-1381', '2017-04-03 14:05:40', '2017-07-04 03:31:23', '1', '1', '1', 'Quasi esse consectetur dolorem quia. Itaque debitis sequi asperiores est sunt recusandae voluptas aut. Ea doloribus necessitatibus quia sit.', '1', 'f067b165-f75b-3f6f-8c1a-ab3bd7b826f5', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('68', 'vkohler@yahoo.com', '$2y$10$iZmS2tgKmTY1Au7BSX7gLu0tvl4Y9/OHbgSueSVbB2D3b/fKCVsv6', '1', 'Brice Cormier', '0', '1990-06-23', '2', '4', 'Wisconsin West Suite 328', '888-403-9989', '2014-05-31 16:55:47', '2017-06-22 13:53:14', '1', '1', '1', 'Vero repellendus sed culpa. Doloribus magni omnis quam neque ut dolorem. Vero dolor et doloremque odio.', '1', '3bed1f2b-fc20-3d15-9ed4-df2bed01275d', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('69', 'ofisher@yahoo.com', '$2y$10$QsH/ddICVkkhy7UPnLILY.ZSMmAu8AOUSl8z7AmvZGTJu23kjvzRG', '3', 'Dr. Jewel Runolfsdottir', '0', '1974-04-16', '3', '8', 'Oregon New Suite 761', '(866) 747-2421', '2013-07-14 21:48:35', '2017-07-19 07:39:16', '1', '1', '1', 'Nemo aspernatur vel architecto quae porro sapiente. Ut illo corporis unde non eius sequi. Ab quia similique perferendis fuga et quis omnis.', '1', 'f54865ac-4fad-36ee-b9f8-1de37a1c7087', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('70', 'bernadine83@hotmail.com', '$2y$10$PbKINY1Yocl6V9sZNMzDQ.sSeIlvnBGQMwRZpNQVVlSQfMWo2U04G', '3', 'Mrs. Valerie Kemmer V', '0', '2010-01-06', '3', '9', 'Colorado West Apt. 632', '1-844-477-9060', '2015-09-08 22:25:00', '2017-07-04 02:43:10', '1', '1', '1', 'Et possimus non sunt aliquid. Ut necessitatibus architecto id itaque saepe quis enim sapiente. Numquam sed consequuntur non. Nulla officia et incidunt.', '1', 'd2fe41de-5647-31c9-ad5e-aa66e65d8964', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('71', 'caterina.gorczany@jerde.com', '$2y$10$fJ90iMzGLUhY60EDOoL6.uEOpPcAynkQJonL4H28OoTmI9SptAG7G', '1', 'Theron Ondricka Jr.', '1', '2009-09-22', '3', '6', 'New Mexico West Suite 201', '1-844-732-9771', '2011-03-06 23:17:34', '2017-06-29 13:16:59', '1', '1', '1', 'Aut voluptates dolores voluptate magni consequatur placeat. Sint libero reiciendis aut eos alias sint. Non dolores soluta ut non.', '1', '19130bd2-4090-36a9-becf-2b46044d6532', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('72', 'sanford.celestine@hickle.com', '$2y$10$6I5VWPUOuWRFJdZ4jKVN3OyhSQuU3UruZn85SeNz45UYbBYjr85fq', '2', 'Isaac Wuckert', '0', '2010-09-24', '2', '6', 'North Dakota New Suite 757', '855-917-4111', '2010-07-25 03:52:42', '2017-06-29 23:36:39', '1', '1', '1', 'Eius incidunt voluptas quo eaque. Dolor sed beatae id recusandae. Omnis aperiam dolore doloribus cupiditate tempore.', '1', '2c41e31f-5f53-3895-94ae-f25080e5f0a5', '2017-07-22 12:31:18', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('73', 'creola31@stark.com', '$2y$10$OFKS/QhtYIBU6xjr2xcMVesjWNMnXNGp7NjtDvhFYDv1mfWSvcw8K', '3', 'Maye Turcotte', '0', '1999-10-12', '2', '5', 'Washington South Apt. 004', '1-855-605-2208', '2016-08-16 02:47:54', '2017-07-05 08:27:59', '1', '1', '1', 'Quidem possimus aliquam laudantium doloribus commodi. Quasi sit nulla nulla aut reiciendis est. Rerum tempore deleniti impedit.', '1', '671f29b3-d43d-34f9-942e-52691756f6fa', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('74', 'metz.rosendo@yahoo.com', '$2y$10$MT147It1fY/GlJtiBoHPpu4i6PX7HvZp45eF9F6iwOU9fEuFj7YNK', '3', 'Prof. Lorine Reynolds DVM', '1', '1995-08-23', '2', '3', 'South Carolina South Suite 488', '800-991-1105', '2014-06-19 16:49:56', '2017-07-02 01:33:23', '1', '1', '1', 'Harum repellat quis minus provident quis iusto. Enim delectus cupiditate non recusandae.', '1', 'f12ae375-36f8-3e93-b60f-18f588e057b4', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('75', 'kuvalis.stanley@cole.com', '$2y$10$gP2USy6d/eKOkbYEG/C2KOuwMxUzIQDaDZze0zjQEYV53qtehak/i', '1', 'Brenden Feeney', '0', '1980-07-13', '1', '9', 'Nebraska Port Suite 036', '1-844-348-2215', '2010-04-19 06:07:33', '2017-07-15 08:06:31', '1', '1', '1', 'Doloribus qui incidunt dolorem sint perferendis enim. Dolorum voluptas velit dignissimos vel a ut reprehenderit. Reprehenderit dolorem sed earum quibusdam numquam dolorem.', '1', 'ef1f0b37-db58-3a70-8f91-051ca081d0a0', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('76', 'ruthe.klocko@hotmail.com', '$2y$10$PWfywLFuvgkfUX97/hbBJ.qdR.eI0i.A9o4J3J2tCjrq1aGni.Pe2', '3', 'Marjory Mayert II', '1', '2002-09-25', '3', '7', 'Arkansas Port Apt. 229', '844.374.4666', '2016-11-28 21:37:37', '2017-07-13 17:17:21', '1', '1', '1', 'Rerum delectus praesentium alias aliquid aliquid veniam iusto quasi. Officiis quas molestias minus at quo et. Consequuntur et asperiores cupiditate repudiandae quaerat.', '1', '5db33795-185f-3d86-8132-2e050d344c38', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('77', 'istokes@hotmail.com', '$2y$10$849OkAWgLQLYr7wY0Qc.1eWEO74tBUwHBbu6dgwaViuukhYmfS2MO', '2', 'Mrs. Vilma Greenholt', '1', '1982-04-14', '3', '6', 'Tennessee New Suite 785', '866.571.8336', '2016-07-06 04:56:55', '2017-06-24 09:30:57', '1', '1', '1', 'Tenetur ea magni veritatis impedit. A eos aut vel iste. Culpa labore et rem dolorem. Quam deserunt id ipsum unde inventore.', '1', '657c7bd1-67ab-374d-89bf-916b1276e75c', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('78', 'phegmann@yahoo.com', '$2y$10$Q6NaGsTQ45iRVJUsaxlPle85/fPupGbO3T33rVReCOpRXK8kUWtye', '3', 'Kattie Rodriguez I', '1', '2011-10-02', '2', '8', 'Tennessee North Apt. 249', '855.457.4935', '2008-09-15 06:49:51', '2017-06-28 15:53:10', '1', '1', '1', 'Odit exercitationem velit deserunt. Ut quae velit enim possimus reiciendis molestias. In cupiditate dolores qui qui.', '1', 'd72bef0f-1d61-3b58-8630-4616edac71f9', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('79', 'kbosco@gmail.com', '$2y$10$jkurpQLgGt2l1CDJEdH44.ZfVRMCBpBq3iJ9J4Me./9sLClL/IxBm', '3', 'Hester Hickle', '1', '1998-04-09', '3', '4', 'North Dakota South Suite 565', '855.839.6410', '2016-08-09 01:28:05', '2017-07-04 02:44:33', '1', '1', '1', 'Enim voluptate molestiae sit iste recusandae et. Qui aut aliquam voluptatem laboriosam nemo officia ipsam.', '1', '4e9d73b1-00fa-3866-9f0e-0ac9a7c677bd', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('80', 'ymiller@hotmail.com', '$2y$10$tLfpxKUUsYcrK4jNjeKOXu0C06Y/dwW.dfSNk9vP/fFMNkppI6Rzm', '1', 'Macy Lubowitz', '1', '1984-05-24', '2', '7', 'South Carolina Lake Suite 090', '1-855-992-6309', '2013-02-04 11:07:34', '2017-07-12 09:22:02', '1', '1', '1', 'Velit sint illum excepturi quas voluptate nisi. Sit eum ipsum sapiente commodi incidunt hic. Sed minima quam qui eligendi.', '1', '498ca4de-c607-3afc-bce9-37365eef34ab', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('81', 'rohan.summer@mertz.org', '$2y$10$D1KIaHXsLptft2wBi5W85et76M8P4x30vbE01Ov4Kx2JFF9f/6Loe', '3', 'Mr. Kay Cormier', '0', '1972-10-01', '3', '3', 'Louisiana South Apt. 004', '855.547.4334', '2012-12-20 20:30:55', '2017-06-26 00:14:41', '1', '1', '1', 'Laboriosam eos consequuntur doloremque maiores in et. Voluptas et aperiam consectetur natus dicta fuga voluptates enim.', '1', '676ccf7a-8e64-3f0b-973c-d0f11d305981', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('82', 'bertram61@gmail.com', '$2y$10$nhIEw7vuiRqEpDWjoVWTrezi3WFBkw2m6KGui1CHoxzhkz1geY/tS', '2', 'Johnathon Williamson', '0', '1973-11-25', '2', '8', 'Missouri Port Apt. 452', '1-844-462-1098', '2015-07-16 16:49:10', '2017-07-08 00:05:57', '1', '1', '1', 'Repellendus rerum dolorem voluptas earum qui dolorum. Quod provident dicta beatae aut natus adipisci dolore. Voluptate et aut maiores alias dignissimos quisquam iure nisi.', '1', '23a9e75d-0743-33b1-b69b-b8e7e4ad6de2', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('83', 'adonis35@klocko.com', '$2y$10$n2c54BjEg1O1taqmWuZS..itVrhfdlLF.rOUVyn/DoC25JP1kkEO6', '3', 'Theodore O\'Hara', '1', '1998-10-07', '3', '3', 'Iowa Port Suite 260', '1-866-534-6771', '2008-04-22 06:38:11', '2017-06-27 03:12:57', '1', '1', '1', 'Fugiat dolor aperiam aliquam. Laudantium illo consectetur maxime aut corporis. Labore nemo accusamus non numquam. Ex omnis repellendus laboriosam temporibus qui voluptatem nihil.', '1', 'd9d88e20-b027-3bab-b117-61a7d3a06a95', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('84', 'vince.graham@yahoo.com', '$2y$10$xIdKzmnK.2l9cx7Xqh33uOPKkAT2RKc61YBwiXXmrnZ5q4Q.uE2ka', '1', 'Mrs. Karelle Kassulke', '1', '2012-11-08', '1', '7', 'Vermont New Apt. 411', '1-844-437-6489', '2014-08-13 16:21:45', '2017-07-16 13:28:52', '1', '1', '1', 'Quibusdam dolores quis impedit quaerat. Soluta est molestiae non nihil et blanditiis dolor. Omnis quaerat in saepe autem. Totam minus aut quod quos.', '1', '3efcb83a-1cd9-36bc-98f9-f8226a0ae832', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('85', 'micheal16@yahoo.com', '$2y$10$WXbGRiOpoa/M6IpPD2CGXOFFb13ioNWOj23tjppe5dM9Zk7aTb126', '1', 'Pearl Hermann', '0', '1978-04-10', '2', '2', 'Utah West Suite 529', '1-888-379-1774', '2008-01-30 23:22:43', '2017-07-16 13:21:07', '1', '1', '1', 'Expedita quis molestiae sunt. Perferendis soluta aspernatur et delectus iusto est dolore. Nostrum rerum veniam consequatur dolorem saepe assumenda voluptas.', '1', 'e4856b8b-e57b-3db8-8620-555983f0ec1b', '2017-07-22 12:31:19', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('86', 'luettgen.maritza@waters.com', '$2y$10$wa47XRWYVN4NlP.COPyaJukwkbhenldkQ6tdzJD6P5SZPpByZxkZi', '1', 'Nikolas Parisian Jr.', '0', '2007-01-28', '2', '6', 'Delaware New Suite 589', '855-288-8151', '2009-02-18 23:32:34', '2017-07-08 14:54:53', '1', '1', '1', 'Omnis ab repudiandae cupiditate qui consequatur. Pariatur fuga quas harum atque eius. Ut est qui saepe quae. Ut aut ipsum reiciendis.', '1', 'b5f17983-8967-30e5-bcd9-e557dfca886c', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('87', 'leonardo10@hagenes.com', '$2y$10$wazzF3wZR.HQuqKrOhcetuQHfxrHBtqRoGqKSIWIOpIwAdPnZcZJO', '3', 'Prof. Vena Gutmann', '1', '2014-05-22', '1', '7', 'Texas East Suite 565', '(800) 422-9128', '2013-08-24 20:16:55', '2017-07-16 19:14:58', '1', '1', '1', 'Voluptate alias fuga aspernatur ut. Aut illum cum tempora aut. Sit non sint at rem illo tempora. Ipsa reiciendis omnis sint nesciunt ea.', '1', 'd76d906b-c0db-3365-b8c9-bde8a859c1b4', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('88', 'hharber@waters.net', '$2y$10$aE/iqQbj1GsZneVxX2Hc5eplGsHATSV3ISeGy7aH5f1swcQ6MteeK', '1', 'Prof. Jeromy Hills', '1', '1970-04-08', '1', '3', 'Nevada Lake Suite 710', '800-909-6039', '2009-07-25 03:37:59', '2017-07-04 05:01:47', '1', '1', '1', 'Aut qui excepturi animi vero rerum tempore ad. Eum tenetur eveniet ipsa et quia soluta et qui. Et officia aut ab similique quaerat aliquid sunt dolores.', '1', '78ce1c33-53e4-3831-8c29-0542b5d5157b', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('89', 'julia83@bogisich.com', '$2y$10$SG4IKM/9xGQmGkZkN6.ORusDURvP/l52/b8ZqSn3X890PXOk1pEGC', '2', 'Ms. Elsa Wuckert Sr.', '0', '1990-12-07', '2', '5', 'Idaho East Apt. 493', '(800) 979-1774', '2008-09-22 20:45:35', '2017-07-01 12:45:16', '1', '1', '1', 'Dolore perferendis in laudantium modi. Alias voluptates cum aut iste aliquam. Culpa earum optio nemo officiis voluptates architecto. Quia doloribus eveniet maxime est sunt non ipsum.', '1', 'f2552210-6977-34ca-8721-4491e68fe5e2', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('90', 'bettye60@hotmail.com', '$2y$10$vWxUJ4LAKwLxVSNcEcfvaOLGhBXO9f1xqlqKOXHhRgXv0MEz3KV4K', '1', 'Dr. Delbert Keebler', '0', '2003-04-21', '1', '7', 'Florida South Suite 358', '1-888-386-0100', '2008-03-05 14:44:07', '2017-07-15 17:54:19', '1', '1', '1', 'Omnis tempore quos corrupti aspernatur vel et sint. Debitis vel delectus eum doloribus omnis excepturi. Reprehenderit commodi aperiam id repudiandae qui magni.', '1', '2ba2bf44-ab0d-3d72-b795-b5a02d468ed2', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('91', 'micaela.brekke@kuhn.net', '$2y$10$72TSVsGu1A4IXYnuRxaN6eOfVt8PhoZAn0kirU/RIXwEfa9N8/eU2', '3', 'Adolfo Gulgowski', '0', '1971-05-30', '3', '2', 'Nevada Port Apt. 044', '844-218-1810', '2010-08-23 07:53:41', '2017-07-14 00:19:14', '1', '1', '1', 'Rem debitis nesciunt quis. Laudantium cumque et voluptatem ea quis. Eum deserunt qui nesciunt mollitia. Laudantium qui ex unde hic est error.', '1', 'eb4511f5-a068-34cf-abac-8f7353f5e309', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('92', 'melvin.funk@brown.com', '$2y$10$k2K8Q2jFZtRLsSDZyylG2e.f2BIf.6E8AfF06oA8YC8DgrCEWrgmi', '3', 'Florine Effertz', '1', '1991-05-27', '3', '3', 'Colorado New Apt. 744', '844.207.8662', '2015-11-06 20:57:01', '2017-07-16 20:45:08', '1', '1', '1', 'Fuga porro sit quas dolor eligendi. Omnis ad nesciunt eius consequuntur culpa doloremque. Molestiae quidem perspiciatis aut nostrum commodi accusantium.', '1', '13e077ba-6918-3714-b8f4-76044dbbac31', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('93', 'romaguera.gerhard@ledner.com', '$2y$10$BOrjgDmzpZ53U.cMdTzylejNTjOQ071XbRZj3HNqh7C9CF51xemBm', '2', 'Dr. Virgie Howe II', '0', '2001-09-23', '2', '4', 'Utah Lake Apt. 099', '877.717.8228', '2011-01-07 03:07:28', '2017-07-06 21:23:41', '1', '1', '1', 'Unde delectus autem et omnis. Et sunt fugit quisquam veritatis. Qui mollitia ea in quia aperiam.\nCumque iure doloribus perspiciatis voluptates. In possimus accusamus velit ut ex tempore asperiores.', '1', 'a797644d-6db0-3b67-aca1-c4c12f7e62ee', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('94', 'emmanuelle41@schneider.com', '$2y$10$stFaiUk0fbMYZ1FEM7DPiua0t/5RGnsnHfeL9QKKEwbP5ksUgIwsO', '3', 'Miss Kattie Gislason', '1', '2001-04-19', '3', '8', 'Georgia Port Apt. 982', '800.537.6147', '2010-06-08 08:15:57', '2017-07-01 21:26:40', '1', '1', '1', 'Similique nulla ab nostrum quam fuga vitae. Est quisquam beatae eveniet commodi autem hic voluptates. Et debitis pariatur qui. Autem excepturi temporibus sunt et.', '1', 'd62d2593-6347-3bb7-906d-078d37f99018', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('95', 'vandervort.bettie@gmail.com', '$2y$10$Fvjz00l5YYH8HFOJ3tl8T.Kj0T9RCYqQXT8bRZc29doDbmKAswn/K', '3', 'Annabelle Von', '1', '2009-09-07', '1', '5', 'Michigan North Suite 304', '844.795.8177', '2014-06-25 06:44:15', '2017-06-28 14:27:33', '1', '1', '1', 'Maxime et velit molestiae provident laudantium. Blanditiis dolore nihil et veniam cum.', '1', '5ab183aa-1db3-3c20-9e96-3c536a8648f2', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('96', 'ethel.mosciski@hotmail.com', '$2y$10$PzOZnh5ZVXJzW0KAYFN71ey1cmFlUnfVq5qHDfQi5OXEb2fY4T.Je', '3', 'Hester Frami DVM', '1', '2016-01-24', '3', '1', 'Illinois Port Suite 271', '1-877-221-9440', '2012-04-12 07:02:59', '2017-07-12 09:01:51', '1', '1', '1', 'Et in sit molestiae ut ullam esse asperiores. Et exercitationem et explicabo animi autem. Autem eum qui nulla similique quia praesentium. Sunt eius rerum laudantium harum sed.', '1', 'f02a98a5-685e-34d2-9b29-d19cd92255e7', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('97', 'purdy.misty@yahoo.com', '$2y$10$MjWdOAnvPzLVbuEuJtdvh.wrj/lqGbxpQheAjGJYhxBFkyhEsLuHC', '2', 'Taylor Douglas', '1', '1988-04-30', '3', '3', 'Connecticut New Suite 509', '1-888-544-9895', '2008-11-02 15:41:59', '2017-07-22 09:29:23', '1', '1', '1', 'Illo enim rem et ut. Omnis ab ea earum et. Voluptas fugit commodi labore voluptatibus beatae. Totam dolores est ut mollitia quaerat.', '1', 'ec8491ad-1d23-3511-bf94-25d311566cf6', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('98', 'raynor.agustin@gmail.com', '$2y$10$5.PqGyTv0Tkh0d0Dyn9Zy.x8c/Ph7gElKoZM3hU6qVP1zkjTgxclu', '2', 'Prof. Osbaldo Schimmel', '0', '1976-03-04', '3', '3', 'Louisiana East Suite 745', '1-888-427-2333', '2014-04-18 20:52:15', '2017-07-20 10:22:45', '1', '1', '1', 'Est quia eaque quo esse quia velit tempore. In doloribus repellat qui sint.', '1', '1c24260e-1aa6-30e2-811c-34e769bc9e71', '2017-07-22 12:31:20', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('99', 'yoshiko.balistreri@yahoo.com', '$2y$10$rkiDQKr5FMqlJ1Mq06M2hOxT.edpXdp7pJvc0muJRvA/Zq9rcmU7y', '3', 'Marshall Gerlach MD', '1', '2012-11-26', '1', '4', 'New Mexico Lake Apt. 867', '1-855-763-7756', '2008-12-24 00:42:08', '2017-07-05 06:17:45', '1', '1', '1', 'Dolorem rerum deleniti quod corporis et. Dignissimos aperiam numquam commodi hic doloremque. Vel quos perferendis aut. In sint ut totam non qui vel ad.', '1', 'ff36911a-8f58-3f24-939e-f375c08ca50d', '2017-07-22 12:31:21', '2017-07-22 12:31:21');
INSERT INTO `users` VALUES ('100', 'alden.kris@koss.com', '$2y$10$twu12nfnPYDU/sqTwstAsutD3OqEGFwS7bM5TsmpOxPuMpPdzUx7y', '3', 'Dr. Tabitha Emmerich', '1', '1978-06-05', '2', '6', 'West Virginia West Suite 688', '800.649.1803', '2014-09-04 10:50:01', '2017-06-24 15:42:46', '1', '1', '1', 'Dolor repellendus explicabo ea voluptatibus. Perspiciatis est libero sed cupiditate est. Quisquam cupiditate eius et velit tempora aut vero.', '1', 'b21abbd0-cafe-3a2f-aca6-f3d98786df53', '2017-07-22 12:31:21', '2017-07-22 12:31:21');

-- ----------------------------
-- Table structure for user_transmission_history
-- ----------------------------
DROP TABLE IF EXISTS `user_transmission_history`;
CREATE TABLE `user_transmission_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_tool_id` int(10) unsigned NOT NULL,
  `sent_date` datetime NOT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_transmission_history
-- ----------------------------
INSERT INTO `user_transmission_history` VALUES ('1', '12', '1996-01-22 00:00:00', 'Laboriosam saepe et quia vel eveniet nemo. Officia non ut consectetur a dolore. Dolor dolores ullam incidunt quo cupiditate voluptas.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('2', '1', '1994-08-21 00:00:00', 'Dolorem aut et sed. Voluptatem tempore occaecati libero ut et. Sequi voluptatibus est possimus. Dignissimos quos dolorum eos provident. Et est cumque ipsum vel sed aut voluptas.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('3', '12', '1988-04-22 00:00:00', 'Vel reprehenderit et rerum expedita repellat. Dolores nam corrupti esse atque numquam nulla. Provident voluptatibus et aspernatur veniam totam cumque.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('4', '44', '2004-06-09 00:00:00', 'Expedita laborum nam voluptas officiis maiores. Enim blanditiis illo tempore. Velit aut officiis beatae sed voluptas aut. Quas unde ipsum aspernatur ut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('5', '41', '2004-11-26 00:00:00', 'Dolores numquam et cum non tenetur. Et quas suscipit voluptatem quos. At sapiente porro repudiandae reiciendis. Asperiores deleniti voluptate non quam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('6', '19', '2008-08-09 00:00:00', 'Culpa qui rem in officiis officiis. Neque ipsam ullam dolore delectus. Ea deserunt perferendis incidunt tempore sed quos.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('7', '29', '1984-01-12 00:00:00', 'Debitis quis placeat ut sit placeat unde. Et voluptatem omnis quia eaque sunt impedit. Suscipit eius enim ut recusandae incidunt itaque.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('8', '4', '1982-01-13 00:00:00', 'Et et iusto et ullam. Dolores nesciunt magni inventore. Accusantium et delectus magnam voluptatum incidunt.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('9', '2', '2004-05-22 00:00:00', 'Quis et voluptatibus consectetur officiis eos et. Et nam aliquid sed ut voluptatem dolor. Sit eos consequatur quis optio animi sed.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('10', '29', '2000-06-30 00:00:00', 'Modi non sed culpa. Repellendus nostrum quibusdam voluptatibus asperiores molestiae repudiandae vitae. Sed animi quo et.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('11', '26', '1990-07-28 00:00:00', 'Veritatis sit quidem impedit sit aut maiores. Similique et libero incidunt consectetur. Voluptas architecto eum odit quia nihil magnam odio.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('12', '38', '1979-02-20 00:00:00', 'Itaque quia molestiae eligendi et qui aut. Impedit nam qui iusto reiciendis qui itaque. Dolorem non et dolore omnis voluptatem omnis. Ut cum labore iste.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('13', '20', '1991-06-24 00:00:00', 'Est ipsa asperiores et voluptatem. Quia qui quam nisi iure voluptas. Amet aut autem est sit culpa laudantium et modi. Incidunt est est qui dolores expedita.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('14', '26', '1994-05-25 00:00:00', 'Ullam qui error eos. Cumque sed unde sit accusamus. Rerum sequi aut debitis repudiandae aut. Consequatur illum ratione facere.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('15', '6', '1998-03-16 00:00:00', 'Rerum voluptatem nemo in quisquam dolorem corrupti perspiciatis. Numquam quod fugiat incidunt illo voluptatem in quo aut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('16', '31', '2012-04-13 00:00:00', 'Eum asperiores asperiores non in. Nobis accusamus distinctio est nesciunt. Sit aut in in dolorem.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('17', '8', '1994-08-13 00:00:00', 'Quia libero facilis occaecati nulla. Praesentium id accusantium ut excepturi sunt eum. Maiores non eum a maiores aliquam nemo qui.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('18', '22', '1987-01-18 00:00:00', 'Voluptas distinctio labore mollitia et. Assumenda est sed accusamus. Alias velit quia rem quo. Quas veritatis magnam nisi tempore rerum et ipsam magnam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('19', '50', '1989-01-10 00:00:00', 'Rem autem saepe ut debitis eos ipsa neque. Vel praesentium dolore repellat error. Nemo consectetur eaque in eos eum explicabo ut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('20', '34', '2000-06-18 00:00:00', 'Neque iure in iure est. Reprehenderit voluptate sit dolor blanditiis enim tenetur voluptatum. Optio dolorem quia cupiditate consequatur.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('21', '20', '2013-07-13 00:00:00', 'Labore molestiae itaque beatae quia. Est quia velit accusantium asperiores perspiciatis qui omnis illo. Consequatur vitae culpa aut labore impedit sed.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('22', '29', '2001-07-08 00:00:00', 'Consectetur provident atque tempore dolor occaecati velit. Tempore consequuntur dolorum aut fuga. Id voluptatibus consequatur officia et esse tempora nihil eos. Odio enim consequatur laborum.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('23', '17', '1987-02-20 00:00:00', 'Labore quaerat et rerum est molestias rerum perferendis. Blanditiis cum dolor porro earum sed et totam. Est nemo laboriosam quos sint sint doloribus quasi magnam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('24', '11', '1994-02-08 00:00:00', 'Quia exercitationem suscipit molestiae. Excepturi vel nihil alias maiores rerum quaerat soluta incidunt. Culpa adipisci et in dolor tempora sint. In aut exercitationem sit natus.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('25', '34', '1981-12-17 00:00:00', 'Minima ut earum et. Qui repellendus occaecati facilis fugiat cupiditate consectetur sed. Voluptas et qui quis provident facilis repudiandae necessitatibus. Illo quis ducimus necessitatibus.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('26', '15', '1992-12-09 00:00:00', 'Voluptatum et ut sed quisquam. Doloribus recusandae et ut est.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('27', '47', '1994-05-18 00:00:00', 'Nam voluptatem tempore vel labore maxime eos. Necessitatibus qui tenetur voluptatem sapiente quo in nihil. Nostrum exercitationem perferendis vel ex libero voluptatibus ad nemo.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('28', '8', '1987-03-03 00:00:00', 'Suscipit omnis ad incidunt ut quia. Ipsa pariatur commodi deserunt. Dignissimos ipsa architecto aut. Qui exercitationem sint et voluptates aut facilis eum.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('29', '5', '2013-07-08 00:00:00', 'Nihil minus aut in cupiditate quae vero. Beatae ut assumenda voluptatibus sapiente eaque repudiandae. Est voluptate eos aliquid aut quam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('30', '43', '1973-07-22 00:00:00', 'Unde pariatur occaecati non voluptatem autem sed a laboriosam. Voluptatem accusamus deserunt voluptatum illo eos nulla. Libero at minima aliquid vel sint magnam quam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('31', '31', '2007-03-25 00:00:00', 'Consequatur quaerat molestiae eum ab cumque cumque nulla. Consequatur velit voluptatem harum ut est. Excepturi laborum deserunt aut et.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('32', '7', '2003-09-07 00:00:00', 'Aperiam iusto sit maxime quo. Eos voluptatibus incidunt quia error. Cumque voluptas consequatur est ut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('33', '21', '2014-07-06 00:00:00', 'Expedita dolorem esse voluptas nam consequatur at provident. Dolorem voluptatem quos voluptas quod blanditiis illo aut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('34', '8', '2010-07-01 00:00:00', 'Quia fuga necessitatibus possimus id corporis id. Repellendus velit sit dolores quibusdam sed nam voluptatem voluptas. Ad odio dolores sed.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('35', '50', '2007-02-24 00:00:00', 'Adipisci ipsa facere animi. Omnis in accusamus est porro.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('36', '44', '1973-06-28 00:00:00', 'Inventore dolor dolorem qui qui. Ipsa sed repellendus soluta. Quaerat sit eveniet quae recusandae explicabo corporis ratione.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('37', '22', '2006-09-04 00:00:00', 'Blanditiis ut voluptatum repellendus numquam quod voluptatem. Sit voluptatem cum nam qui perspiciatis ut. Qui consequuntur voluptas ab et aspernatur aut non. Debitis dolorem quia est ut et voluptas.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('38', '21', '1981-04-28 00:00:00', 'Autem vel ipsa dolorem quos consequatur fugiat. Qui ea et est similique. Accusantium ab omnis nihil voluptas voluptatibus. Ipsum rerum placeat consequuntur dolore.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('39', '27', '1977-10-19 00:00:00', 'Laborum ut velit qui dignissimos consectetur. Dolore nihil ullam tempore iure. Vel dolorem quis dolores maxime.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('40', '16', '2000-08-17 00:00:00', 'Adipisci consequatur temporibus consequatur sunt ratione eos. Qui dicta quibusdam vel eligendi cum qui aut. Aut ut rem ea pariatur eveniet est perspiciatis.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('41', '37', '1980-04-27 00:00:00', 'Qui molestias enim nesciunt minus. Error est et dolorem nesciunt velit alias. Doloremque qui quae possimus eum perspiciatis nulla. Reprehenderit voluptas est sit.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('42', '36', '1996-03-07 00:00:00', 'Veritatis dolor molestias qui ipsam distinctio quam debitis. Vitae vel eveniet autem qui dolor quae id. Natus suscipit enim tempore eos et sit. Similique eum deleniti architecto non enim est non.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('43', '27', '2004-10-09 00:00:00', 'Quis et occaecati iure corrupti corporis. Nulla odio qui error dolorum nihil suscipit tenetur. Est repellendus quia id sapiente cumque.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('44', '13', '1988-05-13 00:00:00', 'Molestias doloribus ut recusandae mollitia et ut perferendis. Est impedit laboriosam ut neque reiciendis amet repudiandae id. Aliquam sed et vero quia quos.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('45', '2', '1992-06-05 00:00:00', 'Et veniam odit voluptas suscipit. Quo delectus autem atque accusantium molestiae voluptas debitis.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('46', '27', '2002-10-11 00:00:00', 'Quibusdam qui minima molestias sint voluptatum ab. Ipsum in et unde et. Sit porro nesciunt sint sit ea rerum earum.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('47', '26', '1985-02-19 00:00:00', 'A dolor repudiandae et sint ipsam deleniti neque. Accusantium aspernatur magnam sunt tempore. Possimus omnis est omnis consectetur amet nemo.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('48', '37', '1996-08-24 00:00:00', 'Corporis quo maiores qui non. Voluptatem recusandae deleniti odit voluptatem nisi molestiae. Quae voluptatem quisquam quis iure occaecati. Omnis eos animi quia deserunt repellat delectus ab ex.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('49', '9', '1990-01-22 00:00:00', 'Ut dolorem voluptatem debitis ad. Voluptas incidunt id aut similique consequatur nihil culpa. Nulla vitae unde aut qui.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('50', '1', '1987-06-06 00:00:00', 'Expedita laudantium dicta molestiae ullam quae aut. Eaque omnis et tempore nisi eos. Repellendus ratione doloremque quia. Iste sunt aut corporis sequi qui.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('51', '39', '1998-05-29 00:00:00', 'Id porro soluta repudiandae rem error. Deleniti in qui quod quam. Impedit voluptas quam quia. Provident ut facere dolores laborum in aperiam voluptatibus.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('52', '8', '2006-03-25 00:00:00', 'Dolor itaque dolorum ratione fuga. Qui omnis voluptatibus temporibus. Consequatur aut saepe et aut accusamus.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('53', '13', '2002-11-19 00:00:00', 'Dolore et sed dicta dolorem. Ullam sequi optio in et aut temporibus aut. Eum dolor aliquid id voluptatem in asperiores voluptatem.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('54', '1', '1979-09-03 00:00:00', 'Voluptatem doloremque quo ad inventore. Aliquid inventore molestiae nulla eveniet id. Quidem possimus porro occaecati rerum et non. Maxime assumenda voluptatem consequuntur quisquam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('55', '38', '2015-07-28 00:00:00', 'Blanditiis quaerat sunt maxime quas dolorum enim sunt. Ducimus vel excepturi officiis voluptates voluptatem. Officiis minus nihil eos numquam nulla at non.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('56', '22', '2007-02-26 00:00:00', 'Architecto consequatur est facilis ratione numquam velit. Modi excepturi accusamus autem eius quae. Sed voluptatem et dolorum. Nihil atque voluptatem eos.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('57', '3', '1998-09-13 00:00:00', 'Non molestias vitae neque facere officiis exercitationem. Corporis et officia tenetur quia non. Quo qui facere aspernatur cumque nulla. In optio ad doloribus ut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('58', '11', '1986-01-21 00:00:00', 'Quia necessitatibus mollitia doloribus nobis. Quia et blanditiis quidem. Hic est non et maxime.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('59', '7', '1998-01-21 00:00:00', 'Est in vel voluptas alias rerum et ab. Id dolorem hic eos dolor.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('60', '2', '2013-03-07 00:00:00', 'Neque reiciendis quaerat voluptas nostrum. Nostrum harum quaerat et itaque. Quis velit ad vero in ea dolor.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('61', '4', '2003-07-27 00:00:00', 'Doloremque et cum magni et eligendi sunt. Non et facere est adipisci explicabo est deleniti. Quae ullam velit dolore dolorem dolores molestiae.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('62', '8', '1977-08-30 00:00:00', 'Eum sint non perspiciatis quis. Occaecati omnis voluptas debitis saepe. Est ut dolorem non ut voluptatem modi.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('63', '36', '2015-01-31 00:00:00', 'Et sit consequatur quisquam magni. Et quam dolores voluptatem est nisi non eligendi. Amet repellat ut assumenda quia ut et.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('64', '20', '1982-08-17 00:00:00', 'Voluptas eius sit provident aperiam facilis. Ab sit quos reiciendis inventore sunt quia eum reprehenderit. Quia quia culpa exercitationem ut. Veniam tempora sapiente tenetur quas iusto voluptas.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('65', '14', '1990-06-28 00:00:00', 'Ipsa suscipit harum voluptatibus. Incidunt explicabo eos iste maiores natus. Sint esse aut itaque in libero sunt aut optio. Rerum aliquid quam culpa.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('66', '13', '1976-08-01 00:00:00', 'A voluptatem vel est maiores. Ipsum rerum modi omnis id nisi voluptatem porro. Rerum ut ut incidunt est sed itaque sit.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('67', '30', '2006-06-05 00:00:00', 'Reiciendis ea explicabo veniam natus. Minima aut ut ut ipsum velit aliquam. Ex distinctio in qui maiores.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('68', '45', '1981-09-27 00:00:00', 'Dolorum molestiae nisi sit quaerat at. Pariatur temporibus et eius dolores atque ut. Ut corrupti eligendi unde unde possimus iusto saepe.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('69', '30', '1989-11-27 00:00:00', 'Et soluta eum praesentium et aut vel. Molestiae assumenda architecto minima quis exercitationem quis. Nihil praesentium facere nostrum eius consectetur magni vel sequi. Ab aut blanditiis quo qui.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('70', '49', '2011-09-10 00:00:00', 'Nemo amet repellendus accusamus recusandae omnis temporibus omnis. Quaerat minima maiores suscipit. Non sequi quia unde quam blanditiis.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('71', '15', '2000-02-17 00:00:00', 'Vero officia tenetur sunt odio aperiam quibusdam. Consectetur aspernatur vitae pariatur magni voluptas cupiditate est. Architecto est laboriosam molestias possimus natus repellat aspernatur.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('72', '29', '2014-01-24 00:00:00', 'Quia et perferendis est beatae error. Excepturi sed ut sint delectus vel aperiam ut. Eaque ut voluptas non. Omnis quidem vero architecto voluptatem quo nisi voluptatibus et.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('73', '11', '2005-06-26 00:00:00', 'Ex qui et id soluta sed ipsam. Iure maiores occaecati alias quia delectus et qui animi. Placeat quo est eius repellat maxime explicabo.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('74', '46', '2001-07-02 00:00:00', 'Laudantium corrupti rerum iste in. Doloribus ducimus quisquam sit impedit quod aperiam est. At illo consequatur cum. Amet odio officiis aut possimus.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('75', '34', '1983-12-15 00:00:00', 'Dolore modi ipsum sunt corporis. Accusantium sed dolor sint repudiandae. Et iure ullam aspernatur itaque. Aut labore earum exercitationem fugiat aut.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('76', '13', '2003-03-10 00:00:00', 'Odit at id ut doloremque cupiditate magnam ab. Eaque alias ut amet nobis ut dolores distinctio praesentium. Magni ut veniam vel sit.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('77', '44', '2001-04-29 00:00:00', 'Omnis pariatur iusto sed ut beatae nobis. Voluptatem maiores fuga et in nihil. Natus molestiae molestiae et aliquid iure perspiciatis voluptatem et.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('78', '3', '2005-12-14 00:00:00', 'Sapiente omnis dolores mollitia nesciunt nulla ut optio. Commodi sunt et laudantium optio sit. Id asperiores est omnis debitis.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('79', '5', '1977-02-16 00:00:00', 'Provident ducimus hic reiciendis iure quod. Dolore cum unde non. Cupiditate voluptatibus et recusandae in tenetur et. Laboriosam provident debitis in commodi modi minima.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('80', '32', '1973-01-23 00:00:00', 'Laborum odit et est velit harum. Nobis repellat doloremque aliquam et qui error. Veritatis architecto ut laudantium sunt placeat maxime ipsum blanditiis. Neque cumque atque fuga sit sed qui nam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('81', '44', '2016-11-15 00:00:00', 'Quae voluptatibus ipsam aut. Deleniti quidem harum ut aut architecto ullam. Harum vel quia error ipsum. Architecto voluptatem magni voluptas quibusdam voluptatum saepe.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('82', '32', '1996-07-02 00:00:00', 'Facere saepe esse quia voluptatum est. Iste vel enim quia maxime. Atque dolore quibusdam est.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('83', '28', '1974-04-23 00:00:00', 'Illum amet totam ea est et. Saepe debitis libero aliquid dolor autem qui. Reiciendis voluptatibus illo quas iusto.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('84', '23', '2003-07-21 00:00:00', 'Cupiditate voluptas fuga vitae qui est quia nostrum. Et culpa sint nisi enim eligendi suscipit ut nisi. Odio aperiam fuga aliquid quia. Error facere iusto dolore nihil nemo.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('85', '24', '2007-03-11 00:00:00', 'At nostrum illum accusamus nemo placeat vitae. Iure nulla optio qui dicta recusandae vel quo. Est voluptatem excepturi error aut. Quia aliquam aut molestias laborum reiciendis magnam.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('86', '46', '2008-10-17 00:00:00', 'Voluptatum sit quia assumenda facere. Minima repellat vel pariatur iusto. Quisquam consequuntur ipsa consequatur molestiae nobis sint. Fugiat et expedita quia.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('87', '14', '2014-04-02 00:00:00', 'Est rem tempore totam esse voluptate. Rem nostrum vitae aut et illo. Incidunt et natus dolorum aliquam possimus et. Ut ex ullam et voluptas optio occaecati voluptatem.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('88', '19', '1987-03-25 00:00:00', 'Deleniti aut consequatur et incidunt possimus molestiae doloribus eos. Adipisci rerum voluptatum est. Sunt animi quo et eum voluptates.', '2017-07-22 12:31:22', '2017-07-22 12:31:22');
INSERT INTO `user_transmission_history` VALUES ('89', '28', '1984-03-01 00:00:00', 'Quia voluptas accusamus accusamus omnis facere aliquid ipsa. Repellendus qui rerum officia. Quisquam eos magni nisi temporibus. Iusto accusantium unde necessitatibus enim.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('90', '31', '1986-03-14 00:00:00', 'Ea exercitationem voluptatum et sint. Rerum sint necessitatibus adipisci debitis fugiat at. Natus nobis consequatur iste. Est qui unde officiis nihil voluptates consequatur.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('91', '7', '1994-03-02 00:00:00', 'Voluptatem mollitia et aliquid sed quidem sit et. Et dolore beatae magni asperiores. In molestiae magnam debitis quis. Voluptates eveniet nulla nesciunt minima molestiae molestias.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('92', '3', '1978-11-07 00:00:00', 'Expedita laudantium et officia. Dolor numquam rem ut et minima nulla aut fugit. Qui soluta cupiditate similique exercitationem iure. Iusto harum exercitationem culpa aperiam ut.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('93', '28', '2014-08-15 00:00:00', 'Et necessitatibus dolorem iste eos magnam rerum ipsa. Quo est at eveniet minus id est. Est aut est repellat rem sit omnis.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('94', '42', '1990-11-24 00:00:00', 'Optio at sint ut rerum perferendis praesentium veniam. Sunt debitis veniam sit similique laborum eaque perferendis. Debitis saepe dolores error qui est et non.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('95', '43', '1981-07-07 00:00:00', 'Sunt consequatur dolor sed ducimus reiciendis officia. Architecto veritatis eos dolor dolorem iusto. Aut quia aut doloremque error ipsam dolores dolor dolores. At animi unde hic aut nihil.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('96', '10', '2004-07-07 00:00:00', 'Veritatis vitae quod placeat rerum. Exercitationem aut consequuntur cum facilis ea a. Dolor labore explicabo veniam ex. Maiores eos voluptas placeat iste error eius.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('97', '4', '1978-05-30 00:00:00', 'Esse quia voluptatum sit voluptatibus iusto nobis tempora. Quidem laboriosam quidem eos. Dolor ipsam nemo omnis eius et. Ipsa cupiditate ea exercitationem temporibus iusto ut.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('98', '46', '1976-07-18 00:00:00', 'Pariatur perferendis ea aut ut consequuntur. Aut ut a tempora qui et vel. Quia est sed quae nihil facere ipsum. Suscipit et harum voluptates vero qui quae soluta.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('99', '25', '2000-08-28 00:00:00', 'Molestiae sunt consectetur voluptatem id debitis. Inventore non quasi recusandae voluptas libero unde sed. Optio dolor nisi exercitationem voluptas dolor. Non quia id harum ullam non quo.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');
INSERT INTO `user_transmission_history` VALUES ('100', '34', '1990-11-07 00:00:00', 'Et consequatur consequatur vero at architecto voluptatum. Vel nobis id id cum soluta numquam cumque. Aut officiis architecto dolores delectus eligendi soluta.', '2017-07-22 12:31:23', '2017-07-22 12:31:23');

-- ----------------------------
-- Table structure for versions
-- ----------------------------
DROP TABLE IF EXISTS `versions`;
CREATE TABLE `versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) unsigned NOT NULL,
  `tips_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `release_date_chapter` datetime NOT NULL,
  `release_date_small_test` datetime NOT NULL,
  `chapter_collection_id` int(10) unsigned NOT NULL,
  `small_test_id` int(10) unsigned NOT NULL,
  `file_id_version` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id_version` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_id_release` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of versions
-- ----------------------------
INSERT INTO `versions` VALUES ('1', '4', '16', 'Version 1', '2008-10-14 00:00:00', '1992-03-11 00:00:00', '7', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('2', '15', '11', 'Version 2', '1971-09-28 00:00:00', '1975-04-14 00:00:00', '9', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('3', '17', '11', 'Version 3', '1970-09-23 00:00:00', '1984-05-13 00:00:00', '6', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('4', '5', '34', 'Version 4', '2002-01-12 00:00:00', '2014-03-12 00:00:00', '3', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('5', '7', '6', 'Version 5', '2010-09-07 00:00:00', '1975-03-19 00:00:00', '5', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('6', '15', '26', 'Version 6', '1975-03-04 00:00:00', '1972-08-04 00:00:00', '8', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('7', '5', '24', 'Version 7', '1977-03-02 00:00:00', '1980-02-10 00:00:00', '6', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('8', '19', '39', 'Version 8', '1995-03-14 00:00:00', '2017-06-23 00:00:00', '8', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('9', '18', '35', 'Version 9', '1986-05-10 00:00:00', '2009-06-09 00:00:00', '1', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('10', '14', '19', 'Version 10', '1983-04-21 00:00:00', '1999-03-01 00:00:00', '9', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('11', '17', '25', 'Version 11', '1974-03-24 00:00:00', '1988-01-29 00:00:00', '8', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('12', '4', '19', 'Version 12', '2012-09-01 00:00:00', '1989-03-11 00:00:00', '1', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('13', '9', '34', 'Version 13', '1998-09-18 00:00:00', '2000-10-30 00:00:00', '3', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('14', '9', '36', 'Version 14', '2010-04-06 00:00:00', '1981-03-05 00:00:00', '6', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('15', '12', '11', 'Version 15', '1977-09-28 00:00:00', '1978-06-09 00:00:00', '1', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('16', '13', '14', 'Version 16', '2008-08-18 00:00:00', '2011-01-24 00:00:00', '0', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('17', '19', '35', 'Version 17', '1987-03-03 00:00:00', '1977-11-28 00:00:00', '7', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('18', '9', '19', 'Version 18', '1990-04-13 00:00:00', '1982-07-08 00:00:00', '0', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('19', '13', '39', 'Version 19', '1999-09-19 00:00:00', '1991-02-05 00:00:00', '5', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('20', '9', '45', 'Version 20', '1976-07-26 00:00:00', '1987-12-18 00:00:00', '7', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('21', '11', '50', 'Version 21', '1986-02-27 00:00:00', '1978-03-17 00:00:00', '8', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('22', '4', '33', 'Version 22', '2003-06-28 00:00:00', '2012-09-29 00:00:00', '9', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('23', '2', '39', 'Version 23', '1978-01-06 00:00:00', '2013-10-13 00:00:00', '4', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('24', '12', '32', 'Version 24', '2005-07-09 00:00:00', '1977-08-10 00:00:00', '9', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('25', '3', '26', 'Version 25', '1978-09-08 00:00:00', '1979-04-09 00:00:00', '3', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('26', '6', '38', 'Version 26', '2017-03-26 00:00:00', '1993-05-08 00:00:00', '7', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('27', '18', '39', 'Version 27', '1977-07-19 00:00:00', '1994-01-29 00:00:00', '7', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('28', '7', '35', 'Version 28', '1990-02-14 00:00:00', '1973-11-06 00:00:00', '6', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('29', '1', '6', 'Version 29', '1996-02-23 00:00:00', '2006-08-25 00:00:00', '2', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('30', '20', '26', 'Version 30', '1984-05-18 00:00:00', '2003-06-07 00:00:00', '7', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('31', '7', '25', 'Version 31', '1985-05-28 00:00:00', '2007-10-08 00:00:00', '6', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('32', '3', '9', 'Version 32', '2010-03-27 00:00:00', '1999-08-11 00:00:00', '9', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('33', '2', '41', 'Version 33', '1986-02-16 00:00:00', '2002-11-20 00:00:00', '8', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('34', '17', '33', 'Version 34', '1975-08-24 00:00:00', '1976-02-05 00:00:00', '3', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('35', '15', '34', 'Version 35', '1992-08-23 00:00:00', '2011-12-03 00:00:00', '6', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('36', '13', '24', 'Version 36', '2009-09-27 00:00:00', '1991-05-24 00:00:00', '2', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('37', '19', '32', 'Version 37', '1993-07-28 00:00:00', '2009-09-27 00:00:00', '8', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('38', '19', '28', 'Version 38', '2014-10-08 00:00:00', '1979-10-21 00:00:00', '4', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('39', '10', '6', 'Version 39', '1996-04-12 00:00:00', '1988-08-04 00:00:00', '8', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('40', '13', '35', 'Version 40', '1973-06-13 00:00:00', '1985-09-05 00:00:00', '4', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('41', '13', '34', 'Version 41', '1999-09-11 00:00:00', '1979-06-02 00:00:00', '6', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('42', '10', '32', 'Version 42', '1984-03-15 00:00:00', '2016-07-21 00:00:00', '6', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('43', '19', '22', 'Version 43', '1983-05-26 00:00:00', '2016-11-10 00:00:00', '4', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('44', '6', '48', 'Version 44', '1996-02-04 00:00:00', '1999-02-21 00:00:00', '4', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('45', '18', '12', 'Version 45', '1995-09-01 00:00:00', '1987-12-22 00:00:00', '3', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('46', '20', '33', 'Version 46', '1990-10-03 00:00:00', '1975-06-16 00:00:00', '8', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('47', '13', '40', 'Version 47', '1981-07-04 00:00:00', '2001-03-15 00:00:00', '9', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('48', '16', '48', 'Version 48', '1996-09-11 00:00:00', '1980-01-27 00:00:00', '9', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('49', '4', '34', 'Version 49', '2004-12-26 00:00:00', '1986-07-02 00:00:00', '8', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('50', '17', '9', 'Version 50', '1986-04-15 00:00:00', '1982-09-02 00:00:00', '6', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('51', '11', '40', 'Version 51', '1995-09-19 00:00:00', '1982-12-12 00:00:00', '5', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('52', '17', '42', 'Version 52', '1992-02-14 00:00:00', '2011-08-17 00:00:00', '5', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('53', '2', '6', 'Version 53', '1978-04-28 00:00:00', '1977-06-04 00:00:00', '6', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('54', '2', '44', 'Version 54', '1981-12-05 00:00:00', '2009-01-12 00:00:00', '2', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('55', '16', '10', 'Version 55', '2007-07-04 00:00:00', '1990-07-14 00:00:00', '6', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('56', '9', '5', 'Version 56', '2014-01-10 00:00:00', '1979-02-22 00:00:00', '7', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('57', '7', '28', 'Version 57', '2012-03-14 00:00:00', '2004-02-14 00:00:00', '0', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('58', '12', '31', 'Version 58', '2000-03-23 00:00:00', '1977-06-13 00:00:00', '2', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('59', '13', '50', 'Version 59', '1978-04-25 00:00:00', '1972-10-13 00:00:00', '0', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('60', '6', '13', 'Version 60', '2009-05-22 00:00:00', '2011-07-15 00:00:00', '0', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('61', '1', '3', 'Version 61', '1997-11-01 00:00:00', '1978-09-10 00:00:00', '5', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('62', '2', '30', 'Version 62', '1977-04-12 00:00:00', '1999-07-02 00:00:00', '5', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('63', '11', '28', 'Version 63', '2015-08-24 00:00:00', '1979-07-03 00:00:00', '8', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('64', '18', '9', 'Version 64', '2010-12-03 00:00:00', '2016-08-25 00:00:00', '4', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('65', '18', '17', 'Version 65', '2011-10-06 00:00:00', '1978-09-11 00:00:00', '8', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('66', '19', '37', 'Version 66', '1994-02-24 00:00:00', '2001-11-13 00:00:00', '6', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('67', '10', '6', 'Version 67', '2006-01-10 00:00:00', '1981-06-28 00:00:00', '7', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('68', '5', '25', 'Version 68', '1995-12-16 00:00:00', '1980-12-02 00:00:00', '5', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('69', '17', '37', 'Version 69', '2000-12-16 00:00:00', '1994-10-24 00:00:00', '7', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('70', '18', '37', 'Version 70', '1979-10-31 00:00:00', '2000-07-17 00:00:00', '3', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('71', '6', '9', 'Version 71', '2007-07-13 00:00:00', '1990-06-11 00:00:00', '0', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:28', '2017-07-22 12:31:28');
INSERT INTO `versions` VALUES ('72', '1', '48', 'Version 72', '1987-06-02 00:00:00', '1989-03-15 00:00:00', '2', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('73', '5', '30', 'Version 73', '1980-04-13 00:00:00', '1988-05-27 00:00:00', '8', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('74', '7', '22', 'Version 74', '1977-06-15 00:00:00', '2004-12-05 00:00:00', '1', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('75', '9', '13', 'Version 75', '1997-02-08 00:00:00', '2012-05-22 00:00:00', '3', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('76', '8', '35', 'Version 76', '2004-12-22 00:00:00', '2008-02-14 00:00:00', '8', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('77', '13', '32', 'Version 77', '1980-03-11 00:00:00', '1981-04-15 00:00:00', '3', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('78', '16', '2', 'Version 78', '2002-12-21 00:00:00', '2003-10-20 00:00:00', '4', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('79', '2', '28', 'Version 79', '1974-12-30 00:00:00', '1975-11-28 00:00:00', '2', '2', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('80', '16', '25', 'Version 80', '1986-10-23 00:00:00', '2003-04-09 00:00:00', '4', '0', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('81', '3', '40', 'Version 81', '1987-03-19 00:00:00', '1995-07-11 00:00:00', '2', '3', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('82', '11', '40', 'Version 82', '1996-11-13 00:00:00', '2003-08-29 00:00:00', '0', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('83', '11', '22', 'Version 83', '1991-11-19 00:00:00', '1988-03-31 00:00:00', '4', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('84', '10', '34', 'Version 84', '2011-12-07 00:00:00', '2011-07-09 00:00:00', '7', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('85', '12', '7', 'Version 85', '1997-01-22 00:00:00', '1987-10-17 00:00:00', '9', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('86', '10', '17', 'Version 86', '1996-06-27 00:00:00', '1999-04-08 00:00:00', '1', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('87', '3', '20', 'Version 87', '1982-01-06 00:00:00', '1974-02-21 00:00:00', '4', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('88', '17', '31', 'Version 88', '1983-08-08 00:00:00', '1975-05-13 00:00:00', '5', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('89', '10', '45', 'Version 89', '2006-09-14 00:00:00', '1971-09-26 00:00:00', '3', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('90', '2', '31', 'Version 90', '1978-10-25 00:00:00', '1977-12-23 00:00:00', '4', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('91', '15', '48', 'Version 91', '1989-04-14 00:00:00', '1976-04-07 00:00:00', '6', '7', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('92', '16', '21', 'Version 92', '1988-05-15 00:00:00', '1988-06-29 00:00:00', '6', '5', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('93', '11', '40', 'Version 93', '1984-05-07 00:00:00', '1987-11-03 00:00:00', '0', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('94', '4', '7', 'Version 94', '1992-11-01 00:00:00', '1996-11-22 00:00:00', '9', '8', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('95', '4', '5', 'Version 95', '1982-03-21 00:00:00', '2015-06-20 00:00:00', '6', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('96', '3', '45', 'Version 96', '1978-06-15 00:00:00', '1970-07-28 00:00:00', '8', '9', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('97', '9', '1', 'Version 97', '1989-02-17 00:00:00', '1972-10-09 00:00:00', '2', '6', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('98', '16', '29', 'Version 98', '1989-08-11 00:00:00', '1995-01-07 00:00:00', '3', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('99', '11', '20', 'Version 99', '1975-04-21 00:00:00', '1975-04-13 00:00:00', '7', '1', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
INSERT INTO `versions` VALUES ('100', '15', '35', 'Version 100', '1982-07-12 00:00:00', '1999-09-30 00:00:00', '5', '4', 'Temp(file_id verions)', 'Temp(folder_id version)', 'Temp(file_id release)', '2017-07-22 12:31:29', '2017-07-22 12:31:29');
