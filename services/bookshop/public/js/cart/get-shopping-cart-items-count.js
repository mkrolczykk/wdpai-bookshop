
getShoppingCartItemsCountEndpoint = 'http://localhost:8180/api/v1/cart/get-shopping-cart-items-count.php';

function getShoppingCartItemsCount() {

    fetch(getShoppingCartItemsCountEndpoint, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }})
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.status === 200) {
                document.querySelector('.menu-navigation-other-shopping-card-value').textContent = data.countResult;
            }
        })
        .catch(error => {
            console.error('Error during loading shopping cart items count value: ', error);
        });
}

// load automatically
getShoppingCartItemsCount();