<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/response/CurrencyResp.php';

class CurrencyRepository extends Repository {

    public function getCurrencyId(string $currency): ?CurrencyResp
    {
        $pdo = $this->database->connect();

        $stmt = $pdo->prepare('
            SELECT 
                currency_id AS currencyid, 
                currency_name AS currencyname,
                shortcut
            FROM currency
            WHERE 
                shortcut = :currency
        ');

        $stmt->bindParam(':currency', $currency);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return
                new CurrencyResp($result['currencyid'], $result['currencyname'], $result['shortcut']);
        }

        return null;
    }

}