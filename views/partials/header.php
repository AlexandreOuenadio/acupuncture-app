<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $page_title ?></title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/header_footer.css">
        <link rel="stylesheet" href="assets/css/<?= $css_file ?>.css">
        
    </head>
<body>
    <header class="header">
        <nav class="nav">
            <input type="checkbox" id="hidden-check">
            <a href="/"><img src="assets/images/logo.png" alt="Logo de l'association" class="nav-logo"></a>
            <ul class="nav-list">
                <a href="/pathologie"><li class="nav-item">Pathologie</li></a>
                <!-- <a href="<?php echo $link; ?>"><li class="nav-item">Pathologie</li></a> -->
                <a href="#"><li class="nav-item">Informations</li></a>
                <a href="/login"><li class="nav-item login">Se connecter</li></a>
                <!-- <a href="login.php?deconnexion=<?php echo $deconnexion; ?>"><li class="nav-item login"><?php echo $user; ?></li></a> -->
            </ul>
            <label for="hidden-check">
                <div class="hamburger">
                    <div class="hamburger-item"></div>
                    <div class="hamburger-item"></div>
                    <div class="hamburger-item"></div>
                </div>
            </label>
        </nav>
    </header>