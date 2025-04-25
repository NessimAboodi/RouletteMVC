<?php
session_start();
require_once 'model/BDD_Manager.php';

$page = $_GET['page'] ?? 'connexion';

switch ($page) {
    case 'connexion':
        include 'Design/connexion.php';
        break;

    case 'inscription':
        include 'Design/inscription.php';
        break;

    case 'roulette':
        include 'Design/roulette.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?page=connexion");
        break;

    default:
        echo "<h2>Page introuvable</h2>";
        break;
}
?>