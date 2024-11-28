CREATE TABLE `defaultdb`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(225) NOT NULL,
  `content` VARCHAR(225) NOT NULL,
  `category_id` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`));