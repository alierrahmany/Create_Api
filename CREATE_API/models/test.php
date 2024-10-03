<?php 
require ('../config/Database.php');
require 'Produit.php';

$db= new Database();

$pdo = $db->getConnexion();

//afficher la list de produits
$p1 = new Produit($pdo);$p1->Lire();