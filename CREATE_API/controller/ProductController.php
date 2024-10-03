<?php 

class ProductController{
    //atribut ou proprietes
    private $produit;

    //constructeur
    public function __construct(){
        $database = new Database();
        $db = $database->getConnexion();
    
        // On instancie les produits
        $this->produit = new Produit($db);
    }
    //Methodes = action:

    //Permet de recuperer la liste des produits
    public function index(){

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

        
            // On récupère les données
            $stmt = $this->produit->Lire();
        
            // On vérifie si on a au moins 1 produit
            if($stmt->rowCount() > 0){

                echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            }
            else
            {
                http_response_code(200);
                echo json_encode(["message" => "La table est vide"]); 
            }
        
        }else{
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(["message" => "La méthode n'est pas autorisée"]);
        }
    }
    public function Add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
            // On instancie la base de données
            $database = new Database();
            $db = $database->getConnexion();
        
            // On instancie les produits
            $produit = new Produit($db);
        
            // On récupère les informations envoyées
            $donnees = json_decode(file_get_contents("php://input"));
            
            //echo $donnees;
            // validation des données
            if(!empty($donnees->nom) && !empty($donnees->description) && !empty($donnees->prix) && !empty($donnees->categories_id)){
                // Ici on a reçu les données
                // On hydrate notre objet
                $produit->nom = $donnees->nom;
                $produit->description = $donnees->description;
                $produit->prix = $donnees->prix;
                $produit->categories_id = $donnees->categories_id;
        
                if($produit->creer()){
                    // Ici la création a fonctionné
                    // On envoie un code 201
                    http_response_code(200);
                    echo json_encode(["message" => "L'ajout a été effectué","infoProduit"=>$produit]);
                }else{
                    // Ici la création n'a pas fonctionné
                    // On envoie un code 503
                    http_response_code(503);
                    echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
                }
            }
        }else{
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(["message" => "La méthode n'est pas autorisée"]);
        }
    }
    public function Update(){
        if($_SERVER['REQUEST_METHOD'] == 'PUT'){

        
            // On instancie la base de données
            $database = new Database();
            $db = $database->getConnexion();
        
            // On instancie les produits
            $produit = new Produit($db);
        
            // On récupère les informations envoyées
            $donnees = json_decode(file_get_contents("php://input"));
            
            if(!empty($donnees->id) && !empty($donnees->nom) && !empty($donnees->description) && !empty($donnees->prix) && !empty($donnees->categories_id)){
                // Ici on a reçu les données
                // On hydrate notre objet
                $produit->id = $donnees->id;
                $produit->nom = $donnees->nom;
                $produit->description = $donnees->description;
                $produit->prix = $donnees->prix;
                $produit->categories_id = $donnees->categories_id;
        
                if($produit->modifier()){
                    // Ici la modification a fonctionné
                    // On envoie un code 200
                    http_response_code(200);
                    echo json_encode(["message" => "La modification a été effectuée"]);
                }else{
                    // Ici la création n'a pas fonctionné
                    // On envoie un code 503
                    http_response_code(503);
                    echo json_encode(["message" => "La modification n'a pas été effectuée"]);         
                }
            }
        }else{
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(["message" => "La méthode n'est pas autorisée"]);
        }
    }
    public function Delete(){
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

            
        
            // On instancie la base de données
            $database = new Database();
            $db = $database->getConnexion();
        
            // On instancie les produits
            $produit = new Produit($db);
        
            // On récupère l'id du produit
            $donnees = json_decode(file_get_contents("php://input"));
        
            if(!empty($donnees->id)){
                $produit->id = $donnees->id;
        
                if($produit->supprimer()){
                    // Ici la suppression a fonctionné
                    // On envoie un code 200
                    http_response_code(200);
                    echo json_encode(["message" => "La suppression a été effectuée"]);
                }else{
                    // Ici la création n'a pas fonctionné
                    // On envoie un code 503
                    http_response_code(503);
                    echo json_encode(["message" => "La suppression n'a pas été effectuée"]);         
                }
            }
        }else{
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(["message" => "La méthode n'est pas autorisée"]);
        }
    }
}