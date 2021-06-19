-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 07:52 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_clsams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `capacities`
--

CREATE TABLE `capacities` (
  `id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capacities`
--

INSERT INTO `capacities` (`id`, `lab_id`, `capacity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 41, '2021-06-02 21:48:46', '2021-06-15 16:47:06', NULL),
(2, 1, 40, '2021-06-15 15:16:19', '2021-06-15 16:46:54', NULL),
(3, 3, 32, '2021-06-15 16:26:49', '2021-06-15 16:40:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Make-Up Class', '2021-06-02 21:40:56', '2021-06-02 21:42:40', NULL),
(2, 'Seminar', '2021-06-02 21:42:46', '2021-06-02 21:42:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_abbrev` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_abbrev`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diploma in Information Communication Technology', 'DICT', '2021-06-02 19:13:20', '2021-06-02 19:13:20', NULL),
(2, 'Bachelor of Science in Information Technology', 'BSIT', '2021-06-02 19:14:42', '2021-06-02 19:17:45', NULL),
(3, 'Diploma in Office Administration Technology', 'DOMT', '2021-06-02 19:18:11', '2021-06-02 19:18:11', NULL),
(4, 'Bachelor of Science in Mechanical Engineering', 'BSME', '2021-06-02 19:18:34', '2021-06-02 19:18:34', NULL),
(5, 'Bachelor of Science in Electronics Engineering', 'BSECE', '2021-06-02 19:18:53', '2021-06-02 19:18:53', NULL),
(6, 'Bachelor of Secondary Education Major in English', 'BSED-ENG', '2021-06-02 19:20:07', '2021-06-02 19:20:07', NULL),
(7, 'Bachelor of Secondary Education Major in Mathematics', 'BSED-MATH', '2021-06-02 19:20:29', '2021-06-02 19:20:29', NULL),
(8, 'Bachelor of Science in Office Administration Major in Legal Transcription', 'BSOA', '2021-06-02 19:21:26', '2021-06-02 19:21:26', NULL),
(9, 'Bachelor of Science in Business Administration Major in Marketing Management', 'BSBA-MM', '2021-06-02 19:22:05', '2021-06-02 19:22:05', NULL),
(10, 'Bachelor of Science in Business Administration Major in Human Resources', 'BSBA-HR', '2021-06-02 19:22:21', '2021-06-02 19:22:21', NULL),
(11, 'Bachelor of Sciene in Accountancy', 'BSA', '2021-06-02 19:22:47', '2021-06-02 19:22:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int(11) NOT NULL,
  `lab_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `lab_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aboitiz', '2021-06-02 20:40:07', '2021-06-02 20:40:07', NULL),
(2, 'DOST', '2021-06-02 20:40:13', '2021-06-02 20:40:13', NULL),
(3, 'DOST 2', '2021-06-15 16:26:35', '2021-06-15 16:26:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) NOT NULL,
  `module` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `permission_type` bigint(20) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission_types`
--

CREATE TABLE `permission_types` (
  `id` bigint(20) NOT NULL,
  `type` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` int(11) NOT NULL,
  `f_code` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `m_initial` varchar(255) NOT NULL,
  `suffix_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `f_code`, `first_name`, `last_name`, `m_initial`, `suffix_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FA12345', 'Joshua', 'Capalaran', 'B', 6, '2021-06-02 19:32:18', '2021-06-17 08:18:43', NULL),
(2, 'FA5678910', 'Gecilie', 'Almiranez', 'C', 6, '2021-06-15 15:45:49', '2021-06-17 08:19:06', NULL),
(3, '2010-00123-TG-0', 'Blance', 'Sanchez', 'C', 0, '2021-06-15 16:06:41', '2021-06-15 16:06:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) NOT NULL,
  `program` varchar(100) NOT NULL,
  `abbreviation` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `program_type` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program`, `abbreviation`, `description`, `program_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diploma in Information, Communication and Technology', 'DICT', 'AB', 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 'Diploma in Information Communication Technology', 'DICT', 'Diploma in Information Communication Technology', 1, '2021-05-31 08:03:22', '2021-05-31 08:06:45', '2021-05-31 08:06:45'),
(3, 'Diploma in Information Communication Technology', 'DICT', 'a', 2, '2021-06-15 16:29:48', '2021-06-15 16:45:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_type`
--

CREATE TABLE `program_type` (
  `id` bigint(20) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_type`
--

INSERT INTO `program_type` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Academic', '0000-00-00 00:00:00', NULL, NULL),
(2, 'Example', '0000-00-00 00:00:00', NULL, NULL),
(3, 'Sample', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedlabs`
--

CREATE TABLE `schedlabs` (
  `id` int(11) NOT NULL,
  `event_name` varchar(25) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `lab_id` int(11) NOT NULL,
  `assigned_person` varchar(255) NOT NULL,
  `num_people` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedlabs`
--

INSERT INTO `schedlabs` (`id`, `event_name`, `category_id`, `date`, `start_time`, `end_time`, `lab_id`, `assigned_person`, `num_people`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Knights of Honor', 0, '2021-06-27', '15:00:00', '16:00:00', 0, 'Joshua Capalaran', 30, '2021-06-13 22:57:02', '2021-06-13 22:58:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedsubjs`
--

CREATE TABLE `schedsubjs` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `lab_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE `schoolyears` (
  `id` int(11) NOT NULL,
  `start_sy` int(11) NOT NULL,
  `end_sy` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`id`, `start_sy`, `end_sy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2019, 2020, '2021-06-02 20:28:36', '2021-06-02 20:28:36', NULL),
(2, 2020, 2021, '2021-06-02 20:28:47', '2021-06-02 20:28:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `year`, `section`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'I', 1, '2021-06-02 19:46:06', '2021-06-02 19:46:06', NULL),
(2, 'II', 1, '2021-06-02 19:46:13', '2021-06-02 19:46:13', NULL),
(3, 'III', 1, '2021-06-02 19:46:21', '2021-06-02 19:46:21', NULL),
(4, 'IV', 1, '2021-06-02 19:46:27', '2021-06-02 19:46:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `sem`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1st', '2021-06-02 19:54:14', '2021-06-02 19:54:14', NULL),
(2, '2nd', '2021-06-02 19:54:28', '2021-06-02 19:54:28', NULL),
(3, '3rd', '2021-06-02 19:54:38', '2021-06-02 19:54:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_num` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `m_initial` varchar(255) NOT NULL,
  `suffix_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_num`, `first_name`, `last_name`, `m_initial`, `suffix_id`, `course_id`, `section_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2018-00256-TG-0', 'Joshua', 'Capalaran', 'A', 0, 0, 0, '2021-06-02 19:29:29', '2021-06-02 19:48:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subj_code` varchar(255) NOT NULL,
  `subj_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subj_code`, `subj_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'COMP123', 'System Data Analysis', '2021-05-31 11:08:16', '2021-06-17 08:17:55', NULL),
(2, 'COMP456', 'Database Administration', '2021-06-02 12:08:44', '2021-06-17 08:18:04', NULL),
(3, 'COMP789', 'Programming 1', '2021-06-02 18:33:51', '2021-06-17 08:18:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suffixes`
--

CREATE TABLE `suffixes` (
  `id` int(11) NOT NULL,
  `suffix_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suffixes`
--

INSERT INTO `suffixes` (`id`, `suffix_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jr', '2021-06-02 21:29:43', '2021-06-02 21:29:43', NULL),
(2, 'I', '2021-06-02 21:29:54', '2021-06-02 21:29:54', NULL),
(3, 'II', '2021-06-02 21:29:59', '2021-06-02 21:29:59', NULL),
(4, 'III', '2021-06-02 21:30:07', '2021-06-02 21:30:07', NULL),
(5, 'Sr', '2021-06-02 21:30:12', '2021-06-02 21:30:12', NULL),
(6, 'PhD', '2021-06-02 21:30:20', '2021-06-02 21:30:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_informations`
--

CREATE TABLE `user_informations` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `office_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `capacities`
--
ALTER TABLE `capacities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_module_id` (`module_id`),
  ADD KEY `FK_permission_type` (`permission_type`);

--
-- Indexes for table `permission_types`
--
ALTER TABLE `permission_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_program_type` (`program_type`);

--
-- Indexes for table `program_type`
--
ALTER TABLE `program_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_role_id` (`role_id`),
  ADD KEY `FK_permission_id` (`permission_id`);

--
-- Indexes for table `schedlabs`
--
ALTER TABLE `schedlabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedsubjs`
--
ALTER TABLE `schedsubjs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suffixes`
--
ALTER TABLE `suffixes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_role_id` (`role_id`);

--
-- Indexes for table `user_informations`
--
ALTER TABLE `user_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_office_id` (`office_id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `capacities`
--
ALTER TABLE `capacities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_types`
--
ALTER TABLE `permission_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_type`
--
ALTER TABLE `program_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedlabs`
--
ALTER TABLE `schedlabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedsubjs`
--
ALTER TABLE `schedsubjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suffixes`
--
ALTER TABLE `suffixes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_informations`
--
ALTER TABLE `user_informations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
