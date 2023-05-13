
const removeFromShoppingCartEndpoint = 'http://localhost:8180/api/v1/cart/remove-from-shopping-cart.php';

function removeFromShoppingCart(bookId) {

    const requestBody = {
        bookId: bookId
    };

    fetch(removeFromShoppingCartEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestBody)
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Request failed with status ' + response.status);
            }
        })
        .then(data => {
            if (data && data.status === 200) {
                // Success - Book has been removed from shopping cart
                alert(data.message);
            } else if (data && data.status === 400) {
                // Fail - Book not present in shopping cart
                alert(data.message);
            } else {
                // Internal server errors
                alert('Server error: ' + data.message);
            }
        })
        .catch(error => {
            // HTTP exceptions
            alert('Request failed: ' + error.message);
            console.log(error);
        });
}
