# ************************************************************
# Sequel Ace SQL dump
# Versão 20046
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Servidor: 127.0.0.1 (MySQL 8.0.32)
# Banco de Dados: fluxo
# Tempo de geração: 2023-05-18 21:46:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump de tabela categorias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;

INSERT INTO `categorias` (`id`, `nome`, `descricao`)
VALUES
	(1,'categoria 1','descricao'),
	(2,'categoria 2','descricao');

/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela lancamentos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lancamentos`;

CREATE TABLE `lancamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data_lancamento` varchar(50) NOT NULL,
  `valor` varchar(50) NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `categoria_id` int NOT NULL,
  `pagamento_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pagamento` (`pagamento_id`) USING BTREE,
  KEY `categoria_lancamento` (`categoria_id`) USING BTREE,
  CONSTRAINT `lancamentos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `lancamentos_ibfk_2` FOREIGN KEY (`pagamento_id`) REFERENCES `pagamentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `lancamentos` WRITE;
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;

INSERT INTO `lancamentos` (`id`, `data_lancamento`, `valor`, `descricao`, `tipo`, `categoria_id`, `pagamento_id`)
VALUES
	(1,'2022-03-22','2.39','Descrição teste','Rendimento',2,1),
	(2,'2023-11-30','0.05','Descrição teste','Despesa',1,1),
	(3,'2002-02-20','1937.74','Descrição teste','Despesa',2,2),
	(6,'2009-10-14','20','Incidunt porro volu','Despesa',2,3);

/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela pagamentos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pagamentos`;

CREATE TABLE `pagamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;

INSERT INTO `pagamentos` (`id`, `nome`)
VALUES
	(1,'Boleto'),
	(2,'Credito'),
	(3,'Debito'),
	(4,'Pix');

/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `name`, `password`)
VALUES
	(1,'admin','teste'),
	(2,'funcionario','1234');

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
