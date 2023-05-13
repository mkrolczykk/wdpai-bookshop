
const addToFavoritesEndpoint = 'http://localhost:8180/api/v1/favorites/add-to-favorites.php';

function addToFavorites(bookId) {

    const requestBody = {
        bookId: bookId
    };

    fetch(addToFavoritesEndpoint, {
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
                // Success - book has been added to favorites
                alert(data.message);
            } else if (data && data.status === 400) {
                // Fail - book already present in favorites
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