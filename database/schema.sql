CREATE DATABASE IF NOT EXISTS impact_academy
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE impact_academy;

-- USERS
CREATE TABLE usuarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  foto VARCHAR(255) NULL,
  tipo ENUM('admin','mentor','aluno') NOT NULL DEFAULT 'aluno',
  status ENUM('ativo','bloqueado') NOT NULL DEFAULT 'ativo',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uk_usuarios_email (email)
) ENGINE=InnoDB;

-- PROGRAMAS
CREATE TABLE programas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  descricao TEXT NULL,
  imagem VARCHAR(255) NULL,
  status ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB;

-- MODULOS
CREATE TABLE modulos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  programa_id INT UNSIGNED NOT NULL,
  titulo VARCHAR(160) NOT NULL,
  ordem INT NOT NULL DEFAULT 0,
  CONSTRAINT fk_modulos_programa
    FOREIGN KEY (programa_id) REFERENCES programas(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  KEY idx_modulos_programa_ordem (programa_id, ordem)
) ENGINE=InnoDB;

-- AULAS
CREATE TABLE aulas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  modulo_id INT UNSIGNED NOT NULL,
  titulo VARCHAR(180) NOT NULL,
  descricao TEXT NULL,
  video_url VARCHAR(255) NULL,
  texto MEDIUMTEXT NULL,
  pdf VARCHAR(255) NULL,
  status ENUM('publicada','rascunho') NOT NULL DEFAULT 'publicada',
  ordem INT NOT NULL DEFAULT 0,
  CONSTRAINT fk_aulas_modulo
    FOREIGN KEY (modulo_id) REFERENCES modulos(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  KEY idx_aulas_modulo_ordem (modulo_id, ordem)
) ENGINE=InnoDB;

-- MATRICULAS
CREATE TABLE matriculas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT UNSIGNED NOT NULL,
  programa_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_matriculas_usuario
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_matriculas_programa
    FOREIGN KEY (programa_id) REFERENCES programas(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  UNIQUE KEY uk_matriculas_usuario_programa (usuario_id, programa_id)
) ENGINE=InnoDB;

-- PROGRESSO (conclusão de aula)
CREATE TABLE progresso (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT UNSIGNED NOT NULL,
  aula_id INT UNSIGNED NOT NULL,
  concluido TINYINT(1) NOT NULL DEFAULT 1,
  completed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_progresso_usuario
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_progresso_aula
    FOREIGN KEY (aula_id) REFERENCES aulas(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  UNIQUE KEY uk_progresso_usuario_aula (usuario_id, aula_id)
) ENGINE=InnoDB;

-- LOGS DE XP (gamificação auditável)
CREATE TABLE xp_logs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT UNSIGNED NOT NULL,
  tipo ENUM('AULA_CONCLUIDA','MODULO_CONCLUIDO','PROGRAMA_CONCLUIDO','EVENTO_PARTICIPOU','ATIVIDADE_ENVIADA') NOT NULL,
  referencia_id INT UNSIGNED NULL,
  pontos INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_xp_usuario
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  KEY idx_xp_usuario_data (usuario_id, created_at)
) ENGINE=InnoDB;

-- BIBLIOTECA (deixa criada para V2; não usada neste MVP)
CREATE TABLE biblioteca (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(180) NOT NULL,
  descricao TEXT NULL,
  arquivo VARCHAR(255) NOT NULL,
  categoria VARCHAR(80) NOT NULL,
  status ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- EVENTOS (deixa criada para V2)
CREATE TABLE eventos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(180) NOT NULL,
  descricao TEXT NULL,
  data_evento DATETIME NOT NULL,
  tipo ENUM('online','presencial') NOT NULL DEFAULT 'online',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ADMIN SEED (senha: Admin@123)
INSERT INTO usuarios (nome, email, senha, tipo, status)
VALUES (
  'Admin',
  'admin@impact.local',
  '$2y$10$5g6zY3u3tC1q6b8G1W8nQeT3Ue3qGJ2Q9mGq5hAqQzq5u7jC9p7jS',
  'admin',
  'ativo'
);