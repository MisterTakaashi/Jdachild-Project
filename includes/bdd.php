<?php
class BDD
{
    private $_host = "localhost";
    private $_user = "oegas";
    private $_password = "";
    private $_dbname = "oegas";

    public function open(){
        try {
            $dns = "mysql:host={$this->_host};dbname={$this->_dbname}";
            $utilisateur = $this->_user;
            $motDePasse = $this->_password;
            $connection = new PDO( $dns, $utilisateur, $motDePasse );

            return $connection;
        } catch ( Exception $e ) {
            echo "Connection à MySQL impossible : ", $e->getMessage();
            die();
        }
    }
}
?>
