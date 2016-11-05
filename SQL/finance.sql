-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2016 at 10:40 PM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `cis_kategorie`
--

CREATE TABLE `cis_kategorie` (
  `id_kat` int(11) NOT NULL,
  `kategorie` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `cis_kategorie`
--

INSERT INTO `cis_kategorie` (`id_kat`, `kategorie`) VALUES
(81, 'Příjmy - dary'),
(72, 'Příjmy - desátky'),
(73, 'Výdaje - evangelizace'),
(74, 'Výdaje - mládež'),
(75, 'Výdaje - nedělka'),
(82, 'Výdaje - provoz'),
(76, 'Výdaje - služebníci');

-- --------------------------------------------------------

--
-- Table structure for table `cis_skupiny`
--

CREATE TABLE `cis_skupiny` (
  `id_skup` int(11) NOT NULL,
  `skupina` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `limit_skup` decimal(11,0) NOT NULL,
  `popis` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `cis_skupiny`
--

INSERT INTO `cis_skupiny` (`id_skup`, `skupina`, `limit_skup`, `popis`) VALUES
(0, 'Příjmy / Prázdná obálka', '0', 'Nemazat - Úvodní obálka nové kategorie nebo příjmy'),
(2, 'Výdaje vnitřní', '20000', 'Provoz sboru'),
(3, 'Výdaje vnější', '10000', 'Všechno čím sloužíme mimo sbor'),
(4, 'testovací', '1000', 'Popis obálky');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `kategorie_skupiny`
--

CREATE TABLE `kategorie_skupiny` (
  `id_kat` int(11) NOT NULL,
  `id_skup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `kategorie_skupiny`
--

INSERT INTO `kategorie_skupiny` (`id_kat`, `id_skup`) VALUES
(72, 0),
(73, 3),
(74, 2),
(75, 2),
(76, 3),
(100, 0),
(81, 0),
(82, 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `polozky`
--

CREATE TABLE `polozky` (
  `id_pol` bigint(20) NOT NULL,
  `polozka` decimal(11,2) NOT NULL,
  `datum_vl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_vz` date NOT NULL,
  `id_kat` bigint(20) NOT NULL,
  `popis` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `polozky`
--

INSERT INTO `polozky` (`id_pol`, `polozka`, `datum_vl`, `datum_vz`, `id_kat`, `popis`) VALUES
(21, '10000.00', '2016-09-26 22:52:54', '2016-09-04', 72, 'Sbírka na shromku'),
(22, '-1000.00', '2016-09-26 22:53:25', '2016-09-27', 73, 'letáčky'),
(23, '-1000.00', '2016-09-26 22:53:44', '2016-09-02', 74, 'Materiály na tvoření'),
(24, '-250.00', '2016-09-26 22:54:01', '2016-09-27', 75, 'Pastelky'),
(25, '-500.00', '2016-09-26 22:54:22', '2016-09-27', 76, 'Doprava'),
(26, '-100.00', '2016-10-04 19:38:47', '2016-10-28', 76, 'Popis operace'),
(27, '-5000.00', '2016-10-04 20:20:48', '2016-10-04', 75, 'Popis operace'),
(28, '-1000.00', '2016-10-04 20:31:43', '2016-10-04', 73, 'Popis operace'),
(29, '2000.00', '2016-10-04 21:42:03', '2016-10-04', 81, 'Popis operace'),
(30, '-15000.00', '2016-10-08 08:07:19', '2016-10-08', 82, 'Nájem '),
(51, '20.00', '2016-10-10 13:42:36', '2000-01-01', 5, 'nic'),
(52, '20.00', '2016-10-10 13:42:48', '2000-01-01', 5, 'nic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$woTY/87yQiIy8h8ZzQiCdu3YPs37q5ALxnsi2MCbe0Q.tC9/3iq8a', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1476227803, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '127.0.0.1', NULL, '$2y$08$REXkRCpgQNAJzI1MbthryupR62V4SaGNq2tvjQgXS9LFlIIpSEonm', NULL, 'test@test.cz', NULL, NULL, NULL, NULL, 1475915056, NULL, 1, 'test', 'test2', 'dddddd', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(8, 1, 1),
(9, 1, 2),
(5, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cis_kategorie`
--
ALTER TABLE `cis_kategorie`
  ADD PRIMARY KEY (`id_kat`),
  ADD UNIQUE KEY `kategorie` (`kategorie`);

--
-- Indexes for table `cis_skupiny`
--
ALTER TABLE `cis_skupiny`
  ADD PRIMARY KEY (`id_skup`),
  ADD UNIQUE KEY `skupina` (`skupina`),
  ADD UNIQUE KEY `skupina_2` (`skupina`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polozky`
--
ALTER TABLE `polozky`
  ADD PRIMARY KEY (`id_pol`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cis_kategorie`
--
ALTER TABLE `cis_kategorie`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `cis_skupiny`
--
ALTER TABLE `cis_skupiny`
  MODIFY `id_skup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `polozky`
--
ALTER TABLE `polozky`
  MODIFY `id_pol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
