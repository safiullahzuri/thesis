-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 06:07 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pacs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `firstname`, `lastname`, `image`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', 'flowers3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `app_id` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `description` text,
  `ptime` time NOT NULL,
  `display` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_id`, `sdate`, `doctor_id`, `patient_id`, `description`, `ptime`, `display`) VALUES
(1, '2121-12-13', 1, 1, 'undefined', '00:12:00', 'no'),
(2, '2121-12-13', 1, 1, 'undefined', '00:12:00', 'no'),
(3, '0000-00-00', 3, 1, 'undefined', '00:00:00', 'no'),
(4, '0000-00-00', 1, 1, '', '00:00:00', 'no'),
(5, '0000-00-00', 1, 1, 'dfadsf', '00:00:00', 'no'),
(9, '2019-07-16', 3, 1, '', '00:00:00', 'yes'),
(10, '2019-07-02', 1, 1, 'let\'s see', '12:32:00', 'no'),
(11, '2212-12-21', 4, 1, 'sfsadfa12', '00:12:00', 'yes'),
(12, '0001-07-25', 1, 1, 'my appointment', '00:12:00', 'no'),
(13, '1321-02-13', 1, 1, 'some mess', '00:13:00', 'no'),
(14, '0031-02-06', 1, 1, 'some appointment', '02:11:00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `backup_id` int(11) NOT NULL,
  `backup_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(16) NOT NULL,
  `backup_address` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`backup_id`, `backup_date`, `user_id`, `user_type`, `backup_address`) VALUES
(1, '2019-07-15', 1, 'doctor', 'backup-on-2019-07-15-16-42-23.zip');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis_file` varchar(256) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`diagnosis_id`, `diagnosis_file`, `appointment_id`) VALUES
(4, '2019-07-08-07-07-00diagnosisnew.txt', 4),
(11, '2019-07-12-09-11-26diagnosis.txt', 5),
(13, '2019-07-09-01-43-19diagnosis.txt', 2),
(14, '2019-07-09-01-48-37diagnosis.txt', 1),
(15, '2019-07-09-06-23-42diagnosis.txt', 3),
(16, '2019-07-11-11-32-51diagnosis.txt', 10),
(17, '2019-07-11-11-39-02diagnosis.txt', 10),
(18, '2019-07-11-11-39-18diagnosis.txt', 10),
(19, '2019-07-12-04-22-32diagnosis.txt', 1),
(20, '2019-07-12-04-23-23diagnosis.txt', 1),
(21, '2019-07-12-04-30-04diagnosis.txt', 1),
(22, '2019-07-12-08-12-51diagnosis.txt', 5),
(23, '2019-07-12-08-59-58diagnosis.txt', 5),
(24, '2019-07-13-07-03-20diagnosis.txt', 13),
(25, '2019-07-13-08-48-20diagnosis.txt', 12),
(26, '2019-07-13-09-34-22diagnosis.txt', 14);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `street` varchar(32) DEFAULT NULL,
  `postCode` varchar(256) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phoneNo` varchar(32) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `firstname`, `lastname`, `dob`, `city`, `street`, `postCode`, `email`, `phoneNo`, `username`, `password`, `image`) VALUES
