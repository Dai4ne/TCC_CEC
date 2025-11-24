-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2025 às 20:19
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
-- Banco de dados: `bd_cec`
--

CREATE DATABASE IF NOT EXISTS bd_cec;
USE bd_cec;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamento`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamento`
--

INSERT INTO `equipamento` (`id_equipamento`, `tipo`, `numeracao`, `descricao`, `numero_serie`, `id_marca`, `disponivel`, `id_local`) VALUES
(19, '2', '1', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '123456789123', 4, 1, 1),
(20, '2', '2', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '223456789123', 4, 1, 1),
(21, '2', '3', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '323456789123', 4, 1, 1),
(22, '2', '4', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '423456789123', 4, 1, 1),
(23, '2', '5', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '523456789123', 4, 1, 1),
(24, '2', '6', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '623456789123', 4, 1, 1),
(25, '2', '7', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '723456789123', 4, 1, 1),
(26, '2', '8', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '823456789123', 4, 1, 1),
(27, '2', '9', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '923456789123', 4, 1, 1),
(28, '2', '10', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '113456789123', 4, 1, 1),
(29, '2', '11', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '133456789123', 4, 1, 1),
(30, '2', '12', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '143456789123', 4, 1, 1),
(31, '2', '13', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '153456789123', 4, 1, 1),
(32, '2', '14', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '163456789123', 4, 1, 1),
(33, '2', '15', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '173456789123', 4, 1, 1),
(34, '2', '16', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '183456789123', 4, 1, 1),
(35, '2', '17', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '193456789123', 4, 1, 1),
(36, '2', '18', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '121456789123', 4, 1, 1),
(37, '2', '19', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '122456789123', 4, 1, 1),
(38, '2', '20', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '124456789123', 4, 1, 1),
(39, '2', '21', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '125456789123', 4, 1, 1),
(40, '2', '22', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '517289143617', 4, 1, 1),
(41, '2', '23', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '981324510926', 4, 1, 1),
(42, '2', '24', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '621080901921', 4, 1, 1),
(43, '2', '25', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '000010101010', 4, 1, 1),
(44, '2', '26', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '000000000000', 4, 1, 1),
(46, '2', '26', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '000000000001', 4, 1, 1),
(47, '2', '27', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '010198765430', 4, 1, 1),
(48, '2', '28', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '098765432109', 4, 1, 1),
(49, '2', '28', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '947202845182', 4, 1, 1),
(50, '2', '29', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '012864517391', 4, 1, 1),
(51, '2', '30', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '982153678901', 4, 1, 1),
(52, '2', '31', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '019265148917', 4, 1, 1),
(53, '2', '32', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '981625761521', 4, 1, 1),
(55, '2', '33', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '671890192161', 4, 1, 1),
(56, '2', '34', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '098098098098', 4, 1, 1),
(57, '2', '35', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '123123123123', 4, 1, 1),
(58, '2', '36', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '121212121212', 4, 1, 1),
(59, '2', '37', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '131313131313', 4, 1, 1),
(60, '2', '38', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '141414141414', 4, 1, 1),
(61, '2', '39', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '151515151515', 4, 1, 1),
(62, '2', '40', 'Nome do modelo: Lenovo ThinkPad L14 Gen2 - Tamanho da tela: 14 polegadas - Mem: 16 GB de RAM - SSD de 512 GB', '161616161616', 4, 1, 1),
(63, '4', '1', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '171717171717', 3, 1, 2),
(64, '4', '2', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '181818181818', 3, 1, 2),
(65, '4', '3', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '1919191919', 3, 1, 2),
(66, '4', '4', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '101010101010', 3, 1, 2),
(67, '4', '5', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '111111111111', 3, 1, 2),
(68, '4', '6', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '232323232323', 3, 1, 2),
(69, '4', '7', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '242424242424', 3, 1, 2),
(70, '4', '8', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '252525252525', 3, 1, 2),
(71, '4', '9', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '262626262626', 3, 1, 2),
(72, '4', '10', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '272727272727', 3, 1, 2),
(73, '4', '11', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '282828282828', 3, 1, 2),
(74, '4', '12', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '292929292929', 3, 1, 2),
(75, '4', '13', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '222222222222', 3, 1, 2),
(76, '4', '14', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '333333333333', 3, 1, 2),
(77, '4', '15', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '343434343434', 3, 1, 2),
(78, '4', '16', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '353535353535', 3, 1, 2),
(79, '4', '17', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '363636363636', 3, 1, 2),
(80, '4', '18', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '373737373737', 3, 1, 2),
(81, '4', '19', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '383838383838', 3, 1, 2),
(82, '4', '20', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '393939393939', 3, 1, 2),
(83, '4', '21', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '444444444444', 3, 1, 2),
(84, '4', '22', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '454545454545', 3, 1, 2),
(85, '4', '23', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '464646464646', 3, 1, 2),
(86, '4', '24', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '474747474747', 3, 1, 2),
(87, '4', '25', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '484848484848', 3, 1, 2),
(88, '4', '26', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '494949494949', 3, 1, 2),
(89, '4', '27', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '404040404040', 3, 1, 2),
(90, '4', '28', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '555555555555', 3, 1, 2),
(91, '4', '29', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '565656565656', 3, 1, 2),
(92, '4', '30', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '575757575757', 3, 1, 2),
(93, '4', '31', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '585858585858', 3, 1, 2),
(94, '4', '32', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '595959595959', 3, 1, 2),
(95, '4', '33', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '767676890123', 3, 1, 2),
(96, '4', '34', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '091019274382', 3, 1, 2),
(97, '4', '35', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '672156178901', 3, 1, 2),
(98, '4', '36', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '152490817654', 3, 1, 2),
(99, '4', '37', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '901256176543', 3, 1, 2),
(100, '4', '38', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '156217890456', 3, 1, 2),
(101, '4', '39', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '8910123457612', 3, 1, 2),
(102, '4', '40', 'Nome do modelo: Tablet T2040 - Tamanho da tela: 10 polegadas - Mem: 2 GB de RAM - Armazenamento: 64 GB', '81267890221', 3, 1, 2),
(103, '3', '1', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '983267189021', 1, 1, 3),
(104, '3', '2', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '142178904567', 1, 1, 3),
(105, '3', '3', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '890145367189', 1, 1, 3),
(106, '3', '4', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '651278905467', 1, 1, 3),
(107, '3', '5', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '123415267891', 1, 1, 3),
(108, '3', '6', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '4516734890189', 1, 1, 3),
(109, '3', '7', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '671892156478', 1, 1, 3),
(110, '3', '8', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '890918764537', 1, 1, 3),
(111, '3', '9', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '142516727893', 1, 1, 3),
(112, '3', '10', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '918201986745', 1, 1, 3),
(113, '3', '11', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '162471892645', 1, 1, 3),
(114, '3', '12', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '672189108456', 1, 1, 3),
(115, '3', '13', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '543167816354', 1, 1, 3),
(116, '3', '14', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '891025146725', 1, 1, 3),
(117, '3', '15', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '62718940376', 1, 1, 3),
(118, '3', '16', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '278190909090', 1, 1, 3),
(119, '3', '17', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '483255555555', 1, 1, 3),
(120, '3', '18', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '631111111111', 1, 1, 3),
(121, '3', '19', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '877777777777', 1, 1, 3),
(122, '3', '20', 'Nome do modelo: Chromebook Samsung 4 - Tamanho da tela: 11.6 polegadas - Mem: 4 GB de RAM - SSD de 32 GB', '921111111111', 1, 1, 3),
(123, '1', '1', 'Smart TV LG 43UN731C0SC LED 4K 43″', '844444444444', 5, 1, 2),
(124, '1', '2', 'Smart TV LG 43UN731C0SC LED 4K 43″', '999999999999', 5, 1, 2),
(125, '1', '3', 'Smart TV LG 43UN731C0SC LED 4K 43″', '637289215647', 5, 1, 2),
(126, '1', '4', 'Smart TV LG 43UN731C0SC LED 4K 43″', '091256471854', 5, 1, 2),
(127, '1', '5', 'Smart TV LG 43UN731C0SC LED 4K 43″', '983167461549', 5, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `local`
--

CREATE TABLE `local` (
  `id_local` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `local`
--

INSERT INTO `local` (`id_local`, `nome`) VALUES
(1, 'Informática'),
(2, 'Sala 10'),
(3, 'Sala Proati');

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
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
-- Estrutura para tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `id_notificacao` int(11) NOT NULL,
  `id_remetente` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `mensagem` varchar(400) NOT NULL,
  `data_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `status_notificacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `id_ocorrencia` int(11) NOT NULL,
  `relato` varchar(300) NOT NULL,
  `data_relato` datetime NOT NULL DEFAULT current_timestamp(),
  `status` char(1) NOT NULL,
  `id_equipamento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_emprestimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` char(1) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
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
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_equipamento` (`id_equipamento`),
  ADD KEY `id_inspetor` (`id_inspetor`);

--
-- Índices de tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id_equipamento`),
  ADD UNIQUE KEY `numero_serie` (`numero_serie`),
  ADD KEY `fk_equipamento_marca` (`id_marca`),
  ADD KEY `id_local` (`id_local`);

--
-- Índices de tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id_local`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Índices de tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id_notificacao`),
  ADD KEY `id_remetente` (`id_remetente`),
  ADD KEY `id_destinatario` (`id_destinatario`);

--
-- Índices de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id_ocorrencia`),
  ADD KEY `id_equipamento` (`id_equipamento`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_emprestimo` (`id_emprestimo`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
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
  MODIFY `id_equipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

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
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamento` (`id_equipamento`);

--
-- Restrições para tabelas `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `fk_equipamento_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `id_local` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`);

--
-- Restrições para tabelas `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `notificacao_ibfk_1` FOREIGN KEY (`id_remetente`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `notificacao_ibfk_2` FOREIGN KEY (`id_destinatario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `ocorrencias_ibfk_1` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamento` (`id_equipamento`),
  ADD CONSTRAINT `ocorrencias_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `ocorrencias_ibfk_3` FOREIGN KEY (`id_emprestimo`) REFERENCES `emprestimo` (`id_emprestimo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
