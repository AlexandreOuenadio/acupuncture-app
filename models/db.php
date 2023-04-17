<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=nom_de_la_bdd';
$user = 'nom_utilisateur';
$password = 'mot_de_passe';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo '<p>Connexion échouée : ' . $e->getMessage() . '</p>';
}


if (isset($dbh)) {
    // Récupération du paramètre GET "symptome"
    $symptome = isset($_GET['symptome']) ? $_GET['symptome'] : '';

    // Requête pour récupérer les pathologies correspondant au symptôme
    if (!empty($symptome)) {
        $sql = 'SELECT * FROM patologie WHERE symptome = :symptome';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':symptome', $symptome);
        $stmt->execute();
        $pathologies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } else {
        // Requête pour récupérer toutes les pathologies
        $sql = 'SELECT * FROM patologie';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $pathologies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



function afficher_pathologies($pathologies) {
    if (!empty($pathologies)) {
        echo '<div class="liste-pathologies">';
        foreach ($pathologies as $pathologie) {
            echo '<div class="pathologie-item">' . $pathologie['nom'] . '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Aucune pathologie trouvée.</p>';
    }
}