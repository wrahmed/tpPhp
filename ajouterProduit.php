<?php

include('components/testConn.php');
include('components/nav.html');

$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = 'img/' . $_FILES['image']['name'] ; 
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
    }
} else {
    $message = "Le formulaire n'a pas été soumis correctement.";
}

// Fermez la connexion après utilisation
$connexionBDD->fermerConnexion();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="components/css/addProd.css" rel="stylesheet">
    <title>IAGI's Stock | Ajouter Produit</title>
</head>
<body>
    <h1 id="title">Ajouter Produit</h1>
    <fieldset>
        <legend>Produit</legend><br><br>
        <form method="POST" action="components/addProductProcess.php" enctype="multipart/form-data">
                <label for="text">Libelle:</label>
                <input type="text" name="libelle"><br>
                <label for="text">Reference:</label>
                <input type="text" name="reference"><br>
                <label for="text">Date Achat:</label>
                <input type="date" name="dateAchat"><br>
                <label for="text">Prix Unitaire:</label>
                <input type="number" name="prixUnitaire"><br>
                <label for="file">Photo du produit:</label>
                <input type="file" id="file" name="image"><br> 
                <label for="cat">Choisir une categorie:</label>
                <select id="cat" name="idCategorie">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select> <br><br>
                <input type="submit" value="Ajouter" id="submit"><br><br>
                </fieldset>
        </form>
    </fieldset>
</body>
</html>
