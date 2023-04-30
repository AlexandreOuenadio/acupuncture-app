<?php

namespace App\Models;
use \PDO;
use \PDOException;

class Database {

    // ATTRIBUTS
    
    private $dbh;
    private $meridiens = [];
    private $types = [];
    private $caracteristics = [];
    private $type_to_name = array(
        "m" => "Pathologie de méridien",
        "tf" => "Pathologie d'organe/viscère (tsang/fu)",
        "j" => "Pathologie tendino-musculaire(jing jin)",
        "l" => "Pathologie des branches (voies luo)",
        "mv" => "Pathologie des merveilleux vaisseaux",
        "i" => "Interne",
        "e" => "Externe",
        "p" => "Plein",
        "v" => "Vide",
        "c" => "Chaud",
        "f" => "Froid",
        "i" => "Inférieur",
        "s" => "Supérieur",
        "-" => "Yin",
        "+" => "Yang"
    ); 

    
    
    private $type_to_caracteristics = array(
        "m" => ["e","i"],
        "tf" => ["c","f","p","i", "s","v","-","+"],
        "j" => [],
        "l" => ["p","v"],
        "mv" => ["i","p"]
    );
    
    private $combinations = array(
        'm', 'tf', 'j', 'l', 'mv', 'lp', 'lv', 'me', 'mi', 'mv', 'mvi',
        'mvp', 'tfc', 'tff', 'tfp', 'tfpc', 'tfpci', 'ftpcm', 'tfpcs', 'tfv',
        'tfv-', 'tfv+', 'tfvf', 'tfvfi', 'tfvfm', 'tfvfs'
    );

    private $type_list = array(
        "Pathologie de méridien",
        "Pathologie d'organe/viscère (tsang/fu)",
        "Pathologie tendino-musculaire(jing jin)",
        "Pathologie des branches (voies luo)",
        "Pathologie des merveilleux vaisseaux"
    );
    public $name_to_type = array();


    
    // CONSTRUCTEUR

