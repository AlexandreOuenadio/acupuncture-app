<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer un compte</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/compte.css">
        <link rel="stylesheet" href="assets/css/header_footer.css">
    </head>
    <body>
        <?php require('templates/header.php'); ?>

        <div class="creation-compte">
<h1>Création de mon compte</h1>
<p>Envie d'en apprendre plus sur l'acupuncture et de profiter des services de l'association ? N'hésitez pas à créer un compte ! </p>
<p>C'est GRATUIT !</p>
<form action="/page-traitement-donnees" method="post">
<div>
<label for="nom">Votre identifiant</label>
<input type="text" id="nom" name="nom" placeholder="ZaphiriosTheBigG" required>
</div>
<div>
<label for="email">Votre e-mail</label>
<input type="email" id="email" name="email" placeholder="monadresse@mail.com" required>
</div>
<div>
<label for="password">Entrez un mot de passe</label>
<input type="password" id="password" name="password" placeholder="Entrez votre mot de passe ici" required>
</div>
<div class="password-icon">
                    <ion-icon name="eye-outline" class="eye"></ion-icon>
                    <ion-icon name="eye-off-outline" class="eye-off"></ion-icon>
                </div>
<div>
<label for="password">Confirmation mot de passe</label>
<input type="password" id="password" name="password" placeholder="Confirmez votre mot de passe ici" required>
</div>
<div class="password-icon">
                    <ion-icon name="eye-outline" class="eye"></ion-icon>
                    <ion-icon name="eye-off-outline" class="eye-off"></ion-icon>
                </div>

<input type="submit" id="submit" value="Créer mon compte">
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1)
                    echo "<p style='color:red'>Utilisateur déjà existant</p>";
                    elseif($err==2)
                    echo "<p style='color:red'>Mail déjà associé à un compte</p>";
                    elseif($err==3)
                    echo "<p style='color:red'>Mot de passe ne respectant pas les règles</p>";
                    elseif($err==4)
                    echo "<p style='color:red'>Mots de passe différents</p>";
                    }
                    ?>
</form>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="assets/js/login.js"></script>
</div>