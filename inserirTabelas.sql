-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql109.infinityfree.com
-- Tempo de geração: 13/06/2023 às 16:50
-- Versão do servidor: 10.4.17-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_34392360_trabalhoppi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anunciante`
--

CREATE TABLE `anunciante` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `hash_senha` varchar(255) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `anunciante`
--

INSERT INTO `anunciante` (`codigo`, `nome`, `cpf`, `email`, `hash_senha`, `telefone`) VALUES
(1, 'Joao', '00012345678', 'joao@email.com', '$2y$10$5Y0U8BJcJLvUolldWMw8De1IRN8AF7hcW.7j0d9b1yuw5TNsB5nZi', '34999998888'),
(2, 'Heitor', '123456789', 'heitor@email.com', '$2y$10$jshzGfZr1uvxKBWGBKOT0OgjcCPh30UTAZhWquf.IxAhDmf0uVpBa', '34999998888'),
(3, 'Igor', '123456987', 'igor@email.com', '$2y$10$w/Ewa83rIlucYAeTYK74qeDkvzpRx/Y8wHMXHSYdw/Bm5Rirh3EZ.', '34988889999'),
(4, 'joaosilva', '46436436', 'joao.silva@example.com', '$2y$10$bDzLkTdCqcFDfNm/a0p53.Lw51c2mS7AG3DO2a/ruUGl71RnB3nDa', '464536543'),
(5, 'pedroalmeida', '4636637547', 'pedro.almeida@example.com', '$2y$10$mHPY4yPrAnTaaCmVIczT4enZWHaRJTQDmjenAjgIPEza9ZxRLjWFi', '6547737'),
(6, 'anacarvalho', '654763675', 'ana.carvalho@example.com', '$2y$10$vamqXizx2vinaGEL.U5v8O7JHHriCdqS3fvgBapt1Sz6IXDqX5R/y', '54354'),
(7, 'lucasrocha', '534467782', 'lucas.rocha@example.com', '$2y$10$nCnnn5DFFztR9rxTtWR7D.TSMu4c8fO96CnJ.md1e6XAEpRjnrQ8e', '57883753');

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncio`
--

