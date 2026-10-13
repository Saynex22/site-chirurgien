<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function est_connecte(): bool
{
    return isset($_SESSION['id_utilisateur']);
}

function rediriger(string $adresse): void
{
    header('Location: ' . $adresse);
    exit;
}

function exiger_connexion(): void
{
    if (!est_connecte()) {
        definir_message('Connectez-vous pour accéder à votre espace.');
        rediriger('connexion.php');
    }
}

function texte_post(string $cle): string
{
    $valeur = $_POST[$cle] ?? '';
    return is_string($valeur) ? trim($valeur) : '';
}

function definir_message(string $texte): void
{
    $_SESSION['message'] = $texte;
}

function lire_message(): ?string
{
    $texte = $_SESSION['message'] ?? null;
    unset($_SESSION['message']);
    return $texte;
}

// Jeton anti-CSRF
function jeton_csrf(): string
{
    if (empty($_SESSION['jeton_csrf'])) {
        $_SESSION['jeton_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['jeton_csrf'];
}

function jeton_csrf_valide(): bool
{
    $jeton_recu = $_POST['jeton_csrf'] ?? '';
    return is_string($jeton_recu)
        && isset($_SESSION['jeton_csrf'])
        && hash_equals($_SESSION['jeton_csrf'], $jeton_recu);
}

function champ_csrf(): string
{
    return '<input type="hidden" name="jeton_csrf" value="' . htmlspecialchars(jeton_csrf()) . '">';
}
