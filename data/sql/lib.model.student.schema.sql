
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sch_person
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_person`;


CREATE TABLE `sch_person`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_attribute
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_attribute`;


CREATE TABLE `sch_attribute`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`key` VARCHAR(250)  NOT NULL,
	`value` VARCHAR(250)  NOT NULL,
	`label` TEXT  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`person_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_attribute_FI_1` (`person_id`),
	CONSTRAINT `sch_attribute_FK_1`
		FOREIGN KEY (`person_id`)
		REFERENCES `sch_person` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_student
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_student`;


CREATE TABLE `sch_student`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`first_name` VARCHAR(100)  NOT NULL,
	`father_name` VARCHAR(100)  NOT NULL,
	`mother_name` VARCHAR(100)  NOT NULL,
	`rude` VARCHAR(100)  NOT NULL,
	`codigo` CHAR(30)  NOT NULL,
	`birth_date` DATETIME,
	`email` VARCHAR(100)  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`person_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_student_FI_1` (`person_id`),
	CONSTRAINT `sch_student_FK_1`
		FOREIGN KEY (`person_id`)
		REFERENCES `sch_person` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_type_tutor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_type_tutor`;


CREATE TABLE `sch_type_tutor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_tutor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_tutor`;


CREATE TABLE `sch_tutor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`first_name` VARCHAR(100)  NOT NULL,
	`father_name` VARCHAR(100)  NOT NULL,
	`mother_name` VARCHAR(100)  NOT NULL,
	`ci` CHAR(20)  NOT NULL,
	`languaje` VARCHAR(100)  NOT NULL,
	`occupation` VARCHAR(100)  NOT NULL,
	`degree` VARCHAR(100)  NOT NULL,
	`email` VARCHAR(100)  NOT NULL,
	`type_tutor_id` INTEGER  NOT NULL,
	`person_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_tutor_FI_1` (`type_tutor_id`),
	CONSTRAINT `sch_tutor_FK_1`
		FOREIGN KEY (`type_tutor_id`)
		REFERENCES `sch_type_tutor` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_tutor_FI_2` (`person_id`),
	CONSTRAINT `sch_tutor_FK_2`
		FOREIGN KEY (`person_id`)
		REFERENCES `sch_person` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_question
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_question`;


CREATE TABLE `sch_question`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`question` VARCHAR(255)  NOT NULL,
	`reply` VARCHAR(255)  NOT NULL,
	`label` TEXT  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`contract_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_question_FI_1` (`contract_id`),
	CONSTRAINT `sch_question_FK_1`
		FOREIGN KEY (`contract_id`)
		REFERENCES `sch_contract` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_period
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_period`;


CREATE TABLE `sch_period`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`from_date` DATETIME,
	`to_date` DATETIME,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_contract
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_contract`;


CREATE TABLE `sch_contract`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`nro` CHAR(20),
	`amount` FLOAT,
	`container` TEXT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`description` TEXT,
	`record_date` DATETIME,
	`city` VARCHAR(100)  NOT NULL,
	`period_id` INTEGER  NOT NULL,
	`student_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_contract_FI_1` (`period_id`),
	CONSTRAINT `sch_contract_FK_1`
		FOREIGN KEY (`period_id`)
		REFERENCES `sch_period` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_contract_FI_2` (`student_id`),
	CONSTRAINT `sch_contract_FK_2`
		FOREIGN KEY (`student_id`)
		REFERENCES `sch_student` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_attribute_contract
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_attribute_contract`;


CREATE TABLE `sch_attribute_contract`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`key` VARCHAR(250)  NOT NULL,
	`value` VARCHAR(250)  NOT NULL,
	`label` TEXT  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`contract_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_attribute_contract_FI_1` (`contract_id`),
	CONSTRAINT `sch_attribute_contract_FK_1`
		FOREIGN KEY (`contract_id`)
		REFERENCES `sch_contract` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_account
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_account`;


