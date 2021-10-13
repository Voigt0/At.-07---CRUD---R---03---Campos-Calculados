CREATE TABLE `carro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `km` double DEFAULT NULL,
  `dataFabricacao` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `carro` (`id`, `nome`, `valor`, `km`, `dataFabricacao`) VALUES ('1', 'Hyundai HB20', '60000', '10000', '2020-01-01');
INSERT INTO `carro` (`id`, `nome`, `valor`, `km`, `dataFabricacao`) VALUES ('2', 'Fiat Argo', '90000', '100000', '2008-02-02');
INSERT INTO `carro` (`id`, `nome`, `valor`, `km`, `dataFabricacao`) VALUES ('3', 'Chevrolet Onix', '80000', '105000', '2010-03-03');
INSERT INTO `carro` (`id`, `nome`, `valor`, `km`, `dataFabricacao`) VALUES ('4', 'Fiat Mobi', '75000', '59000', '2016-10-15');
INSERT INTO `carro` (`id`, `nome`, `valor`, `km`, `dataFabricacao`) VALUES ('5', 'Volkswagen Gol', '70000', '65000', '2009-09-09');