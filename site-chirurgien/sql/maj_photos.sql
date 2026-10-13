-- Seulement si evolution_etape5.sql a été lancé avant l'ajout des photos
SET NAMES utf8mb4;
USE chirurgien;

UPDATE specialite SET image = 'specialites/chirurgie-pediatrique.webp', credit_image = 'Unsplash', lien_image = 'https://unsplash.com/' WHERE id_specialite = 3;
UPDATE specialite SET image = 'specialites/chirurgie-plastique.webp',   credit_image = 'Unsplash', lien_image = 'https://unsplash.com/' WHERE id_specialite = 4;
UPDATE specialite SET image = 'specialites/chirurgie-viscerale.webp',   credit_image = 'Unsplash', lien_image = 'https://unsplash.com/' WHERE id_specialite = 5;
UPDATE specialite SET image = 'specialites/neurochirurgie.webp',        credit_image = 'Robina Weermeijer / Unsplash',
                      lien_image = 'https://unsplash.com/photos/3KGF9R_0oHs' WHERE id_specialite = 6;
