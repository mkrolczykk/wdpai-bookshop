async function removeFromFavorites(bookId) {
    try {
        const requestBody = {
            bookId: bookId
        };

        const response = await fetch(removeFromFavoritesEndpoint, {
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
            // Success - book has been removed from favorites
            alert(data.message);
            location.reload();
        } else if (data && data.status === 400) {
            // Fail - book not present in favorites
            alert(data.message);
        } else {
            // Internal server errors
            alert('Server error: ' + data.message);
        }
    } catch (error) {
        // HTTP exceptions
        alert('Request failed: ' + error.message);
        console.log(error);
    }
}