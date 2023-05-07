function loadCategories(url) {
    return fetch(url)
        .then(response => response.json())
        .then(data => {
            const categoriesResult = data.categoriesResult;
            // sort categories alphabetically
            categoriesResult.sort((a, b) => a.genre.localeCompare(b.genre));
            return categoriesResult;
        })
        .catch(error => console.error(error));
}

function createCategoryLinks(categoriesResult) {
    const categoriesContainer = document.querySelector('.menu-categories-content');
    categoriesResult.forEach(category => {
        const categoryLink = document.createElement('a');
        categoryLink.href = `/category?type=${category.genre.toLowerCase().replace(/\s+/g, '-')}`;
        categoryLink.textContent = category.genre;
        categoriesContainer.appendChild(categoryLink);
    });
}

// load categories and create links automatically
loadCategories('http://localhost:8180/api/v1/genres/get-book-genres.php')
    .then(categoriesResult => createCategoryLinks(categoriesResult));
