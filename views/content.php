<?php
$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'home':
        echo "<h1 class='h2'>Domov</h1>";
        // Your dashboard content logic
        break;

    case 'profil':
        echo "<h1 class='h2'>Profil</h1>";
        // Your profile content logic
        break;

    case 'nastavitve':
        echo "<h1 class='h2'>Nastavitve</h1>";
        // Your settings content logic
        break;

    default:
        echo "<h1 class='h2'>Welcome</h1>";
        echo "<p>Welcome to the modern dashboard!</p>";
        break;
}
?>
