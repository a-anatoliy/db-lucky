USE `luckyDress_db`;
--
-- `ld_langs`
--
INSERT INTO `ld_langs`(`id`,`name`,`title`,`active`) values (1,'pl','pl','1'),(2,'en','en','1'),(3,'ru','ru','1');
-- * -----------------------------------------------
--
-- `ld_contact_form`
--

INSERT INTO `ld_contact_form` (`id`,`parent_id`,`sort_id`,`field_name`,`label`,`title`,`placeholder`,`edit_date`,`lang_id`)
VALUES
-- PL -----------------------------------------------------
  (null,0,1,'name','Twoje Imię','Twoje Imię','Twoje Imię',UNIX_TIMESTAMP(),1),
  (null,0,2,'email','E-mail','E-mail','E-mail',UNIX_TIMESTAMP(),1),
  (null,0,3,'phone','Telefon','Telefon','Telefon',UNIX_TIMESTAMP(),1),
  (null,0,4,'message','Treść wiadomości','Treść wiadomości','Treść wiadomości',UNIX_TIMESTAMP(),1),
  (null,0,5,'act','Wyślij','Wyślij','Wyślij',UNIX_TIMESTAMP(),1),
-- EN ----------------------------------------------
  (null,0,1,'name','Your Name','What is your name?','Your Name',UNIX_TIMESTAMP(),2),
  (null,0,2,'email','E-mail','E-mail','E-mail',UNIX_TIMESTAMP(),2),
  (null,0,3,'phone','Phone Number','Please, enter your phone number','Phone Number',UNIX_TIMESTAMP(),2),
  (null,0,4,'message','Message','Your Message','Your Message',UNIX_TIMESTAMP(),2),
  (null,0,5,'act','Send','Send a message','Send',UNIX_TIMESTAMP(),2),
-- RU ----------------------------------------------
  (null,0,1,'name','Ваше Имя','Укажите Ваше Имя','Ваше Имя',UNIX_TIMESTAMP(),3),
  (null,0,2,'email','E-mail','Укажите Ваш адрес элетронной почты','E-mail',UNIX_TIMESTAMP(),3),
  (null,0,3,'phone','Номер телефона', 'Укажите Ваш номер телефона','Номер телефона',UNIX_TIMESTAMP(),3),
  (null,0,4,'message','Сообщение','Текст Сообщения','Сообщение',UNIX_TIMESTAMP(),3),
  (null,0,5,'act','Отправить','Отправить сообщение','Отправить',UNIX_TIMESTAMP(),3)
;
-- * -----------------------------------------------
--
-- `ld_auxiliary_phrases`
--
INSERT INTO `ld_auxiliary_phrases` (`id`, `page_name`, `subst_name`, `phrase`, `edit_date`, `lang_id`) VALUES
-- PL -----------------------------------------------------
  (NULL,'contact', 'contact-header', 'Umówić się na spotkanie', UNIX_TIMESTAMP(), 1),
  (NULL,'contact', 'contact-header-small', 'Prosimy o wcześniejszy kontakt telefoniczny w celu umówienia się na przymierzanie sukni.', UNIX_TIMESTAMP(), 1),
-- EN ----------------------------------------------
  (NULL,'contact', 'contact-header', 'Arrange an appointment', UNIX_TIMESTAMP(), 2),
  (NULL,'contact', 'contact-header-small', 'Please contact us via phone in advance regarding agreement on fitting the dress.', UNIX_TIMESTAMP(), 2),
-- RU ----------------------------------------------
  (NULL,'contact', 'contact-header', 'Договориться о встрече', UNIX_TIMESTAMP(), 3),
  (NULL,'contact', 'contact-header-small', 'Просим о предварительной договоренности о примерке платья.', UNIX_TIMESTAMP(), 3),
-- email about arranging  an appointment ------------------
-- PL -----------------------------------------------------
  (NULL,'emailer', 'subject', 'Zaproszenie na spotkanie', UNIX_TIMESTAMP(), 1),
  (NULL,'emailer', 'description', 'Zaproszenie na spotkanie z www strony', UNIX_TIMESTAMP(), 1),
-- EN ----------------------------------------------
  (NULL,'emailer', 'subject', 'Meeting appointment', UNIX_TIMESTAMP(), 2),
  (NULL,'emailer', 'description', 'A meeting appointment has been requested using web-site', UNIX_TIMESTAMP(), 2),
-- RU ----------------------------------------------
  (NULL,'emailer', 'subject', 'Запрос на встречу с сайта', UNIX_TIMESTAMP(), 3),
  (NULL,'emailer', 'description', 'Новый запрос на встречу с сайта', UNIX_TIMESTAMP(), 3)
;
-- * -----------------------------------------------


