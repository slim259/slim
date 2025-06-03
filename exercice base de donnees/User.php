<?php
class User {
    private $repository;

    public function __construct(PDO $pdo) {
        $this->repository = new Repository($pdo, 'user');
    }

    public function authenticate($username, $password) {
        $stmt = $this->repository->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }


}