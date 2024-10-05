<?php

session_start(); // Start the session
$user_id = $_SESSION['user_id']; // Retrieve the user ID from the session

include 'db.php'; 

if (isset($_POST['pProdID'])) {
    $ProdID = $_POST['ProdID'];
    $user_id = 1; // Dynamic user ID (use session or auth)

    $sql = "DELETE FROM wishlist WHERE ProdID = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $ProdID, $user_id);

    if ($stmt->execute()) {
        echo "Product removed from wishlist.";
    } else {
        echo "Error removing product.";
    }
}
?>