CREATE TABLE `anuncio` (
  `codigo` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `dataHora` datetime DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `codCategoria` int(11) NOT NULL,
  `codAnunciante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `anuncio`
--

INSERT INTO `anuncio` (`codigo`, `titulo`, `descricao`, `preco`, `dataHora`, `cep`, `bairro`, `cidade`, `estado`, `codCategoria`, `codAnunciante`) VALUES
(9, 'Playstation 5', 'Playstation 5 em boas condições', 3999, '2023-06-13 15:08:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 5, 2),
(10, 'Bicicleta aro 29', 'Bicicleta usada para MTB', 1800, '2023-06-13 15:10:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 9, 2),
(11, 'Iphone 14 pro', 'Iphone 14 pro usado', 6450, '2023-06-13 15:11:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 5, 2),
(12, 'Kawasaki H2R', 'Moto Kawasaki H2R ano 2020', 160000, '2023-06-13 15:56:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 4, 2),
(13, 'Bolsa Termica', 'Bolsa termica com capacidade de 4,2L', 145, '2023-06-13 15:59:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 8, 2),
(14, 'Jaqueta de Couro', 'Jaqueta de couro racer', 297, '2023-06-13 16:02:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 8, 2),
(15, 'Tenis Nike Airforce', 'Tênis Nike Airforce one', 1250, '2023-06-13 16:05:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 8, 2),
(16, 'Panela antiaderente', 'Conjunto de panelas antiaderente', 250, '2023-06-13 16:12:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 10, 3),
(17, 'Processador I9', 'Processador i9k', 3800, '2023-06-13 16:15:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 5, 3),
(18, 'Controle ps5', 'Controle Dualsense ps5', 640, '2023-06-13 16:16:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 5, 3),
(19, 'Casa com piscina e adega', 'Casa de 3 quartos com piscina, suite master e adega', 950000, '2023-06-13 16:37:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 6, 1),
(21, 'Hilux SR', 'Toyota Hilux SR 2023', 250000, '2023-06-13 16:46:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 4, 1),
(22, 'Notebook Lenovo', 'Notebook Lenovo 15 polegadas', 3550, '2023-06-13 16:51:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 5, 1),
(23, 'AirPods 2', 'AirPods 2 Apple', 1800, '2023-06-13 16:55:00', '38400-100', 'Santa Mônica', 'Uberlândia', 'MG', 5, 1),
(24, 'Focus ST 2022', 'Carro compacto e econômico.', 120000, '2023-06-13 17:10:00', '654656', 'gfdgfdtgre', 'Calçoene', 'AP', 4, 1),
(25, 'Toyota Corolla', 'Sedan confiável e confortável.', 80000, '2023-06-13 17:14:00', '654654', 'hghfgdhgdfh', 'Acauã', 'PI', 4, 4),
(26, 'Honda Civic', 'Carro esportivo e elegante.', 75000, '2023-06-13 17:15:00', '6546645', 'hgfhgfhd', 'Alpercata', 'MG', 4, 4),
(27, 'Porsche 911 Turbo S', 'O mais rápido da Porsche', 1500000, '2023-06-13 17:16:00', '543534', 'jhgrfdjyuyk', 'Aparecida', 'PB', 4, 4),
(28, 'Apartamento de luxo', 'Apartamento moderno com vista panorâmica', 1200000, '2023-06-13 17:21:00', '6546677', 'hgfhgfdhgdf', 'Camapuã', 'MS', 6, 4),
(29, 'Mansão moderna', ' Casa espaçosa com localização privilegiada.', 1654700, '2023-06-13 17:23:00', '43545', 'dfghgfdhgdf', 'Nova Ubiratã', 'MT', 6, 4),
(30, 'Casa Alto Padrão', 'Residência elegante e segura.', 2109730, '2023-06-13 17:26:00', '43565643', 'hgfhgdfhgfd', 'São Felipe d\'Oeste', 'RO', 6, 5),
(31, 'Sofá-cama retrátil', 'Móvel funcional para sala de estar.', 2500, '2023-06-13 17:27:00', '65437653', 'ujhfjhgfjjd', 'Belém', 'PA', 7, 5),
(32, 'Mesa de jantar', 'Conjunto elegante para refeições em família, com seis cadeiras', 3000, '2023-06-13 17:28:00', 't46326', 'hhgfdhg', 'Abaiara', 'CE', 7, 5),
(33, 'Guarda-roupa', 'Móvel espaçoso e moderno para o quarto.', 1800, '2023-06-13 17:29:00', '64326', 'gfdjfdj', 'Laranjal do Jari', 'AP', 7, 5),
(34, 'Cama box com colchão ortopédico', 'Conjunto confortável para uma boa noite de sono.', 2200, '2023-06-13 17:30:00', '54364', 'buhyfrtv', 'Campo Grande', 'AL', 7, 5),
(35, 'Raquete de tênis', 'Raquete profissional de alto desempenho.', 600, '2023-06-13 17:32:00', '64536', 'hgfdhgfd', 'Arneiroz', 'CE', 9, 6),
(36, 'Liquidificador ', 'Aparelho prático para preparar sucos e vitaminas.', 200, '2023-06-13 17:33:00', '54543', 'hdfhdfg', 'Divino de São Lourenço', 'ES', 10, 6),
(37, ' Bola Penalty', 'Bola oficial para partidas de futebol.', 100, '2023-06-13 17:34:00', '6436536', 'hfhfshsh', 'Itaguaçu da Bahia', 'BA', 9, 6),
(38, 'Jogo de copos de cristal', 'gdfgshshh', 300, '2023-06-13 17:35:00', '5325342', 'fdsfagfkyt', 'Divinolândia', 'SP', 10, 6),
(39, 'Luvas de boxe Everlast', 'Equipamento de proteção essencial para treinos de boxe.', 300, '2023-06-13 17:35:00', '643624', 'hfdhsdhs', 'Pimenteiras', 'PI', 9, 6),
(40, 'Conjunto de talheres', 'Talheres resistentes e de alta qualidade.', 250, '2023-06-13 17:38:00', '6573765', 'fhhgfdjhgf', 'Urupá', 'RO', 10, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `base_enderecos`
--

CREATE TABLE `base_enderecos` (
  `id` int(11) NOT NULL,
  `cep` char(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`, `descricao`) VALUES
