<?php
session_start();
include'db.php';

if (isset($_POST['ProdID'])) {
    $ProdID = $_POST['ProdID'];
    $quantity = 1; 

    // Check if the product is already in the cart
    $query = "SELECT * FROM cart WHERE ProdID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ProdID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if already in the cart
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE ProdID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ProdID);
        $stmt->execute();
    } else {
        // Insert new product into cart
        $query = "INSERT INTO cart (ProdID, quantity) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $ProdID, $quantity);
        $stmt->execute();
    }

    header('Location: shoppingcart.php');
}
?>