-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla bienes_raices.propiedades: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedorId`) VALUES
	(1, 'Mi casa pro', 12000.00, '0770df11c8a1667100a96b862d633b1f.jpg', 'Hola chavales en este dÃ­a os vengo a mi presentar mi nueva casita de minecraft mientras que a la vez intento manetener mi buena practica de escritura que ya te puedes dar cuenta que es una completa kk', 2, 1, 2, '2022-06-04', 1),
	(2, 'Mi casa tÃ­o 2', 12000.00, '2d772acac3c6562c85ec91e434c850f7.jpg', 'Hola chavales en este dÃ­a os vengo a mi presentar mi nueva casita de minecraft mientras que a la vez intento manetener mi buena practica de escritura que ya te puedes dar cuenta que es una completa kk', 2, 1, 2, '2022-06-04', 1),
	(3, 'Mi casa tÃ­o 3', 12000.00, 'b1a2d0d98db76e3ccc55216f762db342.jpg', 'Hola chavales en este dÃ­a os vengo a mi presentar mi nueva casita de minecraft mientras que a la vez intento manetener mi buena practica de escritura que ya te puedes dar cuenta que es una completa kk', 2, 1, 2, '2022-06-04', 1),
	(4, 'Mi casa tÃ­o 4', 12000.00, 'c209d59a432f83eda7b555d76c86b3aa.jpg', 'Hola chavales en este dÃ­a os vengo a mi presentar mi nueva casita de minecraft mientras que a la vez intento manetener mi buena practica de escritura que ya te puedes dar cuenta que es una completa kk', 2, 1, 2, '2022-06-04', 1),
	(5, 'Casita pa', 232000.00, 'bf8a7d6e27f5db6fde3336b6b745a7bc.jpg', 'Hola lorem ipsum como hacer mantequilla en realidad ni yo sÃ© que chotas estoy escribiendo #GRASA', 5, 2, 1, '2022-06-04', 2);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;

-- Volcando datos para la tabla bienes_raices.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `pass`) VALUES
	(2, 'correo@correo.com', '$2y$10$2Doenv4oLpHQKiVPk4qX7OuJaSASaONGAIoPUfU7nlXzf70zj0Fdm');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando datos para la tabla bienes_raices.vendedores: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
	(1, 'Mateo', 'Elias', '22770014'),
	(2, 'Juan', 'De la Torre', '12022244');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
