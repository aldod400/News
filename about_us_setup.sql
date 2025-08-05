-- Run this SQL to create the About Us tables

-- Create about_us table
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create editorial_board table
CREATE TABLE IF NOT EXISTS `editorial_board` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `position` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`position`)),
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create offices table
CREATE TABLE IF NOT EXISTS `offices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`address`)),
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO `about_us` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{"en":"<p>Welcome to our news organization. We are dedicated to providing accurate, timely, and comprehensive news coverage to our readers. Our mission is to inform, educate, and empower our community through quality journalism.</p><p>Founded with the vision of creating a trusted source of information, we strive to maintain the highest standards of journalistic integrity. Our team of experienced reporters and editors work tirelessly to bring you the most important stories from around the world.</p>","ar":"<p>مرحباً بكم في مؤسستنا الإخبارية. نحن ملتزمون بتقديم تغطية إخبارية دقيقة وشاملة وفي الوقت المناسب لقرائنا. مهمتنا هي إعلام وتثقيف وتمكين مجتمعنا من خلال الصحافة عالية الجودة.</p><p>تأسست برؤية إنشاء مصدر موثوق للمعلومات، ونسعى للحفاظ على أعلى معايير النزاهة الصحفية. يعمل فريقنا من المراسلين والمحررين ذوي الخبرة بلا كلل لتقديم أهم القصص من حول العالم.</p>"}', NOW(), NOW());

INSERT INTO `editorial_board` (`name`, `position`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
('{"en":"Ahmed Hassan","ar":"أحمد حسن"}', '{"en":"Editor-in-Chief","ar":"رئيس التحرير"}', 1, 1, NOW(), NOW()),
('{"en":"Sarah Johnson","ar":"سارة جونسون"}', '{"en":"Deputy Editor","ar":"نائب رئيس التحرير"}', 2, 1, NOW(), NOW()),
('{"en":"Mohamed Ali","ar":"محمد علي"}', '{"en":"News Director","ar":"مدير الأخبار"}', 3, 1, NOW(), NOW());

INSERT INTO `offices` (`name`, `address`, `phone`, `email`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
('{"en":"Main Office - Cairo","ar":"المكتب الرئيسي - القاهرة"}', '{"en":"Downtown Cairo, Egypt","ar":"وسط البلد، القاهرة، مصر"}', '+20 2 1234 5678', 'cairo@newssite.com', 1, 1, NOW(), NOW()),
('{"en":"Alexandria Branch","ar":"فرع الإسكندرية"}', '{"en":"Alexandria, Egypt","ar":"الإسكندرية، مصر"}', '+20 3 1234 5678', 'alexandria@newssite.com', 2, 1, NOW(), NOW());
