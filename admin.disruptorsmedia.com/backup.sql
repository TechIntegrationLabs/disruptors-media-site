-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: disruptorsmedia_db
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about_page`
--

DROP TABLE IF EXISTS `about_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `about_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `about_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `embed_code` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_page`
--

LOCK TABLES `about_page` WRITE;
/*!40000 ALTER TABLE `about_page` DISABLE KEYS */;
INSERT INTO `about_page` VALUES (24,'WE\'RE NOT JUST ANOTHER AGENCY.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(25,'WE\'RE ARCHITECTS OF DIGITAL LANDSCAPES.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(26,'TURNING CLICKS INTO CUSTOMERS.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(27,'A WEBSITE THAT ADAPTS TO EVERY VISITOR.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(28,'EMAIL CAMPAIGNS THAT FEEL LIKE PERSONAL LETTERS.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(29,'SOCIAL MEDIA PAGES RECEIVING MILLIONS OF ENGAGEMENT.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(30,'LAUNCHING BRANDS INTO THE DYNAMIC DIGITAL WORLD.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(31,'WHERE EVERY INTERACTION IS AN OPPORTUNITY.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(32,'IT\'S NOT JUST MARKETING.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL),(33,'IT\'S A NEW CHAPTER FOR YOUR BRAND.','2024-02-04 18:01:10','2024-02-04 18:01:10',NULL);
/*!40000 ALTER TABLE `about_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `about_page_embed_code`
--

DROP TABLE IF EXISTS `about_page_embed_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `about_page_embed_code` (
  `id` int NOT NULL AUTO_INCREMENT,
  `embed_code` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_page_embed_code`
--

