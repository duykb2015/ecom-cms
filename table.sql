DROP DATABASE IF EXISTS `ecomercial`;

CREATE DATABASE `ecomercial`;

USE `ecomercial`;

CREATE TABLE `admin` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `userrname` VARCHAR(30) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `level` TINYINT(1) NOT NULL DEFAULT 1,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

--Tên của những cột trong table chưa thống nhất, có nên thêm tên table vào tên của cột?
CREATE TABLE `menu` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `parent_id` INT(4) NOT NULL DEFAULT 0,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `type` TINYINT(1) NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

CREATE TABLE `attribute` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `is_group` TINYINT(1) NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

--is_group: các sản phẩm cùng một mẫu mã thường có những thuộc tính chung, và một số thuộc tính riêng, trường này sẽ giúp phân loại ra thuộc tính nào chung thuộc tính nào riêng, thuộc tính chung sẽ được thêm vào cùng lúc với phần thêm mẫu mã sản phẩm, còn thuộc tính riêng sẽ được thêm ở phần thêm sản phẩm
CREATE TABLE `product_line` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

--product line: dòng sản phẩm, là các sản phẩm chung một dòng nhưng có một số điểm khác biệt (ví dụ như bộ nhớ trong, kích thước màn hình)
CREATE TABLE `product` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_line_id` INT(11) NOT NULL,
    `name` VARCHAR(2048) NOT NULL,
    `slug` VARCHAR(2048) NOT NULL,
    `additional_information` VARCHAR(2048) NULL,
    `product_support` VARCHAR(2048) NULL,
    `product_description` TEXT NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

ALTER TABLE
    `product`
ADD
    CONSTRAINT `fk_product_product_line` FOREIGN KEY (`product_line_id`) REFERENCES `product_line`(`id`);

CREATE TABLE `product_colors` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_id` INT(11) NOT NULL,
    `color_name` VARCHAR(255) NOT NULL,
    `color_price` VARCHAR(255) NOT NULL,
    `quantity` INT(11) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

ALTER TABLE
    `product_colors`
ADD
    CONSTRAINT `fk_product_colors_product` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

CREATE TABLE `product_images` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_id` INT(11) NOT NULL,
    `image_name` VARCHAR(255) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

ALTER TABLE
    `product_images`
ADD
    CONSTRAINT `fk_product_images_product` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

CREATE TABLE `attribute_value` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_line_id` INT(11) NOT NULL,
    `product_id` INT(11) NOT NULL,
    `attribute_id` INT(11) NOT NULL,
    `value` TEXT NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci;

ALTER TABLE
    `attribute_value`
ADD
    CONSTRAINT `fk_attribute_value_product_line` FOREIGN KEY (`product_line_id`) REFERENCES `product_line`(`id`);

ALTER TABLE
    `attribute_value`
ADD
    CONSTRAINT `fk_attribute_value_product` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

ALTER TABLE
    `attribute_value`
ADD
    CONSTRAINT `fk_attribute_value_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `attribute`(`id`);

INSERT INTO
    `admin` (`username`, `password`)
VALUES
    ('admin', MD5('1112'));