
DROP SCHEMA IF EXISTS BabyControl;

CREATE SCHEMA BabyControl;

USE BabyControl;


DROP TABLE IF EXISTS `BabyControl`.`cadastrousuario` ;

	CREATE TABLE IF NOT EXISTS `BabyControl`.`cadastrousuario` (
	  `id_usuario` INT NOT NULL AUTO_INCREMENT,
      `nome_usuario` VARCHAR(45) NOT NULL,
      `cpf_usuario` VARCHAR(11) NOT NULL,
      `Login_usuario` VARCHAR(30) NULL,
      `Senha_usuario` VARCHAR(45) NULL,
      `status` CHAR(1) NULL,
      PRIMARY KEY (`id_usuario`));



DROP TABLE IF EXISTS `BabyControl`.`cadastrosensores` ;

CREATE TABLE IF NOT EXISTS `BabyControl`.`cadastrosensores` (
  `id_sensor` INT NOT NULL AUTO_INCREMENT,
  `nome_sensor` VARCHAR(45) NOT NULL,
  `localizacao_sensor` CHAR(1) NOT NULL,
  `tipo_sensor` VARCHAR(45) NULL,
  `status_sensor` CHAR(1) NULL,
  PRIMARY KEY (`id_sensor`));



DROP TABLE IF EXISTS `BabyControl`.`cadastrocomponentes` ;

CREATE TABLE IF NOT EXISTS `BabyControl`.`cadastrocomponentes` (
  `id_componente` INT NOT NULL AUTO_INCREMENT,
  `nome_componente` VARCHAR(45) NULL,
  `tipo_componente` CHAR(1) NULL,
  `status` CHAR(1) NULL,
  PRIMARY KEY (`id_componente`));


DROP TABLE IF EXISTS `BabyControl`.`configuracaosensor` ;

CREATE TABLE IF NOT EXISTS `BabyControl`.`configuracaosensor` (
  `id_configuracaosensor` INT NOT NULL AUTO_INCREMENT,
  `id_sensor` INT NOT NULL,
  `tipo_de_leitura` CHAR(1) NULL,
  `intervalo_de_tempo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_configuracaosensor`),
  CONSTRAINT `id_sensor1`
    FOREIGN KEY (`id_sensor`)
    REFERENCES `cadastrosensores` (`id_sensor`));


DROP TABLE IF EXISTS `BabyControl`.`cadastroberco` ;

CREATE TABLE IF NOT EXISTS `BabyControl`.`cadastroberco` (
  `id_berco` INT NOT NULL AUTO_INCREMENT,
  `nome_crianca` VARCHAR(45) NOT NULL,
  `idade_crianca` CHAR(2) NOT NULL,
  `quantidadesensores` VARCHAR(45) NOT NULL,
  `status` CHAR(1) NULL,
  `id_usuario` INT NULL,
  `id_sensor` INT NULL,
  `id_componente` INT NULL,
  PRIMARY KEY (`id_berco`),
  CONSTRAINT `id_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `BabyControl`.`cadastrousuario` (`id_usuario`),
  CONSTRAINT `id_sensor2`
    FOREIGN KEY (`id_sensor`)
    REFERENCES `BabyControl`.`cadastrosensores` (`id_sensor`),	
  CONSTRAINT `id_componente1`
    FOREIGN KEY (`id_componente`)
    REFERENCES `cadastrocomponentes` (`id_componente`));



DROP TABLE IF EXISTS `BabyControl`.`armazenamentodados` ;

CREATE TABLE IF NOT EXISTS `BabyControl`.`armazenamentodados` (
  `id_armazenamentoaados` INT NOT NULL AUTO_INCREMENT,
  `id_berco` INT NULL,
  `id_sensor` INT NULL,
  `data_hora_evento` DATETIME NULL,
  `tipo_evento` VARCHAR(10) NULL,
  PRIMARY KEY (`id_armazenamentoaados`),
  CONSTRAINT `id_sensor`
    FOREIGN KEY (`id_sensor`)
    REFERENCES `BabyControl`.`cadastrosensores` (`id_sensor`),
  CONSTRAINT `id_berco`
    FOREIGN KEY (`id_berco`)
    REFERENCES `cadastroberco` (`id_berco`));

