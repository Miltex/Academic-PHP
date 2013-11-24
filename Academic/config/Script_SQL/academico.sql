--
-- Banco de Dados: `academico`
--
DROP DATABASE IF EXISTS academico;
CREATE DATABASE  `academico` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;


/* DROP USER `sistemaweb`@`localhost`; */

#CREATE USER `sistemaweb`@`localhost` identified by "123456";
#GRANT ALL PRIVILEGES ON academico.* TO `sistemaweb`@`localhost`;

USE academico;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `CidCodigo` int(11) NOT NULL,
  `CidNome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `CidEstado` varchar(2) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`CidCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `cidade`
--
INSERT INTO cidade VALUES (1, 'Joao Monlevade', 'MG');
INSERT INTO cidade VALUES (2, 'Itabira', 'MG');
INSERT INTO cidade VALUES (3, 'Ipatinga', 'MG');
INSERT INTO cidade VALUES (4, 'Belo Horizonte', 'MG');
INSERT INTO cidade VALUES (5, 'Sao Paulo', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--


DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `AluCodigo` int(11) NOT NULL,
  `AluNome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `AluRua` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `AluNumero` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `AluBairro` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `CidCodigo` int(11) NOT NULL,
  `AluCEP` varchar(8) COLLATE latin1_general_ci NOT NULL,
  `AluMail` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`AluCodigo`),
  FOREIGN KEY (CidCodigo) REFERENCES cidade(CidCodigo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0828042', 'ARTHUR DE ASSIS SILVA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0828994', 'DAGSON PATRICK VIEIRA DE SOUZA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0818069', 'ENRICO DIAS E SILVA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0728993', 'ISABELLA CRISTINA SANTIAGO DOS SANTOS', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0828999', 'JANNIELE APARECIDA SOARES', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0828052', 'JANSER LEMES FERREIRA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0818085', 'JORDANIA QUINTAO VIANA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0918054', 'LARISSA CAMILA PAPA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0918058', 'MARCOS ANTONIO COTA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0818043', 'MARCO TULIO TAVARES RESENDE', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0718033', 'MAYCON FERNANDO SILVA BRITO', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0828996', 'MILTON FERREIRA LIMA FILHO', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0918046', 'RAMON DA SILVA MULIA JUNIOR', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0918055', 'RENAN JOSE DOS SANTOS VIANA', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0928053', 'TEO PREDEBON INKE', '1');
INSERT INTO aluno (AluCodigo, AluNome, CidCodigo) VALUES ('0828041', 'THIAGO ALCANTARA LUIZ', '1');



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE  TABLE `academico`.`usuario` (
  `UsuCodigo` INT NOT NULL ,
  `UsuNome` VARCHAR(80) NULL ,
  `UsuLogin` VARCHAR(20) NULL ,
  `UsuSenha` VARCHAR(32) NULL ,
  PRIMARY KEY (`UsuCodigo`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;

INSERT into usuario VALUES (1, 'Administrador', 'admin', md5('admin'));
INSERT into usuario VALUES (2, 'Secretaria', 'secretaria', md5('secretaria'));
INSERT into usuario VALUES (3, 'Coordenador', 'coordenador', md5('coordenador'));

