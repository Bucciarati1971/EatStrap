-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-06-14 20:42:39
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `phpboard`
--

-- --------------------------------------------------------

--
-- 資料表結構 `board`
--

CREATE TABLE `board` (
  `boardid` int(11) UNSIGNED NOT NULL,
  `boardname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardsex` enum('男','女') COLLATE utf8_unicode_ci DEFAULT '男',
  `boardsubject` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardtime` datetime DEFAULT NULL,
  `boardmail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardweb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardcontent` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `board`
--

INSERT INTO `board` (`boardid`, `boardname`, `boardsex`, `boardsubject`, `boardtime`, `boardmail`, `boardweb`, `boardcontent`) VALUES
(1, '茶米', '男', '這是第一則留言', '2016-10-16 11:25:30', 'david@e-happy.com.tw', 'http://www.e-happy.com.tw', '這是茶米的第一則留言！'),
(14, '大總統', '男', '瓦倫泰', '2020-06-15 02:25:54', '', '', '吾心吾行澄如明鏡...... !\r\n所做所為均是「正義」!'),
(15, '阿利嘎多', '男', '喬尼 喬斯達', '2020-06-15 02:33:11', '', '', '抱歉...抱歉...我很想相信他，我真的...很想相信總統...再見了，傑洛....再見...'),
(16, '普奇', '男', '內心多年的疑惑', '2020-06-15 02:34:35', '', '', '對人類而言，對別人略施小惠，無非是希望將來能收到「回報」。\r\n對一個人好，就是希望那個人也對自己好， 世界上沒有不求回報的付出。\r\n即使真有人「不求回報」……那也是希望自己將來死後「靈魂能上天堂」。'),
(17, '喬魯諾。喬巴那', '男', '黃金之風', '2020-06-15 02:35:21', '', '', '我喬魯諾喬巴那，有一個夢想！！'),
(18, '黃金色波紋疾走！', '男', '喬納森 喬斯達', '2020-06-15 02:35:54', '', '', '我的心在劇烈震顫，\r\n像燃燒殆盡一般熾熱！\r\n喔喔喔…銘刻吧，血液的律動！\r\n'),
(20, '喬瑟夫 • 喬斯達', '男', '討厭', '2020-06-15 02:41:10', '', '', '我最討厭的兩個詞就是\\\"努力\\\"和\\\"加油\\\"'),
(21, '普羅修特', '男', '大哥', '2020-06-15 02:41:47', '', '', '我們這小組，跟那些喊著「殺啊」，「殺啊」，彼此安慰的喪家之犬不同!!\r\n當我們心中想著「殺」這個字的時候，事實上已經把對方殺死了!!');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`boardid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board`
--
ALTER TABLE `board`
  MODIFY `boardid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
