CREATE DATABASE `assign_db`;
CREATE TABLE `issue` (
	`issue_id` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`subject` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`status` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`priority` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`region` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`due_date` DATE NULL DEFAULT NULL,
	`assignee` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`reviewer` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`version`  VARCHAR(5)  NULL DEFAULT NULL,
	`image_path` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`reviewer_comment` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`is_deleted` ENUM('1','0') NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`last_modified` TIMESTAMP NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`issue_id`) USING BTREE,
	UNIQUE INDEX `issue_id` (`issue_id`) USING BTREE
	
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
