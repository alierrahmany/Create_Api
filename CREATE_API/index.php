<?php 
//systeme de routage = declaration des chemin vers les ressoutces

if(isset($_GET['action']) && !empty($_GET['action'])){

    //include le module qui contient des actions
    include ('./config/Database.php');
    require ("./controller/ProductController.php");
    include ('./models/Produit.php');


    $prod = new ProductController();

    switch($_GET['action']){
        case 'all': $prod->index();break;
        case 'create': $prod->Add();break;
        case 'update': $prod->Update();break;
        case 'delete': $prod->Delete();break;

    }
}