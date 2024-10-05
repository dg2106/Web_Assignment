$(document).ready(function() {
// Function to add product to cart
$('.add-to-cart').click(function() {
    const ProdID = $(this).data('id'); // Assuming each "Add to Cart" button has a data attribute for product ID
    $.ajax({
        url: 'add_to_cart.php', // The server-side script
        method: 'POST',
        data: { ProdID: ProdID },
        success: function(response) {
        // Update the cart icon or display a success message
        $('#cart-count').text(response.cart_count); // Update cart item count
            alert('Product added to cart!');
            },
        error: function() {
            alert('Error adding product to cart');
        }
    });
});

// Function to remove product from cart
$('.remove-button').click(function() {
    const ProdID = $(this).data('id'); // Product ID to remove
    $.ajax({
        url: 'remove_from_cart.php',
         method: 'POST',
        data: { ProdID: ProdID },
        success: function(response) {
         // Remove product from the DOM or update the cart view
            $('#product-' + ProdID).remove();
            $('#cart-total').text(response.new_total); // Update the total amount
            alert('Product removed from cart!');
        },
        error: function() {
            alert('Error removing product from cart');
        }
    });
 });

// Function to update quantity in the cart
$('.quantity-input').on('change', function() {
    const ProdID = $(this).data('id');
    const newQuantity = $(this).val();
    $.ajax({
        url: 'update_quantity.php',
        method: 'POST',
        data: {
            ProdID: ProdID,
            quantity: newQuantity
        },
        success: function(response) {
        // Update the subtotal for the item and the cart total
            $('#subtotal-' + ProdID).text(response.new_subtotal);
            $('#cart-total').text(response.cart_total);
            alert('Quantity updated!');
        },
        error: function() {
            alert('Error updating quantity');
        }
    });
});
});