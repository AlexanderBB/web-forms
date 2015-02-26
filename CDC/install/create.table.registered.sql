-- phpMyAdmin SQL Dump
-- version 4.0.10.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Time of creation: 26 Feb 2015 в 14:18
-- Mysql version: 5.1.73
-- PHP version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET YOUR TIME ZONE
SET time_zone = "+00:00";

--
-- DB: `db_test`
--

-- --------------------------------------------------------

--
-- Structure of table `registered`
--

CREATE TABLE IF NOT EXISTS `registered` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `sirname` varchar(35) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(64) NOT NULL,
  `university` varchar(150) NOT NULL,
  `specialty` varchar(150) NOT NULL,
  `current_year` varchar(10) NOT NULL,
  `question_field` varchar(1000) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
