<?php
?>
</main>

<footer class="pied-site">
    <div class="conteneur-site">
        <div class="row gy-5">

            <div class="col-lg-5">
                <p class="pied-titre">Chirurgien</p>
                <p class="pied-texte">
                    Un site pour comprendre le métier, ses spécialités
                    et la formation qui y mène.
                </p>
            </div>

            <div class="col-6 col-lg-2">
                <h2 class="pied-rubrique">Le site</h2>
                <ul class="pied-liste">
                    <li><a href="<?= $racine ?>index.php">Accueil</a></li>
                    <li><a href="<?= $racine ?>pages/metier.php">Le métier</a></li>
                    <li><a href="<?= $racine ?>pages/specialites.php">Spécialités</a></li>
                    <li><a href="<?= $racine ?>pages/parcours.php">Parcours</a></li>
                    <li><a href="<?= $racine ?>pages/contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-2">
                <h2 class="pied-rubrique">Compte</h2>
                <ul class="pied-liste">
                    <?php if ($est_connecte) : ?>
                        <li><a href="<?= $racine ?>pages/espace.php">Mon espace</a></li>
                        <li><a href="<?= $racine ?>pages/deconnexion.php">Déconnexion</a></li>
                    <?php else : ?>
                        <li><a href="<?= $racine ?>pages/connexion.php">Connexion</a></li>
                        <li><a href="<?= $racine ?>pages/inscription.php">Inscription</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-3">
                <h2 class="pied-rubrique">Sources</h2>
                <p class="pied-texte">
                    Textes rédigés pour ce projet. Photographies libres de droits,
                    auteurs cités sur la page
                    <a href="<?= $racine ?>pages/credits.php">Crédits et mentions</a>.
                </p>
            </div>

        </div>

        <p class="pied-bas">Projet BTS SIO, <?= date('Y') ?></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // En-tête clair une fois le hero dépassé
    (function () {
        const entete = document.getElementById('entete-site');
        const hero = document.querySelector('.hero');
        if (!entete || !hero) {
            return;
        }

        function mettre_a_jour_entete() {
            const seuil = hero.offsetHeight - entete.offsetHeight;
            entete.classList.toggle('entete-claire', window.scrollY > seuil);
        }

        mettre_a_jour_entete();
        window.addEventListener('scroll', mettre_a_jour_entete, { passive: true });
        window.addEventListener('resize', mettre_a_jour_entete);
    })();
</script>
</body>
</html>
