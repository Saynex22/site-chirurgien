<?php
$racine           = '../';
$titre_page       = 'Le métier | Chirurgien';
$description_page = 'Les qualités demandées à un chirurgien et les difficultés du métier.';
$page_active      = 'metier';

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Planche I</p>
                <p class="planche-legende">Le métier</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Qualités et difficultés</h1>
                <p class="texte-chapeau">
                    Savoir opérer ne suffit pas. Le métier demande aussi de tenir dans la
                    durée, de décider vite et d'expliquer clairement, à des patients
                    souvent inquiets.
                </p>
            </div>
        </div>
    </div>
</section>

<figure class="figure-centree conteneur-site">
    <img src="../img/piron-guillaume-y5hQCIn1c6o-unsplash.webp"
         alt="Chirurgiens au travail dans un bloc opératoire, sous les lampes"
         width="2000" height="1333" loading="lazy">
    <figcaption>
        Fig. 1. Une équipe au bloc : le chirurgien travaille rarement seul.
        Photo : Guillaume Piron / Unsplash.
    </figcaption>
</figure>

<section class="planche planche-serree" aria-label="Qualités et difficultés">
    <div class="conteneur-site">
        <div class="row gy-5">

            <div class="col-lg-5 offset-lg-1">
                <h2 class="titre-sous-section">Qualités demandées</h2>
                <dl class="definitions">
                    <dt>Précision</dt>
                    <dd>Un geste se mesure en millimètres. La main doit rester sûre après plusieurs heures d'intervention.</dd>

                    <dt>Sang-froid</dt>
                    <dd>Une complication peut survenir à tout moment. Il faut garder son calme et choisir rapidement la bonne réponse.</dd>

                    <dt>Endurance</dt>
                    <dd>Certaines opérations durent plus de six heures, debout, sans pause. Les gardes de nuit s'ajoutent aux journées.</dd>

                    <dt>Sens de l'équipe</dt>
                    <dd>Anesthésiste, infirmiers de bloc, internes : le chirurgien dirige, mais rien ne se fait sans les autres.</dd>

                    <dt>Écoute</dt>
                    <dd>Expliquer une opération, ses risques et ses suites fait partie du soin, autant que le geste lui-même.</dd>
                </dl>
            </div>

            <div class="col-lg-5">
                <h2 class="titre-sous-section">Difficultés du métier</h2>
                <dl class="definitions">
                    <dt>Des études très longues</dt>
                    <dd>Douze ans au minimum après le baccalauréat, avec une sélection forte dès la première année.</dd>

                    <dt>Des horaires lourds</dt>
                    <dd>Gardes, astreintes et urgences rendent l'équilibre entre vie professionnelle et vie personnelle difficile.</dd>

                    <dt>La responsabilité</dt>
                    <dd>Chaque décision a des conséquences directes sur la santé du patient, et le chirurgien en répond.</dd>

                    <dt>La charge émotionnelle</dt>
                    <dd>Annoncer un échec, accompagner une famille ou perdre un patient font aussi partie du métier.</dd>
                </dl>
            </div>

        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="journee-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Une journée</p>
                <p class="planche-legende">Exemple dans un service hospitalier</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h2 class="titre-sous-section" id="journee-titre">Une journée type</h2>
                <p>Chaque service a son rythme, mais une journée ressemble souvent à ceci.</p>

                <ol class="liste-etapes">
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">7 h 30</p>
                        <div>
                            <h3 class="liste-etapes-titre">Visite des patients</h3>
                            <p>Passage auprès des patients opérés la veille : douleur, pansements, premiers signes de complication.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">8 h 15</p>
                        <div>
                            <h3 class="liste-etapes-titre">Réunion d'équipe</h3>
                            <p>Point sur les cas difficiles et sur le programme du jour avec les internes et les anesthésistes.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">8 h 45</p>
                        <div>
                            <h3 class="liste-etapes-titre">Bloc opératoire</h3>
                            <p>Une à plusieurs interventions selon leur durée. Entre deux patients, le chirurgien rédige le compte rendu opératoire.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">14 h 30</p>
                        <div>
                            <h3 class="liste-etapes-titre">Consultations</h3>
                            <p>Nouveaux patients, explication des opérations à venir, suivi des patients déjà opérés.</p>
                        </div>
                    </li>
                    <li class="liste-etapes-ligne">
                        <p class="liste-etapes-annees">Le soir</p>
                        <div>
                            <h3 class="liste-etapes-titre">Garde ou astreinte</h3>
                            <p>Plusieurs fois par mois, le chirurgien reste disponible la nuit pour les urgences.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="exercice-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h2 class="titre-sous-section" id="exercice-titre">Où travaille un chirurgien</h2>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-md-4 offset-lg-0">
                <dl class="definitions">
                    <dt>Hôpital public</dt>
                    <dd>Salarié, il est rémunéré selon une grille nationale. Il participe à l'enseignement, à la recherche et aux urgences.</dd>
                </dl>
            </div>
            <div class="col-md-4">
                <dl class="definitions">
                    <dt>Clinique privée</dt>
                    <dd>Il opère dans un établissement privé, le plus souvent comme libéral : il paie une redevance à la clinique.</dd>
                </dl>
            </div>
            <div class="col-md-4">
                <dl class="definitions">
                    <dt>Exercice mixte</dt>
                    <dd>Certains praticiens hospitaliers ont une petite activité libérale au sein même de l'hôpital, dans des limites fixées par la loi.</dd>
                </dl>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="remuneration-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Rémunération</p>
                <p class="planche-legende">Repères 2026</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h2 class="titre-sous-section" id="remuneration-titre">Combien gagne un chirurgien ?</h2>
                <p>
                    À l'hôpital public, la grille est la même pour toutes les spécialités :
                    c'est l'ancienneté qui fait progresser le salaire. En libéral, les écarts
                    entre spécialités sont importants.
                </p>
                <?php include '../includes/tableau_remuneration.php'; ?>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-filet" aria-labelledby="suite-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h2 class="titre-sous-section" id="suite-titre">Et ensuite ?</h2>
                <p>Chaque spécialité a ses propres contraintes. Les fiches détaillent le domaine et la formation de chacune.</p>
                <p><a class="btn btn-plein" href="specialites.php">Voir les spécialités</a></p>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
