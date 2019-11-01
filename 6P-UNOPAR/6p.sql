-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Nov-2015 às 03:07
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `6p`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `clienteId` int(11) NOT NULL AUTO_INCREMENT,
  `clienteTelefone` varchar(30) NOT NULL,
  `clienteEndereco` varchar(255) NOT NULL,
  `clienteReferencia` varchar(255) NOT NULL,
  `clienteNascimento` date NOT NULL,
  `clienteNome` varchar(255) NOT NULL,
  PRIMARY KEY (`clienteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`clienteId`, `clienteTelefone`, `clienteEndereco`, `clienteReferencia`, `clienteNascimento`, `clienteNome`) VALUES
(1, '8311111111', 'Rua de lá', 'Perto de cá', '2015-10-06', 'Delso'),
(2, '8322222222', 'Rua de Cima', 'Perto da quadra D', '2015-09-07', 'Valdemir'),
(5, '22222222', 'Rua daqui', 'Perto do coreto', '2015-09-07', 'ClÃ¡udia'),
(6, '55555555', 'Rua de Campina Grande', 'Perto do SertÃ£o', '1990-09-11', 'Daniel'),
(8, '8333333333', 'Rua Castelo', 'Proxima a ponte', '1984-02-09', 'Katy Mosh'),
(9, '99999999', 'Rua OtÃ¡vio FÃ©lix Pereira, 651. Apart 103', 'Perto do Bouquet', '1987-09-29', 'Valesck FÃ¡tima Carvalho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregador`
--

CREATE TABLE IF NOT EXISTS `entregador` (
  `entregadorId` int(11) NOT NULL AUTO_INCREMENT,
  `entregadorNome` varchar(255) NOT NULL,
  `entregadorRg` int(11) NOT NULL,
  `entregadorCpf` int(14) NOT NULL,
  `entregadorCelular` int(14) NOT NULL,
  `entregadorEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`entregadorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `entregador`
--

INSERT INTO `entregador` (`entregadorId`, `entregadorNome`, `entregadorRg`, `entregadorCpf`, `entregadorCelular`, `entregadorEmpresa`) VALUES
(1, 'John Leno', 1122345, 213313345, 33221188, 3),
(2, 'Roalisson', 332211, 334345677, 90909090, 2),
(3, 'Henrique', 112211, 1122112211, 11222211, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `pedidoId` int(11) NOT NULL AUTO_INCREMENT,
  `pedidoClienteId` int(11) NOT NULL,
  `pedidoProdutoId` varchar(255) NOT NULL,
  `pedidoQtde` varchar(255) NOT NULL,
  `pedidoTamanho` varchar(255) NOT NULL,
  `pedidoValor` varchar(255) NOT NULL,
  `pedidoEntregadorId` int(11) NOT NULL,
  `pedidoStatus` int(11) NOT NULL,
  `pedidoEntrega` varchar(20) NOT NULL,
  `PedidoTroco` varchar(20) NOT NULL,
  `pedidoData` date NOT NULL,
  PRIMARY KEY (`pedidoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`pedidoId`, `pedidoClienteId`, `pedidoProdutoId`, `pedidoQtde`, `pedidoTamanho`, `pedidoValor`, `pedidoEntregadorId`, `pedidoStatus`, `pedidoEntrega`, `PedidoTroco`, `pedidoData`) VALUES
(1, 6, '1;1', '1;1', 'P;M', '40', 1, 3, '0', '0', '2015-11-10'),
(2, 1, '1', '1', 'P', '15', 2, 3, '0', '0', '2015-11-08'),
(3, 1, '2;3', '3;1', 'P;P', '60', 2, 2, '0', '0', '2015-11-02'),
(4, 6, '4', '4', 'M', '140', 1, 1, '0', '0', '2015-10-05'),
(5, 2, '2;3', '1;1', 'M;P', '40', 3, 0, '0', '0', '2015-10-01'),
(6, 2, '1', '1', 'P', '15', 2, 1, '0', '0', '2015-11-30'),
(7, 2, '2', '1', 'G', '30', 0, 0, '15', '50', '2015-11-16'),
(8, 1, '1', '1', 'P', '15', 0, 0, '10', '0', '2015-11-17'),
(9, 2, '2', '1', 'P', '15', 0, 0, '0', '0', '2015-11-09'),
(10, 5, '2;3', '2;2', 'P;P', '60', 1, 0, '15', '100', '2015-11-03'),
(11, 9, '2;3', '1;1', 'M;M', '50', 0, 0, '0', '0', '2015-11-02'),
(12, 1, '1;2', '2;1', 'P;P', '45', 0, 0, '1', '1', '2015-11-02'),
(13, 1, '1', '1', 'P', '15', 0, 0, '1', '20', '2015-11-02'),
(14, 6, '1', '1', 'M', '25', 0, 0, '0', '0', '2015-11-02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `produtoId` int(11) NOT NULL AUTO_INCREMENT,
  `produtoNome` varchar(255) NOT NULL,
  `produtoDescricao` varchar(255) NOT NULL,
  `produtoTamanho` varchar(255) NOT NULL,
  `produtoCusto` varchar(255) NOT NULL,
  `produtoImagem` varchar(255) NOT NULL,
  PRIMARY KEY (`produtoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produtoId`, `produtoNome`, `produtoDescricao`, `produtoTamanho`, `produtoCusto`, `produtoImagem`) VALUES
(1, 'Pizza 4 queijos', 'Pizza com os queijos mais comuns de pizza', 'P;M;G', '15,00;25,00;30,00', '4queijos.jpg'),
(2, 'Pizza portuguesa', 'Pizza com presunto, ovo, queijo, espinafre, tomate, cebola, azeitona', 'P;M;G;GG', '15,00;25,00;30,00;35,00', 'pizza_portuguesa.jpg'),
(3, 'Pizza de calabreza', 'Calabreza, cebola', 'P;M', '15;25', 'calabreza.jpg'),
(4, 'Pizza de lombo', 'Lombo suÃ­no, cebola, queijo, orÃ©gano', 'P;M;G', '30;35;40', 'lombo.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `terceirizada`
--

CREATE TABLE IF NOT EXISTS `terceirizada` (
  `terceirizadaId` int(11) NOT NULL AUTO_INCREMENT,
  `terceirizadaNome` varchar(255) NOT NULL,
  `terceirizadaCnpj` int(15) NOT NULL,
  `terceirizadaEndereco` varchar(255) NOT NULL,
  `terceirizadaTelefone` int(15) NOT NULL,
  `terceirizadaEmail` varchar(255) NOT NULL,
  PRIMARY KEY (`terceirizadaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `terceirizada`
--

INSERT INTO `terceirizada` (`terceirizadaId`, `terceirizadaNome`, `terceirizadaCnpj`, `terceirizadaEndereco`, `terceirizadaTelefone`, `terceirizadaEmail`) VALUES
(1, 'Pensão da Dona Jô', 1001001011, 'Rua Meier', 11111111, 'donajo@hotmail.com'),
(2, 'Balde de Lixo', 22200202, 'Rua Fenda do Biquini', 22121244, 'chunpocket@gmail.com'),
(3, 'Entregas Maravilha', 323232323, 'Rua das maravilhas', 22111122, 'entrmaravilha@mara.com.br'),
(4, 'Entrega Expressa', 2147483647, 'Rua da Boa visinhanÃ§a', 76765656, 'expressa@entrega.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
