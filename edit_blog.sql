-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 26, 2023 lúc 05:43 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `edit_blog`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_categories`
--

CREATE TABLE `blog_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(100) NOT NULL,
  `category_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_categories`
--

INSERT INTO `blog_categories` (`category_id`, `category_name`, `category_description`, `category_date_created`) VALUES
(1, 'Design', 'Phân loại các phương pháp thiết kế', '2023-03-29 15:44:34'),
(2, 'Development', 'Phân loại các ngôn ngữ lập trình', '2023-03-29 16:47:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_comment`
--

CREATE TABLE `blog_comment` (
  `n_blog_comment_id` int(11) NOT NULL,
  `n_blog_comment_parent_id` int(11) NOT NULL,
  `n_blog_post_id` int(11) NOT NULL,
  `v_comment_author` varchar(50) NOT NULL,
  `v_comment_author_email` varchar(100) NOT NULL,
  `v_comment` varchar(500) NOT NULL,
  `d_date_created` date NOT NULL,
  `d_time_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_contact`
--

CREATE TABLE `blog_contact` (
  `c_contact_id` int(11) NOT NULL,
  `c_fullname` varchar(50) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_phone` varchar(50) NOT NULL,
  `c_message` text NOT NULL,
  `c_date_created` date NOT NULL,
  `c_contact_status` int(1) NOT NULL COMMENT '1-Inactive|2-Active|3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_contact`
--

INSERT INTO `blog_contact` (`c_contact_id`, `c_fullname`, `c_email`, `c_phone`, `c_message`, `c_date_created`, `c_contact_status`) VALUES
(16, 'Ngo Tan Hung', 'ngotanhung02011999@gmail.com', '0915625342', 'I really like Figma', '2023-04-25', 1),
(17, 'Hung Ngo', '21662006@kthcm.edu.vn', '0868881725', 'I want study PHP', '2023-04-25', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_post`
--

CREATE TABLE `blog_post` (
  `blog_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `blog_name` varchar(100) NOT NULL,
  `blog_summary` text NOT NULL,
  `blog_content` text NOT NULL,
  `blog_main_image` varchar(100) NOT NULL,
  `blog_alt_image` varchar(100) NOT NULL,
  `blog_place` int(1) NOT NULL COMMENT '0-Inactive|1-Active|2-Deleted',
  `blog_status` int(1) NOT NULL COMMENT '0-Inactive|1-Active|2-Deleted',
  `blog_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_post`
--

INSERT INTO `blog_post` (`blog_id`, `category_id`, `blog_name`, `blog_summary`, `blog_content`, `blog_main_image`, `blog_alt_image`, `blog_place`, `blog_status`, `blog_date_created`) VALUES
(47, 1, 'Website design with Figma is easy...', 'How to install and use figma from zero to hero', 'Figma agent runs an HTTP and HTTPS server on localhost. It only allows connections from figma.com and isn\'t exposed to the public internet.\r\n', 'figma.png', 'figma-alt.png', 1, 1, '2023-04-26 19:44:02'),
(48, 2, 'Web programming with PHP...', 'Learn about the PHP programming language', 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.', 'php.png', 'php-alt.png', 2, 1, '2023-04-26 19:29:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_subscriber`
--

CREATE TABLE `blog_subscriber` (
  `s_sub_id` int(11) NOT NULL,
  `s_sub_email` varchar(50) NOT NULL,
  `s_date_created` date NOT NULL,
  `s_sub_status` int(1) NOT NULL COMMENT '1-Inactive|2-Active|3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_subscriber`
--

INSERT INTO `blog_subscriber` (`s_sub_id`, `s_sub_email`, `s_date_created`, `s_sub_status`) VALUES
(9, 'ngotanhung02011999@gmail.com', '2023-04-25', 1),
(12, '21662006@kthcm.edu.vn', '2023-04-26', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_tags`
--

CREATE TABLE `blog_tags` (
  `n_tag_id` int(11) NOT NULL,
  `n_blog_post_id` int(11) NOT NULL,
  `v_tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_user`
--

CREATE TABLE `blog_user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_infor` varchar(100) NOT NULL,
  `user_date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_user`
--

INSERT INTO `blog_user` (`user_id`, `user_email`, `user_password`, `user_fullname`, `user_phone`, `user_image`, `user_infor`, `user_date_created`) VALUES
(4, 'ngotanhung02011999@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Ngo Tan Hung', '0915625342', 'user-01.jpg', 'I am a student majoring in IT at the College of Economics in Ho Chi Minh City.', '2023-04-26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`n_blog_comment_id`);

--
-- Chỉ mục cho bảng `blog_contact`
--
ALTER TABLE `blog_contact`
  ADD PRIMARY KEY (`c_contact_id`);

--
-- Chỉ mục cho bảng `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`blog_id`);

--
-- Chỉ mục cho bảng `blog_subscriber`
--
ALTER TABLE `blog_subscriber`
  ADD PRIMARY KEY (`s_sub_id`);

--
-- Chỉ mục cho bảng `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`n_tag_id`);

--
-- Chỉ mục cho bảng `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `n_blog_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_contact`
--
ALTER TABLE `blog_contact`
  MODIFY `c_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `blog_subscriber`
--
ALTER TABLE `blog_subscriber`
  MODIFY `s_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `n_tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
