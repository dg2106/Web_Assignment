<?php
session_start();
include 'db.php';

if (isset($_POST['ProdID']) && isset($_POST['quantity'])) {
    $ProdID = $_POST['ProdID'];
    $quantity = $_POST['quantity'];

    $query = "UPDATE cart SET quantity = ? WHERE ProdID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $quantity, $ProdID);
    $stmt->execute();

    header('Location: shoppingcart.php');
}
?>