<?php
session_start();
include 'db.php'; // Database connection

// Fetch products from the database
$query = "SELECT productlist.ProdID, productlist.P_Name, productlist.Price, productlist.picUrl, cart.quantity
          FROM cart
          JOIN productlist ON cart.ProdID = productlist.ProdID";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $conn->query($query);

// Calculate the total price
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SHOPPING CART</title>
  <link rel="stylesheet" href="styles_shoppingcart.css">
</head>
<body>

  <header>
    <h1>My Shopping Cart</h1>
  </header>


<main class="product-grid" id="product-container>
  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="product-item">
        <img src="<?php echo $row['picUrl']; ?>" alt="<?php echo $row['P_Name']; ?>" class="product-image">
        <div class="product-overlay">
          <h2><?php echo $row['P_Name']; ?></h2>
          <p>Price: $<?php echo $row['Price']; ?></p>
          <p>Quantity: 
            <form action="update_cart.php" method="post">
              <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
              <input type="hidden" name="ProdID" value="<?php echo $row['ProdID']; ?>">
              <button type="submit">Update</button>
            </form>
          </p>
          <p>Total: $<?php echo $row['Price'] * $row['quantity']; ?></p>
          <button class="remove-button" onclick="location.href='remove_from_cart.php?ProdID=<?php echo $row['ProdID']; ?>'">Remove</button>
        </div>
      </div>
      <?php $totalPrice += $row['Price'] * $row['quantity']; ?>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Your cart is empty.</p>
  <?php endif; ?>
</main>

  <div class="cart-total">
    <h2>Total Price: $<?php echo number_format($totalPrice, 2); ?></h2>
    <button class="checkout-button" onclick="location.href='checkout.php'">Proceed to Checkout</button>
  </div>

</body>
</html>



  </main>

</body>
</html>