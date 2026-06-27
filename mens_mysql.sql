-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: mens
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `mens`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mens` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `mens`;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_service_id_foreign` (`service_id`),
  CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carousel_images`
--

DROP TABLE IF EXISTS `carousel_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousel_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousel_images`
--

LOCK TABLES `carousel_images` WRITE;
/*!40000 ALTER TABLE `carousel_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `carousel_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faqs_service_id_foreign` (`service_id`),
  CONSTRAINT `faqs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,1,'Is men\'s health physiotherapy private?','Yes. Mayfair provides confidential consultation and treatment support in a respectful clinical environment.',0,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(2,1,'What problems can men\'s health physiotherapy help with?','It may help with pelvic pain, urinary leakage, post-prostate surgery recovery, pelvic floor dysfunction, and related discomfort.',1,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(3,1,'Do I need a doctor referral?','In many cases, you can book directly. If your condition needs medical referral, the team will guide you after assessment.',2,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(4,1,'How long does recovery take?','Recovery depends on the condition, severity, lifestyle, and consistency with treatment and exercises.',3,'active','2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `footer_settings`
--

DROP TABLE IF EXISTS `footer_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `footer_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `pinterest_url` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `footer_settings`
--

LOCK TABLES `footer_settings` WRITE;
/*!40000 ALTER TABLE `footer_settings` DISABLE KEYS */;
INSERT INTO `footer_settings` VALUES (1,NULL,'Your trusted partner in comprehensive healthcare. Discover quality health to meet your needs.','MCC Building, Level 02, Road 127, Gulshan Avenue, Dhaka 1212.','+8801986-660000','info@mayfair.com.bd','https://facebook.com','https://instagram.com','https://linkedin.com','https://pinterest.com','Copyright © 2026 Mayfair. All rights reserved. | Crafted with care by Sinodtech Ltd.','2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `footer_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_group` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'header','Home','/',0,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(2,'header','Services','/services',1,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(3,'header','Our Specialists','https://mayfair.com.bd/our-physiotherapy-specialists/',2,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(4,'header','About Us','https://mayfair.com.bd/about-us',3,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(5,'header','Contact','https://mayfair.com.bd/contact',4,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(6,'discover_us','Home','/',0,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(7,'discover_us','About Us','https://mayfair.com.bd/about-us',1,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(8,'discover_us','Blogs','https://mayfair.com.bd/blogs',2,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(9,'discover_us','Terms & Conditions','https://mayfair.com.bd/terms',3,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(10,'discover_us','Shop','https://mayfair.com.bd/shop',4,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(11,'discover_us','WishList','https://mayfair.com.bd/wishlist',5,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(12,'discover_us','Cart','https://mayfair.com.bd/cart',6,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(13,'useful_links','What we treat','https://mayfair.com.bd/what-we-treat',0,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(14,'useful_links','Our Doctors','https://mayfair.com.bd/our-physiotherapy-specialists/',1,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(15,'useful_links','All Services','/services',2,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(16,'useful_links','How we treat','https://mayfair.com.bd/how-we-treat',3,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(17,'useful_links','Contact','https://mayfair.com.bd/contact',4,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(18,'useful_links','Success Stories','https://mayfair.com.bd/success-stories',5,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(19,'useful_links','Frequently Asked Questions','https://mayfair.com.bd/faqs',6,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(20,'our_services','Physiotherapy','/services/physiotherapy',0,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(21,'our_services','Urological Conditions','/services/urological-conditions',1,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(22,'our_services','Shoulder Pain','/services/shoulder-pain',2,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(23,'our_services','Neck Pain','/services/neck-pain',3,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(24,'our_services','Men\'s Health','/services/mens-health-physiotherapy',4,'active','2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_06_09_000000_create_mens_health_tables',1),(6,'2026_06_09_095957_add_hero_image_and_smtp_settings_to_website_settings_table',1),(7,'2026_06_09_100856_create_carousel_images_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_bullets`
--

