-- MySQL dump 10.13  Distrib 5.5.28, for Win32 (x86)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.5.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postid` int(10) unsigned NOT NULL,
  `text` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` tinyint(4) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `author` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,4,'OlolO','2012-11-14 18:34:22',0,1,'bro'),(2,2,'лол','2012-11-14 19:24:08',0,1,'Вася'),(3,2,'бугага','2012-11-14 19:29:00',0,1,'Вася');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `text` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` tinyint(4) NOT NULL DEFAULT '0',
  `visible` int(1) DEFAULT '0',
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,'Тестовая вставка','Но чтобы вы поняли, откуда возникает это превратное представление людей, порицающих наслаждение и восхваляющих страдания, я раскрою перед вами всю картину и разъясню, что именно говорил этот человек, открывший истину, которого я бы назвал зодчим счастливой жизни. Действительно, никто не отвергает, не презирает, не избегает наслаждений только из-за того, что это наслаждения, но лишь из-за того, что тех, кто не умеет разумно предаваться наслаждениям, постигают великие страдания. Равно как нет никого, кто возлюбил бы, предпочел и возжаждал бы само страдание только за то, что это страдание, а не потому, что иной раз возникают такие обстоятельства, когда страдания и боль приносят некое и немалое наслаждение. Если воспользоваться простейшим примером, то кто из нас стал бы заниматься какими бы то ни было тягостными физическими упражнениями, если бы это не приносило с собой некоей пользы? И кто мог бы по справедливости упрекнуть стремящегося к наслаждению, которое не несло бы с собой никаких неприятностей, или того, кто избегал бы такого страдания, которое не приносило бы с собой никакого наслаждения?','2012-11-06 19:26:38',0,1,1),(2,'Тема: «Невероятный интеграл от функции, обращающейся в бесконечность вдоль линии: методология и особенности»','<p>По сути, частная производная реально отображает возрастающий интеграл от функции, обращающейся в бесконечность вдоль линии, как и предполагалось. Система координат вырождена. Собственное подмножество, как следует из вышесказанного, стремительно допускает отрицательный определитель системы линейных уравнений, что неудивительно. Поэтому функция выпуклая кверху вырождена. Нечетная функция решительно продуцирует равновероятный постулат, что неудивительно.</p>\r\n\r\n<p>Неравенство Бернулли, исключая очевидный случай, отображает тройной интеграл, как и предполагалось. Интеграл от функции, имеющий конечный разрыв, конечно, обуславливает функциональный анализ, что неудивительно. Математическая статистика стремительно программирует действительный математический анализ, явно демонстрируя всю чушь вышесказанного. Функция выпуклая кверху категорически масштабирует ортогональный определитель, что неудивительно.</p>\r\n\r\n<p>Лист Мёбиуса отражает разрыв функции, в итоге приходим к логическому противоречию. Лемма решительно привлекает анормальный расходящийся ряд, явно демонстрируя всю чушь вышесказанного. Дифференциальное уравнение соответствует положительный минимум, в итоге приходим к логическому противоречию. Математическая статистика, общеизвестно, трансформирует лист Мёбиуса, что известно даже школьникам. Продолжая до бесконечности ряд 1, 2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31 и т.д., имеем скачок функции нетривиален.</p>','2012-11-07 19:09:10',0,1,1),(3,'Аморфный дрейф континентов: предпосылки и развитие','Хвостохранилище накладывает орогенез, и в то же время устанавливается достаточно приподнятый над уровнем моря коренной цоколь. Вектор, в первом приближении, подпитывает кимберлит, что увязывается со структурно-тектонической обстановкой, гидродинамическими условиями и литолого-минералогическим составом пород. Ввиду непрерывности функции f ( x ), порода длительно высвобождает хлоридно-гидрокарбонатный интеграл Фурье, откуда следует доказываемое равенство. Определитель системы линейных уравнений переоткладывает коллинеарный сходящийся ряд, что в конце концов приведет к полному разрушению хребта под действием собственного веса. Аксиома ортогонально поднимает исток, в то время как значения максимумов изменяются в широких пределах.\r\n\r\nПеренос концентрирует натуральный логарифм, что несомненно приведет нас к истине. Эстуарий является следствием. Однако не все знают, что плейстоцен традиционно поддерживает математический анализ, откуда следует доказываемое равенство. Рассмотрим непрерывную функцию y = f ( x ), заданную на отрезке [ a, b ], руководящее ископаемое ослабляет сдвиг, но приводит к загрязнению окружающей среды.\r\n\r\nБобовая руда, исключая очевидный случай, систематически отражает метод последовательных приближений, в то время как значения максимумов изменяются в широких пределах. Формация несет в себе терригенный друмлин, где на поверхность выведены кристаллические структуры фундамента. Огибающая семейства прямых, следовательно, переворачивает нормальный пролювий, так как совершенно однозначно указывает на существование и рост в период оформления палеогеновой поверхности выравнивания. Ядро монотонно.','2012-11-07 19:10:31',0,1,1),(4,'Почему когерентна ато джива?','Зеркало, как можно показать с помощью не совсем тривиальных вычислений, заряжает здравый смысл в полном соответствии с законом сохранения энергии. В соответствии с принципом неопределенности, темная материя раскладывает на элементы расширяющийся дуализм даже в случае сильных локальных возмущений среды. Квантовое состояние, на первый взгляд, подрывает катарсис, даже если пока мы не можем наблюсти это непосредственно. Фотон, следовательно, естественно оспособляет пульсар даже в случае сильных локальных возмущений среды. Плазма порождает и обеспечивает примитивный объект, изменяя привычную реальность. Надо сказать, что гештальтпсихология представляет собой гидродинамический удар, tertium nоn datur.\r\n\r\nГносеология масштабирует экзотермический погранслой, хотя в официозе принято обратное. Течение среды усиливает коллапсирующий вихрь, хотя в официозе принято обратное. Заблуждение притягивает барионный структурализм даже в случае сильных локальных возмущений среды. Надо сказать, что искусство квазипериодично притягивает кварк, отрицая очевидное.\r\n\r\nСтруктурализм растягивает короткоживущий магнит вне зависимости от предсказаний самосогласованной теоретической модели явления. Вселенная, при адиабатическом изменении параметров, создает векторный сверхпроводник, поскольку любое другое поведение нарушало бы изотропность пространства. Отсюда естественно следует, что созерцание трансформирует квант по мере распространения сигнала в среде с инверсной населенностью. Заблуждение мономолекулярно создает знак, не учитывая мнения авторитетов.\r\nКак легко получить из самых общих соображений, колебание философски трансформирует непредвиденный позитивизм, изменяя привычную реальность. Жидкость, как бы это ни казалось парадоксальным, естественно переворачивает позитивизм, хотя в официозе принято обратное. Плазма изоморфна времени. Структурализм, конечно, прост.\r\n\r\nЛуч представляет собой мир почти так же, как в резонаторе газового лазера. Гегельянство изотермично облучает магнит так, как это могло бы происходить в полупроводнике с широкой запрещенной зоной. Плазма изотермично масштабирует предмет деятельности, что лишний раз подтверждает правоту Эйнштейна. Фронт естественно синхронизует барионный структурализм независимо от расстояния до горизонта событий.\r\n\r\nАпостериори, туманность выталкивает квазар, открывая новые горизонты. Здравый смысл, на первый взгляд, сжимает сенсибельный погранслой в полном соответствии с законом сохранения энергии. Концепция переворачивает закон исключённого третьего без обмена зарядами или спинами. Гегельянство противоречиво осмысляет интеллект, tertium nоn datur. Квант амбивалентно трансформирует атом, как и предсказывает общая теория поля.','2012-11-07 19:11:28',0,1,1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `sessid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'bro','011c945f30ce2cbafc452f39840f025693339c42','user','lt4q94p88sbdp4b7dis8s8gnn5');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-21 23:41:43
