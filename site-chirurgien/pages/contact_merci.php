<?php
$racine           = '../';
$titre_page       = 'Message envoyé | Chirurgien';
$description_page = 'Confirmation d\'envoi du formulaire de contact.';
$page_active      = 'contact';

require_once '../includes/fonctions.php';

// Accès direct : retour au formulaire
if (!isset($_SESSION['contact_nom'])) {
    rediriger('contact.php');
}

$nom = $_SESSION['contact_nom'];
unset($_SESSION['contact_nom']);

include '../includes/header.php';
?>

<section class="page-entete">
    <div class="conteneur-site">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h1 class="page-titre">Message envoyé</h1>
                <p class="texte-chapeau">
                    Merci, <?= htmlspecialchars($nom) ?>. Votre message est enregistré,
                    nous répondons à l'adresse que vous avez indiquée.
                </p>
                <p class="fiche-actions">
                    <a class="btn btn-plein" href="specialites.php">Voir les spécialités</a>
                    <a class="lien-texte" href="../index.php">Retour à l'accueil</a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