DROP TABLE IF EXISTS `service_bullets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_bullets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned NOT NULL,
  `section_type` varchar(255) NOT NULL,
  `bullet_text` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_bullets_service_id_foreign` (`service_id`),
  CONSTRAINT `service_bullets_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_bullets`
--

LOCK TABLES `service_bullets` WRITE;
/*!40000 ALTER TABLE `service_bullets` DISABLE KEYS */;
INSERT INTO `service_bullets` VALUES (1,1,'cause','Pelvic floor muscle weakness or tightness',0,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(2,1,'cause','Prostate-related inflammation or recovery needs',1,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(3,1,'cause','Long sitting, poor posture, or physical stress',2,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(4,1,'cause','Stress, anxiety, and nervous system sensitivity',3,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(5,1,'cause','Post-surgical changes after prostate or pelvic surgery',4,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(6,1,'cause','Chronic pain patterns around lower back, pelvis, or groin',5,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(7,1,'treatment','Private consultation and assessment',0,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(8,1,'treatment','Pelvic floor muscle training',1,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(9,1,'treatment','Pain relief and mobility exercises',2,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(10,1,'treatment','Posture and movement correction',3,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(11,1,'treatment','Post-surgery rehabilitation support',4,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(12,1,'treatment','Lifestyle and home exercise guidance',5,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(13,1,'treatment','Progress monitoring through follow-up sessions',6,'2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `service_bullets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_steps`
--

DROP TABLE IF EXISTS `service_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `step_number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_steps_service_id_foreign` (`service_id`),
  CONSTRAINT `service_steps_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_steps`
--

LOCK TABLES `service_steps` WRITE;
/*!40000 ALTER TABLE `service_steps` DISABLE KEYS */;
INSERT INTO `service_steps` VALUES (1,1,1,'Get Consultation','Share your symptoms privately and get expert support.',NULL,0,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(2,1,2,'Make Appointment','Choose your preferred time and book easily online.',NULL,1,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(3,1,3,'Select Doctor','Meet a specialist for a personalized treatment plan.',NULL,2,'active','2026-06-16 01:05:39','2026-06-16 01:05:39'),(4,1,4,'Start Treatment','Follow your plan and track your recovery progress.',NULL,3,'active','2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `service_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `main_description` text DEFAULT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_subtitle` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `cause_title` varchar(255) DEFAULT NULL,
  `cause_description` text DEFAULT NULL,
  `cause_image` varchar(255) DEFAULT NULL,
  `treatment_title` varchar(255) DEFAULT NULL,
  `treatment_description` text DEFAULT NULL,
  `treatment_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `show_in_sidebar` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Men\'s Health Physiotherapy','mens-health-physiotherapy','Confidential physiotherapy support for pelvic health, urinary control, sexual wellness, and post-surgical recovery.','Men\'s health physiotherapy focuses on pelvic floor function, urinary control, sexual wellness, chronic pelvic pain, and post-surgical recovery. At Mayfair Wellness Clinic, our approach is private, respectful, and evidence-informed, helping men improve comfort, confidence, and daily quality of life.','Men\'s Health','Confidential Care For Men\'s Wellness',NULL,NULL,'Why Does This Problem Happen?','Men\'s pelvic and urological symptoms can happen due to pelvic floor weakness, muscle tightness, prostate-related concerns, post-surgical changes, stress, posture problems, or long sitting habits. These issues are common, but many men delay treatment because of embarrassment or lack of awareness.',NULL,'How Mayfair Helps You Recover','Mayfair Wellness Clinic provides private assessment, guided pelvic floor rehabilitation, manual therapy, pain management, exercise planning, and lifestyle guidance. Each treatment plan is personalized based on the patient’s symptoms, comfort level, and recovery goal.',NULL,1,1,'active',14,'Men\'s Health Physiotherapy in Dhaka | Mayfair Wellness Clinic','Confidential men\'s health physiotherapy and urological condition support at Mayfair Wellness Clinic, Gulshan, Dhaka. Book your appointment today.','2026-06-16 01:05:39','2026-06-16 01:05:39'),(2,'Arthritis','arthritis','Expert management for Arthritis at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Arthritis.','Arthritis','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',0,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(3,'Back Pain and Sciatica','back-pain-and-sciatica','Expert management for Back Pain and Sciatica at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Back Pain and Sciatica.','Back Pain and Sciatica','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',1,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(4,'Elbow, Wrist and Hand Pain','elbow-wrist-and-hand-pain','Expert management for Elbow, Wrist and Hand Pain at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Elbow, Wrist and Hand Pain.','Elbow, Wrist and Hand Pain','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',2,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(5,'Foot and Ankle Pain','foot-and-ankle-pain','Expert management for Foot and Ankle Pain at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Foot and Ankle Pain.','Foot and Ankle Pain','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',3,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(6,'Hip and Knee Pain','hip-and-knee-pain','Expert management for Hip and Knee Pain at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Hip and Knee Pain.','Hip and Knee Pain','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',4,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(7,'Neck Pain Relief','neck-pain-relief','Expert management for Neck Pain Relief at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Neck Pain Relief.','Neck Pain Relief','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',5,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(8,'Neurological Disorders','neurological-disorders','Expert management for Neurological Disorders at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Neurological Disorders.','Neurological Disorders','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',6,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(9,'Physiotherapy','physiotherapy','Expert management for Physiotherapy at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Physiotherapy.','Physiotherapy','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',7,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(10,'Pre and Post Surgical Rehab','pre-and-post-surgical-rehab','Expert management for Pre and Post Surgical Rehab at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Pre and Post Surgical Rehab.','Pre and Post Surgical Rehab','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',8,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(11,'Regenerative Screening','regenerative-screening','Expert management for Regenerative Screening at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Regenerative Screening.','Regenerative Screening','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',9,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(12,'Shoulder Pain','shoulder-pain','Expert management for Shoulder Pain at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Shoulder Pain.','Shoulder Pain','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',10,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(13,'Sports Injuries','sports-injuries','Expert management for Sports Injuries at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Sports Injuries.','Sports Injuries','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',11,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(14,'Urological Conditions','urological-conditions','Expert management for Urological Conditions at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Urological Conditions.','Urological Conditions','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',12,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39'),(15,'Work Injuries','work-injuries','Expert management for Work Injuries at Mayfair Wellness Clinic.','At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with Work Injuries.','Work Injuries','Specialized Treatment Services',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'active',14,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mayfair Admin','admin@mayfair.com.bd','2026-06-16 01:05:39','$2y$10$XeGZv9AlWRsLt4ynFAqWdemSAUl98A5kfFYDhtP1HAdCbh43rLFPq','admin','active',NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL DEFAULT 'Mayfair Wellness Clinic',
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) NOT NULL DEFAULT '#006F5C',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#CC205C',
  `appointment_button_text` varchar(255) NOT NULL DEFAULT 'Appointment Now',
  `appointment_button_url` varchar(255) NOT NULL DEFAULT '#booking-form',
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `smtp_mail_to` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_encryption` varchar(255) DEFAULT NULL,
  `notification_emails` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_settings`
--

LOCK TABLES `website_settings` WRITE;
/*!40000 ALTER TABLE `website_settings` DISABLE KEYS */;
INSERT INTO `website_settings` VALUES (1,'Mayfair Wellness Clinic',NULL,NULL,NULL,'#006F5C','#CC205C','Appointment Now','#booking-form','+8801986660000','info@mayfair.com.bd',NULL,NULL,NULL,NULL,NULL,NULL,'2026-06-16 01:05:39','2026-06-16 01:05:39');
/*!40000 ALTER TABLE `website_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mens'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-16 17:32:06