CREATE TABLE `sch_account`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`number` TINYINT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`contract_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_account_FI_1` (`contract_id`),
	CONSTRAINT `sch_account_FK_1`
		FOREIGN KEY (`contract_id`)
		REFERENCES `sch_contract` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_student_tutor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_student_tutor`;


CREATE TABLE `sch_student_tutor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`student_id` INTEGER  NOT NULL,
	`tutor_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_student_tutor_FI_1` (`student_id`),
	CONSTRAINT `sch_student_tutor_FK_1`
		FOREIGN KEY (`student_id`)
		REFERENCES `sch_student` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_student_tutor_FI_2` (`tutor_id`),
	CONSTRAINT `sch_student_tutor_FK_2`
		FOREIGN KEY (`tutor_id`)
		REFERENCES `sch_tutor` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_degree
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_degree`;


CREATE TABLE `sch_degree`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_timetable
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_timetable`;


CREATE TABLE `sch_timetable`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_curso
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_curso`;


CREATE TABLE `sch_curso`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_paralelo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_paralelo`;


CREATE TABLE `sch_paralelo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_grade
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_grade`;


CREATE TABLE `sch_grade`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`degree_id` INTEGER  NOT NULL,
	`timetable_id` INTEGER  NOT NULL,
	`curso_id` INTEGER  NOT NULL,
	`paralelo_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_grade_FI_1` (`degree_id`),
	CONSTRAINT `sch_grade_FK_1`
		FOREIGN KEY (`degree_id`)
		REFERENCES `sch_degree` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_grade_FI_2` (`timetable_id`),
	CONSTRAINT `sch_grade_FK_2`
		FOREIGN KEY (`timetable_id`)
		REFERENCES `sch_timetable` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_grade_FI_3` (`curso_id`),
	CONSTRAINT `sch_grade_FK_3`
		FOREIGN KEY (`curso_id`)
		REFERENCES `sch_curso` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_grade_FI_4` (`paralelo_id`),
	CONSTRAINT `sch_grade_FK_4`
		FOREIGN KEY (`paralelo_id`)
		REFERENCES `sch_paralelo` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_subject
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_subject`;


CREATE TABLE `sch_subject`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_teacher
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_teacher`;


CREATE TABLE `sch_teacher`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`first_name` VARCHAR(100)  NOT NULL,
	`last_name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_grade_subject
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_grade_subject`;


CREATE TABLE `sch_grade_subject`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`grade_id` INTEGER  NOT NULL,
	`subject_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_grade_subject_FI_1` (`grade_id`),
	CONSTRAINT `sch_grade_subject_FK_1`
		FOREIGN KEY (`grade_id`)
		REFERENCES `sch_grade` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_grade_subject_FI_2` (`subject_id`),
	CONSTRAINT `sch_grade_subject_FK_2`
		FOREIGN KEY (`subject_id`)
		REFERENCES `sch_subject` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_grade_subject_period
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_grade_subject_period`;


CREATE TABLE `sch_grade_subject_period`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`grade_subject_id` INTEGER  NOT NULL,
	`period_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_grade_subject_period_FI_1` (`grade_subject_id`),
	CONSTRAINT `sch_grade_subject_period_FK_1`
		FOREIGN KEY (`grade_subject_id`)
		REFERENCES `sch_grade_subject` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_grade_subject_period_FI_2` (`period_id`),
	CONSTRAINT `sch_grade_subject_period_FK_2`
		FOREIGN KEY (`period_id`)
		REFERENCES `sch_period` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_grade_subject_period_teacher
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_grade_subject_period_teacher`;


CREATE TABLE `sch_grade_subject_period_teacher`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`grade_subject_period_id` INTEGER  NOT NULL,
	`teacher_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_grade_subject_period_teacher_FI_1` (`grade_subject_period_id`),
	CONSTRAINT `sch_grade_subject_period_teacher_FK_1`
		FOREIGN KEY (`grade_subject_period_id`)
		REFERENCES `sch_grade_subject_period` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_grade_subject_period_teacher_FI_2` (`teacher_id`),
	CONSTRAINT `sch_grade_subject_period_teacher_FK_2`
		FOREIGN KEY (`teacher_id`)
		REFERENCES `sch_teacher` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_classroom
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_classroom`;


