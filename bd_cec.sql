-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Nov-2025 às 06:55
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_cec`
--

CREATE DATABASE IF NOT EXISTS bd_cec;
USE bd_cec;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id_emprestimo` int(11) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `data_devolucao` datetime NOT NULL DEFAULT current_timestamp(),
  `status_emprestimo` char(1) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_equipamento` int(11) NOT NULL,
  `qtd_aulas` int(11) DEFAULT NULL,
  `data_aprovacao` datetime DEFAULT NULL,
  `id_inspetor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id_emprestimo`, `data_hora`, `data_devolucao`, `status_emprestimo`, `id_usuario`, `id_equipamento`, `qtd_aulas`, `data_aprovacao`, `id_inspetor`) VALUES
(1, '2025-11-07 11:24:18', '2025-11-11 14:19:48', 'D', 9, 3, NULL, NULL, NULL),
(2, '2025-11-07 11:33:04', '2025-11-11 14:19:47', 'D', 9, 2, NULL, NULL, NULL),
(3, '2025-11-07 11:44:39', '2025-11-08 11:44:39', 'R', 9, 4, NULL, NULL, NULL),
(4, '2025-11-07 11:44:43', '2025-11-11 14:17:27', 'D', 9, 5, NULL, NULL, NULL),
(5, '2025-11-07 11:47:38', '2025-11-11 14:17:26', 'D', 9, 6, NULL, '2025-11-07 11:49:16', 10),
(6, '2025-11-07 11:47:39', '2025-11-08 11:47:39', 'R', 9, 4, NULL, NULL, NULL),
(7, '2025-11-07 11:59:00', '2025-11-11 14:17:18', 'D', 9, 4, NULL, '2025-11-07 11:59:32', 10),
(8, '2025-11-07 12:08:17', '2025-11-11 14:17:17', 'D', 9, 7, NULL, NULL, NULL),
(9, '2025-11-11 14:03:09', '2025-11-11 14:17:16', 'D', 9, 8, NULL, NULL, NULL),
(10, '2025-11-11 14:03:11', '2025-11-12 14:03:11', 'R', 9, 9, NULL, NULL, NULL),
(11, '2025-11-11 15:22:57', '2025-11-11 15:26:33', 'D', 9, 2, 1, NULL, NULL),
(12, '2025-11-11 15:22:59', '2025-11-11 15:26:34', 'D', 9, 4, 1, NULL, NULL),
(13, '2025-11-11 15:22:59', '2025-11-11 15:26:30', 'D', 9, 5, 1, NULL, NULL),
(14, '2025-11-11 15:23:25', '2025-11-11 15:26:53', 'D', 9, 7, 1, NULL, NULL),
(15, '2025-11-11 15:23:26', '2025-11-11 15:26:55', 'D', 9, 6, 1, NULL, NULL),
(16, '2025-11-11 15:23:27', '2025-11-11 15:24:55', 'D', 9, 8, 1, NULL, NULL),
(17, '2025-11-11 15:23:28', '2025-11-11 15:24:54', 'D', 9, 9, 1, NULL, NULL),
(18, '2025-11-11 15:26:40', '2025-11-11 20:16:40', 'R', 9, 2, 1, NULL, NULL),
(19, '2025-11-11 15:26:41', '2025-11-11 20:16:41', 'R', 9, 5, 1, NULL, NULL),
(20, '2025-11-11 15:26:45', '2025-11-11 20:16:45', 'R', 9, 9, 1, NULL, NULL),
(21, '2025-11-11 15:26:49', '2025-11-11 15:29:57', 'D', 9, 8, 1, NULL, NULL),
(22, '2025-11-11 15:29:36', '2025-11-11 15:32:41', 'D', 9, 2, 1, NULL, NULL),
(23, '2025-11-11 15:29:38', '2025-11-11 15:32:45', 'D', 9, 5, 1, NULL, NULL),
(24, '2025-11-11 15:30:04', '2025-11-11 15:32:45', 'D', 9, 6, 1, NULL, NULL),
(25, '2025-11-11 15:30:27', '2025-11-11 20:20:27', 'R', 9, 3, 1, NULL, NULL),
(26, '2025-11-11 15:31:44', '2025-11-11 15:32:44', 'D', 9, 7, 1, NULL, NULL),
(27, '2025-11-11 15:31:46', '2025-11-11 15:32:42', 'D', 9, 4, 1, NULL, NULL),
(28, '2025-11-11 15:31:46', '2025-11-11 15:32:43', 'D', 9, 8, 1, NULL, NULL),
(29, '2025-11-11 15:31:48', '2025-11-11 15:32:43', 'D', 9, 9, 1, NULL, NULL),
(30, '2025-11-11 15:32:49', '2025-11-12 11:57:52', 'D', 9, 2, 1, NULL, NULL),
(31, '2025-11-11 15:32:51', '2025-11-12 11:50:47', 'D', 9, 4, 1, NULL, NULL),
(32, '2025-11-12 11:35:39', '2025-11-12 11:50:47', 'D', 9, 5, 1, NULL, NULL),
(33, '2025-11-12 11:35:40', '2025-11-12 11:50:47', 'D', 9, 6, 1, NULL, NULL),
(34, '2025-11-12 11:35:41', '2025-11-12 11:50:46', 'D', 9, 7, 1, NULL, NULL),
(35, '2025-11-12 11:35:42', '2025-11-12 11:50:45', 'D', 9, 8, 1, NULL, NULL),
(36, '2025-11-12 11:35:43', '2025-11-12 16:25:43', 'R', 9, 9, 1, NULL, NULL),
(37, '2025-11-12 11:55:18', '2025-11-12 12:04:50', 'D', 9, 4, 1, NULL, NULL),
(38, '2025-11-12 11:55:18', '2025-11-12 12:04:50', 'D', 9, 8, 1, NULL, NULL),
(39, '2025-11-12 11:58:48', '2025-11-12 12:04:50', 'D', 9, 14, 1, NULL, NULL),
(40, '2025-11-12 11:58:51', '2025-11-12 12:04:49', 'D', 9, 13, 1, NULL, NULL),
(41, '2025-11-12 12:00:33', '2025-11-12 12:04:49', 'D', 9, 16, 1, NULL, NULL),
(42, '2025-11-12 12:00:35', '2025-11-12 12:04:49', 'D', 9, 3, 1, NULL, NULL),
(43, '2025-11-12 12:00:37', '2025-11-12 16:50:37', 'R', 9, 2, 1, NULL, NULL),
(44, '2025-11-12 12:05:02', '2025-11-12 12:16:11', 'D', 9, 3, 1, NULL, NULL),
(45, '2025-11-12 12:05:04', '2025-11-12 12:16:10', 'D', 9, 13, 1, NULL, NULL),
(46, '2025-11-12 12:05:05', '2025-11-12 16:55:05', 'R', 9, 14, 1, NULL, NULL),
(47, '2025-11-12 12:05:07', '2025-11-12 12:16:09', 'D', 9, 15, 1, NULL, NULL),
(48, '2025-11-12 12:05:08', '2025-11-12 16:55:08', 'R', 9, 16, 1, NULL, NULL),
(49, '2025-11-12 12:12:55', '2025-11-12 12:16:08', 'D', 9, 2, NULL, NULL, NULL),
(50, '2025-11-12 12:14:40', '2025-11-12 12:27:18', 'D', 9, 4, NULL, NULL, NULL),
(51, '2025-11-20 22:50:02', '2025-11-20 22:52:33', 'D', 9, 2, NULL, NULL, NULL),
(52, '2025-11-20 23:07:10', '2025-11-20 23:08:34', 'D', 9, 14, NULL, NULL, NULL),
(53, '2025-11-20 23:07:35', '2025-11-20 23:08:37', 'D', 9, 13, NULL, NULL, NULL),
(54, '2025-11-20 23:08:50', '2025-11-20 23:12:55', 'D', 9, 3, NULL, NULL, NULL),
(55, '2025-11-20 23:09:08', '2025-11-20 23:12:55', 'D', 9, 13, NULL, NULL, NULL),
(56, '2025-11-20 23:09:19', '2025-11-20 23:12:54', 'D', 9, 11, NULL, NULL, NULL),
(57, '2025-11-20 23:09:30', '2025-11-20 23:12:54', 'D', 9, 2, NULL, NULL, NULL),
(58, '2025-11-20 23:09:41', '2025-11-20 23:12:53', 'D', 9, 4, NULL, NULL, NULL),
(59, '2025-11-20 23:09:52', '2025-11-20 23:12:53', 'D', 9, 8, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id_equipamento` int(11) NOT NULL,
  `tipo` char(1) NOT NULL,
  `numeracao` char(3) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `numero_serie` varchar(20) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1,
  `id_local` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id_equipamento`, `tipo`, `numeracao`, `descricao`, `numero_serie`, `id_marca`, `disponivel`, `id_local`) VALUES
(2, '1', '07', 'oled', '1207', 5, 1, NULL),
(3, '2', '08', 'oled', '12', 3, 1, NULL),
(4, '1', '1', 'oled', '1', 5, 1, NULL),
(5, '1', '2', 'oled', '2', 5, 1, NULL),
(6, '1', '3', 'oled', '3', 5, 1, NULL),
(7, '1', '4', 'oled', '4', 5, 1, NULL),
(8, '1', '13', 'oled', '9', 5, 1, NULL),
(9, '1', '9', 'hd', '19', 5, 1, NULL),
(11, '2', '1', 'hd', '16', 3, 1, NULL),
(13, '3', '1', 'oled', '21', 2, 1, NULL),
(14, '4', '2', 'oled', '22', 3, 1, NULL),
(15, '5', '3', 'oled', '23', 6, 1, NULL),
(16, '6', '2', 'oled', '11', 6, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE `local` (
  `id_local` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`id_local`, `nome`) VALUES
(1, 'Informática'),
(2, 'Sala 10'),
(3, 'Sala Proati');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id_marca`, `nome`) VALUES
(1, 'Samsung'),
(2, 'Google'),
(3, 'Positivo'),
(4, 'Lenovo'),
(5, 'LG'),
(6, 'Outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `id_notificacao` int(11) NOT NULL,
  `id_remetente` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `mensagem` varchar(400) NOT NULL,
  `data_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `status_notificacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notificacao`
--

INSERT INTO `notificacao` (`id_notificacao`, `id_remetente`, `id_destinatario`, `mensagem`, `data_envio`, `status_notificacao`) VALUES
(1, 10, 9, 'Prezado professor, seu empréstimo está atrasado. Por favor, devolva o equipamento o mais breve possível.', '2025-11-12 11:39:59', 'P'),
(2, 10, 9, 'Prezado professor, seu empréstimo está atrasado. Por favor, devolva o equipamento o mais breve possível.', '2025-11-12 11:40:03', 'P');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `id_ocorrencia` int(11) NOT NULL,
  `relato` varchar(300) NOT NULL,
  `data_relato` datetime NOT NULL DEFAULT current_timestamp(),
  `status` char(1) NOT NULL,
  `id_equipamento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_emprestimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` char(1) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo`, `data_registro`) VALUES
