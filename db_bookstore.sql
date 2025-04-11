-- Database: `db_bookstore`
DROP DATABASE IF EXISTS `db_bookstore`;
CREATE DATABASE `db_bookstore` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_bookstore`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Table `address`
CREATE TABLE `address` (
  `address_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`address_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `admin`
CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `book`
CREATE TABLE `book` (
  `book_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `author` varchar(100) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `publisher` varchar(100) NOT NULL DEFAULT 'Kim Đồng',
  `stock` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`book_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `cart`
CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cart_id`),
  KEY `customer_id` (`customer_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `category`
CREATE TABLE `category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `contain`
CREATE TABLE `contain` (
  `contain_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`contain_id`),
  KEY `order_id` (`order_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `customer`
CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL UNIQUE,
  `pass` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `verify_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `order`
CREATE TABLE `order` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `cost` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Processing, 2: Completed',
  `payment_method` varchar(50) NOT NULL,
  `oder_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `rate`
CREATE TABLE `rate` (
  `customer_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `comment` text DEFAULT NULL,
  KEY `customer_id` (`customer_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data
INSERT INTO `admin` (`email`, `password`, `name`) VALUES
('admin1@gmail.com', '123456', 'Nguyễn Văn A'),
('admin2@gmail.com', 'abcdef', 'Trần Thị B');

INSERT INTO `category` (`name`) VALUES
('Tiểu Thuyết'), ('Sách Kỹ Năng'), ('Thiếu Nhi'), ('Sách Ngoại Văn');
INSERT INTO `book` (`book_id`, `name`, `description`, `price`, `author`, `cover_image`, `category_id`, `publisher`, `stock`) VALUES
(1, 'Đắc Nhân Tâm', 'Sách hay về kỹ năng sống', 80000.00, 'Dale Carnegie', 'https://th.bing.com/th/id/OIP.cUYVV92koOJ_3HFiDfTDggHaK1?rs=1&pid=ImgDetMain', 2, 'NXB Trẻ', 50),
(2, 'Doraemon Tập 1', 'Truyện tranh thiếu nhi', 20000.00, 'Fujiko F. Fujio', 'https://th.bing.com/th/id/R.11227f9548eef97e4de838045e32d738?rik=Cdtbxi0nmFYxmA&riu=http%3a%2f%2fwww.pixelstalk.net%2fwp-content%2fuploads%2f2016%2f10%2fDoraemon-wallpaper-for-desktop.jpg&ehk=Wa3aQF%2b4c33lXV4j2W8O1%2bWkeF3hzkTeUJW%2faVBhMYw%3d&risl=&pid=ImgRaw&r=0', 3, 'Kim Đồng', 100),
(3, 'Harry Potter và Hòn đá phù thủy', 'Tiểu thuyết giả tưởng', 120000.00, 'J.K. Rowling', 'https://th.bing.com/th/id/OIP.6r4yWt-AVP-LzA9Pv5Qg7AHaEK?rs=1&pid=ImgDetMain', 4, 'NXB Trẻ', 30),
(5, 'a', 'a', 123.00, 'a', 'https://demoda.vn/wp-content/uploads/2022/02/anh-anh-da-den-cuoi.jpg', 1, 'a', 0);

-- Foreign Keys
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE;

ALTER TABLE `contain`
  ADD CONSTRAINT `fk_contain_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_contain_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fk_order_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

ALTER TABLE `rate`
  ADD CONSTRAINT `fk_rate_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rate_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE;
