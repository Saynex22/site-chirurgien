<?php
$racine           = '../';
$titre_page       = 'Spécialités | Chirurgien';
$description_page = 'Les spécialités chirurgicales présentées sur le site, avec leur domaine et la durée de l\'internat.';
$page_active      = 'specialites';

require_once '../includes/db.php';

// Nombre d'étapes par spécialité
$sql = 'SELECT s.id_specialite, s.nom, s.domaine, s.duree_des, s.image,
               COUNT(e.id_etape) AS nb_etapes
        FROM specialite AS s
        LEFT JOIN etape_formation AS e ON e.id_specialite = s.id_specialite
        GROUP BY s.id_specialite, s.nom, s.domaine, s.duree_des, s.image
        ORDER BY s.nom';
$specialites = $pdo->query($sql)->fetchAll();

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Planche II</p>
                <p class="planche-legende"><?= count($specialites) ?> fiches</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Spécialités</h1>
                <p class="texte-chapeau">
                    Tous les chirurgiens suivent le même début de formation. Le choix de la
                    spécialité se fait à la fin de la sixième année et décide de tout le reste :
                    les organes, les gestes, le rythme de travail.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-label="Liste des spécialités">
    <div class="conteneur-site">

        <?php if (count($specialites) === 0) : ?>
            <p class="message-info">Aucune spécialité n'est encore enregistrée.</p>
        <?php else : ?>
            <ul class="row gy-5 vignettes">
                <?php foreach ($specialites as $numero => $specialite) : ?>
                    <li class="col-sm-6 col-lg-4">
                        <a class="vignette" href="specialite.php?id=<?= (int) $specialite['id_specialite'] ?>">
                            <?php if ($specialite['image'] !== null) : ?>
                                <img class="vignette-image" src="../img/<?= htmlspecialchars($specialite['image']) ?>"
                                     alt="" loading="lazy">
                            <?php else : ?>
                                <span class="vignette-image vignette-vide" aria-hidden="true"></span>
                            <?php endif; ?>
                            <span class="vignette-numero">Fig. <?= $numero + 1 ?></span>
                            <span class="vignette-nom"><?= htmlspecialchars($specialite['nom']) ?></span>
                            <span class="vignette-domaine"><?= htmlspecialchars($specialite['domaine']) ?></span>
                            <span class="vignette-duree">
                                Internat : <?= (int) $specialite['duree_des'] ?> ans,
                                <?= (int) $specialite['nb_etapes'] ?> étapes
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</section>

<?php include '../includes/footer.php'; ?>
