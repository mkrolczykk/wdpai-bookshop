<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookResp.php';

class FavoriteBooksRepository extends Repository {

    public function addToFavorites(string $userId, int $bookId): bool {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO system_user_favorite_book (user_id, book_id)
            VALUES (:userId, :bookId)
            ON CONFLICT (user_id, book_id) DO NOTHING
            RETURNING *
        ');

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

        $result = $stmt->execute();

        return $result && $stmt->rowCount() > 0;
    }


    public function removeFromFavorites(string $userId, int $bookId): bool {

        $stmt = $this->database->connect()->prepare('
            DELETE FROM system_user_favorite_book
            WHERE user_id = :userId AND book_id = :bookId
        ');

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }

    public function getFavoriteBooksCount(string $userId): int {
        $countStmt = $this->database->connect()->prepare('
            SELECT COUNT(*) AS favoritecount
            FROM system_user_favorite_book
            WHERE user_id = :userId
        ');

        $countStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $countStmt->execute();

        $result = $countStmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['favoritecount'];
    }

    public function getUserFavoriteBooks(string $userId, int $limit): array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT
            book.book_id AS bookid,
            book.title AS title,
            STRING_AGG(author.author_name, \', \') AS authors,
            book_price.price AS price,
            currency.shortcut AS currency
        FROM 
            system_user_favorite_book AS favorite
        JOIN book ON favorite.book_id = book.book_id
        JOIN book_author ON book.book_id = book_author.book_id
        JOIN author ON author.author_id = book_author.author_id
        JOIN book_price ON book.book_id = book_price.book_id
        JOIN currency ON book_price.currency_id = currency.currency_id
        WHERE
            favorite.user_id = :userId
        GROUP BY 
            book.book_id, 
            book.title, 
            book_price.price, 
            currency.shortcut,
            favorite.added_at
        ORDER BY favorite.added_at DESC
        LIMIT :limit
    ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new BookResp(
                $book['bookid'],
                $book['title'],
                $book['authors'],
                $book['price'],
                $book['currency']
            );
        }

        return $result;
    }

}