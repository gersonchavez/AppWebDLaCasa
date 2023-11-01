-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 01:25 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdrestaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_plato` int(11) NOT NULL,
  `nombre_plato` varchar(255) NOT NULL,
  `precio_plato` varchar(255) NOT NULL,
  `imagen_plato` varchar(355) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `precio_total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_cliente` varchar(355) NOT NULL,
  `dni_cliente` varchar(12) NOT NULL,
  `celular_cliente` varchar(100) NOT NULL,
  `direccion` varchar(355) NOT NULL,
  `platosorden` varchar(355) NOT NULL,
  `tipo_comprobante` varchar(50) NOT NULL,
  `tipo_pedido` tinyint(1) NOT NULL,
  `precio_total` varchar(355) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `nombre_cliente`, `dni_cliente`, `celular_cliente`, `direccion`, `platosorden`, `tipo_comprobante`, `tipo_pedido`, `precio_total`, `estado`) VALUES
(116, 1, 'Jeremias Roberto Solano Valdiviezo', '12345678', '602014', 'Av. Abancay 456 A espaldas del cementerio.', 'Alitas Broaster PeruvianChef(3), Alita broaster con yuca(6), Nuggets di pollo(3)', 'boleta', 1, '276', 'SERVIDO EN MESA'),
(117, 1, 'Victor Gonzales Modragon', '15986578', '956896598', 'El Olimpo 169 Urb. El ParaÃ­so. Las Brisas', 'Alitas Broaster PeruvianChef(10), Alita broaster con yuca(20)', 'factura', 1, '520', 'NUEVO'),
(118, 2, 'Ivar Lothbrok De Niro', '15878965', '958657854', 'El Olimpo 258 El ParaÃ­so. Las Brisas', 'Nuggets di pollo(3), Spaghetti con crema de burrata(2)', 'boleta', 2, '171', 'REPARTIDO POR DELIVERY'),
(119, 1, 'Maria Martha Torres Ruiz', '69859874', '958687549', '', 'Alita broaster con yuca(4), Nuggets di pollo(2)', 'boleta', 1, '114', 'CULMINADO'),
(123, 1, 'Jeremias Roberto Solano', '16789208', '507169', 'El Olimpo1212', 'Alita broaster con yuca(4)', 'boleta', 2, '34', 'NUEVO'),
(124, 1, 'Yony Hugo Chinchay InoÃ±an', '08196004', '978972449', 'Pinos De La Plata 450 - Lambayeque - Lambayeque', 'Alitas Broaster PeruvianChef(2), Alita broaster con yuca(2), Pollo Broaster(2)', 'boleta', 2, '108', 'EN PROCESO'),
(125, 1, 'Marco Requejo Flores', '15968748', '958689575', 'Condominio Los Paqrque 190 - Chiclayo', 'Alitas Broaster PeruvianChef(1), Alita broaster con yuca(1)', 'factura', 1, '43.5', 'NUEVO'),
(126, 1, 'Rigoberto Jimenez Valderrama', '15968987', '956898789', 'La Purisima 156 - JLO', 'Alitas Broaster PeruvianChef(2), Spaghetti con crema de burrata(2)', 'boleta', 2, '121', 'CULMINADO'),
(127, 1, 'Emanuel Vasquez Gutierrez', '15879868', '963587489', '', 'Spaghetti con crema de burrata(5), Alita broaster con yuca(2)', 'boleta', 2, '144.5', 'REPARTIDO POR DELIVERY'),
(128, 1, 'Diego Roberto Seminario Sanchez', '15987458', '956358789', '', 'Alitas Broaster PeruvianChef(3), Nuggets di pollo(1)', 'factura', 1, '145', 'COBRADO');

-- --------------------------------------------------------

--
-- Table structure for table `plato`
--

CREATE TABLE `plato` (
  `id_plato` int(11) NOT NULL,
  `nombre_plato` varchar(355) NOT NULL,
  `descripcion` varchar(355) NOT NULL,
  `precio_unidad` varchar(255) NOT NULL,
  `plato_image` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plato`
--

INSERT INTO `plato` (`id_plato`, `nombre_plato`, `descripcion`, `precio_unidad`, `plato_image`) VALUES
(1, 'Alitas Broaster PeruvianChef', 'Plato de 10 alitas con más piqueos incluidos como que garantizan su calidad y satisfaccion despuesd e haberlas devorado.', '35', 'images/alitasbroaster.png'),
(2, 'Alita broaster con yuca', 'Plato personal de 3 alitas con yuca frita incluida. Recomendado para el desayuno y dar las energías necesarias para el resto del dia.', '8.5', 'images/alitasconyuca.png'),
(3, 'Nuggets di pollo', 'Plato de 10 nuggets de pollo con salsa barbeque. Disfrutalo en cualquier momento del dia, no te arrepentiras de nada.', '40', 'images/nuggetsdipollo.png'),
(4, 'Spaghetti con crema de burrata', 'Plato cremoso de spaguetti, enriquecido por el crujiente de las berenjenas y los piñones.', '25.5', 'images/spaghetti.png'),
(5, 'Pollo Broaster', 'Delicioso Pollo Broaster especial de la casa con 10 porciones de diferentes partes que garantizaran la satisfacciÃ³n a quiÃ©n lo deleite.', '10.50', 'images/pollobroaster.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(355) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `email`, `contrasena`, `tipo_usuario`) VALUES
(1, 'Igor Chinchay Farronay', 'igor2008_11@hotmail.com', '123', 'mozo'),
(2, 'Braulio Chinchay Farronay', 'braulio@hotmail.com', '123', 'administracion'),
(3, 'Mary Jane Wattson', 'mary@hotmail.com', '123', 'cocina'),
(4, 'Marco Requejo Flores', 'marco@hotmail.com', '123', 'delivery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `fk_detalle_platoid` (`id_plato`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_usuario_pedido` (`id_usuario`);

--
-- Indexes for table `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`id_plato`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `plato`
--
ALTER TABLE `plato`
  MODIFY `id_plato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_detalle_platoid` FOREIGN KEY (`id_plato`) REFERENCES `plato` (`id_plato`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_usuario_pedido` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
