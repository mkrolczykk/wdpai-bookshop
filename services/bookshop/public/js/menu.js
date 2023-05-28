async function loadCategories(url) {
    try {
        const response = await fetch(url);
        const data = await response.json();
        const categoriesResult = data.categoriesResult;
        // Sort categories alphabetically
        categoriesResult.sort((a, b) => a.genre.localeCompare(b.genre));
        return categoriesResult;
    } catch (error) {
        console.error(error);
    }
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

// Load categories and create links automatically
(async () => {
    try {
        const categoriesResult = await loadCategories(getBookCategories);
        createCategoryLinks(categoriesResult);
    } catch (error) {
        console.error(error);
    }
})();
