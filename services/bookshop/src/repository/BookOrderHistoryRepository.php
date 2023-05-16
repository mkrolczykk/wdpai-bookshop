<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookResp.php';

class BookOrderHistoryRepository extends Repository {

    public function getTopSoldBooks(int $limit, string $currency): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT
                book.book_id AS bookid, 
                book.title AS title, 
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
                    os.status in (\'Order Received\', \'Pending Delivery\', \'Delivered\', \'Delivery In Progress\')
                GROUP BY 
                    ol.book_id
                ORDER BY 
                    total_amount DESC
            ) AS sales ON book.book_id = sales.book_id
            WHERE 
                book.created_at <= NOW() AND
                currency.shortcut = :currency
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
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

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