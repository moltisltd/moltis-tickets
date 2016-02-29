SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `email` (
  `id` int(11) NOT NULL COMMENT 'Email ID',
  `to_name` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'To Name',
  `to_email` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'To Email',
  `cc_name` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'CC Name',
  `cc_email` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'CC Email',
  `bcc_name` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'BCC Name',
  `bcc_email` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'BCC Email',
  `sender_name` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'Sender Name',
  `sender_email` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'Sender Email',
  `subject` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'Subject',
  `body` text COLLATE latin1_general_ci NOT NULL COMMENT 'Body',
  `attachments` text COLLATE latin1_general_ci NOT NULL COMMENT 'Attachments',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Status',
  `created` datetime NOT NULL COMMENT 'Time Created',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Updated',
  `sent` datetime NOT NULL COMMENT 'Time Sent'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Email ID';