    public function __construct($dsn, $user, $password) {
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo '<p>Connexion échouée : ' . $e->getMessage() . '</p>';
        }
    }



    // ASSOCIATIVE FUNCTIONS

    private function createNameToTypeArray() {
        $this->name_to_type = array_flip($this->type_to_name);
        return $this->name_to_type;
    }
    
    public function getTypeCode($name) {
        if ($name !== "") {
            if (empty($this->name_to_type)) {
                $this->name_to_type = $this->createNameToTypeArray();
            }
            return $this->name_to_type[$name];
        }
    }
    

    public function getCarForType($type) {
        return $this->type_to_caracteristics[$type];
    }

    public function getNameCode($names) {
        $types = [];
        foreach ($names as $name) {
            $types[] = $this->type_to_name[$name];
        }
        return $types;
    }



    //FUNCTIONS TO GENERATE THE LISTS TO DISPLAY IN FILTER MENUS

    #Function that returns the caracteristic names of a given type name
    private function get_caracteristics_list($type_name){
        return($this->getNameCode($this->getCarForType($this->getTypeCode($type_name))));   
    }

    #Function that returns all the meridiens
    private function get_meridiens_list() {
        if (!isset($this->dbh)) {
            return array();
        }

        $sql = 'SELECT meridien.nom FROM meridien';
    
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #Function that returns all the types
    private function get_type_list() {
        return $this->type_list;
    }



    // FUNCTION TO COMBINE CARACTERISTICS AND TYPE FOR THE DATABASE FETCH

    #Function that combines the type and caracteristics
    private function combine_cara_type($type_name, $caracteristiques_names){

        if (!empty($type_name) && !empty($caracteristiques_names)) {
            $result = array();

            //Convert names to types
            $type = $this->getTypeCode($type_name);
            $caracteristiques = [];
            foreach($caracteristiques_names as $caracteristique_name){
                $caracteristiques[] = $this->getTypeCode($caracteristique_name);
            }


            $caracteristics_count = count($caracteristiques);

            foreach ($this->combinations as $combination) {
                if (strpos($combination, $type) === 0) {
                    //var_dump($combination);
                    $combination_chars = str_replace($type, '', $combination); // remove type characters

                    foreach ($caracteristiques as $caracteristique) {
                        //var_dump($combination_chars, $caracteristique);
                        if (strpos($combination_chars, $caracteristique) !== false) {
                            $result[] = $combination;
                        }
                    }
                }
            }
            return $result;
        }
        return "";
    }
    


    // FUNCTIONS TO MANAGE IDENTIFICATION DATA

    #Function that adds the user data (username, password) into the database
    public function add_user($username, $password) {
        try {

            $sql = 'INSERT INTO identification ("user", password) VALUES (?, ?)';

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $password);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    # Function that checks if the password of a given user is the right one
    public function check_password($username, $password) {
        try {
            $sql = 'SELECT COUNT(*) FROM identification WHERE "user" = ? AND password = ?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $password);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            if ($result > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    # Function that checks if a given username exists in the database
    public function user_exists($username) {
        try {
            $sql = 'SELECT COUNT(*) FROM identification WHERE "user" = ?';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            if ($result > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }



    // FUNCTION TO FETCH DATA ACCORDING TO FILTERS 

    private function getPathologies($symptomes, $type, $caracteristiques, $meridiens) {
        if (!isset($this->dbh)) {
            return array();
        }

        #Combines test and caracteristics into one for request norms
        $types = $this->combine_cara_type($type, $caracteristiques);

        #Pour tests: initialisation des listes des 3 filtres (selected by user)
        #$type = ["méridien", "organes/viscère", "luo", "merveilleux vaisseaux", "jing jin"];
        #$caracteristiques = ["plein", "chaud", "vide", "froid", "interne", "externe"];
        #$meridiens = ["Gros Intestin", "Estomac", "Vessie"];

        $sql = 'SELECT patho.desc 
        FROM keywords
            INNER JOIN keysympt
                ON keysympt.idK = keywords.idK
            INNER JOIN symptome
                ON symptome.idS = keySympt.idS
            INNER JOIN symptpatho
                ON symptpatho.idS = symptome.idS
            INNER JOIN patho
                ON patho.idP = symptpatho.idP
            INNER JOIN meridien
                ON meridien.code = patho.mer
             WHERE true ';
    
        #Ajouts requete filtrages types/caractéristiques/meridiens
        foreach ($symptomes as $symptome) {
            if ($symptome != ""){
                $sql.= " AND keywords.name LIKE ?";
            }
        }
        if ($types != ""){
            foreach ($types as $type) {
                $sql.= " AND patho.type LIKE ?";
            }
        }
        if ($meridiens != ""){
            foreach ($meridiens as $meridien) {
                $sql.= " AND meridien.nom LIKE ?";
            }
        }

        #Reconstitution requete avec valeurs des listes (attribution)
        $sql.= 'GROUP BY patho.desc';
        $stmt = $this->dbh->prepare($sql);
        $i=1;
        foreach ($symptomes as $symptome) {
            if ($symptome != ""){
                $p = "%".$symptome."%";
                $stmt->bindParam($i, $p);
                $i++;
            }

        }
        if ($types != ""){
            foreach ($types as $type) {
                $p = "%".$type."%";
                $stmt->bindParam($i, $p);
                $i++;
            }
        }
        if ($meridiens != ""){
            foreach ($meridiens as $meridien) {
                $p = "%".$meridien."%";
                $stmt->bindParam($i, $p);
                $i++;
            }
        } 

        //var_dump($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // FUNCTION THAT MANAGES ALL THE EXCHANGE OF DATA WITH THE CONTROLLER
    public function get_data($meridien_filter, $type_filter, $caracteristics_filter, $keyword) {

        

        // Get filter lists
        if(empty($meridiens)) {
            $meridiens = $this->get_meridiens_list();
        }
        if(empty($types)) {
            $types = $this->get_type_list();
        }
        if(!empty($type_filter)) {
            $caracteristics = $this->get_caracteristics_list($type_filter);
        }
        else{
            $caracteristics = '';
        }

        // Get pathologies based on filters and keyword
        $pathologies = $this->getPathologies(explode(" ",$keyword), $type_filter, $caracteristics_filter, $meridien_filter);
      
        // return data as an array
        return [
          'meridiens' => $meridiens,
          'types' => $types,
          'characteristics' => $caracteristics,
          'pathologies' => $pathologies,
        ];
      }
      
}

