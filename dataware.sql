-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 09:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataware`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_status` varchar(255) DEFAULT 'to do',
  `project_deadline` date DEFAULT NULL,
  `product_owner` int(11) DEFAULT NULL,
  `project_desc` varchar(255) DEFAULT NULL,
  `project_manager` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_status`, `project_deadline`, `product_owner`, `project_desc`, `project_manager`) VALUES
(8, 'create website ', 'to do', '2023-12-13', 4, 'website for ', 11);

--
-- Triggers `projects`
--
DELIMITER $$
CREATE TRIGGER `delete_pro` AFTER DELETE ON `projects` FOR EACH ROW UPDATE users 
SET user_role = 'membre' , user_status = 'not active' WHERE user_id = OLD.project_manager
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_manager` AFTER UPDATE ON `projects` FOR EACH ROW UPDATE users 
SET user_role = 'scrum' , user_status = 'active' WHERE user_id = NEW.project_manager
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_user` AFTER INSERT ON `projects` FOR EACH ROW UPDATE users
    SET user_role = 'scrum', user_status = 'active'
    WHERE user_id = NEW.project_manager
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `team_status` varchar(255) DEFAULT NULL,
  `scrum_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_status`, `scrum_id`, `pro_id`) VALUES
(1, NULL, 'active', 11, NULL),
(2, 'Dolore odit consequa', 'active', 11, NULL),
(3, 'Ut et non eligendi l', 'active', 11, NULL),
(4, 'Ut et non eligendi l', 'active', 11, NULL),
(5, 'Ut et non eligendi l', 'active', 11, NULL),
(6, 'Ut et non eligendi l', 'active', 11, NULL),
(7, 'Ut et non eligendi l', 'active', 11, NULL),
(8, 'Ut et non eligendi l', 'active', 11, NULL),
(9, 'Ut et non eligendi l', 'active', 11, 8),
(10, 'Totam consequat Pro', 'active', 11, 8),
(11, 'Totam consequat Pro', 'active', 11, 8),
(12, 'Totam consequat Pro', 'active', 11, 8),
(13, 'Totam consequat Pro', 'active', 11, 8),
(14, 'Totam consequat Pro', 'active', 11, 8),
(15, 'Totam consequat Pro', 'active', 11, 8),
(16, 'Totam consequat Pro', 'active', 11, 8),
(17, 'Totam consequat Pro', 'active', 11, 8),
(18, 'Totam consequat Pro', 'active', 11, 8),
(19, 'Totam consequat Pro', 'active', 11, 8),
(20, 'Totam consequat Pro', 'active', 11, 8),
(21, 'Totam consequat Pro', 'active', 11, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `user_role` varchar(100) DEFAULT 'membre',
  `user_status` varchar(50) DEFAULT 'not active',
  `user_pass` varchar(255) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fullname`, `user_email`, `user_img`, `user_role`, `user_status`, `user_pass`, `pro_id`, `team_id`) VALUES
(4, 'Brenden Macdonald', 'fuwih@mailinator.com', NULL, 'Product Owner', 'not active', '$2y$10$I7xr8Gsjth5HnoOeMJbRMO9mM99qqs4bTgUI.NPdFfH77cHOuFAGm', NULL, NULL),
(6, 'Adam Graham', 'lirulam@mailinator.com', NULL, 'membre', 'not active', '$2y$10$73n468zTiyBvTWly1fUC1uP.uZ8auHU.8yXSbFGAra7XzjXQ9MMGG', NULL, NULL),
(8, 'Stewart Koch', 'fezir@mailinator.com', NULL, 'membre', 'not active', '$2y$10$9oOXaZZxLX71vRnm01wS9uHyJx.iWPTIMnGLuSYUPO7/Hz/95w8EC', NULL, NULL),
(11, 'Shelby Roy', 'lutekyna@mailinator.com', NULL, 'scrum', 'active', '$2y$10$dKPXlrLGRBcqUwynhnUrp.XJyvwP7zlu/Lqc2UBeKeO4CWbRS4oT6', NULL, NULL),
(16, 'mouad toto', 'mouad@gmail.com', NULL, 'admin', 'not active', '$2y$10$01sojCF.kjK28wwBHQ9YAumEnaNaPh02Bpz.hmE2ZxLmn/joiQ2r2', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `fk_project_manager` (`project_manager`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `fk_pro_id` (`pro_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `fk_proid` (`pro_id`),
  ADD KEY `fk_team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_project_manager` FOREIGN KEY (`project_manager`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_pro_id` FOREIGN KEY (`pro_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_proid` FOREIGN KEY (`pro_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
