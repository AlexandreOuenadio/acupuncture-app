
<?php 
require(join(DIRECTORY_SEPARATOR, [__DIR__,'partials', 'header.php'])); 
require_once(join(DIRECTORY_SEPARATOR, [__DIR__,'..', 'controllers','login-verification.php']));


?>

<main class="main-login-register">
    <div class="container">
        <!-- Zone où se connecter -->
        <div class="login-register-form-container">
            <!-- <img class="login-register-logo" src="../assets/images/logo.png" alt="logo"> -->
            <div class="login-register-choices-container">
                <div class="login-register-choices">
                    <div class="login-register-choice-cursor" id="cursor-choice"></div>
                    <button class="login-register-choice active" id="switch-to-login">Se connecter</button>
                    <button class="login-register-choice" id="switch-to-signup">S'enregistrer</button>
                </div>
            </div>
            <div class="login-register-form-switch-container">
                <form id="login-form" class="login-register-form active" action="../controllers/login-verification.php" method="POST">
                    <div class="login-register-form-item">
                        <label for="login-username">Nom d'utilisateur</label>
                        <input type="text" id="login-username" placeholder="Entrer votre nom d'utilisateur" name="login-username" required>
                    </div>
                    <div class="login-register-form-item">
                        <label for="login-password">Mot de passe</label>
                        <div class="login-register-form-password-item">
                            <input type="password" id="login-password" placeholder="Entrer votre mot de passe" name="login-password" required>
                            <div class="password-icon">
                                <ion-icon name="eye-outline" class="eye"></ion-icon>
                                <ion-icon name="eye-off-outline" class="eye-off"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="login-register-form-sumbit-btn" name="submit-btn">Se connecter</button>
                    
                    <?php 
                    if(isset($_POST['submit-btn']))
                    {
                        if($_POST['login-username'] !== "" && $_POST['login-password'] !== "")
                        {
                            $user_object = new UserLogin($_POST['login-username'],$_POST['login-password']);
                            $user_object->authenticate();
                        }
                        else
                        {
                            header('Location: /login?erreur=2'); // utilisateur ou mot de passe vide
                        }
                    }

                    
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2) { ?>
                            <p style='color:red'>Utilisateur ou mot de passe incorrect</p>
                    <?php }}?>
                </form>
    
                <form id="signup-form" class="login-register-form" action="" method="POST">
                    <div class="login-register-form-item">
                        <label for="signup-username">Nom d'utilisateur</label>
                        <input type="text" id="signup-username" placeholder="Entrer votre nom d'utilisateur" name="signup-username" required>
                    </div>
                    <div class="login-register-form-item">
                        <label for="signup-password">Mot de passe</label>
                        <div class="login-register-form-password-item">
                            <input type="password" id="signup-password" placeholder="Choisissez un mot de passe" name="signup-password" required>
                        </div>
                    </div>
                    <div class="login-register-form-item">
                        <label for="signup-password2">Confirmation du mot de passe</label>
                        <input type="password" id="signup-password2" placeholder="Entrer le mot de passe à nouveau" name="signup-password2" required>
                    </div>
                    <button class="login-register-form-sumbit-btn">S'enregistrer</button>
                    
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
            </div>

        </div>
    </div>
</main>

<?php require(join(DIRECTORY_SEPARATOR, [__DIR__,'partials', 'footer.php'])); ?>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="assets/js/switchLoginSignUp.js"></script>




