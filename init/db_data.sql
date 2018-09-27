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
  (NULL,'contact','contact_header', 'Umówić się na spotkanie', UNIX_TIMESTAMP(), 1),
  (NULL,'contact','contact_header_small', 'Prosimy o wcześniejszy kontakt telefoniczny w celu umówienia się na przymierzanie sukni.', UNIX_TIMESTAMP(), 1),
-- EN ----------------------------------------------
  (NULL,'contact','contact_header', 'Arrange an appointment', UNIX_TIMESTAMP(), 2),
  (NULL,'contact','contact_header_small', 'Please contact us via phone in advance regarding agreement on fitting the dress.', UNIX_TIMESTAMP(), 2),
-- RU ----------------------------------------------
  (NULL,'contact','contact_header', 'Договориться о встрече', UNIX_TIMESTAMP(), 3),
  (NULL,'contact','contact_header_small', 'Просим о предварительной договоренности о примерке платья.', UNIX_TIMESTAMP(), 3),
-- email about arranging  an appointment ------------------
-- PL -----------------------------------------------------
  (NULL,'emailer','subject', 'Zaproszenie na spotkanie', UNIX_TIMESTAMP(), 1),
  (NULL,'emailer','description', 'Zaproszenie na spotkanie z www strony', UNIX_TIMESTAMP(), 1),
-- EN ----------------------------------------------
  (NULL,'emailer','subject', 'Meeting appointment', UNIX_TIMESTAMP(), 2),
  (NULL,'emailer', 'description', 'A meeting appointment has been requested using web-site', UNIX_TIMESTAMP(), 2),
-- RU ----------------------------------------------
  (NULL,'emailer','subject', 'Запрос на встречу с сайта', UNIX_TIMESTAMP(), 3),
  (NULL,'emailer','description', 'Новый запрос на встречу с сайта', UNIX_TIMESTAMP(), 3),
-- media names --------------------------------------------
-- PL -----------------------------------------------------
  (NULL,'media','misc', 'wieczorowe i koktajlowe', UNIX_TIMESTAMP(), 1),
  (NULL,'media','g18', '2018', UNIX_TIMESTAMP(), 1),
  (NULL,'media','g17', '2017', UNIX_TIMESTAMP(), 1),
-- EN -----------------------------------------------------
  (NULL,'media','misc', 'evening & cocktail', UNIX_TIMESTAMP(), 2),
  (NULL,'media','g18', '2018', UNIX_TIMESTAMP(), 2),
  (NULL,'media','g17', '2017', UNIX_TIMESTAMP(), 2),
-- RU -----------------------------------------------------
  (NULL,'media','misc', 'вечерние и коктейльные', UNIX_TIMESTAMP(), 3),
  (NULL,'media','g18', '2018', UNIX_TIMESTAMP(), 3),
  (NULL,'media','g17', '2017', UNIX_TIMESTAMP(), 3)
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
  (NULL,'contact',3,'Lucky DRESS - atelier','<script>fbq(''track'', ''CompleteRegistration'');</script>','','','kontakt','<legend id="bordered"><span class="fa fa-globe"></span> Adres</legend><address>&nbsp; ul. Długa<span class="header_date"> 17, 31-147</span> <strong>Kraków</strong><br>&nbsp; Pasaż Wenecki, «Lucky Dress»<br>&nbsp; <i class="fa fa-phone"></i> <abbr title="Phone number"> Phone:</abbr> <span class="header_date">(+48) 794 64 64 62</span><br>&nbsp; <i class="fa fa-at"></i> <abbr title="e-mail"> E-mail:</abbr> &lsaquo;<a href="mailto:info@lucky-dress.eu">info<i class="fa fa-at"></i>lucky-dress.eu</a>&rsaquo;</address><div><strong id="bordered">Godziny otwarcia</strong><br>&nbsp;pon. – pt. <span class="header_date">10:00 – 18:00</span><br>&nbsp;sob. <span class="header_date">10:00 – 14:00</span></div>',1,0,1,UNIX_TIMESTAMP()),
  (NULL,'media',  4,'Lucky DRESS - atelier','<link rel="stylesheet" href="/css/gallery.css"><link rel="stylesheet" href="/css/baguetteBox.css"><script src="/js/baguetteBox.min.js" async></script>','','','GALERIA','',1,0,1,UNIX_TIMESTAMP()),
  (NULL,'blog',   5,'Lucky DRESS - atelier','<link rel="stylesheet" type="text/css" href="/css/zabuto_calendar.min.css"><script src="/js/zabuto_calendar.min.js"></script>','','','blog','',1,0,1,UNIX_TIMESTAMP()),
