-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/08/2025 às 15:40
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
  `CodCli` int(11) NOT NULL,
  `Nome` text DEFAULT NULL,
  `Endereco` text DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `CPF` varchar(13) DEFAULT NULL,
  `DtNascimento` datetime DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Senha` text DEFAULT NULL,
  `tipo` char(1) DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`CodCli`, `Nome`, `Endereco`, `Telefone`, `CPF`, `DtNascimento`, `Email`, `Senha`, `tipo`) VALUES
(5, 'Maria Eduarda 01', 'Alegre, ES', '28988151193', '1910962504', '2001-10-28 00:00:00', 'mariaeduarda@gmail.c', 'teste123', 'C'),
(6, 'Maria Eduarda Barros', 'Alegre - ES', '28988151193', '', '0000-00-00 00:00:00', 'maria@gmail.com', '1234', 'C'),
(7, 'admin', 'testeEnd', '2898151193', '19109625705', '0000-00-00 00:00:00', 'admin@gmail.com', '123', 'A');

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
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`CodCli`);

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
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `CodCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
