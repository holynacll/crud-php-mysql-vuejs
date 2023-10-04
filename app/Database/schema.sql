  CREATE TABLE IF NOT EXISTS `users` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  	`name` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
  	`cpf` CHAR(11) NOT NULL COLLATE 'utf8_general_ci',
    `sex` TINYINT(1) NOT NULL,
  	`active` TINYINT(1) NOT NULL DEFAULT 1,
  	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) COLLATE='utf8_general_ci' ENGINE=InnoDB AUTO_INCREMENT=1;


  CREATE TABLE IF NOT EXISTS `addresses` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  	`logradouro` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
  	`cep` CHAR(8) NOT NULL COLLATE 'utf8_general_ci',
    `bairro` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
  	`active` TINYINT(1) NOT NULL DEFAULT 1,
    `user_id` INT(11) NOT NULL,
  	`created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE
  ) COLLATE='utf8_general_ci'  ENGINE=InnoDB  AUTO_INCREMENT=1;
