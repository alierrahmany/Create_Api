<?php 

class Categorie{
    private $connexion;
    private $id;
    private $nom;
    private $description;
    private $table = 'categories';
    public function __construct(){

    }

        public function lire(){
            // On écrit la requête
            $sql = "SELECT * FROM $this->table";
    
            // On prépare la requête
            $query = $this->connexion->prepare($sql);
    
            // On exécute la requête
            $query->execute();
            //$res=$query;
            // On retourne le résultat
            return $query;
        }
    }
