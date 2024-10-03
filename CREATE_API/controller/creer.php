<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie la méthode
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Produit.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie les produits
    $produit = new Produit($db);

    // On récupère les informations envoyées
    $donnees = json_decode(file_get_contents("php://input"));

    //echo $donnees;
    // validation des données
    if (!empty($donnees->nom) && !empty($donnees->description) && !empty($donnees->prix) && !empty($donnees->categories_id)) {
        // Ici on a reçu les données
        // On hydrate notre objet
        $produit->nom = $donnees->nom;
        $produit->description = $donnees->description;
        $produit->prix = $donnees->prix;
        $produit->categories_id = $donnees->categories_id;

        if ($produit->creer()) {
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(200);
            echo json_encode(["message" => "L'ajout a été effectué", "infoProduit" => $produit]);
        } else {
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);
        }
    }
} else {
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
