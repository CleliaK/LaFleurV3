<!DOCTYPE html>
<html lang="fr">
<head> <link rel="stylesheet" type="text/css"  href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
$user = "LaFleur";
$pass = "unv7erd3zyb!AWK0nec";


// Permet la levée des exceptions dans le cas d'une mauvaise connection et à une lecture particulière
try {
    // connection au serveur MySQL (basse de données)
    $dbh = new PDO("mysql:host=localhost;dbname=baselafleur2", $user, $pass);
} catch (PDOException $e) {
    // En cas d'erreur (mauvais mdp, user, requêtes...) affiche le message erreurs c'est une exception
    print "error!:" . $e->getMessage() . "<br/>";
    die();
}

//Requête recupère les fichier de la BDD de la ligne pdt-catégorie.
$requete = "SELECT * 
            FROM produit 
            WHERE pdt_categorie='".$_GET["categ"]."';";
$result = $dbh->query($requete);
//$_GET['categ'] est appelé du HREF dans menu.php
echo '<center><table width="80%" border="1">';
    foreach ($result as $row) { 
                                           
        echo "<tr>";            
        echo "<td width=20%><img src=Images/".$row['pdt_image'].".jpg>"."</td>"; 
        echo "<td width=20%>" . $row['pdt_ref'] . "</td>";
        echo "<td width=20%>" . $row['pdt_designation'] . "</td>";
        echo "<td width=20%>" . $row['pdt_prix'] . "€</td>";
        echo "</tr>";
    }
echo"</table></center>";

$result = $dbh->query($requete);
//Formulaire envoie quantité et pdt dans panier.php
echo '<form action="panier.php" target="menu" method="get">';
    echo '<select name="reference">';
    //echo '<option selected value="">Sélectionnez un produit...</option>';
    foreach ($result as $row) {
        echo "<option class='zonetxt' value='".$row['pdt_ref']."'>".$row['pdt_designation']."</option>";
    }
    echo"</select>";
    echo " Quantité : ";
    echo"<select name='quantite'>";
        for ($i = 1; $i <= 1000; $i++) {
            echo "<option class='zonetxt'>".$i."</option>";
        }
    echo"</select>";
    echo "<p><input class='buton' type='submit' name='btn' value='Ajouter au panier'></p>";
echo '</form>';
//fin formulaire

// Fermeture de la connexion à la BDD
unset($dbh);
?>

</body>
</html>
