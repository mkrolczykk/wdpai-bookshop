<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookResp.php';

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

    public function getBookByTitle(string $title, string $currency): ?BookResp {

        $title = str_replace('-', ' ', $title);

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
            LOWER(book.title) = LOWER(:title) AND
            currency.shortcut = :currency
        GROUP BY 
            book.book_id, 
            book.title, 
            book_price.price, 
            currency.shortcut, 
            book.created_at
    ');

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            return null;
        }

        return new BookResp(
            $book['title'],
            $book['authors'],
            $book['price'],
            $book['currency']
        );

    }
}
