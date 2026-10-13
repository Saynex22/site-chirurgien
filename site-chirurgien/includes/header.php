<?php
// Variables attendues : $racine, $titre_page, $description_page, $page_active, $avec_hero

require_once __DIR__ . '/fonctions.php';

// Valeurs par défaut
$racine           = $racine ?? './';
$titre_page       = $titre_page ?? 'Chirurgien';
$description_page = $description_page ?? 'Site de présentation du métier de chirurgien.';
$page_active      = $page_active ?? '';
$avec_hero        = $avec_hero ?? false;

$est_connecte = est_connecte();

$message_flash = lire_message();

// clé => [libellé, chemin]
$liens_menu = [
    'metier'      => ['Le métier', 'pages/metier.php'],
    'specialites' => ['Spécialités', 'pages/specialites.php'],
    'parcours'    => ['Parcours', 'pages/parcours.php'],
];

if ($est_connecte) {
    $liens_menu['espace'] = ['Mon espace', 'pages/espace.php'];
} else {
    $liens_menu['connexion'] = ['Connexion', 'pages/connexion.php'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($description_page) ?>">
    <title><?= htmlspecialchars($titre_page) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500&family=Instrument+Serif:ital@0;1&display=swap">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $racine ?>css/style.css">
</head>
<body class="<?= $avec_hero ? 'page-hero' : 'page-standard' ?>">

<a class="lien-evitement" href="#contenu">Aller au contenu</a>

<header class="entete-site fixed-top<?= $avec_hero ? '' : ' entete-claire' ?>" id="entete-site">
    <nav class="navbar navbar-expand-lg" aria-label="Navigation principale">
        <div class="container-fluid conteneur-site">

            <a class="navbar-brand" href="<?= $racine ?>index.php">
                <img class="logo-site" src="<?= $racine ?>img/Medicine.svg"
                     alt="Caducée, retour à l'accueil" width="32" height="40">
            </a>

            <button class="navbar-toggler bouton-menu" type="button"
                    data-bs-toggle="collapse" data-bs-target="#menu-principal"
                    aria-controls="menu-principal" aria-expanded="false"
                    aria-label="Ouvrir ou fermer le menu">
                <span class="bouton-menu-texte">Menu</span>
                <span class="bouton-menu-traits" aria-hidden="true"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-principal">
                <ul class="navbar-nav menu-liens">
                    <?php foreach ($liens_menu as $cle => $lien) : ?>
                        <li class="nav-item">
                            <a class="nav-link<?= $cle === $page_active ? ' active' : '' ?>"
                               href="<?= $racine . $lien[1] ?>"
                               <?= $cle === $page_active ? 'aria-current="page"' : '' ?>>
                                <?= htmlspecialchars($lien[0]) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a class="btn btn-contour" href="<?= $racine ?>pages/contact.php">Contact</a>
            </div>

        </div>
    </nav>
</header>

<main id="contenu">

<?php if ($message_flash !== null && !$avec_hero) : ?>
    <div class="conteneur-site">
        <p class="message-flash" role="status"><?= htmlspecialchars($message_flash) ?></p>
    </div>
<?php endif; ?>
