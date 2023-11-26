<?php
session_start();
include('components/testConn.php');
$connexionBDD = new ConnexionBDD();
$connexion = $connexionBDD->getConnexion();
function hello()
{
    date_default_timezone_set('Africa/Casablanca');
    $heure = date('H');

    if ($heure >= 5 && $heure < 18) {
        return "Bonjour ";
    } else {
        return "Bonsoir ";
    }
}
$sql = 'SELECT * FROM produit';
$rep = mysqli_query($connexion, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="components/css/acceuilStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>IAGI's Stock</title>
</head>
<body>

<?php include('components/nav.html'); ?>

<div id="welcomeDiv">
    <h1 id="welcomeText"><?php echo hello() . strtoupper($_SESSION["nom"]) . " " . strtoupper($_SESSION["prenom"]); ?></h1>
</div>

<h1 id="prodTitle">Produits</h1>
<form method="POST">
    <table class="tftable">
        <tr>
            <th style="text-align:left;">Reference</th>
            <th>Libelle</th>
            <th>Prix Unitaire</th>
            <th>Date Achat</th>
            <th>Photo Produit</th>
            <th>Categorie</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($rep)) { ?>
            <tr>
                <td><?php echo $row['reference']; ?></td>
                <td><?php echo $row['libelle']; ?></td>
                <td><?php echo $row['prixUnitaire']; ?></td>
                <td><?php echo $row['dateAchat']; ?></td>
                <td><img src="<?php echo $row['photoProduit']; ?>" class="prodImg"></td>
                <td><?php echo $row['idCategorie']; ?></td>                
                <td>
                    <a href="components/deleteProduct.php?reference=<?php echo $row['reference']; ?>"><i class="fa-solid fa-pencil fa-lg" style="color: #158e17;"></i></a>
                    <a href="components/deleteProduct.php?reference=<?php echo $row['reference']; ?>" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fa-solid fa-trash fa-lg" style="color: #ab0303;"></i></a>
                </td>
                

            </tr>
        <?php } ?>
    </table>
</form>
<?php
$connexionBDD->fermerConnexion();
?>

</body>
</html>
