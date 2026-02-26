-- Blitz Casino Database Schema
-- Run this to set up the database: mysql -u blitz_user -p blitz_casino < database_schema.sql

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Settings Table - Site configuration
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT 'Blitz Casino',
  `description` text,
  `meta_tags` text,
  `theme` tinyint(1) DEFAULT 0,
  `crash_status` int(11) DEFAULT 0,
  `crash_boom` decimal(10,2) DEFAULT 0.00,
  `x30_status` int(11) DEFAULT 0,
  `x100_status` int(11) DEFAULT 0,
  `min_bet` decimal(10,2) DEFAULT 1.00,
  `max_bet` decimal(10,2) DEFAULT 10000.00,
  `min_dep` decimal(10,2) DEFAULT 100.00,
  `min_withdraw` decimal(10,2) DEFAULT 500.00,
  `ref_percent` decimal(5,2) DEFAULT 5.00,
  `jackpot_percent` decimal(5,2) DEFAULT 1.00,
  `deposit_bonus` decimal(5,2) DEFAULT 0.00,
  `vk_group` varchar(255) DEFAULT '',
  `tg_channel` varchar(255) DEFAULT '',
  `support_link` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default settings
INSERT INTO `settings` (`id`, `name`, `description`) VALUES 
(1, 'Blitz Casino', 'Welcome to Blitz Casino - Provably Fair Gaming with Chainlink VRF');

