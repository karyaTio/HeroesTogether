-- Create database
--

CREATE DATABASE Heroes;

USE Heroes;

-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

CREATE TABLE `hero` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `hero_name` varchar(255) DEFAULT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `power` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`id`, `hero_name`, `real_name`, `umur`, `power`) VALUES
(1, 'Superman', 'Clark', 99, 'Leser Eye'),
(2, 'Spiderman', 'Peter Parker', 21, 'Spider Web');
