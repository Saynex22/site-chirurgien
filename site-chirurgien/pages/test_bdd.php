<?php
/* =====================================================================
   pages/test_bdd.php : page TEMPORAIRE pour vérifier la connexion.
   À supprimer avant le rendu du projet.
   ===================================================================== */
require_once '../includes/db.php';

// Requête sans paramètre venant de l'utilisateur : query() suffit ici
$resultat = $pdo->query('SELECT id_specialite, nom FROM specialite ORDER BY nom');
$specialites = $resultat->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Test de connexion</title>
</head>
<body>
    <h1>Connexion réussie</h1>
    <p><?= count($specialites) ?> spécialités trouvées :</p>
    <ul>
        <?php foreach ($specialites as $specialite) : ?>
            <li><?= (int) $specialite['id_specialite'] ?> : <?= htmlspecialchars($specialite['nom']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
