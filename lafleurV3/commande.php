<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head> <link rel="stylesheet" type="text/css"  href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center><h2>Recapitulatif des articles commandé</h2></center>
<?php
//var_dump($_SESSION['cart']['items']);

echo "<center><table width=80% border='1'>";
echo "<tr>
        <th width=20%>Ref</th>
        <th width=20%>Désignation</th>
        <th width=20%>Px unit</th>
        <th width=20%>Qté</th>
        <th>Montant</th>
        </tr>";

$user = "LaFleur";
$pass = "unv7erd3zyb!AWK0nec";
try {
    $dbh = new PDO("mysql:host=localhost;dbname=baselafleur2", $user, $pass);
} catch (PDOException $e) { //en cas d'erreur (mauvais mdp, user, requêtes...) affiche le message erreurs c'est une exception
    print "error!:" . $e->getMessage() . "<br/>";
    die();
}
$cartItems = $_SESSION["cart"]["items"];
$refs      = array_keys($cartItems);

$requete = 'select * 
            FROM produit 
            WHERE pdt_ref 
            IN ("' . implode('", "', $refs) . '") ;';
              //var_dump($requete);
$result = $dbh->query($requete);
$cartTotal = 0;
foreach ($result as $row) {
    $refProduct   = $row['pdt_ref'];
    $cartQty      = $_SESSION['cart']['items'][$refProduct];
    $productPrice = $row['pdt_prix'];
    $productTotal = $cartQty * $productPrice;
    echo "<tr>";
    echo "<td width=20%>" . $refProduct . "</td>";
    echo "<td width=20%>" . $row['pdt_designation'] . "</td>";
    echo "<td width=20%>" . $productPrice . "</td>";
    echo "<td width=20%>" . $cartQty . "</td>";
    echo "<td width=20%>" . $productTotal . "</td>";
    echo "</tr>";

    $cartTotal += $productTotal;
}
unset($connexion);

echo "<tr><td colspan = 4>Total</td><td>" . $cartTotal . "</td></tr>";
echo "</table></center>";
?>
<form name="formulaire" action="envoyer.php" method="get">
    <p>
    <div>
        <input type="text" name="login">
        <input type="password" name="mdp">
    </div>
    </p>

    <p>
    <div>
        <input class='buton' type="submit" name="envoyer" value="Envoyer la commande">
    </div>
    </p>
</form>

</body>
</html>
