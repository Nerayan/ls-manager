-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: 1s
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1-log

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
-- Table structure for table `canvRel`
--

DROP TABLE IF EXISTS `canvRel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canvRel` (
  `idcanv` varchar(10) NOT NULL COMMENT 'Canvas Cursor Relations\n',
  `cursp` varchar(12) NOT NULL DEFAULT '',
  `field_p` varchar(10) NOT NULL DEFAULT '',
  `cursc` varchar(12) NOT NULL DEFAULT '',
  `field_c` varchar(10) DEFAULT '',
  PRIMARY KEY (`idcanv`,`cursp`,`cursc`,`field_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Залежності';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canvRel`
--

LOCK TABLES `canvRel` WRITE;
/*!40000 ALTER TABLE `canvRel` DISABLE KEYS */;
INSERT INTO `canvRel` VALUES ('dbedit','tabs1','dbt','data3','xdbt'),('dbedit','tabs1','dbt','field2','dbt'),('dmzx','dms2','npp','plmo3','npp'),('dmzx','dms2','undoc','plmo3','undoc'),('dmzx','dmz1','undoc','dms2','undoc'),('interf','canvz1','idcanv','canvs2','idcanv'),('interf','canvz1','idcanv','curs3','idcanv'),('interf','canvz1','idcanv','relat','idcanv'),('main','tree1','id','menu1','parent');
/*!40000 ALTER TABLE `canvRel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canvbtn`
--

DROP TABLE IF EXISTS `canvbtn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canvbtn` (
  `idcanv` varchar(10) NOT NULL,
  `cursid` varchar(12) NOT NULL,
  `btn` varchar(10) NOT NULL,
  `pic` varchar(20) DEFAULT NULL,
  `cmd` text,
  `capt` varchar(25) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`idcanv`,`cursid`,`btn`),
  CONSTRAINT `FK_canvbtn_canvz` FOREIGN KEY (`idcanv`) REFERENCES `canvz` (`idcanv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Interface buttons';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canvbtn`
--

LOCK TABLES `canvbtn` WRITE;
/*!40000 ALTER TABLE `canvbtn` DISABLE KEYS */;
INSERT INTO `canvbtn` VALUES ('default','0','F12','img/def.png',NULL,'ExtMenu',12),('default','0','F2','img/def.png',NULL,'Menu',2),('default','0','F4','img/edit.png',NULL,'Edit',4),('default','0','F5','img/prnt.png',NULL,'Print',5),('default','0','F7','img/new.png',NULL,'New',7),('default','0','F8','img/def.png',NULL,'Delete',8),('default','0','Fxx','img/def.png',NULL,'Custom',20);
/*!40000 ALTER TABLE `canvbtn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canvcurs`
--

DROP TABLE IF EXISTS `canvcurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canvcurs` (
  `idcanv` varchar(10) NOT NULL COMMENT 'Описания курсоров\n',
  `cursid` varchar(12) NOT NULL,
  `title` varchar(45) NOT NULL DEFAULT '',
  `dbt` varchar(50) NOT NULL DEFAULT '' COMMENT 'Table alias',
  `crep` varchar(10) DEFAULT NULL,
  `form` varchar(10) DEFAULT NULL,
  `curstype` enum('db','sql') DEFAULT 'sql',
  PRIMARY KEY (`idcanv`,`cursid`),
  KEY `FK_canvcurs_repz` (`dbt`,`crep`),
  KEY `FK_canvcurs_formz` (`form`),
  CONSTRAINT `FK_canvcurs_formz` FOREIGN KEY (`form`) REFERENCES `formz` (`idform`),
  CONSTRAINT `FK_canvcurs_repz` FOREIGN KEY (`dbt`, `crep`) REFERENCES `repz` (`db`, `crep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canvcurs`
--

LOCK TABLES `canvcurs` WRITE;
/*!40000 ALTER TABLE `canvcurs` DISABLE KEYS */;
INSERT INTO `canvcurs` VALUES ('dbedit','data3','','(select * from dms)',NULL,NULL,'sql'),('dbedit','field2','','dbs',NULL,NULL,'db'),('dbedit','tabs1','','dbz',NULL,NULL,'db'),('dmzx','dms2','RowDoc','dms',NULL,NULL,'db'),('dmzx','dmz1','Doc','dmz',NULL,NULL,'db'),('dmzx','plmo3','','plmo',NULL,NULL,'db'),('interf','canvs2','','canvs',NULL,'flogin','db'),('interf','canvz1','','canvz',NULL,'flogin','db'),('interf','curs3','','canvcurs',NULL,'flogin2','db'),('interf','relat','Cursor Name','canvRel',NULL,NULL,'db'),('main','menu1','Canvas places','menu',NULL,NULL,'db'),('main','tree1','','menu',NULL,NULL,'db');
/*!40000 ALTER TABLE `canvcurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canvs`
--

DROP TABLE IF EXISTS `canvs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canvs` (
  `idcanv` varchar(10) NOT NULL DEFAULT 'empty',
  `npp` int(11) NOT NULL DEFAULT '1' COMMENT '<>0',
  `parent` int(11) DEFAULT NULL,
  `boxname` varchar(245) DEFAULT 'empty',
  `boxtype` enum('wrap','grid','icons','tree') DEFAULT 'grid',
  `boxdir` char(5) DEFAULT 'row',
  `resize` char(2) DEFAULT NULL,
  `x` int(11) DEFAULT '0',
  `y` int(11) DEFAULT '0',
  `cursid` char(12) DEFAULT '1',
  `size` char(10) DEFAULT '',
  PRIMARY KEY (`idcanv`,`npp`),
  CONSTRAINT `fk_canvs_canvz` FOREIGN KEY (`idcanv`) REFERENCES `canvz` (`idcanv`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Закладки';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canvs`
--

LOCK TABLES `canvs` WRITE;
/*!40000 ALTER TABLE `canvs` DISABLE KEYS */;
INSERT INTO `canvs` VALUES ('dbedit',1,NULL,'empty','wrap','col','=',0,0,'1','50%'),('dbedit',2,1,'Таблиці','grid','col','=',0,0,'tabs1','20rem'),('dbedit',3,1,'Поля','grid','col','>',0,0,'field2','auto'),('dbedit',4,NULL,'Значення','grid','row','>',0,0,'data3','auto'),('dmzx',1,NULL,'Документи','grid','row','=',0,0,'dmz1','15rem'),('dmzx',3,NULL,'Рядки','grid','row','>',0,0,'dms2','auto'),('dmzx',4,NULL,'Матеріали','grid','row','>',0,0,'plmo3','auto'),('interf',1,NULL,'empty','wrap','col','=',0,0,'1','50%'),('interf',2,1,'Реєстр Інтерфейсів','grid','col','=',0,0,'canvz1','18rem'),('interf',3,1,'Interface places','grid','col','>',0,0,'canvs2','auto'),('interf',5,NULL,'empty','wrap','col','=',0,0,'1','auto'),('interf',6,5,'Курсори','grid','col','>',0,0,'curs3','auto'),('interf',7,5,'Залежності між курсорами','grid','col','>',0,0,'relat','15rem'),('main',1,NULL,'empty','wrap','col','=',0,0,'0','50%'),('main',2,1,'Дерево','tree','col','>',0,0,'tree1','auto'),('main',3,1,'Головне Меню','icons','col','>',0,0,'menu1','auto');
/*!40000 ALTER TABLE `canvs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canvz`
--

DROP TABLE IF EXISTS `canvz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canvz` (
  `idcanv` varchar(10) NOT NULL DEFAULT '' COMMENT 'id',
  `canvname` varchar(45) NOT NULL DEFAULT 'empty',
  PRIMARY KEY (`idcanv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Canvas aka Интерфейс';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canvz`
--

LOCK TABLES `canvz` WRITE;
/*!40000 ALTER TABLE `canvz` DISABLE KEYS */;
INSERT INTO `canvz` VALUES ('dbedit','Констуктор ДБ'),('default','empty'),('dmzx','Documenting...(Док)'),('interf','Interface construction'),('main','MainScreen interface for first screen');
/*!40000 ALTER TABLE `canvz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbs`
--

DROP TABLE IF EXISTS `dbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dbs` (
  `dbt` varchar(10) NOT NULL DEFAULT '',
  `fl` varchar(10) NOT NULL DEFAULT '',
  `npp` int(11) NOT NULL DEFAULT '0',
  `pkey` int(11) NOT NULL DEFAULT '0',
  `fln` varchar(20) NOT NULL DEFAULT '',
  `flt` enum('int','char','decimal','date') DEFAULT NULL,
  `len` int(11) DEFAULT '0',
  PRIMARY KEY (`dbt`,`fl`),
  CONSTRAINT `FK_dbs_dbz` FOREIGN KEY (`dbt`) REFERENCES `dbz` (`dbt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List fields of tables';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbs`
--

LOCK TABLES `dbs` WRITE;
/*!40000 ALTER TABLE `dbs` DISABLE KEYS */;
INSERT INTO `dbs` VALUES ('canvbtn','cursid',2,2,'Curs ID','char',12),('canvbtn','idcanv',1,1,'Canv id','char',10),('canvcurs','cursid',2,2,'','char',12),('canvcurs','idcanv',1,1,'Canv id','char',10),('canvrel','cursc',4,4,'','char',12),('canvrel','cursp',2,2,'','char',12),('canvrel','field_p',3,3,'','char',10),('canvrel','idcanv',1,1,'Canv id','char',10),('canvs','boxdir',6,0,'direction',NULL,NULL),('canvs','boxname',4,0,'name',NULL,NULL),('canvs','boxtype',5,0,'type',NULL,NULL),('canvs','cursid',8,0,'cursid','char',12),('canvs','idcanv',1,1,'Canv id','char',10),('canvs','npp',2,2,'npp','int',NULL),('canvs','parent',3,0,'parent',NULL,NULL),('canvs','resize',7,0,'resize',NULL,NULL),('canvs','size',9,0,'size',NULL,NULL),('canvz','canvname',1,0,'Workplace name',NULL,NULL),('canvz','idcanv',2,1,'Canv id','char',10),('dbs','dbt',1,1,'-',NULL,NULL),('dbs','fl',2,2,'-','char',10),('dbz','dbt',1,1,'-',NULL,NULL),('dms','kmat',3,0,'Material',NULL,NULL),('dms','npp',2,2,'Row id','int',NULL),('dms','undoc',1,1,'Doc ID','int',NULL),('dmz','ddm',3,0,'Date of DOC','date',NULL),('dmz','dept1',6,0,'Depertment from',NULL,NULL),('dmz','dept2',7,0,'Depertment to',NULL,NULL),('dmz','kdmt',5,0,'Type of DOC','char',NULL),('dmz','ndm',2,0,'Number of DOC',NULL,NULL),('dmz','org',4,0,'Contagent','int',NULL),('dmz','undoc',1,1,'unicField','int',NULL),('menu','id',1,1,'ID(Int)','int',NULL);
/*!40000 ALTER TABLE `dbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbz`
--

DROP TABLE IF EXISTS `dbz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dbz` (
  `dbt` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`dbt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List of tables';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbz`
--

LOCK TABLES `dbz` WRITE;
/*!40000 ALTER TABLE `dbz` DISABLE KEYS */;
INSERT INTO `dbz` VALUES ('canvbtn','Button for canvas'),('canvcurs','Work place item cursor'),('canvrel','Work place item cursors Relation'),('canvs','Work place item'),('canvz','Work place'),('dbs','Tables field'),('dbz','List of tables'),('dms','Documents content '),('dmz','Documents'),('forms','Edit forms(elements)'),('formz','Edit forms'),('menu','AKA Main menu'),('reps','Report/View(rows)'),('repz','Report/View'),('users','Access list');
/*!40000 ALTER TABLE `dbz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dms`
--

DROP TABLE IF EXISTS `dms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dms` (
  `undoc` int(11) NOT NULL,
  `npp` int(11) NOT NULL,
  `kmat` char(10) DEFAULT NULL,
  `kol` decimal(10,3) DEFAULT NULL,
  `cen` decimal(10,5) DEFAULT NULL,
  `sum` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`undoc`,`npp`),
  CONSTRAINT `FK__dmz` FOREIGN KEY (`undoc`) REFERENCES `dmz` (`undoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Documents content';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dms`
--

LOCK TABLES `dms` WRITE;
/*!40000 ALTER TABLE `dms` DISABLE KEYS */;
INSERT INTO `dms` VALUES (0,0,'хліб',0.800,NULL,NULL),(0,1,'масло',0.500,NULL,NULL),(0,2,'молоко',1.000,NULL,NULL),(1,0,NULL,NULL,NULL,NULL),(2,0,NULL,NULL,NULL,NULL),(3,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `dms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dmz`
--

DROP TABLE IF EXISTS `dmz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dmz` (
  `undoc` int(11) NOT NULL,
  `ndm` char(20) DEFAULT NULL,
  `ddm` date DEFAULT NULL,
  `org` int(11) DEFAULT NULL,
  `kdmt` char(5) DEFAULT NULL,
  `dept1` int(11) DEFAULT NULL,
  `dept2` int(11) DEFAULT NULL,
  PRIMARY KEY (`undoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Documents';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dmz`
--

LOCK TABLES `dmz` WRITE;
/*!40000 ALTER TABLE `dmz` DISABLE KEYS */;
INSERT INTO `dmz` VALUES (0,'Zero','2019-09-10',0,NULL,1,2),(1,'first','2019-09-20',0,NULL,2,2),(2,'second','2019-09-21',0,NULL,3,3),(3,'third','2019-09-23',0,NULL,1,NULL),(4,'fourth','2019-09-24',0,NULL,1,NULL);
/*!40000 ALTER TABLE `dmz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `idform` varchar(8) NOT NULL,
  `npp` int(11) NOT NULL DEFAULT '0',
  `ftype` enum('label','string','input') DEFAULT 'label',
  `name` varchar(45) DEFAULT '',
  `varn` varchar(15) DEFAULT '',
  `vart` varchar(10) DEFAULT 'C',
  `x` int(11) DEFAULT '1',
  `y` int(11) DEFAULT '1',
  `w` int(11) DEFAULT '1',
  PRIMARY KEY (`idform`,`npp`),
  CONSTRAINT `fk_forms_formz` FOREIGN KEY (`idform`) REFERENCES `formz` (`idform`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES ('flogin',1,'label','LogName','','text',1,2,1),('flogin',2,'label','Passw','','text',1,3,1),('flogin',3,'input','f1 str3','logn','text',7,2,4),('flogin',4,'input','f1 str3','pass','password',7,3,4),('flogin',5,'label','Object','','text',1,4,1),('flogin',6,'input','f1 zzzz','kobj','text',7,4,4),('flogin2',1,NULL,'f2 1','','C',1,2,1),('flogin2',2,NULL,'f2','','C',2,3,1);
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formz`
--

DROP TABLE IF EXISTS `formz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formz` (
  `idform` varchar(8) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `width` int(11) DEFAULT '1',
  `height` int(11) DEFAULT '1',
  `caption` varchar(45) DEFAULT '',
  PRIMARY KEY (`idform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formz`
--

LOCK TABLES `formz` WRITE;
/*!40000 ALTER TABLE `formz` DISABLE KEYS */;
INSERT INTO `formz` VALUES ('flogin','Login Form w/caption/title',20,15,''),('flogin2','',20,15,'Please enter your data');
/*!40000 ALTER TABLE `formz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `mtype` enum('Folder','Func') DEFAULT 'Func',
  `name` char(50) DEFAULT 'Def Name',
  `pic` char(20) DEFAULT 'Def Name',
  `mfunc` char(50) DEFAULT 'alert(''mfunc'');',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Main MENU';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,NULL,'Folder','SelfConstruktor Tools','folder.jpg',NULL),(2,NULL,'Folder','Market','folder.jpg',NULL),(3,NULL,'Folder','Factory','folder.jpg',NULL),(4,NULL,'Folder','Sample','folder.jpg',NULL),(5,1,'Func','SysDBA','def.jpg','nextCanv(\'dbedit\',this)'),(6,1,'Func','Interfaces','new.jpg','nextCanv(\'interf\',this)'),(7,9,'Func','Invoice','def.jpg',NULL),(8,4,'Func','Def Name','def.jpg',NULL),(9,2,'Folder','In','def.jpg',NULL),(10,2,'Folder','Out','def.png',NULL),(11,10,'Func','CMR','def.png',NULL),(12,10,'Func','TIR','def.png',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plmo`
--

DROP TABLE IF EXISTS `plmo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plmo` (
  `unplmo` int(11) NOT NULL,
  `undoc` int(11) DEFAULT NULL,
  `npp` int(11) DEFAULT NULL,
  `text` char(50) DEFAULT NULL,
  PRIMARY KEY (`unplmo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Materials(4test)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plmo`
--

LOCK TABLES `plmo` WRITE;
/*!40000 ALTER TABLE `plmo` DISABLE KEYS */;
INSERT INTO `plmo` VALUES (0,0,0,'Мука'),(1,0,0,'Сіль'),(2,0,0,'Вода'),(3,0,1,'Молоко'),(4,0,2,'Cухе молоко'),(5,NULL,NULL,'55555');
/*!40000 ALTER TABLE `plmo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reps`
--

DROP TABLE IF EXISTS `reps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reps` (
  `db` varchar(10) NOT NULL DEFAULT '',
  `crep` varchar(10) NOT NULL DEFAULT '',
  `npp` int(11) NOT NULL DEFAULT '0',
  `fld` varchar(15) NOT NULL DEFAULT 'NULL',
  `nfld` varchar(50) DEFAULT '',
  `hidden` char(1) NOT NULL DEFAULT '-',
  `key` char(1) DEFAULT '-',
  PRIMARY KEY (`db`,`crep`,`npp`),
  CONSTRAINT `FK_reps_repz` FOREIGN KEY (`db`, `crep`) REFERENCES `repz` (`db`, `crep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reps`
--

LOCK TABLES `reps` WRITE;
/*!40000 ALTER TABLE `reps` DISABLE KEYS */;
INSERT INTO `reps` VALUES ('canvz','canvz01',0,'idcanv','UID','+','+'),('canvz','canvz01',1,'canvname','Назва','-','-');
/*!40000 ALTER TABLE `reps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repz`
--

DROP TABLE IF EXISTS `repz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repz` (
  `db` varchar(10) NOT NULL DEFAULT '',
  `crep` varchar(10) NOT NULL DEFAULT '',
  `nrep` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`db`,`crep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ВО/ВВ/View for cursors';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repz`
--

LOCK TABLES `repz` WRITE;
/*!40000 ALTER TABLE `repz` DISABLE KEYS */;
INSERT INTO `repz` VALUES ('canvs','canvs01','Область інтерфейсу'),('canvz','canvz01','Інтерфейс/Канвас/Workplace');
/*!40000 ALTER TABLE `repz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `pazz` varchar(45) DEFAULT NULL,
  `sid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'admin','c4ca4238a0b923820dcc509a6f75849b','1','7piFkfh0qf'),(1,'alex','c4ca4238a0b923820dcc509a6f75849b','1','vFTXd6fzjJ');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-29 16:58:05
