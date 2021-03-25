-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2021 at 12:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joinmePrj`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `CUId` int(11) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `district` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `about` longtext DEFAULT NULL,
  `img` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`CUId`, `address`, `pincode`, `district`, `state`, `country`, `email`, `phone`, `about`, `img`) VALUES
(41, 'Thenayi parambil house Panangattoor Post  Tanur', 676302, 'Malappuram', 'Kerala', 'India', 'red@gmail.com', '865546576', 'kjahksjdhkjhkasd kajsd kjhkjashdkjhf aksdjfkjh jghaksdkj', ''),
(42, 'Thenayiparambil house\r\nPanangattoor', 676302, 'Tanur', 'Kerala', 'India', 'ajshdg5@gmail.com', '91283498875', 'aljhsgdjfg aljshdgjflgljasgldf ljuhgelwuhlulf l jasgdjgjg', 'b1f34fb9251f886dbba08d5d157a6fa3.jpg'),
(43, 'yahoo mail', 123123, 'Calicut', 'Kerala', 'India', 'yahoo@yahoomail.com', '1231231230', 'Yahoo! is an Internet portal that incorporates a search engine and a directory of World Wide Web sites organized in a hierarchy of topic categories. As a directory, it provides both new and seasoned Web users the reassurance of a structured view of hundreds of thousands of Web sites and millions of Web pages. It also provides one of the best ways to search the Web for a given topic. Since Yahoo is associated with the most popular Web search sites, if a search argument doesn\'t lead to a Yahoo topic page, it will still lead to results from the six or seven popular search engine sites Yahoo links to.\r\n\r\nYahoo! began as the bookmark lists of two Stanford University graduate students, David Filo and Jerry Yang. After putting their combined bookmark lists organized by categories on a college site, the list began to grow into an Internet phenomenon. It became the first such directory with a large following. Filo and Yang postponed their graduate work and became part of a public offering for a multi-million dollar corporation. As of October, 2005, Yahoo was serving approximately 3.4 billion page views worldwide.', 'breakfast.png'),
(44, 'ashdfhkjasdhfkjh kashdkjfhkajshdf kajsdhf kjhasdkjf kjsadfhkjsa', 234524, 'kahsdkhf', ' kshdkf ', 'sdkfhskj', 'sdfjbas@jahs.sjj', '12367865764', 'j sjdf kasd fklhaksdjhfkashdkf kasdfhkjahsdkfjh aksjdfhkjahs dkf', ''),
(45, 'asdflasdfm', 123111, 'lslkdflkls', 'lnlskndflknlk', 'nflksndfnl', 'sldk@kasjd.asd', '456745456', 'lknsdlkfnlsndflnlsn nknlknlfnsdf lskdlfkslkdfkll asf lsdlsdl', ''),
(49, 'ajsdkjfhkhkh', 92837, 'ujweuruw', 'iuweyiruy', 'iuyweuyri', 'jakshdj@sjdhf.skdh', '98712878778', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque sit. Auctor eu augue ut lectus arcu bibendum at varius. At elementum eu facilisis sed. Sem fringilla ut morbi tincidunt augue interdum velit euismod. Sit amet dictum sit amet justo donec enim. Nunc eget lorem dolor sed. Ac tincidunt vitae semper quis lectus nulla at volutpat. Neque gravida in fermentum et sollicitudin. Vestibulum morbi blandit cursus risus at ultrices mi. Magna fermentum iaculis eu non diam phasellus vestibulum. Suspendisse potenti nullam ac tortor vitae purus faucibus. Ut faucibus pulvinar elementum integer enim neque volutpat ac. Elit at imperdiet dui accumsan sit amet nulla. Vitae auctor eu augue ut. Morbi blandit cursus risus at ultrices. Scelerisque varius morbi enim nunc. Aliquam vestibulum morbi blandit cursus risus at ultrices. Viverra orci sagittis eu volutpat odio facilisis. Egestas sed tempus urna et pharetra pharetra massa massa.', '00100sPORTRAIT_00100_BURST20190418124435239_COVER.jpg'),
(50, 'Thenayi parambil house Panangattoor Post  Tanur', 676302, 'malappuram', 'Kerala', 'India', 'ajaytp7@gmail.com', '8593902179', 'yrieufbub adfbvie fvskdfbvkjb', ''),
(51, 'akjsdhfkjkas dkfahksjdhfkhaskdhfk kajhskjdh', 676302, 'malappuram', 'kerala', 'india', 'sarathptnr@gmail.com', '9633360014', 'asdjfkjasdf asjdfgjs', ''),
(53, 'sdfa', 234, 'asdf', 'asdf`', 'sdf', 'sdf@sd.cls', '2423', 'sdfsdf', ''),
(54, 'sdfa', 23423, 'asdf', 'asdf`', 'sdf', 'sdf@sd.clsa', '2423233', 'sdfsdf', ''),
(55, 'Tanur near railway station', 676302, 'malappuram', 'kerala', 'india', 'anusha@gmail.com', '6666666666', 'Financial solutions provider', ''),
(57, 'jabir house', 676302, 'Malappuram', 'Kerala', 'India', 'jabir@gmail.com', '9988776788', 'jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj jhgashdgjgsjdfsdf sdajgfjhsadgfjgsjd fjhs dfjhsdjhf jsd gfj gsdj', ''),
(58, 'akhsdjfhkshdfkjhaskjdfhks sdkjfhksadjhfk', 676302, 'Malappuram', 'Kerala', 'India', 'pranav@gmail.com', '99998787', 'askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf askduhfkjashjdf sdfjhskdjfh kjsdhf ', 'apple-touch-icon.png'),
(59, 'sadiq ali house', 676302, 'Malappuram', 'Kerala', 'India', 'sadiq@gmail.com', '9988778866', 'asdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdfasdfjhbasjdfjsabdkjfb sdfjh asdjhf jsad fjs bdf', 'kNKrjvAshU2wAHXM2aOMAIzYGML6mr.png'),
(60, 'msadbfsmdfsdfm j asjdfkjaksdhfk sdkf', 676302, 'Malappuram', 'KERALA', 'India', 'jibin@gmail.com', '8877665577', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque sit. Auctor eu augue ut lectus arcu bibendum at varius. At elementum eu facilisis sed. Sem fringilla ut morbi tincidunt augue interdum velit euismod. Sit amet dictum sit amet justo donec enim. Nunc eget lorem dolor sed. Ac tincidunt vitae semper quis lectus nulla at volutpat. Neque gravida in fermentum et sollicitudin. Vestibulum morbi blandit cursus risus at ultrices mi. Magna fermentum iaculis eu non diam phasellus vestibulum. Suspendisse potenti nullam ac tortor vitae purus faucibus. Ut faucibus pulvinar elementum integer enim neque volutpat ac. Elit at imperdiet dui accumsan sit amet nulla. Vitae auctor eu augue ut. Morbi blandit cursus risus at ultrices. Scelerisque varius morbi enim nunc. Aliquam vestibulum morbi blandit cursus risus at ultrices. Viverra orci sagittis eu volutpat odio facilisis. Egestas sed tempus urna et pharetra pharetra massa massa.', '0wdvqxH533NYr99ZYy5bTiyJ7gSKbS.png');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CId` int(11) DEFAULT NULL,
  `cname` varchar(50) DEFAULT NULL,
  `since` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CId`, `cname`, `since`) VALUES
(41, 'hello', '2020-10-30'),
(42, 'sdfa', '2020-10-29'),
(43, 'Yahoo', '2020-10-30'),
(44, 'New', '2020-10-30'),
(45, 'hi', '2020-10-29'),
(53, 'asdf', '2020-10-31'),
(54, 'asdf', '2020-10-31'),
(55, 'SBI', '2020-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `companyProjects`
--

CREATE TABLE `companyProjects` (
  `CPId` int(11) NOT NULL,
  `CId` int(11) DEFAULT NULL,
  `prTitle` varchar(50) NOT NULL,
  `psDate` date DEFAULT NULL,
  `pcDate` date DEFAULT NULL,
  `tExp` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companyProjects`
--

INSERT INTO `companyProjects` (`CPId`, `CId`, `prTitle`, `psDate`, `pcDate`, `tExp`, `status`) VALUES
(11, 43, 'asdf', '2021-01-15', '0000-00-00', 300000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `companySalaryScale`
--

CREATE TABLE `companySalaryScale` (
  `CId` int(11) DEFAULT NULL,
  `levels` int(11) NOT NULL,
  `jTitle` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companySalaryScale`
--

INSERT INTO `companySalaryScale` (`CId`, `levels`, `jTitle`, `salary`) VALUES
(43, 1, 'ANDROID', '7000'),
(43, 2, 'ANDROID', '18000'),
(43, 3, 'ANDROID', '25000'),
(43, 1, 'JAVA', '9,500'),
(43, 2, 'JAVA', '15,500'),
(43, 3, 'JAVA', '25,000');

-- --------------------------------------------------------

--
-- Table structure for table `dailyWorkReport`
--

CREATE TABLE `dailyWorkReport` (
  `DWRId` int(11) NOT NULL,
  `CPId` int(11) DEFAULT NULL,
  `UId` int(11) DEFAULT NULL,
  `uDate` date DEFAULT NULL,
  `gitid` varchar(100) DEFAULT NULL,
  `desc` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dailyWorkReport`
--

INSERT INTO `dailyWorkReport` (`DWRId`, `CPId`, `UId`, `uDate`, `gitid`, `desc`) VALUES
(2, 11, 60, '2021-01-11', 'dshe3m', 'ashdbfbsd\nasdfasdf'),
(3, 11, 60, '2021-01-11', 'djekk3ks', 'hashd\nasdks\nskh'),
(4, 11, 60, '2021-01-11', 'jsjnd4k', 'akjd akjfkjakd fkjf'),
(5, 11, 60, '2021-01-11', 'kkjsd32nd', 'asdjcvjs'),
(6, 11, 60, '2021-01-12', 'ds4ge6', 'Added new components'),
(7, 11, 60, '2021-01-12', 'ah2djaj7', 'new'),
(8, 11, 60, '2021-01-12', 'sghe3d', 'ajshdfh'),
(9, 11, 60, '2021-01-12', '4evw3n', 'asdfasdf'),
(10, 11, 60, '2021-01-12', 'asd3rf', 'dfgasdfa'),
(11, 11, 60, '2021-01-12', 'asdfj', 'asdfasdf'),
(12, 11, 60, '2021-01-12', 'asdfxc', 'asdftdsv');

-- --------------------------------------------------------

--
-- Table structure for table `jobApply`
--

CREATE TABLE `jobApply` (
  `UId` int(11) NOT NULL,
  `CId` int(11) NOT NULL,
  `PId` int(11) NOT NULL,
  `applyDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobApply`
--

INSERT INTO `jobApply` (`UId`, `CId`, `PId`, `applyDateTime`) VALUES
(49, 43, 11, '2020-12-23 19:07:27'),
(60, 43, 11, '2020-12-25 20:31:07'),
(60, 43, 13, '2021-01-13 09:35:29'),
(56, 43, 13, '2021-01-14 11:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Lid` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pass` mediumtext NOT NULL,
  `type` int(11) NOT NULL,
  `approve` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Lid`, `uname`, `pass`, `type`, `approve`) VALUES
(1, 'admin', 'ab3c39847e49d63a5bd272ea4ef85eae59e13eebbf337dbda68261dd78adde48', 0, 1),
(41, 'hello', 'efb9db7b5418bec7c1cb69c1f03cbebbea7c8c1e059c40cc4c0d744fac533e6d', 1, 1),
(42, 'asdf', 'efb9db7b5418bec7c1cb69c1f03cbebbea7c8c1e059c40cc4c0d744fac533e6d', 1, 1),
(43, 'yahoo', 'a4e119faca5752a222e375d42f3de915d3069f74384d5e58bf628dc0bdd2cac6', 1, 1),
(44, 'new', 'efb9db7b5418bec7c1cb69c1f03cbebbea7c8c1e059c40cc4c0d744fac533e6d', 1, 1),
(45, 'hi', 'efb9db7b5418bec7c1cb69c1f03cbebbea7c8c1e059c40cc4c0d744fac533e6d', 1, 0),
(49, 'shafeeq', 'e3eb97e60942204f13028eedee0859e0bbf6f9f257b90e8f84bd223f9b18095a', 2, 1),
(50, 'ajaytp7', '97373d2f95e26e97fd15f5adfd58f9daf4436298141ae5453261cfda0bf0ab2a', 2, 0),
(51, 'sarathp', '546bb11ab848ffb1b69a758811296d4528f6faac10c66c5cc3b019c4b23aa599', 2, 0),
(52, 'sam', 'da22e6944be808bfb048a22c454e457bab8ff54af7845a253219908f66268ab9', 1, 0),
(53, 'sxc', '7e7869070287233d36834a642ab24dae1c4fdfb54c4b397d2cd88eebd17bb10a', 1, 0),
(54, 'sxcasd', '30d04a6b8ca3cd861e1c3f44e9ae404ba92a91babea56fb2769549314e2034eb', 1, 0),
(55, 'anusha', '43e2e3fef4413931fd399dd4d938f0937a3237f35e42d1e30964334afad5c2ee', 1, 0),
(56, 'jemseers', '3e72325b0a710153af38817735fddfa05ec40d6f2eca06a06d128658fd1a9013', 2, 0),
(57, 'jabir', '2a80792e49def7d8734452a415ee93b737e038de9baecfb165b3b7099db515fe', 2, 0),
(58, 'pranav', '94c6e8b715cf6f4ec9075a39ee91eadb2a64cb82e84ed07e947c14ecd242f516', 2, 0),
(59, 'sadiq', 'dc80bf83671fe8a31c9b9cac685e19f9fada0745a014e8b22b4bdf95651909b2', 2, 0),
(60, 'jibin', 'd78898926d0e5c76fdc55d9a7c0594fd7deeaaa9bddd49af92baa6de56a1df97', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PId` int(11) NOT NULL,
  `CId` int(11) DEFAULT NULL,
  `pTitle` varchar(100) DEFAULT NULL,
  `descr` mediumtext DEFAULT NULL,
  `EDate` date DEFAULT NULL,
  `NoUsers` int(11) DEFAULT NULL,
  `Ulevel` varchar(30) DEFAULT NULL,
  `jTitle` varchar(50) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `tExp` int(11) DEFAULT NULL,
  `pDate` date NOT NULL,
  `durDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PId`, `CId`, `pTitle`, `descr`, `EDate`, `NoUsers`, `Ulevel`, `jTitle`, `salary`, `tExp`, `pDate`, `durDate`) VALUES
(11, 43, 'asdf', 'Google Pay (stylized as G Pay; formerly Pay with Google and Android Pay) is a digital wallet platform and online payment system developed by Google to power in-app and tap-to-pay purchases on mobile devices, enabling users to make payments with Android phones, tablets or watches. Users in the United States and India can also use an iOS device, albeit with limited functionality. In addition to this, the service also supports passes such as coupons, boarding passes, student ID cards, event tickets, movie tickets, public transportation tickets, store cards, and loyalty cards.\r\n\r\nAs of January 8, 2018, the old Android Pay and Google Wallet have unified into a single pay system called Google Pay. Android Pay was rebranded and renamed as Google Pay. It also took over the branding of Google Chrome\'s autofill feature. Google Pay adopts the features of both Android Pay and Google Wallet through its in-store, peer-to-peer, and online payments services.\r\n\r\nThe rebranded service provided a new API that allows merchants to add the payment service to websites, apps, Stripe, Braintree, and Google Assistant. The service allows users to use the payment cards they have on file in their Google Account.', '2020-12-24', 2, 'Expert', 'ANDROID', 25000, 300000, '2020-12-13', '0000-00-00'),
(12, 43, 'New job', 'Java (stylized as java; formerly Pay with Google and is a digital wallet platform and online payment system developed by Google to power in-app and tap-to-pay purchases on mobile devices, enabling users to make payments with Android phones, tablets or watches. Users in the United States and India can also use an iOS device, albeit with limited functionality. In addition to this, the service also supports passes such as coupons, boarding passes, student ID cards, event tickets, movie tickets, public transportation tickets, store cards, and loyalty cards.\r\n\r\nAs of January 8, 2018, the old Android Pay and Google Wallet have unified into a single pay system called Google Pay. Android Pay was rebranded and renamed as Google Pay. It also took over the branding of Google Chrome\'s autofill feature. Google Pay adopts the features of both Android Pay and Google Wallet through its in-store, peer-to-peer, and online payments services.\r\n\r\nThe rebranded service provided a new API that allows merchants to add the payment service to websites, apps, Stripe, Braintree, and Google Assistant. The service allows users to use the payment cards they have on file in their Google Account.', '2021-04-16', 4, 'Intermediate', 'JAVA', 15500, 310000, '2020-12-20', '0000-00-00'),
(13, 43, 'Android - Chatting App', 'We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. We need android developers for our Chatting app project. ', '2021-01-25', 9, 'Expert', 'ANDROID', 25000, 2250000, '2021-01-13', '1970-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `RSId` int(11) DEFAULT NULL,
  `RRId` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`RSId`, `RRId`, `rating`) VALUES
(50, 43, 2),
(51, 43, 2),
(55, 49, 4),
(41, 49, 4),
(43, 49, 4);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `SKId` int(11) NOT NULL,
  `skill` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`SKId`, `skill`) VALUES
(49, 'ANDROID'),
(55, 'JAVA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UId` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UId`, `name`, `gender`, `dob`) VALUES
(49, 'Shafeeq', 'male', '2020-10-30'),
(50, 'Ajay Tp', 'male', '1996-02-20'),
(51, 'Sarath p', 'male', '1997-07-10'),
(56, 'Jemseers', 'male', '1996-06-28'),
(57, 'Jabir', 'male', '1996-06-28'),
(58, 'pranav', 'male', '1996-07-30'),
(59, 'sadiq', 'male', '1996-07-24'),
(60, 'jibin', 'male', '1996-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `usersDocument`
--

CREATE TABLE `usersDocument` (
  `UId` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usersDocument`
--

INSERT INTO `usersDocument` (`UId`, `type`, `path`) VALUES
(60, 'cv', '3LzQdrG7fPXGWRuyC9RcMHML1NOLV94cOgZDgGsfiiBSRikKms.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `userSkill`
--

CREATE TABLE `userSkill` (
  `SKId` int(11) DEFAULT NULL,
  `UId` int(11) DEFAULT NULL,
  `levels` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userSkill`
--

INSERT INTO `userSkill` (`SKId`, `UId`, `levels`) VALUES
(49, 49, 'Expert');

-- --------------------------------------------------------

--
-- Table structure for table `usersOnProject`
--

CREATE TABLE `usersOnProject` (
  `CPId` int(11) NOT NULL,
  `UId` int(11) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usersOnProject`
--

INSERT INTO `usersOnProject` (`CPId`, `UId`, `status`) VALUES
(11, 49, 0),
(11, 60, 0),
(13, 60, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD KEY `CUId` (`CUId`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD KEY `CId` (`CId`);

--
-- Indexes for table `companyProjects`
--
ALTER TABLE `companyProjects`
  ADD PRIMARY KEY (`CPId`),
  ADD KEY `CId` (`CId`);

--
-- Indexes for table `companySalaryScale`
--
ALTER TABLE `companySalaryScale`
  ADD KEY `CId` (`CId`);

--
-- Indexes for table `dailyWorkReport`
--
ALTER TABLE `dailyWorkReport`
  ADD PRIMARY KEY (`DWRId`),
  ADD KEY `CPId` (`CPId`),
  ADD KEY `UId` (`UId`);

--
-- Indexes for table `jobApply`
--
ALTER TABLE `jobApply`
  ADD KEY `UId` (`UId`),
  ADD KEY `CId` (`CId`),
  ADD KEY `PId` (`PId`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Lid`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PId`),
  ADD KEY `CId` (`CId`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD KEY `RSId` (`RSId`),
  ADD KEY `RRId` (`RRId`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`SKId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `UId` (`UId`);

--
-- Indexes for table `usersDocument`
--
ALTER TABLE `usersDocument`
  ADD KEY `UId` (`UId`);

--
-- Indexes for table `userSkill`
--
ALTER TABLE `userSkill`
  ADD KEY `SKId` (`SKId`),
  ADD KEY `UId` (`UId`);

--
-- Indexes for table `usersOnProject`
--
ALTER TABLE `usersOnProject`
  ADD KEY `CPId` (`CPId`),
  ADD KEY `UId` (`UId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companyProjects`
--
ALTER TABLE `companyProjects`
  MODIFY `CPId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dailyWorkReport`
--
ALTER TABLE `dailyWorkReport`
  MODIFY `DWRId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `SKId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`CUId`) REFERENCES `login` (`Lid`),
  ADD CONSTRAINT `fk_addr_id` FOREIGN KEY (`CUId`) REFERENCES `login` (`Lid`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`CId`) REFERENCES `login` (`Lid`);

--
-- Constraints for table `companyProjects`
--
ALTER TABLE `companyProjects`
  ADD CONSTRAINT `cid_foreignkey` FOREIGN KEY (`CId`) REFERENCES `company` (`CId`);

--
-- Constraints for table `companySalaryScale`
--
ALTER TABLE `companySalaryScale`
  ADD CONSTRAINT `companysalaryscale_ibfk_1` FOREIGN KEY (`CId`) REFERENCES `company` (`CId`);

--
-- Constraints for table `dailyWorkReport`
--
ALTER TABLE `dailyWorkReport`
  ADD CONSTRAINT `dailyworkreport_ibfk_2` FOREIGN KEY (`UId`) REFERENCES `users` (`UId`);

--
-- Constraints for table `jobApply`
--
ALTER TABLE `jobApply`
  ADD CONSTRAINT `jobapply_ibfk_1` FOREIGN KEY (`UId`) REFERENCES `users` (`UId`),
  ADD CONSTRAINT `jobapply_ibfk_2` FOREIGN KEY (`CId`) REFERENCES `company` (`CId`),
  ADD CONSTRAINT `jobapply_ibfk_3` FOREIGN KEY (`PId`) REFERENCES `posts` (`PId`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`CId`) REFERENCES `company` (`CId`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`RSId`) REFERENCES `login` (`Lid`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`RRId`) REFERENCES `login` (`Lid`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UId`) REFERENCES `login` (`Lid`);

--
-- Constraints for table `usersDocument`
--
ALTER TABLE `usersDocument`
  ADD CONSTRAINT `usersdocument_ibfk_1` FOREIGN KEY (`UId`) REFERENCES `users` (`UId`);

--
-- Constraints for table `userSkill`
--
ALTER TABLE `userSkill`
  ADD CONSTRAINT `userskill_ibfk_1` FOREIGN KEY (`SKId`) REFERENCES `skills` (`SKId`),
  ADD CONSTRAINT `userskill_ibfk_2` FOREIGN KEY (`UId`) REFERENCES `users` (`UId`);

--
-- Constraints for table `usersOnProject`
--
ALTER TABLE `usersOnProject`
  ADD CONSTRAINT `usersonproject_ibfk_1` FOREIGN KEY (`CPId`) REFERENCES `posts` (`PId`),
  ADD CONSTRAINT `usersonproject_ibfk_2` FOREIGN KEY (`UId`) REFERENCES `users` (`UId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