-- EN -----------------------------------------------------
  (NULL,'home',   1,'Lucky DRESS - atelier','','wedding,cocktail,dresses,sewing,artistic sewing,fashion wedding,online shop,accessories,luckydress,lucky-dress','Wedding and cocktail dresses. We offers best wedding and cocktail dresses. Sewing dresses. Artistic sewing. Fashion wedding. Workshop of wedding dresses. Trendy wedding and cocktail dresses','home','<p class="bukvica">We offer women and girls to choose in our shop stunning dresses for the happiest moments in life. Our professional dressmakers with many years of experience in the manufacture attentive to every detail. We use Italian fabric.</p><p class="bukvica">Many years of our successful experience backed by the trust of women.</p><p class="bukvica">In the "Lucky Dress" you will find a wedding dresses and dresses for special events like rout or party.</p><p class="bukvica">And if you have a non-standard shape or have your own unique taste, and You know how should look like Your Lucky Dress - we are ready to realize your vision.</p>',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'about',  2,'Lucky DRESS - atelier','','','','about','<img class="rounded float-left img-fluid" src="/i/aboutus03.jpg" width="400" style="padding-right: 20px !important;"><p class="bukvica">We offer women and girls to choose in our shop stunning dresses for the happiest moments in life. Our professional dressmakers with many years of experience in the manufacture attentive to every detail. We use Italian fabric.</p><p class="bukvica">Many years of our successful experience backed by the trust of women.</p><p class="bukvica">In the "Lucky Dress" you will find a wedding dresses and dresses for special events like rout or party.</p><p class="bukvica">And if you have a non-standard shape or have your own unique taste, and You know how should look like Your Lucky Dress - we are ready to realize your vision.</p>',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'contact',3,'Lucky DRESS - atelier','<script>fbq(''track'', ''CompleteRegistration'');</script>','','','contact','<legend id="bordered"><span class="fa fa-globe"></span> Address</legend><address>&nbsp; ul. Długa<span class="header_date"> 17, 31-147</span> <strong>Krakow</strong><br>&nbsp; Pasaż Wenecki, «Lucky Dress»<br>&nbsp; <i class="fa fa-phone"></i> <abbr title="Phone number"> Phone:</abbr> <span class="header_date">(+48) 794 64 64 62</span><br>&nbsp; <i class="fa fa-at"></i> <abbr title="e-mail"> E-mail:</abbr> &lsaquo;<a href="mailto:info@lucky-dress.eu">info<i class="fa fa-at"></i>lucky-dress.eu</a>&rsaquo;</address><div><strong id="bordered">Open hours</strong><br>&nbsp;Mon. – Fri. <span class="header_date">10:00 – 18:00</span><br>&nbsp;Sat. <span class="header_date">10:00 – 14:00</span></div>',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'media',  4,'Lucky DRESS - atelier','<link rel="stylesheet" href="/css/gallery.css"><link rel="stylesheet" href="/css/baguetteBox.css"><script src="/js/baguetteBox.min.js" async></script>','','','gallery','',1,0,2,UNIX_TIMESTAMP()),
  (NULL,'blog',   5,'Lucky DRESS - atelier','<link rel="stylesheet" type="text/css" href="/css/zabuto_calendar.min.css"><script src="/js/zabuto_calendar.min.js"></script>','','','blog','',1,0,2,UNIX_TIMESTAMP()),
