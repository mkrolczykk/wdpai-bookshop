<?php

require_once 'Repository.php';

class ShoppingCartRepository extends Repository {

    public function addToShoppingCart(string $userId, int $bookId, int $amount): bool {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO 
                shopping_cart (user_id, book_id, amount)
            VALUES 
                (:userId, :bookId, :amount)
            ON CONFLICT (user_id, book_id) DO NOTHING
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function removeFromShoppingCart(string $userId, int $bookId): bool {

        $stmt = $this->database->connect()->prepare('
            DELETE FROM 
                shopping_cart
            WHERE 
                user_id = :userId AND
                book_id = :bookId
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }

    public function increaseAmountOfGivenBook(string $userId, int $bookId) {

        $stmt = $this->database->connect()->prepare('
            UPDATE 
                shopping_cart 
            SET 
                "amount" = "amount" + 1 
            WHERE 
                user_id = :userid AND
                book_id = :bookid
         ');

        $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':bookid', $bookId, PDO::PARAM_INT);

        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }

    public function decreaseAmountOfGivenBook(string $userId, int $bookId): bool {
        $stmt = $this->database->connect()->prepare('
            UPDATE 
                shopping_cart 
            SET 
                amount = 
                    CASE WHEN amount > 1 
                        THEN amount - 1 
                        ELSE amount 
                    END
            WHERE 
                user_id = :userId AND
                book_id = :bookId
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);

        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }

}
