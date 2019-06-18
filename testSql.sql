

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecofriends`
--

-- --------------------------------------------------------

--
-- table structure `chargetypetbl`
--

DROP TABLE IF EXISTS `chargetypetbl`;
CREATE TABLE IF NOT EXISTS `chargetypetbl` (
  `type_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- table dump data `chargetypetbl`
--

INSERT INTO `chargetypetbl` (`type_id`, `type`) VALUES
(1, 'DC차데모+AC3상+DC콤보'),
(2, 'DC차데모+AC4상+DC콤보'),
(3, 'DC차데모+AC5상+DC콤보'),
(4, 'DC차데모+AC6상+DC콤보'),
(5, 'DC차데모+AC7상+DC콤보'),
(6, 'DC차데모+AC8상+DC콤보'),
(7, 'DC차데모+DC콤보'),
(8, 'DC차데모+AC3상'),
(9, 'DC차데모+AC단상'),
(10, 'AC3상+DC콤보'),
(11, 'DC차데모'),
(12, 'DC콤보'),
(13, 'AC3상'),
(14, 'AC단상'),
(15, 'AC완속'),
(16, NULL);

-- --------------------------------------------------------

--
-- table structure `citytbl`
--

DROP TABLE IF EXISTS `citytbl`;
CREATE TABLE IF NOT EXISTS `citytbl` (
  `city_id` int(11) UNSIGNED NOT NULL,
  `city_name` varchar(20) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- table dump data `citytbl`
--

INSERT INTO `citytbl` (`city_id`, `city_name`) VALUES
(1, '서울'),
(2, '경기'),
(3, '인천'),
(4, '강원'),
(5, '대전'),
(6, '세종'),
(7, '충북'),
(8, '충남'),
(9, '경북'),
(10, '경남'),
(11, '대구'),
(12, '부산'),
(13, '울산'),
(14, '광주'),
(15, '전북'),
(16, '전남'),
(17, '제주');

-- --------------------------------------------------------

--
-- table structure `favoritetbl`
--

DROP TABLE IF EXISTS `favoritetbl`;
CREATE TABLE IF NOT EXISTS `favoritetbl` (
  `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `u_id` int(11) UNSIGNED NOT NULL,
  `m_id` int(11) UNSIGNED NOT NULL,
  `f_status` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`f_id`),
  KEY `favoritetbl_ibfk_1` (`u_id`),
  KEY `favoritetbl_ibfk_2` (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- table dump data `favoritetbl`
--

INSERT INTO `favoritetbl` (`f_id`, `u_id`, `m_id`, `f_status`) VALUES
(1, 1, 26, 0),
(2, 1, 2218, 0),
(3, 1, 36, 0),
(4, 1, 32, 0),
(5, 1, 1341, 0);

-- --------------------------------------------------------

--
-- table dump data`maptbl`
--

DROP TABLE IF EXISTS `maptbl`;
CREATE TABLE IF NOT EXISTS `maptbl` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `address` varchar(100) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2219 DEFAULT CHARSET=utf8;

--
-- table dump data `maptbl`
--

INSERT INTO `maptbl` (`id`, `name`, `city_id`, `address`, `lat`, `lng`, `type_id`) VALUES
(1, '﻿DTC섬유박물관', 11, '대구광역시 동구 팔공로 227 지하1층 T6', 35.918980, 128.639969, 1),
(2, '갓바위공영3주차장', 11, '대구광역시 동구 갓바위로 227 입구 우측', 35.970798, 128.725891, 16),
(3, '갓바위공영5주차장', 11, '대구광역시 동구 진인동 123-38 입구 우측', 35.969379, 128.726059, 1),
(4, '국채보상운동기념공원주차장', 11, '대구광역시 중구 공평로10길 25 지하 1층 우측', 35.868862, 128.600296, 16),
(5, '논공읍 논공공단출장소', 11, '대구광역시 달성군 논공읍 논공중앙로 33길 3 입구 좌측', 35.729687, 128.453033, 1),
(6, '농수산물도매시장', 11, '대구광역시 북구 매천로18길 34 4문 좌측', 35.901646, 128.541824, 1),
(7, '달서구청', 11, '대구광역시 달서구 학산로 45 입구 좌측', 35.829735, 128.533020, 1),
(8, '달서시장공영주차장', 11, '대구광역시 달서구 당산로 32 입구 좌측', 35.840847, 128.543671, 16),
(9, '달성군청', 11, '대구광역시 달성군 논공읍 달성군청로 33 입구 우측', 35.773869, 128.430908, 1),
(10, '대구과학관', 11, '대구광역시 달성군 유가면 테크노대로6길 20 입구 좌측', 35.685200, 128.465866, 1),
(11, '대구도시철도공사', 11, '대구광역시 달서구 월배로 250 입구 좌측', 35.819733, 128.541138, 1),
(12, '대구시청', 11, '대구광역시 중구 공평로 88 입구 좌측', 35.871040, 128.601440, 1),
(13, '대구의료원', 11, '대구광역시 서구 평리로 157 입구 좌측', 35.859146, 128.541000, 1),
(14, '동구청', 11, '대구광역시 동구 아양로 207 입구 우측', 35.886497, 128.635956, 1),
(15, '동대구복합환승센터', 11, '대구광역시 동구 동부로 153 별관2층 D15-18', 35.878811, 128.631027, 1),
(16, '두류공원', 11, '대구광역시 달서구 공원순환로 216 입구 우측', 35.844715, 128.561737, 16),
(17, '대구환경공단(지산)', 11, '대구광역시 수성구 무학로 112 입구 좌측', 35.829678, 128.621429, 1),
(18, '매천역환승공영주차장', 11, '대구광역시 북구 태전동 881-10 입구 좌끝', 35.914310, 128.542709, 16),
(19, '북구청', 11, '대구광역시 북구 옥산로 65 입구 좌측', 35.885170, 128.582916, 1),
(20, '서구국민체육센터', 11, '대구광역시 서구 문화로 72 입구 좌측', 35.873173, 128.540588, 1),
(21, '서구청', 11, '대구광역시 서구 국채보상로 257 청사 후면', 35.871971, 128.558762, 1),
(22, '서문주차빌딩', 11, '대구광역시 중구 큰장로26길 45 3층 F 나', 35.868984, 128.581009, 1),
(23, '서부법원 앞', 11, '대구광역시 달서구 용산동 230-5 도로면', 35.851925, 128.525940, 16),
(24, '성서체육공원주차장', 11, '대구광역시 달서구 성서공단로22길 25 입구 좌측', 35.832249, 128.495132, 16),
(25, '성서홈플러스', 11, '대구광역시 달서구 달구벌대로 1467 지하4층 40', 35.849358, 128.526169, 1),
(26, '수성구청', 11, '대구광역시 수성구 달구벌대로 2450 입구 좌측', 35.858433, 128.631104, 1),
(27, '수성대학교 입구 우', 11, '대구광역시 수성구 달구벌대로 529길 도로면', 35.855827, 128.649933, 16),
(28, '수성대학교 입구 좌', 11, '대구광역시 수성구 달구벌대로 528길 도로면', 35.855770, 128.650055, 16),
(29, '시설안전관리사업소', 11, '대구광역시 달서구 성서공단로 58 입구 우측', 35.834557, 128.489288, 1),
(30, '시지근린공원', 11, '대구광역시 수성구 달구벌대로 637길 5 도로면', 35.843437, 128.706146, 16),
(31, '시청별관', 11, '대구광역시 북구 연암로 60 입구 우측', 35.890633, 128.597092, 1),
(32, '어린이회관', 11, '대구광역시 수성구 동대구로 176 입구 좌측', 35.846695, 128.625763, 16),
(33, '올브랜 주차장', 11, '대구광역시 북구 산격동 1671 입구 우측', 35.904503, 128.609467, 16),
(34, '외환들공영주차장', 11, '대구광역시 수성구 미술관로 40 주차장 하단부', 35.828747, 128.673996, 16),
(35, '율하체육공원3주차장', 11, '대구광역시 동구 금호강변로 278 입구 좌측', 35.859577, 128.699585, 1),
(36, '차량등록사업소', 11, '대구광역시 수성구 동원로 84 입구 우측', 35.866726, 128.639725, 1),
(37, '첨단의료산업진흥재단', 11, '대구광역시 동구 첨복로 80 입구 좌측', 35.878204, 128.736374, 1),
(38, '충전인프라 관제센터', 11, '대구광역시 서구 가르뱅이로10길 31 입구 정면', 35.885113, 128.531281, 1),
(39, '충혼탑 주차장', 11, '대구광역시 남구 앞산순환로 540 입구 좌측', 35.832848, 128.585373, 1),
(40, '패션센터 주차장', 11, '대구광역시 북구 유통단지로 14길 17 입구 우측', 35.905449, 128.611862, 1),
(41, '환경공단안심관리소', 11, '대구광역시 동구 금호강변로 91 입구 우측', 35.868572, 128.680862, 1),
(42, '반야월공영주차장', 11, '대구광역시 동구 신기동 174 입구 우측', 35.872288, 128.702026, 1),
(43, '대구환경공단(달서천)', 11, '대구광역시 서구 염색공단로 130 입구 좌측', 35.884411, 128.542191, 1),
(44, '상중이동행정복지센터', 11, '대구광역시 서구 중리동  1085-3 센터 뒤편', 35.866905, 128.545944, 1),
(45, '관음공영주차장', 11, '대구광역시 북구 관음중앙로 80 입구 좌측', 35.941097, 128.544693, 1),
(46, '복현장미공원', 11, '대구광역시 북구 경진로남1길  40 1층 주차장 진입 후 우측', 35.893394, 128.617584, 1),
(47, '대구 부광교회', 11, '대구광역시 북구 칠곡중앙대로52길38 입구 좌측', 35.922085, 128.548920, 1),
(48, '두산오거리(두산스포츠 북동편 도로면)', 11, '대구광역시 수성구 두산동 954-14 도로면', 35.827263, 128.625137, 16),
(49, '파동교네거리주차장', 11, '대구광역시 수성구 파동로  174 입구 우측', 35.809906, 128.618790, 1),
(50, '월광수변공원주차장', 11, '대구광역시 달서구 도원동 928 입구 좌측', 35.798733, 128.548767, 1),
(51, '대구환경공단(본부)', 11, '대구광역시 달서구 달서대로 210 입구 좌측', 35.820763, 128.495056, 1),
(52, '다사읍사무소', 11, '대구광역시 달성군 다사읍 매곡로 7 입구 좌측', 35.861904, 128.454285, 1),
(53, '달성군 농업기술센터', 11, '대구광역시 달성군 옥포면 비슬로 2040 입구 우측', 35.782558, 128.446884, 1),
(54, '문양역 야외주차장', 11, '대구광역시 달성군 다사읍 문양리  470 입구 좌측', 35.864006, 128.437943, 1),
(55, '비슬산자연휴양림공영주차장', 11, '대구광역시 달성군 유가면 휴양림길 236 입구 좌측', 35.693863, 128.505325, 1),
(56, '한국산업단지 달성출장소', 11, '대구광역시 달성군 구지면 달성2차동1로 109 입구 좌측', 35.640930, 128.419632, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `markers`
--

-- --------------------------------------------------------


DROP TABLE IF EXISTS `usertbl`;
CREATE TABLE IF NOT EXISTS `usertbl` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_pwd` varchar(100) NOT NULL,
  `user_cPwd` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


INSERT INTO `usertbl` (`user_id`, `user_email`, `user_name`, `user_pwd`, `user_cPwd`) VALUES
(1, 'ubd@n.com', '엄복동', '$2y$07$frwiNAZgdnMmrhrTF.DT0.ZexZ2YJBw1F.ZDNTeWFqIgVtNGP6Ape', '$2y$07$frwiNAZgdnMmrhrTF.DT0.ZexZ2YJBw1F.ZDNTeWFqIgVtNGP6Ape'),
(2, 'kim@n.com', '김길동', '$2y$07$BBJcWPO8Z9kj6RWcA9hOcOwAiSTi/Bjsd/mE.GAqaYsm5D5P5Nd9q', '$2y$07$BBJcWPO8Z9kj6RWcA9hOcOwAiSTi/Bjsd/mE.GAqaYsm5D5P5Nd9q');

ALTER TABLE `maptbl`
  ADD CONSTRAINT `maptbl_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `citytbl` (`city_id`),
  ADD CONSTRAINT `maptbl_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `chargetypetbl` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