-- --------------------------------------------------------
-- Users Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'https://api.dicebear.com/7.x/avataaars/svg?seed=default',
  `balance` decimal(20,2) DEFAULT 0.00,
  `demo_balance` decimal(20,2) DEFAULT 10000.00,
  `type_balance` tinyint(1) DEFAULT 0 COMMENT '0=real, 1=demo',
  `total_deposit` decimal(20,2) DEFAULT 0.00,
  `total_withdraw` decimal(20,2) DEFAULT 0.00,
  `total_bet` decimal(20,2) DEFAULT 0.00,
  `total_win` decimal(20,2) DEFAULT 0.00,
  `ref_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ref_balance` decimal(20,2) DEFAULT 0.00,
  `vk_id` varchar(255) DEFAULT NULL,
  `tg_id` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `yandex_id` varchar(255) DEFAULT NULL,
  `promo_used` text,
  `ban` tinyint(1) DEFAULT 0,
  `admin` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Crash Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `crash` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `auto` decimal(10,2) DEFAULT 0.00 COMMENT 'Auto cashout multiplier',
  `result` decimal(10,2) DEFAULT 0.00 COMMENT 'Cashout multiplier',
  `win` decimal(20,2) DEFAULT 0.00,
  `game_hash` varchar(255) DEFAULT NULL,
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `crash_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Wheel (X30/X100) Games Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheels` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('x30','x100') NOT NULL DEFAULT 'x30',
  `bet` decimal(20,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `wheels_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Wheel History Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheel_history` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `coff` varchar(50) DEFAULT NULL,
  `random` varchar(255) DEFAULT NULL,
  `signature` text,
  `vrf_proof` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Wheel Anti (X100) Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheel_antis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `bet` decimal(20,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- X100 Specific Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `x100s` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- X100 Anti (House Bets) Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `x100_antis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Dice Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `coins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `target` decimal(10,2) DEFAULT NULL COMMENT 'Target number/range',
  `direction` enum('over','under') DEFAULT 'over',
  `result` decimal(10,2) DEFAULT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `multiplier` decimal(10,4) DEFAULT 1.0000,
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `coins_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Mines Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `mines_games` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `mines_count` int(11) DEFAULT 5,
  `mines` text COMMENT 'JSON array of mine positions',
  `revealed` text COMMENT 'JSON array of revealed positions',
  `multiplier` decimal(10,4) DEFAULT 1.0000,
  `win` decimal(20,2) DEFAULT 0.00,
  `status` enum('active','won','lost') DEFAULT 'active',
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mines_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Keno Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `kenos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `selected` text COMMENT 'JSON array of selected numbers',
  `drawn` text COMMENT 'JSON array of drawn numbers',
  `hits` int(11) DEFAULT 0,
  `multiplier` decimal(10,4) DEFAULT 1.0000,
  `win` decimal(20,2) DEFAULT 0.00,
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kenos_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Keno History Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `keno_histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `round_id` varchar(255) DEFAULT NULL,
  `numbers` text COMMENT 'JSON array of drawn numbers',
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Jackpot Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jackpots` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `round_id` int(11) DEFAULT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Jackpot History Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jackpot_histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `round_id` int(11) DEFAULT NULL,
  `winner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_pot` decimal(20,2) DEFAULT 0.00,
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Boom City Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `boom_cities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `selected` varchar(50) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Payments Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `status` enum('pending','completed','failed','cancelled') DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Withdrawals Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `withdraws_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Promo Codes Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `promos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `amount` decimal(20,2) DEFAULT 0.00,
  `type` enum('balance','bonus_percent') DEFAULT 'balance',
  `max_uses` int(11) DEFAULT 1,
  `uses` int(11) DEFAULT 0,
  `min_deposit` decimal(20,2) DEFAULT 0.00,
  `expires_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promos_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Active Promos (User-Promo relationship)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `active_promos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Deposit Promos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dep_promos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `bonus_percent` decimal(5,2) DEFAULT 0.00,
  `wager` decimal(5,2) DEFAULT 1.00,
  `max_uses` int(11) DEFAULT 1,
  `uses` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Messages / Chat Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `type` enum('user','system','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Support Tickets Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` enum('open','pending','closed') DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Ticket Messages Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Games / Slots Table (External games catalog)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `games` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `show` tinyint(1) DEFAULT 1,
  `is_live` tinyint(1) DEFAULT 0,
  `priority` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Slots Game History
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `slots` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `bet` decimal(20,2) NOT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tourniers (Tournaments) Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tourniers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prize_pool` decimal(20,2) DEFAULT 0.00,
  `min_bet` decimal(20,2) DEFAULT 1.00,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `status` enum('upcoming','active','ended') DEFAULT 'upcoming',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tournament Leaderboard Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournier_tables` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tournier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_bet` decimal(20,2) DEFAULT 0.00,
  `total_win` decimal(20,2) DEFAULT 0.00,
  `points` decimal(20,2) DEFAULT 0.00,
  `rank` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Balance History Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `history_balances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT 0.00,
  `balance_before` decimal(20,2) DEFAULT 0.00,
  `balance_after` decimal(20,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Posts / News Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `image` varchar(500) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- System Deposits Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `system_deps` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- System Withdraws Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `system_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Random Keys Table (for provable fairness)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `random_keys` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_hash` varchar(255) NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `game_type` varchar(50) DEFAULT NULL,
  `game_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Result Random Table (VRF results storage)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `result_randoms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `game_type` varchar(50) NOT NULL,
  `game_round` varchar(255) DEFAULT NULL,
  `seed` varchar(255) NOT NULL,
  `signature` text NOT NULL,
  `raw_value` varchar(255) DEFAULT NULL,
  `mapped_value` decimal(20,6) DEFAULT NULL,
  `vrf_proof` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `result_randoms_game_type_index` (`game_type`),
  KEY `result_randoms_seed_index` (`seed`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Reposts Table (Social sharing rewards)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `reposts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `platform` varchar(50) NOT NULL,
  `reward_amount` decimal(20,2) DEFAULT 0.00,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- User Reposts Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `user_reposts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `repost_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Shoots Game Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `shoots` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bet` decimal(20,2) NOT NULL,
  `result` varchar(50) DEFAULT NULL,
  `win` decimal(20,2) DEFAULT 0.00,
  `vrf_seed` varchar(255) DEFAULT NULL,
  `vrf_signature` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Status Table (system status flags)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statuses_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Jobs Table (Laravel Queue)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Failed Jobs Table (Laravel Queue)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Authorization Tokens Table
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `authorizations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT 'session',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------
-- Create Admin User (password: admin123)
-- --------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `balance`, `demo_balance`, `admin`, `created_at`) VALUES
(1, 'Admin', 'admin', 'admin@blitz.casino', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 100000.00, 100000.00, 1, NOW());

-- --------------------------------------------------------
-- Sample Promo Codes
-- --------------------------------------------------------
INSERT INTO `promos` (`code`, `amount`, `type`, `max_uses`, `active`) VALUES
('BLITZ100', 100.00, 'balance', 100, 1),
('WELCOME50', 50.00, 'balance', 1000, 1);

COMMIT;
