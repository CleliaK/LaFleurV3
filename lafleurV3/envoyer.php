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
<?php

$timestamp = time();
$date      = date('Y-m-d');
$i         = count($_SESSION['reference']);
$user      = "LaFleur";
$pass      = "unv7erd3zyb!AWK0nec";

if (empty($_GET['login']) || empty($_GET['mdp'])) {
    echo "Veuillez saisir votre numéro client et votre mot de passe";
    exit();
}

try {
    $dbh = new PDO("mysql:host=localhost;dbname=baselafleur2", $user, $pass);
} 
catch (PDOException $e) { //en cas d'erreur (mauvais mdp, user, requêtes...) affiche le message erreurs c'est une exception
    print "error!:" . $e->getMessage() .
    die();
}
$requete = "select * from clientconnu where clt_code='" . $_GET['login'] . "';";
$result  = $dbh->query($requete);

if (!$result->rowCount()) {
    echo "Votre compte n'existe pas. Veuillez contacter notre service client par Mail.";
    exit();
}

$customerData = $result->fetch();
if ($customerData['clt_motPasse'] !== $_GET['mdp']) {
    echo "Mauvais mot de passe.";
    exit();
}

//requete pour envoyer vers la BDD vers commande
$dbh->exec("
    INSERT INTO commande (cde_moment, cde_client, cde_date) 
    VALUES ('" . $timestamp . "','" . $_GET['login'] . "','" . $date . "');
");



$cartItems = $_SESSION['cart']['items'];
foreach ($cartItems as $ref => $qty) {
    //requetes pour envoyer vers BDD contenir
    $dbh->exec("
        INSERT INTO contenir (cde_moment, cde_client, produit, quantite) 
        VALUES ('" . $timestamp . "','" . $_GET['login'] . "','" . $ref . "','" . $qty . "');
    ");
}
//requêtes pour vérifier que la commande est bien enregistré dans BDD
$requete = "select * from commande where cde_moment='" . $timestamp . "';";
$result  = $dbh->query($requete);
$req=false;
foreach ($result as $row){
    $req=true;
    echo "Votre commande a été enregistrée sous le numéro "  . $_GET['login'] . "/" . $timestamp;
    $_SESSION['cart']['items'] = [];
}    
    if ($req==false){
    echo 
        "Il y a eu un problème lors de l'enregistrement veuillez essayer à nouveau ";
    }
exit();
?>
</body>
</html>
