<div class=books-container>
    <section class="books-section">
            <?php foreach ($booksResult as $book): ?>
                <div id="<?= $book->getTitle(); ?>" class="book-section-cover">
                    <?php
                        $bookTitle = str_replace(' ', '-', strtolower($book->getTitle()));
                        $coverPath = 'public/img/books/' . $bookTitle . '.png';

                        if (file_exists($coverPath)) {
                            $coverSrc = $coverPath;
                        } else {
                            $coverSrc = 'public/img/books/mock-book-cover.png';
                        }

                        echo '<a href="bookDetail?bookTitle=' . $bookTitle . '"><img class="book-cover" src="' . $coverSrc . '" alt="Book cover"></a>';
                    ?>
                    <div class="book-description">
                        <h2 class="book-description-title"><a href="bookDetail?bookTitle=<?= str_replace(' ', '-', strtolower($book->getTitle())) ?>"><?= $book->getTitle(); ?></a></h2>
                        <p><?= $book->getAuthors(); ?></p>
                        <div class="price-section">
                            <p> <?= $book->getPrice(); echo ' '; echo $book->getCurrency();?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </section>
</div>
