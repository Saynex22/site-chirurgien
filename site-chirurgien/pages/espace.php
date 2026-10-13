<?php
$racine           = '../';
$titre_page       = 'Mon espace | Chirurgien';
$description_page = 'Espace personnel : informations du compte.';
$page_active      = 'espace';

require_once '../includes/fonctions.php';
require_once '../includes/db.php';

exiger_connexion();

// Toujours depuis la session, jamais depuis le formulaire
$id_utilisateur = $_SESSION['id_utilisateur'];

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!jeton_csrf_valide()) {
        definir_message('La session a expiré. Recommencez l\'opération.');
        rediriger('espace.php');
    }

    $prenom = texte_post('prenom');
    $nom    = texte_post('nom');

    if ($prenom === '' || mb_strlen($prenom) > 50) {
        $erreurs['prenom'] = 'Indiquez votre prénom (50 caractères au plus).';
    }
    if ($nom === '' || mb_strlen($nom) > 50) {
        $erreurs['nom'] = 'Indiquez votre nom (50 caractères au plus).';
    }

    if (count($erreurs) === 0) {
        $requete = $pdo->prepare(
            'UPDATE utilisateur
             SET prenom = :prenom, nom = :nom
             WHERE id_utilisateur = :id'
        );
        $requete->execute(['prenom' => $prenom, 'nom' => $nom, 'id' => $id_utilisateur]);

        $_SESSION['prenom'] = $prenom;
        definir_message('Profil mis à jour.');
        rediriger('espace.php');
    }
}

$requete = $pdo->prepare('SELECT prenom, nom, email, date_inscription FROM utilisateur WHERE id_utilisateur = :id');
$requete->execute(['id' => $id_utilisateur]);
$profil = $requete->fetch();

// Compte supprimé entre-temps
if (!$profil) {
    rediriger('deconnexion.php');
}

if (count($erreurs) > 0) {
    $profil['prenom'] = texte_post('prenom');
    $profil['nom']    = texte_post('nom');
}

$date_inscription = date('d/m/Y', strtotime($profil['date_inscription']));

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Compte</p>
                <p class="planche-legende">Membre depuis le <?= $date_inscription ?></p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Bonjour, <?= htmlspecialchars($profil['prenom']) ?></h1>
                <p class="texte-chapeau">Les informations de votre compte.</p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-labelledby="profil-titre">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-5 offset-lg-4">
                <h2 class="titre-sous-section" id="profil-titre">Mon profil</h2>

                <?php if (count($erreurs) > 0) : ?>
                    <p class="message-erreur" role="alert">Le profil n'est pas modifié : corrigez les champs signalés.</p>
                <?php endif; ?>

                <form class="formulaire" method="post" action="espace.php" novalidate>
                    <?= champ_csrf() ?>

                    <div class="row">
                        <div class="col-md-6 formulaire-champ">
                            <label class="form-label" for="prenom">Prénom</label>
                            <input class="form-control<?= isset($erreurs['prenom']) ? ' is-invalid' : '' ?>"
                                   type="text" id="prenom" name="prenom" maxlength="50" required
                                   value="<?= htmlspecialchars($profil['prenom']) ?>">
                            <?php if (isset($erreurs['prenom'])) : ?>
                                <p class="invalid-feedback"><?= htmlspecialchars($erreurs['prenom']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 formulaire-champ">
                            <label class="form-label" for="nom">Nom</label>
                            <input class="form-control<?= isset($erreurs['nom']) ? ' is-invalid' : '' ?>"
                                   type="text" id="nom" name="nom" maxlength="50" required
                                   value="<?= htmlspecialchars($profil['nom']) ?>">
                            <?php if (isset($erreurs['nom'])) : ?>
                                <p class="invalid-feedback"><?= htmlspecialchars($erreurs['nom']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="email-lecture">Adresse électronique</label>
                        <input class="form-control" type="email" id="email-lecture"
                               value="<?= htmlspecialchars($profil['email']) ?>" readonly>
                    </div>

                    <div class="fiche-actions">
                        <button class="btn btn-plein" type="submit">Enregistrer</button>
                        <a class="lien-texte" href="deconnexion.php">Se déconnecter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
