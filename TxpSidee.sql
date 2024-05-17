-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 17 2024 г., 12:35
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `TxpSidee`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Authors`
--

CREATE TABLE `Authors` (
  `author_id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Authors`
--

INSERT INTO `Authors` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'Джейн', 'Остин'),
(2, 'Федор', 'Достоевский'),
(3, 'Уильям', 'Шекспир'),
(4, 'Агата', 'Кристи'),
(5, 'Эрнест', 'Хемингуэй'),
(6, 'Джордж', 'Оруэлл'),
(7, 'Лев', 'Толстой'),
(8, 'Харуки', 'Мураками'),
(9, 'Юкио', 'Мисима'),
(10, 'Масамуне', 'Сиро'),
(11, 'Каору', 'Мори'),
(12, 'Хаяо', 'Миядзаки'),
(54, 'Марк', 'Твен'),
(55, 'Луиджи', 'Пиранделло'),
(56, 'Итало', 'Кальвино'),
(57, 'Виктор', 'Гюго'),
(58, 'Жан-Жак', 'Руссо'),
(59, 'Мао', 'Цзэдун'),
(60, 'Лао', 'Цзы'),
(61, 'Томас', 'Манн'),
(62, 'Фридрих', 'Ницше'),
(63, 'Мохаммед', 'Аль-Мур'),
(64, 'Мохаммед', 'Аль-Мазруи'),
(65, 'Михаил', 'Булгаков'),
(66, 'Андрей', 'Курков'),
(67, 'Алесь', 'Беляцкий'),
(68, 'Иван', 'Мелець'),
(69, 'Арто', 'Паасилинна'),
(70, 'Анси', 'Кастила'),
(71, 'Хван', 'Чжион'),
(72, 'Ли', 'Мин-хо'),
(73, 'Хуан', 'Рульфо');

-- --------------------------------------------------------

--
-- Структура таблицы `Books`
--

CREATE TABLE `Books` (
  `book_id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int NOT NULL,
  `genre_id` int NOT NULL,
  `country_id` int NOT NULL,
  `publication_date` date NOT NULL,
  `publisher_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Books`
--

