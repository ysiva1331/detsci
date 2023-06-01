CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(12, 'SivaPrasadY', 'test@test.com', 1234567890, 'f925916e2754e5e03f75dd58a5733251', '2020-04-28 12:32:14');
CREATE TABLE `tblexpense` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ExpenseDate` date DEFAULT NULL,
  `ExpenseItem` varchar(200) DEFAULT NULL,
  `ExpenseCost` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
);
CREATE TABLE `revenue` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `RevenueDate` date DEFAULT NULL,
  `RevenueItem` varchar(200) DEFAULT NULL,
  `RevenueCost` varchar(200) DEFAULT NULL,
  `remarks` text NOT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
);

CREATE TABLE `remainders` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `RemainderDate` date DEFAULT NULL,
  `RemainderItem` varchar(200) DEFAULT NULL,
  `RemainderCost` varchar(200) DEFAULT NULL,
  `remarks` text NOT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
);
