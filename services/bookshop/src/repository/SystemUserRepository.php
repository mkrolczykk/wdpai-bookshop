<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/request/SystemUserRegisterReq.php';
require_once __DIR__ . '/../model/response/SystemUserLoginResp.php';

class SystemUserRepository extends Repository {

    public function getSystemUser(string $email): ?SystemUserLoginResp {

        $stmt = $this->database->connect()->prepare('
            SELECT 
                su.user_id AS user_id, 
                su.name AS name, 
                su.surname AS surname, 
                su.username AS username, 
                su.email AS email, 
                su.password AS password,
                r.role_id AS role_id
            FROM system_user su
            JOIN user_role ur ON su.user_id = ur.user_id
            JOIN role r ON ur.role_id = r.role_id
            WHERE su.email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new SystemUserLoginResp(
            $user['user_id'],
            $user['name'],
            $user['surname'],
            $user['username'],
            $user['email'],
            $user['password'],
            $user['role_id']
        );
    }

    public function addSystemUser(SystemUserRegisterReq $userDto): bool {

        $pdo = $this->database->connect();
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare('
                INSERT INTO system_user (name, surname, username, email, password, notifications)
                VALUES (?, ?, ?, ?, ?, ?)
            ');

            $stmt->execute([
                $userDto->getName(),
                $userDto->getSurname(),
                $userDto->getUsername(),
                $userDto->getEmail(),
                $userDto->getPassword(),
                $userDto->getNotifications()
            ]);

            $user_id = $pdo->lastInsertId();

            $stmt = $pdo->prepare('
                INSERT INTO user_role (role_id, user_id)
                VALUES (?, ?)
            ');

            $stmt->execute([
                $userDto->getRoleId(),
                $user_id
            ]);

            $pdo->commit();

            return true;
        } catch (Exception $e) {
            $pdo->rollback();

            return false;
        }
    }

    private function getSystemUserID(string $name, string $surname, string $email): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id 
            FROM system_user 
            WHERE name = :name AND 
                  surname = :surname AND 
                  email = :email
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data['id'];
    }

    public function checkIfEmailAlreadyExists(string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT email 
            FROM system_user 
            WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($data !== false);
    }

    public function checkIfUsernameAlreadyExists(string $username): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT username 
            FROM system_user 
            WHERE username = :username
        ');

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($data !== false);
    }

}