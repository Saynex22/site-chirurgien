<?php
$racine           = '../';
$titre_page       = 'Contact | Chirurgien';
$description_page = 'Poser une question sur le métier de chirurgien ou sur une spécialité.';
$page_active      = 'contact';

require_once '../includes/fonctions.php';
require_once '../includes/db.php';

$sujets = $pdo->query('SELECT id_specialite, nom FROM specialite ORDER BY nom')->fetchAll();

// Pour vérifier que le sujet reçu existe
$ids_sujets = array_map('intval', array_column($sujets, 'id_specialite'));

$valeurs = ['nom' => '', 'email' => '', 'telephone' => '', 'sujet' => '', 'contenu' => ''];
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach (array_keys($valeurs) as $cle) {
        $valeurs[$cle] = texte_post($cle);
    }

    // Vérifications
    if (!jeton_csrf_valide()) {
        $erreurs['general'] = 'La session a expiré. Rechargez la page et renvoyez le message.';
    }

    $longueur_nom = mb_strlen($valeurs['nom']);
    if ($longueur_nom < 2 || $longueur_nom > 100) {
        $erreurs['nom'] = 'Indiquez un nom de 2 à 100 caractères.';
    }

    if (!filter_var($valeurs['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Indiquez une adresse électronique valide, par exemple nom@exemple.fr.';
    }

    // Téléphone facultatif, format français
    if ($valeurs['telephone'] !== '' && !preg_match('/^0[1-9]( ?[0-9]{2}){4}$/', $valeurs['telephone'])) {
        $erreurs['telephone'] = 'Indiquez un numéro à 10 chiffres commençant par 0, ou laissez le champ vide.';
    }

    // Sujet facultatif
    $id_sujet = null;
    if ($valeurs['sujet'] !== '') {
        $id_sujet = filter_var($valeurs['sujet'], FILTER_VALIDATE_INT);
        if ($id_sujet === false || !in_array($id_sujet, $ids_sujets, true)) {
            $erreurs['sujet'] = 'Choisissez un sujet dans la liste.';
            $id_sujet = null;
        }
    }

    $longueur_contenu = mb_strlen($valeurs['contenu']);
    if ($longueur_contenu < 10 || $longueur_contenu > 2000) {
        $erreurs['contenu'] = 'Le message doit faire entre 10 et 2000 caractères.';
    }

    if (count($erreurs) === 0) {
        $requete = $pdo->prepare(
            'INSERT INTO message (id_specialite, nom, email, telephone, contenu)
             VALUES (:id_specialite, :nom, :email, :telephone, :contenu)'
        );
        $requete->execute([
            'id_specialite' => $id_sujet,
            'nom'           => $valeurs['nom'],
            'email'         => $valeurs['email'],
            'telephone'     => $valeurs['telephone'] !== '' ? $valeurs['telephone'] : null,
            'contenu'       => $valeurs['contenu'],
        ]);

        $_SESSION['contact_nom'] = $valeurs['nom'];

        rediriger('contact_merci.php');
    }
}

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-3">
                <p class="planche-numero">Contact</p>
                <p class="planche-legende">Réponse par courriel</p>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <h1 class="page-titre">Poser une question</h1>
                <p class="texte-chapeau">
                    Une question sur le métier, une spécialité ou les études ?
                    Écrivez-nous, nous répondons à l'adresse indiquée.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="planche planche-serree" aria-label="Formulaire de contact">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-6 offset-lg-4">

                <?php if (isset($erreurs['general'])) : ?>
                    <p class="message-erreur" role="alert"><?= htmlspecialchars($erreurs['general']) ?></p>
                <?php elseif (count($erreurs) > 0) : ?>
                    <p class="message-erreur" role="alert">Le message n'est pas parti : corrigez les champs signalés.</p>
                <?php endif; ?>

                <form class="formulaire" method="post" action="contact.php" novalidate>
                    <?= champ_csrf() ?>

                    <div class="formulaire-champ">
                        <label class="form-label" for="nom">Nom</label>
                        <input class="form-control<?= isset($erreurs['nom']) ? ' is-invalid' : '' ?>"
                               type="text" id="nom" name="nom" maxlength="100" required autocomplete="name"
                               value="<?= htmlspecialchars($valeurs['nom']) ?>">
                        <?php if (isset($erreurs['nom'])) : ?>
                            <p class="invalid-feedback"><?= htmlspecialchars($erreurs['nom']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-7 formulaire-champ">
                            <label class="form-label" for="email">Adresse électronique</label>
                            <input class="form-control<?= isset($erreurs['email']) ? ' is-invalid' : '' ?>"
                                   type="email" id="email" name="email" maxlength="150" required autocomplete="email"
                                   value="<?= htmlspecialchars($valeurs['email']) ?>">
                            <?php if (isset($erreurs['email'])) : ?>
                                <p class="invalid-feedback"><?= htmlspecialchars($erreurs['email']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-5 formulaire-champ">
                            <label class="form-label" for="telephone">Téléphone (facultatif)</label>
                            <input class="form-control<?= isset($erreurs['telephone']) ? ' is-invalid' : '' ?>"
                                   type="tel" id="telephone" name="telephone" maxlength="20" autocomplete="tel"
                                   value="<?= htmlspecialchars($valeurs['telephone']) ?>">
                            <?php if (isset($erreurs['telephone'])) : ?>
                                <p class="invalid-feedback"><?= htmlspecialchars($erreurs['telephone']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="sujet">Sujet</label>
                        <select class="form-select<?= isset($erreurs['sujet']) ? ' is-invalid' : '' ?>" id="sujet" name="sujet">
                            <option value="">Question générale</option>
                            <?php foreach ($sujets as $sujet) : ?>
                                <option value="<?= (int) $sujet['id_specialite'] ?>"
                                    <?= $valeurs['sujet'] === (string) $sujet['id_specialite'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($sujet['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($erreurs['sujet'])) : ?>
                            <p class="invalid-feedback"><?= htmlspecialchars($erreurs['sujet']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="formulaire-champ">
                        <label class="form-label" for="champ-contenu">Message</label>
                        <textarea class="form-control<?= isset($erreurs['contenu']) ? ' is-invalid' : '' ?>"
                                  id="champ-contenu" name="contenu" rows="6" minlength="10" maxlength="2000" required><?= htmlspecialchars($valeurs['contenu']) ?></textarea>
                        <?php if (isset($erreurs['contenu'])) : ?>
                            <p class="invalid-feedback"><?= htmlspecialchars($erreurs['contenu']) ?></p>
                        <?php endif; ?>
                    </div>

                    <button class="btn btn-plein" type="submit">Envoyer le message</button>
                </form>

            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
