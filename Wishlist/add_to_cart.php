<?php 
session_start();
include 'db.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1; // Default quantity for adding from wishlist or as sent

    // Check if the product is already in the cart
    $query = "SELECT * FROM cart WHERE ProdID = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $product_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If product is already in the cart, update the quantity
        $query = "UPDATE cart SET quantity = quantity + ? WHERE ProdID = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $quantity, $product_id, $_SESSION['user_id']);
        $stmt->execute();
    } else {
        // Insert new product into the cart
        $query = "INSERT INTO cart (user_id, ProdID, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $_SESSION['user_id'], $product_id, $quantity);
        $stmt->execute();
    }

    echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
}
?>