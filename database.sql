-- ─────────────────────────────────────────────────────────────────────────────
-- Schema: crud_docentes
-- Motor: MySQL 8+ / MariaDB 10.5+
-- ─────────────────────────────────────────────────────────────────────────────

CREATE DATABASE IF NOT EXISTS crud_docentes
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE crud_docentes;

CREATE TABLE IF NOT EXISTS docentes (
    id                INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    nombre            VARCHAR(100)     NOT NULL,
    apellidos         VARCHAR(100)     NOT NULL,
    email             VARCHAR(150)     NOT NULL,
    telefono          VARCHAR(25)      NOT NULL,
    blog              VARCHAR(255)     NULL,
    profesional       VARCHAR(150)     NOT NULL  COMMENT 'Título profesional (p.ej. Ingeniero de Sistemas)',
    escalafon         ENUM(
                          'Instructor',
                          'Asistente',
                          'Asociado',
                          'Titular',
                          'Emérito'
                      )               NOT NULL,
    idioma            ENUM(
                          'Español',
                          'Inglés',
                          'Francés',
                          'Alemán',
                          'Portugués',
                          'Mandarín',
                          'Otro'
                      )               NOT NULL,
    anios_experiencia TINYINT UNSIGNED NOT NULL DEFAULT 0,
    area_trabajo      VARCHAR(150)     NOT NULL  COMMENT 'Área o departamento académico',
    created_at        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uq_docentes_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Datos de prueba ───────────────────────────────────────────────────────────
INSERT INTO docentes
    (nombre, apellidos, email, telefono, blog, profesional, escalafon, idioma, anios_experiencia, area_trabajo)
VALUES
    ('John Carlos', 'Arrieta Arrieta', 'jcarrieta@uni.edu.co', '+57 3001234567',
     'https://jcarrieta.dev', 'Ingeniero de Sistemas', 'Asociado', 'Español', 15, 'Ingeniería de Software'),

    ('María Paula', 'Gómez Torres', 'mpgomez@uni.edu.co', '+57 3109876543',
     NULL, 'Matemática', 'Titular', 'Inglés', 22, 'Matemáticas'),

    ('Andrés Felipe', 'López Martínez', 'aflopez@uni.edu.co', '+57 3156665544',
     'https://aflopez.blog', 'Físico', 'Asistente', 'Francés', 5, 'Física');
