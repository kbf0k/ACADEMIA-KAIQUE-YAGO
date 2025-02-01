-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/02/2025 às 05:29
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
-- Banco de dados: `db_academia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE DATABASE db_academia;
USE db_academia;


CREATE TABLE `aluno` (
  `aluno_cod` int(11) NOT NULL,
  `aluno_nome` varchar(100) NOT NULL,
  `aluno_email` varchar(255) NOT NULL,
  `aluno_cpf` varchar(14) NOT NULL,
  `aluno_endereco` varchar(255) DEFAULT NULL,
  `aluno_telefone` varchar(20) DEFAULT NULL,
  `aluno_nasc` date DEFAULT NULL,
  `aluno_senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`aluno_cod`, `aluno_nome`, `aluno_email`, `aluno_cpf`, `aluno_endereco`, `aluno_telefone`, `aluno_nasc`, `aluno_senha`) VALUES
(1, 'Kaique', 'kaique1245br@gmail.com', '123456789', 'Rua do Kaique', '123456789', '2025-02-11', '$2y$10$mM5F3zd9E/dLqJ8BLuasVuVxkpZF4lb/9t30H3fkl99Io2qMlUaYy'),
(2, 'Yago', 'yago@gmail.com', '123456789', 'Rua do yago', '123456789', '2025-02-11', '$2y$10$IR7jXWNG7fk7jjfZimYP6eu5AOhduLUzWC0BrgIKnPzJJcgyQena2'),
(3, 'Mamute', 'mamute@gmail.com', '123456789', 'Rua do mamute', '123456789', '2025-02-18', '$2y$10$MM07HFpt/b51FQ/K8yUXPeOzZyjC6u0m5ce1rHR4aFrjJaeWVNeg6');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aula`
--

CREATE TABLE `aula` (
  `aula_cod` int(11) NOT NULL,
  `aula_tipo` enum('Yoga','Musculação','Crossfit','Zumba','Aeróbica','Pilates','Personal Trainer') NOT NULL,
  `aula_data` datetime NOT NULL,
  `fk_instrutor_cod` int(11) DEFAULT NULL,
  `fk_aluno_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aula`
--

INSERT INTO `aula` (`aula_cod`, `aula_tipo`, `aula_data`, `fk_instrutor_cod`, `fk_aluno_cod`) VALUES
(1, 'Crossfit', '2025-02-01 05:27:04', 1, 1),
(2, 'Zumba', '2025-02-01 05:27:31', 1, 2),
(3, 'Personal Trainer', '2025-02-01 05:27:44', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `instrutor`
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
-- Despejando dados para a tabela `instrutor`
--

INSERT INTO `instrutor` (`instrutor_cod`, `instrutor_nome`, `instrutor_email`, `instrutor_cpf`, `instrutor_endereco`, `instrutor_telefone`, `instrutor_nasc`, `instrutor_senha`, `instrutor_especialidade`) VALUES
(1, 'Marcos', '', '', '', 0, '0000-00-00', '', 'Musculação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `tipo_usuario` enum('aluno','instrutor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `tipo_usuario`) VALUES
(1, 'Kaique', 'kaique1245br@gmail.com', '$2y$10$mM5F3zd9E/dLqJ8BLuasVuVxkpZF4lb/9t30H3fkl99Io2qMlUaYy', 'aluno'),
(2, 'Yago', 'yago@gmail.com', '$2y$10$IR7jXWNG7fk7jjfZimYP6eu5AOhduLUzWC0BrgIKnPzJJcgyQena2', 'aluno'),
(3, 'Mamute', 'mamute@gmail.com', '$2y$10$MM07HFpt/b51FQ/K8yUXPeOzZyjC6u0m5ce1rHR4aFrjJaeWVNeg6', 'aluno'),
(4, '', 'marcos@gmail.com', '$2y$10$60o7eL.vc44HBrfFVBLxn.ZA7veRB6NUF3VClgXD/fjOiU4xKOKAK', 'instrutor');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_cod`);

--
-- Índices de tabela `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`aula_cod`),
  ADD KEY `fk_instrutor_cod` (`fk_instrutor_cod`),
  ADD KEY `fk_aluno_cod` (`fk_aluno_cod`);

--
-- Índices de tabela `instrutor`
--
ALTER TABLE `instrutor`
  ADD PRIMARY KEY (`instrutor_cod`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `aluno_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `aula`
--
ALTER TABLE `aula`
  MODIFY `aula_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `instrutor`
--
ALTER TABLE `instrutor`
  MODIFY `instrutor_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `fk_aluno_cod` FOREIGN KEY (`fk_aluno_cod`) REFERENCES `aluno` (`aluno_cod`),
  ADD CONSTRAINT `fk_instrutor_cod` FOREIGN KEY (`fk_instrutor_cod`) REFERENCES `instrutor` (`instrutor_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
