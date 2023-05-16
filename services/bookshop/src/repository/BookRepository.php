<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookResp.php';
require_once __DIR__ . '/../model/response/BookDetailResp.php';

class BookRepository extends Repository
{
    public function getBooksByTitleOrAuthor(string $searchKey, string $currency): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT 
                book.title AS title,
                STRING_AGG(author.author_name, \', \') AS authors,
                book_price.price AS price, 
                currency.shortcut AS currency
            FROM book
            JOIN book_author ON book.book_id = book_author.book_id
            JOIN author ON author.author_id = book_author.author_id
            JOIN book_price ON book.book_id = book_price.book_id
            JOIN currency ON book_price.currency_id = currency.currency_id
            WHERE 
                (LOWER(book.title) LIKE :search OR LOWER(author.author_name) LIKE :search) AND
                currency.shortcut = :currency
            GROUP BY book.book_id, book.title, book_price.price, currency.shortcut
        ');

        $searchKey = '%' . strtolower($searchKey) . '%';
        $search = '%' . $searchKey . '%';

        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new BookResp(
                $book['title'],
                $book['authors'],
                $book['price'],
                $book['currency']
            );
        }

        return $result;
    }

    public function countBooks(): int {

        $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) as count FROM book
        ');

        $stmt->execute();

        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$count['count'];
    }

    public function getRecentlyAddedBooks(int $limit, string $currency): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT 
                book.title AS title,
                STRING_AGG(author.author_name, \', \') AS authors,
                book_price.price AS price, 
                currency.shortcut AS currency
            FROM book
            JOIN book_author ON book.book_id = book_author.book_id
            JOIN author ON author.author_id = book_author.author_id
            JOIN book_price ON book.book_id = book_price.book_id
            JOIN currency ON book_price.currency_id = currency.currency_id
            WHERE
                book.created_at <= NOW() AND
                currency.shortcut = :currency
            GROUP BY 
                book.book_id, 
                book.title, 
                book_price.price, 
                currency.shortcut, 
                book.created_at
            ORDER BY 
                book.created_at DESC
            LIMIT :limit
        ');

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new BookResp(
                $book['title'],
                $book['authors'],
                $book['price'],
                $book['currency']
            );
        }

        return $result;
    }

    public function getCategoryRelatedBooks(string $categoryType, string $currency): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT 
            book.title AS title, 
            STRING_AGG(author.author_name, \', \') AS authors,
            book_price.price AS price, 
            currency.shortcut AS currency
        FROM book
        JOIN book_author ON book.book_id = book_author.book_id
        JOIN author ON author.author_id = book_author.author_id
        JOIN book_price ON book.book_id = book_price.book_id
        JOIN currency ON book_price.currency_id = currency.currency_id
        JOIN book_genre ON book_genre.genre_id = book.genre_id
        WHERE
            LOWER(book_genre.genre) = LOWER(:categoryType) AND
            currency.shortcut = :currency
        GROUP BY 
            book.book_id, 
            book.title, 
            book_price.price, 
            currency.shortcut, 
            book.created_at
        ORDER BY 
            book.created_at DESC
    ');

        $stmt->bindParam(':categoryType', $categoryType, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new BookResp(
                $book['title'],
                $book['authors'],
                $book['price'],
                $book['currency']
            );
        }

        return $result;
    }

    public function getBookByTitle(string $title): ?BookDetailResp {

        $title = str_replace('-', ' ', $title);

        $stmt = $this->database->connect()->prepare('
        SELECT 
            book.book_id AS bookid,
            book.title AS title, 
            STRING_AGG(author.author_name, \', \') AS authors,
            book_genre.genre AS category,
            book.summary AS summary,
            book.description AS description,
            book_price.price AS price, 
            currency.shortcut AS currency,
            book.num_pages AS numpages,
            STRING_AGG(book_language.language_name, \', \') AS languages,
            TO_CHAR(book.created_at::DATE, \'YYYY-MM-DD\') AS addedat
        FROM book
        JOIN book_author ON book.book_id = book_author.book_id
        JOIN book_genre ON book.genre_id = book_genre.genre_id
        JOIN author ON author.author_id = book_author.author_id
        JOIN book_price ON book.book_id = book_price.book_id
        JOIN book_language ON book.language_id = book_language.language_id
        JOIN currency ON book_price.currency_id = currency.currency_id
        WHERE
            LOWER(book.title) = LOWER(:title)
        GROUP BY 
            book.book_id, 
            book.title,
            book_genre.genre,
            book_price.price, 
            currency.shortcut,
            book.num_pages,
            book.created_at
    ');

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);

        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            return null;
        }

        return new BookDetailResp(
            $book['bookid'],
            $book['title'],
            $book['authors'],
            $book['category'],
            $book['summary'],
            $book['description'],
            $book['price'],
            $book['currency'],
            $book['numpages'],
            $book['languages'],
            $book['addedat']
        );

    }

    public function checkIfBookExists(string $title, string $slug): bool
    {
        $title = strtolower(trim($title));
        $slug = strtolower(trim($slug));

        $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) AS count
            FROM book
            WHERE LOWER(title) = :title
            AND LOWER(slug) = :slug
        ');

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    public function addBook(AddBookReq $bookReq): bool
    {
        $title = $bookReq->getTitle();
        $author = $bookReq->getAuthor();
        $summary = $bookReq->getSummary();
        $description = $bookReq->getDescription();
        $slug = $bookReq->getSlug();
        $genre = $bookReq->getGenre();
        $numPages = $bookReq->getNumPages();
        $language = $bookReq->getLanguage();
        $price = $bookReq->getPrice();
        $currency = $bookReq->getCurrency();
        $publisher = $bookReq->getPublisher();

        $pdo = $this->database->connect();
        $pdo->beginTransaction();

        try {
            // Check if publisher exists
            $stmt = $pdo->prepare('SELECT publisher_id FROM publisher WHERE publisher_name = ?');
            $stmt->execute([$publisher]);
            $publisherId = $stmt->fetchColumn();

            if (!$publisherId) {
                // If not, create a new one
                $stmt = $pdo->prepare('INSERT INTO publisher (publisher_name) VALUES (?)');
                $stmt->execute([$publisher]);
                $publisherId = $pdo->lastInsertId();
            }

            // Check if language exists
            $stmt = $pdo->prepare('SELECT language_id FROM book_language WHERE language_name = ?');
            $stmt->execute([$language]);
            $languageId = $stmt->fetchColumn();

            if (!$languageId) {
                // if not, add new one
                $stmt = $pdo->prepare('INSERT INTO book_language (language_name) VALUES (?)');
                $stmt->execute([$language]);
                $languageId = $pdo->lastInsertId();
            }

            // Check if category exists
            $stmt = $pdo->prepare('SELECT genre_id FROM book_genre WHERE genre = ?');
            $stmt->execute([$genre]);
            $genreId = $stmt->fetchColumn();

            if (!$genreId) {
                // if not, add new one
                $stmt = $pdo->prepare('INSERT INTO book_genre (genre) VALUES (?)');
                $stmt->execute([$genre]);
                $genreId = $pdo->lastInsertId();
            }

            // Check if author exists
            $stmt = $pdo->prepare('SELECT author_id FROM author WHERE author_name = ?');
            $stmt->execute([$author]);
            $authorId = $stmt->fetchColumn();

            if (!$authorId) {
                // if not, add new one
                $stmt = $pdo->prepare('INSERT INTO author (author_name) VALUES (?)');
                $stmt->execute([$author]);
                $authorId = $pdo->lastInsertId();
            }

            // Add book
            $stmt = $pdo->prepare('
                INSERT INTO book (title, summary, description, num_pages, slug, genre_id, language_id, publisher_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ');

            $stmt->execute([$title, $summary, $description, $numPages, $slug, $genreId, $languageId, $publisherId]);

            $bookId = $pdo->lastInsertId();

            // Assign author to book
            $stmt = $pdo->prepare('INSERT INTO book_author (book_id, author_id) VALUES (?, ?)');
            $stmt->execute([$bookId, $authorId]);

            // Get currency id
            $stmt = $pdo->prepare('SELECT currency_id FROM currency WHERE shortcut = ?');
            $stmt->execute([$currency]);
            $currencyId = $stmt->fetchColumn();

            // Add book price for given currency
            $stmt = $pdo->prepare('INSERT INTO book_price (book_id, price, currency_id) VALUES (?, ?, ?)');
            $stmt->execute([$bookId, $price, $currencyId]);

            $pdo->commit();

            return true;
        } catch (Exception $e) {
            $pdo->rollback();
            return false;
        }
    }

}
