-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2016 at 04:39 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_idemitsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_team_detail`
--

CREATE TABLE `t_team_detail` (
  `TEAM_ID` int(11) NOT NULL,
  `DETAIL_ID` int(11) NOT NULL,
  `MEMBER_FIRST_NAME` varchar(200) DEFAULT NULL,
  `MEMBER_LAST_NAME` varchar(200) DEFAULT NULL,
  `MEMBER_ID` varchar(50) DEFAULT NULL,
  `CREATE_DATE` date NOT NULL,
  `CREATE_BY` varchar(100) NOT NULL,
  `LAST_UPDATE_DATE` date DEFAULT NULL,
  `LAST_UPDATE_BY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_team_header`
--

CREATE TABLE `t_team_header` (
  `TEAM_ID` bigint(20) UNSIGNED NOT NULL,
  `TEAM_NAME` varchar(200) NOT NULL,
  `INSTITUTE_NAME` varchar(400) NOT NULL,
  `INSTITUTE_TYPE` varchar(100) NOT NULL,
  `LEADER_FIRST_NAME` varchar(200) NOT NULL,
  `LEADER_LAST_NAME` varchar(200) NOT NULL,
  `LEADER_ID` varchar(50) NOT NULL,
  `LEADER_EMAIL` varchar(100) NOT NULL,
  `TELEPHONE` varchar(50) NOT NULL,
  `ADVISOR_NAME` varchar(500) DEFAULT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `CREATE_DATE` date NOT NULL,
  `CREATE_BY` varchar(100) NOT NULL,
  `LAST_UPDATE_DATE` date DEFAULT NULL,
  `LAST_UPDATE_BY` varchar(100) DEFAULT NULL,
  `LINK` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `USER_ID` bigint(20) UNSIGNED NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `USER_PASSWORD` varchar(500) NOT NULL,
  `CREATE_DATE` date NOT NULL,
  `CREATE_BY` varchar(100) NOT NULL,
  `LAST_UPDATE_DATE` date DEFAULT NULL,
  `LAST_UPDATE_BY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_team_detail`
--
ALTER TABLE `t_team_detail`
  ADD UNIQUE KEY `TEAM_DETAIL_ID` (`TEAM_ID`,`DETAIL_ID`) USING BTREE;

--
-- Indexes for table `t_team_header`
--
ALTER TABLE `t_team_header`
  ADD PRIMARY KEY (`TEAM_ID`),
  ADD UNIQUE KEY `TEAM_ID` (`TEAM_ID`),
  ADD UNIQUE KEY `TEAM_UNIDX` (`TEAM_NAME`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`USER_ID`) USING BTREE,
  ADD UNIQUE KEY `USER_UNIDX` (`USER_NAME`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_team_header`
--
ALTER TABLE `t_team_header`
  MODIFY `TEAM_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `USER_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

COMMIT;