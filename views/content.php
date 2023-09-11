<?php
$page = $_GET['page'];

switch ($page) {
    case 'dashboard':
        echo "<h1 class='text-center primary-text'>Nadzorna plošča</h1>";
        echo "<p class='text-center second-text'>Tukaj lahko upravljate vse svoje podatke in imate pregled nad svojim poslovanjem</p>";
        break;

    case 'users':
        echo "<h1 class='text-center primary-text'>Upravljanje uporabnikov</h1>";
        // Your users management content logic
        break;

    case 'subjects':
        echo "<h1 class='text-center primary-text'>Upravljanje predmetov</h1>";
        // Your subjects management content logic
        break;

    case 'upload':
        echo "<h1 class='text-center primary-text'>Nalaganje gradiv</h1>";
        // Your upload content logic
        break;

    case 'tasks':
        echo "<h1 class='text-center primary-text'>Pregled nalog</h1>";
        // Your tasks content logic
        break;

    case 'logout':
        echo "<h1 class='text-center primary-text'>Odjava</h1>";
        // Your logout content logic
        break;

    case 'profile':
        echo "<h1 class='text-center primary-text'>Profil</h1>";
        // Your profile content logic
        break;

    case 'settings':
        echo "<h1 class='text-center primary-text'>Nastavitve</h1>";
        // Your settings content logic
        break;

    default:
        echo "<h1 class='text-center primary-text'>Dobrodošli na nadzorni plošči</h1>";
        echo "<p class='text-center second-text'>Tukaj lahko upravljate vse svoje podatke in imate pregled nad svojim poslovanjem</p>";
        break;
}
?>
