<?php

include('testConn.php');
$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

$del_ref = mysqli_real_escape_string($connexion, $_GET['reference']); // Assuming you are using GET method
$sql = "DELETE FROM produit WHERE reference = '$del_ref'";
mysqli_query($connexion, $sql);

// Redirect to acceuil.php after deletion
header('Location: ../acceuil.php');
exit(); // Ensure that no further code is executed after the redirect

$connexionBDD->fermerConnexion();

?>
