<div class=books-container>
    <section class="books-section">
            <?php foreach ($booksResult as $book): ?>
                <div id="<?= $book->getTitle(); ?>" class="book-section-cover">
                    <?php
                        if ($book->getCover()) {
                            echo '<a href="bookDetail?bookTitle=' . str_replace(' ', '-', strtolower($book->getTitle())) . '"><img class="book-cover" src="data:image/png;base64,' . base64_encode(stream_get_contents($book->getCover())) . '" alt="Book cover"></a>';
                        } else {
                            echo '<a href="bookDetail?bookTitle=' . str_replace(' ', '-', strtolower($book->getTitle())) . '"><img class="book-cover" src="public/img/default-cover.png"></a>';
                        }
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
