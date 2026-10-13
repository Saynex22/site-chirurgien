<?php
$racine           = '../';
$titre_page       = 'Inscription | Chirurgien';
$description_page = 'Créer un compte sur le site.';
$page_active      = 'connexion';

require_once '../includes/fonctions.php';
require_once '../includes/db.php';

if (est_connecte()) {
    rediriger('espace.php');
}

$valeurs = ['prenom' => '', 'nom' => '', 'email' => ''];
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach (array_keys($valeurs) as $cle) {
        $valeurs[$cle] = texte_post($cle);
    }
    // Pas de trim() sur les mots de passe
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    if (!jeton_csrf_valide()) {
        $erreurs['general'] = 'La session a expiré. Rechargez la page et recommencez.';
    }

    if ($valeurs['prenom'] === '' || mb_strlen($valeurs['prenom']) > 50) {
        $erreurs['prenom'] = 'Indiquez votre prénom (50 caractères au plus).';
    }

    if ($valeurs['nom'] === '' || mb_strlen($valeurs['nom']) > 50) {
        $erreurs['nom'] = 'Indiquez votre nom (50 caractères au plus).';
    }

    if (!filter_var($valeurs['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Indiquez une adresse électronique valide.';
    } else {
        $requete = $pdo->prepare('SELECT COUNT(*) FROM utilisateur WHERE email = :email');
        $requete->execute(['email' => $valeurs['email']]);
        if ((int) $requete->fetchColumn() > 0) {
            $erreurs['email'] = 'Un compte existe déjà avec cette adresse. Connectez-vous.';
        }
    }

    // Au moins 8 caractères dont un chiffre
    if (!is_string($mot_de_passe) || mb_strlen($mot_de_passe) < 8 || !preg_match('/[0-9]/', $mot_de_passe)) {
        $erreurs['mot_de_passe'] = 'Le mot de passe doit faire au moins 8 caractères, dont un chiffre.';
    } elseif ($mot_de_passe !== $confirmation) {
        $erreurs['confirmation'] = 'Les deux mots de passe ne sont pas identiques.';
    }

    if (count($erreurs) === 0) {
        $requete = $pdo->prepare(
            'INSERT INTO utilisateur (prenom, nom, email, mot_de_passe)
             VALUES (:prenom, :nom, :email, :mot_de_passe)'
        );
        $requete->execute([
            'prenom'       => $valeurs['prenom'],
            'nom'          => $valeurs['nom'],
            'email'        => $valeurs['email'],
            'mot_de_passe' => password_hash($mot_de_passe, PASSWORD_DEFAULT),
        ]);

        definir_message('Compte créé. Vous pouvez maintenant vous connecter.');
        rediriger('connexion.php');
    }
}

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Compte</p>
                <p class="planche-legende">Inscription</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Créer un compte</h1>
                <p class="texte-chapeau">
                    Un compte donne accès à un espace personnel.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-label="Formulaire d'inscription">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-5 offset-lg-4">

                <?php if (isset($erreurs['general'])) : ?>
                    <p class="message-erreur" role="alert"><?= htmlspecialchars($erreurs['general']) ?></p>
                <?php elseif (count($erreurs) > 0) : ?>
                    <p class="message-erreur" role="alert">Le compte n'est pas créé : corrigez les champs signalés.</p>
                <?php endif; ?>

                <form class="formulaire" method="post" action="inscription.php" novalidate>
                    <?= champ_csrf() ?>

                    <div class="row">
                        <div class="col-md-6 formulaire-champ">
                            <label class="form-label" for="prenom">Prénom</label>
                            <input class="form-control<?= isset($erreurs['prenom']) ? ' is-invalid' : '' ?>"
                                   type="text" id="prenom" name="prenom" maxlength="50" required autocomplete="given-name"
                                   value="<?= htmlspecialchars($valeurs['prenom']) ?>">
                            <?php if (isset($erreurs['prenom'])) : ?>
                                <p class="invalid-feedback"><?= htmlspecialchars($erreurs['prenom']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 formulaire-champ">
                            <label class="form-label" for="nom">Nom</label>
                            <input class="form-control<?= isset($erreurs['nom']) ? ' is-invalid' : '' ?>"
                                   type="text" id="nom" name="nom" maxlength="50" required autocomplete="family-name"
                                   value="<?= htmlspecialchars($valeurs['nom']) ?>">
                            <?php if (isset($erreurs['nom'])) : ?>
                                <p class="invalid-feedback"><?= htmlspecialchars($erreurs['nom']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="email">Adresse électronique</label>
                        <input class="form-control<?= isset($erreurs['email']) ? ' is-invalid' : '' ?>"
                               type="email" id="email" name="email" maxlength="150" required autocomplete="email"
                               value="<?= htmlspecialchars($valeurs['email']) ?>">
                        <?php if (isset($erreurs['email'])) : ?>
                            <p class="invalid-feedback"><?= htmlspecialchars($erreurs['email']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="mot_de_passe">Mot de passe (8 caractères dont un chiffre)</label>
                        <input class="form-control<?= isset($erreurs['mot_de_passe']) ? ' is-invalid' : '' ?>"
                               type="password" id="mot_de_passe" name="mot_de_passe" required autocomplete="new-password">
                        <?php if (isset($erreurs['mot_de_passe'])) : ?>
                            <p class="invalid-feedback"><?= htmlspecialchars($erreurs['mot_de_passe']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="confirmation">Confirmer le mot de passe</label>
                        <input class="form-control<?= isset($erreurs['confirmation']) ? ' is-invalid' : '' ?>"
                               type="password" id="confirmation" name="confirmation" required autocomplete="new-password">
                        <?php if (isset($erreurs['confirmation'])) : ?>
                            <p class="invalid-feedback"><?= htmlspecialchars($erreurs['confirmation']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="fiche-actions">
                        <button class="btn btn-plein" type="submit">Créer mon compte</button>
                        <a class="lien-texte" href="connexion.php">J'ai déjà un compte</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
