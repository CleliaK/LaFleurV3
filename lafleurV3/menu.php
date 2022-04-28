<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head> <link rel="stylesheet" type="text/css"  href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
<?php 
        if (!isset($_SESSION["reference"]))
        {
                $_SESSION["reference"]=array();
                $_SESSION["quantite"]=array();

        }
?>
    <h2
    >Société LaFleur
    </h2>

    <div>
        <a target="page" href="logo.php"> Accueil</a>
    </div>
    <div>
        <a href="mailto:commercial@lafleur.com">Nous écrire</a>
    </div>

        <hr>

    <p>
        <u>
            Nos Produits
        </u>
    </p>
    
    <table width="100%">
        <tr>
            <td>
                <a target="page" href="listepdt.php?categ=bul"> Bulbes </a>
            </td>
        </tr>
        <tr>
            <td>
                <a target="page" href="listepdt.php?categ=mas">Plantes à Massif</a>
            </td>
        </tr>
        <tr>
            <td>
               <a target="page" href="listepdt.php?categ=ros">Rosiers</a>
            </td>
        </tr>
    </table>
    <p>
            <hr>
    </p>

    <p><div>
        <form action="panier.php" target="page" method="get">
            <input class='buton' type="submit" name="btn" value="Vider le panier"/>
        </form>
    </div></p>
    <p><div>
        <form action="commande.php" target="page" method="get">
            <input class='buton' type="submit" value="Voir le panier" />
        </form>
    </div></p>

</body>
</html>