(4, 'Veículo', 'Categoria para veículos, como carros e motos'),
(5, 'Eletroeletrônico', 'Categoria para produtos eletrônicos, como TVs e smartphones'),
(6, 'Imóvel', 'Categoria para imóveis, como casas e apartamentos'),
(7, 'Móvel', 'Categoria para móveis, como mesas e cadeiras'),
(8, 'Vestuário', 'Categoria para roupas e acessórios'),
(9, 'Esporte', 'Categoria para itens relacionados a esporte'),
(10, 'Utensilios domesticos', 'Categoria para utensilios domesticos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `foto`
--

CREATE TABLE `foto` (
  `codAnuncio` int(11) NOT NULL,
  `nomeArqFoto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `foto`
--

INSERT INTO `foto` (`codAnuncio`, `nomeArqFoto`) VALUES
(9, 'ps5.png'),
(10, 'bike.png'),
(11, '14pro.png'),
(12, 'kawasaki.png'),
(13, 'bolsatermica.png'),
(14, 'jaquetacouro.png'),
(15, 'airforceone.png'),
(16, 'panela.png'),
(17, 'i9.png'),
(18, 'ps5_3.png'),
(19, 'casa.png'),
(21, 'hilux1.png'),
(22, 'notebook.png'),
(23, 'airpods.png'),
(24, 'Ford-Focus-ST-Line-2022.jpg'),
(25, 'corolla.jpg'),
(26, 'civic.jpg'),
(27, '911.jpeg'),
(28, 'apartamento3.jpg'),
(29, 'casa2.jpg'),
(30, 'casa1jpg.jpg'),
(31, 'sofacama.png'),
(32, 'mesa.jpeg'),
(33, 'guarda-roupa.jpg'),
(34, 'colchao.jpg'),
(35, 'raquete.png'),
(36, 'liquidificador.png'),
(37, 'bola.png'),
(38, 'copos.jpg'),
(39, 'luvabox.jpg'),
(40, 'talheres.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `interesse`
--

CREATE TABLE `interesse` (
  `codigo` int(11) NOT NULL,
  `mensagem` varchar(255) DEFAULT NULL,
  `dataHora` date DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `codAnuncio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `anunciante`
--
ALTER TABLE `anunciante`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codCategoria` (`codCategoria`),
  ADD KEY `codAnunciante` (`codAnunciante`);

--
-- Índices de tabela `base_enderecos`
--
ALTER TABLE `base_enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `foto`
--
ALTER TABLE `foto`
  ADD KEY `codAnuncio` (`codAnuncio`);

--
-- Índices de tabela `interesse`
--
ALTER TABLE `interesse`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codAnuncio` (`codAnuncio`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `anunciante`
--
ALTER TABLE `anunciante`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `base_enderecos`
--
ALTER TABLE `base_enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `interesse`
--
ALTER TABLE `interesse`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`codCategoria`) REFERENCES `categoria` (`codigo`) ON DELETE CASCADE,
  ADD CONSTRAINT `anuncio_ibfk_2` FOREIGN KEY (`codAnunciante`) REFERENCES `anunciante` (`codigo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`codAnuncio`) REFERENCES `anuncio` (`codigo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `interesse`
--
ALTER TABLE `interesse`
  ADD CONSTRAINT `interesse_ibfk_1` FOREIGN KEY (`codAnuncio`) REFERENCES `anuncio` (`codigo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
