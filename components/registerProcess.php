<?php
session_start();
include('testConn.php');
$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($connexion, $_POST['username']);
    $password = mysqli_real_escape_string($connexion, $_POST['password']);
    $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $prenom = mysqli_real_escape_string($connexion, $_POST['prenom']);

    $query_log = "INSERT INTO compte(loginpr, mdppr, nom, prenom) VALUES ('$username', '$password', '$nom', '$prenom')";
    $result = mysqli_query($connexion, $query_log);
        
    if ($result === TRUE) {
        $_SESSION['registrationSuccess'] = true;
        header('Location: ../LoginPage.php?registrationSuccess=true');
    } else {
        echo "Error: " . $query_log . "<br>" . mysqli_error($connexion);
    }

} else {
    echo "Erreur FORM NOT POST";
    exit();
}

session_destroy() ; 
?>
