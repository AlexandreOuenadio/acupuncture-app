<?php
$user = 'Se connecter';
$deconnexion = 'false';
$link = 'login.php';
if(session_status() !== PHP_SESSION_ACTIVE){
    @session_start();
}
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $user = $_SESSION['username'];
    $deconnexion = 'true';
    $link = 'pathologie.php';
    }


?>
<header class="header">
    <nav class="nav">
        <input type="checkbox" id="hidden-check">
        <a href="index.php"><img src="assets/images/logo.png" alt="Logo de l'association" class="nav-logo"></a>
        <ul class="nav-list">
            <a href="<?php echo $link; ?>"><li class="nav-item">Pathologie</li></a>
            <a href="#"><li class="nav-item">Informations</li></a>
            <a href="login.php?deconnexion=<?php echo $deconnexion; ?>"><li class="nav-item login"><?php echo $user; ?></li></a>
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