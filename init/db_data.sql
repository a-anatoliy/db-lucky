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
--
-- `ld_pages`
--
INSERT INTO `ld_pages`
  (`id`, `page_name`, `sort_id`, `title`, `additional_header`, `keywords`, `meta_description`, `announcement`, `content`, `active`, `active_from`, `lang_id`, `last_edit`) VALUES

-- RU -----------------------------------------------------
  (NULL, 404, 0, 'Page not found', '', '', '', 'Page not found', 'The requested resource could not be found but may be available in the future. Subsequent requests by the client are permissible.', 1, 0, 1, UNIX_TIMESTAMP()),
  (NULL, 404, 0, 'Page not found', '', '', '', 'Page not found', 'The requested resource could not be found but may be available in the future. Subsequent requests by the client are permissible.', 1, 0, 2, UNIX_TIMESTAMP()),
  (NULL, 404, 0, 'Page not found', '', '', '', '', 'Запрашиваемая страница не найдена', '1', 0, 3, UNIX_TIMESTAMP()),
-- PL -----------------------------------------------------
  (NULL,'home',   1,'Lucky DRESS - Suknie ślubne i wieczorowe - atelier - Kraków','','suknie ślubne, suknie wieczorowe, fryzury ślubne, makijaż ślubny, dekoracje ślubne, ślubny taniec','Suknie ślubne. Suknie ślubne na wesele. Oferty najlepszych sukien ślubnych. Szycie sukienek. Artystyczne szycie. Moda weselna. Pracownia sukien ślubnych. Oferujemy modne suknie ślubne','Główna','<p class="bukvica">Każda suknia uszyta w Lucky Dress to <b>Szczęśliwa Sukienka</b>. Wierzymy, że dobrze dobrana sukienka daje każdej z nas wyjątkowe poczucia radości z przeżywania własnej kobiecości.</p><p class="bukvica">Posiadamy bogate doświadczenie w projektowaniu i krawiectwie najwyższej klasy, dzięki czemu wiemy co uszyć i jak uszyć, aby wydobyć kobiece piękno z każdej sylwetki. Śledzimy najnowsze trendy modowe i nie są nam straszne żadne, nawet najbardziej wyrafinowane projekty.</p><p class="bukvica">Przykładamy wielką uwagę do detali i wykończenia. Do tworzenia naszych sukni wykorzystujemy najlepsze włoskie tkaniny.</p><p class="bukvica">To powiększającym się grono zadowolonych klientek, poparte wieloletnie doświadczeniem, stało się motywacją do stworzenia własnej marki i wyjątkowego salonu, do którego serdecznie Cię zapraszamy.</p><p class="bukvica">W salonie «Lucky Dress – Szczęśliwa Sukienka» znajdziesz zarówno gotowe projekty sukni ślubnych, weselnych oraz wieczorowych jak i inspiracje do stworzenia własnego projektu, który z radością dla Ciebie uszyjemy. Każda kobieta jest wyjątkowa, dlatego oferujemy również możliwość szycia na miarę.</p><p class="bukvica">Jeśli posiadasz niestandardową sylwetkę lub nie masz pomysłu w czym będziesz wyglądać pięknie – po prostu przyjdź, porozmawiamy i stworzymy wspólnie projekt Twoich marzeń. Czekamy na Ciebie.</p>',1,0,1,UNIX_TIMESTAMP()),
  (NULL,'about',  2,'Lucky DRESS - atelier. Suknie ślubne i wieczorowe','','','','o nas','<img class="rounded float-left img-fluid" src="/i/aboutus03.jpg" width="400" style="padding-right: 20px !important;"><p class="bukvica">Każda suknia uszyta w Lucky Dress to <b>Szczęśliwa Sukienka</b>. Wierzymy, że dobrze dobrana sukienka daje każdej z nas wyjątkowe poczucia radości z przeżywania własnej kobiecości.</p><p class="bukvica">Posiadamy bogate doświadczenie w projektowaniu i krawiectwie najwyższej klasy, dzięki czemu wiemy co uszyć i jak uszyć, aby wydobyć kobiece piękno z każdej sylwetki. Śledzimy najnowsze trendy modowe i nie są nam straszne żadne, nawet najbardziej wyrafinowane projekty.</p><p class="bukvica">Przykładamy wielką uwagę do detali i wykończenia. Do tworzenia naszych sukni wykorzystujemy najlepsze włoskie tkaniny.</p><p class="bukvica">To powiększającym się grono zadowolonych klientek, poparte wieloletnie doświadczeniem, stało się motywacją do stworzenia własnej marki i wyjątkowego salonu, do którego serdecznie Cię zapraszamy.</p><p class="bukvica">W salonie «Lucky Dress – Szczęśliwa Sukienka» znajdziesz zarówno gotowe projekty sukni ślubnych, weselnych oraz wieczorowych jak i inspiracje do stworzenia własnego projektu, który z radością dla Ciebie uszyjemy. Każda kobieta jest wyjątkowa, dlatego oferujemy również możliwość szycia na miarę.</p><p class="bukvica">Jeśli posiadasz niestandardową sylwetkę lub nie masz pomysłu w czym będziesz wyglądać pięknie – po prostu przyjdź, porozmawiamy i stworzymy wspólnie projekt Twoich marzeń. Czekamy na Ciebie.</p>',1,0,1,UNIX_TIMESTAMP()),
  (NULL,'contact',3,'Lucky DRESS - atelier','','','','kontakt','<legend id="bordered"><span class="fa fa-globe"></span> Adres</legend><address>&nbsp; ul. Długa<span class="header_date"> 17, 31-147</span> <strong>Kraków</strong><br>&nbsp; Pasaż Wenecki, «Lucky Dress»<br>&nbsp; <i class="fa fa-phone"></i> <abbr title="Phone number"> Phone:</abbr> <span class="header_date">(+48) 794 64 64 62</span><br>&nbsp; <i class="fa fa-at"></i> <abbr title="e-mail"> E-mail:</abbr> &lsaquo;<a href="mailto:info@lucky-dress.eu">info<i class="fa fa-at"></i>lucky-dress.eu</a>&rsaquo;</address><div><strong id="bordered">Godziny otwarcia</strong><br>&nbsp;pon. – pt. <span class="header_date">10:00 – 18:00</span><br>&nbsp;sob. <span class="header_date">10:00 – 14:00</span></div>',1,0,1,UNIX_TIMESTAMP()),
  (NULL,'media',  4,'Lucky DRESS - atelier','','','','GALERIA','',1,0,1,UNIX_TIMESTAMP()),
