<?php 
class Database{
    //CONNEXION A LA BASE DE DONNEES
    private $host = 'localhost';//serveur de donnees
    private $db_name = 'api_rest';//nom de la base de donnees

    private $username = 'root';//username

    private $password = '';//password

    private $connexion;//proprite qui permet de stocker l'instance

    public function getConnexion(){

        $this->connexion = null;

        try{

            $this->connexion =new PDO("mysql:host=" .$this->host.";dbname=".$this->db_name,$this->username,$this->password);

        }catch(PDOException $exception){

            echo ' Error de connexion:' .$exception->getMessage();
        }

        return $this->connexion;
    }

}