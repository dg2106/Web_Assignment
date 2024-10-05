<?php
session_start();
include 'db.php';

// Assuming user is ready to checkout
$totalPrice = 0;
$query = "SELECT productlist.Price, cart.quantity
          FROM cart
          JOIN productlist ON cart.ProdID = productlist.ProdID";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalPrice += $row['Price'] * $row['quantity'];
    }
}

// Handle the checkout process (e.g., payment, shipping, etc.)
// This is a simplified placeholder

echo "<h1>Checkout</h1>";
echo "<p>Total Price: $" . number_format($totalPrice, 2) . "</p>";
echo "<p>Proceeding to payment...</p>";

// Clear the cart after checkout
$conn->query("DELETE FROM cart");

?>