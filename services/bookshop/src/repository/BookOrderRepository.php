<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/BookOrderResp.php';

class BookOrderRepository extends Repository {

    public function getOrders(): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT
                o.order_id AS orderid,
                TO_CHAR(o.created_at, \'YYYY-MM-DD HH24:MI:SS\') AS ordertime,
                SUM(ol.total_price) AS total,
                c.shortcut AS currency,
                CONCAT(u.name, \' \', u.surname) AS orderexec,
                os.status AS orderstatus
            FROM
                "order" AS o
            INNER JOIN
                order_line AS ol ON o.order_id = ol.order_id
            INNER JOIN
                currency AS c ON ol.currency_id = c.currency_id
            INNER JOIN
                order_history AS oh ON o.order_id = oh.order_id
            INNER JOIN
                order_status AS os ON oh.status_id = os.status_id
            LEFT JOIN
                system_user AS u ON o.order_exec = u.user_id
            WHERE
                os.status = \'Order Received\'
            GROUP BY
                o.order_id,
                o.created_at,
                c.shortcut,
                os.status,
                u.name,
                u.surname
            ORDER BY
                o.created_at ASC
        ');

        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($orders as $order) {
            $result[] = new BookOrderResp(
                $order['orderid'],
                $order['ordertime'],
                $order['total'],
                $order['currency'],
                $order['orderstatus'],
                $order['orderexec']
            );
        }

        return $result;
    }

    public function updateOrderStatusToPendingDelivery($orderId): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
            UPDATE order_history
            SET 
                status_id = (SELECT status_id FROM order_status WHERE status = \'Pending Delivery\')
            WHERE 
                order_id = :orderId AND 
                status_id = (SELECT status_id FROM order_status WHERE status = \'Order Received\')
            ');

            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();

            $rowCount = $stmt->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function assignEmployeeToOrder($orderId, $employeeId): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('
                UPDATE "order"
                SET 
                    order_exec = :employeeId
                WHERE 
                    order_id = :orderId
            ');

            $stmt->bindParam(':employeeId', $employeeId);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();

            $rowCount = $stmt->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

}