(8, 'arthur', 'admin@gmail.com', '$2y$12$QTF4HAlY9TeHhXiZmjbow.MS35.6Ty2zal9JOiUpeY88WnZXq2NPq', '1', '2025-11-07 11:01:22'),
(9, 'dai', 'dai@gmail.com', '$2y$12$nmkK5Ha6WEpMFjs12D9M2Oji/qBTM2m4Q.XlQAfwtsgQl5bLVW3Va', '2', '2025-11-07 11:01:39'),
(10, 'let', 'let@gmail.com', '$2y$12$Vxi.VelyamKJ8ZGpCdwcfu77PxYERlekPaUGYJVoXHiVf0iZwOzEG', '3', '2025-11-07 11:01:48'),
(11, 'arthurR', 'thur@gmail.com', '$2y$12$kic9hdLggrtwxqCjdvIFz.mrldhyt2sSB.hXib.rk/Ti0f7o.RzEy', '1', '2025-11-19 23:56:33');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_equipamento` (`id_equipamento`),
  ADD KEY `id_inspetor` (`id_inspetor`);

--
-- Índices para tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id_equipamento`),
  ADD UNIQUE KEY `numero_serie` (`numero_serie`),
  ADD KEY `fk_equipamento_marca` (`id_marca`),
  ADD KEY `id_local` (`id_local`);

--
-- Índices para tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id_local`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Índices para tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id_notificacao`),
  ADD KEY `id_remetente` (`id_remetente`),
  ADD KEY `id_destinatario` (`id_destinatario`);

--
-- Índices para tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id_ocorrencia`),
  ADD KEY `id_equipamento` (`id_equipamento`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_emprestimo` (`id_emprestimo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id_equipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `id_notificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  MODIFY `id_ocorrencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamento` (`id_equipamento`);

--
-- Limitadores para a tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `fk_equipamento_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `id_local` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`);

--
-- Limitadores para a tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `notificacao_ibfk_1` FOREIGN KEY (`id_remetente`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `notificacao_ibfk_2` FOREIGN KEY (`id_destinatario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `ocorrencias_ibfk_1` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamento` (`id_equipamento`),
  ADD CONSTRAINT `ocorrencias_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `ocorrencias_ibfk_3` FOREIGN KEY (`id_emprestimo`) REFERENCES `emprestimo` (`id_emprestimo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
