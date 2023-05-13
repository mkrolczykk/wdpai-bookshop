
getFavoriteBooksCountEndpoint = 'http://localhost:8180/api/v1/favorites/get-favorite-books-count.php';

function getFavoriteBooksCount() {

    fetch(getFavoriteBooksCountEndpoint, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }})
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.status === 200) {
                document.querySelector('.menu-navigation-other-favourite-books-value').textContent = data.countResult;
            }
        })
        .catch(error => {
            console.error('Error during loading favorites books count number: ', error);
        });
}

// load automatically
getFavoriteBooksCount();