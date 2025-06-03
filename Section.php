<?php
class Section {
    private $repository;

    public function __construct(PDO $pdo) {
        $this->repository = new Repository($pdo, 'section');
    }


}