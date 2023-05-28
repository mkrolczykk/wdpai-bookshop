async function getShoppingCartItemsCount() {
    try {
        const response = await fetch(getShoppingCartItemsCountEndpoint, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const data = await response.json();

        if (data.status === 200) {
            document.querySelector('.menu-navigation-other-shopping-card-value').textContent = data.countResult;
        }
    } catch (error) {
        console.error('Error during loading shopping cart items count value: ', error);
    }
}

// load automatically
getShoppingCartItemsCount();