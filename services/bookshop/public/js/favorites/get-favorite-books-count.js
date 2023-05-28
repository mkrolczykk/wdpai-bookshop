async function getFavoriteBooksCount() {
    try {
        const response = await fetch(getFavoriteBooksCountEndpoint, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Request failed with status ' + response.status);
        }

        const data = await response.json();

        if (data.status === 200) {
            const countElement = document.querySelector('.menu-navigation-other-favourite-books-value');
            countElement.textContent = data.countResult;
        }
    } catch (error) {
        console.error('Error during loading favorites books count number: ', error);
    }
}

// Load automatically
getFavoriteBooksCount();