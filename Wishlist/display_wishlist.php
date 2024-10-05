<?php

session_start(); // Start the session
$user_id = $_SESSION['user_id']; // Retrieve the user ID from the session

include 'db.php'; 

// Fetch products from the database


$sql = "SELECT p.ProdID, p.P_Name, p.Price, p.picUrl FROM productlist p 
        INNER JOIN wishlist w ON p.ProdID = w.product_id 
        WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
$user_id = 1; // This should be dynamic based on logged-in user
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Display products
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo "<div class='wishlist-item'>";
    echo "<img src='" . htmlspecialchars($row['picUrl']) . "' alt='" .htmlspecialchars($row['P_Name']) . "' class='product-image'>";
    echo "<div class='product-overlay'>";
    echo "<h2>" .htmlspecialchars ($row['P_Name']) . "</h2>";
    echo "<p>$" . htmlspecialchars9 ($row['Price']) . "</p>";
    echo "<button class='add-to-cart' onclick='addToCart(" . (int)$row['ProdID'] . ")'>Add to Cart</button>";
    echo "<button class='remove-button' onclick='removeFromWishlist(" . (int)$row['ProdID'] . ")'>Remove</button>";
    echo "</div></div>";
}

} else {
    echo "<p>Your wishlist is empty.</p>"; 
}

?>