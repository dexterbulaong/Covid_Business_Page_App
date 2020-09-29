DROP DATABASE IF EXISTS `covid_project`;
CREATE DATABASE `covid_project`; 
USE `covid_project`;

CREATE TABLE `businesses` (
	`business_id` int(11) NOT NULL,
	`business_name` varchar(50) NOT NULL,
    `business_address` varchar(50) NOT NULL,
    `business_hours` varchar(50) NOT NULL,
    `business_type` varchar(50) NOT NULL,
    `business_link` varchar(50) NOT NULL,
    `entry_date` date NOT NULL,
    `last_updated` date NOT NULL,
    PRIMARY KEY (`business_id`)
    );