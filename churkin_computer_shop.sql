-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 19 2024 г., 11:28
-- Версия сервера: 10.11.10-MariaDB-ubu2204
-- Версия PHP: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `churkin_computer_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `80plus_certificate`
--

CREATE TABLE `80plus_certificate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `80plus_certificate`
--

INSERT INTO `80plus_certificate` (`id`, `name`) VALUES
(1, 'Bronze'),
(2, 'Gold'),
(3, 'Platinum'),
(4, 'Silver'),
(5, 'Standart'),
(6, 'Titanium'),
(7, 'нет');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL COMMENT 'id пользователя',
  `product` int(11) NOT NULL COMMENT 'id товара',
  `count` int(11) NOT NULL COMMENT 'количество товаров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `case_size`
--

CREATE TABLE `case_size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `case_size`
--

INSERT INTO `case_size` (`id`, `name`) VALUES
(1, 'Desktop'),
(2, 'Full-Tower'),
(3, 'Mid-Tower'),
(4, 'Mini-Tower'),
(5, 'NUC'),
(6, 'Slim'),
(7, 'Super/Ultra-Tower'),
(8, 'компактный (SFF)'),
(9, 'нестандартный'),
(10, 'открытый корпус'),
(11, 'открытый стенд');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `code`, `name`) VALUES
(1, 'computer_case', 'корпус компьютера'),
(2, 'motherboard', 'материнская плата'),
(3, 'power_supply', 'блок питания'),
(4, 'video_card', 'видеокарта'),
(5, 'ram', 'оперативная память'),
(6, 'processor', 'процессор');

-- --------------------------------------------------------

--
-- Структура таблицы `computer_case`
--

CREATE TABLE `computer_case` (
  `id` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL COMMENT 'Производитель',
  `motherboard_form_factor` int(11) DEFAULT NULL COMMENT 'Форм-фактор совместимых плат',
  `power_supply_form_factor` int(11) DEFAULT NULL COMMENT 'Форм-фактор совместимых блоков питания',
  `case_size` int(11) DEFAULT NULL COMMENT 'Типоразмер корпуса',
  `name` varchar(255) NOT NULL COMMENT 'полное наименование',
  `price` int(11) NOT NULL COMMENT 'цена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `computer_case`
--

INSERT INTO `computer_case` (`id`, `manufacturer`, `motherboard_form_factor`, `power_supply_form_factor`, `case_size`, `name`, `price`) VALUES
(1, 5, 3, 8, 3, 'Корпус ARDOR GAMING Rare M2 ARGB черный', 7199),
(2, 81, 2, 8, 3, 'Корпус Cougar Duoface Pro RGB [CGR-5AD1B-RGB] черный', 8999),
(5, 177, 2, 8, 3, 'Корпус MONTECH KING 95 PRO белый', 17899),
(6, 9, 4, 8, 4, 'Корпус DEXP DC-202M черный', 1499),
(7, 81, 2, 8, 2, 'Корпус Cougar MX600 RGB White [3857C90.0018] белый', 10999),
(8, 5, 3, 8, 4, 'Корпус ARDOR GAMING Rare Minicase MS4 GG серый', 3899),
(9, 176, 2, 8, 2, 'Корпус LIAN LI O11D Evo XL [G99.O11DEXL-X.R0] черный', 24999),
(31, 11, 4, 8, 4, 'Корпус MSI MAG PANO M100R PZ WHITE [306-7G24W21-809] белый', 11999),
(32, 178, 2, 8, 3, 'Корпус ZALMAN i4 [i4 WH] белый', 6999),
(33, 188, 2, 8, 3, 'Корпус APNX Creator C1 [APCM-CR01043.11] черный', 11999),
(34, 180, 4, 8, 3, 'Корпус AeroCool Aero One Frost [Aero One Frost-G-WT-v1] белый', 6999),
(35, 177, 3, 8, 4, 'Корпус MONTECH AIR 100 LITE белый', 5499),
(36, 11, 4, 8, 4, 'Корпус MSI MAG FORGE M100A [306-7G20A21-809] черный', 5299),
(37, 79, 2, 8, 3, 'Корпус Thermaltake Ceres 500 [CA-1X5-00M1WN-00] черный', 21599),
(38, 81, 2, 8, 3, 'Корпус Cougar Cratus [CGR-5LMSB] черный', 36799),
(39, 79, 4, 8, 8, 'Корпус Thermaltake The Tower 100 Snow [CA-1R3-00S6WN-00] белый', 10999),
(40, 178, 4, 10, 8, 'Корпус ZALMAN M2 mini [M2 mini Silver] серый', 12899),
(41, 9, 4, 8, 6, 'Корпус DEXP DC-Slim черный', 2950);

--
-- Триггеры `computer_case`
--
DELIMITER $$
CREATE TRIGGER `delete_computer_case` BEFORE DELETE ON `computer_case` FOR EACH ROW DELETE FROM product WHERE value_table = "computer_case" and value_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_computer_case` AFTER INSERT ON `computer_case` FOR EACH ROW INSERT INTO product VALUES (null, "computer_case", NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `form_factor`
--

CREATE TABLE `form_factor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `form_factor`
--

INSERT INTO `form_factor` (`id`, `name`) VALUES
(8, 'ATX'),
(1, 'E-ATX'),
(9, 'FlexATX'),
(3, 'Micro-ATX'),
(4, 'Mini-ITX'),
(10, 'SFX'),
(5, 'SSI-CEB'),
(6, 'SSI-EEB'),
(2, 'Standart-ATX'),
(11, 'TFX'),
(12, 'Thin Mini-ITX'),
(13, 'UCFF'),
(14, 'XL-ATX'),
(7, 'нестандартный');

-- --------------------------------------------------------

--
-- Структура таблицы `graphics_processor`
--

CREATE TABLE `graphics_processor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `graphics_processor`
--

INSERT INTO `graphics_processor` (`id`, `name`, `manufacturer`) VALUES
(1, 'GeForce RTX 4090', 1),
(2, 'GeForce RTX 4080 SUPER', 1),
(3, 'GeForce RTX 4080', 1),
(4, 'GeForce RTX 4070 Ti SUPER', 1),
(5, 'GeForce RTX 4070 Ti', 1),
(6, 'GeForce RTX 4070 SUPER', 1),
(7, 'GeForce RTX 4070', 1),
(8, 'GeForce RTX 4060 Ti', 1),
(9, 'GeForce RTX 4060', 1),
(10, 'GeForce RTX 3090', 1),
(11, 'GeForce RTX 3080 Ti', 1),
(12, 'GeForce RTX 3080', 1),
(13, 'GeForce RTX 3070 Ti', 1),
(14, 'GeForce RTX 3070', 1),
(15, 'GeForce RTX 3060 Ti', 1),
(16, 'GeForce RTX 3060', 1),
(17, 'GeForce RTX 3050', 1),
(18, 'GeForce RTX 2060 SUPER', 1),
(19, 'GeForce RTX 2060', 1),
(20, 'GeForce GTX 1660 Ti', 1),
(21, 'GeForce GTX 1660 SUPER', 1),
(22, 'GeForce GTX 1660', 1),
(23, 'GeForce GTX 1650', 1),
(24, 'GeForce GTX 1630', 1),
(25, 'GeForce GTX 1050 Ti', 1),
(26, 'GeForce GT 1030', 1),
(27, 'GeForce GTX 750 Ti', 1),
(28, 'GeForce GT 730', 1),
(29, 'GeForce GT 710', 1),
(30, 'GeForce 210', 1),
(31, 'GeForce GTX 1080 TI', 1),
(32, 'GeForce GTX 750', 1),
(33, 'Quadro RTX 4000', 1),
(34, 'Quadro M5000', 1),
(35, 'Tesla P4', 1),
(36, 'Tesla T4', 1),
(37, 'Tesla A2', 1),
(38, 'GeForce GTX 1650 SUPER', 1),
(40, 'GeForce RTX 2070 SUPER', 1),
(41, 'GeForce RTX 3090 Ti', 1),
(42, 'Quadro P1000', 1),
(43, 'Quadro RTX 5000 Ada', 1),
(44, 'RTX 2000 Ada Generation', 1),
(45, 'RTX A400', 1),
(46, 'RTX A1000', 1),
(47, 'RTX A2000', 1),
(48, 'RTX A4000', 1),
(49, 'RTX A4500', 1),
(50, 'RTX A5000', 1),
(51, 'T400', 1),
(52, 'T1000', 1),
(53, 'Titan RTX', 1),
(54, 'Radeon RX 7900 XTX', 2),
(55, 'Radeon RX 7900 XT', 2),
(56, 'Radeon RX 7900 GRE', 2),
(57, 'Radeon RX 7800 XT', 2),
(58, 'Radeon RX 7700 XT', 2),
(59, 'Radeon RX 7600 XT', 2),
(60, 'Radeon RX 7600', 2),
(61, 'Radeon RX 6900 XT', 2),
(62, 'Radeon RX 6800 XT', 2),
(63, 'Radeon RX 6800', 2),
(64, 'Radeon RX 6750 GRE', 2),
(65, 'Radeon RX 6750 XT', 2),
(66, 'Radeon RX 6700 XT', 2),
(67, 'Radeon RX 6650 XT', 2),
(68, 'Radeon RX 6600 XT', 2),
(69, 'Radeon RX 6600', 2),
(70, 'Radeon RX 6500 XT', 2),
(71, 'Radeon RX 6400', 2),
(72, 'Radeon RX 5700 XT', 2),
(73, 'Radeon RX 5600 XT', 2),
(74, 'Radeon RX 5500 XT', 2),
(75, 'Radeon RX 580', 2),
(76, 'Radeon RX 550', 2),
(77, 'Radeon RX 570', 2),
(78, 'Radeon R7 240', 2),
(79, 'Radeon 550', 2),
(80, 'Radeon RX 6950 XT', 2),
(81, 'Arc A770', 3),
(82, 'Arc A750', 3),
(83, 'Arc A580', 3),
(84, 'Arc A380', 3),
(85, 'Arc A310', 3),
(86, 'С420', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `list_order`
--

CREATE TABLE `list_order` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL COMMENT 'пользователь',
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `list_order`
--

INSERT INTO `list_order` (`id`, `user`, `date_create`) VALUES
(1, 13, '2024-12-07 19:42:34'),
(2, 13, '2024-12-07 19:44:12'),
(3, 13, '2024-12-07 19:44:42'),
(4, 13, '2024-12-07 19:46:03'),
(5, 13, '2024-12-07 19:46:16'),
(6, 10, '2024-12-07 19:51:47'),
(7, 10, '2024-12-07 19:55:37'),
(8, 10, '2024-12-16 20:26:46'),
(9, 14, '2024-12-18 07:00:51');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`) VALUES
(179, '1STPLAYER'),
(24, 'Acer'),
(54, 'ADATA'),
(180, 'AeroCool'),
(12, 'AFOX'),
(55, 'AGI'),
(2, 'AMD'),
(56, 'AMD Radeon'),
(17, 'Apacer'),
(188, 'APNX'),
(5, 'ARDOR GAMING'),
(6, 'Asrock'),
(7, 'ASUS'),
(181, 'be quiet!'),
(13, 'Biostar'),
(182, 'Chieftec'),
(8, 'ColorFul'),
(183, 'CoolerMaster'),
(57, 'Corsair'),
(81, 'Cougar'),
(58, 'Crucial'),
(59, 'Crucial Ballistix'),
(60, 'Dahua'),
(82, 'DEEPCOOL'),
(9, 'DEXP'),
(14, 'Elitegroup'),
(15, 'Esonic'),
(61, 'ExeGate'),
(62, 'Foxline'),
(18, 'G.Skill'),
(184, 'GameMax'),
(194, 'GeForce'),
(63, 'GeIL'),
(64, 'Goodram'),
(10, 'GYGABYTE'),
(65, 'Hikvision'),
(66, 'HP'),
(67, 'Hynix'),
(68, 'HyperX'),
(3, 'Intel'),
(185, 'JONSBO'),
(190, 'KFA2'),
(19, 'Kingston'),
(20, 'Kingston FURY'),
(176, 'Lian Li'),
(4, 'Matrox'),
(16, 'MaxSun'),
(69, 'Micron'),
(177, 'Montech'),
(11, 'MSI'),
(70, 'Neo Forza'),
(71, 'Netac'),
(1, 'NVIDIA'),
(72, 'OCPC Gaming'),
(191, 'Palit'),
(21, 'Patriot Memory'),
(186, 'PCCooler'),
(73, 'PNY'),
(187, 'PowerCase'),
(193, 'PowerColor'),
(74, 'Predator'),
(75, 'QUMO'),
(76, 'Samsung'),
(192, 'Sapphire'),
(77, 'Silicon Power'),
(78, 'Smartbuy'),
(22, 'Team Group'),
(79, 'Thermaltake'),
(80, 'Transcend'),
(23, 'XPG (ADATA)'),
(178, 'ZALMAN');

-- --------------------------------------------------------

--
-- Структура таблицы `memory`
--

CREATE TABLE `memory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `memory`
--

INSERT INTO `memory` (`id`, `name`) VALUES
(1, 'DDR2'),
(2, 'DDR3'),
(3, 'DDR3L'),
(4, 'DDR4'),
(5, 'DDR5'),
(10, 'GDDR3'),
(9, 'GDDR5'),
(8, 'GDDR5X'),
(7, 'GDDR6'),
(6, 'GDDR6X');

-- --------------------------------------------------------

--
-- Структура таблицы `motherboard`
--

CREATE TABLE `motherboard` (
  `id` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL COMMENT 'производитель (ASUS, GIGABYTE etc)',
  `socket` int(11) DEFAULT NULL COMMENT 'сокет',
  `memory_type` int(11) DEFAULT NULL COMMENT 'тип поддерживаемой памяти',
  `form_factor` int(11) DEFAULT NULL COMMENT 'форм-фактор',
  `memory_slots` int(11) NOT NULL COMMENT 'Количество слотов памяти',
  `m2_slots` int(11) NOT NULL COMMENT 'Количество разъемов M.2',
  `name` varchar(255) NOT NULL COMMENT 'полное наименование',
  `price` int(11) NOT NULL COMMENT 'цена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `motherboard`
--

INSERT INTO `motherboard` (`id`, `manufacturer`, `socket`, `memory_type`, `form_factor`, `memory_slots`, `m2_slots`, `name`, `price`) VALUES
(1, 11, 5, 4, 3, 2, 1, 'Материнская плата MSI PRO H610M-E DDR4', 7499),
(2, 11, 4, 4, 2, 4, 2, 'Материнская плата MSI MPG B550 GAMING PLUS', 13999),
(3, 10, 4, 4, 3, 4, 2, 'Материнская плата GIGABYTE B550M K', 9499),
(4, 6, 3, 5, 3, 4, 3, 'Материнская плата ASRock B650M Pro RS', 15299),
(5, 10, 4, 4, 3, 4, 2, 'Материнская плата GIGABYTE B550M AORUS ELITE', 12499),
(6, 11, 5, 5, 2, 4, 4, 'Материнская плата MSI PRO Z790-P WIFI', 22999),
(7, 10, 4, 2, 2, 4, 2, 'Материнская плата GIGABYTE B550 AORUS ELITE V2', 16999),
(8, 11, 5, 5, 2, 4, 4, 'Материнская плата MSI PRO Z790-A WIFI', 24999),
(9, 11, 3, 5, 3, 2, 1, 'Материнская плата MSI PRO B650M-B', 9999),
(10, 10, 6, 4, 3, 4, 1, 'Материнская плата GIGABYTE B560M DS3H V3', 9199),
(12, 1, 9, 1, 1, 100, 2, 'test name', 54443);

--
-- Триггеры `motherboard`
--
DELIMITER $$
CREATE TRIGGER `delete_motherboard` BEFORE DELETE ON `motherboard` FOR EACH ROW DELETE FROM product WHERE value_table = "motherboard" and value_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_motherboard` AFTER INSERT ON `motherboard` FOR EACH ROW INSERT INTO product VALUES (null, "motherboard", NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `order_info`
--

CREATE TABLE `order_info` (
  `code` int(11) NOT NULL COMMENT 'id заказа из list_order',
  `product` int(11) NOT NULL COMMENT 'товар',
  `count` int(11) NOT NULL COMMENT 'количество'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_info`
--

INSERT INTO `order_info` (`code`, `product`, `count`) VALUES
(6, 58, 3),
(6, 68, 1),
(7, 58, 3),
(7, 68, 1),
(8, 28, 1),
(8, 38, 1),
(8, 58, 1),
(8, 68, 1),
(9, 68, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `power_supply`
--

CREATE TABLE `power_supply` (
  `id` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL COMMENT 'Производитель',
  `power` int(11) NOT NULL COMMENT 'Мощность (номинал) (Вт)',
  `plus80` int(11) DEFAULT NULL COMMENT 'Сертификат 80 PLUS',
  `form_factor` int(11) DEFAULT NULL COMMENT 'Форм-фактор',
  `name` varchar(255) NOT NULL COMMENT 'полное наименование',
  `price` int(11) NOT NULL COMMENT 'цена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `power_supply`
--

INSERT INTO `power_supply` (`id`, `manufacturer`, `power`, `plus80`, `form_factor`, `name`, `price`) VALUES
(1, 82, 750, 5, 8, 'Блок питания DEEPCOOL PF750 [R-PF750D-HA0B-EU] черный', 5599),
(2, 82, 1000, 2, 8, 'Блок питания DEEPCOOL PX1000G черный', 17999),
(3, 82, 650, 1, 8, 'Блок питания DEEPCOOL PK650D [R-PK650D-FA0B-EU] черный', 6199),
(4, 81, 850, 2, 8, 'Блок питания Cougar GEX850 [31GE085001P01] черный', 10199),
(5, 11, 650, 1, 8, 'Блок питания MSI MAG A650BN [306-7ZP2B19-CE0] черный', 5599),
(6, 177, 850, 2, 8, 'Блок питания MONTECH TITAN GOLD 850 [TIS0124] черный', 14799),
(7, 81, 600, 5, 8, 'Блок питания Cougar STC 600 [CGR SC-600] черный', 3999),
(8, 177, 750, 2, 8, 'Блок питания MONTECH GAMMA II 750 [GAMMA II 750] черный', 8499),
(9, 11, 850, 2, 8, 'Блок питания MSI MPG A850G PCIE5 [306-7ZP7B11-CE0] черный', 16299),
(10, 180, 500, 7, 8, 'Блок питания AeroCool VX PLUS 500W [VX-500 PLUS] черный', 3599);

--
-- Триггеры `power_supply`
--
DELIMITER $$
CREATE TRIGGER `delete_power_supply` BEFORE DELETE ON `power_supply` FOR EACH ROW DELETE FROM product WHERE value_table = "power_supply" and value_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_power_supply` AFTER INSERT ON `power_supply` FOR EACH ROW INSERT INTO product VALUES (null, "power_supply", NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `processor`
--

CREATE TABLE `processor` (
  `id` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL COMMENT 'производитель (AMD, Intel)',
  `socket` int(11) DEFAULT NULL COMMENT 'сокет (LGA 1700, AM5 и тд.)',
  `count_productive_cores` int(11) NOT NULL COMMENT 'количество производительных ядер (2, 4, 6 и тд.)',
  `memory_type` int(11) DEFAULT NULL COMMENT 'Тип памяти (DDR4, DDR3 и тд.)',
  `model` varchar(255) NOT NULL COMMENT 'Полное название модели (Intel Core i5-12400F, AMD Ryzen 9 3900XT и тд.)',
  `base_frequency` float NOT NULL COMMENT 'Базовая частота процессора (ГГц)',
  `thermal_design_power` int(11) NOT NULL COMMENT 'Тепловыделение (Вт)',
  `price` int(11) NOT NULL COMMENT 'Цена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `processor`
--

INSERT INTO `processor` (`id`, `manufacturer`, `socket`, `count_productive_cores`, `memory_type`, `model`, `base_frequency`, `thermal_design_power`, `price`) VALUES
(2, 2, 3, 6, 5, 'AMD Ryzen 5 7500F', 3.7, 65, 17699),
(3, 2, 4, 6, 4, 'AMD Ryzen 5 5600', 3.5, 65, 9999),
(4, 2, 3, 8, 5, 'AMD Ryzen 7 7700', 3.8, 65, 27299),
(5, 3, 5, 6, 5, 'Intel Core i5-12400', 2.5, 117, 15199),
(6, 3, 5, 4, 5, 'Intel Core i3-12100', 3.3, 89, 10999),
(7, 2, 4, 6, 4, 'AMD Ryzen 5 5600X', 3.7, 65, 12499),
(8, 2, 4, 8, 4, 'AMD Ryzen 7 5700X3D', 3, 105, 20799),
(9, 2, 3, 16, 5, 'AMD Ryzen 9 7950X3D', 4.2, 120, 72999),
(10, 3, 6, 4, 4, 'Intel Core i3-10105', 3.7, 65, 10599);

--
-- Триггеры `processor`
--
DELIMITER $$
CREATE TRIGGER `delete_processor` BEFORE DELETE ON `processor` FOR EACH ROW DELETE FROM product WHERE value_table = "processor" and value_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_processor` AFTER INSERT ON `processor` FOR EACH ROW INSERT INTO product VALUES (null, "processor", NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `processor_socket`
--

CREATE TABLE `processor_socket` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `processor_socket`
--

INSERT INTO `processor_socket` (`id`, `name`) VALUES
(9, 'AM3+'),
(4, 'AM4'),
(3, 'AM5'),
(13, 'FM2+'),
(8, 'LGA 1151'),
(7, 'LGA 1151-v2'),
(6, 'LGA 1200'),
(5, 'LGA 1700'),
(12, 'LGA 2066'),
(10, 'sWRX8'),
(11, 'TR4');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `value_table` varchar(255) NOT NULL,
  `value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `value_table`, `value_id`) VALUES
(2, 'computer_case', 1),
(3, 'computer_case', 2),
(5, 'computer_case', 5),
(6, 'computer_case', 6),
(7, 'computer_case', 7),
(8, 'computer_case', 8),
(9, 'computer_case', 9),
(17, 'computer_case', 31),
(18, 'computer_case', 32),
(19, 'computer_case', 33),
(20, 'computer_case', 34),
(21, 'computer_case', 35),
(22, 'computer_case', 36),
(23, 'computer_case', 37),
(24, 'computer_case', 38),
(25, 'computer_case', 39),
(26, 'computer_case', 40),
(27, 'computer_case', 41),
(28, 'motherboard', 1),
(29, 'motherboard', 2),
(30, 'motherboard', 3),
(31, 'motherboard', 4),
(32, 'motherboard', 5),
(33, 'motherboard', 6),
(34, 'motherboard', 7),
(35, 'motherboard', 8),
(36, 'motherboard', 9),
(37, 'motherboard', 10),
(38, 'power_supply', 1),
(39, 'power_supply', 2),
(40, 'power_supply', 3),
(41, 'power_supply', 4),
(42, 'power_supply', 5),
(43, 'power_supply', 6),
(44, 'power_supply', 7),
(45, 'power_supply', 8),
(46, 'power_supply', 9),
(47, 'power_supply', 10),
(49, 'processor', 2),
(50, 'processor', 3),
(51, 'processor', 4),
(52, 'processor', 5),
(53, 'processor', 6),
(54, 'processor', 7),
(55, 'processor', 8),
(56, 'processor', 9),
(57, 'processor', 10),
(58, 'video_card', 1),
(59, 'video_card', 2),
(60, 'video_card', 3),
(61, 'video_card', 4),
(62, 'video_card', 5),
(63, 'video_card', 6),
(64, 'video_card', 7),
(65, 'video_card', 8),
(66, 'video_card', 9),
(67, 'video_card', 10),
(68, 'ram', 1),
(72, 'ram', 11),
(73, 'ram', 12),
(74, 'ram', 13),
(75, 'ram', 14),
(76, 'ram', 15),
(77, 'ram', 16),
(78, 'ram', 17),
(79, 'ram', 18),
(80, 'ram', 19),
(82, 'motherboard', 12),
(83, 'ram', 20);

-- --------------------------------------------------------

--
-- Структура таблицы `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL COMMENT 'производитель',
  `memory_type` int(11) DEFAULT NULL COMMENT 'тип памяти',
  `memory_capacity` int(11) NOT NULL COMMENT 'Общий объем памяти (ГБ)',
  `frequency` int(11) NOT NULL COMMENT 'Тактовая частота (МГц)',
  `number_modules` int(11) NOT NULL COMMENT 'Количество модулей в комплекте (шт)',
  `name` varchar(255) NOT NULL COMMENT 'полное наименование',
  `price` int(11) NOT NULL COMMENT 'цена комплекта'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `ram`
--

INSERT INTO `ram` (`id`, `manufacturer`, `memory_type`, `memory_capacity`, `frequency`, `number_modules`, `name`, `price`) VALUES
(1, 20, 4, 16, 3200, 2, 'Kingston FURY Beast Black', 4199),
(11, 20, 4, 32, 3200, 2, 'Kingston FURY Beast Black [KF432C16BBK2/32] 32 ГБ', 7999),
(12, 54, 5, 32, 6000, 2, 'ADATA XPG Lancer Blade [AX5U6000C3016G-DTLABBK] 32 ГБ', 12999),
(13, 18, 4, 16, 3200, 2, 'G.Skill Aegis [F4-3200C16D-16GIS] 16 ГБ', 3499),
(14, 20, 5, 64, 5600, 2, 'Kingston FURY Beast Black [KF556C40BBK2-64] 64 ГБ', 24199),
(15, 20, 5, 128, 4800, 4, 'Kingston FURY Renegade Pro [KF548R36RBK4-128] 128 ГБ', 86299),
(16, 76, 4, 128, 3200, 1, 'Samsung [M386AAG40AM3-CWE] 128 ГБ', 61999),
(17, 9, 2, 4, 1600, 1, 'DEXP [DEXP4GD3UD16] 4 ГБ', 799),
(18, 17, 2, 4, 1600, 1, 'Apacer [DL.04G2K.KAM] 4 ГБ', 850),
(19, 61, 4, 8, 2400, 1, 'ExeGate HiPower [EX288049RUS] 8 ГБ', 1450),
(20, 20, 4, 16, 3200, 2, 'clay', 4199);

--
-- Триггеры `ram`
--
DELIMITER $$
CREATE TRIGGER `delete_ram` BEFORE DELETE ON `ram` FOR EACH ROW DELETE FROM product WHERE value_table = "ram" and value_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_ram` AFTER INSERT ON `ram` FOR EACH ROW INSERT INTO product VALUES (null, "ram", NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT 'логин',
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'почта',
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `phone`, `email`, `password`, `profileImage`, `token`, `admin`) VALUES
(10, '432', 'erfd', '+799999999999999', 'newemail@mail.ru', '$2y$13$679nv8IVZ9g723SwWBID0.OBuDO9FlcwH3delgKTp3lBI0Cv3j6UO', '345643', 'gUbROwqU46jleUW3Bwc8TBNEflxAZ0Ne', 0),
(11, '123', '34543t', '436345345', 'email@mail.ru', '$2y$13$14zbSzinI69D4HAZ9lNhG.1HlfZuSR/Vge/wzGCVEL9hNsqRkwmbC', NULL, 'vLIJyHy3hE2BEMIipYsr6_tRfTHU0EH5', 0),
(12, '1234', '431534', '34643346', 'yemail@mail.ru', '$2y$13$G4y6S13/R4WXgRluC5Xlk.4prx8AccQUeeuZxIutGaF8CtqyXy3Bi', NULL, 'ypSOxQvd5hW69gF8Ec-F7N9NvuuW2vgX', 0),
(13, 'Arabika', 'Aka', '01234567891', 'email3@mail.ru', '$2y$13$0DAzaUNJWcCrfpongoSlK.ykAgEdQcByqPZzrba78Ku60gX0g9Ie6', 'uploads/волк сбоку.jpg', '5NVhoQgdk_2Xl5cVRbQ6I9c5DJT2iz2l', 1),
(14, 'suhary', 'Пользователь', '+79999999999', 'suharik@mail.ru', '$2y$13$y6V2qFj4GR77nTsCs7A4WufI2vR9BHw2UNxKRoDmXm3PyEweZYShS', NULL, 'hl3fGvVkAvu5UXqI0X1_L_yHkhPnfLCs', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `video_card`
--

CREATE TABLE `video_card` (
  `id` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL COMMENT 'производитель',
  `graphics_processor` int(11) DEFAULT NULL COMMENT 'Графический процессор',
  `memory_capacity` int(11) NOT NULL COMMENT 'Объем видеопамяти (ГБ)',
  `count_fans` int(11) NOT NULL COMMENT 'количество установленных вентиляторов',
  `memory_type` int(11) DEFAULT NULL COMMENT 'Тип памяти',
  `video_outputs` int(11) NOT NULL COMMENT 'Количество видеовыходов',
  `name` varchar(255) NOT NULL COMMENT 'полное наименование',
  `price` int(11) NOT NULL COMMENT 'цена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `video_card`
--

INSERT INTO `video_card` (`id`, `manufacturer`, `graphics_processor`, `memory_capacity`, `count_fans`, `memory_type`, `video_outputs`, `name`, `price`) VALUES
(1, 11, 9, 8, 2, 7, 4, 'MSI GeForce RTX 4060 VENTUS 2X BLACK OC', 40999),
(2, 11, 23, 4, 2, 7, 3, 'MSI GeForce GTX 1650 D6 VENTUS XS OCV3', 17999),
(3, 191, 4, 16, 3, 6, 4, 'Palit GeForce RTX 4070 Ti SUPER JetStream OC', 104999),
(4, 11, 17, 8, 2, 7, 3, 'MSI Geforce RTX 3050 VENTUS 2X XS WHITE OC', 25499),
(5, 193, 69, 8, 2, 7, 4, 'PowerColor AMD Radeon RX 6600 Fighter', 25999),
(6, 192, 57, 16, 2, 7, 4, 'Sapphire AMD Radeon RX 7800 XT PULSE', 64999),
(7, 6, 69, 8, 2, 7, 4, 'ASRock AMD Radeon RX 6600 Challenger D', 27499),
(8, 192, 79, 4, 1, 9, 3, 'Sapphire AMD Radeon RX 550 PULSE OC', 8999),
(9, 6, 83, 8, 2, 7, 4, 'ASRock Intel Arc A580 Challenger OC', 22599),
(10, 6, 84, 6, 1, 7, 4, 'ASRock Intel Arc A380 Challenger ITX OC', 13999);

--
-- Триггеры `video_card`
--
DELIMITER $$
CREATE TRIGGER `delete_video_card` BEFORE DELETE ON `video_card` FOR EACH ROW DELETE FROM product WHERE value_table = "video_card" and value_id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_video_card` AFTER INSERT ON `video_card` FOR EACH ROW INSERT INTO product VALUES (null, "video_card", NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `whish_list`
--

CREATE TABLE `whish_list` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `whish_list`
--

INSERT INTO `whish_list` (`id`, `user`, `product`) VALUES
(12, 14, 58),
(11, 14, 68);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `80plus_certificate`
--
ALTER TABLE `80plus_certificate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`,`product`),
  ADD KEY `product` (`product`);

--
-- Индексы таблицы `case_size`
--
ALTER TABLE `case_size`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `computer_case`
--
ALTER TABLE `computer_case`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`,`motherboard_form_factor`,`power_supply_form_factor`,`case_size`),
  ADD KEY `computer_case_ibfk_1` (`case_size`),
  ADD KEY `motherboard_form_factor` (`motherboard_form_factor`),
  ADD KEY `power_supply_form_factor` (`power_supply_form_factor`);

--
-- Индексы таблицы `form_factor`
--
ALTER TABLE `form_factor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `graphics_processor`
--
ALTER TABLE `graphics_processor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `manufacturer` (`manufacturer`);

--
-- Индексы таблицы `list_order`
--
ALTER TABLE `list_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `memory`
--
ALTER TABLE `memory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `motherboard`
--
ALTER TABLE `motherboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`,`socket`,`memory_type`,`form_factor`),
  ADD KEY `memory_type` (`memory_type`),
  ADD KEY `form_factor` (`form_factor`),
  ADD KEY `motherboard_ibfk_4` (`socket`);

--
-- Индексы таблицы `order_info`
--
ALTER TABLE `order_info`
  ADD KEY `code` (`code`),
  ADD KEY `product` (`product`);

--
-- Индексы таблицы `power_supply`
--
ALTER TABLE `power_supply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`,`plus80`,`form_factor`),
  ADD KEY `80plus` (`plus80`),
  ADD KEY `form_factor` (`form_factor`);

--
-- Индексы таблицы `processor`
--
ALTER TABLE `processor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`,`socket`,`memory_type`),
  ADD KEY `memory_type` (`memory_type`),
  ADD KEY `socket` (`socket`);

--
-- Индексы таблицы `processor_socket`
--
ALTER TABLE `processor_socket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`,`memory_type`),
  ADD KEY `memory_type` (`memory_type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Индексы таблицы `video_card`
--
ALTER TABLE `video_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer` (`manufacturer`,`graphics_processor`,`memory_type`),
  ADD KEY `graphics_processor` (`graphics_processor`),
  ADD KEY `memory_type` (`memory_type`);

--
-- Индексы таблицы `whish_list`
--
ALTER TABLE `whish_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`,`product`),
  ADD KEY `product` (`product`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `80plus_certificate`
--
ALTER TABLE `80plus_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `case_size`
--
ALTER TABLE `case_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `computer_case`
--
ALTER TABLE `computer_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `form_factor`
--
ALTER TABLE `form_factor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `graphics_processor`
--
ALTER TABLE `graphics_processor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `list_order`
--
ALTER TABLE `list_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT для таблицы `memory`
--
ALTER TABLE `memory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `motherboard`
--
ALTER TABLE `motherboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `power_supply`
--
ALTER TABLE `power_supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `processor`
--
ALTER TABLE `processor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `processor_socket`
--
ALTER TABLE `processor_socket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT для таблицы `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `video_card`
--
ALTER TABLE `video_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `whish_list`
--
ALTER TABLE `whish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `computer_case`
--
ALTER TABLE `computer_case`
  ADD CONSTRAINT `computer_case_ibfk_1` FOREIGN KEY (`case_size`) REFERENCES `case_size` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `computer_case_ibfk_2` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `computer_case_ibfk_3` FOREIGN KEY (`motherboard_form_factor`) REFERENCES `form_factor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `computer_case_ibfk_4` FOREIGN KEY (`power_supply_form_factor`) REFERENCES `form_factor` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `graphics_processor`
--
ALTER TABLE `graphics_processor`
  ADD CONSTRAINT `graphics_processor_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `list_order`
--
ALTER TABLE `list_order`
  ADD CONSTRAINT `list_order_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `motherboard`
--
ALTER TABLE `motherboard`
  ADD CONSTRAINT `motherboard_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `motherboard_ibfk_2` FOREIGN KEY (`memory_type`) REFERENCES `memory` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `motherboard_ibfk_3` FOREIGN KEY (`form_factor`) REFERENCES `form_factor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `motherboard_ibfk_4` FOREIGN KEY (`socket`) REFERENCES `processor_socket` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `order_info_ibfk_1` FOREIGN KEY (`code`) REFERENCES `list_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_info_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `power_supply`
--
ALTER TABLE `power_supply`
  ADD CONSTRAINT `power_supply_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `power_supply_ibfk_2` FOREIGN KEY (`plus80`) REFERENCES `80plus_certificate` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `power_supply_ibfk_3` FOREIGN KEY (`form_factor`) REFERENCES `form_factor` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `processor`
--
ALTER TABLE `processor`
  ADD CONSTRAINT `processor_ibfk_3` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `processor_ibfk_4` FOREIGN KEY (`memory_type`) REFERENCES `memory` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `processor_ibfk_5` FOREIGN KEY (`socket`) REFERENCES `processor_socket` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `ram`
--
ALTER TABLE `ram`
  ADD CONSTRAINT `ram_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ram_ibfk_2` FOREIGN KEY (`memory_type`) REFERENCES `memory` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `video_card`
--
ALTER TABLE `video_card`
  ADD CONSTRAINT `video_card_ibfk_1` FOREIGN KEY (`graphics_processor`) REFERENCES `graphics_processor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `video_card_ibfk_2` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `video_card_ibfk_3` FOREIGN KEY (`memory_type`) REFERENCES `memory` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `whish_list`
--
ALTER TABLE `whish_list`
  ADD CONSTRAINT `whish_list_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `whish_list_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
