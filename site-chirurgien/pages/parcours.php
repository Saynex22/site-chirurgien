<?php
$racine           = '../';
$titre_page       = 'Parcours de formation | Chirurgien';
$description_page = 'Les étapes pour devenir chirurgien en France.';
$page_active      = 'parcours';

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Planche III</p>
                <p class="planche-legende">La formation</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Parcours de formation</h1>
                <p class="texte-chapeau">
                    Devenir chirurgien demande au minimum douze ans après le baccalauréat.
                    Les six premières années sont communes à tous les médecins, l'internat
                    est propre à chaque spécialité.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-labelledby="etapes-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h2 class="titre-sous-section" id="etapes-titre">Les grandes étapes</h2>

                <ol class="liste-etapes">
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">Année 1</p>
                        <div>
                            <h3 class="liste-etapes-titre">PASS ou L.AS</h3>
                            <p>Première année d'accès aux études de santé. Seule une partie des étudiants est admise à continuer en médecine.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">Années 2 et 3</p>
                        <div>
                            <h3 class="liste-etapes-titre">Premier cycle</h3>
                            <p>Sciences fondamentales, anatomie, premiers stages d'observation à l'hôpital.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">Années 4 à 6</p>
                        <div>
                            <h3 class="liste-etapes-titre">Externat</h3>
                            <p>L'étudiant partage son temps entre les cours et les services hospitaliers. Les épreuves nationales de sixième année fixent le rang de classement, qui permet de choisir la spécialité et la ville.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">Années 7 à 12</p>
                        <div>
                            <h3 class="liste-etapes-titre">Internat de chirurgie</h3>
                            <p>Six ans en trois phases : socle, approfondissement, puis consolidation, pendant laquelle l'interne devient docteur junior et opère avec plus d'autonomie.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="suite-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h2 class="titre-sous-section" id="suite-titre">Par spécialité</h2>
                <p>Chaque fiche détaille la durée de l'internat et les étapes propres à la spécialité.</p>
                <p><a class="btn btn-plein" href="specialites.php">Voir les spécialités</a></p>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
