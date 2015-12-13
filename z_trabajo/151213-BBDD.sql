-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5025
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla cont.contfpp_deudores
DROP TABLE IF EXISTS `contfpp_deudores`;
CREATE TABLE IF NOT EXISTS `contfpp_deudores` (
  `IdDeu` int(11) NOT NULL AUTO_INCREMENT,
  `deudor` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`IdDeu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla cont.contfpp_motivos
DROP TABLE IF EXISTS `contfpp_motivos`;
CREATE TABLE IF NOT EXISTS `contfpp_motivos` (
  `IdMot` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdMot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla cont.contfpp_movimientos
DROP TABLE IF EXISTS `contfpp_movimientos`;
CREATE TABLE IF NOT EXISTS `contfpp_movimientos` (
  `IdMov` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`IdMov`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla cont.contfpp_movimientos_final
DROP TABLE IF EXISTS `contfpp_movimientos_final`;
CREATE TABLE IF NOT EXISTS `contfpp_movimientos_final` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime DEFAULT NULL,
  `Movimiento` int(4) DEFAULT NULL,
  `Motivo` int(5) DEFAULT NULL,
  `Euros` double DEFAULT NULL,
  `Deudor` int(5) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla cont.contfpp_usuarios
DROP TABLE IF EXISTS `contfpp_usuarios`;
CREATE TABLE IF NOT EXISTS `contfpp_usuarios` (
  `IdUsu` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) DEFAULT NULL,
  `clave` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IdUsu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