-- EN -----------------------------------------------------
  (NULL,'home',   1,'Lucky DRESS - atelier','','wedding,cocktail,dresses,sewing,artistic sewing,fashion wedding,online shop,accessories,luckydress,lucky-dress','Wedding and cocktail dresses. We offers best wedding and cocktail dresses. Sewing dresses. Artistic sewing. Fashion wedding. Workshop of wedding dresses. Trendy wedding and cocktail dresses','home','<p class="bukvica">We offer women and girls to choose in our shop stunning dresses for the happiest moments in life. Our professional dressmakers with many years of experience in the manufacture attentive to every detail. We use Italian fabric.</p><p class="bukvica">Many years of our successful experience backed by the trust of women.</p><p class="bukvica">In the "Lucky Dress" you will find a wedding dresses and dresses for special events like rout or party.</p><p class="bukvica">And if you have a non-standard shape or have your own unique taste, and You know how should look like Your Lucky Dress - we are ready to realize your vision.</p>',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'about',  2,'Lucky DRESS - atelier','','','','about','<img class="rounded float-left img-fluid" src="/i/aboutus03.jpg" width="400" style="padding-right: 20px !important;"><p class="bukvica">We offer women and girls to choose in our shop stunning dresses for the happiest moments in life. Our professional dressmakers with many years of experience in the manufacture attentive to every detail. We use Italian fabric.</p><p class="bukvica">Many years of our successful experience backed by the trust of women.</p><p class="bukvica">In the "Lucky Dress" you will find a wedding dresses and dresses for special events like rout or party.</p><p class="bukvica">And if you have a non-standard shape or have your own unique taste, and You know how should look like Your Lucky Dress - we are ready to realize your vision.</p>',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'contact',3,'Lucky DRESS - atelier','','','','contact','<legend id="bordered"><span class="fa fa-globe"></span> Address</legend><address>&nbsp; ul. Długa<span class="header_date"> 17, 31-147</span> <strong>Krakow</strong><br>&nbsp; Pasaż Wenecki, «Lucky Dress»<br>&nbsp; <i class="fa fa-phone"></i> <abbr title="Phone number"> Phone:</abbr> <span class="header_date">(+48) 794 64 64 62</span><br>&nbsp; <i class="fa fa-at"></i> <abbr title="e-mail"> E-mail:</abbr> &lsaquo;<a href="mailto:info@lucky-dress.eu">info<i class="fa fa-at"></i>lucky-dress.eu</a>&rsaquo;</address><div><strong id="bordered">Open hours</strong><br>&nbsp;Mon. – Fri. <span class="header_date">10:00 – 18:00</span><br>&nbsp;Sat. <span class="header_date">10:00 – 14:00</span></div>',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'media',  4,'Lucky DRESS - atelier','','','','gallery','',1,0,2,UNIX_TIMESTAMP()),
