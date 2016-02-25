SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `cart` (
  `id` int(11) NOT NULL COMMENT 'Cart ID',
  `customer_id` int(11) NOT NULL COMMENT 'Customer User ID',
  `session_id` varchar(100) NOT NULL COMMENT 'Session ID',
  `created` datetime NOT NULL COMMENT 'Time created',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Time last updated',
  `status` tinyint(4) NOT NULL COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cart_items` (
  `cart_id` int(11) NOT NULL COMMENT 'Cart ID',
  `ticket_id` int(11) NOT NULL COMMENT 'Ticket ID',
  `quantity` int(11) NOT NULL COMMENT 'Quantity'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `event` (
  `id` int(11) NOT NULL COMMENT 'Event ID',
  `owner_id` int(11) NOT NULL COMMENT 'Owner Organisation ID',
  `name` varchar(255) NOT NULL COMMENT 'Event Name',
  `slug` varchar(100) NOT NULL COMMENT 'Event URL Slug',
  `start_time` datetime NOT NULL COMMENT 'Start time',
  `end_time` datetime NOT NULL COMMENT 'End time',
  `description` mediumtext NOT NULL COMMENT 'Description',
  `summary` varchar(500) NOT NULL COMMENT 'Summary'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `event` (`id`, `owner_id`, `name`, `slug`, `start_time`, `end_time`, `description`, `summary`) VALUES
(1, 1, 'Dark Dreams', 'dark-dreams', '2015-05-13 19:00:00', '2015-05-15 14:00:00', 'Dark Dreams', 'Dark Dreams');

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL COMMENT 'Organisation ID',
  `name` varchar(100) NOT NULL COMMENT 'Organisation Name',
  `url` varchar(255) NOT NULL COMMENT 'Organisation URL',
  `email` varchar(255) NOT NULL COMMENT 'Organisation Contact Email',
  `summary` mediumtext NOT NULL COMMENT 'Organisation Summary',
  `stripe_user_id` varchar(64) NOT NULL COMMENT 'Stripe User ID',
  `stripe_public_key` varchar(64) NOT NULL COMMENT 'Stripe Public Key',
  `stripe_access_token` varchar(64) NOT NULL COMMENT 'Stripe Access Token',
  `stripe_refresh_token` varchar(64) NOT NULL COMMENT 'Stripe Refresh Token'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `organisation` (`id`, `name`, `url`, `email`, `summary`, `stripe_user_id`, `stripe_public_key`, `stripe_access_token`, `stripe_refresh_token`) VALUES
(1, 'Conflict Resolution LARP', 'http://www.conflict-resolution.org.uk/', 'yoda@conflict-resolution.org.uk', 'We run No Rest for the Wicked', '', '', '', '');

CREATE TABLE `organisation_members` (
  `organisation_id` int(11) NOT NULL COMMENT 'Organisation ID',
  `user_id` int(11) NOT NULL COMMENT 'User ID',
  `founder` tinyint(4) NOT NULL COMMENT 'Founder flag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `organisation_members` (`organisation_id`, `user_id`, `founder`) VALUES
(1, 1, 1);

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL COMMENT 'Ticket ID',
  `group_id` int(11) NOT NULL COMMENT 'Ticket Group ID',
  `type_id` int(11) NOT NULL COMMENT 'Ticket Type ID',
  `name` varchar(50) NOT NULL COMMENT 'Ticket Name',
  `ticket_price` decimal(9,2) NOT NULL COMMENT 'Ticket price',
  `ticket_fee` decimal(9,2) NOT NULL COMMENT 'Ticket Fee',
  `fee_included` tinyint(4) NOT NULL COMMENT 'Is fee included in price?',
  `ticket_limit` int(11) NOT NULL COMMENT 'Tickets available',
  `description` varchar(255) NOT NULL COMMENT 'Ticket Description',
  `sell_from` datetime NOT NULL COMMENT 'Start selling from',
  `sell_until` datetime NOT NULL COMMENT 'Stop selling at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ticket` (`id`, `group_id`, `type_id`, `name`, `ticket_price`, `ticket_fee`, `fee_included`, `ticket_limit`, `description`, `sell_from`, `sell_until`) VALUES
(1, 1, 1, 'Player Ticket', '70.00', '0.50', 1, 0, 'Standard Player Ticket', '2015-02-28 00:00:00', '2015-05-13 18:00:00'),
(2, 1, 1, 'Hardship Ticket', '55.00', '0.50', 1, 0, 'Hardship Ticket', '2015-02-28 00:00:00', '2015-05-13 18:00:00'),
(3, 1, 1, 'Donation Ticket', '85.00', '0.50', 1, 0, 'Player Ticket plus a donation', '2015-02-28 00:00:00', '2015-05-13 18:00:00'),
(4, 2, 1, 'Crew Ticket (Catered)', '17.00', '0.50', 1, 0, 'Catered crew ticket', '2015-02-25 00:00:00', '2015-05-13 18:00:00');

CREATE TABLE `ticket_group` (
  `id` int(11) NOT NULL COMMENT 'Ticket Group ID',
  `event_id` int(11) NOT NULL COMMENT 'Event ID',
  `name` varchar(100) NOT NULL COMMENT 'Ticket Group Name',
  `ticket_limit` int(11) NOT NULL COMMENT 'Tickets Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ticket_group` (`id`, `event_id`, `name`, `ticket_limit`) VALUES
(1, 1, 'Players', 35),
(2, 1, 'Crew', 0);

CREATE TABLE `ticket_type` (
  `id` int(11) NOT NULL COMMENT 'Ticket Type ID',
  `name` varchar(20) NOT NULL COMMENT 'Ticket Type Name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ticket_type` (`id`, `name`) VALUES
(1, 'Paid Ticket'),
(2, 'Free Ticket'),
(3, 'Donation'),
(4, 'Sign Up');

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'User ID',
  `name` varchar(100) NOT NULL COMMENT 'User Name',
  `email` varchar(255) NOT NULL COMMENT 'User Email',
  `password` varchar(100) NOT NULL COMMENT 'Password',
  `customer_token` varchar(100) NOT NULL COMMENT 'Stripe Customer Token',
  `admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Admin flag',
  `access_token` varchar(32) NOT NULL COMMENT 'Security Access Token'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `customer_token`, `admin`, `access_token`) VALUES
(1, 'Yoda', 'david@moltis.co.uk', '$2y$13$.1ziZHdW5v7gMNqAQjS9hOoWOR9BdpIqBdZtH95VP18ocQYPRU8BW', '', 1, 'TTFet07ChcozR3ezdu6vgogRxXzOpvwA');


ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `session_id` (`session_id`);

ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_id`,`ticket_id`);

ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `organisation_members`
  ADD PRIMARY KEY (`organisation_id`,`user_id`);

ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `group_id` (`group_id`);

ALTER TABLE `ticket_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Cart ID';
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Event ID', AUTO_INCREMENT=2;
ALTER TABLE `organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Organisation ID', AUTO_INCREMENT=2;
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ticket ID', AUTO_INCREMENT=5;
ALTER TABLE `ticket_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ticket Group ID', AUTO_INCREMENT=3;
ALTER TABLE `ticket_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ticket Type ID', AUTO_INCREMENT=5;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
