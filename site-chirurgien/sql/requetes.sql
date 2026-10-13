SET NAMES utf8mb4;

USE chirurgien;

-- Lecture

-- Toutes les spécialités
SELECT id_specialite, nom, domaine
FROM specialite
ORDER BY nom;

-- Une spécialité par son identifiant
SELECT nom, domaine, description, duree_des
FROM specialite
WHERE id_specialite = 6;

-- Une spécialité et ses étapes
SELECT s.nom AS specialite, e.ordre, e.titre, e.duree_annees
FROM specialite AS s
INNER JOIN etape_formation AS e ON e.id_specialite = s.id_specialite
WHERE s.id_specialite = 1
ORDER BY e.ordre;

-- Durée totale des études par spécialité
SELECT s.nom AS specialite, SUM(e.duree_annees) AS annees_total
FROM specialite AS s
INNER JOIN etape_formation AS e ON e.id_specialite = s.id_specialite
GROUP BY s.id_specialite, s.nom
ORDER BY annees_total DESC;

-- Favoris de chaque utilisateur
SELECT u.prenom, u.nom, s.nom AS specialite_favorite
FROM favori AS f
INNER JOIN utilisateur AS u ON u.id_utilisateur = f.id_utilisateur
INNER JOIN specialite  AS s ON s.id_specialite  = f.id_specialite
ORDER BY u.nom, s.nom;

-- Messages, avec ou sans sujet
SELECT m.nom, m.date_envoi, IFNULL(s.nom, 'Sans sujet') AS sujet
FROM message AS m
LEFT JOIN specialite AS s ON s.id_specialite = m.id_specialite
ORDER BY m.date_envoi DESC;

-- Modification

-- Sans condition
UPDATE message
SET traite = 0;

-- Condition sur la clé
UPDATE utilisateur
SET prenom = 'Hugo-Alexandre'
WHERE id_utilisateur = 2;

-- Condition sur un critère
UPDATE message
SET traite = 1
WHERE date_envoi < '2026-10-01';

-- Suppression

-- Par la clé primaire
DELETE FROM favori
WHERE id_utilisateur = 1 AND id_specialite = 6;

-- Condition sur un critère
DELETE FROM message
WHERE traite = 1;

-- Sans condition (vide la table) :
-- DELETE FROM favori;

-- Tests des contraintes : chaque requête doit être refusée

-- UNIQUE
-- INSERT INTO specialite (nom, domaine, description, duree_des) VALUES ('Neurochirurgie', 'x', 'x', 6);

-- CHECK sur la durée
-- INSERT INTO specialite (nom, domaine, description, duree_des) VALUES ('Test', 'x', 'x', 9);

-- CHECK sur l'adresse
-- INSERT INTO utilisateur (prenom, nom, email, mot_de_passe) VALUES ('A', 'B', 'adresse-invalide', 'x');

-- Clé primaire composée
-- INSERT INTO favori (id_utilisateur, id_specialite) VALUES (2, 2);

-- FOREIGN KEY
-- INSERT INTO etape_formation (id_specialite, ordre, titre, duree_annees) VALUES (99, 1, 'Test', 1);
