-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema incidentmng
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema incidentmng
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `incidentmng` DEFAULT CHARACTER SET utf8 ;
USE `incidentmng` ;

-- -----------------------------------------------------
-- Table `incidentmng`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`categorias` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `descripcion` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`chat` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `incident_id` INT(10) UNSIGNED NOT NULL,
  `from_user_id` INT(10) UNSIGNED NOT NULL,
  `to_user_id` INT(11) NULL DEFAULT NULL,
  `mensaje` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `table_chat_incident_id_foreign` (`incident_id` ASC),
  INDEX `table_chat_from_user_id_foreign` (`from_user_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`incidencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`incidencias` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(150) CHARACTER SET 'utf8mb4' NOT NULL,
  `descripcion` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `severidad` VARCHAR(1) CHARACTER SET 'utf8mb4' NOT NULL,
  `categoria_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `nivel_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `cliente_id` INT(10) UNSIGNED NOT NULL,
  `soporte_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `proyecto_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `activa` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `incidencias_categoria_id_foreign` (`categoria_id` ASC),
  INDEX `incidencias_nivel_id_foreign` (`nivel_id` ASC),
  INDEX `incidencias_cliente_id_foreign` (`cliente_id` ASC),
  INDEX `incidencias_soporte_id_foreign` (`soporte_id` ASC),
  INDEX `incidencias_proyecto_id_foreign` (`proyecto_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`menus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`menus` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `menu_padre_id` INT(11) NULL DEFAULT NULL,
  `ruta` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `posicion` INT(11) NOT NULL,
  `ocultar` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 38
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`niveles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`niveles` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`pantallas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`pantallas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `boton_nuevo` TINYINT(1) NOT NULL DEFAULT '0',
  `boton_grabar` TINYINT(1) NOT NULL DEFAULT '0',
  `boton_eliminar` TINYINT(1) NOT NULL DEFAULT '0',
  `menu_id` INT(11) NULL DEFAULT NULL,
  `es_escritorio` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`password_resets` (
  `email` VARCHAR(150) CHARACTER SET 'utf8mb4' NOT NULL,
  `token` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`permisos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rol_id` INT(10) UNSIGNED NOT NULL,
  `ver` TINYINT(1) NOT NULL,
  `crear` TINYINT(1) NOT NULL,
  `modificar` TINYINT(1) NOT NULL,
  `eliminar` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `pantalla_id` INT(10) UNSIGNED NOT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `permisos_rol_id_foreign` (`rol_id` ASC),
  INDEX `permisos_pantalla_id_foreign` (`pantalla_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`proyectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`proyectos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `descripcion` VARCHAR(255) CHARACTER SET 'utf8mb4' NULL DEFAULT NULL,
  `fecha_inicio` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`roles` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`user_project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`user_project` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED NOT NULL,
  `nivel_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `proyecto_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_project_user_id_foreign` (`user_id` ASC),
  INDEX `user_project_nivel_id_foreign` (`nivel_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 31
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `incidentmng`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidentmng`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `email` VARCHAR(150) CHARACTER SET 'utf8mb4' NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `role_id` INT(10) UNSIGNED NOT NULL,
  `selected_project_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC),
  INDEX `users_selected_project_id_foreign` (`selected_project_id` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
