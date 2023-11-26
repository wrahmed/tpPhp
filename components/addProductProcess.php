<?php

include('testConn.php');
$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libelle = mysqli_real_escape_string($connexion, $_POST['libelle']);
    $reference = mysqli_real_escape_string($connexion, $_POST['reference']);
    $dateAchat = mysqli_real_escape_string($connexion, $_POST['dateAchat']);
    $prixUnitaire = mysqli_real_escape_string($connexion, $_POST['prixUnitaire']);
    $idCategorie = mysqli_real_escape_string($connexion, $_POST['idCategorie']);
    $photoProduit = mysqli_real_escape_string($connexion,$_FILES['image']['name']);

    // Validation (you might need more thorough validation based on your requirements)
    if (empty($libelle) || empty($reference) || empty($dateAchat) || empty($prixUnitaire) || empty($idCategorie)) {
        echo "Tous les champs doivent être remplis.";
    } else {
                // Prepared Statement
                $sql = "INSERT INTO produit (libelle, reference, dateAchat, prixUnitaire, idCategorie,photoProduit) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connexion, $sql);
                mysqli_stmt_bind_param($stmt, 'ssssss', $libelle, $reference, $dateAchat, $prixUnitaire, $idCategorie,$photoProduit);

                if (mysqli_stmt_execute($stmt)) {
                    echo '</script>Produit ajouté avec succès.<script>';
                } else {
                    echo "<script>Erreur lors de l'ajout du produit : </script> " . mysqli_error($connexion);
                }
                mysqli_stmt_close($stmt);
            } 
}
        else {
                echo "<script>Le formulaire n'a pas été soumis correctement. </script>";
             }
// Fermez la connexion après utilisation
$connexionBDD->fermerConnexion();

?>
