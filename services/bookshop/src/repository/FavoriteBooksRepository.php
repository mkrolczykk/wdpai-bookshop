<?php

require_once 'Repository.php';

class FavoriteBooksRepository extends Repository {

    public function addToFavorites(string $userId, int $bookId): bool {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO system_user_favorite_book (user_id, book_id)
            VALUES (:userId, :bookId)
            ON CONFLICT (user_id, book_id) DO NOTHING
        ');

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

        return $stmt->execute();
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

}