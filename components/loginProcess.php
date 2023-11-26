<?php
session_start();
include('testConn.php');
$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($connexion, $_POST['username']);
    $password = mysqli_real_escape_string($connexion, $_POST['password']);
    $query_log = "SELECT * FROM compte WHERE loginpr='$username' AND mdppr='$password'";
    $result = mysqli_query($connexion, $query_log);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['nom'] = $row['nom']; 
            $_SESSION['prenom'] = $row['prenom']; 
            header('Location: ../acceuil.php'); 
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password";
            header('Location: ../LoginPage.php'); 
            exit();
        }
} else {
    echo "Erreur FORM NOT POST";
    exit();
}

?>
