<?php
$racine           = '../';
$titre_page       = 'Connexion | Chirurgien';
$description_page = 'Se connecter à son espace personnel.';
$page_active      = 'connexion';

require_once '../includes/fonctions.php';
require_once '../includes/db.php';

if (est_connecte()) {
    rediriger('espace.php');
}

$email  = '';
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email        = texte_post('email');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (!jeton_csrf_valide()) {
        $erreur = 'La session a expiré. Rechargez la page et recommencez.';
    } elseif ($email === '' || !is_string($mot_de_passe) || $mot_de_passe === '') {
        $erreur = 'Remplissez l\'adresse électronique et le mot de passe.';
    } else {
        $requete = $pdo->prepare(
            'SELECT id_utilisateur, prenom, mot_de_passe
             FROM utilisateur
             WHERE email = :email'
        );
        $requete->execute(['email' => $email]);
        $utilisateur = $requete->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {

            // Contre la fixation de session
            session_regenerate_id(true);

            $_SESSION['id_utilisateur'] = (int) $utilisateur['id_utilisateur'];
            $_SESSION['prenom']         = $utilisateur['prenom'];

            definir_message('Bonjour ' . $utilisateur['prenom'] . ', vous êtes connecté.');
            rediriger('espace.php');
        }

        // Même message dans les deux cas
        $erreur = 'Adresse électronique ou mot de passe incorrect.';
    }
}

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Compte</p>
                <p class="planche-legende">Connexion</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Se connecter</h1>
                <p class="texte-chapeau">Accédez à votre espace personnel.</p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-label="Formulaire de connexion">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">

                <?php if ($erreur !== '') : ?>
                    <p class="message-erreur" role="alert"><?= htmlspecialchars($erreur) ?></p>
                <?php endif; ?>

                <form class="formulaire" method="post" action="connexion.php" novalidate>
                    <?= champ_csrf() ?>

                    <div class="formulaire-champ">
                        <label class="form-label" for="email">Adresse électronique</label>
                        <input class="form-control" type="email" id="email" name="email"
                               required autocomplete="email" value="<?= htmlspecialchars($email) ?>">
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="mot_de_passe">Mot de passe</label>
                        <input class="form-control" type="password" id="mot_de_passe" name="mot_de_passe"
                               required autocomplete="current-password">
                    </div>

                    <div class="fiche-actions">
                        <button class="btn btn-plein" type="submit">Se connecter</button>
                        <a class="lien-texte" href="inscription.php">Créer un compte</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
