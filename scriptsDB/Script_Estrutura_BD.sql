-- =============================
-- CRIAÇÃO DATABASE rio_saude
-- =============================
-- CREATE DATABASE rio_saude
-- -----------------------------
-- DROP DE TABELAS
-- -----------------------------
DROP TABLE IF EXISTS reputacao;
DROP TABLE IF EXISTS unidade_basica_saude_federal;
DROP TABLE IF EXISTS estabelecimento_saude;
--
DROP VIEW IF EXISTS view_esfera_administrativa;
DROP VIEW IF EXISTS view_atividade_de_ensino;
DROP VIEW IF EXISTS view_natureza_da_organizacao;
DROP VIEW IF EXISTS view_tipo_de_unidade;
DROP VIEW IF EXISTS view_situacao_federal;
-- -----------------------------
-- CRIACAO DE TABELAS
-- -----------------------------
CREATE TABLE estabelecimento_saude (
	cnes MEDIUMINT UNSIGNED NOT NULL,
	cnpj VARCHAR(14),
	razao_social VARCHAR(60) NOT NULL,
	nome_de_fantasia VARCHAR(60) NOT NULL,
	logradouro VARCHAR(60) NOT NULL,
	numero VARCHAR(10) NOT NULL,
	complemento VARCHAR(60),
	bairro VARCHAR(60) NOT NULL,
	cep VARCHAR(8) NOT NULL,
	telefone VARCHAR(40),
	fax VARCHAR(60),
	email VARCHAR(60),
	latitude VARCHAR(30) NOT NULL,
	longitude VARCHAR(30) NOT NULL,
	data_de_atualizacao_coordenadas VARCHAR(10),
	codigo_esfera_administrativa TINYINT UNSIGNED NOT NULL,
	esfera_administrativa VARCHAR(60) NOT NULL,
	codigo_da_atividade TINYINT UNSIGNED NOT NULL,
	atividade_de_ensino VARCHAR(60) NOT NULL,
	codigo_da_natureza_organizacao TINYINT UNSIGNED NOT NULL,
	natureza_da_organizacao VARCHAR(60) NOT NULL,
	tipo_da_unidade TINYINT UNSIGNED NOT NULL,
	tipo_de_estabelecimento VARCHAR(60) NOT NULL,
	PRIMARY KEY (cnes));
CREATE TABLE unidade_basica_saude_federal (
	vlr_latitude VARCHAR(30) NOT NULL,
	vlr_longitude VARCHAR(30) NOT NULL,
	cod_munic MEDIUMINT UNSIGNED NOT NULL,
	cod_cnes MEDIUMINT UNSIGNED NOT NULL,
	nom_estab VARCHAR(60) NOT NULL,
	dsc_endereco VARCHAR(60) NOT NULL,
	dsc_bairro VARCHAR(60),
	dsc_cidade VARCHAR(40) NOT NULL,
	dsc_telefone VARCHAR(40),
	dsc_estrut_fisic_ambiencia VARCHAR(60) NOT NULL,
	dsc_adap_defic_fisic_idoso VARCHAR(60) NOT NULL,
	dsc_equipamentos VARCHAR(60) NOT NULL,
	dsc_medicamentos VARCHAR(60) NOT NULL);
CREATE TABLE reputacao (
	codigo INT UNSIGNED NOT NULL,
	qtd_estrelas TINYINT UNSIGNED NOT NULL,
	data DATE NOT NULL,
	cnes_municipio MEDIUMINT UNSIGNED NOT NULL,
	PRIMARY KEY (codigo));	
-- -----------------------------
-- COMENTÁRIOS NAS TABELAS
-- -----------------------------
ALTER TABLE estabelecimento_saude COMMENT 'Dados Abertos da Cidade do Rio de Janeiro';
ALTER TABLE unidade_basica_saude_federal COMMENT 'Dados Abertos Brasil';
ALTER TABLE reputacao COMMENT 'Dados gerados pela avaliação do usuário';
-- -----------------------------
-- CRIACAO DE CONSTRAINTS
-- -----------------------------
ALTER TABLE reputacao ADD CONSTRAINT unidade_saude_recomendacao_fk
	FOREIGN KEY (cnes_municipio)
	REFERENCES estabelecimento_saude (cnes)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;
