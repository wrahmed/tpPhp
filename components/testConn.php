<?php

class ConnexionBDD {

    private $serveur = "localhost";
    private $utilisateur = "root";
    private $motDePasse = "";
    private $nomDeLaBase = "gestprod";
    private $connexion;

    public function __construct() {
        $this->connexion = $this->seConnecter();
    }

    private function seConnecter() {
        $connexion = mysqli_connect($this->serveur, $this->utilisateur, $this->motDePasse, $this->nomDeLaBase);

        if (!$connexion) {
            $_SESSION['erreur'] = "Échec de la connexion à la base de données : " . mysqli_connect_error();
            return null;
        }

        return $connexion;
    }

    public function getConnexion() {
        return $this->connexion;
    }

    public function fermerConnexion() {
        if ($this->connexion) {
            mysqli_close($this->connexion);
        }
    }
}
?>