-- RU -----------------------------------------------------
  (NULL,'home',   1,'Lucky DRESS - Свадебные и вечерние платья - ателье - Краков','','свадьба,платья,пошив,ателье,индивидуальный пошив,примерка,свадебные платья,вечерние,вечернеебневеста','Свадебные и вечерние платья. Индивидуальный пошив. Свадебная мода. Интернет-магазин','главная','<p class="bukvica">Предлагаем женщинам и девушкам выбрать в нашем салоне потрясающие платья для самых счастливых моментов в жизни.<br>Профессиональные портнихи с многолетней практикой при изготовлении внимательны к каждой детали.<br> Мы используем итальянские ткани. Наш многолетний успешный опыт подкреплен доверием женщин.</p><p class="bukvica">В "Счастливом Платье" вы найдете уже готовые свадебные платья и платья для торжественных выходов.</p><p class="bukvica">А если у вас нестандартная фигура или есть свой собственный, неповторимый вкус, и Вы сами знаете, как должно выглядеть Ваше Счастливое платье - мы готовы воплотить в жизнь ваше видение.</p>',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'about',  2,'Lucky DRESS - Свадебные и вечерние платья','','','','о нас','<img class="rounded float-left img-fluid" src="/i/aboutus03.jpg" width="400" style="padding-right: 20px !important;"><p class="bukvica">Предлагаем женщинам и девушкам выбрать в нашем салоне потрясающие платья для самых счастливых моментов в жизни.<br>Профессиональные портнихи с многолетней практикой при изготовлении внимательны к каждой детали.<br> Мы используем итальянские ткани. Наш многолетний успешный опыт подкреплен доверием женщин.</p><p class="bukvica">В "Счастливом Платье" вы найдете уже готовые свадебные платья и платья для торжественных выходов.</p><p class="bukvica">А если у вас нестандартная фигура или есть свой собственный, неповторимый вкус, и Вы сами знаете, как должно выглядеть Ваше Счастливое платье - мы готовы воплотить в жизнь ваше видение.</p>',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'contact',3,'Lucky DRESS - Свадебные и вечерние платья','<script>fbq(''track'', ''CompleteRegistration'');</script>','','','контакт','<legend id="bordered"><span class="fa fa-globe"></span> Адрес</legend><address>&nbsp; ul. Długa<span class="header_date"> 17, 31-147</span> <strong>Krakow</strong><br>&nbsp; Pasaż Wenecki, «Lucky Dress»<br>&nbsp; <i class="fa fa-phone"></i> <abbr title="Phone number"> Phone:</abbr> <span class="header_date">(+48) 794 64 64 62</span><br>&nbsp; <i class="fa fa-at"></i> <abbr title="e-mail"> E-mail:</abbr> &lsaquo;<a href="mailto:info@lucky-dress.eu">info<i class="fa fa-at"></i>lucky-dress.eu</a>&rsaquo;</address><div><strong id="bordered">Часы работы</strong><br>&nbsp;пнд. – птн. <span class="header_date">10:00 – 18:00</span><br>&nbsp;сбт. <span class="header_date">10:00 – 14:00</span></div>',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'media',  4,'Lucky DRESS - Свадебные и вечерние платья','<link rel="stylesheet" href="/css/gallery.css"><link rel="stylesheet" href="/css/baguetteBox.css"><script src="/js/baguetteBox.min.js" async></script>','','','коллекции','',1,0,3,UNIX_TIMESTAMP()),
  (NULL,'blog',   5,'Lucky DRESS - Свадебные и вечерние платья','<link rel="stylesheet" type="text/css" href="/css/zabuto_calendar.min.css"><script src="/js/zabuto_calendar.min.js"></script>','','','блог','',1,0,3,UNIX_TIMESTAMP())
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