CREATE TABLE `sch_classroom`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`grade_subject_period_id` INTEGER  NOT NULL,
	`account_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_classroom_FI_1` (`grade_subject_period_id`),
	CONSTRAINT `sch_classroom_FK_1`
		FOREIGN KEY (`grade_subject_period_id`)
		REFERENCES `sch_grade_subject_period` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_classroom_FI_2` (`account_id`),
	CONSTRAINT `sch_classroom_FK_2`
		FOREIGN KEY (`account_id`)
		REFERENCES `sch_account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_business_entity
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_business_entity`;


CREATE TABLE `sch_business_entity`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`server_name` VARCHAR(100)  NOT NULL,
	`connection` VARCHAR(100)  NOT NULL,
	`night_audit_hour` INTEGER  NOT NULL,
	`night_audit_overtime` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_night_audit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_night_audit`;


CREATE TABLE `sch_night_audit`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`date` DATETIME  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`business_entity_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_night_audit_FI_1` (`user_id`),
	CONSTRAINT `sch_night_audit_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_night_audit_FI_2` (`business_entity_id`),
	CONSTRAINT `sch_night_audit_FK_2`
		FOREIGN KEY (`business_entity_id`)
		REFERENCES `sch_business_entity` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_cashbox
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_cashbox`;


CREATE TABLE `sch_cashbox`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`closing_date` DATETIME,
	`comment` TEXT,
	`superviser_id` INTEGER,
	`cashier_id` INTEGER  NOT NULL,
	`night_audit_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_cashbox_FI_1` (`cashier_id`),
	CONSTRAINT `sch_cashbox_FK_1`
		FOREIGN KEY (`cashier_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_cashbox_FI_2` (`night_audit_id`),
	CONSTRAINT `sch_cashbox_FK_2`
		FOREIGN KEY (`night_audit_id`)
		REFERENCES `sch_night_audit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_form_of_payment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_form_of_payment`;


CREATE TABLE `sch_form_of_payment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_currency
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_currency`;


CREATE TABLE `sch_currency`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`exchange_rate` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_currency_price
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_currency_price`;


CREATE TABLE `sch_currency_price`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`reference` VARCHAR(100)  NOT NULL,
	`sale` FLOAT  NOT NULL,
	`purchase` FLOAT  NOT NULL,
	`since_date` DATETIME  NOT NULL,
	`until_date` DATETIME  NOT NULL,
	`currency_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_currency_price_FI_1` (`currency_id`),
	CONSTRAINT `sch_currency_price_FK_1`
		FOREIGN KEY (`currency_id`)
		REFERENCES `sch_currency` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_currency_price_FI_2` (`user_id`),
	CONSTRAINT `sch_currency_price_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_payment_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_payment_type`;


CREATE TABLE `sch_payment_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`user_name` TINYINT,
	`number` TINYINT,
	`document` TINYINT,
	`comment` TINYINT,
	`address` TINYINT,
	`validity` TINYINT,
	`cvv_code` TINYINT,
	`sales_check` TINYINT,
	`accounting_record` TINYINT,
	`currency_id` INTEGER  NOT NULL,
	`form_of_payment_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_payment_type_FI_1` (`currency_id`),
	CONSTRAINT `sch_payment_type_FK_1`
		FOREIGN KEY (`currency_id`)
		REFERENCES `sch_currency` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_payment_type_FI_2` (`form_of_payment_id`),
	CONSTRAINT `sch_payment_type_FK_2`
		FOREIGN KEY (`form_of_payment_id`)
		REFERENCES `sch_form_of_payment` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_movement_cashbox
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_movement_cashbox`;


CREATE TABLE `sch_movement_cashbox`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`sum` FLOAT,
	`cashbox_id` INTEGER  NOT NULL,
	`currency_price_id` INTEGER  NOT NULL,
	`payment_type_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_movement_cashbox_FI_1` (`cashbox_id`),
	CONSTRAINT `sch_movement_cashbox_FK_1`
		FOREIGN KEY (`cashbox_id`)
		REFERENCES `sch_cashbox` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_FI_2` (`currency_price_id`),
	CONSTRAINT `sch_movement_cashbox_FK_2`
		FOREIGN KEY (`currency_price_id`)
		REFERENCES `sch_currency_price` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_FI_3` (`payment_type_id`),
	CONSTRAINT `sch_movement_cashbox_FK_3`
		FOREIGN KEY (`payment_type_id`)
		REFERENCES `sch_payment_type` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_payment_information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_payment_information`;


CREATE TABLE `sch_payment_information`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`user_name` VARCHAR(50),
	`number` VARCHAR(20),
	`comment` TEXT,
	`address` TEXT,
	`validity` DATETIME,
	`cvv_code` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_movement_cashbox_pay_inf
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_movement_cashbox_pay_inf`;


