<?php
session_start();

if ($_GET['btn'] == "Ajouter au panier") {
    $ref = $_GET['reference'];
    $qty = $_GET['quantite'];

    
    // D'abord, chercher la ref. Si trouvée, on incrémente la qty
    if (isset($_SESSION['cart']['items'][$ref])){ 
        $_SESSION['cart']['items'][$ref] += $qty;
        header("Location:menu.php");
        exit();
    }

    // Sinon on crée la ref+  qty
    $_SESSION['cart']['items'][$ref] = $qty;
    //echo "turlututututu";
    header("Location:menu.php");
    exit();
    
}

if ($_GET['btn'] == "Vider le panier") {
    $_SESSION['cart']['items'] = [];
    header("Location:commande.php");
    exit();
} 
