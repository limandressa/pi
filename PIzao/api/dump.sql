/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.32-MariaDB : Database - bdpi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdpi` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bdpi`;

/*Table structure for table `bairro` */

DROP TABLE IF EXISTS `bairro`;

CREATE TABLE `bairro` (
  `idbairro` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `cidade_idcidade` int(11) NOT NULL,
  PRIMARY KEY (`idbairro`),
  KEY `fk_bairro_cidade_idx` (`cidade_idcidade`),
  CONSTRAINT `fk_bairro_cidade` FOREIGN KEY (`cidade_idcidade`) REFERENCES `cidade` (`idcidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bairro` */

insert  into `bairro`(`idbairro`,`nome`,`latitude`,`longitude`,`cidade_idcidade`) values 
(1,'Ariribá',-26.968349,-48.641772,1),
(2,'Centro',-26.995866,-48.634417,1),
(3,'Barra',-27.009544,-48.601366,1),
(4,'Barra Sul',-27.003548,-48.618071,1),
(5,'Bairro das Nações',-26.978573,-48.646438,1),
(6,'Bairro dos Estados',-26.993587,-48.651188,1),
(7,'Bairro dos Municípios',-27.004752,-48.638228,1),
(8,'Bairro dos Pioneiros',-26.969875,-48.635396,1),
(9,'Estaleiro',-27.02838,-48.58364,1),
(10,'Jardim Iate Clube',-27.013964,-48.632899,1),
(11,'Nova Esperança',-27.027761,-48.611948,1),
(12,'Praia dos Amores',-26.955857,-48.636568,1),
(13,'São Judas Tadeu',-27.022994,-48.603254,1),
(14,'Taquaras',-27.011994,-48.580807,1),
(15,'Vila Real',-27.005874,-48.629317,1),
(16,'Areias',-27.03083,-48.667454,2),
(17,'Cedro',-27.029851,-48.65387,2),
(18,'Centro de Camboriú',-27.019265,-48.652222,2),
(19,'Conde Vila Verde',-27.045479,-48.636856,2),
(20,'Monte Alegre',-27.000066,-48.66568,2),
(21,'Rio Pequeno',-27.037683,-48.634028,2),
(22,'Santa Regina',-27.035901,-48.671211,2),
(23,'São Francisco de Assis',-27.020809,-48.63742,2),
(24,'Tabuleiro',-27.005905,-48.654688,2),
(25,'Várzea do Ranchinho',-26.982548,-48.680345,2),
(26,'Arraial dos Cunhas',-26.975733,-48.793182,3),
(27,'Baía',-26.963514,-48.751043,3),
(28,'Barra do Rio',-26.89168,-48.679782,3),
(29,'Brilhante I',-27.002016,-48.795282,3),
(30,'Brilhante II',-27.036034,-48.801488,3),
(31,'Cabeçudas',-26.927948,-48.634719,3),
(32,'Campeche',-26.997151,-48.841207,3),
(33,'Canhanduba',-26.959157,-48.680656,3),
(34,'Carvalho',-26.915233,-48.686799,3),
(35,'Centro de Itajaí',-26.907542,-48.661449,3),
(36,'Cidade Nova',-26.923321,-48.696599,3),
(37,'Cordeiros',-26.88671,-48.700724,3),
(38,'Costa Cavalcanti',-26.896021,-48.704383,3),
(39,'Dom Bosco',-26.919247,-48.678439,3),
(40,'Espinheiros',-26.89771,-48.711293,3),
(41,'Fazenda',-26.926098,-48.648424,3),
(42,'Imaruí',-26.888715,-48.672758,3),
(43,'Itaipava',-26.944363,-48.733278,3),
(44,'Limoeiro',-27.029973,-48.858569,3),
(45,'Murta',-26.869874,-48.697197,3),
(46,'Nossa Senhora das Graças',-26.922251,-48.665845,3),
(47,'Paciência',-26.973512,-48.767821,3),
(48,'Praia Brava',-26.947689,-48.640325,3),
(49,'Quilometro 12',-26.963046,-48.68986,3),
(50,'Ressacada',-26.927541,-48.676119,3),
(51,'Rio Bonito',-26.907589,-48.705073,3),
(52,'Salseiros',-26.867957,-48.728695,3),
(53,'São João',-26.901218,-48.677739,3),
(54,'São Judas',-26.912854,-48.679196,3),
(55,'São Roque',-26.91441,-48.760361,3),
(56,'São Vicente',-26.907331,-48.692132,3),
(57,'Vila Operária',-26.909409,-48.671281,3);

/*Table structure for table `cidade` */

DROP TABLE IF EXISTS `cidade`;

CREATE TABLE `cidade` (
  `idcidade` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`idcidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cidade` */

insert  into `cidade`(`idcidade`,`nome`,`latitude`,`longitude`) values 
(1,'Balneário Camboriú',-26.999606,-48.637658),
(2,'Camboriú',-27.026875,-48.655285),
(3,'Itajaí',-26.990414,-48.634429);

/*Table structure for table `classificacao` */

DROP TABLE IF EXISTS `classificacao`;

CREATE TABLE `classificacao` (
  `data` datetime NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `bairro_idbairro` int(11) NOT NULL,
  `valor` tinyint(1) NOT NULL,
  PRIMARY KEY (`data`,`usuario_email`),
  KEY `fk_classificacao_bairro1_idx` (`bairro_idbairro`),
  KEY `fk_classificacao_usuario1_idx` (`usuario_email`),
  CONSTRAINT `fk_classificacao_bairro1` FOREIGN KEY (`bairro_idbairro`) REFERENCES `bairro` (`idbairro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_classificacao_usuario1` FOREIGN KEY (`usuario_email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `classificacao` */

insert  into `classificacao`(`data`,`usuario_email`,`bairro_idbairro`,`valor`) values 
('2018-09-15 15:32:15','abc@gmail.com',18,1),
('2018-09-15 15:32:19','abc@gmail.com',18,1),
('2018-09-15 15:32:20','abc@gmail.com',18,1),
('2018-09-15 15:32:21','abc@gmail.com',18,1),
('2018-09-15 15:32:25','abc@gmail.com',18,1),
('2018-09-15 15:32:26','abc@gmail.com',18,1),
('2018-09-20 09:56:22','abc@gmail.com',18,1),
('2018-09-20 14:05:43','asd@gmail.com',18,1),
('2018-09-20 14:05:51','asd@gmail.com',3,1),
('2018-09-23 11:51:23','a',18,1),
('2018-09-23 11:52:43','a',18,1),
('2018-09-23 11:53:10','a',18,1),
('2018-09-24 17:21:26','c',18,1),
('2018-09-25 17:25:27','a',18,1),
('2018-09-27 19:14:45','a',18,1),
('2018-09-27 19:19:12','a',18,1),
('2018-09-27 19:24:01','a',18,1),
('2018-10-02 17:31:51','a',48,1),
('2018-10-03 12:16:16','a',4,1),
('2018-10-09 15:07:06','a',9,1),
('2018-10-09 15:07:08','a',9,1),
('2018-10-09 15:07:10','a',9,1),
('2018-10-09 15:07:12','a',9,1),
('2018-10-09 15:07:14','a',9,1),
('2018-10-09 15:13:06','a',9,1),
('2018-10-11 16:57:15','a',9,1),
('2018-10-11 17:20:35','a',9,1),
('2018-10-11 17:21:06','a',9,1),
('2018-10-11 17:21:29','a',3,1),
('2018-10-16 14:38:46','a',3,1),
('2018-10-16 14:39:41','a',3,1),
('2018-11-06 16:40:31','a',18,1),
('2018-11-06 16:46:09','a',9,1),
('2018-11-06 16:47:20','a',9,1),
('2018-11-06 16:47:48','a',9,1),
('2018-11-06 16:48:04','a',9,1),
('2018-11-06 16:48:05','a',9,1),
('2018-11-06 16:48:27','a',9,1),
('2018-11-06 16:48:42','a',9,0),
('2018-11-06 16:49:28','a',9,1),
('2018-11-06 16:50:20','a',9,1),
('2018-11-13 14:43:34','a',9,1),
('2018-11-13 14:44:17','a',9,0),
('2018-12-01 13:15:33','a',18,1),
('2018-12-01 14:13:57','w',18,1),
('2018-12-01 14:14:45','ab',18,1),
('2018-12-01 14:15:19','nn',18,1),
('2018-12-01 14:15:42','pio',18,1),
('2018-12-01 14:16:24','ww',18,1),
('2018-12-01 15:00:20','a',3,0),
('2018-12-01 15:01:03','a',3,0),
('2018-12-01 15:01:05','a',3,0),
('2018-12-01 15:01:08','a',3,0),
('2018-12-01 15:01:10','a',3,0),
('2018-12-01 15:01:12','a',3,0),
('2018-12-01 22:52:19','cmas',18,1),
('2018-12-02 10:45:17','accc',18,0),
('2018-12-02 10:49:56','tom',18,0),
('2018-12-03 23:27:14','a',18,1),
('2018-12-03 23:27:18','a',18,0);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(15) NOT NULL,
  `bairro_idbairro` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_usuario_bairro1_idx` (`bairro_idbairro`),
  CONSTRAINT `fk_usuario_bairro1` FOREIGN KEY (`bairro_idbairro`) REFERENCES `bairro` (`idbairro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

insert  into `usuario`(`email`,`nome`,`senha`,`bairro_idbairro`,`data`) values 
('a','a','a',25,'2018-09-09 00:00:00'),
('aaaa','aaaaaa','q',25,'2018-11-13 15:03:13'),
('ab','ab','aa',25,'2018-11-13 15:03:13'),
('abc@gmail.com','a','123',25,'2018-11-13 15:03:13'),
('accc','aaa','ii',25,'2016-01-12 00:00:00'),
('acccc','aaa','ixi',25,'2016-01-12 00:00:00'),
('adsdfsd','sddas','a',11,NULL),
('andressa','andressa','andressa',25,'2018-11-13 15:03:13'),
('andressasts1@gmail.com','Tom Cruise','123456',25,'2018-12-04 11:01:25'),
('asd@gmail.com','a','123',25,'2018-11-13 15:03:13'),
('ax@gmail.com','xx','123',25,'2018-11-13 15:03:13'),
('axcccc','aaa','ixi',25,'2016-01-12 00:00:00'),
('az@gmail.com','a','123',25,'2018-11-13 15:03:13'),
('b1@gmail.com','b','123',25,'2018-11-13 15:03:13'),
('b3@gmail.com','b','123',25,'2018-11-13 15:03:13'),
('b@gmail.com','b','123',25,'2018-11-13 15:03:13'),
('beltrano@gmail.com','beltrano','123',25,'2018-11-13 15:03:13'),
('c','aaaaa','aaa',25,'2018-11-13 15:03:13'),
('c@gmail.com','c','123',25,'2018-11-13 15:03:13'),
('cmas','aaa','ii',25,NULL),
('cmsas','aaa','ii',25,'2018-01-01 00:00:00'),
('d','Nicole Kidman','aaa',25,'2018-11-13 15:03:13'),
('e','e','ee',25,'2018-11-13 15:03:13'),
('f','f','ff',25,'2018-11-13 15:03:13'),
('fulano@gmail.com','fulano','123',25,'2018-11-13 15:03:13'),
('kk','kk','kk',25,'2018-11-13 15:03:13'),
('m','m','mm',25,'2018-11-13 15:03:13'),
('mas','aaa','ii',35,NULL),
('mdfas','aaa','ii',25,'1998-09-09 00:00:00'),
('mdffas','aaa','ii',25,'2018-01-12 00:00:00'),
('mdffssfas','aaa','ii',3,'2016-01-12 00:00:00'),
('mdfssfas','aaa','ii',25,'2016-01-12 00:00:00'),
('mn','mn','b',25,'2018-11-13 15:03:13'),
('mnm','mn','b',25,'2018-11-13 15:03:13'),
('nn','nn','nn',25,'2018-11-13 15:03:13'),
('nnb','nnb','nnb',25,'2018-11-13 15:03:13'),
('pio','pio','pio',25,'2018-11-13 15:03:13'),
('piob','pio','pio',25,'2018-11-13 15:03:13'),
('sqsq','aqq','aqq',25,'2018-11-13 15:03:13'),
('sqsqa','aqq','aqaq',25,'2018-11-13 15:03:13'),
('ss','ss','ss',25,'2018-11-13 15:03:13'),
('tom','tom','oo',25,'2018-12-02 10:49:56'),
('w','www','ww',25,'2018-11-13 15:03:13'),
('ww','ww','ww',25,'2018-11-13 15:03:13'),
('x@gmail.com','x','123',25,'2018-11-13 15:03:13'),
('zzz','zz','zz',25,'2018-11-13 15:03:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
