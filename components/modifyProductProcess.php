<?php
include('testConn.php');

$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
    // Fetch product details from the database
    $sql = "SELECT * FROM produit WHERE reference = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, 's', $reference);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the product exists
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product reference not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = 'img/' . $_FILES["image"]["name"] ;  
    $libelle = mysqli_real_escape_string($connexion, $_POST['libelle']);
    $reference = mysqli_real_escape_string($connexion, $_POST['reference']);
    $dateAchat = mysqli_real_escape_string($connexion, $_POST['dateAchat']);
    $prixUnitaire = mysqli_real_escape_string($connexion, $_POST['prixUnitaire']);
    $idCategorie = mysqli_real_escape_string($connexion, $_POST['idCategorie']);
    $photoProduit = mysqli_real_escape_string($connexion, $image);

    // Validation (you might need more thorough validation based on your requirements)
    if (empty($libelle) || empty($reference) || empty($dateAchat) || empty($prixUnitaire) || empty($idCategorie)) {
        $message = "Tous les champs doivent être remplis.";
    } else {
        // Prepared Statement
        $sql = "UPDATE produit SET libelle=?, reference=?, dateAchat=?, prixUnitaire=?, idCategorie=?, photoProduit=? WHERE reference=?";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssiss', $libelle, $reference, $dateAchat, $prixUnitaire, $idCategorie, $photoProduit, $reference);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Produit modifié avec succès.";
            echo "<script>alert('$message');</script>";
        } else {
            error_log("Erreur lors de la modification du produit : " . mysqli_error($connexion));
            $message = "Une erreur est survenue lors de la modification du produit. Veuillez réessayer plus tard.";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    $message = "Le formulaire n'a pas été soumis correctement.";
}

// Display categories from the db
$sql = "SELECT idCategorie, denomination FROM categorie";
$result = mysqli_query($connexion, $sql);

// Check if there are categories
if ($result && mysqli_num_rows($result) > 0) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $categories = array(); // Empty array if no categories are found
}

$connexionBDD->fermerConnexion();

?>