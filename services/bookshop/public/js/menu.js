function loadCategories(url) {

    fetch(url)
        .then(response => response.json())
        .then(data => {

            const categoriesResult = data.categoriesResult;
            const categoriesContainer = document.querySelector('.menu-categories-content');

            // sort categories alphabetically
            categoriesResult.sort((a, b) => a.genre.localeCompare(b.genre));

            categoriesResult.forEach(category => {
                const categoryLink = document.createElement('a');
                categoryLink.href = `/category?type=${category.genre.toLowerCase().replace(/\s+/g, '-')}`;
                categoryLink.textContent = category.genre;
                categoriesContainer.appendChild(categoryLink);
            });
        })
        .catch(error => console.error(error));
}

// load automatically
loadCategories('http://localhost:8180/api/v1/genres/get-book-genres.php');