(1, '3660a0ff490b6293fa5266b6f4d56eb7aea8f470f0ed82ebf3e2b20a39feb14507657fb74e94c43c5e699a7eecd98d7431c6fe27276a5eb7bffc404c02d35d62VQill0tkZbRkn4aqkjcmB7MJAy1/mABpS8nZe6vMWIw=', '5246dd4097f6b0ef002c47674b3aeb361ce81945b10f425ff38e79cbe4688284f70c2896588f5046f15e1ce1435e670a4c3cba6907bcc494677581a995108996EXGpydvGTZd2MJFv3EmdioIb4YWKcMCgQA+rbcKIL/k=', '2019-07-02', 'herat', 'herat', '082b9d3216f1b699c1fbb794e04abb9a74af454a4f5234c405a41513b5f713e3d04ddcc4c31f7fb1c3e33a96b70ad326d3e7a5831dcc12d38f9d47ed3c5c8b874w7sTCN3uAbkqIj9XNImq8N8FMb3j3vWBqiY9hzLKME=', 'heratedited@gm.com', 'herat', 'safi', '21232f297a57a5a743894a0e4a801fc3', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(3, '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', '0000-00-00', 'dsaf', 'dsafa', 'dsafa', 's@g.com', 'sdfa', 'sd', '21232f297a57a5a743894a0e4a801fc3', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(4, '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', '1122-02-12', 'fdas', 'dasf', 'dsfsad', 's@g.com', 'dsfadfa', 'sfs', '21232f297a57a5a743894a0e4a801fc3', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(5, 'ff5f3d38868d44f8892a6f5082b5e03cb80215bb83ee918f82d24072a32d07f0989f0c7515b8a17f3800d67c05a56cbf967adc625d753d39de2ba4fde75ccf5ewGtHxgQNImT6NkYCucBafFHIeR66XPk4SeHabIWwTtQ=', 'e31b3b45ad451bc3acb1ebb9a458bc83b5de601306eb4b0bf08379da8871b68e23fd3ab59138b5e9cece9ac31d56eff99f4d889ce4e13cc661812fb5ce7c8f09so1YJEo0NHgYMwR6+3VHu58Zw4x3X5t4JhHfsMzSv7E=', '2111-02-11', 'dlksjf', 'dlskjf', 'eb514a5169e4d4ebe651411f9bef77b606a32964786448279dffa3691e889ff1f2cdcf61afc71e63013bc6c65f1030af17be9702ef901055c72f413512788a88BCKFYL+EoIMLlAEqJh1T4miPnnsgg0TtPDqlhEyNCQc=', 'someemail@gmail.com', 'dlkfjs', 'doctor', '931681a971adb816a5ee55a32e5e5e32', '4aac907861a181ff9228526b983d0302e6489121306b9a4cdbe362035b198d4589fc3fa01d03f75b86c9e0fd62419a05c5c25bcddabfed9dc83f23f32c6d61d2lDGOMUYGdwha7m9Fuu2U8XeJPk8wqBVwpQGMlE75J0IaKspKACOMCp+EtKC674Hh');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `job` varchar(32) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `street` varchar(32) DEFAULT NULL,
  `postCode` varchar(256) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `phoneNo` varchar(32) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `firstname`, `lastname`, `dob`, `job`, `city`, `street`, `postCode`, `email`, `username`, `password`, `phoneNo`, `image`) VALUES
(1, '3097612d4b7d06b6746cc668dc100210ffc4ec316f36f73bb83874b81a892e19158f5f78edb57e3487d48b7b01b1c620f6ce0bf9508325c52e924f26ba5fb347Y9foZuUxGwXXzHbP2TiVRd4lDSNbKwXwM/IweAqGitQ=', '98703af17fa0b5724e6502dbc65bcec8dcac3006cfce35b8af059abd00a27e8d142b98a39290220f721df8b53c007d16a6397e8f7ec2cdcff49dd041933fb195v0ExNf+BquN5hRIhER7zlqTfuZ6++htPDDj4naJZVYM=', '2019-07-15', 'dfa', 'Herat', 'lkdjaslkfj', 'febaeaf2a48d0e6ef22a61b685d4aeda8e6d61b9f4a52d6eee9e35a50ad0e1dfa33e0b6f1bc32a1e3dfbf94004bf02c228bea0994bee248820bb6d89f785891cfGAlP4nqA7Odw+DjoEpvH0NooerTbEifTEMTDPQGp78=', 's@g.com', 'safi', '21232f297a57a5a743894a0e4a801fc3', '0734987432', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(2, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '2222-01-29', 'lkfdjal', 'dkfjsl', 'lkdjfal', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'a@g.com', 'dfasfd', 'sdjf', '231321', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(3, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '2019-07-04', 'dsfs', 'dsfa', 'dsfsd', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'someemail@gmail.com', 'ahmet', 'mehmet', 'dsfsdafs', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(4, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '0212-12-10', 'dsfas', 'dsf', 'sdfds', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'someemail@gmail.com', 'username', '$2y$10$yvEkSlsFhlB9lU8H5ZbP3OWey', 'sdfsdf', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(5, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '1311-02-17', 'dsf', 'dsf', 'dfs', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'someemail@gmail.com', 'ahmet', '$2y$10$Tvcjv5nISrtJctGjo/2Gr.pcC', 'dfs', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(6, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '0212-12-23', 'dsfa', 'dsf', 'dsfa', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'someemail@gmail.com', 'gholam', '$2y$10$1VKlF5MLfcYmGsgs9C9JcuMIa', 'dfs', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(7, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '0121-12-31', '231', '321', 'dsf', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'someemail@gmail.com', 'ahmet', '$2y$10$N/lei.fZz/6aWdOzrazK6ePjA', 'dfs', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(8, '39018d06cff5ff3bb4392ed55b2de3d2101c1f612034dd1d5957f65a426f7eec741a09800a8fd309f058d7e540128f3a6c9e82e46ab77d57b839c8a7e8972877fcEpPBTGmddbkg8pjuG3FzAO3ussiiVuy9txR2noPcI=', '4dbe690c9965b1f857fac1e13cf26df2c52b72464b49797df03af3e8777afca035e93bc390ec5425cfba8f95a97013c95ffc407a40cdec54078ba1ce2e2af525A8RxmZJotYctDe+mKIqOAvZ/0JrIVzYRCgQt1hkwXik=', '2019-07-16', 'dsf', 'dsf', '', 'efe8ed922fb2c43f2fde79d552feda30ed9cd9e905609832513fd23d81f8f8dc34351c93efc658862e903abf4220f27f3e58997cbff64116c02e6a5211a8eed4cg/gQbqcNAourycTPsZgj94J7keMyihPyo1kLAsLbTs=', 'someemail@gmail.com', 'username', '$2y$10$G/toi4HH3bq7k8cIbyhxOOAjx', 'dsa', '133125810d693d25bd06ef3f9c4002e72de233f8faab703dc49022cfe5a195dee1b8aba43435311403a7107a76a7d6d4f6b7d4bfd0edd7750b3e5eeca75afc58Xz2Cq5bsDfjlV4JnwyeZMKMlYouExA91Udn5PCpEuTQ='),
(9, 'c5bfd29547938c2607da0ba0a34d9d0deb81c205a492dadac995afc65eb420cd247340eeac7e5702cf9a3f5e548fec9bc88604373a551172367742cfa2dc2129L9EtBi63V3/fZqDKd3VMo/M1na2OTMsGNK0FIgTQ0mZAWSBk8cxktRvopUUy922LiRP7LALt6I7+VMsrpXtgmoDgx5/9XO5fB8d4vOFkhg1uHLxvCrVm/uGVQLIy2gpC', 'dcc8655d972d82767e5a60e3dac1e3e0979b38c8ab88b8f3abc77ce8b5f9c067deb7c42529b58eb435f2fc3fb32882f1edc02b6537aa6991422f61ee99c4d001ABYrkqMVWTZW5Nscy1yJF1+FB9BuY1R2p22ZhhjmJSY=', '2111-12-31', 'sdf', 'dsf', 'dsf', 'd4a1e6371f7a2a7263a70544b78650d72208fad37f40dac653a885775c5ec08232343268c7bb6dca8943cf3ea92d1fbf426e05ce5d6b55d7f908bf6e903970715S7DE16Haw+yHNwdQdRxhQ3DkHd2jM/KNOpmt0pz2wc=', 'someemail@gmail.com', 'gholam', '5f4dcc3b5aa765d61d8327deb882cf99', 'dsf', 'bf09c518b6ae4f851ad0dbc68762402bce3b9167481b2156ca831b8b56ec83447f80e0a8b7af5aaecc51f646d1da33a6e768b6e2c74a7db02d0f653eb5d911afu57VBuV+6xV+fNqjTQVKIs+XsrRGgL/khG0dNhqZXO0=');

-- --------------------------------------------------------

--
-- Table structure for table `scan`
--

CREATE TABLE `scan` (
  `scan_id` int(11) NOT NULL,
  `file_name` varchar(256) DEFAULT NULL,
  `scan_desc` text,
  `appointment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan`
--

INSERT INTO `scan` (`scan_id`, `file_name`, `scan_desc`, `appointment_id`) VALUES
(5, '145ea45e25b7a87864b1256e6839f62a6b855e96acad7edf96cdf53a07dc3c7508a957fb03cb3fe0fec45cc9cf2780609b2042c5f6521ce1d38c808b66e8a461OL5L+tib/hfJMuPe3meD+tPBhCD/vtM5zvi+DmL8WJCx0o0tszkxjtyvLPMdU+64', 'sadfasdfasfasf', 4),
(6, '145ea45e25b7a87864b1256e6839f62a6b855e96acad7edf96cdf53a07dc3c7508a957fb03cb3fe0fec45cc9cf2780609b2042c5f6521ce1d38c808b66e8a461OL5L+tib/hfJMuPe3meD+tPBhCD/vtM5zvi+DmL8WJCx0o0tszkxjtyvLPMdU+64', 'new description', 4),
(7, '145ea45e25b7a87864b1256e6839f62a6b855e96acad7edf96cdf53a07dc3c7508a957fb03cb3fe0fec45cc9cf2780609b2042c5f6521ce1d38c808b66e8a461OL5L+tib/hfJMuPe3meD+tPBhCD/vtM5zvi+DmL8WJCx0o0tszkxjtyvLPMdU+64', 'tasks desc', 1),
(8, '145ea45e25b7a87864b1256e6839f62a6b855e96acad7edf96cdf53a07dc3c7508a957fb03cb3fe0fec45cc9cf2780609b2042c5f6521ce1d38c808b66e8a461OL5L+tib/hfJMuPe3meD+tPBhCD/vtM5zvi+DmL8WJCx0o0tszkxjtyvLPMdU+64', 'flowers desc', 1),
(9, '145ea45e25b7a87864b1256e6839f62a6b855e96acad7edf96cdf53a07dc3c7508a957fb03cb3fe0fec45cc9cf2780609b2042c5f6521ce1d38c808b66e8a461OL5L+tib/hfJMuPe3meD+tPBhCD/vtM5zvi+DmL8WJCx0o0tszkxjtyvLPMdU+64', 'fdsfadsfads', 1),
(10, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'diagram', 1),
(11, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'let\'s see', 1),
(12, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'let\'s see', 1),
(15, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'bakalim', 2),
(16, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'bakalim', 2),
(17, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'bakalim', 2),
(18, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'bakalim', 2),
(19, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'bakalim', 2),
(20, '9c465a55d741a4c349d98e08c65864209bc95790e93fce8ba556b72fb22cb5b09af491e7c9241bfd4ff14a8df09ef908c2cb7b9207c06be1dbf769aae31418eaISjFYBsWIfrGlTN0JuuKDh4Lu7lGo2oujjED1jWCxXw=', 'bakalim', 2),
(21, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(22, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(23, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(24, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(25, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(26, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(27, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(28, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(29, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(30, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(31, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(32, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(33, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(34, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(35, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(36, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(37, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(38, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(39, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(40, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(41, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(42, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(43, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(44, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(45, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(46, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(47, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(48, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(49, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'bakalim', 2),
(50, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsfasdfas', 4),
(51, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsfasdfas', 4),
(52, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsfasdfas', 4),
(53, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsfasdfas', 4),
(54, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsfasdfas', 4),
(55, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'pexels fala nf ilan', 4),
(56, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'pexels fala nf ilan', 4),
(57, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'pexels fala nf ilan', 4),
(58, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'pexels fala nf ilan', 4),
(59, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'pexels fala nf ilan', 4),
(60, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'flowersb ones', 5),
(61, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsafadsf', 4),
(62, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dfas', 2),
(63, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'flower', 1),
(64, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dfsaf', 3),
(65, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'lk;sjfadslkjfdsa', 3),
(66, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', '', 10),
(67, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', '', 10),
(68, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'fdsafas', 10),
(69, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'some desc', 1),
(70, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'skdljasd', 1),
(71, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 's', 1),
(72, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', '', 1),
(73, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'dsa', 1),
(74, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'some flowers here', 5),
(75, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', '', 5),
(76, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'd', 5),
(77, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'd', 5),
(78, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'd', 5),
(79, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(80, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(81, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(82, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(83, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(84, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(85, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(86, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(87, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(88, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(89, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'let\'s see the diagnosis', 13),
(90, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'first', 12),
(91, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'second', 12),
(92, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'third', 12),
(93, 'e33fa5cea395f23a922a68572863cea35ef90f01e486c9c4962b9f13c1d4c3001f06be13464a4350e4c1e0933e1238bc25d765c4b15b05c5da691881c9edc3a0OeRwdj/ZO7d1xfrWAkVTCiL0Dd6/RLQPCeF9/oDPgV8=', 'tasks first', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`diagnosis_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`scan_id`),
  ADD KEY `fk_appointment_id` (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scan`
--
ALTER TABLE `scan`
  MODIFY `scan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`app_id`);

--
-- Constraints for table `scan`
--
ALTER TABLE `scan`
  ADD CONSTRAINT `fk_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`app_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
