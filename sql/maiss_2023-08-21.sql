# ************************************************************
# Sequel Ace SQL dump
# バージョン 20050
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# ホスト: localhost (MySQL 8.0.32)
# データベース: maiss
# 生成時間: 2023-08-21 08:35:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ boards
# ------------------------------------------------------------

CREATE TABLE `boards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '組',
  `start_date` date NOT NULL COMMENT '開始日',
  `end_date` date NOT NULL COMMENT '終了日',
  `user_id` bigint unsigned DEFAULT NULL COMMENT 'ユーザーID・投稿者ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `boards_user_id_foreign` (`user_id`),
  CONSTRAINT `boards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# テーブルのダンプ enquete_answers
# ------------------------------------------------------------

CREATE TABLE `enquete_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL COMMENT 'ユーザーID',
  `enquete_id` bigint unsigned NOT NULL COMMENT '質問ID',
  `enquete_item_id` bigint unsigned NOT NULL COMMENT '回答ID',
  `comment` text COLLATE utf8mb4_unicode_ci COMMENT 'コメント・意見',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enquete_answers_user_id_foreign` (`user_id`),
  KEY `enquete_answers_enquete_id_foreign` (`enquete_id`),
  KEY `enquete_answers_enquete_item_id_foreign` (`enquete_item_id`),
  CONSTRAINT `enquete_answers_enquete_id_foreign` FOREIGN KEY (`enquete_id`) REFERENCES `enquetes` (`id`),
  CONSTRAINT `enquete_answers_enquete_item_id_foreign` FOREIGN KEY (`enquete_item_id`) REFERENCES `enquete_items` (`id`),
  CONSTRAINT `enquete_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ enquete_items
# ------------------------------------------------------------

CREATE TABLE `enquete_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `enquete_id` bigint unsigned NOT NULL COMMENT '質問ID',
  `option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '選択肢',
  `total` int NOT NULL DEFAULT '0' COMMENT '累計',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enquete_items_enquete_id_foreign` (`enquete_id`),
  CONSTRAINT `enquete_items_enquete_id_foreign` FOREIGN KEY (`enquete_id`) REFERENCES `enquetes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ enquetes
# ------------------------------------------------------------

CREATE TABLE `enquetes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'タイトル',
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '詳細',
  `start_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'アンケート開始日時',
  `expired_at` datetime NOT NULL COMMENT '有効期限',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ failed_jobs
# ------------------------------------------------------------

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ general_meetings
# ------------------------------------------------------------

CREATE TABLE `general_meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `open_date` datetime DEFAULT NULL COMMENT '開催日時',
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '総会名称',
  `place` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '開催場所',
  `meeting_filename` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '総会資料ファイル名',
  `minutes_filename` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '議事録ファイル名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# テーブルのダンプ migrations
# ------------------------------------------------------------

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ notifications
# ------------------------------------------------------------

CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL COMMENT 'ユーザーID・投稿者ID',
  `is_parmanent` tinyint NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# テーブルのダンプ password_reset_tokens
# ------------------------------------------------------------

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ personal_access_tokens
# ------------------------------------------------------------

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ rules
# ------------------------------------------------------------

CREATE TABLE `rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '規約の種類',
  `chapter` int DEFAULT NULL,
  `chapter_str` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `section` int DEFAULT NULL,
  `section_str` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paragraph` int DEFAULT NULL,
  `paragraph_text` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# テーブルのダンプ schedules
# ------------------------------------------------------------

CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `enquete_id` bigint unsigned NOT NULL DEFAULT '1' COMMENT 'アンケートID',
  `notification_id` bigint unsigned NOT NULL DEFAULT '1' COMMENT 'お知らせID',
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'イベント名',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'リンク先URL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_notification_id_foreign` (`notification_id`),
  KEY `schedules_enquete_id_foreign` (`enquete_id`),
  CONSTRAINT `schedules_enquete_id_foreign` FOREIGN KEY (`enquete_id`) REFERENCES `enquetes` (`id`),
  CONSTRAINT `schedules_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# テーブルのダンプ users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` tinyint NOT NULL DEFAULT '1' COMMENT '役割・権限',
  `room` int NOT NULL COMMENT '部屋番号',
  `family_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `given_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_account_unique` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
