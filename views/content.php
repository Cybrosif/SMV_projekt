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

    case 'Neki':
        echo "<h1 class='h2'>Neki</h1>";
        echo "Bedak";
        break;

    case 'Neki2':
        echo "<h1 class='h2'>Neki2</h1>";
        // Your products content logic
        break;

    case 'Neki3':
        echo "<h1 class='h2'>Neki3</h1>";
        // Your customers content logic
        break;

    default:
        echo "<h1 class='h2'>Welcome</h1>";
        echo "<p>Welcome to the modern dashboard!</p>";
        break;
}
?>