INSERT INTO `ld_famous` (`id`,`phrase`,`auth`,`lang_id`) values
  (NULL,"I am not a product of my circumstances. I am a product of my decisions.",'Stephen Covey',2),
  (NULL,"Я не плод моих обстоятельств. Я плод моих решений.",'Стивен Кови',3),
  (NULL,"I’ve learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel.",'Maya Angelou',2),
  (NULL,"Люди забудут, что ты сказал, они забудут, что ты сделал, но они всегда будут помнить, что почувствовали благодаря тебе.",'Майя Энджелоу',3),
  (NULL,"Remember no one can make you feel inferior without your consent.",'Eleanor Roosevelt',2),
  (NULL,"Запомните, никто не заставит вас чувствовать себя неполноценным без вашего согласия.",'Элеонора Рузвельт',3),
  (NULL,"A person who never made a mistake never tried anything new.",'Albert Einstein',2),
  (NULL,"Человек, никогда не совершавший ошибок, никогда не пробовал ничего нового.",'Альберт Эйнштейн',3),
  (NULL,"Watch your thoughts for they become words. Watch your words for they become actions. Watch your actions for they become habits. Watch your habits for they become your character. And watch your character for it becomes your destiny. What we think, we become.",'Margaret Thatcher',2),
  (NULL,"Следите за своими мыслями, ибо обращаются они в слова, слова – в действия, а действия – в привычки. Берегитесь привычек, ибо они формируют ваш характер. Усмиряйте характер, ибо он становится судьбой. Что мы думаем – тем и становимся…",'Маргарет Тэтчер',3),
  (NULL,"Strive not to be a success, but rather to be of value.",'Albert Einstein',2),
  (NULL,"Стремись не к тому, чтобы добиться успеха, а к тому, чтобы твоя жизнь имела смысл.",'Альберт Эйнштейн',3),
  (NULL,"Build your own dreams, or someone else will hire you to build theirs.",'Farrah Gray',2),
  (NULL,"Стройте свои собственные мечты, иначе кто-то другой использует вас, чтобы построить свои.",'Фара Грей',3),
  (NULL,"Look at a day when you are supremely satisfied at the end. It’s not a day when you lounge around doing nothing; it’s a day you’ve had everything to do and you’ve done it.",'Margaret Thatcher',2),
  (NULL,"Обратите внимание на каждый из дней, вечером которого вас наполняет радость и удовлетворение. И вы увидите, что это — не тот день, когда Вы предавались праздному безделью, а день, когда вам многое предстояло сделать, и вы великолепно справились с этим.",'Маргарет Тэтчер',3),
  (NULL,"Life is not about waiting for the storm to pass… it’s about learning to dance in the rain.",'Vivian Greene',2),
  (NULL,"Смысл жизни не в том, чтобы ждать, когда закончится гроза, а в том, чтобы учиться танцевать под дождем.",'Вивиан Грин',3),
  (NULL,"If you hear a voice within you say “you cannot paint,” then by all means paint and that voice will be silenced.",'Vincent Van Gogh',2),
  (NULL,"Если вы слышите внутренний голос, который говорит вам «вы не сможете рисовать», рисуйте, во что бы то ни стало, и этот голос однажды замолчит.",'Винсент Ван Гог',3),
  (NULL,"Great minds discuss ideas; average minds discuss events; small minds discuss people.",'Eleanor Roosevelt',2),
  (NULL,"Великие умы обсуждают идеи. Средние умы обсуждают события. Мелкие умы обсуждают людей.",'Элеонора Рузвельт',3),
  (NULL,"Darkness cannot drive out darkness: only light can do that. Hate cannot drive out hate: only love can do that.’s life.",'Martin Luther King, JR.',2),
  (NULL,"Темнота не может разогнать темноту: на это способен только свет. Ненависть не может уничтожить ненависть: только любовь способна на это.",'Мартин Лютер Кинг',3),
  (NULL,"The only thing we have to fear is fear itself.",'Franklin D. Roosevelt',2),
  (NULL,"Единственное, чего мы должны бояться, так это самого страха.",'Франклин Делано Рузвельт',3),
  (NULL,"The secret to success is constancy of purpose.",'Benjamin Disraeli',2),
  (NULL,"Секрет успеха — это настойчивое стремление к цели.",'Бенджамин Дизраэли',3),
  (NULL,"How wonderful it is that nobody need wait a single moment before starting to improve the world.",'Anne Frank',2),
  (NULL,"Хорошо, что никому не нужно ждать ни минуты, чтобы начать делать мир лучше.",'Анна Франк',3),
  (NULL,"Success is walking from failure to failure with no loss of enthusiasm.",'Winston Churchill',2),
  (NULL,"Успех — это умение двигаться от одной неудачи к другой не теряя энтузиазма.",'Уинстон Черчилль',3),
  (NULL,"Live as if you were to die tomorrow. Learn as if you were to live forever.",'Mahatma Gandhi',2),
  (NULL,"Живи так, будто завтра умрешь; учись так, будто проживешь вечно.",'Махатма Ганди',3),
  (NULL,"I have not failed. I’ve just found 10,000 ways that won’t work.",'Thomas A. Edison',2),
  (NULL,"Я не потерпел неудачу. Я только нашел 10000 способов, которые не будут работать.",'Томас А. Эдисон',3),
  (NULL,"How many cares one loses when one decides not to be something but to be someone.",'Gabrielle “Coco” Chanel',2),
  (NULL,"Сколько забот исчезнет, если решиться быть не чем-то, а кем-то.",'Габриэль "Коко" Шанель',3),
  (NULL,"Whenever you find yourself on the side of the majority, it is time to pause and reflect.",'Mark Twain',2),
  (NULL,"Если вы заметили, что вы на стороне большинства, это верный признак того, что пора меняться (или остановиться и задуматься).",'Марк Твен',3),
  (NULL,"When everything seems to be going against you, remember that the airplane takes off against the wind, not with it.",'Henry Ford',2),
  (NULL,"Когда кажется, что весь мир настроен против тебя, помни, что самолёт взлетает против ветра.",'Генри Форд',3),
  (NULL,"The journey of a thousand miles begins with one step.",'Lao Tzu',2),
  (NULL,"Путь в тысячу миль начинается с одного шага.",'Лао Цзы',3),
  (NULL,"You must be the change you wish to see in the world.",'Gandhi',2),
  (NULL,"Вы должны быть теми изменениями, которые вы хотим видеть в мире.",'Ганди',3),
  (NULL,"Don’t wait. The time will never be just right.",'Napoleon Hill',2),
  (NULL,"Не ждите. Время никогда не будет идеальным.",'Наполеон Хилл',3),
  (NULL,"What we fear doing most is usually what we most need to do.",'Tim Ferriss',2),
  (NULL,"Больше всего мы боимся совершать самые необходимые поступки.",'Тимоти Феррис',3),
  (NULL,"There is only one way to avoid criticism: do nothing, say nothing, and be nothing.",'Aristotle',2),
  (NULL,"Есть только один способ избежать критики — ничего не делать, ничего не говорить и не быть никем.",'Аристотель',3),
  (NULL,"When I was 5 years old, my mother always told me that happiness was the key to life. When I went to school, they asked me what I wanted to be when I grew up. I wrote down ‘happy’. They told me I didn’t understand the assignment, and I told them they didn’t understand life.",'John Lennon',2),
  (NULL,"Когда мне было 5 лет, моя мать сказала, что счастье — это главное в жизни. Когда я пошел в школу, и меня спросили, кем я хочу стать, когда выросту, я ответил «счастливым». Они сказали, что я не понял вопроса, а я ответил, что они не понимают жизни.",'Джон Леннон',3),
  (NULL,"I’ve missed more than 9000 shots in my career. I’ve lost almost 300 games. 26 times I’ve been trusted to take the game winning shot and missed. I’ve failed over and over and over again in my life. And that is why I succeed.",'Michael Jordan',2),
  (NULL,"Я сделал более 9000 неудачных бросков за свою карьеру. Я проиграл почти 300 игр. 26 раз мне доверили сделать решающий бросок в матче, и я промахнулся. Я проигрывал снова, снова, и снова, всю свою жизнь. Вот, почему я добился успеха.",'Майкл Джордан',3),
  (NULL,"I didn’t fail the test. I just found 100 ways to do it wrong.",'Benjamin Franklin',2),
  (NULL,"Я не провалил тест, я просто нашел 100 способов сделать его неправильно",'Бенджамин Франклин',3),
  (NULL,"It does not matter how slowly you go as long as you do not stop.",'Confucius',2),
  (NULL,"Не важно с какой скоростью ты движешься к своей цели, главное не останавливаться.",'Конфуций',3),
  (NULL,"Twenty years from now you will be more disappointed by the things that you didn’t do than by the ones you did do, so throw off the bowlines, sail away from safe harbor, catch the trade winds in your sails. Explore, Dream, Discover.",'Mark Twain',2),
  (NULL,"Через двадцать лет вы будете более сожалеть о том, чего не сделали, чем о том, что вы сделали. Поэтому, отбросьте сомнения. Уплывайте прочь от безопасной гавани. Поймайте попутный ветер своими парусами. Исследуйте. Мечтайте. Открывайте.",'Марк Твен',3),
  (NULL,"Your time is limited, so don’t waste it living someone else’s life.",'Steve Jobs',2),
  (NULL,"Ваше время ограничено, поэтому не тратьте его на жизнь чей-то чужой жизнью.",'Стив Джобс',3),
  (NULL,"Every child is an artist. The problem is how to remain an artist once he grows up.",'Pablo Picasso',2),
  (NULL,"Каждый ребенок – художник. Трудность в том, чтобы остаться художником, выйдя из детского возраста.",'Пабло Пикассо',3),
  (NULL,"Whether you think you can or you think you can’t, you’re right.",'Henry Ford',2),
  (NULL,"Если вы думаете что вы способны на что-то, вы правы, если вы думаете что у вас не получится что-то, вы тоже правы.",'Генри Форд',3),
  (NULL,"You miss 100% of the shots you don’t take.",'Wayne Gretzky',2),
  (NULL,"Из тех бросков, которые ты не сделал, 100% — мимо ворот.",'Уэйн Гретцки',3)
;
