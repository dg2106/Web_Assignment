<?php
session_start();
include 'db.php';

if (isset($_GET['ProdID'])) {
    $ProdID = $_GET['ProdID'];

    $query = "DELETE FROM cart WHERE ProdID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ProdID);
    $stmt->execute();

    header('Location: shoppingcart.php');
}
?>