CREATE TABLE `sch_movement_cashbox_pay_inf`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`movement_cashbox_id` INTEGER  NOT NULL,
	`payment_information_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_movement_cashbox_pay_inf_FI_1` (`movement_cashbox_id`),
	CONSTRAINT `sch_movement_cashbox_pay_inf_FK_1`
		FOREIGN KEY (`movement_cashbox_id`)
		REFERENCES `sch_movement_cashbox` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_pay_inf_FI_2` (`payment_information_id`),
	CONSTRAINT `sch_movement_cashbox_pay_inf_FK_2`
		FOREIGN KEY (`payment_information_id`)
		REFERENCES `sch_payment_information` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_type_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_type_item`;


CREATE TABLE `sch_type_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_item`;


CREATE TABLE `sch_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100),
	`description` TEXT,
	`price` FLOAT,
	`alter_price` TINYINT,
	`quantity_load` TINYINT,
	`name_load` TEXT,
	`type_item_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_item_FI_1` (`type_item_id`),
	CONSTRAINT `sch_item_FK_1`
		FOREIGN KEY (`type_item_id`)
		REFERENCES `sch_type_item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_sales
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_sales`;


CREATE TABLE `sch_sales`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`number` INTEGER,
	`cashier_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_sales_FI_1` (`cashier_id`),
	CONSTRAINT `sch_sales_FK_1`
		FOREIGN KEY (`cashier_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_item_for_sale
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_item_for_sale`;


CREATE TABLE `sch_item_for_sale`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100),
	`quantity` INTEGER,
	`price` FLOAT,
	`discount` FLOAT,
	`discount_name` VARCHAR(100),
	`deleted` INTEGER,
	`sales_id` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`additional_information` TEXT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_item_for_sale_FI_1` (`sales_id`),
	CONSTRAINT `sch_item_for_sale_FK_1`
		FOREIGN KEY (`sales_id`)
		REFERENCES `sch_sales` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_item_for_sale_FI_2` (`item_id`),
	CONSTRAINT `sch_item_for_sale_FK_2`
		FOREIGN KEY (`item_id`)
		REFERENCES `sch_item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_sale_account
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_sale_account`;


CREATE TABLE `sch_sale_account`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`amount` FLOAT,
	`sales_id` INTEGER  NOT NULL,
	`account_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_sale_account_FI_1` (`sales_id`),
	CONSTRAINT `sch_sale_account_FK_1`
		FOREIGN KEY (`sales_id`)
		REFERENCES `sch_sales` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_sale_account_FI_2` (`account_id`),
	CONSTRAINT `sch_sale_account_FK_2`
		FOREIGN KEY (`account_id`)
		REFERENCES `sch_account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_deposit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_deposit`;


