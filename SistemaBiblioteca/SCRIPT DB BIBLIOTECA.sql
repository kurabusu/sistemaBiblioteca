-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `db_biblioteca` ;

-- -----------------------------------------------------
-- Table `db_biblioteca`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(5) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`libro` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `isbn` VARCHAR(45) NOT NULL,
  `titulo` VARCHAR(50) NOT NULL,
  `autor` VARCHAR(45) NOT NULL,
  `editorial` VARCHAR(15) NOT NULL,
  `annio` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `categoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `categoria_id`),
  INDEX `fk_libro_categoria1_idx` (`categoria_id` ASC),
  CONSTRAINT `fk_libro_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `db_biblioteca`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`persona` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rut` VARCHAR(15) NOT NULL,
  `nombres` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  `estado` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`historico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`historico` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` DATE NOT NULL,
  `fecha_devolucion` DATE NOT NULL,
  `libro_id` INT(11) NOT NULL,
  `persona_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `libro_id`, `persona_id`),
  INDEX `fk_historico_libro1_idx` (`libro_id` ASC),
  INDEX `fk_historico_persona1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_historico_libro1`
    FOREIGN KEY (`libro_id`)
    REFERENCES `db_biblioteca`.`libro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historico_persona1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `db_biblioteca`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`perfil` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(30) NOT NULL,
  `estado` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`prestamo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` DATE NOT NULL,
  `persona_id` INT(11) NOT NULL,
  `libro_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `persona_id`, `libro_id`),
  INDEX `fk_prestamo_persona1_idx` (`persona_id` ASC),
  INDEX `fk_prestamo_libro1_idx` (`libro_id` ASC),
  CONSTRAINT `fk_prestamo_persona1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `db_biblioteca`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestamo_libro1`
    FOREIGN KEY (`libro_id`)
    REFERENCES `db_biblioteca`.`libro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`reserva` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha_reserva` DATE NOT NULL,
  `persona_id` INT(11) NOT NULL,
  `libro_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `persona_id`, `libro_id`),
  INDEX `fk_reserva_persona1_idx` (`persona_id` ASC),
  INDEX `fk_reserva_libro1_idx` (`libro_id` ASC),
  CONSTRAINT `fk_reserva_persona1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `db_biblioteca`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_libro1`
    FOREIGN KEY (`libro_id`)
    REFERENCES `db_biblioteca`.`libro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_biblioteca`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_biblioteca`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `estado` INT(11) NOT NULL,
  `perfil_id` INT(11) NOT NULL,
  `persona_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `perfil_id`, `persona_id`),
  INDEX `fk_usuario_perfil_idx` (`perfil_id` ASC),
  INDEX `fk_usuario_persona1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_usuario_perfil`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `db_biblioteca`.`perfil` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_persona1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `db_biblioteca`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
