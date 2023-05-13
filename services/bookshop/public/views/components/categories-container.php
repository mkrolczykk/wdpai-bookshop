<?php

$categoriesHtml = '';

foreach ($bookCategories as $category) {
    $genre = strtolower(str_replace(' ', '-', $category->getGenre()));
    $thumbnailPath = 'public/img/categories/' . $genre . '.png';

    if (file_exists($thumbnailPath)) {
        $thumbnailSrc = $thumbnailPath;
    } else {
        $thumbnailSrc = 'public/img/categories/default-cover.png';
    }

    $categoryLink = '/category?type=' . $genre;
    $categoryHtml = sprintf(
        '<a href="%s" class="categories-container-books-categories-container-category">
                    <img src="%s" alt="%s">
                    <h2>%s</h2>
                </a>',
        $categoryLink,
        $thumbnailSrc,
        $category->getGenre(),
        $category->getGenre()
    );
    $categoriesHtml .= $categoryHtml;
}
?>
<section class="categories-container">
    <section class="categories-container-books-categories">
        <h1 class="page-section-title categories-container-books-categories-title">Categories</h1>
        <div class="categories-container-books-categories-container">
            <?php echo $categoriesHtml; ?>
        </div>
    </section>
</section>