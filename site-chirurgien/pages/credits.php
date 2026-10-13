<?php
$racine           = '../';
$titre_page       = 'Crédits et mentions | Chirurgien';
$description_page = 'Sources des images, des polices et des outils utilisés sur le site.';
$page_active      = 'credits';

require_once '../includes/db.php';

$photos = $pdo->query(
    'SELECT nom, credit_image, lien_image
     FROM specialite
     WHERE image IS NOT NULL AND credit_image IS NOT NULL
     ORDER BY nom'
)->fetchAll();

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h1 class="page-titre">Crédits et mentions</h1>
                <p class="texte-chapeau">
                    Ce site est un projet réalisé dans le cadre du BTS SIO. Les textes ont été
                    rédigés pour le projet. Les éléments ci-dessous viennent d'autres auteurs
                    et sont utilisés selon leur licence.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-label="Liste des crédits">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <dl class="definitions">
                    <dt>Photographie du bloc opératoire</dt>
                    <dd>
                        Guillaume Piron, sur
                        <a href="https://unsplash.com/photos/y5hQCIn1c6o" target="_blank" rel="noopener">Unsplash</a>.
                        Licence Unsplash : utilisation libre, sans obligation de citer l'auteur,
                        mais nous le citons.
                    </dd>

                    <?php foreach ($photos as $photo) : ?>
                        <dt>Photographie : <?= htmlspecialchars($photo['nom']) ?></dt>
                        <dd>
                            <?php if ($photo['lien_image'] !== null) : ?>
                                <a href="<?= htmlspecialchars($photo['lien_image']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($photo['credit_image']) ?></a>.
                            <?php else : ?>
                                <?= htmlspecialchars($photo['credit_image']) ?>.
                            <?php endif; ?>
                            Licence Unsplash : utilisation libre.
                        </dd>
                    <?php endforeach; ?>

                    <dt>Logo (caducée)</dt>
                    <dd>
                        Illustration issue d'<a href="https://unsplash.com/" target="_blank" rel="noopener">Unsplash</a>,
                        licence Unsplash : utilisation libre, y compris sans citer l'auteur.
                    </dd>

                    <dt>Rémunérations</dt>
                    <dd>
                        Grille des praticiens hospitaliers et émoluments des internes : arrêté du
                        8 juillet 2022 modifié. Revenus libéraux : CARMF, revenus 2024.
                        Montants vérifiés en octobre 2026.
                    </dd>

                    <dt>Serment d'Hippocrate</dt>
                    <dd>Traduction d'Émile Littré (1844), texte du domaine public.</dd>

                    <dt>Polices</dt>
                    <dd>
                        Instrument Serif et IBM Plex Sans, distribuées par Google Fonts
                        sous licence SIL Open Font License.
                    </dd>

                    <dt>Bootstrap</dt>
                    <dd>Bibliothèque CSS et JavaScript, version 5.3, sous licence MIT.</dd>
                </dl>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