INSERT INTO `Books` (`book_id`, `title`, `text`, `image`, `author_id`, `genre_id`, `country_id`, `publication_date`, `publisher_id`) VALUES
(1, 'Гордость и предубеждение', 'Роман «Гордость и предубеждение» Остин был написан в 1813 году. В книге описывается жизнь английского дворянства в глубинке в первой половине XIX века. Главной в произведении является тема любви, возможность распоряжаться своей жизнью по собственному усмотрению.\n\n', 'gp.jpg', 1, 1, 1, '1813-01-28', 1),
(2, 'Преступление и наказание', 'Преступление и наказание – самый известный роман Ф.М. Достоевского, совершивший мощный переворот общественного сознания. Написание романа символизирует открытие высшего, нового этапа творчества гениального писателя. В романе, с присущим Достоевскому психологизмом, показан путь мятущейся души человека сквозь тернии страданий к постижению Истины.\n\nПуть создания произведения был весьма нелегок. Замысел романа с лежащей в его основе теорией о «сверхчеловеке», начал зарождаться еще во время пребывания писателя на каторге, он созревал в течение многих лет, но сама идея раскрывающая сущность «обыкновенных» и «необыкновенных» людей  выкристаллизовалась во время пребывания Достоевского в Италии.', 'pin.jpg', 2, 1, 1, '1866-01-01', 2),
(3, 'Гамлет', 'Трагедия Уильяма Шекспира в пяти актах, одна из самых известных его пьес и одна из самых знаменитых пьес в мировой драматургии. Написана в 1599-1601 годах. Это самая длинная пьеса Шекспира - в ней 4042 строки и 29 551 слово. Место действия пьесы - Дания, где принц Гамлет мстит своему дяде Клавдию за убийство его отца, совершённое из расчёта занять престол и жениться на матери Гамлета Гертруде', 'gm.jpeg', 3, 1, 3, '1603-01-01', 3),
(4, 'Убийство в восточном экспрессе', 'Путешествие на одном из самых роскошных поездов Европы неожиданно превращается в одну из самых стильных и захватывающих загадок в истории. Фильм рассказывает историю тринадцати пассажиров поезда, каждый из которых находится под подозрением. И только сыщик должен как можно быстрее разгадать головоломку, прежде чем преступник нанесет новый удар.', 'yve.jpeg', 4, 3, 3, '1934-01-01', 4),
(5, 'Прощай, оружие', 'Книга рассказывает о любви на фоне Первой мировой войны. Роман во многом является автобиографичным — Хемингуэй служил на итальянском фронте, был ранен и лежал в госпитале в Милане, где у него был роман с медсестрой.', 'po.jpg', 5, 3, 4, '1929-01-01', 5),
(6, '1984', '«1984» — роман-антиутопия Джорджа Оруэлла, изданный в 1949 году.\n\nКак отмечает членкор РАН М. Ф. Черныш, это самое главное и последнее произведение писателя.', '1984.jpg', 6, 1, 5, '1949-01-01', 3),
(7, 'Война и мир', 'Война и мир[a] - литературное произведение русского писателя Льва Толстого. Действие происходит во времена наполеоновских войн, в произведении сочетается вымышленное повествование с главами, обсуждающими историю и философию. Впервые публикуемая серийно, начиная с 1865 года, работа была переписана и опубликована полностью в 1869 году. Она считается лучшим литературным достижением Толстого и остается всемирно признанной классикой мировой литературы.', 'wiw.jpg', 7, 1, 1, '1869-01-01', 1),
(8, 'Анна Каренина', 'Роман Льва Толстого о трагической любви замужней дамы Анны Карениной и блестящего офицера Алексея Вронского на фоне счастливой семейной жизни дворян Константина Лёвина[К 1] и Кити Щербацкой. Масштабная картина нравов и быта дворянской среды Петербурга и Москвы второй половины XIX века, сочетающая философские размышления авторского alter ego Лёвина с передовыми в русской литературе психологическими зарисовками, а также сценами из жизни крестьян.', 'ak.jpg', 7, 1, 1, '1877-01-01', 2),
(9, 'Моби Дик', '«Моби Дик, или Белый кит» (1851) — основная работа Германа Мелвилла, итоговое произведение литературы американского романтизма.\n\nДлинный роман с многочисленными лирическими отступлениями, проникнутый библейской образностью и многослойным символизмом, не был понят и принят современниками. Переоткрытие «Моби Дика» произошло в 1920-е годы.', 'md.jpg', 5, 2, 4, '1851-01-01', 3),
(10, 'Унесенные ветром', ' Американский художественный фильм 1939 года в жанре исторической военной мелодрамы, снятый по одноимённому роману Маргарет Митчелл. Продюсером ленты выступил Дэвид Селзник из Selznick International Pictures[en], а режиссёром — Виктор Флеминг[3]. События фильма разворачиваются на Юге США во время Гражданской войны, в центре сюжета — история Скарлетт О’Хары, дочери плантатора из Джорджии. Главные роли исполнили Вивьен Ли (Скарлетт), Кларк Гейбл (Ретт), Лесли Говард (Эшли) и Оливия де Хэвилленд (Мелани).', 'o-o.jpeg', 8, 5, 4, '1936-01-01', 5),
(11, 'Норвежский лес', '37-летний Тору слышит в гамбургском аэропорту мелодию песни The Beatles «Norwegian Wood» и переносится мыслями в свою юность — в 1960-е годы, когда он был токийским студентом, тяжело переживавшим смерть лучшего друга, который совершил самоубийство. ', 'otd.jpg', 8, 2, 2, '1987-01-01', 6),
(12, '1Q84', '«1Q84» («Тысяча невестьсот восемьдесят четыре») — это книга о поиске психологической опоры в мире размытых ориентиров. Книга знакомит читателя с двумя героями: женщиной-инструктором фитнес-клуба Аомамэ и учителем математики Тэнго. Повествование ведётся от третьего лица. Общая фабула строится на темах веры и религии, любви и секса, оружия и домашнего насилия, убийства по убеждениям и суицида, а также потери себя и духовной пропасти между поколениями отцов и детей.', '1q84.jpg', 8, 2, 2, '2009-01-01', 7),
(13, 'Падение ангела', 'Заключительный роман тетралогии «Море изобилия», считающейся вершиной сочинительства Мисимы и своего рода творческим завещанием; это произведение, в котором Мисима, по его словам, «выразил все свои идеи» и после которого ему уже «не о чем было писать». Завершив последний роман тетралогии, он поставил точку и в своей жизни.', 'mpa.jpg', 9, 1, 2, '1967-01-01', 6),
(14, 'Принцесса Мононоке', 'Убив вепря, юный принц Аситака навлек на себя смертельное проклятие. Старая знахарка предсказала, что только он сам способен изменить свою судьбу, и отважный воин отправился в опасное путешествие. Так он оказался в загадочной стране, где люди под предводительством злой госпожи Эбоси воевали с обитателями леса: духами, демонами и гигантскими существами, каких Аситака раньше никогда не видел. И была с ними принцесса Мононоке - повелительница зверей и дочь волчицы. Теперь судьба всех зависит только от одного воина - принца Аситаки.', 'pma.jpg', 12, 1, 2, '1980-01-01', 7),
(15, 'Ходячий замок', 'Злая ведьма заточила 18-летнюю Софи в тело старухи. Девушка-бабушка бежит из города куда глаза глядят и встречает удивительный дом на ножках, где знакомится с могущественным волшебником Хаулом и демоном Кальцифером. Кальцифер должен служить Хаулу по договору, условия которого он не может разглашать. Девушка и демон решают помочь друг другу избавиться от злых чар.', 'hzm.jpg', 12, 5, 2, '1986-01-01', 6),
(16, 'Shirley', 'Сборник включает семь историй-зарисовок из жизни горничных в эдвардианской Англии. Пять из семи рассказов посвящены обаятельной тринадцатилетней Ширли Медисон и ее хозяйке – мисс Беннетт Кренри. Истории эти иногда веселые, иногда печальные, написаны с особой любовью и добротой.Мисс Беннетт Кренри, владелец кафе \"Мона Лиза\", работает с раннего утра и до поздней ночи. Она слишком занята, чтобы заниматься еще и домашним хозяйством. Поэтому мисс Беннетт помещает в газете объявление о найме горничной. Каково же было ее удивление, когда наниматься к ней на работу пришла Ширли Медисон... ', 'SM.jpg', 11, 1, 2, '2004-07-08', 7),
(17, 'Призрак в доспехах', 'Научно-фантастическая манга, созданная Масамунэ Сиро, изначально опубликованная в 1989 году в виде отрывков и позже объединенная в единый том. Также известна под названием Ghost in the Shell. Она повествует историю организации под названием Девятый отдел, ведущей борьбу с кибертерроризмом в Японии середины XXI века, главным агентом которой является Майор Мотоко Кусанаги.', 'pvd.jpg', 10, 4, 2, '2021-09-22', 6),
(26, 'Приключения Гекльберри Финна', 'Приключения Гекльберри Финна - роман американского писателя Марка Твена, который был впервые опубликован в Соединенном Королевстве в декабре 1884 года и в Соединенных Штатах в феврале 1885 года.\n\nПроизведение, обычно называемое среди великих американских романов, является одним из первых в крупной американской литературе, написанное на народном английском языке, отличающемся местным колоритом и регионализмом. Рассказ от первого лица ведется Гекльберри \"Гек\" Финном, рассказчиком двух других романов Твена (\"Том Сойер за границей\" и \"Том Сойер, детектив\") и другом Тома Сойера. Это прямое продолжение \"Приключений Тома Сойера\".\n\nКнига известна тем, что \"изменила направление детской литературы\" в Соединенных Штатах за \"глубоко прочувствованное изображение детства\".[2][нужен более точный источник] Он также известен своими красочными описаниями людей и мест вдоль реки Миссисипи. Действие \"Приключений Гекльберри Финна\" разворачивается в южном довоенном обществе, которое прекратило свое существование более чем за 20 лет до публикации произведения. Это часто едкая сатира на укоренившиеся взгляды, особенно на расизм и свободу.\n\nНеизменно популярная среди читателей книга \"Приключения Гекльберри Финна\" также является постоянным объектом изучения литературных критиков с момента ее публикации. После выхода книга подверглась широкой критике из-за широкого использования в ней грубых выражений и расовых эпитетов. На протяжении всего 20-го века, и несмотря на аргументы о том, что главный герой и направленность книги являются антирасистскими,[3][4] критика книги продолжалась как из-за предполагаемого использования в ней расовых стереотипов, так и из-за частого употребления расового оскорбления \"ниггер\".', 'pgf.jpg', 54, 11, 4, '1884-01-01', 3),
(27, 'Приключения Тома Сойера', '«Приключе́ния То́ма Со́йера» (англ. The Adventures of Tom Sawyer) — вышедшая в 1876 году повесть Марка Твена о приключениях мальчика, живущего в небольшом американском городке Сент-Питерсберг (Санкт-Петербург) в штате Миссури. Действие в книге происходит до событий Гражданской войны в США, при этом ряд моментов в этой книге и её продолжении, «Приключениях Гекльберри Финна», а также обстоятельства жизни автора, во многом легшие в основу книг, указывают на 1844 год .<br>Том Сойер — веселый и шаловливый мальчик примерно двенадцатилетнего возраста, живёт у тёти Полли, сестры своей покойной матери. В повести описываются различные приключения Тома и его друзей на протяжении нескольких месяцев.\n\nВ ходе этих приключений он успевает найти свою любовь (Бекки Тэтчер), стать свидетелем убийства и разоблачить убийцу, убежать из дома, чтобы стать пиратом и пожить на острове, заблудиться в пещере и благополучно выбраться из неё, найти драгоценный клад стоимостью в двенадцать тысяч долларов и разделить его со своим другом Гекльберри Финном.', 'ts.jpg', 54, 11, 4, '1876-01-01', 4),
(28, 'Отверженные', '«Отве́рженные» (фр. «Les Misérables») — роман-эпопея французского классика Виктора Гюго. Широко признан мировой литературной критикой и мировой общественностью апофеозом творчества писателя и одним из величайших романов XIX столетия. Впервые опубликован в 1862 году.\n\nРоман переведён на многие мировые языки и входит в большое количество школьных курсов по литературе. Он многократно ставился на сценах театров и не раз экранизировался во Франции и за её пределами под своим оригинальным названием.<br>На страницах романа широко освещаются главные и важнейшие для Гюго проблемы: сила закона и любви, жестокость и человечность, непостижимые лишения и нестерпимые страдания бедных, благоденствие богатых. Автор рисует длительный и нелёгкий жизненный путь бывшего каторжника Жана Вальжана (главного героя романа), его мировоззрение; перемены, произошедшие в его характере по ходу повествования; его стремление к исправлению прошлых ошибок, добру и самопожертвованию во имя свободы и счастья других. Жан Вальжан является одним из самых благородных и самоотверженных героев во французской литературе. Ему противопоставляется инспектор Жавер, олицетворяющий власть. Это человек жестокий и волевой, который не остановится ни перед чем, чтобы правосудие восторжествовало.\n\nОхватывая широкие временные рамки (включая период Франции с 1815 до 1832 года и жестоко подавленное войсками Июньское восстание в Париже), произведение является исторической драмой, постоянно отсылающей читателя к актуальным событиям того времени. Виктор Гюго подвергает критике политику эпохи Реставрации, нищее социальное положение большинства населения. Он придаёт своим персонажам республиканские настроения, что делает роман революционным и антимонархическим.', 'otv.jpg', 57, 1, 6, '1862-01-01', 11),
(29, 'Исповедь', '«Исповедь» (фр. Les Confessions) — автобиографическая книга французского писателя Жан-Жака Руссо, написанная в 1765—1770 годах и впервые опубликованная в 1782—1789 годах, после смерти автора.<br>В «Исповеди» Руссо рассказывает о всей своей жизни[1], причём делает это с беспрецедентной для своей эпохи откровенностью (по его собственным словам, он показал себя в книге «во всей правде природы»). Автор пишет, например, что его сексуальное развитие началось, когда няня отшлёпала его по заду. Далее он рассказывает о своём пристрастии к мастурбации, о приставаниях монахов в католическом приюте в Турине, об отношениях с любовницей Терезой Левассер, и сообщает множество подробностей о своей сексуальной жизни.', 'isp.jpg', 58, 10, 6, '1782-01-01', 10),
(30, 'Дао де цзин', 'Дао дэ цзин (кит. трад. 道德經, упр. 道德经, пиньинь Dào Dé Jīng, звучаниеⓘ, «Книга пути и достоинства») — основополагающий источник учения и один из выдающихся памятников китайской мысли, оказавший большое влияние на культуру Китая и всего мира. Основная идея этого произведения — понятие дао — трактуется как естественный порядок вещей, не допускающий постороннего вмешательства, «небесная воля» или «чистое небытие». Споры о содержании книги и её авторе продолжаются до сих пор.\n\nУтверждается, что общее количество классических комментариев к Дао дэ цзин достигает 700, из которых на данный момент сохранилось 350. Количество комментариев на японском языке около 270.<br>Трактат Дао дэ цзин состоит из 81 главы. Центральным понятием является неизреченное, пустое (4), невидимое (14) и вечное (32) Дао, которое предшествовало различению Неба и Земли. Образом Дао является вода.\n\nЧеловек, осознавший Дао, именуется совершенномудрым. Он обладает дружелюбием и искренностью. Среди добродетелей также названа справедливость, покой, постоянство и естественность . Эти качества являются проявлением дао: Дао постоянно осуществляет недеяние . В конце трактата упоминаются три добродетели: человеколюбие, бережливость и скромность .', 'dao-de-czzin.jpg', 60, 12, 7, '0922-01-01', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Country`
--

CREATE TABLE `Country` (
  `country_id` int NOT NULL,
  `country_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Country`
--

INSERT INTO `Country` (`country_id`, `country_name`) VALUES
(1, 'Россия'),
(2, 'Япония'),
(3, 'Великобритания'),
(4, 'США'),
(5, 'Италия'),
(6, 'Франция'),
(7, 'Китай'),
(8, 'Германия'),
(9, 'ОАЭ'),
(10, 'Украина'),
(11, 'Беларусь'),
(12, 'Финляндия'),
(13, 'Корея'),
(14, 'Испания');

-- --------------------------------------------------------

--
-- Структура таблицы `Feedback`
--

CREATE TABLE `Feedback` (
  `id` int NOT NULL,
  `sender_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `submission_datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Feedback`
--

INSERT INTO `Feedback` (`id`, `sender_name`, `sender_email`, `subject`, `message_text`, `submission_datetime`) VALUES
(3, 'Klim', 'erwe@mail.ru', 'Похвала от японских самураев', 'много поздравлений должно быть тут\r\n', '2024-05-14 18:35:15'),
(4, 'Deko', 'dddfg@gmail.com', 'Совет по улучшению', 'много текста с предложениями улучшения проекта', '2024-05-14 18:53:33'),
(5, 'Liam', 'lr@mia.ru', 'Совет по дизайну', 'много мнений о дизайне проекта', '2024-05-14 18:57:18'),
(6, '000', '000@gmail.com', '000', '00000000000000000000000', '2024-05-15 14:11:55');

-- --------------------------------------------------------

--
-- Структура таблицы `Genres`
--

CREATE TABLE `Genres` (
  `genre_id` int NOT NULL,
  `genre_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Genres`
--

INSERT INTO `Genres` (`genre_id`, `genre_name`) VALUES
(1, 'Роман'),
(2, 'Драма'),
(3, 'Детектив'),
(4, 'Фантастика'),
(5, 'Фэнтези'),
(6, 'Поэзия'),
(7, 'Научная фантастика'),
(8, 'Эссе'),
(9, 'Биография'),
(10, 'Автобиография'),
(11, 'Приключения'),
(12, 'Философская '),
(13, 'Документальная '),
(14, 'Юмористическая '),
(15, 'Религиозная '),
(16, 'Триллер'),
(17, 'Ужасы'),
(18, 'Мистика'),
(19, 'Сатира'),
(20, 'Сказка'),
(21, 'Детская '),
(22, 'Юношеская ');

-- --------------------------------------------------------

--
-- Структура таблицы `Publishers`
--

CREATE TABLE `Publishers` (
  `publisher_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Publishers`
--

INSERT INTO `Publishers` (`publisher_id`, `name`, `address`) VALUES
(1, 'Издательство \"АСТ\"', 'Россия, Москва, ул. Ленина, 10'),
(2, 'Издательство \"Эксмо\"', 'Россия, Санкт-Петербург, Невский пр., 20'),
(3, 'Penguin Random House', 'США, Нью-Йорк, 5-я авеню, 123'),
(4, 'HarperCollins', 'Великобритания, Лондон, Стрэнд, 45'),
(5, 'Книжный мир', 'Россия, Москва, просп. Пушкина, 5'),
(6, 'Kadokawa Shoten', 'Япония, Токио, ст. Ямато, 2'),
(7, 'Hakusensha', 'Япония, Осака, ст. Намба, 15'),
(10, 'Hachette Livre', 'Франция, Париж, ул. Жана Блезена, 58'),
(11, 'Springer Nature', 'Германия, Гейдельберг, ул. Тиргартенштрассе 15-17');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id_user` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id_user`, `first_name`, `last_name`, `username`, `email`, `password`, `role`, `avatar`) VALUES
(5501, 'Петр', 'Петров', 'ippo', 'ippo@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'user', 'anim333.jpg'),
(5502, 'Анна', 'Сидорова', 'annasdr', 'sdrnn@mail.ru', 'a1f00dddbabf086e7ddbe15de572fd7f', 'user', 'default.jpg'),
(5503, 'Мария', 'Смирнова', 'lllfjdw', 'lllfjdw@mail.ru', '5af3726edbe019a3ad9f64e82442e282', 'user', 'default.jpg'),
(5504, 'Алексей', 'Сульянов', 'sln_tpsd', 'sln_tpsd@gmail.com', '5ca179c31c2ef92572d636db4770de0d', 'admin', 'default.jpg'),
(5505, 'Тимур', 'Волков', 'lovv66', 'lovv66@gmail.com', '3295c76acbf4caaed33c36b1b5fc2cb1', 'user', 'anim3422.jpg'),
(5506, 'Николай', 'Дроздов', 'syigetsu', 'syigetsu@gmail.com', '6c30b25863d26833d08c615837176d56', 'admin', 'default.jpg'),
(11214, 'Максим', 'Осинцев', 'HIBAKO', 'hiboba@mail.ru', '5e36941b3d856737e81516acd45edc50', 'admin', 'default.jpg'),
(11215, '22', '22', '22', '22@gmai.com', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'user', 'anim3422.jpg'),
(11216, '000', '000', '000', '000@gmail.com', 'c6f057b86584942e415435ffb1fa93d4', 'user', 'anim21312.jpg'),
(11217, '77', '77', '77', '77@gmail.com', '28dd2c7955ce926456240b2ff0100bde', 'user', 'anim6642.jpg'),
(11218, '88', '88', '88', '88@gmail.com', '2a38a4a9316c49e5a833517c45d31070', 'user', 'kill21.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user_book_status`
--

CREATE TABLE `user_book_status` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `status` enum('не прочитано','в планах','читаю','прочитано') COLLATE utf8mb4_unicode_ci DEFAULT 'не прочитано'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_book_status`
--

INSERT INTO `user_book_status` (`id`, `user_id`, `book_id`, `status`) VALUES
(1, 5505, 1, 'читаю'),
(2, 5505, 2, 'читаю'),
(3, 5505, 3, 'в планах'),
(4, 5505, 4, 'прочитано'),
(5, 5505, 5, 'читаю'),
(6, 5505, 11, 'в планах'),
(7, 5505, 12, 'в планах'),
(8, 5505, 13, 'в планах'),
(9, 5505, 14, 'прочитано'),
(10, 5505, 9, 'прочитано'),
(11, 5505, 10, 'прочитано'),
(12, 5505, 30, 'прочитано'),
(13, 5505, 28, 'читаю'),
(14, 5505, 27, 'читаю'),
(15, 11215, 1, 'в планах'),
(16, 11215, 3, 'читаю'),
(17, 11215, 4, 'читаю'),
(18, 11216, 1, 'в планах'),
(19, 11216, 2, 'в планах'),
(20, 11216, 3, 'читаю'),
(21, 11218, 1, 'читаю');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Authors`
--
ALTER TABLE `Authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Индексы таблицы `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`country_id`);

--
-- Индексы таблицы `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Genres`
--
ALTER TABLE `Genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Индексы таблицы `Publishers`
--
ALTER TABLE `Publishers`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `user_book_status`
--
ALTER TABLE `user_book_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Authors`
--
ALTER TABLE `Authors`
  MODIFY `author_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `Books`
--
ALTER TABLE `Books`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `Country`
--
ALTER TABLE `Country`
  MODIFY `country_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Genres`
--
ALTER TABLE `Genres`
  MODIFY `genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `Publishers`
--
ALTER TABLE `Publishers`
  MODIFY `publisher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11219;

--
-- AUTO_INCREMENT для таблицы `user_book_status`
--
ALTER TABLE `user_book_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Books`
--
ALTER TABLE `Books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `Authors` (`author_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `Publishers` (`publisher_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `Genres` (`genre_id`),
  ADD CONSTRAINT `books_ibfk_4` FOREIGN KEY (`country_id`) REFERENCES `Country` (`country_id`);

--
-- Ограничения внешнего ключа таблицы `user_book_status`
--
ALTER TABLE `user_book_status`
  ADD CONSTRAINT `user_book_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_book_status_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
