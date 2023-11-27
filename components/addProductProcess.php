<?php
include('testConn.php');
$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = 'img/' . $_FILES["image"]["name"] ; 
    $libelle = mysqli_real_escape_string($connexion, $_POST['libelle']);
    $reference = mysqli_real_escape_string($connexion, $_POST['reference']);
    $dateAchat = mysqli_real_escape_string($connexion, $_POST['dateAchat']);
    $prixUnitaire = mysqli_real_escape_string($connexion, $_POST['prixUnitaire']);
    $idCategorie = mysqli_real_escape_string($connexion, $_POST['idCategorie']);
    $photoProduit = mysqli_real_escape_string($connexion, $image);
    // Validation (you might need more thorough validation based on your requirements)
        // Prepared Statement
        $sql = "INSERT INTO produit (libelle, reference, dateAchat, prixUnitaire, idCategorie, photoProduit) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', $libelle, $reference, $dateAchat, $prixUnitaire, $idCategorie, $photoProduit);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Produit ajouté avec succès.";
            echo "<script>alert('$message');</script>";
        } else {
            error_log("Erreur lors de l'ajout du produit : " . mysqli_error($connexion));
            $message = "Une erreur est survenue lors de l'ajout du produit. Veuillez réessayer plus tard.";
        }
        mysqli_stmt_close($stmt);
    
} else {
    $message = "Le formulaire n'a pas été soumis correctement.";
}
//Display Categories
$sql = "SELECT idCategorie, denomination FROM categorie";
$result = mysqli_query($connexion, $sql);

// Check if there are categories
if ($result && mysqli_num_rows($result) > 0) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $categories = array(); // Empty array if no categories are found
}

// Fermez la connexion après utilisation
$connexionBDD->fermerConnexion();

?>