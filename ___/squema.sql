CREATE TABLE `package` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` CHAR(50) DEFAULT NULL,
  `description` VARCHAR(250) DEFAULT NULL,
  `discount` DOUBLE(10,2) DEFAULT NULL,
  `config` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;


### PAYMENT
CREATE TABLE `payment` (

  `id` INT(11) NOT NULL AUTO_INCREMENT,

  `order_id` CHAR(20) DEFAULT NULL COMMENT 'codigo de recaudacion',

  `transaction_id` CHAR(20) DEFAULT NULL COMMENT 'DEVUELTO POR SINTESIS',

  `created_on` DATETIME NOT NULL,

  `status` ENUM('pending','completed','canceled','reversed') NOT NULL,

  `description` VARCHAR(250) DEFAULT NULL,

  `discount` DOUBLE(10,2) DEFAULT NULL,

  `user_id` INT(11) NOT NULL,

  `due_date` DATE DEFAULT NULL,

  `due_time` TIME DEFAULT NULL,

  `pay_date` DATETIME DEFAULT NULL COMMENT 'fecha de pago',

  `pay_ip` CHAR(30) DEFAULT NULL,

  `nit` CHAR(80) DEFAULT NULL,

  `nit_name` CHAR(255) DEFAULT NULL,

  `payment_response` TEXT COMMENT 'json encoded info from sintesis',

  `enviar_factura` INT(1) DEFAULT NULL,

  `type` ENUM('subscription','courtesy','rrhh') NOT NULL DEFAULT 'subscription',

  PRIMARY KEY (`id`),

  UNIQUE KEY `order_id` (`order_id`),

  KEY `created_on` (`created_on`),

  KEY `user_id` (`user_id`),

  KEY `type` (`type`)

) ENGINE=MYISAM AUTO_INCREMENT=10585 DEFAULT CHARSET=utf8;