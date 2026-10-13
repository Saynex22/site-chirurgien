<?php
// Paramètres lus par includes/header.php
$racine           = './';
$titre_page       = 'Chirurgien : le métier, les spécialités, la formation';
$description_page = 'Découvrir le métier de chirurgien : quotidien, spécialités chirurgicales et parcours de formation en France.';
$page_active      = 'accueil';
$avec_hero        = true;

// Spécialités pour l'index
require_once 'includes/db.php';
$specialites = $pdo->query('SELECT id_specialite, nom, domaine FROM specialite ORDER BY nom')->fetchAll();

include 'includes/header.php';
?>

<section class="hero" aria-labelledby="hero-titre">

    <img class="hero-image"
         src="img/piron-guillaume-y5hQCIn1c6o-unsplash.webp"
         alt="Équipe chirurgicale en tenue de bloc autour d'un patient, entourée d'écrans de surveillance"
         width="2000" height="1333">

    <div class="hero-contenu conteneur-site">
        <h1 class="hero-titre" id="hero-titre">Chirurgien</h1>
        <figure class="hero-serment">
            <blockquote class="hero-serment-texte">
                <p>
                    « Je dirigerai le régime des malades à leur avantage,
                    suivant mes forces et mon jugement, et je m'abstiendrai
                    de tout mal et de toute injustice. »
                </p>
            </blockquote>
            <figcaption class="hero-serment-source">
                Hippocrate, <cite>Serment</cite>, traduction d'Émile Littré (1844)
            </figcaption>
        </figure>
    </div>

    <div class="hero-pied">
        <div class="conteneur-site hero-pied-grille">
            <p class="hero-credit">
                Photo :
                <a href="https://unsplash.com/photos/y5hQCIn1c6o" target="_blank" rel="noopener">Guillaume Piron / Unsplash</a>
            </p>

            <a class="fleche-bas" href="#introduction" aria-label="Descendre vers la présentation du métier">
                <span class="fleche-bas-trait" aria-hidden="true"></span>
            </a>

            <ul class="hero-raccourcis">
                <li><a href="pages/specialites.php">Spécialités</a></li>
                <li><a href="pages/parcours.php">Parcours</a></li>
            </ul>
        </div>
    </div>
</section>

<section class="planche" id="introduction" aria-labelledby="intro-titre">
    <div class="conteneur-site">
        <div class="row">

            <div class="col-lg-3">
                <p class="planche-numero">Planche I</p>
                <p class="planche-legende">Le métier</p>
            </div>

            <div class="col-lg-8 offset-lg-1">
                <h2 class="titre-section" id="intro-titre">Opérer, c'est d'abord décider.</h2>

                <p class="texte-chapeau">
                    Le chirurgien est un médecin qui soigne par l'intervention manuelle
                    et instrumentale. Avant le geste, il y a le diagnostic, le choix de la
                    technique et la discussion avec le patient. Après, il y a le suivi,
                    parfois pendant des années.
                </p>

                <div class="row">
                    <div class="col-md-6">
                        <p>
                            Le métier s'exerce au bloc opératoire, mais aussi en consultation
                            et dans les services. Une journée peut commencer par la visite des
                            patients opérés la veille, continuer par plusieurs interventions et
                            finir par des consultations ou une garde.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            La chirurgie n'est pas une discipline unique. Chaque spécialité a
                            ses organes, ses techniques et son rythme : un neurochirurgien et un
                            chirurgien orthopédiste ont la même formation de base, pas le même
                            quotidien.
                        </p>
                        <p><a class="lien-texte" href="pages/metier.php">Qualités et difficultés du métier</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="index-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Planche II</p>
                <p class="planche-legende"><?= count($specialites) ?> spécialités parmi d'autres</p>
            </div>

            <div class="col-lg-8 offset-lg-1">
                <h2 class="titre-section" id="index-titre">Index des spécialités</h2>

                <ul class="index-liste">
                    <?php foreach ($specialites as $specialite) : ?>
                        <li>
                            <a class="index-ligne" href="pages/specialite.php?id=<?= (int) $specialite['id_specialite'] ?>">
                                <span class="index-nom"><?= htmlspecialchars($specialite['nom']) ?></span>
                                <span class="index-domaine"><?= htmlspecialchars($specialite['domaine']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="formation-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Planche III</p>
                <p class="planche-legende">La formation</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h2 class="titre-section" id="formation-titre">Douze ans d'études au minimum</h2>
            </div>
        </div>

        <ol class="row etapes">
            <li class="col-md-4 etape">
                <p class="etape-annees">Années 1 à 6</p>
                <h3 class="etape-titre">Études de médecine</h3>
                <p>
                    Une première année PASS ou L.AS, puis cinq années d'études médicales.
                    Les épreuves nationales de fin de sixième année décident de la
                    spécialité et de la ville d'internat.
                </p>
            </li>
            <li class="col-md-4 etape">
                <p class="etape-annees">Années 7 à 12</p>
                <h3 class="etape-titre">Internat de chirurgie</h3>
                <p>
                    Le diplôme d'études spécialisées de chirurgie dure six ans. L'interne opère sous la responsabilité de chirurgiens
                    confirmés, puis gagne en autonomie comme docteur junior.
                </p>
            </li>
            <li class="col-md-4 etape">
                <p class="etape-annees">Ensuite</p>
                <h3 class="etape-titre">Exercice</h3>
                <p>
                    Hôpital public, clinique privée ou cabinet libéral. Beaucoup
                    complètent leur formation par un poste d'assistant ou de chef
                    de clinique.
                </p>
            </li>
        </ol>

        <p class="planche-suite">
            <a class="btn btn-plein" href="pages/parcours.php">Voir le parcours détaillé</a>
        </p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
