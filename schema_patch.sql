USE `smmpanel`;

-- Admin Constants
CREATE TABLE IF NOT EXISTS `admin_constants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paidRent` int(11) NOT NULL DEFAULT 1,
  `brand_logo` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin_constants` (`id`, `paidRent`, `brand_logo`) VALUES (1, 1, '""')
ON DUPLICATE KEY UPDATE `paidRent` = 1;

-- Panel Master
CREATE TABLE IF NOT EXISTS `panel_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_domain` varchar(255) DEFAULT '',
  `razorpay_payment_amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `panel_master` (`id`, `panel_domain`, `razorpay_payment_amount`) VALUES (1, '127.0.0.1', 0.00)
ON DUPLICATE KEY UPDATE `panel_domain` = '127.0.0.1';
INSERT INTO `panel_master` (`id`, `panel_domain`, `razorpay_payment_amount`) VALUES (2, 'localhost', 0.00)
ON DUPLICATE KEY UPDATE `panel_domain` = 'localhost';

-- Blacklisted IPs
CREATE TABLE IF NOT EXISTS `blacklisted_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Allowed Admin IPs
CREATE TABLE IF NOT EXISTS `allowed_admin_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `allowed_admin_ip` (`ip_address`) VALUES ('*'), ('127.0.0.1'), ('::1')
ON DUPLICATE KEY UPDATE `ip_address`=VALUES(`ip_address`);

-- Currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(50) NOT NULL DEFAULT 'US Dollar',
  `currency_code` varchar(10) NOT NULL DEFAULT 'USD',
  `currency_symbol` varchar(10) DEFAULT '$',
  `symbol_position` varchar(10) DEFAULT 'left',
  `currency_rate` double NOT NULL DEFAULT 1,
  `currency_inverse_rate` double NOT NULL DEFAULT 1,
  `is_enable` tinyint(1) NOT NULL DEFAULT 1,
  `currency_hash` varchar(100) NOT NULL DEFAULT '1234567890abcdef',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `currencies` (`id`, `currency_name`, `currency_code`, `currency_symbol`, `symbol_position`, `currency_rate`, `currency_inverse_rate`, `is_enable`, `currency_hash`) VALUES
(1, 'US Dollar', 'USD', '$', 'left', 1, 1, 1, '1234567890abcdef')
ON DUPLICATE KEY UPDATE `is_enable` = 1;

-- Admins Table
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) DEFAULT 'Super Admin',
  `username` varchar(255) NOT NULL DEFAULT 'admin',
  `admin_email` varchar(255) NOT NULL DEFAULT 'admin@admin.com',
  `telephone` varchar(50) DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT 'admin',
  `access` text DEFAULT NULL,
  `client_type` int(11) DEFAULT 2,
  `admin_type` int(11) DEFAULT 1,
  `two_factor` tinyint(1) DEFAULT 0,
  `two_factor_secret_key` varchar(255) DEFAULT NULL,
  `email_2fa` tinyint(1) DEFAULT 0,
  `secure_token` varchar(255) DEFAULT NULL,
  `chat_id` varchar(255) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `login_ip` varchar(100) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `mode` varchar(50) DEFAULT 'day',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admins` (`admin_id`, `admin_name`, `username`, `admin_email`, `telephone`, `password`, `access`, `client_type`, `admin_type`, `two_factor`, `email_2fa`, `register_date`, `mode`) VALUES
(1, 'Super Admin', 'admin', 'admin@admin.com', '', 'admin', '{"admin_access":"1","users":"1","orders":"1","subscriptions":"1","dripfeed":"1","tasks":"1","services":"1","payments":"1","tickets":"1","reports":"1","general_settings":"1","pages":"1","blog":"1","seo":"1","menu":"1","subject":"1","child_panels":"1","payments_settings":"1","bank_accounts":"1","payments_bonus":"1","alert_settings":"1","providers":"1","modules":"1","themes":"1","language":"1","logs":"1","update-prices":"1","crons":"1","provider_logs":"1","guard_logs":"1","admins":"1","kuponlar":"1","currency_settings":"1"}', 2, 1, 0, 0, NOW(), 'day')
ON DUPLICATE KEY UPDATE `password` = 'admin';

-- Panel Info
CREATE TABLE IF NOT EXISTS `panel_info` (
  `panel_id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_type` varchar(50) DEFAULT 'single',
  PRIMARY KEY (`panel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `panel_info` (`panel_id`, `panel_type`) VALUES (1, 'single')
