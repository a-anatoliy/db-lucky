CREATE TABLE `Tickets` (
    `ticketID` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Имя участника/название организации',
    `info` VARCHAR(255) NULL DEFAULT '' COMMENT 'Информация о номинанте',
    PRIMARY KEY (`ticketID`)
) COMMENT='Заявки учасников конкурса' ENGINE=InnoDB ;

CREATE TABLE `Nominations` (
    `nominationID` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Название номинации',
    PRIMARY KEY (`nominationID`)
) COMMENT='Номинации конкурса' ENGINE=InnoDB ;

CREATE TABLE `Tickets_Nominations` (
    `ticket_id` INT(11) NOT NULL,
    `nomination_id` INT(11) NOT NULL,
    PRIMARY KEY (`ticket_id`, `nomination_id`),
    INDEX `ticket_id` (`ticket_id`),
    INDEX `nomination_id` (`nomination_id`),
    CONSTRAINT `FK_Nominations` FOREIGN KEY (`nomination_id`)
        REFERENCES `Nominations` (`nominationID`) ON DELETE CASCADE,
    CONSTRAINT `FK_Ticket` FOREIGN KEY (`ticket_id`)
        REFERENCES `Tickets` (`ticketID`) ON DELETE CASCADE
) COMMENT='Таблица связи заявок участников и номинаций конкурса'
ENGINE=InnoDB;