CREATE TABLE `sch_deposit`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`amount` FLOAT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`comment` TEXT,
	`discount` FLOAT,
	`cashier_id` INTEGER  NOT NULL,
	`currency_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_deposit_FI_1` (`cashier_id`),
	CONSTRAINT `sch_deposit_FK_1`
		FOREIGN KEY (`cashier_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_deposit_FI_2` (`currency_id`),
	CONSTRAINT `sch_deposit_FK_2`
		FOREIGN KEY (`currency_id`)
		REFERENCES `sch_currency` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_sales_deposit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_sales_deposit`;


CREATE TABLE `sch_sales_deposit`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`amount` FLOAT,
	`sales_id` INTEGER  NOT NULL,
	`deposit_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_sales_deposit_FI_1` (`sales_id`),
	CONSTRAINT `sch_sales_deposit_FK_1`
		FOREIGN KEY (`sales_id`)
		REFERENCES `sch_sales` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_sales_deposit_FI_2` (`deposit_id`),
	CONSTRAINT `sch_sales_deposit_FK_2`
		FOREIGN KEY (`deposit_id`)
		REFERENCES `sch_deposit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_account_deposit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_account_deposit`;


CREATE TABLE `sch_account_deposit`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`amount` FLOAT,
	`account_id` INTEGER  NOT NULL,
	`deposit_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_account_deposit_FI_1` (`account_id`),
	CONSTRAINT `sch_account_deposit_FK_1`
		FOREIGN KEY (`account_id`)
		REFERENCES `sch_account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_account_deposit_FI_2` (`deposit_id`),
	CONSTRAINT `sch_account_deposit_FK_2`
		FOREIGN KEY (`deposit_id`)
		REFERENCES `sch_deposit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_movement_cashbox_deposit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_movement_cashbox_deposit`;


CREATE TABLE `sch_movement_cashbox_deposit`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`movement_cashbox_id` INTEGER  NOT NULL,
	`deposit_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_movement_cashbox_deposit_FI_1` (`movement_cashbox_id`),
	CONSTRAINT `sch_movement_cashbox_deposit_FK_1`
		FOREIGN KEY (`movement_cashbox_id`)
		REFERENCES `sch_movement_cashbox` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_deposit_FI_2` (`deposit_id`),
	CONSTRAINT `sch_movement_cashbox_deposit_FK_2`
		FOREIGN KEY (`deposit_id`)
		REFERENCES `sch_deposit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_movement_cashbox_sales
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_movement_cashbox_sales`;


CREATE TABLE `sch_movement_cashbox_sales`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`movement_cashbox_id` INTEGER  NOT NULL,
	`sales_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_movement_cashbox_sales_FI_1` (`movement_cashbox_id`),
	CONSTRAINT `sch_movement_cashbox_sales_FK_1`
		FOREIGN KEY (`movement_cashbox_id`)
		REFERENCES `sch_movement_cashbox` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_sales_FI_2` (`sales_id`),
	CONSTRAINT `sch_movement_cashbox_sales_FK_2`
		FOREIGN KEY (`sales_id`)
		REFERENCES `sch_sales` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_receipt
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_receipt`;


CREATE TABLE `sch_receipt`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`total` FLOAT,
	`total_net` FLOAT,
	`night_audit_id` INTEGER  NOT NULL,
	`discount` FLOAT,
	`service` FLOAT,
	`canceled` TINYINT,
	`printed` TINYINT,
	`comment` TEXT,
	`name` VARCHAR(100),
	`nit` VARCHAR(12),
	`telefon` VARCHAR(12),
	`additional_information` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_by` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sch_receipt_FI_1` (`night_audit_id`),
	CONSTRAINT `sch_receipt_FK_1`
		FOREIGN KEY (`night_audit_id`)
		REFERENCES `sch_night_audit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_movement_cashbox_receipt
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_movement_cashbox_receipt`;


CREATE TABLE `sch_movement_cashbox_receipt`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`movement_cashbox_id` INTEGER  NOT NULL,
	`receipt_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_by` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sch_movement_cashbox_receipt_FI_1` (`movement_cashbox_id`),
	CONSTRAINT `sch_movement_cashbox_receipt_FK_1`
		FOREIGN KEY (`movement_cashbox_id`)
		REFERENCES `sch_movement_cashbox` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_receipt_FI_2` (`receipt_id`),
	CONSTRAINT `sch_movement_cashbox_receipt_FK_2`
		FOREIGN KEY (`receipt_id`)
		REFERENCES `sch_receipt` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_discount
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_discount`;


CREATE TABLE `sch_discount`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100),
	`discount` FLOAT,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_by` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_discount_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_discount_item`;