ON DUPLICATE KEY UPDATE `panel_type`='single';

-- Refill Status
CREATE TABLE IF NOT EXISTS `refill_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `refill_status` varchar(50) DEFAULT 'Pending',
  `creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Referral Payouts
CREATE TABLE IF NOT EXISTS `referral_payouts` (
  `r_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_p_code` varchar(50) DEFAULT '',
  `r_p_amount` decimal(10,2) DEFAULT '0.00',
  `r_p_status` varchar(50) DEFAULT 'Pending',
  `r_p_requested` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`r_p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ranks
CREATE TABLE IF NOT EXISTS `ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(100) NOT NULL,
  `min_spent` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ranks` (`id`, `rank_name`, `min_spent`) VALUES
(1, 'Newbie', 0.00),
(2, 'Junior', 50.00),
(3, 'Regular', 200.00),
(4, 'Expert', 500.00),
(5, 'VIP', 1000.00)
ON DUPLICATE KEY UPDATE `rank_name`=VALUES(`rank_name`);

-- Broadcasts
CREATE TABLE IF NOT EXISTS `broadcasts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `content` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Broadcast Notifications
CREATE TABLE IF NOT EXISTS `broadcast_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `broadcast_id` int(11) DEFAULT 0,
  `client_id` int(11) DEFAULT 0,
  `is_read` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Notifications Popup
CREATE TABLE IF NOT EXISTS `notifications_popup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `message` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Favorite Services
CREATE TABLE IF NOT EXISTS `favorite_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sync Logs
CREATE TABLE IF NOT EXISTS `sync_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Earn
CREATE TABLE IF NOT EXISTS `earn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT '0.00',
  `status` varchar(50) DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Updates
CREATE TABLE IF NOT EXISTS `updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Units per page
CREATE TABLE IF NOT EXISTS `units_per_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL DEFAULT 25,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_unique` (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `units_per_page` (`page`, `unit`) VALUES
('clients', 25),
('orders', 25),
('payments', 25),
('services', 25)
ON DUPLICATE KEY UPDATE `unit` = VALUES(`unit`);

-- Childpanels
CREATE TABLE IF NOT EXISTS `childpanels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `panel_domain` text DEFAULT NULL,
  `panel_currency` text DEFAULT NULL,
  `panel_status` varchar(225) NOT NULL DEFAULT 'pending',
  `child_panel_status` varchar(225) NOT NULL DEFAULT 'pending',
  `panel_price` text DEFAULT NULL,
  `panel_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- General Options
CREATE TABLE IF NOT EXISTS `General_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_format` varchar(50) DEFAULT '1',
  `massorder` int(11) DEFAULT 1,
  `updates_show` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `General_options` (`id`, `currency_format`, `massorder`, `updates_show`) VALUES (1, '1', 1, 1)
ON DUPLICATE KEY UPDATE `currency_format` = '1';

-- Decoration
CREATE TABLE IF NOT EXISTS `decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fire_works` varchar(50) DEFAULT 'false',
  `snowflakes` int(11) DEFAULT 50,
  `garlands` varchar(50) DEFAULT 'false',
  `toys` varchar(50) DEFAULT 'false',
  `toy_a` varchar(50) DEFAULT 'false',
  `toy_b` varchar(50) DEFAULT 'false',
  `toy_c` varchar(50) DEFAULT 'false',
  `toy_d` varchar(50) DEFAULT 'false',
  `toy_e` varchar(50) DEFAULT 'false',
  `toy_f` varchar(50) DEFAULT 'false',
  `toy_g` varchar(50) DEFAULT 'false',
  `toy_h` varchar(50) DEFAULT 'false',
  `toy_i` varchar(50) DEFAULT 'false',
  `toy_j` varchar(50) DEFAULT 'false',
  `toy_k` varchar(50) DEFAULT 'false',
  `toy_l` varchar(50) DEFAULT 'false',
  `toy_size` int(11) DEFAULT 50,
  `toy_quantity` int(11) DEFAULT 10,
  `toy_speed` int(11) DEFAULT 5,
  `toy_launch` varchar(50) DEFAULT 'false',
  `fire_speed` int(11) DEFAULT 5,
  `fire_size` int(11) DEFAULT 50,
  `gar_style` varchar(50) DEFAULT '1',
  `gar_shape` varchar(50) DEFAULT 'apple',
  `snow_speed` int(11) DEFAULT 5,
  `snow_fall` varchar(50) DEFAULT 'false',
  `snow_colour` varchar(50) DEFAULT '#ffffff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `decoration` (`id`, `snow_fall`, `garlands`, `fire_works`, `snow_colour`) VALUES (1, 'false', 'false', 'false', '#ffffff')
ON DUPLICATE KEY UPDATE `snow_fall` = 'false';

-- Payment Methods Table
CREATE TABLE IF NOT EXISTS `paymentmethods` (
  `methodId` int(11) NOT NULL AUTO_INCREMENT,
  `methodName` varchar(255) DEFAULT '',
  `methodVisibleName` varchar(255) DEFAULT '',
  `methodLogo` varchar(255) DEFAULT '',
  `methodMin` double DEFAULT 1,
  `methodMax` double DEFAULT 1000,
  `methodFee` double DEFAULT 0,
  `methodBonusPercentage` double DEFAULT 0,
  `methodBonusStartAmount` double DEFAULT 0,
  `methodStatus` tinyint(1) DEFAULT 1,
  `methodPosition` int(11) DEFAULT 1,
  `methodInstructions` text DEFAULT NULL,
  `methodExtras` text DEFAULT NULL,
  `methodCallback` varchar(255) DEFAULT '',
  PRIMARY KEY (`methodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `paymentmethods` (`methodId`, `methodName`, `methodVisibleName`, `methodLogo`, `methodMin`, `methodMax`, `methodFee`, `methodStatus`, `methodPosition`, `methodInstructions`, `methodExtras`, `methodCallback`) VALUES
(1, 'PayPal', 'PayPal', '', 5, 500, 0, 1, 1, 'Pay securely with PayPal', '{"clientId":"","clientSecret":""}', 'paypal'),
(2, 'Stripe', 'Credit / Debit Card', '', 5, 500, 0, 1, 2, 'Pay securely with Credit / Debit Card', '{"publishableKey":"","secretKey":""}', 'stripe'),
(3, 'Cryptocurrency', 'Crypto (Bitcoin, USDT)', '', 10, 1000, 0, 1, 3, 'Pay with Crypto', '{"apiKey":""}', 'crypto')
ON DUPLICATE KEY UPDATE `methodVisibleName` = VALUES(`methodVisibleName`);

-- Themes
DELETE FROM `themes`;
INSERT INTO `themes` (`id`, `theme_name`, `theme_dirname`, `theme_extras`) VALUES
(1, 'Eternity', 'Eternity', '{"stylesheets":["public/Eternity/bootstrap.css","public/Eternity/pink.css"],"scripts":["public/Eternity/js/bundle.js","public/Eternity/js/main.js"]}'),
(2, 'Simplify', 'Simplify', '{"stylesheets":["public/Simplify/bootstrap.css","public/Simplify/Grapes.css"],"scripts":["public/Simplify/js/ajax.js"]}');

-- Alter Clients table
ALTER TABLE `clients`
  ADD COLUMN IF NOT EXISTS `name` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `ref_code` varchar(50) DEFAULT 'd22b8',
  ADD COLUMN IF NOT EXISTS `ref_by` varchar(50) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `email_type` int(11) DEFAULT 2,
  ADD COLUMN IF NOT EXISTS `currency_type` varchar(10) DEFAULT 'USD',
  ADD COLUMN IF NOT EXISTS `broadcast_id` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `chat_id` varchar(255) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `two_factor` tinyint(1) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `two_factor_code` varchar(50) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `passwordreset_token` varchar(255) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `rank` varchar(50) DEFAULT 'Newbie',
  ADD COLUMN IF NOT EXISTS `mode` varchar(50) DEFAULT 'day';

UPDATE `clients` SET `password` = '21232f297a57a5a743894a0e4a801fc3', `name` = 'Admin', `balance` = 1000.00 WHERE `username` = 'admin';

-- Alter Categories
ALTER TABLE `categories`
  ADD COLUMN IF NOT EXISTS `category_deleted` tinyint(1) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `category_icon` text DEFAULT NULL;

-- Alter Services
ALTER TABLE `services`
  ADD COLUMN IF NOT EXISTS `service_deleted` tinyint(1) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `price_profit` double DEFAULT 0;

-- Alter Orders
ALTER TABLE `orders`
  ADD COLUMN IF NOT EXISTS `order_increase` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `last_check` varchar(50) DEFAULT NULL;

-- Alter Blogs
ALTER TABLE `blogs`
  ADD COLUMN IF NOT EXISTS `blog_get` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `title` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `content` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `image_file` varchar(255) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `status` tinyint(1) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `published_at` datetime DEFAULT CURRENT_TIMESTAMP,
  ADD COLUMN IF NOT EXISTS `updated_at` datetime DEFAULT CURRENT_TIMESTAMP;

-- Alter Pages
ALTER TABLE `pages`
  ADD COLUMN IF NOT EXISTS `page_status` tinyint(1) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `seo_title` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `seo_keywords` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `seo_description` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `page_content2` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `last_modified` datetime DEFAULT CURRENT_TIMESTAMP;

-- Alter Referral
ALTER TABLE `referral`
  ADD COLUMN IF NOT EXISTS `referral_code` varchar(50) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `r_p_code` varchar(50) DEFAULT NULL;

-- Alter Settings table
ALTER TABLE `settings`
  ADD COLUMN IF NOT EXISTS `oldadminname` varchar(255) DEFAULT 'admin',
  ADD COLUMN IF NOT EXISTS `site_theme_alt` varchar(50) DEFAULT 'pink',
  ADD COLUMN IF NOT EXISTS `pc_1` varchar(50) DEFAULT '#5b53ff',
  ADD COLUMN IF NOT EXISTS `pc_2` varchar(50) DEFAULT '#443df6',
  ADD COLUMN IF NOT EXISTS `ph` varchar(50) DEFAULT '#ffffff',
  ADD COLUMN IF NOT EXISTS `pd` varchar(50) DEFAULT '#f5f5f5',
  ADD COLUMN IF NOT EXISTS `sc_1` varchar(50) DEFAULT '#2b2b2b',
  ADD COLUMN IF NOT EXISTS `sc_2` varchar(50) DEFAULT '#1e1e1e',
  ADD COLUMN IF NOT EXISTS `sh` varchar(50) DEFAULT '#ffffff',
  ADD COLUMN IF NOT EXISTS `sd` varchar(50) DEFAULT '#333333',
  ADD COLUMN IF NOT EXISTS `admin_font` varchar(100) DEFAULT 'Inter',
  ADD COLUMN IF NOT EXISTS `admin_font_type` varchar(100) DEFAULT 'sans-serif',
  ADD COLUMN IF NOT EXISTS `admin_font_import` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `user_font` varchar(100) DEFAULT 'Nunito',
  ADD COLUMN IF NOT EXISTS `user_font_type` varchar(100) DEFAULT 'sans-serif',
  ADD COLUMN IF NOT EXISTS `user_font_import` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `adminbottoken` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `adminbotusername` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `telegramusertoken` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `userbotusername` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `chat_id` varchar(255) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `snow_colour` varchar(50) DEFAULT '#ffffff',
  ADD COLUMN IF NOT EXISTS `snow_effect` tinyint(1) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `popup` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `site_base_currency` varchar(10) DEFAULT 'USD',
  ADD COLUMN IF NOT EXISTS `site_currency_converter` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `site_update_rates_automatically` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `last_updated_currency_rates` varchar(50) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `inr_symbol` varchar(10) DEFAULT '₹',
  ADD COLUMN IF NOT EXISTS `inr_value` double DEFAULT 80,
  ADD COLUMN IF NOT EXISTS `childpanel_selling` int(11) DEFAULT 2,
  ADD COLUMN IF NOT EXISTS `childpanel_price` double DEFAULT 10,
  ADD COLUMN IF NOT EXISTS `ns1` varchar(255) DEFAULT 'ns1.example.com',
  ADD COLUMN IF NOT EXISTS `ns2` varchar(255) DEFAULT 'ns2.example.com',
  ADD COLUMN IF NOT EXISTS `neworder_type` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `googleclientid` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `googleclientsecret` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `google_login` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `fake_order_service_enabled` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `fake_order_min` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `fake_order_max` int(11) DEFAULT 100,
  ADD COLUMN IF NOT EXISTS `panel_orders_pattern` text DEFAULT '{"panel_orders_prefix":"","panel_orders_suffix":""}',
  ADD COLUMN IF NOT EXISTS `panel_orders` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `referral_status` int(11) DEFAULT 2,
  ADD COLUMN IF NOT EXISTS `promotion` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `freebalance` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `freeamount` double DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `referral_commision` double DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `referral_payout` double DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `fav_services` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `services_average_time` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `admin_ip_protect` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `rank_display` int(11) DEFAULT 1,
  ADD COLUMN IF NOT EXISTS `homepage` varchar(50) DEFAULT 'default',
  ADD COLUMN IF NOT EXISTS `site_seo` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `site_favicon` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `whatsapp_status` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `whatsapp_number` varchar(50) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `whatsapp_position` varchar(50) DEFAULT 'right',
  ADD COLUMN IF NOT EXISTS `whatsapp_welcome` text DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `telegram_status` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `telegram_username` varchar(100) DEFAULT '',
  ADD COLUMN IF NOT EXISTS `telegram_position` varchar(50) DEFAULT 'left',
  ADD COLUMN IF NOT EXISTS `auto_avg_time` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `auto_order_resend` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `resend_max` int(11) DEFAULT 3,
  ADD COLUMN IF NOT EXISTS `email_confirmation` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `tickets_per_user` int(11) DEFAULT 5,
  ADD COLUMN IF NOT EXISTS `order_completion_time` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `order_completion_visibility` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `otp_login` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `loss_protection` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `name_fields` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `skype_fields` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `alert_apimail` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `alert_newmessage` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `alert_orderfail` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `alert_welcomemail` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `auto_fail_to_cancel_delay_minutes` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `auto_fail_to_cancel_enabled` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `auto_fail_to_inprogress_delay_minutes` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `auto_fail_to_inprogress_enabled` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `permissions` text DEFAULT NULL;

UPDATE `settings` SET
  `oldadminname` = 'admin',
  `site_theme` = 'Eternity',
  `site_theme_alt` = 'pink',
  `site_base_currency` = 'USD',
  `site_currency_converter` = 1,
  `site_maintenance` = '2',
  `site_frozen` = 2,
  `admin_ip_protect` = 1,
  `recaptcha` = '1',
  `childpanel_selling` = 2,
  `referral_status` = 2
WHERE `id` = 1;

-- Additional client & referral columns
ALTER TABLE `clients`
  ADD COLUMN IF NOT EXISTS `secure_token` varchar(255) DEFAULT NULL,
  ADD COLUMN IF NOT EXISTS `rank_name` varchar(100) DEFAULT 'Newbie',
  ADD COLUMN IF NOT EXISTS `discount_percentage` double DEFAULT 0;

ALTER TABLE `referral`
  ADD COLUMN IF NOT EXISTS `referral_sign_up` int(11) DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `referral_client_id` int(11) DEFAULT 0;

-- Relax non-null columns without defaults for compatibility
ALTER TABLE `clients`
  MODIFY `login_ip` varchar(225) DEFAULT '',
  MODIFY `register_ip` varchar(225) DEFAULT '',
  MODIFY `referral_code` varchar(225) DEFAULT '',
  MODIFY `debit_limit` varchar(225) DEFAULT '0',
  MODIFY `refchar` varchar(225) DEFAULT '0',
  MODIFY `reforder` varchar(225) DEFAULT '0',
  MODIFY `total_click` varchar(225) DEFAULT '0';

ALTER TABLE `payments`
  MODIFY `payment_bank` int(11) DEFAULT 0,
  MODIFY `payment_extra` text DEFAULT NULL;

ALTER TABLE `referral`
  MODIFY `client_id` int(11) DEFAULT 0,
  MODIFY `refferal` int(11) DEFAULT 0,
  MODIFY `action` text DEFAULT NULL,
  MODIFY `register_date` varchar(225) DEFAULT '';
