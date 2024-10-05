// Load Wishlist on Page Load
$(document).ready(function() {
    $('#wishlist-container').load('display_wishlist.php');
});

//Add to card 
$(document). ready(function(){
    //Function to addd product to cart
    $('.add-to-cart').click(function() {
        const ProdID = $(this).data('id'); 

    $.ajax({
        url: 'add_to_cart.php',
        type: 'POST',
        data: { ProdID: ProdID },
        success: function(response) {
            alert(response);
        },
        error: function() {
            alert('Error adding product to cart.');
        }
    });
    });
});

// Remove from Wishlist with Confirmation
function removeFromWishlist(ProdID) {
    const confirmRemove = confirm("Are you sure you want to remove this product from your wishlist?");
    if (confirmRemove) {
        $.ajax({
            url: 'remove_from_wishlist.php',
            type: 'POST',
            data: { ProdID: ProdID },
            success: function(response) {
                alert(response);
                location.reload(); // Refresh page to update wishlist
            },
            error: function() {
                alert('Error removing product from wishlist.');
            }
        });
    } else {
        alert('Product not removed.');
    }
}