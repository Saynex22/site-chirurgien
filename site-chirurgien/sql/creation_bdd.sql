-- Ordre : creation_bdd.sql, jeu_essai.sql, evolution_etape5.sql
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS chirurgien
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE chirurgien;

-- Tables filles d'abord (remuneration : ancienne version du projet)
DROP TABLE IF EXISTS remuneration;
DROP TABLE IF EXISTS favori;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS msg_contact;
DROP TABLE IF EXISTS etape_formation;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS specialite;

-- Table specialite
CREATE TABLE specialite (
    id_specialite INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    nom           VARCHAR(100)     NOT NULL,
    domaine       VARCHAR(150)     NOT NULL,
    description   TEXT             NOT NULL,
    duree_des     TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_specialite       PRIMARY KEY (id_specialite),
    CONSTRAINT uq_specialite_nom   UNIQUE (nom),
    CONSTRAINT ck_specialite_duree CHECK (duree_des BETWEEN 4 AND 6)
) ENGINE = InnoDB;

-- Table etape_formation
CREATE TABLE etape_formation (
    id_etape      INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    id_specialite INT UNSIGNED     NOT NULL,
    ordre         TINYINT UNSIGNED NOT NULL,
    titre         VARCHAR(150)     NOT NULL,
    duree_annees  TINYINT UNSIGNED NOT NULL,
    description   TEXT             NULL,
    CONSTRAINT pk_etape            PRIMARY KEY (id_etape),
    CONSTRAINT uq_etape_ordre      UNIQUE (id_specialite, ordre),
    CONSTRAINT ck_etape_ordre      CHECK (ordre >= 1),
    CONSTRAINT ck_etape_duree      CHECK (duree_annees BETWEEN 1 AND 6),
    CONSTRAINT fk_etape_specialite FOREIGN KEY (id_specialite)
        REFERENCES specialite (id_specialite)
        ON DELETE CASCADE
) ENGINE = InnoDB;

-- Table utilisateur
-- SERIAL = BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE
CREATE TABLE utilisateur (
    id_utilisateur   SERIAL,
    prenom           VARCHAR(50)  NOT NULL,
    nom              VARCHAR(50)  NOT NULL,
    email            VARCHAR(150) NOT NULL,
    mot_de_passe     VARCHAR(255) NOT NULL,
    date_inscription DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_utilisateur       PRIMARY KEY (id_utilisateur),
    CONSTRAINT uq_utilisateur_email UNIQUE (email),
    CONSTRAINT ck_utilisateur_email CHECK (email LIKE '%_@_%._%')
) ENGINE = InnoDB;

-- Table favori
-- Clé primaire composée
CREATE TABLE favori (
    id_utilisateur BIGINT UNSIGNED NOT NULL,
    id_specialite  INT UNSIGNED    NOT NULL,
    date_ajout     DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_favori PRIMARY KEY (id_utilisateur, id_specialite),
    CONSTRAINT fk_favori_utilisateur FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur (id_utilisateur)
        ON DELETE CASCADE,
    CONSTRAINT fk_favori_specialite FOREIGN KEY (id_specialite)
        REFERENCES specialite (id_specialite)
        ON DELETE CASCADE
) ENGINE = InnoDB;

-- Table des messages de contact
-- Créée sous le nom msg_contact, renommée plus bas
CREATE TABLE msg_contact (
    id_message    INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_specialite INT UNSIGNED NULL,
    nom           VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL,
    contenu       TEXT         NOT NULL,
    traite        TINYINT(1)   NOT NULL DEFAULT 0, -- 0 = à lire, 1 = traité
    date_envoi    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_message         PRIMARY KEY (id_message),
    CONSTRAINT ck_message_contenu CHECK (CHAR_LENGTH(contenu) >= 10),
    CONSTRAINT ck_message_traite  CHECK (traite IN (0, 1)),
    CONSTRAINT fk_message_specialite FOREIGN KEY (id_specialite)
        REFERENCES specialite (id_specialite)
        ON DELETE SET NULL
) ENGINE = InnoDB;

-- Modifications après création

-- Ajout d'une colonne
ALTER TABLE msg_contact
    ADD COLUMN telephone VARCHAR(20) NULL AFTER email;

-- Changement de nom
ALTER TABLE msg_contact
    RENAME TO message;
