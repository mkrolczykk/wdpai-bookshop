<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/ShoppingCartResp.php';

class ShoppingCartRepository extends Repository {

    public function addToShoppingCart(string $userId, int $bookId, int $amount): bool {
        $pdo = $this->database->connect();

        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare('
            INSERT INTO 
                shopping_cart (user_id, book_id, amount)
            VALUES 
                (:userId, :bookId, :amount)
        ');

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);

            $stmt->execute();

            $rowCount = $stmt->rowCount();

            $pdo->commit();

            return $rowCount > 0;
        } catch (PDOException $e) {
            $pdo->rollBack();
            return false;
        }
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

    public function getShoppingCartItemsCount(string $userId): int {
        $countStmt = $this->database->connect()->prepare('
            SELECT COUNT(*) AS itemscount
            FROM shopping_cart
            WHERE user_id = :userId
        ');

        $countStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $countStmt->execute();

        $result = $countStmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['itemscount'];
    }

    public function getUserShoppingCart(string $userId, string $currency): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT 
                book.book_id AS id,
                book.title AS bookname,
                book_price.price AS price,
                shopping_cart.amount AS amount,
                (book_price.price * shopping_cart.amount) AS total,
                currency.shortcut AS currency
            FROM 
                shopping_cart
            JOIN book ON shopping_cart.book_id = book.book_id
            JOIN book_price ON shopping_cart.book_id = book_price.book_id
            JOIN currency ON book_price.currency_id = currency.currency_id
            WHERE 
                shopping_cart.user_id = :userId AND
                currency.shortcut = :currency
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

        $stmt->execute();
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cartItems as $item) {
            $result[] = new ShoppingCartResp(
                $item['id'],
                $item['bookname'],
                $item['price'],
                $item['amount'],
                $item['currency'],
                $item['total']
            );
        }

        return $result;
    }

    public function getCartTotalAmount(string $userId, string $currency): float {

        $stmt = $this->database->connect()->prepare('
            SELECT 
                SUM(book_price.price * shopping_cart.amount) AS total
            FROM 
                shopping_cart
            JOIN book_price ON shopping_cart.book_id = book_price.book_id
            JOIN currency ON book_price.currency_id = currency.currency_id
            WHERE 
                shopping_cart.user_id = :userId AND
                currency.shortcut = :currency
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (float) $result['total'];
    }

    public function submitOrder(string $userId, int $shippingMethodId, int $addressId, int $currencyId): bool
    {
        $pdo = $this->database->connect();

        $pdo->beginTransaction();

        try {
            // Get all books from shopping cart
            $stmt = $pdo->prepare('
                SELECT 
                    sc.book_id, 
                    sc.amount,
                    bp.price
                FROM 
                    shopping_cart sc
                INNER JOIN 
                    book b ON sc.book_id = b.book_id
                INNER JOIN
                    book_price bp ON bp.book_id = b.book_id AND bp.currency_id = :currencyId
                WHERE 
                    sc.user_id = :userId
            ');

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':currencyId', $currencyId, PDO::PARAM_INT);
            $stmt->execute();

            $orderLines = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($orderLines)) {
                return false;
            }

            // Create new order
            $stmt = $pdo->prepare('
                INSERT INTO "order" (user_id, shipping_method_id, address_id)
                VALUES (:userId, :shippingMethodId, :addressId)
            ');

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':shippingMethodId', $shippingMethodId, PDO::PARAM_INT);
            $stmt->bindParam(':addressId', $addressId, PDO::PARAM_INT);
            $stmt->execute();

            $orderId = $pdo->lastInsertId();

            // Create a corresponding order_line for each item in shopping cart
            foreach ($orderLines as $orderLine) {
                $bookId = $orderLine['book_id'];
                $amount = $orderLine['amount'];
                $price = $orderLine['price'];

                $totalPrice = $price * $amount;

                $stmt = $pdo->prepare('
                    INSERT INTO order_line (order_id, book_id, amount, total_price, currency_id)
                    VALUES (:orderId, :bookId, :amount, :totalPrice, :currencyId)
                ');

                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
                $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
                $stmt->bindParam(':totalPrice', $totalPrice);
                $stmt->bindParam(':currencyId', $currencyId, PDO::PARAM_INT);
                $stmt->execute();
            }

            // Add a record to order_history with status "Order Received"

            $stmt = $pdo->prepare('
                SELECT 
                    status_id
                FROM 
                    order_status
                WHERE 
                    status = :status
                LIMIT 1
            ');

            $status = 'Order Received';

            $stmt->bindParam(':status', $status);
            $stmt->execute();

            $statusId = $stmt->fetchColumn();

            if (!$statusId) {
                return false;
            }

            $stmt = $pdo->prepare('
                INSERT INTO order_history (order_id, status_id)
                VALUES (:orderId, :statusId)
            ');

            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->bindParam(':statusId', $statusId, PDO::PARAM_INT);
            $stmt->execute();

            // Empty user's shopping cart
            $stmt = $pdo->prepare('
                DELETE FROM shopping_cart 
                WHERE 
                    user_id = :userId
            ');

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $pdo->commit();

            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            return false;
        }
    }

}
