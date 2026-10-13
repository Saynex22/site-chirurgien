<?php
$racine      = '../';
$page_active = 'specialites';

require_once '../includes/db.php';

$id_specialite = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);

$lignes = [];

if ($id_specialite) {
    $requete = $pdo->prepare(
        'SELECT s.nom, s.domaine, s.description, s.duree_des,
                s.quotidien, s.interventions, s.exercice,
                s.image, s.credit_image, s.lien_image,
                e.ordre, e.titre, e.duree_annees, e.description AS etape_description
         FROM specialite AS s
         LEFT JOIN etape_formation AS e ON e.id_specialite = s.id_specialite
         WHERE s.id_specialite = :id
         ORDER BY e.ordre'
    );
    $requete->execute(['id' => $id_specialite]);
    $lignes = $requete->fetchAll();
}

// Identifiant invalide ou inexistant
if (count($lignes) === 0) {
    http_response_code(404);
    $titre_page       = 'Spécialité introuvable | Chirurgien';
    $description_page = 'Cette fiche n\'existe pas.';
    include '../includes/header.php';
    ?>
    <section class="page-entete">
        <div class="conteneur-site">
            <div class="row">
                <div class="col-lg-8 offset-lg-4">
                    <h1 class="page-titre">Fiche introuvable</h1>
                    <p class="texte-chapeau">
                        Aucune spécialité ne correspond à cette adresse.
                        Choisissez-en une dans l'index.
                    </p>
                    <p><a class="btn btn-plein" href="specialites.php">Voir toutes les spécialités</a></p>
                </div>
            </div>
        </div>
    </section>
    <?php
    include '../includes/footer.php';
    exit;
}

// Infos de la spécialité, répétées sur chaque ligne
$specialite = $lignes[0];

// LEFT JOIN : ordre vaut NULL s'il n'y a aucune étape
$etapes = array_filter($lignes, function ($ligne) {
    return $ligne['ordre'] !== null;
});

$annees_total = 0;
foreach ($etapes as $etape) {
    $annees_total += (int) $etape['duree_annees'];
}

$rubriques = [
    'Au quotidien'            => $specialite['quotidien'],
    'Interventions courantes' => $specialite['interventions'],
    'Où exercer'              => $specialite['exercice'],
];

$titre_page       = $specialite['nom'] . ' | Chirurgien';
$description_page = $specialite['nom'] . ' : domaine, formation et durée des études.';

include '../includes/header.php';
?>

<nav class="fil-ariane conteneur-site" aria-label="Fil d'Ariane">
    <a href="specialites.php">Spécialités</a>
    <span aria-hidden="true">/</span>
    <span aria-current="page"><?= htmlspecialchars($specialite['nom']) ?></span>
</nav>

<article class="fiche">
    <div class="conteneur-site">
        <div class="row">

            <aside class="col-lg-3 order-2 order-lg-1 fiche-reperes">
                <dl>
                    <dt>Domaine</dt>
                    <dd><?= htmlspecialchars($specialite['domaine']) ?></dd>

                    <dt>Durée de l'internat</dt>
                    <dd><?= (int) $specialite['duree_des'] ?> ans</dd>

                    <?php if ($annees_total > 0) : ?>
                        <dt>Durée totale indiquée</dt>
                        <dd><?= $annees_total ?> ans</dd>
                    <?php endif; ?>
                </dl>
            </aside>

            <div class="col-lg-8 offset-lg-1 order-1 order-lg-2">
                <h1 class="page-titre"><?= htmlspecialchars($specialite['nom']) ?></h1>
                <p class="texte-chapeau"><?= htmlspecialchars($specialite['description']) ?></p>

                <?php if ($specialite['image'] !== null) : ?>
                    <figure class="fiche-image">
                        <img src="../img/<?= htmlspecialchars($specialite['image']) ?>"
                             alt="Illustration de la spécialité : <?= htmlspecialchars($specialite['nom']) ?>">
                        <?php if ($specialite['credit_image'] !== null) : ?>
                            <figcaption>
                                Photo :
                                <?php if ($specialite['lien_image'] !== null) : ?>
                                    <a href="<?= htmlspecialchars($specialite['lien_image']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($specialite['credit_image']) ?></a>
                                <?php else : ?>
                                    <?= htmlspecialchars($specialite['credit_image']) ?>
                                <?php endif; ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>

                <?php foreach ($rubriques as $titre_rubrique => $texte_rubrique) : ?>
                    <?php if ($texte_rubrique !== null) : ?>
                        <section class="fiche-rubrique">
                            <h2 class="titre-sous-section"><?= $titre_rubrique ?></h2>
                            <p><?= htmlspecialchars($texte_rubrique) ?></p>
                        </section>
                    <?php endif; ?>
                <?php endforeach; ?>

                <h2 class="titre-sous-section">Étapes de la formation</h2>

                <?php if (count($etapes) === 0) : ?>
                    <p class="message-info">Les étapes de cette formation ne sont pas encore renseignées.</p>
                <?php else : ?>
                    <ol class="liste-etapes">
                        <?php $annee_debut = 1; ?>
                        <?php foreach ($etapes as $etape) : ?>
                            <?php
                            $annee_fin = $annee_debut + (int) $etape['duree_annees'] - 1;
                            $libelle_annees = ($annee_debut === $annee_fin)
                                ? 'Année ' . $annee_debut
                                : 'Années ' . $annee_debut . ' à ' . $annee_fin;
                            ?>
                            <li class="liste-etapes-ligne">
                                <p class="liste-etapes-annees"><?= $libelle_annees ?></p>
                                <div>
                                    <h3 class="liste-etapes-titre"><?= htmlspecialchars($etape['titre']) ?></h3>
                                    <?php if ($etape['etape_description'] !== null) : ?>
                                        <p><?= htmlspecialchars($etape['etape_description']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php $annee_debut = $annee_fin + 1; ?>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>

                <h2 class="titre-sous-section">Rémunération</h2>
                <?php include '../includes/tableau_remuneration.php'; ?>

                <div class="fiche-actions">
                    <a class="btn btn-plein" href="parcours.php">Voir le parcours de formation</a>
                    <a class="lien-texte" href="specialites.php">Retour à l'index</a>
                </div>
            </div>

        </div>
    </div>
</article>

<?php include '../includes/footer.php'; ?>
