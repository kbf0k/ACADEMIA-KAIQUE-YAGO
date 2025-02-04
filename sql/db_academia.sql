-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Fev-2025 às 13:27
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_cod` int(11) NOT NULL,
  `aluno_nome` varchar(100) NOT NULL,
  `aluno_email` varchar(255) NOT NULL,
  `aluno_cpf` varchar(14) NOT NULL,
  `aluno_endereco` varchar(255) DEFAULT NULL,
  `aluno_telefone` varchar(20) DEFAULT NULL,
  `aluno_nasc` date DEFAULT NULL,
  `aluno_senha` varchar(255) NOT NULL,
  `fk_aula_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`aluno_cod`, `aluno_nome`, `aluno_email`, `aluno_cpf`, `aluno_endereco`, `aluno_telefone`, `aluno_nasc`, `aluno_senha`, `fk_aula_cod`) VALUES
(1, 'Kaique', 'kaique1245br@gmail.com', '123456789', 'Rua do Kaique', '123456789', '2025-02-11', '$2y$10$mM5F3zd9E/dLqJ8BLuasVuVxkpZF4lb/9t30H3fkl99Io2qMlUaYy', NULL),
(2, 'Yago', 'yago@gmail.com', '123456789', 'Rua do yago', '123456789', '2025-02-11', '$2y$10$IR7jXWNG7fk7jjfZimYP6eu5AOhduLUzWC0BrgIKnPzJJcgyQena2', NULL),
(3, 'Mamute', 'mamute@gmail.com', '123456789', 'Rua do mamute', '123456789', '2025-02-18', '$2y$10$MM07HFpt/b51FQ/K8yUXPeOzZyjC6u0m5ce1rHR4aFrjJaeWVNeg6', NULL),
(4, 'Roberto', 'beto@gmail.com', '12345678', 'Rua do Roberto', '12345678', '2025-02-10', '$2y$10$FFiGlskjcYbzPNOvdjqV8.lAzFPH2q7JCU4LvjaEQs7FD5Sx4YQKC', NULL),
(5, 'Raquel', 'kel@gmail.com', '12345678', 'Rua da Raquel', '12345678', '2025-02-10', '$2y$10$/upZJ/.Yjb0sMSJcZlxzau8l7bS4aUjPPfEH0kFpo6nY/hAG1Wb56', NULL),
(6, 'Tiago', 'tiago@gmail.com', '12345678', 'Rua do tiago', '12345678', '2025-01-26', '$2y$10$AqdS1rbhGGCcu09qRKLBMujS0rCzQ38Pi.eEN.CwZFqaXHpJqA8IS', NULL),
(7, 'Melissa', 'mel@gmail.com', '12345678', 'Rua das Melissas', '12345678', '2025-01-27', '$2y$10$.UvNz9EjEXsbfg7ViJqjde/ePeo.REI1MCwKtZQGY5vZ9X0QDdrmq', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula`
--

CREATE TABLE `aula` (
  `aula_cod` int(11) NOT NULL,
  `aula_tipo` enum('Yoga','Musculação','Crossfit','Zumba','Aeróbica','Pilates','Personal Trainer') NOT NULL,
  `aula_data` datetime NOT NULL,
  `fk_instrutor_cod` int(11) DEFAULT NULL,
  `fk_aluno_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aula`
--

INSERT INTO `aula` (`aula_cod`, `aula_tipo`, `aula_data`, `fk_instrutor_cod`, `fk_aluno_cod`) VALUES
(8, 'Zumba', '2025-02-26 00:30:00', 2, 2),
(13, 'Yoga', '2025-02-11 00:00:00', 1, 2),
(15, 'Aeróbica', '2025-02-27 00:00:00', 1, NULL),
(17, 'Yoga', '2025-02-10 00:00:00', 2, NULL),
(18, 'Musculação', '2025-02-11 00:00:00', 2, NULL),
(19, 'Pilates', '2025-02-27 00:00:00', 1, NULL),
(20, 'Crossfit', '2025-01-26 00:00:00', 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `instrutor`
--

CREATE TABLE `instrutor` (
  `instrutor_cod` int(11) NOT NULL,
  `instrutor_nome` varchar(100) NOT NULL,
  `instrutor_email` varchar(255) NOT NULL,
  `instrutor_cpf` varchar(255) NOT NULL,
  `instrutor_endereco` varchar(255) NOT NULL,
  `instrutor_telefone` int(255) NOT NULL,
  `instrutor_nasc` date NOT NULL,
  `instrutor_senha` varchar(255) NOT NULL,
  `instrutor_especialidade` enum('Yoga','Musculação','Crossfit','Zumba','Aeróbica','Pilates','Personal Trainer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `instrutor`
--

INSERT INTO `instrutor` (`instrutor_cod`, `instrutor_nome`, `instrutor_email`, `instrutor_cpf`, `instrutor_endereco`, `instrutor_telefone`, `instrutor_nasc`, `instrutor_senha`, `instrutor_especialidade`) VALUES
(1, 'Marcos', 'marcos@gmail.com', '12345678', 'Rua do Marcos', 12345678, '0000-00-00', '', 'Musculação'),
(2, 'Brunão', 'brunao@gmail.com', '444557722', 'Rua dos Brunos', 1299874114, '2015-02-01', 'bruno123', 'Musculação'),
(3, 'Toguro', 'toguro@gmail.com', '12345678', 'Rua do Toguro', 12345678, '2025-02-02', 'toguro123', 'Musculação'),
(4, 'Gabriel', 'gab@gmail.com', '12345678', 'Rua do Gabriel', 12345678, '2025-02-02', 'gabriel123', 'Pilates'),
(5, 'Rafael', 'rafa@gmail.com', '12345678', 'Rua do Rafael', 12345678, '2025-02-02', 'rafa123', 'Zumba'),
(6, 'Joao', 'joaoaoao@gmail.com', '12345678', 'Rua do joaoo', 12345678, '2025-02-02', 'joao123', 'Crossfit'),
(7, 'Mateus', 'mateus@gmail.com', '12345678', 'RUa amem', 12345678, '2025-02-02', '', 'Personal Trainer'),
(8, 'Yagão', 'yagoinstrutor@gmail.com', '12345678', 'Rua das Aleluias', 12345678, '2025-02-02', 'yago123', 'Aeróbica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `tipo_usuario` enum('aluno','instrutor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `tipo_usuario`) VALUES
(1, 'Kaique', 'kaique1245br@gmail.com', '$2y$10$mM5F3zd9E/dLqJ8BLuasVuVxkpZF4lb/9t30H3fkl99Io2qMlUaYy', 'aluno'),
(2, 'Yago', 'yago@gmail.com', '$2y$10$IR7jXWNG7fk7jjfZimYP6eu5AOhduLUzWC0BrgIKnPzJJcgyQena2', 'instrutor'),
(3, 'Mamute', 'mamute@gmail.com', '$2y$10$MM07HFpt/b51FQ/K8yUXPeOzZyjC6u0m5ce1rHR4aFrjJaeWVNeg6', 'aluno'),
(4, '', 'marcos@gmail.com', '$2y$10$60o7eL.vc44HBrfFVBLxn.ZA7veRB6NUF3VClgXD/fjOiU4xKOKAK', 'instrutor'),
(5, 'Roberto', 'beto@gmail.com', '$2y$10$FFiGlskjcYbzPNOvdjqV8.lAzFPH2q7JCU4LvjaEQs7FD5Sx4YQKC', 'aluno'),
(6, 'Raquel', 'kel@gmail.com', '$2y$10$/upZJ/.Yjb0sMSJcZlxzau8l7bS4aUjPPfEH0kFpo6nY/hAG1Wb56', 'aluno'),
(7, 'Tiago', 'tiago@gmail.com', '$2y$10$AqdS1rbhGGCcu09qRKLBMujS0rCzQ38Pi.eEN.CwZFqaXHpJqA8IS', 'aluno'),
(8, 'Melissa', 'mel@gmail.com', '$2y$10$.UvNz9EjEXsbfg7ViJqjde/ePeo.REI1MCwKtZQGY5vZ9X0QDdrmq', 'aluno');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_cod`),
  ADD KEY `fk_aluno_aula` (`fk_aula_cod`);

--
-- Índices para tabela `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`aula_cod`),
  ADD KEY `fk_aula_aluno` (`fk_aluno_cod`);

--
-- Índices para tabela `instrutor`
--
ALTER TABLE `instrutor`
  ADD PRIMARY KEY (`instrutor_cod`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `aluno_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `aula`
--
ALTER TABLE `aula`
  MODIFY `aula_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `instrutor`
--
ALTER TABLE `instrutor`
  MODIFY `instrutor_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_aula` FOREIGN KEY (`fk_aula_cod`) REFERENCES `aula` (`aula_cod`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `fk_aula_aluno` FOREIGN KEY (`fk_aluno_cod`) REFERENCES `aluno` (`aluno_cod`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
