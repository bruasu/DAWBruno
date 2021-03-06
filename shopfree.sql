-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2018 at 09:18 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopfree`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(5) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`) VALUES
(1, 'Electrodomesticos'),
(2, 'Celulares'),
(3, 'Ropa'),
(4, 'Camiseta'),
(10, 'Computadora de Mesa');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `precio_promocional` float NOT NULL,
  `cantidad` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `foto`, `precio_compra`, `precio_venta`, `precio_promocional`, `cantidad`, `status`, `id_categoria`) VALUES
(1, 'lavadora Ultimation', 'producto para lavar las ropas que estan sucias', '1541442953.jpg', 9000, 14000, 12500, 15, 1, 1),
(4, 'Celular J1', 'Celular de pantalla tactil', '1541442958.jpg', 1200, 2500, 1999, 60, 1, 2),
(5, 'Camisetas', 'tamaño P M G', '1541442963.jpg', 100, 190, 150, 20, 1, 4),
(7, 'lavadora', 'producto para lavar las ropas que estan sucias', '1541442973.jpg', 8000, 12000, 10500, 10, 1, 1),
(8, 'PC Pentium casi 5', 'computadora de ultima Generacion, Ultimo de los Ultimo', '1541442986.jpg', 15000.1, 22000.2, 19950, 40, 1, 10),
(9, 'Celular J7', 'celular con pantalla de 5.5" con un procesador de 8 nucleos', '1541442993.jpg', 5000, 8000, 7200, 50, 1, 2),
(11, 'Camisetas2', 'tamaño P M G', '1541442999.jpg', 100, 190, 150, 20, 1, 4),
(12, 'Pantalones', 'Tamaï¿½o P M G', '1541443019.jpg', 100, 187, 150, 40, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `productos_ventas`
--

CREATE TABLE `productos_ventas` (
  `id_productos` int(11) NOT NULL,
  `id_ventas` int(11) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `valor_producto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos_ventas`
--

INSERT INTO `productos_ventas` (`id_productos`, `id_ventas`, `cantidad`, `valor_producto`) VALUES
(1, 1, 10, 500),
(11, 2, 15, 100),
(4, 3, 14, 200),
(8, 1, 10, 8000),
(12, 6, 10, 455),
(9, 3, 60, 500),
(7, 9, 1, 9000),
(5, 10, 50, 1245),
(4, 7, 10, 12752),
(11, 4, 10, 582);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `contrasena` varchar(72) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `contrasena`, `email`, `fecha_nacimiento`, `telefono`, `celular`, `status`, `tipo`) VALUES
(1, 'Bruno', 'Asuncion', '12345678', 'bruasu@gmail.com', '1990-03-24', '', '', '1', 'admin'),
(2, 'Rafael', 'Asuncion', '12345678', 'bruasu1@gmail.com', '1990-03-24', '', '', '1', '1'),
(3, 'Karen', 'Lemos', '12345678', 'bruasu2@gmail.com', '1990-03-24', '', '', '1', '1'),
(4, 'Leticia', 'Da Silva', '12345678', 'bruasu3@gmail.com', '1990-03-24', '', '', '1', '1'),
(5, 'Kesia', 'Da Silva', '12345678', 'bruasu4@gmail.com', '1990-03-24', '', '', '1', '1'),
(6, 'Simone', 'Da Silva', '12345678', 'bruasu5@gmail.com', '1990-03-24', '', '', '1', '1'),
(7, 'Preicila', 'Da Silva', '12345678', 'bruasu6@gmail.com', '1990-03-24', '', '', '1', '1'),
(8, 'Mary', 'Lemos', '12345678', 'bruasu7@gmail.com', '1990-03-24', '', '', '1', '1'),
(9, 'Lucas', 'Asuncion', '12345678', 'bruasu8@gmail.com', '1990-03-24', '', '', '1', '1'),
(10, 'Ezequiel', 'Asuncion', '12345678', 'bruasu9@gmail.com', '1990-03-24', '', '', '1', '1'),
(14, '', 'asjd', 'asd', 'bruasu@gmail.com', '1416-12-15', '0', '0', 'activo', 'user'),
(15, '', 'asdasdasd', 'asd', 'bb@ASD.COM', '2018-09-29', '0', '0', 'activo', 'user'),
(16, 'algo', 'algo2', 'asd', 'bruasu@gmail.com', '2018-09-12', '0', '0', 'activo', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valor_total` float NOT NULL,
  `fecha_compra` date NOT NULL,
  `direccion_entrega` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `id_usuario`, `valor_total`, `fecha_compra`, `direccion_entrega`, `status`) VALUES
(1, 1, 4000, '2018-08-11', 'francia 2056', 1),
(2, 10, 5000, '2018-08-01', 'araujo 5623', 1),
(3, 3, 5000, '2018-08-02', 'brasil 2056', 1),
(4, 5, 5000, '2018-08-03', 'libano 136', 1),
(5, 4, 5263, '2018-08-31', 'asdasd 2635', 1),
(6, 9, 2695, '2018-08-20', 'asdagfrg 2563', 1),
(7, 8, 6953, '2018-08-15', 'nfgnbfgn 62626', 1),
(8, 7, 5698, '2018-08-15', 'kikol 256', 1),
(9, 2, 5263, '2018-08-05', 'fwe fv 215', 1),
(10, 6, 6593, '2018-08-02', 'knoljio 3652', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `productos_ibfk_1` (`id_categoria`);

--
-- Indexes for table `productos_ventas`
--
ALTER TABLE `productos_ventas`
  ADD KEY `id_productos` (`id_productos`),
  ADD KEY `id_ventas` (`id_ventas`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Constraints for table `productos_ventas`
--
ALTER TABLE `productos_ventas`
  ADD CONSTRAINT `productos_ventas_ibfk_1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `productos_ventas_ibfk_2` FOREIGN KEY (`id_ventas`) REFERENCES `ventas` (`id_ventas`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
