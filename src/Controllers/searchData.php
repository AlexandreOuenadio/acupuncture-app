<?php


use App\Models\Database;


function doResearch() : array{
    // Fetch filters content and keyword
    $meridien_filter = $_POST['meridien'] ?? "";
    $type_filter = $_POST['categorie'] ?? "";
    $caracteristics_filter = $_POST['caracteristiques'] ?? "";
    $keyword = $_POST['search-bar'] ?? "";


    // Connect to model and fetch data
    $dsn = 'pgsql:host=localhost;port=5432;dbname=acudb';
    $user_db = 'postgres';
    $password_db = '1234';
    $db = new Database($dsn, $user_db, $password_db);

   
    //var_dump($meridien_filter, $type_filter, $caracteristics_filter, $keyword);

    return $db->get_data($meridien_filter, $type_filter, $caracteristics_filter, $keyword);
}


function saveDataToSession(array $data) : void{
    checkSessionStart();
    $_SESSION['data'] = $data;


}

function getDataFromSession() : array{
    checkSessionStart();
    if(isset($_SESSION['data'])) {
        return $_SESSION['data'];
    }
    
    return [];


}

