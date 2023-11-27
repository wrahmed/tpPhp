<?php
include('components/nav.html');
include('components/modifyProductProcess.php')
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
    <h1 id="title">Modifier Produit</h1>
    <fieldset>
        <legend>Produit</legend><br><br>
        <form method="POST" enctype="multipart/form-data">
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
                            <?php
                    foreach ($categories as $category) {
                        echo "<option value='{$category['idCategorie']}'>{$category['denomination']}</option>";
                    }
                    ?>
                </select> <br><br>
                <input type="submit" value="Modifier" id="submit"><br><br>
                </fieldset>
        </form>
    </fieldset>
</body>
</html>
