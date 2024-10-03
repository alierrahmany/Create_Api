<?php 

require 'Database.php';

$db = new Database();

$pdo = $db->getConnexion();
if($pdo == null){
    echo 'error de connexion';
}else{
    echo ' connected successfully';
}