<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookResp.php';

class BookOrderHistoryRepository extends Repository {

    public function getTopSoldBooks(int $limit): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT
                book.title AS title, 
                book.cover AS cover,
                STRING_AGG(author.author_name, \', \') AS authors,
                book_price.price AS price, 
                currency.shortcut AS currency,
                sales.total_amount AS total_amount
            FROM book
            JOIN book_author ON book.book_id = book_author.book_id
            JOIN author ON author.author_id = book_author.author_id
            JOIN book_price ON book.book_id = book_price.book_id
            JOIN currency ON book_price.currency_id = currency.currency_id
            JOIN (
                SELECT 
                    ol.book_id AS book_id, 
                    SUM(ol.amount) AS total_amount
                FROM order_line ol
                JOIN "order" o ON o.order_id = ol.order_id
                JOIN order_history oh ON o.order_id = oh.order_id
                JOIN order_status os ON os.status_id = oh.status_id
                WHERE 
                    os.status in (\'Delivered\', \'Delivery In Progress\')
                GROUP BY 
                    ol.book_id
                ORDER BY 
                    total_amount DESC
                LIMIT :limit
            ) AS sales ON book.book_id = sales.book_id
            WHERE 
                book.created_at <= NOW()
            GROUP BY 
                book.book_id, 
                book.title, 
                book_price.price, 
                currency.shortcut, 
                book.created_at,
                sales.total_amount
            ORDER BY
                sales.total_amount DESC
            LIMIT :limit
        ');

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new BookResp(
                $book['title'],
                $book['cover'],
                $book['authors'],
                $book['price'],
                $book['currency']
            );
        }

        return $result;
    }

}