LOCK TABLES `about_page_embed_code` WRITE;
/*!40000 ALTER TABLE `about_page_embed_code` DISABLE KEYS */;
INSERT INTO `about_page_embed_code` VALUES (1,'<iframe src=\"https://example.com\" width=\"600\" height=\"400\"></iframe>');
/*!40000 ALTER TABLE `about_page_embed_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','admin@admin.com',NULL,'(555)-555-5555','','$2y$10$XfKFwVpIVp94M0lRfUnH0OxLULjVUNZxGo0iM7MRXhxzS/d79bwuG','2024-01-10 19:38:19','2024-01-10 19:38:19'),(2,'kelvinjames','kelvinkelvinjames502@gmail.com',NULL,'','FNheFe4qK5dyoaJxBCeghOFjOG7Sv032Uuksb2A2p7Z8sdoJa1PTtHRT8fEG','$2y$10$0j46sdFdzn01Or2SUgF2JOLlJsAeKms9D7aRjfGcnxYEcJrgg0SOK',NULL,'2024-02-13 00:52:12'),(3,'moe','moe@disruptorsmedia.com',NULL,NULL,NULL,'$2a$04$Nrw826QTxlAsZid2/xvENedupIjElqJoNFToHlN78ClD4K9MtcCYi',NULL,NULL),(4,'Tyler','tyler@disruptorsmedia.com',NULL,NULL,NULL,'$2a$04$Nrw826QTxlAsZid2/xvENedupIjElqJoNFToHlN78ClD4K9MtcCYi',NULL,NULL),(5,'Josh','josh@disruptorsmedia.com',NULL,NULL,NULL,'$2a$04$Nrw826QTxlAsZid2/xvENedupIjElqJoNFToHlN78ClD4K9MtcCYi',NULL,NULL),(6,'Bailey','bailey@disruptorsmedia.com',NULL,NULL,NULL,'$2a$04$Nrw826QTxlAsZid2/xvENedupIjElqJoNFToHlN78ClD4K9MtcCYi',NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_page`
--

DROP TABLE IF EXISTS `contact_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `main_heading` varchar(300) NOT NULL,
  `text_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_page`
--

LOCK TABLES `contact_page` WRITE;
/*!40000 ALTER TABLE `contact_page` DISABLE KEYS */;
INSERT INTO `contact_page` VALUES (1,'LET’S WORK','<iframe src=\"https://zufh2dc8efb.typeform.com/to/XUfheBdy\"></iframe>','2024-01-31 15:53:05','2024-02-04 07:11:32');
/*!40000 ALTER TABLE `contact_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_category`
--

DROP TABLE IF EXISTS `faq_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_category`
--

LOCK TABLES `faq_category` WRITE;
/*!40000 ALTER TABLE `faq_category` DISABLE KEYS */;
INSERT INTO `faq_category` VALUES (1,'FAQ Page','2024-01-31 17:39:41','2024-01-31 17:39:41'),(2,'What we do section','2024-01-31 17:39:41','2024-01-31 17:39:41');
/*!40000 ALTER TABLE `faq_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `category_id` int NOT NULL,
  `question` varchar(300) NOT NULL,
  `answer` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,1,1,'WHAT SERVICES DOES YOUR AGENCY OFFER?','We specialize in a range of digital marketing services including social media management, content creation, SEO, PPC advertising, email and SMS marketing, data analytics, and podcast production.','2024-01-28 19:17:45','2024-02-09 06:27:57'),(2,2,1,'How do you tailor your strategy to each client?','Connect directly with your audience through social media, email, and podcasts, fostering ongoing conversations.','2024-01-28 19:18:45','2024-02-08 23:57:15'),(3,3,1,'WHAT MAKES YOUR AGENCY DIFFERENT FROM OTHERS?','Our holistic, 360-degree approach to marketing sets us apart. We not only create and execute strategies but also continuously analyze and optimize them for the best results. Our creative and innovative team always stays ahead of the curve.','2024-01-28 19:19:22','2024-01-28 19:19:22'),(4,4,1,'HOW DO YOU MEASURE THE SUCCESS OF YOUR CAMPAIGNS?','Success is measured through a combination of metrics tailored to each campaign\'s goals, including engagement rates, website traffic, conversion rates, and ROI. We provide regular reports and insights to keep you informed.','2024-01-28 19:19:52','2024-01-28 19:19:52'),(5,5,1,'CAN YOU HANDLE BOTH SMALL AND LARGE-SCALE PROJECTS?','Absolutely! We have experience and resources to manage projects of all sizes, ensuring each client receives personalized attention and expertise.','2024-01-28 19:20:14','2024-01-28 19:20:14'),(6,6,1,'WHAT IS YOUR PRICING STRUCTURE?','Our pricing is based on the scope of work and the specific services you require. We offer flexible packages and can provide a customized quote after understanding your needs.','2024-01-28 19:20:37','2024-01-28 19:20:37'),(7,7,1,'HOW LONG DOES IT TAKE TO SEE RESULTS?','The timeline for seeing results varies depending on the nature of the campaign. While some digital marketing efforts yield quick results, others, like SEO, may take longer. We set realistic expectations from the outset.','2024-01-28 19:21:08','2024-01-28 19:21:08'),(8,8,1,'HOW DO WE GET STARTED?','Getting started is easy! Just reach out to us through our contact form or give us a call, and we\'ll set up an initial consultation to discuss your needs and how we can help.\"','2024-01-28 19:21:30','2024-01-28 19:21:30'),(9,9,2,'DIGITAL MARKETING & PRESENCE','Elevate your digital prescence with our comprehensive management and targeted SEO strategies. We ensure your brand stands out, driving traffic and enhancing visability. <a href=\"https://disruptorsmedia.com/contact\">Contact us</a> to transform your digital identity.','2024-01-31 12:48:25','2024-03-06 23:09:24'),(10,10,2,'OPTIMIZATION & ANALYTICS','Refine your strategy with our AI-powered tools and data insights for peak performance. We turn data into actionable intelligence. <a href=\"https://disruptorsmedia.com/contact\">Contact us</a> to optimize your marketing efforts.','2024-01-31 12:51:15','2024-03-06 23:09:57'),(11,2,2,'WEB DEVELOPMENT & E-COMMERCE','Build a dynamic online presence with our web development and e-commerce solutions. Engage and convert your audience effectively. <a href=\"https://disruptorsmedia.com/contact\">Contact us</a> to elevate your digital journey.','2024-01-31 12:51:28','2024-03-06 23:10:08'),(12,1,2,'CREATIVE & STRATEGY','We craft personalized, AI-driven strategies that bridge the gap between your goals and tangible results. We also captivate audiences with compelling content and design, fueled by the power of AI-assisted creativity.','2024-01-31 12:51:48','2024-03-05 21:52:45');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_clients`
--

DROP TABLE IF EXISTS `featured_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `add_feature_clients` varchar(300) NOT NULL,
  `featured_link` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_clients`
--

LOCK TABLES `featured_clients` WRITE;
/*!40000 ALTER TABLE `featured_clients` DISABLE KEYS */;
INSERT INTO `featured_clients` VALUES (8,1,'featured_clients/Asset 5@2x.png','https://disruptorsmedia.com/work/bf4real-podcast','2024-02-03 14:28:12','2024-03-21 22:32:51'),(9,6,'featured_clients/Bruce-Leeroy--Logo.png','http://disruptorsmedia.com/work/bruce-leeroy','2024-02-03 14:39:48','2024-02-19 19:59:15'),(10,2,'featured_clients/e-district--logo.png','http://disruptorsmedia.com/work/e-district','2024-02-03 14:39:59','2024-02-19 19:58:59'),(11,3,'featured_clients/Master Lu\'s.png','https://disruptorsmedia.com/work/master-lus-health-center','2024-02-03 14:41:20','2024-05-24 17:24:30'),(14,4,'featured_clients/psyched-out--logo.png','http://disruptorsmedia.com/work/physched-out','2024-02-03 14:43:06','2024-02-19 19:59:41'),(15,5,'featured_clients/Community Cures.png','http://disruptorsmedia.com/work/community-curescast','2024-02-03 14:43:58','2024-03-21 22:34:46');
/*!40000 ALTER TABLE `featured_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `footer_settings`
--

DROP TABLE IF EXISTS `footer_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `footer_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `left_side_heading` varchar(255) NOT NULL,
  `left_side_address` varchar(255) NOT NULL,
  `right_side_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `footer_settings`
--

LOCK TABLES `footer_settings` WRITE;
/*!40000 ALTER TABLE `footer_settings` DISABLE KEYS */;
INSERT INTO `footer_settings` VALUES (1,'DISRUPTORS MEDIA INC.','650 N MAIN ST, NORTH SALT LAKE, UT 84054','<p>40.853400, -111.911790</p>\r\n<p>LOAD ADDRESS: 034526-01, ISCXX COMPRESSED</p>','2024-01-29 08:18:17','2024-01-29 12:28:27');
/*!40000 ALTER TABLE `footer_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frames_category`
--

DROP TABLE IF EXISTS `frames_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frames_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `frame_name` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frames_category`
--

LOCK TABLES `frames_category` WRITE;
/*!40000 ALTER TABLE `frames_category` DISABLE KEYS */;
INSERT INTO `frames_category` VALUES (1,'Our Process','2024-01-31 16:02:02','2024-01-31 16:02:02'),(2,'Who we do','2024-01-31 16:02:02','2024-01-31 16:02:02'),(3,'Who we do Bottom','2024-02-28 20:39:36','2024-02-28 20:39:36');
/*!40000 ALTER TABLE `frames_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `add_gallery_video` text,
  `gallery_link` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (31,15,'galleries/Gen-2 3253005707, image 135jpg, brush_V 21, brush_A 08.mp4','#','2024-04-01 20:07:53','2024-04-01 20:07:53'),(32,15,'galleries/Gen-2 2727797683, image 142jpg, brush_A 13.mp4','#','2024-04-01 20:08:13','2024-04-01 20:08:13'),(33,15,'galleries/Gen-2 3834837978, image 143jpg, brush_V 18, brush_A 07(1).mp4','#','2024-04-01 20:09:26','2024-04-01 20:09:26'),(34,15,'galleries/Gen-2 1037691818, image 107jpg, brush_A 02.mp4','#','2024-04-01 20:09:49','2024-04-01 20:09:49'),(35,15,'galleries/Gen-2 2553829429, image 141jpg, cam_YW 2, brush_A 06.mp4','#','2024-04-01 20:10:16','2024-04-01 20:10:16'),(36,15,'galleries/Gen-2 2606816455, image 136jpg, brush_H -22, brush_V 23, brush_P 17, brush_A 06(1).mp4','#','2024-04-01 20:10:49','2024-04-01 20:10:49'),(37,15,'galleries/652aa913-7d04-4704-bcde-47a07029cf75.mp4','#','2024-04-01 20:13:40','2024-04-01 20:13:40'),(38,15,'galleries/ff26b757-d157-4d97-94a9-a144bf0fdde6.mp4','#','2024-04-01 20:14:22','2024-04-01 20:14:22');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `get_a_quote`
--

DROP TABLE IF EXISTS `get_a_quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `get_a_quote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `main_heading` varchar(300) NOT NULL,
  `right_side_content` varchar(300) NOT NULL,
  `anchor_text` varchar(300) NOT NULL,
  `anchor_link` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `get_a_quote`
--

LOCK TABLES `get_a_quote` WRITE;
/*!40000 ALTER TABLE `get_a_quote` DISABLE KEYS */;
INSERT INTO `get_a_quote` VALUES (1,'GET A FREE QUOTE','Think you need something but not sure what? That\'s what we\'re here for. Get in touch!','Book A Call','contact','2024-01-29 09:52:24','2024-02-06 00:24:30');
/*!40000 ALTER TABLE `get_a_quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `header_settings`
--

DROP TABLE IF EXISTS `header_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `header_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `header_logo` varchar(300) NOT NULL,
  `header_right_side_anchor_text` varchar(300) NOT NULL,
  `header_right_side_anchor_link` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `header_settings`
--

LOCK TABLES `header_settings` WRITE;
/*!40000 ALTER TABLE `header_settings` DISABLE KEYS */;
INSERT INTO `header_settings` VALUES (1,'header_logos/Disrupting.png','Book a Call','contact','2024-01-28 21:52:37','2024-02-29 21:14:10');
/*!40000 ALTER TABLE `header_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_settings`
--

DROP TABLE IF EXISTS `homepage_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homepage_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_one_main_heading` varchar(300) NOT NULL,
  `section_one_sub_heading` varchar(300) NOT NULL,
  `section_one_button_text` varchar(300) NOT NULL,
  `section_one_button_link` varchar(300) NOT NULL,
  `section_two_box_text` text NOT NULL,
  `section_three_main_heading` varchar(300) NOT NULL,
  `section_four_main_heading` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `embed_code` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_settings`
--

LOCK TABLES `homepage_settings` WRITE;
/*!40000 ALTER TABLE `homepage_settings` DISABLE KEYS */;
INSERT INTO `homepage_settings` VALUES (1,'Disruptors Media','Bringing Your company <br />from the past to future.','Book a Call','contact','Dive into the mind of a disruptor and reach your target audience with our data-driven strategies.','SERVICES','FEATURED CLIENTS','2024-01-29 12:18:25','2024-10-04 16:16:13','https://google.com');
/*!40000 ALTER TABLE `homepage_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_category`
--

DROP TABLE IF EXISTS `menu_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_category`
--

LOCK TABLES `menu_category` WRITE;
/*!40000 ALTER TABLE `menu_category` DISABLE KEYS */;
INSERT INTO `menu_category` VALUES (1,'Header ','2024-01-29 23:47:26','2024-01-29 23:47:26'),(2,'Footer','2024-01-29 23:47:26','2024-01-29 23:47:26');
/*!40000 ALTER TABLE `menu_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_manager`
--

DROP TABLE IF EXISTS `menu_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_manager` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `order` int NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_manager`
--

LOCK TABLES `menu_manager` WRITE;
/*!40000 ALTER TABLE `menu_manager` DISABLE KEYS */;
INSERT INTO `menu_manager` VALUES (27,2,10,'Gallery','/gallery','2024-02-05 23:05:20','2024-02-08 06:38:49'),(26,2,8,'Faq','/faq','2024-02-05 23:05:07','2024-02-06 04:36:34'),(25,2,7,'About','/about','2024-02-05 23:04:54','2024-02-06 04:36:40'),(24,2,6,'Services','/services','2024-02-05 23:04:44','2024-02-06 04:36:46'),(23,2,5,'Work','/work','2024-02-05 23:04:28','2024-02-06 04:36:54'),(22,1,4,'Gallery','/gallery','2024-02-05 23:01:24','2024-02-06 04:37:01'),(21,1,3,'About','/about','2024-02-05 23:01:10','2024-02-06 04:37:08'),(19,1,1,'Work','/work','2024-02-05 23:00:35','2024-02-09 06:26:58'),(20,1,2,'Services','/services','2024-02-05 23:00:49','2024-02-08 23:13:06'),(28,2,9,'Contact','/contact','2024-02-05 23:05:40','2024-02-08 06:38:49');
/*!40000 ALTER TABLE `menu_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_meta`
--

DROP TABLE IF EXISTS `page_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_meta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `home_meta_title` varchar(300) NOT NULL,
  `home_meta_description` longtext NOT NULL,
  `work_meta_title` varchar(300) NOT NULL,
  `work_meta_description` longtext NOT NULL,
  `services_meta_title` varchar(300) NOT NULL,
  `services_meta_description` longtext NOT NULL,
  `about_meta_title` varchar(300) NOT NULL,
  `about_meta_description` longtext NOT NULL,
  `gallery_meta_title` varchar(300) NOT NULL,
  `gallery_meta_description` longtext NOT NULL,
  `faq_meta_title` varchar(300) NOT NULL,
  `faq_meta_description` longtext NOT NULL,
  `contact_meta_title` varchar(300) NOT NULL,
  `contact_meta_description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_meta`
--

LOCK TABLES `page_meta` WRITE;
/*!40000 ALTER TABLE `page_meta` DISABLE KEYS */;
INSERT INTO `page_meta` VALUES (1,'Home','Disruptors Media is on a mission to empower you. We celebrate those who challenge broken systems with fresh ideas. Inspired by leading change makers, we\'ve developed a blueprint for anyone to build their voice and create a positive impact. The world needs you. Join us in taking action, even if it\'s not perfect. Together, let\'s shake things up for the better.','Work','Disruptors Media current and past clients.','Services','Disruptors Media is a 360 marketing agency that offers a wide range of services including podcasting, SEO, websites, photography, videography, branding, design, and so much more.','About','WE\'RE NOT JUST ANOTHER AGENCY.\r\nWE\'RE ARCHITECTS OF DIGITAL LANDSCAPES.\r\nTURNING CLICKS INTO CUSTOMERS.\r\nA WEBSITE THAT ADAPTS TO EVERY VISITOR.\r\nEMAIL CAMPAIGNS THAT FEEL LIKE PERSONAL LETTERS.\r\nSOCIAL MEDIA PAGES RECEIVING MILLIONS OF ENGAGEMENT.\r\nLAUNCHING BRANDS INTO THE DYNAMIC DIGITAL WORLD.\r\nWHERE EVERY INTERACTION IS AN OPPORTUNITY.\r\nIT\'S NOT JUST MARKETING.\r\nIT\'S A NEW CHAPTER FOR YOUR BRAND.','Gallery','Cool gallery of Disruptors Media images.','Faq','Frequently Asked Questions','Contact','Contact Us to learn more about how Disruptors Media can be an effective marketing resource to you!','2024-02-13 00:24:55','2024-07-05 21:21:09');
/*!40000 ALTER TABLE `page_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('lucaswillis741@gmail.com','$2y$10$kjKBAeY05iYmE4zU2EQsfeb3J9/LSnK566xTCzkQBzkdA8snjHfDK','2024-02-09 07:44:30'),('admin@admin.com','$2y$10$cphRJhzDuEs9XnBySdnZDeWPoEiUZbb1abU9c0hxXE/eeA8MXGBQy','2024-02-13 15:52:16');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_category`
--

DROP TABLE IF EXISTS `portfolio_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_category`
--

LOCK TABLES `portfolio_category` WRITE;
/*!40000 ALTER TABLE `portfolio_category` DISABLE KEYS */;
INSERT INTO `portfolio_category` VALUES (1,'Marketing','2024-02-01 12:44:32','2024-02-01 12:44:32'),(2,'UX/UI','2024-02-01 12:44:32','2024-02-01 12:44:32'),(3,'Web Development','2024-02-01 12:45:00','2024-02-01 12:45:00'),(6,'Branding','2024-02-09 07:09:16','2024-02-09 07:09:16'),(7,'Podcast','2024-02-16 19:08:19','2024-02-16 19:08:19'),(8,'Photography/Videography','2024-02-16 19:08:33','2024-02-16 19:08:33');
/*!40000 ALTER TABLE `portfolio_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_images`
--

DROP TABLE IF EXISTS `portfolio_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `portfolio_id` int DEFAULT NULL,
  `portfolio_images` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_images`
--

LOCK TABLES `portfolio_images` WRITE;
/*!40000 ALTER TABLE `portfolio_images` DISABLE KEYS */;
INSERT INTO `portfolio_images` VALUES (8,9,'project_gallery_images/facebook-app-symbol.png','2024-02-06 02:28:13','2024-02-06 02:28:13'),(9,9,'project_gallery_images/instagram.png','2024-02-06 02:28:13','2024-02-06 02:28:13'),(10,9,'project_gallery_images/twitter-sign (1).png','2024-02-06 02:28:13','2024-02-06 02:28:13'),(11,9,'project_gallery_images/twitter-sign.png','2024-02-06 02:28:13','2024-02-06 02:28:13'),(12,9,'project_gallery_images/youtube.png','2024-02-06 02:28:13','2024-02-06 02:28:13'),(14,8,'project_gallery_images/case-study-1.jpg','2024-02-06 04:35:39','2024-02-06 04:35:39'),(15,10,'project_gallery_images/book-left.png','2024-02-07 07:29:55','2024-02-07 07:29:55'),(16,10,'project_gallery_images/what-we-do-abt-3.png','2024-02-07 18:05:15','2024-02-07 18:05:15'),(17,10,'project_gallery_images/what-we-do-abt-2.png','2024-02-07 18:05:15','2024-02-07 18:05:15'),(18,10,'project_gallery_images/what-we-do-abt-1.png','2024-02-07 18:05:15','2024-02-07 18:05:15'),(19,11,'project_gallery_images/what-we-do-abt-3.png','2024-02-07 18:26:52','2024-02-07 18:26:52'),(20,11,'project_gallery_images/what-we-do-abt-2.png','2024-02-07 18:26:52','2024-02-07 18:26:52'),(21,11,'project_gallery_images/what-we-do-abt-1.png','2024-02-07 18:26:52','2024-02-07 18:26:52'),(22,11,'project_gallery_images/what-we-do-abt.png','2024-02-07 18:26:52','2024-02-07 18:26:52'),(65,18,'project_gallery_images/20160305_1519111.jpg','2024-02-09 02:11:14','2024-02-09 02:11:14'),(66,18,'project_gallery_images/1692833577-vc-about.png','2024-02-09 02:11:14','2024-02-09 02:11:14'),(67,18,'project_gallery_images/1692901600_Rectangle 33.png','2024-02-09 02:11:14','2024-02-09 02:11:14'),(76,12,'project_gallery_images/_AH_1745 1.png','2024-02-16 23:23:55','2024-02-16 23:23:55'),(77,12,'project_gallery_images/Drank 1.png','2024-02-16 23:23:55','2024-02-16 23:23:55'),(78,12,'project_gallery_images/Lion lit 1.png','2024-02-16 23:23:55','2024-02-16 23:23:55'),(79,12,'project_gallery_images/Obsession Lit 1.png','2024-02-16 23:23:55','2024-02-16 23:23:55'),(80,12,'project_gallery_images/Sparkling Lit 1.png','2024-02-16 23:23:55','2024-02-16 23:23:55'),(81,15,'project_gallery_images/image 115.png','2024-02-17 19:58:41','2024-02-17 19:58:41'),(82,15,'project_gallery_images/image 116.png','2024-02-17 19:58:41','2024-02-17 19:58:41'),(83,15,'project_gallery_images/image 117.png','2024-02-17 19:58:41','2024-02-17 19:58:41'),(84,15,'project_gallery_images/image 118.png','2024-02-17 19:58:41','2024-02-17 19:58:41'),(85,15,'project_gallery_images/image 114.png','2024-02-17 19:59:32','2024-02-17 19:59:32'),(86,14,'project_gallery_images/ConfRoom1 1.png','2024-02-17 20:14:23','2024-02-17 20:14:23'),(87,14,'project_gallery_images/image 105.png','2024-02-17 20:14:23','2024-02-17 20:14:23'),(89,14,'project_gallery_images/image 108.png','2024-02-17 20:14:23','2024-02-17 20:14:23'),(90,14,'project_gallery_images/Lobby 1.png','2024-02-17 20:14:23','2024-02-17 20:14:23'),(91,14,'project_gallery_images/Ste209b 1.png','2024-02-17 20:14:23','2024-02-17 20:14:23'),(92,16,'project_gallery_images/IMG_2851.png','2024-02-17 20:25:33','2024-02-17 20:25:33'),(93,16,'project_gallery_images/IMG_2854.png','2024-02-17 20:26:36','2024-02-17 20:26:36'),(94,16,'project_gallery_images/IMG_2855.png','2024-02-17 20:26:36','2024-02-17 20:26:36'),(95,16,'project_gallery_images/IMG_2858.png','2024-02-17 20:26:36','2024-02-17 20:26:36'),(96,16,'project_gallery_images/Psyched 1.png','2024-02-17 20:26:36','2024-02-17 20:26:36'),(97,17,'project_gallery_images/image 109.png','2024-02-17 20:34:47','2024-02-17 20:34:47'),(98,17,'project_gallery_images/image 110.png','2024-02-17 20:34:47','2024-02-17 20:34:47'),(99,17,'project_gallery_images/image 111.png','2024-02-17 20:34:47','2024-02-17 20:34:47'),(100,17,'project_gallery_images/image 112.png','2024-02-17 20:34:47','2024-02-17 20:34:47'),(103,13,'project_gallery_images/P1180579-3 1.png','2024-02-17 21:55:06','2024-02-17 21:55:06'),(104,13,'project_gallery_images/P1430154-Enhanced-NR.png','2024-02-17 21:55:06','2024-02-17 21:55:06'),(106,13,'project_gallery_images/P1430096-Enhanced-NR.png','2024-02-17 21:55:56','2024-02-17 21:55:56'),(107,13,'project_gallery_images/P1180600 1.png','2024-02-17 21:56:07','2024-02-17 21:56:07'),(108,13,'project_gallery_images/P1430188-Enhanced-NR.png','2024-02-17 21:56:57','2024-02-17 21:56:57'),(109,17,'project_gallery_images/IMG_6012 1.png','2024-02-17 22:05:58','2024-02-17 22:05:58'),(110,19,'project_gallery_images/IMG_9074.jpg','2024-03-21 22:24:19','2024-03-21 22:24:19'),(111,19,'project_gallery_images/IMG_9020.JPG','2024-03-21 22:26:02','2024-03-21 22:26:02'),(112,19,'project_gallery_images/IMG_9054.JPG','2024-03-21 22:26:02','2024-03-21 22:26:02'),(113,19,'project_gallery_images/IMG_9074.jpg','2024-03-21 22:26:02','2024-03-21 22:26:02'),(114,19,'project_gallery_images/IMG_9094.jpg','2024-03-21 22:26:02','2024-03-21 22:26:02'),(115,19,'project_gallery_images/IMG_9127.JPG','2024-03-21 22:26:02','2024-03-21 22:26:02'),(116,19,'project_gallery_images/IMG_9139.JPG','2024-03-21 22:26:02','2024-03-21 22:26:02'),(120,20,'project_gallery_images/P1022035.jpg','2024-05-24 17:37:38','2024-05-24 17:37:38'),(124,20,'project_gallery_images/Screen Shot 2024-05-24 at 11.30.14 AM.png','2024-05-24 17:38:16','2024-05-24 17:38:16'),(125,20,'project_gallery_images/Screen Shot 2024-05-24 at 11.32.10 AM.png','2024-05-24 17:38:34','2024-05-24 17:38:34'),(126,20,'project_gallery_images/P1022046.jpg','2024-05-24 17:39:21','2024-05-24 17:39:21'),(127,20,'project_gallery_images/P1022054.jpg','2024-05-24 17:40:16','2024-05-24 17:40:16');
/*!40000 ALTER TABLE `portfolio_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `portfolio_name` varchar(300) NOT NULL,
  `portfolio_slug` varchar(300) NOT NULL,
  `portfolio_image` varchar(300) NOT NULL,
  `overview_description` text NOT NULL,
  `team_description` text NOT NULL,
  `portfolio_tags` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (15,4,'1,6,8','Bruce Leeroy','bruce-leeroy','portfolios/image 114.png','Bruce Leeroy is an up and coming MMA fighter out of Los Angeles, California. With the help of Disruptors Media, he saw millions of views on both TikTok and Instagram. Now with over 30,000 followers combined on multiple platforms, he aims to make his professional debut later this year.','Creative Direction: Tyler Gordon, Media Production: Tyler Gordon, Marketing: Tyler Gordon, , , ','Branding, Photography, Marketing, Videography, ','2024-02-08 03:42:28','2024-02-17 19:58:12'),(13,2,'1,2,3,6,7,8','Community Cures','community-cures','portfolios/P1430136-Enhanced-NR.png','In the heart of Salt Lake City, Utah, lies Community Curescast, a podcast with a powerful mission: to weave riveting stories that bridge divides and foster connection within communities. But their vision needed a voice, a visual identity, and a strategic path to reach the hearts and minds they aimed to touch. That\'s where Disruptors Media came in. We became partners in purpose, crafting a compelling brand, developing engaging marketing campaigns to amplify their message, and bringing their stories to life through captivating videography.','Creative Direction: Bailey Latimer, Tyler Gordon, , , Marketing: Tyler Gordon, Carson Ireland, Website: Bailey Latimer, Mustafa Qureshi, , ','Branding, UX/UI, Marketing, Web Development, Videography','2024-02-08 03:42:28','2024-03-29 14:37:13'),(20,2,'1,6,7,8','Master Lu\'s Health Center','master-lus-health-center','portfolios/P1022046.jpg','Master Lu\'s Health Center sought out Disruptors Media to increase clients for their martial arts studio and acupuncture practice. From our campaign, we have been able to generate thousands of engagement and an increase of clients.','Marketing: Tyler Gordon, Creative Direction:  Carson Ireland, Videography: Chad Coleman, Photography: Matheus Barbosa-Costa','Photography, Videography, Branding, Marketing, Podcast','2024-05-24 17:18:13','2024-05-24 17:28:02'),(14,3,'1,2,3,6,7,8','E-District','e-district','portfolios/image 106.png','E-District is a commerical building located just north of Salt Lake City International Airport. Disruptors Media was tasked with helping them grow more clients for their podcast studio and LED billboard. Through this collaboration, we have reviltalized their branding and helped increased clientele.','Creative Direction:  Carson Ireland, Marketing: Tyler Gordon, Carson Ireland, Web Development: Tyler Gordon, Bailey Latimer, , , , , , , , ','Branding, Photography, Marketing, Videography, ','2024-02-08 03:42:28','2024-03-29 14:38:23'),(12,1,'1,6','Desjardins Brands','desjardins-brands','portfolios/_AH_1595.jpg','Disruptors Media: The key ingredient to Desjardins Brands\' success: Desjardins Brands, a LA-based luxury food and beverage distributor, sought our expertise to elevate their brand and amplify their reach. Our strategic guidance and viral digital campaigns fueled their success, propelling them to generate over $100,000 in revenue per year.','Creative Direction: Tyler Gordon, , Marketing: Tyler Gordon, UX/UI: Bailey Latimer, , ','Branding, Social Media, Marketing, Creative, Design','2024-02-08 03:42:28','2024-03-29 14:36:35'),(19,2,'1,6,7,8','BF4Real Podcast','bf4real-podcast','portfolios/BF4REAL MAIN IMAGE.png','The BF4Real Podcast transcends borders by featuring high-profile guests with millions of followers. From acclaimed artists and cultural leaders to captivating storytellers and everyday heroes, the podcast offers a unique space for diverse perspectives to come together.','Media Production: Carson Ireland, Tyler Gordon, Creative Direction: Tyler Gordon, Carson Ireland, ','Photography, Videography, Branding, Marketing, Podcast','2024-03-21 22:24:19','2024-03-29 14:34:38'),(16,6,'1,2,3,6,8','Physched Out','physched-out','portfolios/IMG_2851.png','Psyched Out Clothing is an up and coming clothing brand based out of Florida. They specialize in custom pieces tailored to every day fashion. Disruptors Media was tasked with creating a beautiful website and developing the branding for the company.','Creative Direction: Tyler Gordon, UX/UI: Tyler Gordon, Web Development: Bailey Latimer, Marketing: Tyler Gordon, , , , , ','Branding, UI/UX, Marketing, Web Development, Photography','2024-02-08 03:42:28','2024-03-29 14:40:02'),(17,5,'1,2,3,6','BYS','bys','portfolios/IMG_6012 1.png','BYS is a sports promotion focused on teaching self defense through martial arts and preventing gun violence in Los Angeles - to over 100,000 combined followers across various social media platforms.&nbsp; Through working with BYS, Disruptors Media developed a passion for marketing and making a positive impact in local communities.','Creative Direction: Tyler Gordon, Marketing: Tyler Gordon, Web Development: Tyler Gordon, , , ','Branding, UX/UI, Marketing, Web Development, ','2024-02-08 03:42:28','2024-03-29 14:39:19');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_scripts`
--

DROP TABLE IF EXISTS `seo_scripts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seo_scripts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `google_search_console` longtext NOT NULL,
  `google_analytics` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_scripts`
--

LOCK TABLES `seo_scripts` WRITE;
/*!40000 ALTER TABLE `seo_scripts` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo_scripts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_page`
--

DROP TABLE IF EXISTS `services_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `services_page_main_heading` varchar(300) NOT NULL,
  `services_page_box_inner_image` varchar(300) NOT NULL,
  `services_page_box_inner_content` text NOT NULL,
  `services_page_second_section_main_heading` varchar(300) NOT NULL,
  `services_page_second_section_main_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_page`
--

LOCK TABLES `services_page` WRITE;
/*!40000 ALTER TABLE `services_page` DISABLE KEYS */;
INSERT INTO `services_page` VALUES (1,'FULL-FUNNEL APPROACH','services_page_box_inner_image/services-img.png','Our approach is simple yet impactful. We combine strategic thinking with creative flair to enhance your digital presence and drive real results. Whether expanding your audience or boosting your online profile, our process is designed to take your brand from ordinary to extraordinary, efficiently and effectively.','WHAT WE DO','Call us traditional, but we believe in the old-fashioned way of connection. And no, we don\'t mean Myspace. You can have a killer product or service, but that\'s not what sets you apart. It\'s how people feel after each interaction.','2024-01-31 17:37:56','2024-02-10 06:09:14');
/*!40000 ALTER TABLE `services_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_media_cat`
--

DROP TABLE IF EXISTS `social_media_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_media_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `social_media_cat_name` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_media_cat`
--

LOCK TABLES `social_media_cat` WRITE;
/*!40000 ALTER TABLE `social_media_cat` DISABLE KEYS */;
INSERT INTO `social_media_cat` VALUES (2,'facebook','2024-02-06 08:20:16','2024-02-06 08:20:16'),(3,'youtube','2024-02-06 08:20:39','2024-02-06 08:20:39'),(4,'instagram','2024-02-06 08:20:47','2024-02-06 08:20:47'),(5,'twitter','2024-02-06 08:20:52','2024-02-06 08:20:52'),(9,'TikTok','2024-02-09 07:22:56','2024-02-09 07:22:56');
/*!40000 ALTER TABLE `social_media_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_media_links`
--

DROP TABLE IF EXISTS `social_media_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_media_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `social_media_link_name` varchar(255) NOT NULL,
  `social_media_icon` varchar(300) NOT NULL,
  `social_media_link_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_media_links`
--

LOCK TABLES `social_media_links` WRITE;
/*!40000 ALTER TABLE `social_media_links` DISABLE KEYS */;
INSERT INTO `social_media_links` VALUES (12,3,'youtube','social_media_icon/youtube.svg','https://www.youtube.com/channel/UCIS7eKSZMJWnUT1dTLBjOWA','2024-02-06 00:42:56','2024-02-09 07:20:32'),(13,4,'instagram','social_media_icon/insta.svg','https://www.instagram.com/disruptorsmedia_','2024-02-06 00:44:10','2024-02-09 07:20:01'),(14,1,'twitter','social_media_icon/x-twitter.svg','https://twitter.com/DisruptorsMedia','2024-02-06 00:44:56','2024-02-09 07:31:23'),(15,2,'TikTok','social_media_icon/tiktok.png','https://www.tiktok.com/@disruptorsmedia','2024-02-09 07:28:18','2024-02-09 07:31:23');
/*!40000 ALTER TABLE `social_media_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `who_we_do`
--

DROP TABLE IF EXISTS `who_we_do`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `who_we_do` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `category_id` int NOT NULL,
  `featured_image` varchar(300) DEFAULT NULL,
  `feature_video` text,
  `main_heading` varchar(300) NOT NULL,
  `enter_link` varchar(300) NOT NULL,
  `excerpt` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `who_we_do`
--

LOCK TABLES `who_we_do` WRITE;
/*!40000 ALTER TABLE `who_we_do` DISABLE KEYS */;
INSERT INTO `who_we_do` VALUES (4,1,2,'who_we_do/what-we-do-bx.jpg','','Digital','/services','We orchestrate your entire digital presence, from website management to paid advertising and more.','2024-01-29 11:57:31','2024-02-29 21:23:28'),(5,2,2,'who_we_do/seo.jpg','','SEO','/services','We unlock the power of search engines, driving organic traffic and boosting your visibility online.','2024-01-29 12:01:51','2024-02-29 18:18:14'),(6,3,2,'who_we_do/optimization.jpg','','Podcast','/services','We provide the platform for you to capture your audio and visuals in stunning detail.','2024-01-29 12:12:52','2024-06-04 15:16:23'),(8,4,2,'who_we_do/strategy.jpg','','Strategy','/services','We craft personalized, AI-driven strategies that bridge the gap between your goals and tangible results.','2024-01-31 11:14:17','2024-02-29 18:18:40'),(9,5,1,'who_we_do/what-we-do-abt-1.jpg','','DISCOVERY CALL','/contact','Kick-off with Insight: A focused call to understand your brand\'s needs and outline our role in your growth story.','2024-02-04 13:04:56','2024-02-29 21:22:59'),(10,6,1,'who_we_do/what-we-do-abt-2.jpg','','SEND PROPOSAL','/contact','Strategic Blueprint: A detailed proposal presenting a customized plan for your brand\'s digital and creative journey.','2024-02-04 13:06:27','2024-02-29 21:22:44'),(11,7,1,'who_we_do/what-we-do-abt-3.jpg','','SCOPE OF WORK','/contact','We help you build a sustainable, competitive advantage through data-driven creative that establishes brand identity, engages consumers, and drives traffic.','2024-02-04 13:08:28','2024-02-29 21:21:33'),(12,8,1,'who_we_do/what-we-do-abt-4.jpg','','START DESIGN + CREATIVE WORK','/contact','Creative Execution: Launching into the design and marketing phase to turn your brand vision into impactful reality.','2024-02-04 13:10:22','2024-02-29 21:21:03'),(18,15,3,'who_we_do/Creative.jpg',NULL,'Creative','/services','We captivate audiences with compelling content and design, fueled by the power of AI-assisted creativity.','2024-02-29 15:14:35','2024-02-29 18:18:52'),(19,15,3,'who_we_do/web-dev.jpg',NULL,'Web Development','/services','We build stunning, high-performing websites that serve as the foundation for your online success.','2024-02-29 15:15:44','2024-02-29 18:19:06'),(20,15,3,'who_we_do/social.jpg',NULL,'Social Management','/services','We engage your audience and build vibrant communities across all major social media platforms.','2024-02-29 15:16:49','2024-02-29 21:23:58'),(21,15,3,'who_we_do/ecom.jpg',NULL,'E-commerce','/services','We design and implement seamless online shopping experiences that convert visitors into loyal customers.','2024-02-29 15:17:37','2024-02-29 21:24:25');
/*!40000 ALTER TABLE `who_we_do` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-04 17:10:42
