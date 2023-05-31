-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2022 at 07:52 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_draft`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbappointment`
--

CREATE TABLE `dbappointment` (
  `ID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `doctornote` text NOT NULL,
  `symptom` text NOT NULL,
  `suspectedcause` text NOT NULL,
  `prescription` text NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbappointment`
--

INSERT INTO `dbappointment` (`ID`, `BookingID`, `doctornote`, `symptom`, `suspectedcause`, `prescription`, `date`) VALUES
(1, 5, 'Notes  Notes Notes Notes ', 'SymptomsSymptoms SymptomsSymptoms', 'Suspected CauseSuspected Cause', 'Prescription Prescription ', '2022-04-03'),
(2, 8, 'Patient	', 'Patient', 'Patient	', 'Patient	', '2022-04-16'),
(3, 9, 'take meds after every meal', 'Cough, Fever 105', 'Seasonal Flu', 'Biogesic', '2022-04-23'),
(4, 11, 'data', 'symptomsdata', 'data', 'data', '2022-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dbboooking`
--

CREATE TABLE `dbboooking` (
  `ID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `ScheduleID` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `bookingnumber` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbboooking`
--

INSERT INTO `dbboooking` (`ID`, `PatientID`, `ScheduleID`, `date`, `bookingnumber`, `status`, `createddate`) VALUES
(1, 1, 1, 'next Monday from 2022-03-25', '1', 'booked', '2022-03-25'),
(2, 1, 1, 'next Monday from 2022-03-25', '2', 'booked', '2022-03-25'),
(4, 1, 4, 'next Saturday from 2022-04-02', '1', 'booked', '2022-04-02'),
(5, 1, 5, 'next Sunday from 2022-04-03', '1', 'done', '2022-04-03'),
(6, 1, 5, 'next Sunday from 2022-04-03', '2', 'booked', '2022-04-03'),
(8, 1, 4, 'next Saturday from 2022-04-16', '1', 'done', '2022-04-16'),
(9, 1, 5, 'next Sunday from 2022-04-23', '1', 'done', '2022-04-23'),
(10, 2, 5, 'next Sunday from 2022-04-23', '2', 'booked', '2022-04-23'),
(11, 4, 7, 'next Monday from 2022-05-02', '1', 'done', '2022-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dbdepartment`
--

CREATE TABLE `dbdepartment` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbdepartment`
--

INSERT INTO `dbdepartment` (`ID`, `Name`) VALUES
(1, 'General'),
(2, 'Therapist'),
(3, 'Physician'),
(4, 'NewDepartment');

-- --------------------------------------------------------

--
-- Table structure for table `dbdoctor`
--

CREATE TABLE `dbdoctor` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `phnum` varchar(25) NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `price` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbdoctor`
--

INSERT INTO `dbdoctor` (`ID`, `name`, `DepartmentID`, `phnum`, `ssn`, `degree`, `dob`, `price`, `salary`, `email`, `password`, `status`) VALUES
(1, 'Doctor', 1, '9090909', '1234', 'Degree in Degree', '2002-02-14', '7000', '800000', 'doctor@gmail.com', 'f9f16d97c90d8c6f2cab37bb6d1f1992', 'active'),
(2, 'Dr. Therapist', 2, '09090909', '3456', 'TherapistTherapistTherapist', '2022-04-04', '15000', '800000', 'therapist@gmail.com', '21f89778210c3a0e4ef6b1235f8f56c3', 'active'),
(3, 'therapist2', 2, '9090901', '1234', 'therapist2', '2020-01-28', '10000', '750000', 'therapist2@gmail.com', '8713ce02d133aa1807ecd6ded92525b6', 'active'),
(4, 'NewDoctor', 4, '09090909', '123412', 'BSC DEGREES', '1999-11-11', '10000', '700000', 'newdoc@gmail.com', 'a5e171f642af8e3bd24c50cdc4d66fe3', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `dbpatient`
--

CREATE TABLE `dbpatient` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phnum` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `password` text NOT NULL,
  `allergies` text NOT NULL,
  `createdby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbpatient`
--

INSERT INTO `dbpatient` (`ID`, `name`, `phnum`, `email`, `address`, `dob`, `password`, `allergies`, `createdby`) VALUES
(1, 'Patient', '0909090909', 'patient@gmail.com', 'patient address', '2004-06-06', 'b39024efbc6de61976f585c8421c6bba', 'None', 'Patient'),
(2, 'patient2', '9090909', 'patient2@gmail.com', 'addressaddress', '2016-06-08', '3d47080f1445cd844c3390b15c835ffa', 'allergiesallergies', '1'),
(3, 'patient3', '9090901', 'patient3@gmail.com', 'addressforpatient3', '1992-03-30', '03ede2bfbf54e1352444d524f782ae74', 'allergiesofpatient3', '1'),
(4, 'NewPatient', '12312414', 'newpatient@gmail.com', 'patient add', '2002-12-12', 'a3a1515805dc095d933c35b0a25182ff', 'Alelrgies', '1');

-- --------------------------------------------------------

--
-- Table structure for table `dbproduct`
--

CREATE TABLE `dbproduct` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `retailprice` varchar(100) NOT NULL,
  `supplierprice` varchar(100) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbproduct`
--

INSERT INTO `dbproduct` (`ID`, `name`, `retailprice`, `supplierprice`, `suppliername`, `quantity`, `description`) VALUES
(1, 'Cetrine', '200', '150', '1', 198, 'sicksicksick'),
(2, 'SuppMeds', '300', '200', '2', 297, 'descccc'),
(3, 'Biogesic', '300', '200', '2', 498, 'de'),
(4, 'NewMed', '200', '150', '3', 180, 'adf'),
(5, 'NewProd', '200', '150', '4', 200, '12321321');

-- --------------------------------------------------------

--
-- Table structure for table `dbreceipt`
--

CREATE TABLE `dbreceipt` (
  `ID` int(11) NOT NULL,
  `AppointmentID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `price` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbsale`
--

CREATE TABLE `dbsale` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalprice` varchar(100) NOT NULL,
  `staffid` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbsale`
--

INSERT INTO `dbsale` (`ID`, `date`, `totalprice`, `staffid`, `time`) VALUES
(1, '2022-03-09', '400', 2, '21:01:00'),
(2, '2022-03-09', '200', 2, '22:04:29'),
(3, '2022-04-16', '1500', 2, '16:01:11'),
(4, '2022-04-16', '600', 2, '16:06:16'),
(5, '2022-05-02', '4000', 2, '11:50:59'),
(6, '2022-05-02', '4000', 2, '12:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `dbsaledetail`
--

CREATE TABLE `dbsaledetail` (
  `saleID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbsaledetail`
--

INSERT INTO `dbsaledetail` (`saleID`, `productID`, `quantity`, `price`) VALUES
(1, 1, 2, '400'),
(3, 2, 3, '900'),
(3, 3, 2, '600'),
(4, 1, 3, '600'),
(5, 4, 20, '4000'),
(6, 5, 20, '4000');

-- --------------------------------------------------------

--
-- Table structure for table `dbschedule`
--

CREATE TABLE `dbschedule` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `day` varchar(25) NOT NULL,
  `timestart` varchar(25) NOT NULL,
  `timeend` varchar(25) NOT NULL,
  `patientlimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbschedule`
--

INSERT INTO `dbschedule` (`ID`, `DoctorID`, `day`, `timestart`, `timeend`, `patientlimit`) VALUES
(1, 1, 'Monday', '10:00 AM', '12:00 Noon', 10),
(2, 1, 'Tuesday', '10:00 AM', '11:00 AM', 5),
(3, 1, 'Wednesday', '10:00 AM', '11:00 AM', 5),
(4, 1, 'Saturday', '10:00 AM', '11:00 AM', 5),
(5, 1, 'Sunday', '10:00 AM', '11:00 AM', 5),
(6, 0, 'Monday', '10:00 AM', '11:00 AM', 2),
(7, 4, 'Monday', '10:00 AM', '11:30 AM', 15);

-- --------------------------------------------------------

--
-- Table structure for table `dbstaff`
--

CREATE TABLE `dbstaff` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phnum` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `salary` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbstaff`
--

INSERT INTO `dbstaff` (`ID`, `name`, `phnum`, `type`, `salary`, `email`, `password`) VALUES
(1, 'Cetrine', '9090909', 'admin', '800000', 'password2@gmail.com', '6cb75f652a9b52798eb6cf2201057c73'),
(2, 'a', '09090909', 'sale', '750000', 'sale@gmail.com', 'e70b59714528d5798b1c8adaf0d0ed15'),
(3, 'purchase', '0909090808', 'purchase', '750000', 'purchase@gmail.com', '85dbdb21fe502c4d7a1e81bca0aa396d'),
(4, 'Testing Staff', '091082193789', 'sale', '900000', 'testingsales@gmail.com', '4884c7d041236e13f6252b2b36d37223'),
(5, 'testingstaff11', '0909090922', 'admin', '800000', 'test@gmail.com', 'ad0234829205b9033196ba818f7a872b');

-- --------------------------------------------------------

--
-- Table structure for table `dbsupplier`
--

CREATE TABLE `dbsupplier` (
  `ID` int(11) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `contactno` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbsupplier`
--

INSERT INTO `dbsupplier` (`ID`, `companyname`, `contactno`, `email`, `address`) VALUES
(1, 'SupplierComp', '00000999', 'k@aef.com', 'aaaaaaaaaaaaaaaaaaaaa'),
(2, 'Supplying', '00000999', 'supp@gmail.com', 'aaddress'),
(3, 'suppliertest', '0090909', 'suppliertest@gmail.com', 'adfawefwa'),
(4, 'SupTest', '123123', 'sup@gmail.com', '12313');

-- --------------------------------------------------------

--
-- Table structure for table `dbsupply`
--

CREATE TABLE `dbsupply` (
  `ID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalprice` varchar(25) NOT NULL,
  `staffid` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbsupply`
--

INSERT INTO `dbsupply` (`ID`, `supplierID`, `date`, `totalprice`, `staffid`, `time`) VALUES
(1, 2, '2022-03-11', '20000', 1, '11:11:51'),
(2, 4, '2022-05-02', '3000', 0, '12:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `dbsupplydetail`
--

CREATE TABLE `dbsupplydetail` (
  `supplyID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbsupplydetail`
--

INSERT INTO `dbsupplydetail` (`supplyID`, `productID`, `quantity`, `price`) VALUES
(1, 2, 100, '20000'),
(2, 5, 20, '3000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbappointment`
--
ALTER TABLE `dbappointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbboooking`
--
ALTER TABLE `dbboooking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbdepartment`
--
ALTER TABLE `dbdepartment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbdoctor`
--
ALTER TABLE `dbdoctor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbpatient`
--
ALTER TABLE `dbpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbproduct`
--
ALTER TABLE `dbproduct`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbreceipt`
--
ALTER TABLE `dbreceipt`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbsale`
--
ALTER TABLE `dbsale`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbschedule`
--
ALTER TABLE `dbschedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbstaff`
--
ALTER TABLE `dbstaff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbsupplier`
--
ALTER TABLE `dbsupplier`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dbsupply`
--
ALTER TABLE `dbsupply`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbappointment`
--
ALTER TABLE `dbappointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbboooking`
--
ALTER TABLE `dbboooking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dbdepartment`
--
ALTER TABLE `dbdepartment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbdoctor`
--
ALTER TABLE `dbdoctor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbpatient`
--
ALTER TABLE `dbpatient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dbproduct`
--
ALTER TABLE `dbproduct`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dbreceipt`
--
ALTER TABLE `dbreceipt`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbschedule`
--
ALTER TABLE `dbschedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dbstaff`
--
ALTER TABLE `dbstaff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dbsupplier`
--
ALTER TABLE `dbsupplier`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