CREATE TABLE `sch_discount_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`discount_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_by` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sch_discount_item_FI_1` (`item_id`),
	CONSTRAINT `sch_discount_item_FK_1`
		FOREIGN KEY (`item_id`)
		REFERENCES `sch_item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_discount_item_FI_2` (`discount_id`),
	CONSTRAINT `sch_discount_item_FK_2`
		FOREIGN KEY (`discount_id`)
		REFERENCES `sch_discount` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_item_grade
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_item_grade`;


CREATE TABLE `sch_item_grade`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`grade_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_by` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sch_item_grade_FI_1` (`item_id`),
	CONSTRAINT `sch_item_grade_FK_1`
		FOREIGN KEY (`item_id`)
		REFERENCES `sch_item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_item_grade_FI_2` (`grade_id`),
	CONSTRAINT `sch_item_grade_FK_2`
		FOREIGN KEY (`grade_id`)
		REFERENCES `sch_grade` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_discount_contract
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_discount_contract`;


CREATE TABLE `sch_discount_contract`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`contract_id` INTEGER  NOT NULL,
	`discount_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_by` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sch_discount_contract_FI_1` (`contract_id`),
	CONSTRAINT `sch_discount_contract_FK_1`
		FOREIGN KEY (`contract_id`)
		REFERENCES `sch_contract` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_discount_contract_FI_2` (`discount_id`),
	CONSTRAINT `sch_discount_contract_FK_2`
		FOREIGN KEY (`discount_id`)
		REFERENCES `sch_discount` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_contract_grade
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_contract_grade`;


CREATE TABLE `sch_contract_grade`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`contract_id` INTEGER  NOT NULL,
	`grade_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_contract_grade_FI_1` (`contract_id`),
	CONSTRAINT `sch_contract_grade_FK_1`
		FOREIGN KEY (`contract_id`)
		REFERENCES `sch_contract` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_contract_grade_FI_2` (`grade_id`),
	CONSTRAINT `sch_contract_grade_FK_2`
		FOREIGN KEY (`grade_id`)
		REFERENCES `sch_grade` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_transfer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_transfer`;


CREATE TABLE `sch_transfer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`amount` FLOAT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`comment` TEXT,
	`type` TINYINT  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sch_transfer_FI_1` (`user_id`),
	CONSTRAINT `sch_transfer_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_movement_cashbox_transfer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_movement_cashbox_transfer`;


CREATE TABLE `sch_movement_cashbox_transfer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`movement_cashbox_id` INTEGER  NOT NULL,
	`transfer_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_movement_cashbox_transfer_FI_1` (`movement_cashbox_id`),
	CONSTRAINT `sch_movement_cashbox_transfer_FK_1`
		FOREIGN KEY (`movement_cashbox_id`)
		REFERENCES `sch_movement_cashbox` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_movement_cashbox_transfer_FI_2` (`transfer_id`),
	CONSTRAINT `sch_movement_cashbox_transfer_FK_2`
		FOREIGN KEY (`transfer_id`)
		REFERENCES `sch_transfer` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_billet
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_billet`;


CREATE TABLE `sch_billet`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`name` VARCHAR(100),
	`description` TEXT,
	`value` FLOAT,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_transfer_billet
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_transfer_billet`;


CREATE TABLE `sch_transfer_billet`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`transfer_id` INTEGER  NOT NULL,
	`billet_id` INTEGER  NOT NULL,
	`quantity` INTEGER,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_transfer_billet_FI_1` (`transfer_id`),
	CONSTRAINT `sch_transfer_billet_FK_1`
		FOREIGN KEY (`transfer_id`)
		REFERENCES `sch_transfer` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_transfer_billet_FI_2` (`billet_id`),
	CONSTRAINT `sch_transfer_billet_FK_2`
		FOREIGN KEY (`billet_id`)
		REFERENCES `sch_billet` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sch_payment_type_billet
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sch_payment_type_billet`;


CREATE TABLE `sch_payment_type_billet`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_state` INTEGER  NOT NULL,
	`billet_id` INTEGER  NOT NULL,
	`payment_type_id` INTEGER  NOT NULL,
	`deleted_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sch_payment_type_billet_FI_1` (`billet_id`),
	CONSTRAINT `sch_payment_type_billet_FK_1`
		FOREIGN KEY (`billet_id`)
		REFERENCES `sch_billet` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `sch_payment_type_billet_FI_2` (`payment_type_id`),
	CONSTRAINT `sch_payment_type_billet_FK_2`
		FOREIGN KEY (`payment_type_id`)
		REFERENCES `sch_payment_type` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
