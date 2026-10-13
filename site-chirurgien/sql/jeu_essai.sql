SET NAMES utf8mb4;

USE chirurgien;

-- Spécialités

-- Avec clé primaire donnée
INSERT INTO specialite (id_specialite, nom, domaine, description, duree_des) VALUES
(1, 'Chirurgie cardiaque et thoracique', 'Cœur, poumons, gros vaisseaux',
    'Elle opère le cœur, les valves, les artères coronaires et les poumons. Les interventions sont longues et se font souvent avec une circulation extracorporelle, qui remplace le cœur pendant l''opération.', 6),
(2, 'Chirurgie orthopédique', 'Os, articulations, tendons',
    'Elle traite les fractures, l''usure des articulations et les déformations du squelette. La pose de prothèses de hanche ou de genou fait partie des opérations les plus fréquentes.', 6),
(3, 'Chirurgie pédiatrique', 'Enfants, de la naissance à l''adolescence',
    'Elle opère des patients dont le corps grandit encore. Le chirurgien doit adapter chaque geste à la taille de l''enfant et expliquer l''intervention aux parents comme à l''enfant.', 6);

-- Sans clé primaire : AUTO_INCREMENT donne 4, 5, 6
INSERT INTO specialite (nom, domaine, description, duree_des) VALUES
('Chirurgie plastique et reconstructrice', 'Peau, tissus, réparation après accident',
    'Elle répare ce qu''un accident, une brûlure ou une maladie a abîmé. La partie esthétique n''est qu''une part du métier : la reconstruction après un cancer en est une autre, très importante.', 6),
('Chirurgie viscérale et digestive', 'Organes de l''abdomen',
    'Elle intervient sur l''estomac, l''intestin, le foie ou le pancréas. Une grande partie des urgences chirurgicales, comme l''appendicite, relève de cette spécialité.', 6),
('Neurochirurgie', 'Cerveau, moelle épinière, nerfs',
    'Elle opère le système nerveux : tumeurs du cerveau, hernies discales, traumatismes crâniens. La précision demandée est extrême, car un millimètre peut changer le résultat.', 6);

-- Étapes de formation
INSERT INTO etape_formation (id_specialite, ordre, titre, duree_annees, description) VALUES
(1, 1, 'Première année PASS ou L.AS', 1, 'Année d''accès aux études de santé, très sélective.'),
(1, 2, 'Deuxième et troisième cycles de médecine', 5, 'Cours, stages à l''hôpital, puis épreuves nationales de fin de sixième année.'),
(1, 3, 'DES de chirurgie thoracique et cardiovasculaire', 6, 'Internat en services de chirurgie cardiaque et thoracique.'),
(1, 4, 'Post-internat', 2, 'Poste d''assistant ou de chef de clinique, facultatif mais fréquent.'),

(2, 1, 'Première année PASS ou L.AS', 1, 'Année d''accès aux études de santé, très sélective.'),
(2, 2, 'Deuxième et troisième cycles de médecine', 5, 'Cours, stages à l''hôpital, puis épreuves nationales de fin de sixième année.'),
(2, 3, 'DES de chirurgie orthopédique et traumatologique', 6, 'Internat en services d''orthopédie et de traumatologie.'),

(3, 1, 'Première année PASS ou L.AS', 1, 'Année d''accès aux études de santé, très sélective.'),
(3, 2, 'Deuxième et troisième cycles de médecine', 5, 'Cours, stages à l''hôpital, puis épreuves nationales de fin de sixième année.'),
(3, 3, 'DES de chirurgie pédiatrique', 6, 'Internat en services de chirurgie de l''enfant.'),

(4, 1, 'Première année PASS ou L.AS', 1, 'Année d''accès aux études de santé, très sélective.'),
(4, 2, 'Deuxième et troisième cycles de médecine', 5, 'Cours, stages à l''hôpital, puis épreuves nationales de fin de sixième année.'),
(4, 3, 'DES de chirurgie plastique, reconstructrice et esthétique', 6, 'Internat en services de chirurgie plastique et des brûlés.'),

(5, 1, 'Première année PASS ou L.AS', 1, 'Année d''accès aux études de santé, très sélective.'),
(5, 2, 'Deuxième et troisième cycles de médecine', 5, 'Cours, stages à l''hôpital, puis épreuves nationales de fin de sixième année.'),
(5, 3, 'DES de chirurgie viscérale et digestive', 6, 'Internat en services de chirurgie digestive.'),

(6, 1, 'Première année PASS ou L.AS', 1, 'Année d''accès aux études de santé, très sélective.'),
(6, 2, 'Deuxième et troisième cycles de médecine', 5, 'Cours, stages à l''hôpital, puis épreuves nationales de fin de sixième année.'),
(6, 3, 'DES de neurochirurgie', 6, 'Internat en services de neurochirurgie.');

-- Utilisateurs de test, mot de passe : Test1234!
INSERT INTO utilisateur (prenom, nom, email, mot_de_passe) VALUES
('Léa',    'Martin',  'lea.martin@exemple.fr',  '$2y$10$ymlGa2R6jjD3lAlNCn2a0ur8dJqLHkGPRU5BK971orXrhn.qTDixS'),
('Hugo',   'Bernard', 'hugo.bernard@exemple.fr', '$2y$10$lMfBPFBTIv1uVIMgBTt.6OQd/NhfnZ9ftnV1a4PtzOIYxWvVxJU/u'),
('Inès',   'Petit',   'ines.petit@exemple.fr',   '$2y$10$5AEzmvz9AHVRctY6jKYV4.IzhkEShrZnUEA0rkiRkVKpl09/yW4ke');

-- Favoris
INSERT INTO favori (id_utilisateur, id_specialite) VALUES
(1, 1),
(1, 6),
(2, 2),
(3, 3),
(3, 5);

-- Messages de contact
INSERT INTO message (id_specialite, nom, email, telephone, contenu, date_envoi) VALUES
(6,    'Camille Roux',  'camille.roux@exemple.fr',  NULL,         'Combien de neurochirurgiens exercent en France ?', '2026-09-02 10:15:00'),
(2,    'Yanis Moreau',  'yanis.moreau@exemple.fr',  '0601020304', 'Peut-on faire de l''orthopédie du sport dès l''internat ?', '2026-09-20 18:40:00'),
(NULL, 'Sarah Lefèvre', 'sarah.lefevre@exemple.fr', NULL,         'Votre site m''a aidée à préparer mon oral, merci.', '2026-10-05 09:05:00');
