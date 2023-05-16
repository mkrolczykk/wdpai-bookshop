
const removeFromFavoritesEndpoint = 'http://localhost:8180/api/v1/favorites/remove-from-favorites.php';

function removeFromFavorites(bookId) {

    const requestBody = {
        bookId: bookId
    };

    fetch(removeFromFavoritesEndpoint, {
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
                // Success - book has been removed favorites
                alert(data.message);
                location.reload();
            } else if (data && data.status === 400) {
                // Fail - book not present in favorites
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