-- RU -----------------------------------------------------
  (NULL,'home',   1,'Lucky DRESS - Свадебные и вечерние платья - ателье - Краков','','свадьба,платья,пошив,ателье,индивидуальный пошив,примерка,свадебные платья,вечерние,вечернеебневеста','Свадебные и вечерние платья. Индивидуальный пошив. Свадебная мода. Интернет-магазин','главная','<p class="bukvica">Предлагаем женщинам и девушкам выбрать в нашем салоне потрясающие платья для самых счастливых моментов в жизни.<br>Профессиональные портнихи с многолетней практикой при изготовлении внимательны к каждой детали.<br> Мы используем итальянские ткани. Наш многолетний успешный опыт подкреплен доверием женщин.</p><p class="bukvica">В "Счастливом Платье" вы найдете уже готовые свадебные платья и платья для торжественных выходов.</p><p class="bukvica">А если у вас нестандартная фигура или есть свой собственный, неповторимый вкус, и Вы сами знаете, как должно выглядеть Ваше Счастливое платье - мы готовы воплотить в жизнь ваше видение.</p>',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'about',  2,'Lucky DRESS - Свадебные и вечерние платья','','','','о нас','<img class="rounded float-left img-fluid" src="/i/aboutus03.jpg" width="400" style="padding-right: 20px !important;"><p class="bukvica">Предлагаем женщинам и девушкам выбрать в нашем салоне потрясающие платья для самых счастливых моментов в жизни.<br>Профессиональные портнихи с многолетней практикой при изготовлении внимательны к каждой детали.<br> Мы используем итальянские ткани. Наш многолетний успешный опыт подкреплен доверием женщин.</p><p class="bukvica">В "Счастливом Платье" вы найдете уже готовые свадебные платья и платья для торжественных выходов.</p><p class="bukvica">А если у вас нестандартная фигура или есть свой собственный, неповторимый вкус, и Вы сами знаете, как должно выглядеть Ваше Счастливое платье - мы готовы воплотить в жизнь ваше видение.</p>',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'contact',3,'Lucky DRESS - Свадебные и вечерние платья','','','','контакт','<legend id="bordered"><span class="fa fa-globe"></span> Адрес</legend><address>&nbsp; ul. Długa<span class="header_date"> 17, 31-147</span> <strong>Krakow</strong><br>&nbsp; Pasaż Wenecki, «Lucky Dress»<br>&nbsp; <i class="fa fa-phone"></i> <abbr title="Phone number"> Phone:</abbr> <span class="header_date">(+48) 794 64 64 62</span><br>&nbsp; <i class="fa fa-at"></i> <abbr title="e-mail"> E-mail:</abbr> &lsaquo;<a href="mailto:info@lucky-dress.eu">info<i class="fa fa-at"></i>lucky-dress.eu</a>&rsaquo;</address><div><strong id="bordered">Часы работы</strong><br>&nbsp;пнд. – птн. <span class="header_date">10:00 – 18:00</span><br>&nbsp;сбт. <span class="header_date">10:00 – 14:00</span></div>',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'media',  4,'Lucky DRESS - Свадебные и вечерние платья','','','','коллекции','',1,0,3,UNIX_TIMESTAMP())
;

-- для галерей добавить переводы заголовков плашек в таблицу ld_auxiliary_phrases

-- * -----------------------------------------------
--
-- `ld_TABLE`
--
/*
INSERT INTO `ld_TABLE`
  (`id`)
VALUES
*/
-- PL -----------------------------------------------------
-- EN -----------------------------------------------------
-- RU -----------------------------------------------------
/* ; */
-- * ------------------------------------------------------