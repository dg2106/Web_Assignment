<?php
session_start(); // Start the session
$user_id = $_SESSION['user_id']; // Retrieve the user ID from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DEMURE WISHLIST</title>
  <link rel="stylesheet" href="styles_wishlist.css">
</head>
<body>

  <header>
    <h1>Your Wishlist</h1>
  </header>

  <main class="wishlist-grid" id="wishlist-container">
   
    <?php include 'display_wishlist.php'; ?>
    
  </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="wishlist.js"></script>


</body>
</html>