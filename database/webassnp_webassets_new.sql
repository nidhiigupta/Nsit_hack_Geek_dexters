-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2018 at 07:10 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webassnp_webassets_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_email` text NOT NULL,
  `admin_phone` text NOT NULL,
  `admin_password` text NOT NULL,
  `admin_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_phone`, `admin_password`, `admin_image`) VALUES
(8, 'Sai Kiran', 'saikiran.2310@gmail.com', '9035266874', '$2y$10$bzWesdeo5d1Oim49NIqJH.AXA5QPR0693mloGQl8QvYt2sF.HF8fK', '/images/default_profile_pic.png');

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `analytics_id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `token_id` int(11) NOT NULL,
  `last_run` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analytics`
--

INSERT INTO `analytics` (`analytics_id`, `camp_id`, `inf_id`, `token_id`, `last_run`, `time`, `is_active`) VALUES
(7, 7, 14, 4, 1517425754, 1517424274, 1),
(8, 7, 14, 7, 1517425759, 1517424300, 1),
(9, 8, 14, 0, 1517425763, 1517424581, 1);

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `approve_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `value` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`approve_id`, `pro_id`, `camp_id`, `brand_id`, `inf_id`, `name`, `image`, `video`, `content`, `value`) VALUES
(3, 5, 7, 9, 14, 'Sai Kiran', '/uploads/images/approval/99f0e91e4f90ecc.jpg', '', 'This year\'s Virtual Bounty is live, and better than ever! Put on your thinking cap, and get hunting!\n\nTo play, go to: http://virtualbounty.engineer.org.in/\n\nCash prizes to be won! All the best!', 1),
(4, 6, 8, 9, 14, 'Sai Kiran', '/assets/images/noimage.png', '', 'fghfghfghfgh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` text NOT NULL,
  `bank_name` text NOT NULL,
  `account_holder_name` text NOT NULL,
  `ifsc_code` text NOT NULL,
  `account_number` text NOT NULL,
  `mobile_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `website` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `oauth_uid` text NOT NULL,
  `oauth_provider` text NOT NULL,
  `locale` text NOT NULL,
  `profile_url` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` text NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `activate_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `email`, `password`, `image`, `website`, `phone`, `industry`, `is_active`, `oauth_uid`, `oauth_provider`, `locale`, `profile_url`, `created`, `modified`, `username`, `token`, `activate_token`) VALUES
(9, 'Sai Kiran', 'phsaikiran.2310@gmail.com', '$2y$10$dbi8kpzOZuo6VRDPFcvMfOd6DFcv1B2fIbWsuaPHKWbMbXzT2goWy', '/images/default_profile_pic.png', '', 9035266874, 'Crypto Currencies', 1, '', '', '', '', '2018-01-17 11:03:36', '2018-01-21 06:29:28', '', NULL, '6b6e574c00ef2b889f6f390d1563ba0dff66d4aa72d2d72745977d44af5a');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `camp_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `camp_name` text,
  `camp_image` text NOT NULL,
  `desp` text NOT NULL,
  `number_of` int(11) NOT NULL,
  `camp_price` float NOT NULL,
  `camp_category` varchar(255) DEFAULT NULL,
  `camp_type` varchar(255) NOT NULL,
  `camp_price_currency` varchar(10) NOT NULL,
  `cm_id` text NOT NULL,
  `cm_link` text NOT NULL,
  `ori_link` text NOT NULL,
  `camp_completion_date` timestamp NOT NULL,
  `camp_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `camp_by` int(11) NOT NULL,
  `status` enum('Ongoing','Completed') NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`camp_id`, `id`, `camp_name`, `camp_image`, `desp`, `number_of`, `camp_price`, `camp_category`, `camp_type`, `camp_price_currency`, `cm_id`, `cm_link`, `ori_link`, `camp_completion_date`, `camp_created`, `camp_by`, `status`, `is_active`) VALUES
(7, 1, 'sdfsfsdfs', 'images/campaigns/4d6a0e7e466e151.jpg', 'dfsdfsdfsdfsdf', 333, 10989, 'Facebook', 'Likes', 'INR', '', '', '', '2002-12-12 14:48:00', '2018-01-21 06:40:45', 9, 'Ongoing', 1),
(8, 2, 'tw', 'images/campaigns/694eabca410cc15.jpg', 'wtwt', 4, 16, 'Twitter', 'Favorites', 'INR', '', '', '', '2017-12-11 18:30:00', '2018-01-31 18:46:19', 9, 'Ongoing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `camp_data`
--

CREATE TABLE `camp_data` (
  `id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `token_id` int(11) NOT NULL,
  `camp_link` varchar(255) NOT NULL,
  `percent_completion` float NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camp_data`
--

INSERT INTO `camp_data` (`id`, `camp_id`, `inf_id`, `token_id`, `camp_link`, `percent_completion`, `post_id`, `status`) VALUES
(7, 7, 14, 4, 'https://www.facebook.com/703224756441255_910714085692320', 0, '703224756441255_910714085692320', 1),
(8, 7, 14, 7, 'https://www.facebook.com/118703882058855_182255292370380', 0, '118703882058855_182255292370380', 1),
(9, 8, 14, 0, 'https://www.twitter.com/statuses/958790267137486849', 0, '958790267137486849', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `msg_by` tinytext NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `brand_id`, `inf_id`, `msg`, `msg_by`, `time`) VALUES
(47, 9, 14, 'Changes!!', 'b', '2018-01-21 06:46:01'),
(48, 9, 14, 'Hey!', 'b', '2018-01-21 06:46:05'),
(49, 9, 14, 'Hey!', 'b', '2018-01-21 06:46:07'),
(50, 9, 14, 'HEy!These are the changes', 'b', '2018-01-21 16:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `influencers`
--

CREATE TABLE `influencers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `intro` text NOT NULL,
  `category` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(255) DEFAULT NULL,
  `activate_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `influencers`
--

INSERT INTO `influencers` (`id`, `name`, `phone`, `industry`, `email`, `password`, `image`, `intro`, `category`, `is_active`, `created`, `modified`, `token`, `activate_token`) VALUES
(14, 'Sai Kiran', '9035266874', 'Crypto Currencies', 'saikiran.2310@gmail.com', '$2y$10$AVZpyaubrUzTF71G8i4WEuDRe6QJki4AzlDh.JgNLvmeHKVPBJ.gi', 'images/influencers/9e1a36515d6704d.jpg', '', '', 1, '2018-01-17 09:33:00', '2018-01-21 06:39:42', NULL, '70c038acb29102550d71545e37142251f48b2bb35f24b3261e7b79660228');

-- --------------------------------------------------------

--
-- Table structure for table `notif_brand`
--

CREATE TABLE `notif_brand` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `time` bigint(20) NOT NULL,
  `clicked` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_brand`
--

INSERT INTO `notif_brand` (`id`, `brand_id`, `msg`, `link`, `category`, `time`, `clicked`) VALUES
(12, 9, 'Campaign approved!', 'brand/view_campaign?camp_id=1', 'Campaign', 1516516845, 1),
(13, 9, 'New offer on your campaign', 'brand/view_campaign?camp_id=7&redirect=id', 'Offer', 1516516888, 1),
(14, 9, 'New campaign request', 'brand/view_campaign?camp_id=7&redirect=id', 'Campaign', 1516517133, 1),
(15, 9, 'Campaign request updated', 'brand/view_campaign?camp_id=7&redirect=id', 'Campaign', 1516517206, 1),
(16, 9, 'New offer on your campaign', 'brand/view_campaign?camp_id=7&redirect=id', 'Offer', 1516551986, 0),
(17, 9, 'New campaign request', 'brand/view_campaign?camp_id=7&redirect=id', 'Campaign', 1516552102, 0),
(18, 9, 'Campaign request updated', 'brand/view_campaign?camp_id=7&redirect=id', 'Campaign', 1516552187, 0),
(19, 9, 'Campaign approved!', 'brand/view_campaign?camp_id=2', 'Campaign', 1517424379, 0),
(20, 9, 'New offer on your campaign', 'brand/view_campaign?camp_id=8&redirect=id', 'Offer', 1517424443, 0),
(21, 9, 'New campaign request', 'brand/view_campaign?camp_id=8&redirect=id', 'Campaign', 1517424484, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notif_inf`
--

CREATE TABLE `notif_inf` (
  `id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `time` bigint(20) NOT NULL,
  `clicked` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_inf`
--

INSERT INTO `notif_inf` (`id`, `inf_id`, `msg`, `link`, `category`, `time`, `clicked`) VALUES
(43, 14, 'You offer has been accepted', 'influencer/view_campaign?camp_id=7&redirect=id', 'Offer', 1516517099, 1),
(44, 14, 'Message From Sai Kiran', 'influencer/chat', 'Messages', 1516517161, 1),
(45, 14, 'Message From Sai Kiran', 'influencer/chat', 'Messages', 1516517165, 1),
(46, 14, 'Message From Sai Kiran', 'influencer/chat', 'Messages', 1516517167, 1),
(47, 14, 'You campaign has been accepted', 'influencer/view_campaign?camp_id=7&redirect=id', 'Campaign', 1516517215, 1),
(48, 14, 'You offer has been accepted', 'influencer/view_campaign?camp_id=7&redirect=id', 'Offer', 1516552066, 0),
(49, 14, 'Message From Sai Kiran', 'influencer/chat', 'Messages', 1516552157, 0),
(50, 14, 'You campaign has been accepted', 'influencer/view_campaign?camp_id=7&redirect=id', 'Campaign', 1516552198, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `sale_id` varchar(255) NOT NULL,
  `payment_from` varchar(255) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `tax` float NOT NULL,
  `subtotal` float NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `pro_id` int(11) NOT NULL,
  `pro_by` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_for` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `pro_msg` text NOT NULL,
  `pro_price` float NOT NULL,
  `approval` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`pro_id`, `pro_by`, `pro_name`, `pro_for`, `brand_id`, `pro_msg`, `pro_price`, `approval`) VALUES
(5, 14, 'Sai Kiran', 7, 9, '123123', 12, 1),
(6, 14, 'Sai Kiran', 8, 9, '3333', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reporting`
--

CREATE TABLE `reporting` (
  `report_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `id` text NOT NULL,
  `name` text NOT NULL,
  `access_token` text NOT NULL,
  `access_token_secret` text NOT NULL,
  `last_run` bigint(20) NOT NULL,
  `time` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cat_id` varchar(255) NOT NULL,
  `cat_token` text NOT NULL,
  `followers` int(11) NOT NULL,
  `added_on` bigint(20) NOT NULL,
  `next_refresh` bigint(20) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `inf_id`, `category`, `name`, `image`, `cat_id`, `cat_token`, `followers`, `added_on`, `next_refresh`, `is_active`) VALUES
(4, 14, 'fb', 'Virtual Bounty', 'https://scontent.xx.fbcdn.net/v/t1.0-1/26231161_1824527494286908_6696132803407196137_n.jpg?oh=f86a961d42cc471a6ab0dd32fa2d4511&oe=5AFB54CC', '703224756441255', '{"access_token":"EAAGi2cF6LUsBAMpWf6hgAUt8h6TbOmJLhLsaaM2PTEzGfqzM8afpFZBnHekYQZAUbKuzsTZALDRGbW9usopTOeZCaxZBqQVYmayXRxZBm5TaXNGRRWC02s5tKNOm5zZARPrTNe04SRK4CfiYPTmqos6ZBPABlnN8EhimEIKZBnQ3PAwZDZD","id":"1635355973204062"}', 669, 1516516711, 1521700711, 1),
(5, 14, 'fb', 'IET NITK', 'https://scontent.xx.fbcdn.net/v/t1.0-1/26231161_1824527494286908_6696132803407196137_n.jpg?oh=f86a961d42cc471a6ab0dd32fa2d4511&oe=5AFB54CC', '176287479458861', '{"access_token":"EAAGi2cF6LUsBACQRHrEiP1ZCN39Rmgn9DhsL1wl8ZCdhSM6qirJc3Mky2P5o74VpUGHw67jQ4AVoTj3PrHidbKbU3IoGZBqi7WY0G6wChwxzVZAZBtZCR5eXB2S6rCqZA07p0C9HSpMRB2p6nGfeikX9d9jygJryYJwJOrZChJTW3wZDZD","id":"1635355973204062"}', 754, 1516516723, 1521700723, 1),
(6, 14, 'fb', 'Test1111sdfsdf', 'https://scontent.xx.fbcdn.net/v/t1.0-1/10414463_1380802568897689_636683261291066799_n.jpg?oh=ad718179323855bdabd834ab4ee10927&oe=5AE4F9CD', '1910384062618349', '{"access_token":"EAAGi2cF6LUsBAF8rqjnI8TmyrZBXBZB9juJwoOgtEiaiNWbqLQDF12DdJLlHHZCHgTQCKqQIDDaxCwaIIEXFZCxcBfrMdH4AZAP4ZCeJ7vuNLrV4LWZBQrQUbWAbXjo3D55a0g6EhZADrjRYV4ftCFvhmabppcPx8nubUUX1IwBZArbMSQiy18QRw","id":"1814933172151291"}', 1, 1516527262, 1521711262, 1),
(7, 14, 'fb', 'TenisonFoure', 'https://scontent.xx.fbcdn.net/v/t1.0-1/10414463_1380802568897689_636683261291066799_n.jpg?oh=ad718179323855bdabd834ab4ee10927&oe=5AE4F9CD', '118703882058855', '{"access_token":"EAAGi2cF6LUsBADYaV79ZBLxyrNWNUVzZAyTBhMVa8fZAz4uweDTW8HJvjJlpKZBuXGpES1sZC1NwhE1pk3Fr7opCpZCZBOeCyogKeWxZC20SJ18cAqhNeE0rMaxy6ykBQd4EC7UPTaUPQYFZB1PWwp1BHvzX46NIpJIrHJ1wPFO5HnXYacwRXvTEi","id":"1814933172151291"}', 21, 1516527280, 1521711280, 1),
(8, 14, 'tw', 'ionlycomment23', NULL, 'ionlycomment23', '{"id":"3009152568","access_token":"3009152568-ze31n9y76FsUlAJnWdNSb2dndCtDG2plZjpno5h","access_token_secret":"e3F5LK4VZA0LL0mcBmQERW9joiBMwRiFf7Shc90Z4Fjdp"}', 1, 1517424431, 1522608431, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `created` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `brand_id`, `amount`, `created`) VALUES
(1, 9, 95864.8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `webassets_fb_analytics_9`
--

CREATE TABLE `webassets_fb_analytics_9` (
  `id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `camp_data_id` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webassets_fb_analytics_9`
--

INSERT INTO `webassets_fb_analytics_9` (`id`, `camp_id`, `camp_data_id`, `timestamp`, `data`) VALUES
(7, 7, 7, 1517425689, '{"post_impressions":989,"post_impressions_unique":490,"post_impressions_paid":0,"post_impressions_paid_unique":0,"post_impressions_fan":291,"post_impressions_fan_unique":117,"post_impressions_fan_paid":0,"post_impressions_fan_paid_unique":0,"post_impressions_organic":249,"post_impressions_organic_unique":98,"post_impressions_viral":740,"post_impressions_viral_unique":407,"post_consumptions":19,"post_consumptions_unique":13,"post_engaged_users":18,"post_negative_feedback":0,"post_negative_feedback_unique":0,"post_engaged_fan":13,"post_fan_reach":117,"post_reactions_like_total":3,"post_reactions_love_total":0,"post_reactions_wow_total":0,"post_reactions_haha_total":0,"post_reactions_sorry_total":0,"post_reactions_anger_total":0,"comments":1,"shares":3}'),
(8, 7, 8, 1517425690, '{"post_impressions":6,"post_impressions_unique":3,"post_impressions_paid":0,"post_impressions_paid_unique":0,"post_impressions_fan":4,"post_impressions_fan_unique":2,"post_impressions_fan_paid":0,"post_impressions_fan_paid_unique":0,"post_impressions_organic":6,"post_impressions_organic_unique":3,"post_impressions_viral":0,"post_impressions_viral_unique":0,"post_consumptions":0,"post_consumptions_unique":0,"post_engaged_users":0,"post_negative_feedback":0,"post_negative_feedback_unique":0,"post_engaged_fan":0,"post_fan_reach":2,"post_reactions_like_total":0,"post_reactions_love_total":0,"post_reactions_wow_total":0,"post_reactions_haha_total":0,"post_reactions_sorry_total":0,"post_reactions_anger_total":0,"comments":0,"shares":0}'),
(9, 7, 7, 1517425740, '{"post_impressions":989,"post_impressions_unique":490,"post_impressions_paid":0,"post_impressions_paid_unique":0,"post_impressions_fan":291,"post_impressions_fan_unique":117,"post_impressions_fan_paid":0,"post_impressions_fan_paid_unique":0,"post_impressions_organic":249,"post_impressions_organic_unique":98,"post_impressions_viral":740,"post_impressions_viral_unique":407,"post_consumptions":19,"post_consumptions_unique":13,"post_engaged_users":18,"post_negative_feedback":0,"post_negative_feedback_unique":0,"post_engaged_fan":13,"post_fan_reach":117,"post_reactions_like_total":3,"post_reactions_love_total":0,"post_reactions_wow_total":0,"post_reactions_haha_total":0,"post_reactions_sorry_total":0,"post_reactions_anger_total":0,"comments":1,"shares":3}'),
(10, 7, 8, 1517425744, '{"post_impressions":6,"post_impressions_unique":3,"post_impressions_paid":0,"post_impressions_paid_unique":0,"post_impressions_fan":4,"post_impressions_fan_unique":2,"post_impressions_fan_paid":0,"post_impressions_fan_paid_unique":0,"post_impressions_organic":6,"post_impressions_organic_unique":3,"post_impressions_viral":0,"post_impressions_viral_unique":0,"post_consumptions":0,"post_consumptions_unique":0,"post_engaged_users":0,"post_negative_feedback":0,"post_negative_feedback_unique":0,"post_engaged_fan":0,"post_fan_reach":2,"post_reactions_like_total":0,"post_reactions_love_total":0,"post_reactions_wow_total":0,"post_reactions_haha_total":0,"post_reactions_sorry_total":0,"post_reactions_anger_total":0,"comments":0,"shares":0}'),
(11, 7, 7, 1517425757, '{"post_impressions":989,"post_impressions_unique":490,"post_impressions_paid":0,"post_impressions_paid_unique":0,"post_impressions_fan":291,"post_impressions_fan_unique":117,"post_impressions_fan_paid":0,"post_impressions_fan_paid_unique":0,"post_impressions_organic":249,"post_impressions_organic_unique":98,"post_impressions_viral":740,"post_impressions_viral_unique":407,"post_consumptions":19,"post_consumptions_unique":13,"post_engaged_users":18,"post_negative_feedback":0,"post_negative_feedback_unique":0,"post_engaged_fan":13,"post_fan_reach":117,"post_reactions_like_total":3,"post_reactions_love_total":0,"post_reactions_wow_total":0,"post_reactions_haha_total":0,"post_reactions_sorry_total":0,"post_reactions_anger_total":0,"comments":1,"shares":3}'),
(12, 7, 8, 1517425761, '{"post_impressions":6,"post_impressions_unique":3,"post_impressions_paid":0,"post_impressions_paid_unique":0,"post_impressions_fan":4,"post_impressions_fan_unique":2,"post_impressions_fan_paid":0,"post_impressions_fan_paid_unique":0,"post_impressions_organic":6,"post_impressions_organic_unique":3,"post_impressions_viral":0,"post_impressions_viral_unique":0,"post_consumptions":0,"post_consumptions_unique":0,"post_engaged_users":0,"post_negative_feedback":0,"post_negative_feedback_unique":0,"post_engaged_fan":0,"post_fan_reach":2,"post_reactions_like_total":0,"post_reactions_love_total":0,"post_reactions_wow_total":0,"post_reactions_haha_total":0,"post_reactions_sorry_total":0,"post_reactions_anger_total":0,"comments":0,"shares":0}');

-- --------------------------------------------------------

--
-- Table structure for table `webassets_tw_analytics_9`
--

CREATE TABLE `webassets_tw_analytics_9` (
  `id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `camp_data_id` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webassets_tw_analytics_9`
--

INSERT INTO `webassets_tw_analytics_9` (`id`, `camp_id`, `camp_data_id`, `timestamp`, `data`) VALUES
(1, 8, 9, 1517424770, '{"favorites":0,"retweets":0,"replies":0}'),
(2, 8, 9, 1517425694, '{"favorites":0,"retweets":0,"replies":0}'),
(3, 8, 9, 1517425748, '{"favorites":0,"retweets":0,"replies":0}'),
(4, 8, 9, 1517425764, '{"favorites":0,"retweets":0,"replies":0}');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`analytics_id`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`approve_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`camp_id`);

--
-- Indexes for table `camp_data`
--
ALTER TABLE `camp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencers`
--
ALTER TABLE `influencers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_brand`
--
ALTER TABLE `notif_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_inf`
--
ALTER TABLE `notif_inf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `reporting`
--
ALTER TABLE `reporting`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webassets_fb_analytics_9`
--
ALTER TABLE `webassets_fb_analytics_9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webassets_tw_analytics_9`
--
ALTER TABLE `webassets_tw_analytics_9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `analytics_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `approve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `camp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `camp_data`
--
ALTER TABLE `camp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `influencers`
--
ALTER TABLE `influencers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `notif_brand`
--
ALTER TABLE `notif_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `notif_inf`
--
ALTER TABLE `notif_inf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reporting`
--
ALTER TABLE `reporting`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `webassets_fb_analytics_9`
--
ALTER TABLE `webassets_fb_analytics_9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `webassets_tw_analytics_9`
--
ALTER TABLE `webassets_tw_analytics_9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
