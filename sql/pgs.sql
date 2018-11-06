-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2016 at 12:00 AM
-- Server version: 5.6.16
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgs`
--

-- --------------------------------------------------------

--
-- Table structure for table `gra_asessor`
--

CREATE TABLE `gra_asessor` (
  `id` int(11) NOT NULL,
  `stu_reg` varchar(20) DEFAULT NULL,
  `ass_name` varchar(65) DEFAULT NULL,
  `mark_pre` int(3) DEFAULT NULL,
  `mark_obj` int(3) DEFAULT NULL,
  `mark_que` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gra_coord`
--

CREATE TABLE `gra_coord` (
  `id` int(11) NOT NULL,
  `username` varchar(111) NOT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gra_coord`
--

INSERT INTO `gra_coord` (`id`, `username`, `password`) VALUES
(1, '_admin', '5407b06005f22ecc65ce32ce7fd0a6a0'),
(2, '_super', 'c6a3eacdb4174aa031e570036eebbead');

-- --------------------------------------------------------

--
-- Table structure for table `gra_student`
--

CREATE TABLE `gra_student` (
  `id` int(11) NOT NULL,
  `stu_reg` varchar(20) DEFAULT NULL,
  `stu_name` varchar(111) DEFAULT NULL,
  `stu_no` int(3) DEFAULT NULL,
  `stu_venue` varchar(65) DEFAULT NULL,
  `stu_project` varchar(255) DEFAULT NULL,
  `stu_supervisor` varchar(65) DEFAULT NULL,
  `stu_password` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gra_student`
--

INSERT INTO `gra_student` (`id`, `stu_reg`, `stu_name`, `stu_no`, `stu_venue`, `stu_project`, `stu_supervisor`, `stu_password`) VALUES
(1, 'CST/12/COM/00001', 'IBRAHIM  ABBA', 43, 'PG LECTURE ROOM', 'project title N/A', 'MAAhmad', '19C779'),
(2, 'CST/12/COM/00003', 'HAMZA SULEIMAN ABBAS', 66, 'PG LECTURE ROOM', 'project title N/A', 'JAGaladanci', '41AC14'),
(3, 'CST/12/COM/00004', 'NUSAIBA MAIKANO ABBAS', 15, 'PG LECTURE ROOM', 'project title N/A', 'MUmar', 'C72DD6'),
(4, 'CST/12/COM/00005', 'ISA  ABDULAZIZ', 51, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', 'B7D970'),
(5, 'CST/12/COM/00006', 'SALIM  ABDULGANIY', 11, 'PG LECTURE ROOM', 'project title N/A', 'MAAhmad', '75A5F7'),
(6, 'CST/12/COM/00007', 'SIDDIQ IBRAHIM ABDULHAMID', 59, 'PG LECTURE ROOM', 'project title N/A', 'JZMaitama', 'CFFD95'),
(7, 'CST/12/COM/00009', 'SAADAT  ABDULKAREE', 17, 'PG LECTURE ROOM', 'project title N/A', 'ASAli', 'BA0020'),
(8, 'CST/12/COM/00010', 'MUHAMMAD NASIR ABDULLAHI', 5, 'PG LECTURE ROOM', 'project title N/A', 'AADatti', '5C5133'),
(9, 'CST/12/COM/00012', 'TIJJANI  ABDULLAHI', 7, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', 'E32658'),
(10, 'CST/12/COM/00013', 'YAHAYA  ABDULLAHI', 10, 'PG LECTURE ROOM', 'project title N/A', 'SMTanimu', '671BF2'),
(11, 'CST/12/COM/00015', 'AHMAD ADAMU ABDULLAHI', 1, 'PG LECTURE ROOM', 'project title N/A', 'BSani', 'FE1301'),
(12, 'CST/12/COM/00016', 'BAHIJJA UBALE ABDULLAHI', 67, 'PG LECTURE ROOM', 'project title N/A', 'ASYahaya', '4FED12'),
(13, 'CST/12/COM/00018', 'MARYAM MUKTAR ABDULLAHI', 22, 'PG LECTURE ROOM', 'project title N/A', 'SIlu', '6A5C4A'),
(14, 'CST/12/COM/00019', 'MUHAMMAD SUNUSI ABDULLAHI', 25, 'PG LECTURE ROOM', 'project title N/A', 'ASYahaya', 'B5167B'),
(15, 'CST/12/COM/00021', 'NABEELA MUSA ABDULLAHI', 49, 'PG LECTURE ROOM', 'project title N/A', 'ASAli', '45A761'),
(16, 'CST/12/COM/00022', 'YUSIF SHEHU ABDULLAHI', 3, 'PG LECTURE ROOM', 'project title N/A', 'ALawal', '40BE03'),
(17, 'CST/12/COM/00026', 'UMMI  ABDULSALAM', 29, 'PG LECTURE ROOM', 'project title N/A', 'ALawal', 'F1C3D4'),
(18, 'CST/12/COM/00027', 'IBRAHIM  ABUBAKAR', 54, 'PG LECTURE ROOM', 'project title N/A', 'BSani', '512F0A'),
(19, 'CST/12/COM/00028', 'MUHAMMAD  ABUBAKAR', 56, 'PG LECTURE ROOM', 'project title N/A', 'SMTanimu', '293609'),
(20, 'CST/12/COM/00029', 'UMAR  ABUBAKAR', 30, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', '0875EA'),
(21, 'CST/12/COM/00030', 'ABDULLAH A ABUBAKAR', 50, 'PG LECTURE ROOM', 'project title N/A', 'ASYahaya', '7D8C81'),
(22, 'CST/12/COM/00032', 'MUSTAPHA MUH''D ABUBAKAR', 55, 'PG LECTURE ROOM', 'project title N/A', 'SKamal', '77A2D2'),
(23, 'CST/12/COM/00033', 'NASIRU ADAMU ABUBAKAR', 45, 'PG LECTURE ROOM', 'project title N/A', 'RARasheed', 'E78D16'),
(24, 'CST/12/COM/00034', 'UMAR ALIYU ABUBAKAR', 2, 'PG LECTURE ROOM', 'project title N/A', 'MSGadanya', '945F4C'),
(25, 'CST/12/COM/00035', 'ZAINAB LADAN ABUBAKAR', 18, 'PG LECTURE ROOM', 'project title N/A', 'SAMuaz', 'DEF1D7'),
(26, 'CST/12/COM/00036', 'ABUBAKAR  ADAMU', 61, 'PG LECTURE ROOM', 'project title N/A', 'MUmar', 'B932B0'),
(27, 'CST/12/COM/00038', 'SANI  ADAMU', 64, 'PG LECTURE ROOM', 'project title N/A', 'RARasheed', 'C88088'),
(28, 'CST/12/COM/00039', 'ABDULKADIR MUHAMMAD ADAMU', 13, 'PG LECTURE ROOM', 'project title N/A', 'SKamal', '0FB188'),
(29, 'CST/12/COM/00040', 'MAARUF MOHAMMED ADAMU', 40, 'PG LECTURE ROOM', 'project title N/A', 'ASYahaya', '1371BA'),
(30, 'CST/12/COM/00041', 'MANSUR RABIU ADAMU', 19, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', '478BEA'),
(31, 'CST/12/COM/00045', 'OLANREWAJU ADAMS AGUNLOYE', 34, 'PG LECTURE ROOM', 'project title N/A', 'JAGaladanci', '259274'),
(32, 'CST/12/COM/00048', 'AMINU RUFAI AHMAD', 31, 'PG LECTURE ROOM', 'project title N/A', 'BSGaladanci', 'FBC818'),
(33, 'CST/12/COM/00049', 'FATIMA GANI AHMAD', 36, 'PG LECTURE ROOM', 'project title N/A', 'SMTanimu', 'D9CCF5'),
(34, 'CST/12/COM/00051', 'MUHAMMAD MUHAMMAD AHMAD', 63, 'PG LECTURE ROOM', 'project title N/A', 'JZMaitama', '0C67FA'),
(35, 'CST/12/COM/00054', 'AHMED ABDULLAHI AHMED', 26, 'PG LECTURE ROOM', 'project title N/A', 'MBabagana', '0AE8D3'),
(36, 'CST/12/COM/00056', 'RABI MOHAMMAD AHMED', 44, 'PG LECTURE ROOM', 'project title N/A', 'MAYusuf', '70AEE2'),
(37, 'CST/12/COM/00061', 'OKASHA SULEIMAN ALI', 32, 'PG LECTURE ROOM', 'project title N/A', 'SHMuhammad', 'EE871C'),
(38, 'CST/12/COM/00062', 'AISHATU  ALIYU', 48, 'PG LECTURE ROOM', 'project title N/A', 'MBabagana', 'C92F32'),
(39, 'CST/12/COM/00064', 'AHMAD ALHAJI ALIYU', 52, 'PG LECTURE ROOM', 'project title N/A', 'MBabagana', 'E783B2'),
(40, 'CST/12/COM/00065', 'FATIMA ADAMU ALIYU', 38, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', '4A6F1C'),
(41, 'CST/12/COM/00066', 'IBRAHIM IBRAHIM ALIYU', 14, 'PG LECTURE ROOM', 'project title N/A', 'AHAbba', '56D800'),
(42, 'CST/12/COM/00072', 'SEMIAT  ASUKU', 69, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', 'EFA9E1'),
(43, 'CST/12/COM/00073', 'SHEDRACH MONDAY AUDU', 9, 'PG LECTURE ROOM', 'project title N/A', 'MUmar', 'C8A9A6'),
(44, 'CST/12/COM/00074', 'KHADIJAH ABDUSSALAM AUWAL', 53, 'PG LECTURE ROOM', 'project title N/A', 'SKamal', '807BA6'),
(45, 'CST/12/COM/00078', 'SADIYA SABIU BAKO', 62, 'PG LECTURE ROOM', 'project title N/A', 'BSGaladanci', 'B45893'),
(46, 'CST/12/COM/00079', 'RAHMATU  BALARABE', 57, 'PG LECTURE ROOM', 'project title N/A', 'MAAhmad', 'CFCB1B'),
(47, 'CST/12/COM/00080', 'SULAIMAN ABDULKADIR BARI', 8, 'PG LECTURE ROOM', 'project title N/A', 'ALawal', 'E49113'),
(48, 'CST/12/COM/00081', 'HAFSAT MUHAMMAD BASHIR', 46, 'PG LECTURE ROOM', 'project title N/A', 'SHMuhammad', '849762'),
(49, 'CST/12/COM/00082', 'HAUWA MUHAMMAD BASHIR', 37, 'PG LECTURE ROOM', 'project title N/A', 'AHAbba', '7AF060'),
(50, 'CST/12/COM/00083', 'GIMBA UMAR BELLO', 65, 'PG LECTURE ROOM', 'project title N/A', 'MUmar', '5AB7CB'),
(51, 'CST/12/COM/00086', 'MUHAMMAD WAZIRI DAHIRU', 20, 'PG LECTURE ROOM', 'project title N/A', 'MAAhmad', 'B556DF'),
(52, 'CST/12/COM/00087', 'DAHIRU ZAREWA DALHA', 28, 'PG LECTURE ROOM', 'project title N/A', 'SAMuaz', '406FA6'),
(53, 'CST/12/COM/00088', 'AYSHA  DANSABO', 27, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', 'C7F336'),
(54, 'CST/12/COM/00090', 'MUHAMMAD ALHAJI DAUDA', 12, 'PG LECTURE ROOM', 'project title N/A', 'SMAliyu', 'C3E20F'),
(55, 'CST/12/COM/00091', 'CHUKWUDI HENRY EZIAGULU', 23, 'PG LECTURE ROOM', 'project title N/A', 'SAMuaz', '4C8B67'),
(56, 'CST/12/COM/00092', 'MUHAMMAD  FARUK', 41, 'PG LECTURE ROOM', 'project title N/A', 'JAGaladanci', '077E5B'),
(57, 'CST/12/COM/00095', 'ABUBAKAR SANI GAMBO', 58, 'PG LECTURE ROOM', 'project title N/A', 'HKAhmad', 'E17925'),
(58, 'CST/12/COM/00098', 'ADO U GARBA', 33, 'PG LECTURE ROOM', 'project title N/A', 'MUmar', 'B8F83E'),
(59, 'CST/12/COM/00099', 'AISHA SHEHU GARBA', 39, 'PG LECTURE ROOM', 'project title N/A', 'MIMukhtar', '1175A9'),
(60, 'CST/12/COM/00101', 'SHEHU HAUWA GARBA', 4, 'PG LECTURE ROOM', 'project title N/A', 'SAMuaz', 'C85620'),
(61, 'CST/12/COM/00102', 'UMAR MAHMUD GARBA', 35, 'PG LECTURE ROOM', 'project title N/A', 'MUmar', '69AFF3'),
(62, 'CST/12/COM/00105', 'AISHA UMMI HABEEB', 68, 'PG LECTURE ROOM', 'project title N/A', 'RARasheed', 'FD2451'),
(63, 'CST/12/COM/00107', 'SALAMATU  HABIBU', 42, 'PG LECTURE ROOM', 'project title N/A', 'MIMukhtar', 'E21978'),
(64, 'CST/12/COM/00109', 'ABBAS ABDULLAHI HALLIRU', 60, 'PG LECTURE ROOM', 'project title N/A', 'BSani', 'FB8AA4'),
(65, 'CST/12/COM/00110', 'KHADIJA MUHAMMAD HALLIRU', 6, 'PG LECTURE ROOM', 'project title N/A', 'SIlu', 'FACE2C'),
(66, 'CST/12/COM/00111', 'UMAR  HAMISU', 21, 'PG LECTURE ROOM', 'project title N/A', 'MAYusuf', '67F639'),
(67, 'CST/12/COM/00113', 'JIBRIL MUSA HARBAU', 24, 'PG LECTURE ROOM', 'project title N/A', 'HKAhmad', 'AB9C95'),
(68, 'CST/12/COM/00116', 'RASHIDA UZOMA HARUNA', 47, 'PG LECTURE ROOM', 'project title N/A', 'SAMuaz', 'CDC667'),
(69, 'CST/12/COM/00119', 'ZAYNAB FOUAD HASHIM', 16, 'PG LECTURE ROOM', 'project title N/A', 'MSGadanya', '721C67'),
(70, 'CST/12/COM/00121', 'AMINU RABI''U HASSAN', 56, 'PG LAB', 'project title N/A', 'RARasheed', '8CF6F4'),
(71, 'CST/12/COM/00122', 'KHADIJA SANI HASSAN', 28, 'PG LAB', 'project title N/A', 'JAGaladanci', '61B6DD'),
(72, 'CST/12/COM/00123', 'MARYAM ALIYU HUDU', 64, 'PG LAB', 'project title N/A', 'MUmar', '28F8EB'),
(73, 'CST/12/COM/00125', 'SHUAIB  HUSSAINI', 52, 'PG LAB', 'project title N/A', 'SAMuaz', 'F222DD'),
(74, 'CST/12/COM/00126', 'YUSUF  HUSSAINI', 43, 'PG LAB', 'project title N/A', 'AADatti', '89456F'),
(75, 'CST/12/COM/00131', 'NAZIFI  IBRAHIM', 24, 'PG LAB', 'project title N/A', 'AHAbba', 'A907E7'),
(76, 'CST/12/COM/00132', 'SULEIMAN  IBRAHIM', 27, 'PG LAB', 'project title N/A', 'MSGadanya', '94B567'),
(77, 'CST/12/COM/00133', 'ABDULKADIR OLAYINKA IBRAHIM', 2, 'PG LAB', 'project title N/A', 'HKAhmad', 'A6FE4D'),
(78, 'CST/12/COM/00134', 'BASHIR SIBA IBRAHIM', 7, 'PG LAB', 'project title N/A', 'AADatti', '8F35D3'),
(79, 'CST/12/COM/00136', 'MAHMUD ALHASSAN IBRAHIM', 58, 'PG LAB', 'project title N/A', 'MIMukhtar', '55E2D6'),
(80, 'CST/12/COM/00137', 'MARYAM MAGAMA IBRAHIM', 23, 'PG LAB', 'project title N/A', 'JAGaladanci', 'F1BCB4'),
(81, 'CST/12/COM/00139', 'SHAMSUDDIN HAMISU IDRIS', 67, 'PG LAB', 'project title N/A', 'SHMuhammad', 'CAA8EA'),
(82, 'CST/12/COM/00142', 'MARYAM MUHAMMAD INUWA', 36, 'PG LAB', 'project title N/A', 'JAGaladanci', 'F9CA87'),
(83, 'CST/12/COM/00143', 'FATIMA IBRAHIM ISA', 30, 'PG LAB', 'project title N/A', 'MIMukhtar', 'D946D6'),
(84, 'CST/12/COM/00144', 'SANI MOHAMMED ISA', 54, 'PG LAB', 'project title N/A', 'MIMukhtar', 'B5BC28'),
(85, 'CST/12/COM/00145', 'ALHABIB  ISAH', 12, 'PG LAB', 'project title N/A', 'USHanga', '876554'),
(86, 'CST/12/COM/00147', 'YUSUF ISMAILA ISIAKA', 31, 'PG LAB', 'project title N/A', 'USHanga', 'CDBA2A'),
(87, 'CST/12/COM/00149', 'SADAM ALHASSAN ISMAIL', 34, 'PG LAB', 'project title N/A', 'BSGaladanci', '3F1953'),
(88, 'CST/12/COM/00150', 'ABUBAKAR  JIBRIN', 16, 'PG LAB', 'project title N/A', 'MBabagana', '7AC744'),
(89, 'CST/12/COM/00151', 'NURA  JIBRIN', 53, 'PG LAB', 'project title N/A', 'MAYusuf', '193406'),
(90, 'CST/12/COM/00152', 'SHAMSUDEEN GARBA JIBRIN', 48, 'PG LAB', 'project title N/A', 'JZMaitama', '8F71F6'),
(91, 'CST/12/COM/00153', 'KHADIJAH  KABIR', 46, 'PG LAB', 'project title N/A', 'ASAli', '3A47EB'),
(92, 'CST/12/COM/00158', 'IBRAHIM SANI KULO', 44, 'PG LAB', 'project title N/A', 'AHTata', 'C37A2D'),
(93, 'CST/12/COM/00159', 'ABDULLAHI RABIU KURA', 25, 'PG LAB', 'project title N/A', 'AHAbba', '52F758'),
(94, 'CST/12/COM/00160', 'ABDULHAMID  LAWAL', 4, 'PG LAB', 'project title N/A', 'SIlu', 'C0323C'),
(95, 'CST/12/COM/00161', 'YAHAYA YUSUF MAIBASIRA', 18, 'PG LAB', 'project title N/A', 'BSGaladanci', '17D412'),
(96, 'CST/12/COM/00162', 'ZAINAB ADO MAJE', 63, 'PG LAB', 'project title N/A', 'SMTanimu', '210A6A'),
(97, 'CST/12/COM/00165', 'HARUNA DAVID MOHAMMED', 21, 'PG LAB', 'project title N/A', 'ASAli', 'FFC1B1'),
(98, 'CST/12/COM/00167', 'SALISU OSAKPOLOR MUBARAK', 50, 'PG LAB', 'project title N/A', 'USHanga', 'C766EE'),
(99, 'CST/12/COM/00168', 'SUMAYYAH ADAM MUHAMMAD', 26, 'PG LAB', 'project title N/A', 'SKamal', '719F5E'),
(100, 'CST/12/COM/00169', 'ALIYASAU  MUHAMMAD', 19, 'PG LAB', 'project title N/A', 'AHAbba', '207866'),
(101, 'CST/12/COM/00171', 'SANI  MUHAMMAD', 51, 'PG LAB', 'project title N/A', 'MAAhmad', 'D71570'),
(102, 'CST/12/COM/00172', 'TANIMU  MUHAMMAD', 35, 'PG LAB', 'project title N/A', 'HKAhmad', 'DAB486'),
(103, 'CST/12/COM/00173', 'ABDULYASAR SALEH MUHAMMAD', 13, 'PG LAB', 'project title N/A', 'BSGaladanci', 'CA525B'),
(104, 'CST/12/COM/00174', 'ABUBAKAR UMAR MUHAMMAD', 55, 'PG LAB', 'project title N/A', 'USHanga', '5A8ED0'),
(105, 'CST/12/COM/00175', 'HAMZA ADAMU MUHAMMAD', 37, 'PG LAB', 'project title N/A', 'ALawal', '83C185'),
(106, 'CST/12/COM/00177', 'KABIR BELLO MUHAMMAD', 60, 'PG LAB', 'project title N/A', 'ALawal', '368534'),
(107, 'CST/12/COM/00178', 'MUSTAPHA IBRAHIM MUHAMMAD', 20, 'PG LAB', 'project title N/A', 'RARasheed', 'F7F584'),
(108, 'CST/12/COM/00179', 'NA''IMA BABANGIDA MUHAMMAD', 62, 'PG LAB', 'project title N/A', 'JZMaitama', '22933B'),
(109, 'CST/12/COM/00181', 'MUHAMMED ASABE MUHAMMED', 49, 'PG LAB', 'project title N/A', 'SHMuhammad', '90BB2B'),
(110, 'CST/12/COM/00182', 'MUNIR  MUKHTAR', 10, 'PG LAB', 'project title N/A', 'ASAli', 'EE91C4'),
(111, 'CST/12/COM/00184', 'MUNNIRA AMINU MUKHTAR', 66, 'PG LAB', 'project title N/A', 'AHAbba', '4C2601'),
(112, 'CST/12/COM/00186', 'SA''ADATU LAWAL MUKHTAR', 3, 'PG LAB', 'project title N/A', 'AADatti', 'E6602D'),
(113, 'CST/12/COM/00189', 'ALIYU ABDULQADIR MUSA', 42, 'PG LAB', 'project title N/A', 'SIlu', 'CF14CA'),
(114, 'CST/12/COM/00193', 'MUHAMMED KABILA MUSA', 32, 'PG LAB', 'project title N/A', 'ASYahaya', '750177'),
(115, 'CST/12/COM/00195', 'ABDULHAKEEM ADETUNJI MUSTAPHA', 5, 'PG LAB', 'project title N/A', 'MUmar', '973C65'),
(116, 'CST/12/COM/00196', 'AISHAT YASMEEN MUSTAPHA', 14, 'PG LAB', 'project title N/A', 'MAAhmad', 'AEBB1C'),
(117, 'CST/12/COM/00197', 'AL-AMIN MUHAMMAD MUSTAPHA', 59, 'PG LAB', 'project title N/A', 'AHTata', '2B174C'),
(118, 'CST/12/COM/00198', 'SULEIMAN DALHA NA''ABBA', 41, 'PG LAB', 'project title N/A', 'MAYusuf', '48DDF3'),
(119, 'CST/12/COM/00200', 'HALIMATU MUHAMMAD NASIR', 9, 'PG LAB', 'project title N/A', 'AHTata', '992E96'),
(120, 'CST/12/COM/00201', 'IDRIS  NUHU', 1, 'PG LAB', 'project title N/A', 'ASYahaya', '434AC9'),
(121, 'CST/12/COM/00203', 'ALIYU HAIDAR NURUDDEEN', 38, 'PG LAB', 'project title N/A', 'SIlu', 'D10163'),
(122, 'CST/12/COM/00204', 'MERCY ONYIOZA OGIRIMA', 61, 'PG LAB', 'project title N/A', 'AHTata', '21E520'),
(123, 'CST/12/COM/00208', 'ABDURRASHID UMAR RABIU', 6, 'PG LAB', 'project title N/A', 'AHTata', '8F03CE'),
(124, 'CST/12/COM/00210', 'HARUNA MUHAMMAD RABIU', 68, 'PG LAB', 'project title N/A', 'AADatti', 'AC803C'),
(125, 'CST/12/COM/00212', 'HAFIZ INUSA SABIU', 8, 'PG LAB', 'project title N/A', 'SMAliyu', '3C546D'),
(126, 'CST/12/COM/00213', 'AHMAD AHMAD SABO', 57, 'PG LAB', 'project title N/A', 'MSGadanya', '87F8A3'),
(127, 'CST/12/COM/00215', 'MUHAMMAD NAZIR SAID', 29, 'PG LAB', 'project title N/A', 'MAAhmad', 'C32ABD'),
(128, 'CST/12/COM/00217', 'ABDULLAHI ONIMISI SALAHUDEEN', 45, 'PG LAB', 'project title N/A', 'SMTanimu', '447159'),
(129, 'CST/12/COM/00218', 'AUWAL BELLO SALIHI', 40, 'PG LAB', 'project title N/A', 'SIlu', '606500'),
(130, 'CST/12/COM/00225', 'AMATULLAH MUHAMMAD SANUSI', 33, 'PG LAB', 'project title N/A', 'MBabagana', '1CE3D9'),
(131, 'CST/12/COM/00226', 'ABDULRASHEE  SHAIBU', 15, 'PG LAB', 'project title N/A', 'JZMaitama', 'EDA0CA'),
(132, 'CST/12/COM/00227', 'ILIASU  SHAIBU', 47, 'PG LAB', 'project title N/A', 'ASYahaya', '105D78'),
(133, 'CST/12/COM/00229', 'AISHA ABDULLAHI SHU''AIBU', 39, 'PG LAB', 'project title N/A', 'MSGadanya', 'B00ACE'),
(134, 'CST/12/COM/00230', 'MUHAMMAD ABUBAKAR SHUIBU', 22, 'PG LAB', 'project title N/A', 'MAAhmad', '516BE6'),
(135, 'CST/12/COM/00231', 'DAUDA  SIDI', 11, 'PG LAB', 'project title N/A', 'JAGaladanci', '627E7D'),
(136, 'CST/12/COM/00233', 'MUHAMMAD HAMZA SULAIMAN', 17, 'PG LAB', 'project title N/A', 'SKamal', '5959BE'),
(137, 'CST/12/COM/00235', 'ZAINAB HABU SULE', 65, 'PG LAB', 'project title N/A', 'HKAhmad', '238D05'),
(138, 'CST/12/COM/00236', 'FATIMA  SULEIMAN', 67, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ASAli', '499E90'),
(139, 'CST/12/COM/00237', 'HALIMA SADIYA SULEIMAN', 22, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'USHanga', 'F6FFDC'),
(140, 'CST/12/COM/00238', 'MUHAMMED ANAS SULEIMAN', 42, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SKamal', '33F4A9'),
(141, 'CST/12/COM/00243', 'ABDULRAHMAN  UMAR', 13, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SHMuhammad', '32988D'),
(142, 'CST/12/COM/00244', 'SULEIMAN  UMAR', 14, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'RARasheed', '324279'),
(143, 'CST/12/COM/00245', 'HAJARA IBRAHIM UMAR', 12, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'USHanga', '681165'),
(144, 'CST/12/COM/00247', 'MUAZU BELLO UMAR', 29, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MIMukhtar', 'C887E0'),
(145, 'CST/12/COM/00251', 'BELLO  USMAN', 6, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SAMuaz', 'D5B957'),
(146, 'CST/12/COM/00258', 'SAFIYANU ISAH YAHAYA', 44, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SMTanimu', 'FE9EAD'),
(147, 'CST/12/COM/00260', 'AISHA MUHAMMAD YAHYA', 3, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'JZMaitama', 'CC0BA6'),
(148, 'CST/12/COM/00262', 'AMINA ENYO YAKUBU', 54, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MAYusuf', 'BDE695'),
(149, 'CST/12/COM/00264', 'JUMMAI  YUNISA', 45, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MIMukhtar', 'B1C981'),
(150, 'CST/12/COM/00265', 'IBRAHIM  YUSUF', 41, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SHMuhammad', '0B38A2'),
(151, 'CST/12/COM/00266', 'ABDULMALIK SALAHUDEEN YUSUF', 20, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SMTanimu', '2ACC39'),
(152, 'CST/12/COM/00268', 'MUSTAPHA ABDULLAHI ZAHRADEEN', 65, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SKamal', '08E34A'),
(153, 'CST/12/COM/00270', 'ALIYU HARUNA ZUBAIRU', 63, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MSGadanya', '41E2B1'),
(154, 'CST/13/COM/00653', 'Sunusi Isa Abdullahi', 18, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'BSani', '27B5D4'),
(155, 'CST/13/COM/00654', 'Buhari Idris Abubakar', 11, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ASYahaya', 'B567DE'),
(156, 'CST/13/COM/00656', 'Elizabeth   Afolayan', 56, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'JAGaladanci', 'A41D80'),
(157, 'CST/13/COM/00658', 'Goodnews   Akobundu', 9, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ALawal', '9EA561'),
(158, 'CST/13/COM/00659', 'Nurat Aderonke Alasiri', 66, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MBabagana', '78C256'),
(159, 'CST/13/COM/00660', 'Sa''adatu Baba Aminu', 61, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AADatti', '3E0163'),
(160, 'CST/13/COM/00662', 'Haruna Adamu Babale', 28, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MAYusuf', '7CC81D'),
(161, 'CST/13/COM/00665', 'Esther Essien Benedict', 25, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'BSGaladanci', '38A080'),
(162, 'CST/13/COM/00669', 'Mohammed   Ibrahim', 33, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'BSani', '868D8D'),
(163, 'CST/13/COM/00672', 'Shafiu   Ibrahim', 60, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'HKAhmad', '7D19E5'),
(164, 'CST/13/COM/00675', 'Aliyu Abdullahi Isah', 46, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'BSani', '780F4E'),
(165, 'CST/13/COM/00676', 'Abraham Audu Itodo', 10, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SHMuhammad', 'D8EE6C'),
(166, 'CST/13/COM/00677', 'Mary   James', 37, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AHAbba', '40CC1D'),
(167, 'CST/13/COM/00681', 'Yusuf Suna Maje', 57, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MAYusuf', '67FCAE'),
(168, 'CST/13/COM/00683', 'Habib   Momohjimoh', 64, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SAMuaz', 'E563A8'),
(169, 'CST/13/COM/00685', 'Zainab Sulaiman Muhammad', 59, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'JZMaitama', '1DE619'),
(170, 'CST/13/COM/00686', 'Sadiya Saleh Muhammed', 68, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SIlu', 'D43C20'),
(171, 'CST/13/COM/00687', 'Farouk Abdullahi Musa', 38, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AHAbba', '290C97'),
(172, 'CST/13/COM/00688', 'Olawale Yusuph Mustapha', 51, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'BSani', '0AB336'),
(173, 'CST/13/COM/00689', 'Abdulfatahi Kailani Nasuru', 30, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AADatti', '6BE10F'),
(174, 'CST/13/COM/00690', 'Felicia   Ochiagha', 58, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AADatti', '7AD5C8'),
(175, 'CST/13/COM/00691', 'Opeyemi   Ojo', 40, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'JAGaladanci', 'DDF3ED'),
(176, 'CST/13/COM/00692', 'Damilola Muyideen Olajire', 7, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'HKAhmad', '9A5F90'),
(177, 'CST/13/COM/00693', 'Musa Mayowa Olumoh', 26, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SAMuaz', 'E2CF2F'),
(178, 'CST/13/COM/00695', 'Abdulmumuni   Salawu', 24, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MIMukhtar', 'DEA806'),
(179, 'CST/13/COM/00696', 'Salihu Alhassan Salihu', 16, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AHAbba', 'AC3457'),
(180, 'CST/13/COM/00697', 'Sumayya Mustapha Salim', 48, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'USHanga', '2DC7EB'),
(181, 'CST/13/COM/00698', 'Alheri T Samuel', 34, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'RARasheed', '8DCEA9'),
(182, 'CST/13/COM/00699', 'Abdulhakeem   Shehu', 62, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ASAli', '171E3D'),
(183, 'CST/13/COM/00700', 'Abubakar Sadiq Shittu', 4, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ASAli', '277D7E'),
(184, 'CST/13/COM/00702', 'Surajo Yusuf Surajo', 49, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'RARasheed', 'E5D882'),
(185, 'CST/13/COM/00704', 'Francis Terhemen Ugese', 15, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'JZMaitama', '944DCB'),
(186, 'CST/13/COM/00706', 'Amina Yusuf Umar', 35, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AHTata', '363075'),
(187, 'CST/13/COM/00707', 'Naziru   Umar', 50, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SKamal', '3F4178'),
(188, 'CST/13/COM/00708', 'Nizamaddeen   Umar', 32, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MSGadanya', '4C852D'),
(189, 'CST/13/COM/00709', 'Ibrahim   Usman', 39, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'JZMaitama', 'F45D99'),
(190, 'CST/13/COM/00710', 'Abiodun Olaniyi Yekeen', 21, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SHMuhammad', 'EF4A55'),
(191, 'CST/13/COM/00712', 'Abdulrahman  Yusuf', 5, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ALawal', '43A5AC'),
(192, 'CST/13/COM/00713', 'Hakibu   Babayo', 47, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SHMuhammad', 'A202A8'),
(193, 'CST/13/COM/00716', 'Nafiu Musa Muhammad', 27, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AHTata', 'ADE43B'),
(194, 'CST/13/COM/00717', 'Kemi Mary Ogunleye', 53, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AHTata', '9327D8'),
(195, 'CST/13/COM/00719', 'Sa''adatu Abdullahi Umar', 1, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MSGadanya', '65DA27'),
(196, 'CST/13/COM/00720', 'Babangida A Yakubu', 17, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MAYusuf', '099EC3'),
(197, 'SCI/11/COM/00961', 'Musa Buba Galadima', 55, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ALawal', 'DF2CBF'),
(198, 'SCI/11/COM/00916', 'Abubakar  Abdullahi', 2, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'AADatti', 'CDAD3B'),
(199, 'SCI/11/COM/00949', 'Abbas Said Badamasi', 8, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'USHanga', 'B9C902'),
(200, 'SCI/11/COM/00968', 'Hafsat Yusuf Ibrahim', 52, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'ASAli', '2C52F4'),
(201, 'SCI/11/COM/01005', 'Emmanuel Onimisi Samuel', 43, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MBabagana', 'E00811'),
(202, 'SCI/11/COM/01015', 'Faizaht Abdulfatah Tijjani', 19, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'BSGaladanci', 'EB0A64'),
(203, 'SCI/11/COM/01050', 'Hope  Ajabiowe', 31, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'SMTanimu', '9D72B0'),
(204, 'CST/12/COM/00180', 'IBRAHIM USMAN MUHAMMED', 23, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'MAYusuf', 'E822E8'),
(205, 'CST/12/COM/00267', 'Rahama Aliyu Yusuf', 36, 'FCSIT COMMITTEE ROOM', 'project title N/A', 'HKAhmad', 'B787C0');

-- --------------------------------------------------------

--
-- Table structure for table `gra_supervisor`
--

CREATE TABLE `gra_supervisor` (
  `id` int(11) NOT NULL,
  `stu_reg` varchar(20) DEFAULT NULL,
  `sup_email` varchar(65) DEFAULT NULL,
  `mark_1` varchar(5) DEFAULT NULL,
  `mark_2` varchar(11) DEFAULT NULL,
  `mark_3` varchar(11) DEFAULT NULL,
  `mark_4` varchar(11) DEFAULT NULL,
  `mark_5` varchar(11) DEFAULT NULL,
  `mark_6` varchar(11) DEFAULT NULL,
  `mark_7` varchar(11) DEFAULT NULL,
  `mark_8` varchar(11) DEFAULT NULL,
  `mark_9` varchar(11) DEFAULT NULL,
  `mark_10` varchar(11) DEFAULT NULL,
  `mark_total` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_account`
--

CREATE TABLE `lecturer_account` (
  `lecturer_id` int(11) NOT NULL,
  `lec_title` varchar(255) DEFAULT NULL,
  `lec_name` varchar(255) DEFAULT NULL,
  `lec_email` varchar(255) DEFAULT NULL,
  `lec_password` varchar(255) DEFAULT NULL,
  `assess_venue` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_account`
--

INSERT INTO `lecturer_account` (`lecturer_id`, `lec_title`, `lec_name`, `lec_email`, `lec_password`, `assess_venue`) VALUES
(1, 'Dr.', 'ALawal', 'alawal.it@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(2, 'Dr.', 'BSGaladanci', 'bsgaladanci.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(3, 'Dr.', 'MKMijinyawa', 'mkmijinyawa.it@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(4, 'Mal.', 'AHAbba', 'ahabba.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(5, 'Mal.', 'ASYahaya', 'asyahaya.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(6, 'Mal.', 'AADatti', 'aadatti.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(7, 'Mal.', 'ISAhmad', 'isahmad.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(8, 'Mal.', 'AHTata', 'ahtata.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(9, 'Mal.', 'ASAli', 'asali.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(10, 'Mal.', 'BSani', 'bsani.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(11, 'Mal.', 'BSBello', 'bsbello.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(12, 'Mal.', 'JZMaitama', 'jzmaitama.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(13, 'Mal.', 'JAGaladanci', 'jagaladanci.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(14, 'Mal.', 'MAYusuf', 'mayusuf.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(15, 'Mal.', 'MBabagana', 'mbabagana.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(16, 'Mal.', 'MSZubair', 'mszubair.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(17, 'Mal.', 'MUmar', 'mumar.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(18, 'Mal.', 'MSAbubakar', 'msabubakar.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(19, 'Mal.', 'MYusif', 'myusif.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(20, 'Mal.', 'SMTanimu', 'smtanimu.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(21, 'Mal.', 'SAKiri', 'sakiri.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(22, 'Mal.', 'SHMuhammad', 'shmuhammad.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(23, 'Mallama.', 'HAUmar', 'haumar.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(24, 'Mallama.', 'HKAhmad', 'hkahmad.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(25, 'Mallama.', 'NHAbubakar', 'nhabubabakar.it@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(26, 'Mal.', 'SMAliyu', 'smaliyu.cce@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(27, 'Mallama.', 'MSGadanya', 'msgadanya.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(28, 'Mal.', 'KHaruna', 'kharuna.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', ''),
(29, 'Mal.', 'MAAhmad', 'maahmad.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(30, 'Mallama.', 'MIMukhtar', 'mimukhtar.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LAB'),
(31, 'Mal.', 'RARasheed', 'rarasheed.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'PG LECTURE ROOM'),
(32, 'Mallama.', 'SAMuaz', 'samuaz.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(33, 'Mal.', 'SKamal', 'skamal.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(34, 'Mal.', 'USHanga', 'ushanga.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(35, 'Mallama.', 'SIlu', 'silu.se@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', 'FCSIT COMMITTEE ROOM'),
(36, 'Mr.', 'ExamOfficer', 'examofficer', 'e10adc3949ba59abbe56e057f20f883e', ''),
(37, 'Dr.', 'ABBaffa', 'abbaffa.cs@buk.edu.ng', 'e10adc3949ba59abbe56e057f20f883e', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gra_asessor`
--
ALTER TABLE `gra_asessor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gra_coord`
--
ALTER TABLE `gra_coord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gra_student`
--
ALTER TABLE `gra_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gra_supervisor`
--
ALTER TABLE `gra_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer_account`
--
ALTER TABLE `lecturer_account`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gra_asessor`
--
ALTER TABLE `gra_asessor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `gra_coord`
--
ALTER TABLE `gra_coord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gra_student`
--
ALTER TABLE `gra_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `gra_supervisor`
--
ALTER TABLE `gra_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lecturer_account`
--
ALTER TABLE `lecturer_account`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
