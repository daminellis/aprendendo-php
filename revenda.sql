-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 14/03/2024 às 18h24min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `revenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codigo`, `nome`) VALUES
(1, 'Fiat'),
(2, 'Ford');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE IF NOT EXISTS `modelo` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codmarca` int(5) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codmarca` (`codmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`codigo`, `nome`, `codmarca`) VALUES
(1, 'Palio', 1),
(2, 'Uno', 1),
(3, 'fiesta', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(10) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `nome`, `login`, `senha`) VALUES
(1212, 'matheus', 'daminelli', '123'),
(3434, 'joao', 'jao', '3232');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `codigo` int(5) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `codmodelo` int(5) NOT NULL,
  `ano` int(4) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `opcionais` varchar(50) NOT NULL,
  `valor` float(10,2) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codmodelo` (`codmodelo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`codigo`, `descricao`, `codmodelo`, `ano`, `cor`, `placa`, `opcionais`, `valor`) VALUES
(1, 'fiat palio elx 4 portas', 1, 2022, 'branca', 'ABC123', 'alarme e vidros elétricos', 45000.00),
(2, 'fiat uno 2 portas', 2, 2021, 'vermelha', 'XYZ123', 'alarme', 40000.00),
(3, 'fiat uno 10 porta', 2, 2024, 'prata', 'abc321', 'teto', 12000.00),
(4, 'fiesta 4 portas', 3, 2023, 'preto', '234xtx', 'teto e ar', 12000.00);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`codmarca`) REFERENCES `marca` (`codigo`);

--
-- Restrições para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`codmodelo`) REFERENCES `modelo` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
