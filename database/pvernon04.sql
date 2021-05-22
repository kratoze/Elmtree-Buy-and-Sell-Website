-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2019 at 03:44 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pvernon04`
--

-- --------------------------------------------------------

--
-- Table structure for table `ET_boughtproducts`
--

CREATE TABLE `ET_boughtproducts` (
  `boughtproductsid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_boughtproducts`
--

INSERT INTO `ET_boughtproducts` (`boughtproductsid`, `userid`, `productid`) VALUES
(10, 222, 25);

-- --------------------------------------------------------

--
-- Table structure for table `ET_institutes`
--

CREATE TABLE `ET_institutes` (
  `instituteid` int(11) NOT NULL,
  `institute` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_institutes`
--

INSERT INTO `ET_institutes` (`instituteid`, `institute`) VALUES
(1, 'Queen\'s University Belfast'),
(2, 'Ulster University');

-- --------------------------------------------------------

--
-- Table structure for table `ET_productgallery`
--

CREATE TABLE `ET_productgallery` (
  `galleryid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `imgpath` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_productgallery`
--

INSERT INTO `ET_productgallery` (`galleryid`, `productid`, `imgpath`) VALUES
(4, 3, '79453zanzibar4.jpg'),
(5, 3, '71166zanzibar3.jpg'),
(6, 3, '33429zanzibar2.jpg'),
(7, 4, '67290rose3.jpg'),
(8, 4, '30190rose2.jpg'),
(9, 5, '62388drac3.jpg'),
(10, 5, '49177drac2.jpg'),
(13, 7, '54256bonsai3.jpeg'),
(14, 7, '12206bonsai2.jpg'),
(15, 8, '83595cactus3.jpeg'),
(16, 8, '58096catus2.jpeg'),
(19, 10, '60441oak3.jpeg'),
(20, 10, '73751oak2.jpeg'),
(21, 10, '6792'),
(43, 18, '6049pink4.jpg'),
(44, 18, '74848pink3.jpg'),
(45, 18, '11809pink2.jpg'),
(46, 19, '96151'),
(49, 22, '10769pumkpin2.jpeg'),
(50, 23, '58601tomato3.jpeg'),
(51, 23, '28956tomato2.jpg'),
(52, 24, '1179spider3.jpg'),
(53, 24, '54890spider2.jpg'),
(54, 25, '47908spider3.jpg'),
(55, 25, '9891spider2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ET_products`
--

CREATE TABLE `ET_products` (
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `productdesc` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  `mainimg` varchar(255) NOT NULL DEFAULT 'imgdefault.png',
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `status` int(11) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_products`
--

INSERT INTO `ET_products` (`productid`, `productname`, `productdesc`, `price`, `type`, `mainimg`, `dateadded`, `userid`, `status`) VALUES
(3, 'Zanzibar Gem', 'A perfect houseplant - Zamioculcas zamiifolia is both unusual and strong! The palm-like leaves are dark green and glossy so the plant easily tolerates drought. It can be left without any problems for 3 weeks while you go on holiday! Stand this indoor palm in a light spot, preferably out of full sun. A lovely houseplant, not really a palm tree but known as such!', '16.50', 2, '25583zanzibargem.jpg', '2019-04-05 14:31:26', 221, 3),
(4, 'Potted Rose', 'A miniature rose bush cheers up any home or conservatory. This potted rose bush with beautiful blooms exudes a lovely fragrance and will cheer everyone up! The indoor rose bush is grown with the utmost care and will flower for months. Order several of these beautiful rose bushes for spectacular colour in the home. After flowering, plant your rose bush in the garden.', '20', 5, '30273rose1.jpg', '2019-04-05 14:33:39', 221, 3),
(5, 'Dracaena', 'This dracena has very striking, dark green leaves with white stripes giving it a fantastic contrasting look! Lots of light but well away from direct sunlight - at least 3 metres from the window is ideal. Greenery indoors - always a perfect addition to any home!', '12', 2, '40725drac1.jpg', '2019-04-05 14:35:28', 221, 3),
(7, 'Bonsai Tree', 'This indoor Bonsai originated in southern China, having matured for 6 years and shaped to resemble an ancient tree. It comeâ€™s gift boxed as pictured with care and maintenance instructions.', '10', 2, '22839bonsai1.jpeg', '2019-04-05 14:44:25', 223, 3),
(8, 'Cactus', 'Had this cactus for 2 weeks.  Well looked after.  It\'s green and spiky and comes in a pot.  Would really love to keep it but the missus isn\'t keen on it she says it\'s dangerous and the cat might hurt himself.  I really don\'t understand how it could be dangerous and if you ask me, that cat could learn a lesson or two anyway.  You can see by the pictures it grew a lot.', '8', 5, '69875cactus1.jpg', '2019-04-05 14:49:54', 223, 3),
(10, 'Oak Tree', 'An oak is a tree or shrub in the genus Quercus of the beech family, Fagaceae. There are approximately 600 extant species of oaks. The common name \"oak\" also appears in the names of species in related genera, notably Lithocarpus (stone oaks), as well as in those of unrelated species such as Grevillea robusta (silky oaks) and the Casuarinaceae (she-oaks). The genus Quercus is native to the Northern Hemisphere.', '500', 3, '87549oak1.jpg', '2019-04-05 14:53:55', 223, 3),
(18, 'Pink Passion', 'Cordyline Pink Passion is a new comer for adding interest to your garden and patio planters, offering a completely new colour variation to anything available before. Deep bronze-purple-red foliage with a wide, distinctive pink edging. The bright pink colouration is combined with tactile foliage, bold arching leaves are almost reminiscent of a phormium.', '15', 4, '93833pink1.jpg', '2019-04-05 15:05:38', 223, 3),
(19, 'Shears', 'Used for cuttin\' and trimmin\'.  had to get rid of the hedge out our front because we kept losing our cat so I don\'t need them anymore.', '16', 6, '84556shears1.jpg', '2019-04-05 15:08:45', 223, 3),
(22, 'Pumpkin Seed', 'A pumpkin is a cultivar of a squash plant, most commonly of Cucurbita pepo, that is round, with smooth, slightly ribbed skin, and most often deep yellow to orange in coloration. The thick shell contains the seeds and pulp.', '4', 7, '27950pumpkin1.png', '2019-04-05 15:13:06', 223, 3),
(23, 'Tomato Seeds', 'The aroma and flavour of a freshly picked tomato straight from the vine is something to be savoured! Once you\'ve had the pleasure of this experience you will never want to taste a supermarket tomato again!\r\nGrowing your own tomatoes couldn\'t be simpler and two or three plants will give you an amazing amount of deliciously sweet tomatoes throughout summer and often well into autumn!.', '3', 7, '50767tomato1.jpg', '2019-04-05 15:14:45', 223, 3),
(24, 'Spider Plant', 'The cute and easily grown spider plant (Chlorophytum comosum â€˜Atlanticâ€™) will thrive just about anywhere. Place it in a nice light spot and keep the soil moist â€“ it will never disappoint you. This cheerful little plant with variegated foliage is fun to have.', '11', 2, '67578spider1.jpg', '2019-04-05 15:23:30', 223, 3),
(25, 'Spider Plant', 'The cute and easily grown spider plant (Chlorophytum comosum â€˜Atlanticâ€™) will thrive just about anywhere. Place it in a nice light spot and keep the soil moist â€“ it will never disappoint you. This cheerful little plant with variegated foliage is fun to have.', '11', 2, '54991spider1.jpg', '2019-04-05 15:25:48', 223, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ET_productstatus`
--

CREATE TABLE `ET_productstatus` (
  `productstatusid` int(11) NOT NULL,
  `productstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_productstatus`
--

INSERT INTO `ET_productstatus` (`productstatusid`, `productstatus`) VALUES
(1, 'Sold'),
(2, 'Hidden'),
(3, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `ET_roles`
--

CREATE TABLE `ET_roles` (
  `roleid` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_roles`
--

INSERT INTO `ET_roles` (`roleid`, `role`) VALUES
(1, 'buyer'),
(2, 'seller'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ET_type`
--

CREATE TABLE `ET_type` (
  `typeid` int(11) NOT NULL,
  `type` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_type`
--

INSERT INTO `ET_type` (`typeid`, `type`) VALUES
(2, 'House Plant'),
(3, 'Trees'),
(4, 'Outdoor Plant'),
(5, 'Potted'),
(6, 'Tools'),
(7, 'Seeds');

-- --------------------------------------------------------

--
-- Table structure for table `ET_users`
--

CREATE TABLE `ET_users` (
  `userid` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `forename` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `profileimg` varchar(100) NOT NULL DEFAULT 'Placeholder.png',
  `institute` int(11) NOT NULL,
  `signupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_users`
--

INSERT INTO `ET_users` (`userid`, `username`, `forename`, `surname`, `password`, `email`, `phonenumber`, `profileimg`, `institute`, `signupdate`, `rating`) VALUES
(221, 'pvernon04', 'Philip', 'Vernon', 'password1', 'philip.s.vernon@gmail.com', '07895427620', '39779gracie.jpg', 1, '2019-04-03 15:27:46', 8),
(222, 'dmcdevitt', 'declan', 'mcdevitt', 'password', 'deco@gmail.com', '7892294320', '52989declan.jpeg', 1, '2019-04-05 02:06:40', 4),
(223, 'psmith', 'Peter', 'Smith', 'password3', 'psmith@hotmail.com', '07848493876', '3240smithpn.jpg', 2, '2019-04-05 14:36:59', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ET_users_role`
--

CREATE TABLE `ET_users_role` (
  `users_roleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ET_users_role`
--

INSERT INTO `ET_users_role` (`users_roleid`, `userid`, `roleid`) VALUES
(140, 221, 2),
(141, 221, 1),
(142, 221, 3),
(143, 222, 1),
(144, 223, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ET_boughtproducts`
--
ALTER TABLE `ET_boughtproducts`
  ADD PRIMARY KEY (`boughtproductsid`),
  ADD KEY `FK_bought_products_userid` (`userid`),
  ADD KEY `FK_boughtproducts_productid` (`productid`);

--
-- Indexes for table `ET_institutes`
--
ALTER TABLE `ET_institutes`
  ADD PRIMARY KEY (`instituteid`);

--
-- Indexes for table `ET_productgallery`
--
ALTER TABLE `ET_productgallery`
  ADD PRIMARY KEY (`galleryid`),
  ADD KEY `ET_gallery_productid` (`productid`);

--
-- Indexes for table `ET_products`
--
ALTER TABLE `ET_products`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `FK_products_userid` (`userid`),
  ADD KEY `FK_products_statusid` (`status`);

--
-- Indexes for table `ET_productstatus`
--
ALTER TABLE `ET_productstatus`
  ADD PRIMARY KEY (`productstatusid`);

--
-- Indexes for table `ET_roles`
--
ALTER TABLE `ET_roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `ET_type`
--
ALTER TABLE `ET_type`
  ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `ET_users`
--
ALTER TABLE `ET_users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `FK_user_institute` (`institute`);

--
-- Indexes for table `ET_users_role`
--
ALTER TABLE `ET_users_role`
  ADD PRIMARY KEY (`users_roleid`),
  ADD KEY `FK_usertype_userid` (`userid`),
  ADD KEY `FK_usertype_roleid` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ET_boughtproducts`
--
ALTER TABLE `ET_boughtproducts`
  MODIFY `boughtproductsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ET_institutes`
--
ALTER TABLE `ET_institutes`
  MODIFY `instituteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ET_productgallery`
--
ALTER TABLE `ET_productgallery`
  MODIFY `galleryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `ET_products`
--
ALTER TABLE `ET_products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ET_productstatus`
--
ALTER TABLE `ET_productstatus`
  MODIFY `productstatusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ET_roles`
--
ALTER TABLE `ET_roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ET_type`
--
ALTER TABLE `ET_type`
  MODIFY `typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ET_users`
--
ALTER TABLE `ET_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `ET_users_role`
--
ALTER TABLE `ET_users_role`
  MODIFY `users_roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ET_boughtproducts`
--
ALTER TABLE `ET_boughtproducts`
  ADD CONSTRAINT `FK_bought_products_userid` FOREIGN KEY (`userid`) REFERENCES `ET_users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_boughtproducts_productid` FOREIGN KEY (`productid`) REFERENCES `ET_products` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ET_productgallery`
--
ALTER TABLE `ET_productgallery`
  ADD CONSTRAINT `ET_gallery_productid` FOREIGN KEY (`productid`) REFERENCES `ET_products` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ET_products`
--
ALTER TABLE `ET_products`
  ADD CONSTRAINT `FK_products_statusid` FOREIGN KEY (`status`) REFERENCES `ET_productstatus` (`productstatusid`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_products_userid` FOREIGN KEY (`userid`) REFERENCES `ET_users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ET_users`
--
ALTER TABLE `ET_users`
  ADD CONSTRAINT `FK_user_institute` FOREIGN KEY (`institute`) REFERENCES `ET_institutes` (`instituteid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ET_users_role`
--
ALTER TABLE `ET_users_role`
  ADD CONSTRAINT `FK_usertype_roleid` FOREIGN KEY (`roleid`) REFERENCES `ET_roles` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_usertype_userid` FOREIGN KEY (`userid`) REFERENCES `ET_users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
