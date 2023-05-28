async function addToShoppingCart(bookId) {
    try {
        const amount = parseInt(document.querySelector('.amount').innerText);

        const requestBody = {
            bookId: bookId,
            amount: amount
        };

        const response = await fetch(addToShoppingCartEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            throw new Error('Request failed with status ' + response.status);
        }

        const data = await response.json();

        if (data && data.status === 200) {
            // Success - Book has been added to the shopping cart
            alert(data.message);
            location.reload();
        } else if (data && data.status === 400) {
            // Fail - Book already present in the shopping cart
            alert(data.message);
        } else {
            // Internal server error
            alert('Server error: ' + data.message);
        }
    } catch (error) {
        // Handle any exception, including HTTP errors
        alert('Request failed: ' + error.message);
        console.log(error);
    }
}