-- -----------------------------
-- CRIACAO DE UNIKE KEYS
-- -----------------------------
CREATE UNIQUE INDEX idx_unidade_basica_saude_federal_cod_cnes ON unidade_basica_saude_federal (cod_cnes);
-- -----------------------------
-- CRIACAO DE INDICES
-- -----------------------------
CREATE INDEX idx_estabelecimento_saude_codigo_esfera_administrativa ON estabelecimento_saude (codigo_esfera_administrativa);
CREATE INDEX idx_estabelecimento_saude_esfera_administrativa ON estabelecimento_saude (esfera_administrativa);
CREATE INDEX idx_estabelecimento_saude_codigo_da_atividade ON estabelecimento_saude (codigo_da_atividade);
CREATE INDEX idx_estabelecimento_saude_codigo_da_natureza_organizacao ON estabelecimento_saude (codigo_da_natureza_organizacao);
CREATE INDEX idx_estabelecimento_saude_natureza_da_organizacao ON estabelecimento_saude (natureza_da_organizacao);
CREATE INDEX idx_estabelecimento_saude_tipo_da_unidade ON estabelecimento_saude (tipo_da_unidade);
CREATE INDEX idx_estabelecimento_saude_tipo_de_estabelecimento ON estabelecimento_saude (tipo_de_estabelecimento);
--
CREATE INDEX idx_unidade_basica_saude_federal_cod_munic ON unidade_basica_saude_federal (cod_munic);
CREATE INDEX idx_unidade_basica_saude_federal_dsc_estrut_fisic_ambiencia ON unidade_basica_saude_federal (dsc_estrut_fisic_ambiencia);
CREATE INDEX idx_unidade_basica_saude_federal_dsc_adap_defic_fisic_idoso ON unidade_basica_saude_federal (dsc_adap_defic_fisic_idoso);
CREATE INDEX idx_unidade_basica_saude_federal_dsc_equipamentos ON unidade_basica_saude_federal (dsc_equipamentos);
CREATE INDEX idx_unidade_basica_saude_federal_dsc_medicamentos ON unidade_basica_saude_federal (dsc_medicamentos);
--
CREATE INDEX idx_reputacao_cnes_municipio ON reputacao (cnes_municipio);
-- -----------------------------
-- CRIACAO DE VIEWS
-- -----------------------------
CREATE VIEW view_esfera_administrativa AS SELECT DISTINCT codigo_esfera_administrativa, esfera_administrativa FROM estabelecimento_saude ORDER BY codigo_esfera_administrativa;
CREATE VIEW view_atividade_de_ensino AS SELECT DISTINCT codigo_da_atividade, atividade_de_ensino FROM estabelecimento_saude ORDER BY codigo_da_atividade;
CREATE VIEW view_natureza_da_organizacao AS SELECT DISTINCT codigo_da_natureza_organizacao, natureza_da_organizacao FROM estabelecimento_saude ORDER BY codigo_da_natureza_organizacao;
CREATE VIEW view_tipo_de_unidade AS SELECT DISTINCT tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude ORDER BY tipo_da_unidade;
--
CREATE VIEW view_situacao_federal AS 
	SELECT DISTINCT dsc_estrut_fisic_ambiencia AS situacao FROM unidade_basica_saude_federal
	UNION
	SELECT DISTINCT dsc_adap_defic_fisic_idoso AS situacao FROM unidade_basica_saude_federal
	UNION
	SELECT DISTINCT dsc_equipamentos AS situacao FROM unidade_basica_saude_federal
	UNION
	SELECT DISTINCT dsc_medicamentos AS situacao FROM unidade_basica_saude_federal;
