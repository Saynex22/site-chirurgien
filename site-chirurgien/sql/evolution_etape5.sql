SET NAMES utf8mb4;

USE chirurgien;

-- Nouvelles colonnes de specialite
ALTER TABLE specialite
    ADD COLUMN quotidien     TEXT         NULL AFTER description,
    ADD COLUMN interventions TEXT         NULL AFTER quotidien,
    ADD COLUMN exercice      TEXT         NULL AFTER interventions,
    ADD COLUMN image         VARCHAR(255) NULL AFTER exercice,
    ADD COLUMN credit_image  VARCHAR(255) NULL AFTER image,
    ADD COLUMN lien_image    VARCHAR(255) NULL AFTER credit_image;

-- Contenus des nouvelles colonnes
UPDATE specialite SET
    quotidien = 'Les journées sont rythmées par une ou deux interventions longues, souvent de quatre à six heures. Le chirurgien travaille en équipe étroite avec l''anesthésiste et le perfusionniste, qui pilote la circulation extracorporelle. Les patients passent ensuite en réanimation, où les premières heures sont décisives.',
    interventions = 'Pontage coronarien, remplacement ou réparation d''une valve cardiaque, chirurgie de l''aorte, ablation d''une partie du poumon en cas de tumeur, transplantation cardiaque ou pulmonaire dans quelques centres.',
    exercice = 'Surtout à l''hôpital, en CHU ou en grand centre : ces opérations demandent un plateau technique lourd. L''exercice libéral existe dans quelques cliniques spécialisées.',
    image = 'specialites/chirurgie-cardiaque.webp',
    credit_image = 'Mathurin Napoly / Unsplash',
    lien_image = 'https://unsplash.com/@matnapo'
WHERE id_specialite = 1;

UPDATE specialite SET
    quotidien = 'Le rythme alterne programme opératoire, consultations et urgences traumatologiques. Les interventions sont souvent plus courtes qu''en chirurgie cardiaque, mais nombreuses. Le travail est physique : il faut manipuler les membres, utiliser des instruments lourds et contrôler le geste à la radiographie.',
    interventions = 'Prothèse de hanche ou de genou, reconstruction du ligament croisé, fixation d''une fracture par plaque ou clou, chirurgie de la main, arthroscopie de l''épaule, chirurgie de la colonne vertébrale.',
    exercice = 'Très présente en clinique privée et en libéral, où la pose de prothèses occupe une grande place. À l''hôpital public, la traumatologie et les urgences dominent.',
    image = 'specialites/chirurgie-orthopedique.webp',
    credit_image = 'Akram Huseyn / Unsplash',
    lien_image = NULL
WHERE id_specialite = 2;

UPDATE specialite SET
    quotidien = 'Le chirurgien opère aussi bien des nouveau-nés que des adolescents : la taille des instruments, les doses et la façon d''expliquer changent à chaque fois. Les parents sont présents à chaque étape. Une grande partie de l''activité vient des urgences.',
    interventions = 'Appendicite, hernie de l''aine, testicule non descendu, correction de malformations digestives ou urinaires du nouveau-né, fractures de l''enfant, scoliose.',
    exercice = 'Presque uniquement à l''hôpital, dans les services de chirurgie pédiatrique des CHU et de quelques grands hôpitaux. Les postes sont peu nombreux.'
WHERE id_specialite = 3;

UPDATE specialite SET
    quotidien = 'Une intervention peut durer quelques dizaines de minutes ou une journée entière pour une reconstruction complexe. Le chirurgien travaille avec d''autres équipes : cancérologie, traumatologie, centres de brûlés. La consultation compte beaucoup : il faut écouter la demande et expliquer ce qui est possible.',
    interventions = 'Reconstruction du sein après un cancer, greffe de peau chez les brûlés, chirurgie de la main, lambeaux pour couvrir une plaie après un accident, correction de malformations du visage, chirurgie esthétique.',
    exercice = 'Partagé entre l''hôpital (reconstruction, brûlés, urgences de la main) et le libéral, où la chirurgie esthétique, non remboursée, pèse fortement sur les revenus.'
WHERE id_specialite = 4;

UPDATE specialite SET
    quotidien = 'C''est la spécialité des urgences abdominales : beaucoup de gardes et des opérations la nuit. En journée, le programme mêle cancers digestifs et interventions plus courantes. La plupart des gestes se font par cœlioscopie, avec une caméra et de petites incisions, parfois à l''aide d''un robot.',
    interventions = 'Ablation de l''appendice ou de la vésicule biliaire, réparation de hernie, chirurgie de l''obésité, ablation d''une partie du côlon, de l''estomac, du foie ou du pancréas en cas de cancer.',
    exercice = 'Présente partout : CHU, hôpitaux généraux et cliniques. Dans la plupart des hôpitaux, c''est elle qui assure les urgences chirurgicales.'
WHERE id_specialite = 5;

UPDATE specialite SET
    quotidien = 'Les interventions se font au microscope opératoire, guidées par une imagerie préparée avant le bloc. Certaines tumeurs du cerveau s''opèrent sur un patient réveillé, pour vérifier pendant le geste que la parole et le mouvement sont préservés. Les urgences imposent des décisions rapides.',
    interventions = 'Ablation de tumeurs du cerveau, traitement des hernies discales, chirurgie des traumatismes crâniens, dérivation en cas d''hydrocéphalie, stimulation cérébrale profonde dans la maladie de Parkinson.',
    exercice = 'Surtout à l''hôpital : les services de neurochirurgie se trouvent dans les CHU et quelques grands établissements. Le libéral concerne surtout la chirurgie de la colonne vertébrale.',
    image = 'specialites/neurochirurgie.webp',
    credit_image = 'Robina Weermeijer / Unsplash',
    lien_image = 'https://unsplash.com/photos/3KGF9R_0oHs'
WHERE id_specialite = 6;

-- Photos (Unsplash)
UPDATE specialite SET image = 'specialites/chirurgie-pediatrique.webp', credit_image = 'Unsplash', lien_image = 'https://unsplash.com/' WHERE id_specialite = 3;
UPDATE specialite SET image = 'specialites/chirurgie-plastique.webp',   credit_image = 'Unsplash', lien_image = 'https://unsplash.com/' WHERE id_specialite = 4;
UPDATE specialite SET image = 'specialites/chirurgie-viscerale.webp',   credit_image = 'Unsplash', lien_image = 'https://unsplash.com/' WHERE id_specialite = 5;
