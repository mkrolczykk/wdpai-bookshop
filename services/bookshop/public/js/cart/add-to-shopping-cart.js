
const addToShoppingCartEndpoint = 'http://localhost:8180/api/v1/cart/add-to-shopping-cart.php';

function addToShoppingCart(bookId) {

    const amount = parseInt(document.querySelector('.amount').innerText);

    const requestBody = {
        bookId: bookId,
        amount: amount
    };

    fetch(addToShoppingCartEndpoint, {
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
                // Success - Book has been added to shopping cart
                alert(data.message);
            } else if (data && data.status === 400) {
                // Fail - Book already present in shopping cart
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
