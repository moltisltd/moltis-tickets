alter table `event` add `location_id` int not null;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `location` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'Name',
  `address` text COLLATE latin1_general_ci NOT NULL COMMENT 'Address',
  `postcode` varchar(10) COLLATE latin1_general_ci NOT NULL COMMENT 'Postcode',
  `country` varchar(2) COLLATE latin1_general_ci NOT NULL COMMENT 'Country Code'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `location` (`id`, `name`, `address`, `postcode`, `country`) VALUES
(1, 'Douglaswood Scout Centre', 'Dundee', 'DD5 3QH', 'UK'),
(2, 'Consall Scout Camp', 'Blakely Lane\r\nDilhorne\r\nStoke-on-Trent', 'ST10 2PS', 'UK');


ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);


ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;