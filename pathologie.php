<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/header_footer.css">
    <link rel="stylesheet" href="assets/css/pathologie.css">
    
</head>
<body>
    <?php require('templates/header.php'); ?> 
    <main>
        <section class="search">
            <div class="container">
                <h2 class="search-title">Rechercher une pathologie</h2>
                <form action="search.php" method="get" class="form-search">
                    <div class="search-criteria-box">
                        <h3 class="search-criteria-title">Critères de recherche</h3>
                        <div class="search-criteria">
                            <div class="criteria">
                                <label for="symptome">Symptôme: </label>
                                <select name="symptome" id="symptome">
                                    <option value="">-- Choix Syptome --</option>
                                </select>
                            </div>
                            <div class="criteria">
                                <label for="pathologie">Méridien: </label>
                                <select name="meridien" id="meridien">
                                    <option value="">-- Choix Méridien --</option>
                                </select>
                            </div>
                            <div class="criteria">
                                <label for="meridien">Méridien: </label>
                                <select name="meridien" id="meridien">
                                    <option value="">-- Choix Méridien --</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="search-bar-box">
                        <input type="text" name="search-bar" id="search-bar" class="search-bar" placeholder="baka" required>
                        <button class="submit-btn"><ion-icon name="search-outline"></ion-icon></button>
                    </div>
                    
                </form>
                <div class="liste-pathologies">
                    <div class="pathologie-item">Result 1</div>
                    <div class="pathologie-item">Result 2</div>
                    <div class="pathologie-item">Result 3</div>
                    <div class="pathologie-item">Result 4</div>
                    <div class="pathologie-item">Result 5</div>
                </div>
            </div>
        </section>
    </main>

    <?php require('templates/footer.php'); ?> 

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>