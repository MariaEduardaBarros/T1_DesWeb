-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/08/2025 às 22:26
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojat3ek`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `datasdisponiveis`
--

CREATE TABLE `datasdisponiveis` (
  `id_servico` int(11) NOT NULL,
  `id_disponibilidade` int(11) NOT NULL,
  `data` date NOT NULL,
  `disponivel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `datasdisponiveis`
--

INSERT INTO `datasdisponiveis` (`id_servico`, `id_disponibilidade`, `data`, `disponivel`) VALUES
(22, 67, '2025-07-18', 1),
(22, 68, '2025-08-10', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `descricao` text NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id_servico`, `nome`, `valor`, `descricao`, `id_tipo`) VALUES
(22, 'Kailany', 333, 'cientista de dados', 2),
(23, 'Lukas', 150, 'Desenvolvedor Front-end', 1),
(24, 'Thiago', 100, 'Desenvolvedor Back-end', 1),
(26, 'QA', 3500, 'teste de descrição', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `nome`, `valor`) VALUES
(1, 'Desenvolvedor', 500),
(2, 'Analista de dados', 600);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `CodCli` decimal(4,0) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Endereco` varchar(50) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `CPF` varchar(13) DEFAULT NULL,
  `DtNascimento` datetime DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `Senha` varchar(8) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`CodCli`, `Nome`, `Endereco`, `Telefone`, `CPF`, `DtNascimento`, `Email`, `Senha`, `is_admin`) VALUES
(NULL, NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', '1234', 0),
(1, 'admin', 'testeEnd', '2898151193', '19109625705', '0000-00-00 00:00:00', 'admin@gmail.com', '123', 1),
(1, 'Maria', 'Rua das Flores, 123', '11999999999', '12345678900', '1990-01-01 00:00:00', 'maria@gmail.com', '123', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `Cod_venda` int(11) NOT NULL,
  `Cod_cliente` int(11) DEFAULT NULL,
  `Cod_produto` int(11) DEFAULT NULL,
  `Valor_total` float DEFAULT NULL,
  `Quantidade_itens` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `datasdisponiveis`
--
ALTER TABLE `datasdisponiveis`
  ADD PRIMARY KEY (`id_disponibilidade`),
  ADD KEY `id_servico` (`id_servico`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD UNIQUE KEY `Cod_venda` (`Cod_venda`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `datasdisponiveis`
--
ALTER TABLE `datasdisponiveis`
  MODIFY `id_disponibilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `Cod_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `datasdisponiveis`
--
ALTER TABLE `datasdisponiveis`
  ADD CONSTRAINT `id_servico` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
